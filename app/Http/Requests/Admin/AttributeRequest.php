<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AttributeRequest extends FormRequest
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
            'name_en'   => 'required',
            'name_hant' => 'required',
            'name_hans' => 'required',
            'values.*'  => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name_en.required'   => __('backend.validation_message.attribute_term_en'),
            'name_hant.required' => __('backend.validation_message.attribute_term_hant'),
            'name_hans.required' => __('backend.validation_message.attribute_term_hans'),
            'values.*.required'  => __('backend.validation_message.value'),
        ];
    }
}
