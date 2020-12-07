<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePostRequest extends FormRequest
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
            'category'           => 'required|array',
            'category.*.id'      => 'required|string|exists:category,id',
            'title'              => 'required|string',
            'content'            => 'required|string',
            'file'               => 'nullable|file|image|mimes:jpg,jpeg,png|max:102400',
            'is_active'          => 'required|in:0,1'
        ];
    }
}
