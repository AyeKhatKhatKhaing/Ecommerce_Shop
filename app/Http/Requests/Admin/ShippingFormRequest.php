<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ShippingFormRequest extends FormRequest
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

            'country_type' => 'required',
            'amount'       => 'required|numeric',

        ];
    }

    public function messages()
    {
        return [
            'country_type.required' => __('backend.validation_message.country_type'),
            'amount.required'       => __('backend.validation_message.amount'),

        ];
    }
}
