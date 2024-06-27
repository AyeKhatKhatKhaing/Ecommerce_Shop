<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class ChangeMemberPasswordRequest extends FormRequest
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
            'current_password' => 'required',
            'new_password'     => 'required|min:6',
        ];
    }

    public function messages()
    {
        return [
            'current_password.required' => 'Password Field is required.',
            'new_password.required'     => 'New Password Field is required.',
            'new_password.min:6'        => 'New Password must be at least 6 characters.',
            'new_password.confirmed'    => 'Password confirmation does not match',
        ];
    }
}
