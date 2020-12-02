<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdminRequest extends FormRequest
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
            'name'                  => 'sometimes|string|max:100',
            'password'              => [
                'nullable',
                'required_unless:password,',
                'string',
                'confirmed',
                'min:6',
                'max:100',
                "regex:/^[a-zA-Z0-9!@#$%^&*()_+\-=\[\]{};'`:\"\\|,.<>\/?]+$/",
            ],
            'password_confirmation' => 'nullable|string',
            'is_active'             => 'sometimes|boolean',
        ];
    }
}
