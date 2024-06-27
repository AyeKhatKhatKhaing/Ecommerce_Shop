<?php

namespace App\Http\Requests\Admin;

use App\Helpers\AdminHelper;
use Illuminate\Foundation\Http\FormRequest;

class MenuFormRequest extends FormRequest
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
           
            'name_en'     => 'required',
            'name_hant'   => 'required',
            'name_hans'   => 'required',
        ];
    }

    public function messages()
    {
        return [
           
            'name_en.required'             => __('backend.validation_message.name_en'),
            'name_hant.required'           => __('backend.validation_message.name_hant'),
            'name_hans.required'           => __('backend.validation_message.name_hans'),

        ];
    }

    public function withValidator($validator)
    {
        if (!is_null($this->image)) {
            $image_path = AdminHelper::storageFileExist($this->image);

            $validator->after(function ($validator) use ($image_path) {
                if (!$image_path) {
                    $validator->errors()->add('image', 'Invalid Banner Image Path.');
                }
            });

            $this->merge([
                'image' => $image_path,
            ]);
        }
    }
}
