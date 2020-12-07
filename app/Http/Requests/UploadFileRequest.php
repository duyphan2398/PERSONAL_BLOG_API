<?php

namespace App\Http\Requests;

use App\Enums\FileTypeEnum;
use Illuminate\Foundation\Http\FormRequest;

class UploadFileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'type'      => 'required|in:IMAGE,VIDEO',
            'target'    => 'required|in:CATEGORY,POST'
        ];
    }

    public function withValidator($validator)
    {
        switch ($this->type) {
            case FileTypeEnum::IMAGE:
                $validator->addRules(['file' => 'required|file|image|mimes:jpg,jpeg,png|max:102400']);
                break;
            case FileTypeEnum::VIDEO:
                $validator->addRules(['file' => 'required|file|mimes:mp4,mov,m4v|max:1024000']);
        }
    }
}
