<?php

namespace App\Actions;


use App\Models\Category;
use App\Models\File;
use Illuminate\Support\Arr;

class UpdateCategoryAction
{
    public function execute(array $data, Category $category)
    {
        $category->update(Arr::except($data, ['file']));

        // update thumbnail
        if ($category->file && Arr::get($data, 'file')) {
            $category->file()->delete();
            $category->update(['thumbnail' => null]);
        }

        if (Arr::get($data, 'file')) {
            try {
                $uploadFile = pathinfo($data['file']->path());
                $thumbnail = File::query()->create([
                    'path'        => $data['file']->path(),
                    'name'        => $data['file']->getClientOriginalName(),
                    'upload_name' => $uploadFile['basename'],
                    'type'        => 'IMAGE',
                    'target'      => 'CATEGORIES',
                    'size'        => request()->file('file')->getSize(),
                    'extension'   => $uploadFile['extension'],
                    'mime_type'   => $data['file']->getClientMimeType(),
                ]);

                $category->update(['file_id' => $thumbnail->id]);
                $base64 = 'data:image/'.$data['file']->getClientOriginalExtension().';base64,'.base64_encode(file_get_contents(request()
                        ->file('file')
                        ->path()));
                $category->update(['thumbnail' => $base64]);
            } catch (\Exception $exception) {
                // Upload file failed
            }
        }
    }
}