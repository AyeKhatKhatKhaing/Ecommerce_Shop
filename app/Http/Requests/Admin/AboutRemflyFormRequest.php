<?php

namespace App\Http\Requests\Admin;

use App\Helpers\AdminHelper;
use Illuminate\Foundation\Http\FormRequest;

class AboutRemflyFormRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'banner_title_en'       => 'required',
            'banner_title_hant'     => 'required',
            'banner_title_hans'     => 'required',
            'banner_image'          => 'required',
            'description_en'        => 'required',
            'description_hant'      => 'required',
            'description_hans'      => 'required',
            'key_operation_en'      => 'required',
            'key_operation_hant'    => 'required',
            'key_operation_hans'    => 'required',
        ];
    }

    public function messages()
    {
        return [
            'banner_title_en.required'    => __('backend.validation_message.banner_title_en'),
            'banner_title_hant.required'  => __('backend.validation_message.banner_title_hant'),
            'banner_title_hans.required'  => __('backend.validation_message.banner_title_hans'),
            'banner_image.required'       => __('backend.validation_message.banner_image'),
            'description_en.required'     => __('backend.validation_message.description_en'),
            'description_hant.required'   => __('backend.validation_message.description_hant'),
            'description_hans.required'   => __('backend.validation_message.description_hans'),
            'key_operation_en.required'   => __('backend.validation_message.key_operation_en'),
            'key_operation_hant.required' => __('backend.validation_message.key_operation_hant'),
            'key_operation_hans.required' => __('backend.validation_message.key_operation_hans'),
        ];
    }

    public function withValidator($validator)
    {

        if (!is_null($this->banner_image) || !is_null($this->meta_image)) {
            $banner_image_path = AdminHelper::storageFileExist($this->banner_image);
            $meta_image_path   = AdminHelper::storageFileExist($this->meta_image);

            $validator->after(function ($validator) use ($banner_image_path, $meta_image_path) {

                if (!$banner_image_path) {
                    $validator->errors()->add('banner_image', 'Invalid Banner Image Path.');
                }
                if (!$meta_image_path) {
                    $validator->errors()->add('meta_image', 'Invalid Meta Image Path.');
                }

            });

            $this->merge([
                'banner_image' => $banner_image_path,
                'meta_image'   => $meta_image_path,
            ]);
        }
    }

}
