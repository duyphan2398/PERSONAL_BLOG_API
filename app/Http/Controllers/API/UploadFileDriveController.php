<?php

namespace App\Http\Controllers\API;

use App\Actions\UploadFileAction;
use Flugg\Responder\Serializers\NoopSerializer;
use Illuminate\Http\Request;

class UploadFileDriveController extends ApiController
{
    public function __invoke(Request $request, UploadFileAction $action)
    {
        return $this->setSerializer(NoopSerializer::class)
                    ->httpOK($action->execute($request->all()));
    }
}
