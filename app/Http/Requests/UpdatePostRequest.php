<?php

namespace App\Http\Requests;

use App\Rules\CheckCategoriesExistRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
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
            'categories'         =>  ['required',new CheckCategoriesExistRule()],
            'title'              => 'required|string|max:100000',
            'short_title'        => 'required|string|max:200',
            'content'            => 'required|string',
            'short_content'      => 'required|string|max:500',
            'file'               => 'nullable|file|image|mimes:jpg,jpeg,png|max:102400',
            'is_active'          => 'required|in:0,1'
        ];
    }
}
