<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMemberInfoRequest extends FormRequest
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
            'first_name'  => 'required|string',
            'last_name'   => 'required|string',
            'email'       => 'required|email',
            'country_id'  => 'required',
            'phone'       => 'required',
            'city'        => 'required|string',
            'state'       => 'required|string',
            'address'     => 'required|string',
            'postal_code' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'first_name.required'   => 'Name Field is required.',
            'last_name.required'    => 'Surname Field is required.',
            'email.required'        => 'Email Field is required.',
            'email.unique'          => 'Email Field must be unique.',
            'email.email'           => 'Email Field must be email type.',
            'phone.required'        => 'Phone Field is required.',
            'country_code.required' => 'Country Code Field is required.',
            'postal_code.required'  => 'Postal Code Field is required.',
            'address.required'      => 'Address Field is required.',
            'city.required'         => 'City Field is required.',
            'state.required'        => 'State Field is required.',
        ];
    }
}
