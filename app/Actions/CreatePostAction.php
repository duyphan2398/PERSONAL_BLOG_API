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
         foreach ($data['category'] as $category){
             $post->postCategories()->create(['category_id' => $category->id]);
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
                    'type'        => $data['type'],
                    'target'      => $data['target'],
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