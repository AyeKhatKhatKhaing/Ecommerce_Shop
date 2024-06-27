<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'password'          => 'required|min:6|confirmed',
            // 'confirm_password' => 'string|min:6|required_with:password|same:password',
        ];
    }

    public function messages()
    {
        return [
            'password.required'          => 'Password Field is required.',
            'password.min'               => 'Password must be at least 6 characters.',
            'password.confirmed'         => 'Password and password confirmation must be same.',
        ];
    }
}
