<?php

namespace App\Actions;

use Carbon\Carbon;
use Illuminate\Support\Str;

class UploadFileAction
{

    public function __construct()
    {
    }

    public function execute($data)
    {
        $destinationPath = $data['target'].'/'.Carbon::today()->format('d-m-y');
        $profileImage = Str::random(20).'_'.Carbon::now()->format('d-m-y-h-i').'.'.$data['file']->getClientOriginalExtension();
        $path = $data['file']->storeAs($destinationPath, $profileImage, 'public');
        return $path ? 'resource/asset/'.$path : null;
    }
}