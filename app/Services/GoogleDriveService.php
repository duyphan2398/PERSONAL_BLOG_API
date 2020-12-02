<?php

namespace App\Services;

use App\Exceptions\UploadFileException;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;

class GoogleDriveService
{
    /**
     * @param $filename
     * @return string
     */
    public function getURlAccessImage($filename)
    {
        if (is_null($filename) || empty($filename)) {
            return "";
        }
        $client = Storage::disk('s3')->getDriver()->getAdapter()->getClient();
        $bucket = Config::get('filesystems.disks.s3.bucket');
        $command = $client->getCommand('GetObject', [
            'Bucket' => $bucket,
            'Key'    => $filename,
        ]);
        $request = $client->createPresignedRequest($command, '+5 minutes');

        return (string) $request->getUri();
    }

    /**
     * @param $data
     * @param $path
     * @param $image
     * @return mixed
     * @throws \App\Exceptions\UploadFileException
     */
    public function uploadImage($data, $path, $image)
    {
        $thumbnailFile = Arr::get($data, $image);
        $fileName = sprintf('%s_%s', now()->timestamp, $thumbnailFile->getClientOriginalName());
        $storageFilePath = Storage::disk('s3')->putFileAs($path, $thumbnailFile->getPathname(), $fileName);
        if (! $storageFilePath) {
            throw UploadFileException::handle($fileName);
        }

        return $storageFilePath;
    }
}