<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class MemberLoginRequest extends FormRequest
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
            'email'                => 'required_if:login_method,email',
            'phone'                => 'required_if:login_method,phone',
            'country_code'         => 'required_if:login_method,phone',
            'password'             => 'required',
            'login_method'         => 'required',
            'g-recaptcha-response' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'email.required_if'             => 'Email Field is required.',
            'phone.required_if'             => 'Phone Field is required.',
            'password.required'             => 'Password Field is required.',
            'country_code.required_if'      => 'Country Code Field is required.',
            'g-recaptcha-response.required' => 'Google Recaptcha Field is required',
        ];
    }
}
