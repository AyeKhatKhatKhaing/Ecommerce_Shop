<?php

namespace App\Http\Requests\Admin;

use App\Helpers\AdminHelper;
use Illuminate\Foundation\Http\FormRequest;

class SubscribeNotificationFormRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title_en'              => 'required',
            'title_hant'            => 'required',
            'title_hans'            => 'required',
            'description_en'        => 'required',
            'description_hant'      => 'required',
            'description_hans'      => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title_en.required'           => __('backend.validation_message.title_en'),
            'title_hant.required'         => __('backend.validation_message.title_hant'),
            'title_hans.required'         => __('backend.validation_message.title_hans'),
            'description_en.required'     => __('backend.validation_message.description_en'),
            'description_hant.required'   => __('backend.validation_message.description_hant'),
            'description_hans.required'   => __('backend.validation_message.description_hans'),
        ];
    }

}
