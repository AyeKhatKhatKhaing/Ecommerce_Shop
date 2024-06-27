<?php

namespace App\Http\Requests\Admin;

use App\Helpers\AdminHelper;
use Illuminate\Foundation\Http\FormRequest;

class ExclusiveOfferFormRequest extends FormRequest
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
            'title_en'   => 'required',
            'title_hant' => 'required',
            'title_hans' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title_en.required'           => __('backend.validation_message.title_en'),
            'title_hant.required'         => __('backend.validation_message.title_hant'),
            'title_hans.required'         => __('backend.validation_message.title_hans'),
        ];
    }

    public function withValidator($validator)
    {
        if (!is_null($this->image)) {
            $image_path = AdminHelper::storageFileExist($this->image);

            $validator->after(function ($validator) use ($image_path) {
                if (!$image_path) {
                    $validator->errors()->add('image', 'Invalid Blog Image Path.');
                }

            });

            $this->merge([
                'image' => $image_path,
            ]);
        }
    }
}
