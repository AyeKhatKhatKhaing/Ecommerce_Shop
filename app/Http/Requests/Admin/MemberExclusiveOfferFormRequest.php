<?php

namespace App\Http\Requests\Admin;

use App\Helpers\AdminHelper;
use Illuminate\Foundation\Http\FormRequest;

class MemberExclusiveOfferFormRequest extends FormRequest
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
            'tier_benefit_en'   => 'required',
            'tier_benefit_hant' => 'required',
            'tier_benefit_hans' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'tier_benefit_en.required'           => __('backend.validation_message.tier_benefit_en'),
            'tier_benefit_hant.required'         => __('backend.validation_message.tier_benefit_hant'),
            'tier_benefit_hans.required'         => __('backend.validation_message.tier_benefit_hans'),
        ];
    }

    public function withValidator($validator)
    {
        if (!is_null($this->banner_image) || !is_null($this->meta_image)) {
            $banner_image_path = AdminHelper::storageFileExist($this->banner_image);
            $meta_image_path   = AdminHelper::storageFileExist($this->meta_image);

            $validator->after(function ($validator) use ($banner_image_path, $meta_image_path) {
                if (!$banner_image_path) {
                    $validator->errors()->add('banner_image', 'Invalid Blog Image Path.');
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
