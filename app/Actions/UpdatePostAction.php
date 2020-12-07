<?php

namespace App\Actions;


use App\Models\File;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UpdatePostAction
{

    public function execute(array $data, Post $post)
    {
        $post->update(Arr::except($data, ['file', 'category']));
        // update category
        $post->postCategories()->delete();
        foreach ($data['category'] as $category){
            $post->postCategories()->create(['category_id' => $category->id]);
        }

        // update thumbnail
        if (Arr::get($data, 'file')) {
            if ($post->file){
                $post->file()->delete();
                Storage::disk('public')->deleteDirectory('POST/THUMBNAIL/'.$post->id);
            }

            $destinationPath = 'POST/THUMBNAIL/'.$post->id.'/'.Carbon::today()->format('d-m-y');
            $profileImage = Str::random(20).'_'.Carbon::now()
                                                      ->format('d-m-y-h-i').'.'.$data['file']->getClientOriginalExtension();
            $path = $data['file']->storeAs($destinationPath, $profileImage, 'public');
            if ($path) {
                $uploadFile = pathinfo($path);
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
    }
}