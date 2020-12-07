<?php

namespace App\Transformers;

use App\Models\File;
use Flugg\Responder\Transformers\Transformer;
use Illuminate\Http\Request;

class FileTransformer extends Transformer
{

    /**
     * List of auto loaded default relations.
     *
     * @var array
     */
    protected $load = [];

    /**
     * @param \App\Models\News $news
     * @return array
     */
    public function transform(File $file)
    {
        return [
            'id'                        => (string)     $file->id,
            'is_using'                  => (bool)       $file->is_using,
            'path'                      => (string)     $file->path,
            'name'                      => (string)     $file->name,
            'upload_name'               => (string)     $file->upload_name,
            'type'                      => (string)     $file->type,
            'target'                    => (string)     $file->target,
            'size'                      => (int)        $file->size,
            'extension'                 => (string)     $file->extension,
            'mime_type'                 => (string)     $file->mime_type
        ];
    }
}
