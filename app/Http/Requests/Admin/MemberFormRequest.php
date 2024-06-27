<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class MemberFormRequest extends FormRequest
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
            'first_name'     => 'required',
            'last_name'      => 'required',
            'account_type'   => 'required',
            'country_id'     => 'required',
            'email'          => 'required_without:phone',
            'phone'          => 'required_without:email',
            'password'       => $password,
            'member_type_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'first_name.required'     => __('backend.validation_message.first_name'),
            'last_name.required'      => __('backend.validation_message.last_name'),
            'account_type.required'   => __('backend.validation_message.account_type'),
            'country_id.required'     => __('backend.validation_message.select_country'),
            'phone.required'          => __('backend.validation_message.phone'),
            'email.required'          => __('backend.validation_message.email'),
            // 'email.unique'            => 'Your email address is already taken.',
            'password'                => __('backend.validation_message.password'),
            'password.min'            => __('backend.validation_message.password_min'),
            'member_type_id.required' => __('backend.validation_message.member_type_id'),
        ];
    }
}
