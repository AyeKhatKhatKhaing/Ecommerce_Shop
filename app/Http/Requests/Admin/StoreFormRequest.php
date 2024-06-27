<?php

namespace App\Http\Requests\Admin;

use App\Helpers\AdminHelper;
use Illuminate\Foundation\Http\FormRequest;

class StoreFormRequest extends FormRequest
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
            'name_en'        => 'required',
            'name_hant'      => 'required',
            'name_hans'      => 'required',
            'addresses_en'   => 'required',
            'addresses_hant' => 'required',
            'addresses_hans' => 'required',
            'email'          => 'required',
            'phone'          => 'required',
            'store_image'    => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name_en.required'        => __('backend.validation_message.name_en'),
            'name_hant.required'      => __('backend.validation_message.name_hant'),
            'name_hans.required'      => __('backend.validation_message.name_hans'),
            'addresses_en.required'   => __('backend.validation_message.addresses_en'),
            'addresses_hant.required' => __('backend.validation_message.addresses_hant'),
            'addresses_hans.required' => __('backend.validation_message.addresses_hans'),
            'phone.required'          => __('backend.validation_message.phone'),
            'email.required'          => __('backend.validation_message.email'),
            'store_image.required'    => __('backend.validation_message.store_image'),
        ];
    }
    public function withValidator($validator)
    {

        if (!is_null($this->store_image)) {
            $store_image_path = AdminHelper::storageFileExist($this->store_image);

            $validator->after(function ($validator) use ($store_image_path) {
                if (!$store_image_path) {
                    $validator->errors()->add('store_image', 'Invalid Store Image Path.');
                }
            });

            $this->merge([
                'store_image' => $store_image_path,
            ]);
        }
    }
}
