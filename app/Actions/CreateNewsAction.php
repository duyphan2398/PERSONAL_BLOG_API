<?php

namespace App\Actions;

use App\Models\News;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;

class CreateNewsAction implements BaseAction
{
    private $awsS3Service;

    public function __construct(AwsS3Service $awsS3Service)
    {
        $this->awsS3Service = $awsS3Service;
    }

    public function execute(array $data)
    {
        $path = 'news/'.auth()->user()->id;
        /** @var UploadedFile $bannerFile */

        $news = new News();
        $news->fill(Arr::except($data, 'thumbnail'));
        $news->thumbnail = $this->awsS3Service->uploadImage($data, $path, 'thumbnail');
        $news->save();

        return $news;
    }
}