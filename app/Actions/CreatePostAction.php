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
        $post = Post::query()->create(Arr::except($data, ['file', 'category']));

        // save category
         foreach (json_decode($data['category']) as $categoryId){
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