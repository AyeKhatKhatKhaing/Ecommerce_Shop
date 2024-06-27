<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class RegionRequest extends FormRequest
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
            'country_id' => 'required',
            'name_en'    => 'required',
            'name_hant'  => 'required',
            'name_hans'  => 'required',
        ];
    }

    public function messages()
    {
        return [

            'country_id.required' => __('backend.validation_message.selectcountry'),
            'name_en.required'    => __('backend.validation_message.name_en'),
            'name_hant.required'  => __('backend.validation_message.name_hant'),
            'name_hans.required'  => __('backend.validation_message.name_hans'),

        ];
    }
}
