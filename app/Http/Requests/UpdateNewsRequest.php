<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNewsRequest extends FormRequest
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
            'category_id'            => 'nullable|string|exists:categories,id',
            'movie_id'               => 'nullable|string|exists:movies,id',
            'title'                  => 'required|string',
            'display_type'           => 'string',
            'publish_start_datetime' => 'required|date_format:"Y-m-d H:i"',
            'publish_end_datetime'   => 'required|date_format:"Y-m-d H:i"',
            'text'                   => 'nullable|string',
            'thumbnail'              => 'nullable',
            'url'                    => 'nullable|url',
            'is_active'              => 'required|boolean',
            'is_pushed'              => 'boolean',
            'is_preview'             => 'boolean',
        ];
    }
}
