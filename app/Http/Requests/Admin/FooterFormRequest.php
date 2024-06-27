<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class FooterFormRequest extends FormRequest
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
            'web_content_en'      => 'required',
            'web_content_hant'    => 'required',
            'web_content_hans'    => 'required',
            'mobile_content_en'   => 'required',
            'mobile_content_hant' => 'required',
            'mobile_content_hans' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'web_content_en.required'      => __('backend.validation_message.web_content_en'),
            'web_content_hant.required'    => __('backend.validation_message.web_content_hant'),
            'web_content_hans.required'    => __('backend.validation_message.web_content_hans'),
            'mobile_content_en.required'   => __('backend.validation_message.mobile_content_en'),
            'mobile_content_hant.required' => __('backend.validation_message.mobile_content_hant'),
            'mobile_content_hans.required' => __('backend.validation_message.mobile_content_hans'),
        ];
    }
}
