<?php

namespace App\Http\Requests\Admin;

use App\Helpers\AdminHelper;
use Illuminate\Foundation\Http\FormRequest;

class OtherProductFormRequest extends FormRequest
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
        $code  = ($this->getMethod() == "POST") ? 'required|unique:products,code' : '';

        return [
            'name_en'       => 'required',
            'name_hant'     => 'required',
            'name_hans'     => 'required',
            'feature_image' => 'required',
            // 'code'          => "required|min:1|max:255|unique:products,code," . $this->product . ",id",
            'code'          => $code,
        ];
    }

    public function messages()
    {
        return [
            'name_en.required'       => __('backend.validation_message.name_en'),
            'name_hans.required'     => __('backend.validation_message.name_hans'),
            'name_hant.required'     => __('backend.validation_message.name_hant'),
            'feature_image.required' => __('backend.validation_message.feature_image'),
            'code.required'          => __('backend.validation_message.code'),
            'code.unique'            => __('backend.validation_message.product_code'),
        ];
    }

    public function withValidator($validator)
    {

        if (!is_null($this->feature_image)) {
            $feature_image_path = AdminHelper::storageFileExist($this->feature_image);

            $validator->after(function ($validator) use ($feature_image_path) {

                if (!$feature_image_path) {
                    $validator->errors()->add('feature_image', 'Invalid Feature Image Path.');
                }

            });

            $this->merge([
                'feature_image' => $feature_image_path,
            ]);
        }
    }
}
