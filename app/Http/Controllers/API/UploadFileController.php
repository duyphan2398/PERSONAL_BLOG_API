<?php

namespace App\Http\Controllers\API;

use App\Actions\UploadFileAction;
use App\Http\Requests\UploadFileRequest;
use App\Models\File;
use App\Transformers\FileTransformer;
use Flugg\Responder\Serializers\NoopSerializer;
use Illuminate\Support\Arr;

class UploadFileController extends ApiController
{
    public function __invoke(UploadFileRequest $request, UploadFileAction $action)
    {
        $data = $request->all();
        try {
            if ($path = $action->execute($request->all())) {
                $uploadFile =  pathinfo($path);
                $file = File::query()->create([
                    'path'        => $path,
                    'name'        => $data['file']->getClientOriginalName(),
                    'upload_name' => $uploadFile['basename'],
                    'type'        => $data['type'],
                    'target'      => $data['target'],
                    'size'        => $request->file('file')->getSize(),
                    'extension'   => $uploadFile['extension'],
                    'mime_type'   => $data['file']->getClientMimeType()
                ]);

                return $this->httpCreated($file, FileTransformer::class);
            }

            return $this->httpBadRequest();

        } catch (\Exception $e) {
            return $this->httpBadRequest([
                'error' => $e->getMessage(),
            ]);
        }
    }
}