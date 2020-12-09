<?php

namespace App\Models;

use App\Builders\FileBuilder;
use App\Traits\OverridesBuilder;

class File extends BaseModel
{
    use OverridesBuilder;

    public function provideCustomBuilder()
    {
        return FileBuilder::class;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'is_using',
        'path',
        'name',
        'upload_name',
        'type',
        'target',
        'size',
        'extension',
        'mime_type',
        'created_at',
        'updated_at'
    ];

    public function getPathAttribute($value){
        return  config('app.url').'/resource/asset/'.$value;
    }
    public $timestamps = true;
}
