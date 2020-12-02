<?php

namespace App\Exceptions;

class UploadFileException extends \Exception
{
    public static function handle(string $filename) {
        return new static("Can't upload file {$filename}. Please try again!");
    }
}