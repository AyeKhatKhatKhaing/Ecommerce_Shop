<?php

namespace App\Http\Requests\Admin;

use App\Helpers\AdminHelper;
use Illuminate\Foundation\Http\FormRequest;

class HomeFormRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'feature_name_en'            => 'required',
            'feature_name_hant'          => 'required',
            'feature_name_hans'          => 'required',
            'feature_title_en'           => 'required',
            'feature_title_hant'         => 'required',
            'feature_title_hans'         => 'required',
            'feature_description_en'     => 'required',
            'feature_description_hant'   => 'required',
            'feature_description_hans'   => 'required',
            'penfold_name_en'            => 'required',
            'penfold_name_hant'          => 'required',
            'penfold_name_hans'          => 'required',
            'penfold_title_en'           => 'required',
            'penfold_title_hant'         => 'required',
            'penfold_title_hans'         => 'required',
            'penfold_description_en'     => 'required',
            'penfold_description_hant'   => 'required',
            'penfold_description_hans'   => 'required',
            'exclusive_title_en'         => 'required',
            'exclusive_title_hant'       => 'required',
            'exclusive_title_hans'       => 'required',
            'exclusive_description_en'   => 'required',
            'exclusive_description_hant' => 'required',
            'exclusive_description_hans' => 'required',
            'about_title_en'             => 'required',
            'about_title_hant'           => 'required',
            'about_title_hans'           => 'required',
            'about_description_en'       => 'required',
            'about_description_hant'     => 'required',
            'about_description_hans'     => 'required',
            'store_title_en'             => 'required',
            'store_title_hant'           => 'required',
            'store_title_hans'           => 'required',
            'store_description_en'       => 'required',
            'store_description_hant'     => 'required',
            'store_description_hans'     => 'required',

        ];
    }

    public function withValidator($validator)
    {

        if (!is_null($this->feature_image) || !is_null($this->penfold_image) || !is_null($this->exclusive_image) || !is_null($this->about_image) || !is_null($this->store_image) || !is_null($this->meta_image)) {
            $feature_image_path   = AdminHelper::storageFileExist($this->feature_image);
            $penfold_image_path   = AdminHelper::storageFileExist($this->penfold_image);
            $exclusive_image_path = AdminHelper::storageFileExist($this->exclusive_image);
            $about_image_path     = AdminHelper::storageFileExist($this->about_image);
            $store_image_path     = AdminHelper::storageFileExist($this->store_image);
            $meta_image_path      = AdminHelper::storageFileExist($this->meta_image);

            $validator->after(function ($validator) use ($feature_image_path, $penfold_image_path, $exclusive_image_path, $about_image_path, $store_image_path, $meta_image_path) {

                if (!$feature_image_path) {
                    $validator->errors()->add('feature_image', 'Invalid RemflyFeatured Image Path.');
                }
                if (!$penfold_image_path) {
                    $validator->errors()->add('penfold_image', 'Invalid Penfold Max Image Path.');
                }
                if (!$exclusive_image_path) {
                    $validator->errors()->add('exclusive_image', 'Invalid Member Exclusive Offers Image Path.');
                }
                if (!$about_image_path) {
                    $validator->errors()->add('about_image', 'Invalid About Remfly Image Path.');
                }
                if (!$store_image_path) {
                    $validator->errors()->add('store_image', 'Invalid Store Distribution Image Path.');
                }
                if (!$meta_image_path) {
                    $validator->errors()->add('meta_image', 'Invalid Meta Image Path.');
                }

            });

            $this->merge([
                'feature_image'   => $feature_image_path,
                'penfold_image'   => $penfold_image_path,
                'exclusive_image' => $exclusive_image_path,
                'about_image'     => $about_image_path,
                'store_image'     => $store_image_path,
                'meta_image'      => $meta_image_path,
            ]);
        }
    }

    public function messages()
    {
        return [

            'feature_name_en.required'            => __('backend.validation_message.feature_name_en'),
            'feature_name_hant.required'          => __('backend.validation_message.feature_name_hant'),
            'feature_name_hans.required'          => __('backend.validation_message.feature_name_hans'),
            'feature_title_en.required'           => __('backend.validation_message.feature_title_en'),
            'feature_title_hant.required'         => __('backend.validation_message.feature_title_hant'),
            'feature_title_hans.required'         => __('backend.validation_message.feature_title_hans'),
            'feature_description_en.required'     => __('backend.validation_message.feature_description_en'),
            'feature_description_hant.required'   => __('backend.validation_message.feature_description_hant'),
            'feature_description_hans.required'   => __('backend.validation_message.feature_description_hans'),
            'penfold_name_en.required'            => __('backend.validation_message.penfold_name_en'),
            'penfold_name_hant.required'          => __('backend.validation_message.penfold_name_hant'),
            'penfold_name_hans.required'          => __('backend.validation_message.penfold_name_hans'),
            'penfold_title_en.required'           => __('backend.validation_message.penfold_title_en'),
            'penfold_title_hant.required'         => __('backend.validation_message.penfold_title_hant'),
            'penfold_title_hans.required'         => __('backend.validation_message.penfold_title_hans'),
            'penfold_description_en.required'     => __('backend.validation_message.penfold_description_en'),
            'penfold_description_hant.required'   => __('backend.validation_message.penfold_description_hant'),
            'penfold_description_hans.required'   => __('backend.validation_message.penfold_description_hans'),
            'exclusive_title_en.required'         => __('backend.validation_message.exclusive_title_en'),
            'exclusive_title_hant.required'       => __('backend.validation_message.exclusive_title_hant'),
            'exclusive_title_hans.required'       => __('backend.validation_message.exclusive_title_hans'),
            'exclusive_description_en.required'   => __('backend.validation_message.exclusive_description_en'),
            'exclusive_description_hant.required' => __('backend.validation_message.exclusive_description_hant'),
            'exclusive_description_hans.required' => __('backend.validation_message.exclusive_description_hans'),
            'about_title_en.required'             => __('backend.validation_message.about_title_en'),
            'about_title_hant.required'           => __('backend.validation_message.about_title_hant'),
            'about_title_hans.required'           => __('backend.validation_message.about_title_hans'),
            'about_description_en.required'       => __('backend.validation_message.about_description_en'),
            'about_description_hant.required'     => __('backend.validation_message.about_description_hant'),
            'about_description_hans.required'     => __('backend.validation_message.about_description_hans'),
            'store_title_en.required'             => __('backend.validation_message.store_title_en'),
            'store_title_hant.required'           => __('backend.validation_message.store_title_hant'),
            'store_title_hans.required'           => __('backend.validation_message.store_title_hans'),
            'store_description_en.required'       => __('backend.validation_message.store_description_en'),
            'store_description_hant.required'     => __('backend.validation_message.store_description_hant'),
            'store_description_hans.required'     => __('backend.validation_message.store_description_hans'),
        ];
    }

}
