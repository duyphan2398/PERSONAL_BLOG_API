<?php

namespace App\Http\Requests;

use App\Rules\CheckCategoriesExistRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
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
            'title'              => 'required|string|max:100',
            'content'            => 'required|string|max:255',
            'file'               => 'nullable|file|image|mimes:jpg,jpeg,png|max:102400',
            'color'             =>  'required|string'
        ];
    }
}
