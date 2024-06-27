<?php

namespace App\Http\Requests\Admin;

use App\Helpers\AdminHelper;
use Illuminate\Foundation\Http\FormRequest;

class PageFormRequest extends FormRequest
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

    public function withValidator($validator)
    {

        if (!is_null($this->image) || !is_null($this->meta_image)) {
            $image_path      = AdminHelper::storageFileExist($this->image);
            $meta_image_path = AdminHelper::storageFileExist($this->meta_image);

            $validator->after(function ($validator) use ($image_path, $meta_image_path) {

                if (!$image_path) {
                    $validator->errors()->add('image', 'Invalid Banner Image Path.');
                }
                if (!$meta_image_path) {
                    $validator->errors()->add('meta_image', 'Invalid Meta Image Path.');
                }

            });

            $this->merge([
                'image'      => $image_path,
                'meta_image' => $meta_image_path,
            ]);
        }
    }

}
