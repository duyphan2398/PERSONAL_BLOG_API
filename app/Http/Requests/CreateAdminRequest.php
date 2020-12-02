<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateAdminRequest extends FormRequest
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
            'role_id'               => 'required|int|exists:roles,id',
            'name'                  => 'required|string|max:100',
            'login_id'              => [
                Rule::unique('admins')->where(function ($query) {
                    return $query->where('deleted_at', 0);
                }),
                'required',
                'string',
                'min:4',
                'max:100',
                'regex:/^[a-zA-Z0-9.]+$/',
            ],
            'password'              => [
                'required',
                'string',
                'confirmed',
                'min:6',
                'max:100',
                "regex:/^[a-zA-Z0-9!@#$%^&*()_+\-=\[\]{};'`:\"\\|,.<>\/?]+$/",
            ],
            'password_confirmation' => 'required|string',
            'is_active'             => 'required|boolean',
        ];
    }
}
