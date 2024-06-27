<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserFormRequest extends FormRequest
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
        $password = ($this->getMethod() == "POST") ? 'required|min:6' : '';

        return [
            'name'     => 'required',
            'email'    => 'required|string|max:255|email|unique:users',
            'password' => $password,
            'roles'    => 'required',
        ];
    }

    public function messages()
    {
        return [

            'name.required'     => __('backend.validation_message.name'),
            'email.required'    => __('backend.validation_message.email'),
            'email.unique'      => __('backend.validation_message.email_unique'),
            'password.required' => __('backend.validation_message.password'),
            'roles.required'    => __('backend.validation_message.roles'),

        ];
    }
}
