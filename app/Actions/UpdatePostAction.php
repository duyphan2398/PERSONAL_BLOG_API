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
        $transformData = Arr::except($data, ['file', 'categories', 'slug', 'custom_slug']);

        if ($data['custom_slug']){
            $tmpSlug = str_replace('.', '',str_replace('/', '',Arr::get($data, 'slug')));
            $slug = Str::random(3).'-'.join('+',explode(' ', $tmpSlug));
            $transformData['slug'] = $slug;
        }

        $post->update($transformData);
        // update category
        $post->postCategories()->delete();
        foreach (json_decode($data['categories']) as $categoryId){
            $post->postCategories()->create(['category_id' => $categoryId]);
        }

        // update thumbnail
        if ($post->file && Arr::get($data, 'file')){
            $post->file()->delete();
            $post->update(['thumbnail' => null]);
            Storage::disk('public')->deleteDirectory('POST/THUMBNAIL/'.$post->id);
        }

        if (Arr::get($data, 'file')) {
            $destinationPath = 'POST/THUMBNAIL/'.$post->id.'/'.Carbon::today()->format('d-m-y');
            $profileImage = Str::random(20).'_'.Carbon::now()->format('d-m-y-h-i').'.'.$data['file']->getClientOriginalExtension();
            try {
                $path = $data['file']->storeAs($destinationPath, $profileImage, 'public');
                if ($path) {
                    $uploadFile = pathinfo($path);
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
                    $base64 = 'data:image/'.$uploadFile['extension'].';base64,'.base64_encode(file_get_contents(request()->file('file')->path()));
                    $post->update(['thumbnail' =>  $base64]);
            }
            } catch (\Exception $exception) {
                // Upload file failed
            }
        }
    }
}