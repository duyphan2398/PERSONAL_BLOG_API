<?php

namespace App\Actions;


use App\Models\Category;
use App\Models\File;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UpdateCategoryAction
{

    public function execute(array $data, Category $category)
    {
        $category->update(Arr::except($data, ['file']));

        // update thumbnail
        if ($category->file && Arr::get($data, 'file')){
            $category->file()->delete();
            Storage::disk('public')->deleteDirectory('CATEGORY/THUMBNAIL/'.$category->id);
        }

        if (Arr::get($data, 'file')) {
            $destinationPath = 'CATEGORY/THUMBNAIL/'.$category->id.'/'.Carbon::today()->format('d-m-y');
            $profileImage = Str::random(20).'_'.Carbon::now()->format('d-m-y-h-i').'.'.$data['file']->getClientOriginalExtension();
            $path = $data['file']->storeAs($destinationPath, $profileImage, 'public');
            if ($path) {
                $uploadFile = pathinfo($path);
                $thumbnail = File::query()->create([
                    'path'        => $path,
                    'name'        => $data['file']->getClientOriginalName(),
                    'upload_name' => $uploadFile['basename'],
                    'type'        => 'IMAGE',
                    'target'      => 'CATEGORIES',
                    'size'        => request()->file('file')->getSize(),
                    'extension'   => $uploadFile['extension'],
                    'mime_type'   => $data['file']->getClientMimeType()
                ]);

                $category->update(['file_id' => $thumbnail->id]);
            }
        }
    }
}