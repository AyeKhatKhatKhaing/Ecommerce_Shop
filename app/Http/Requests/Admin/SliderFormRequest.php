<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use App\Helpers\AdminHelper;

class SliderFormRequest extends FormRequest
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
            //
        ];
    }

    public function withValidator($validator)
    {
        if (!is_null($this->banner_image) || !is_null($this->mb_banner_image) ) {
            $banner_image_path    = AdminHelper::storageFileExist($this->banner_image);
            $mb_banner_image_path = AdminHelper::storageFileExist($this->mb_banner_image);

            $validator->after(function ($validator) use ($banner_image_path, $mb_banner_image_path) {
                if (!$banner_image_path) {
                    $validator->errors()->add('banner_image', 'Invalid Banner Image Path.');
                }

                if (!$mb_banner_image_path) {
                    $validator->errors()->add('mb_banner_image', 'Invalid Mobile Banner Image Path.');
                }
            });

            $this->merge([
                'banner_image'    => $banner_image_path,
                'mb_banner_image' => $mb_banner_image_path,
            ]);
        }
    }
}
