<?php

namespace App\Actions;


use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;

class UpdateNewsAction implements BaseAction
{
    private $awsS3Service;

    public function __construct(AwsS3Service $awsS3Service)
    {
        $this->awsS3Service = $awsS3Service;
    }

    public function execute(array $data)
    {
        $path = 'news/'.auth()->user()->id;

        Route::current()->news->update(Arr::except($data, 'thumbnail'));
        if (isset($data['thumbnail'])) {
            Route::current()->news->thumbnail = $this->awsS3Service->uploadImage($data, $path, 'thumbnail');
            Route::current()->news->save();
        }
    }
}