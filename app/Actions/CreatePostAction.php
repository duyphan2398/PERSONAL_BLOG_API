<?php

namespace App\Actions;

use App\Models\File;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class CreatePostAction
{
    public function execute(array $data)
    {
        $transformData = Arr::except($data, ['file', 'categories']);
        $slug = Str::random(3).'-'.join('+',explode(' ', str_replace('/', '',Arr::get($transformData, 'short_title'))));
        $transformData['slug'] = $slug;

        $post = Post::query()->create($transformData);


        // save category
         foreach (json_decode($data['categories']) as $categoryId){
             $post->postCategories()->create(['category_id' => $categoryId]);
         }

        // save thumbnail
        if (Arr::get($data, 'file')){
            $destinationPath =  'POST/THUMBNAIL/'.$post->id.'/'.Carbon::today()->format('d-m-y');
            $profileImage = Str::random(20).'_'.Carbon::now()->format('d-m-y-h-i').'.'.$data['file']->getClientOriginalExtension();
            $path = $data['file']->storeAs($destinationPath, $profileImage, 'public');
            if ($path){
                $uploadFile =  pathinfo($path);
                $thumbnail = File::query()->create([
                    'path'        => $path,
                    'name'        => $data['file']->getClientOriginalName(),
                    'upload_name' => $uploadFile['basename'],
                    'type'        => 'IMAGE',
                    'target'      => 'POST',
                    'size'        => request()->file('file')->getSize(),
                    'extension'   => $uploadFile['extension'],
                    'mime_type'   => $data['file']->getClientMimeType()
                ]);

                $post->update(['file_id' => $thumbnail->id]);
            }
        }

        return $post;
    }
}