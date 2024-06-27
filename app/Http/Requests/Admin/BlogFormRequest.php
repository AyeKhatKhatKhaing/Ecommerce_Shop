<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use App\Helpers\AdminHelper;

class BlogFormRequest extends FormRequest
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
            'title_en'     => 'required',
            'title_hant'   => 'required',
            'title_hans'   => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title_en.required'    => __('backend.validation_message.title_en'),
            'title_hant.required'  => __('backend.validation_message.title_hant'),
            'title_hans.required'  => __('backend.validation_message.title_hans'),
        ];
    }

    public function withValidator($validator)
    {
        if (!is_null($this->blog_image) || !is_null($this->meta_image)) {
            $blog_image_path  = AdminHelper::storageFileExist($this->blog_image);
            $meta_image_path  = AdminHelper::storageFileExist($this->meta_image);

            $validator->after(function ($validator) use ($blog_image_path, $meta_image_path) {
                if (!$blog_image_path) {
                    $validator->errors()->add('blog_image', 'Invalid Blog Image Path.');
                }

                if (!$meta_image_path) {
                    $validator->errors()->add('meta_image', 'Invalid Meta Image Path.');
                }
            });

            $this->merge([
                'blog_image'  => $blog_image_path,
                'meta_image'  => $meta_image_path,
            ]);
        }
    }
}
