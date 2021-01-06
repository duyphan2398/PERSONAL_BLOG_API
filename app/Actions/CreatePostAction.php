<?php

namespace App\Actions;

use App\Models\File;
use App\Models\Post;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class CreatePostAction
{
    public function execute(array $data)
    {
        $transformData = Arr::except($data, ['file', 'categories', 'slug', 'custom_slug']);

        if ($data['custom_slug']) {
            $tmpSlug = str_replace('.', '', str_replace('/', '', Arr::get($data, 'slug')));
            $slug = Str::random(3).'-'.join('+', explode(' ', $tmpSlug));
        } else {
            $tmpSlug = str_replace('.', '', str_replace('/', '', Arr::get($data, 'short_title')));
            $slug = Str::random(3).'-'.join('+', explode(' ', $tmpSlug));
        }
        $transformData['slug'] = $slug;

        $post = Post::query()->create($transformData);

        // save category
        foreach (json_decode($data['categories']) as $categoryId) {
            $post->postCategories()->create(['category_id' => $categoryId]);
        }

        // save thumbnail
        if (Arr::get($data, 'file')) {
            try {
                $uploadFile = pathinfo($data['file']->path());
                $thumbnail = File::query()->create([
                    'path'        => $data['file']->path(),
                    'name'        => $data['file']->getClientOriginalName(),
                    'upload_name' => $uploadFile['basename'],
                    'type'        => 'IMAGE',
                    'target'      => 'POST',
                    'size'        => request()->file('file')->getSize(),
                    'extension'   => $data['file']->getClientOriginalExtension(),
                    'mime_type'   => $data['file']->getClientMimeType(),
                ]);

                $post->update(['file_id' => $thumbnail->id]);

                $base64 = 'data:image/'.$data['file']->getClientOriginalExtension().';base64,'.base64_encode(file_get_contents(request()
                        ->file('file')
                        ->path()));
                $post->update(['thumbnail' => $base64]);
            } catch (\Exception $exception) {
                // Upload file failed
            }
        }

        return $post;
    }
}