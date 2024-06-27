<?php

namespace App\Http\Requests\Admin;

use App\Helpers\AdminHelper;
use Illuminate\Foundation\Http\FormRequest;

class ProductFormRequest extends FormRequest
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
            'name_en'            => 'required',
            'quantity'           => 'required',
            'original_price'     => 'required',
            'sell_quantity'      => 'required',
            'feature_image'      => 'required',
            'content_en'         => 'required',
            'content_hant'       => 'required',
            'content_hans'       => 'required',
            'code'               => 'required',
            'code'               => "required|min:1|max:255|unique:products,code," . $this->product . ",id",
            // 'min_stock_quantity' => 'required',
            'capacity'           => 'required',

        ];
    }

    public function messages()
    {
        return [
            'name_en.required'            => __('backend.validation_message.name_en'),
            'original_price.required'     => __('backend.validation_message.original_price'),
            'sale_price.required'         => __('backend.validation_message.sale_price'),
            'quantity.required'           => __('backend.validation_message.quantity'),
            'sell_quantity.required'      => __('backend.validation_message.sell_quantity'),
            'feature_image.required'      => __('backend.validation_message.feature_image'),
            'content_en.required'         => __('backend.validation_message.content_en'),
            'content_hant.required'       => __('backend.validation_message.content_hant'),
            'content_hans.required'       => __('backend.validation_message.content_hans'),
            'code.required'               => __('backend.validation_message.code'),
            'code.unique'                 => __('backend.validation_message.product_code'),
            // 'min_stock_quantity.required' => __('backend.validation_message.min_stock_quantity'),
            'capacity.required'           => __('backend.validation_message.capacity'),

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
