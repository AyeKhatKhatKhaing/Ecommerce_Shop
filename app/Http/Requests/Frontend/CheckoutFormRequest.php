<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CheckoutFormRequest extends FormRequest
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
            'billing_address'         => 'required_if:delivery_type,delivery',
            'billing_address_detail'  => 'required_if:delivery_type,delivery',
            'billing_first_name'      => 'required_if:delivery_type,delivery',
            'billing_last_name'       => 'required_if:delivery_type,delivery',
            // 'billing_phone'           => 'required_if:delivery_type,delivery',
            // 'billing_email'           => 'required_if:delivery_type,delivery',

            'billing_phone' => [Rule::requiredIf(function () {
                return $this->input('delivery_type') == 'delivery';
            }), !auth()->guard('member')->check() ? Rule::unique('members', 'phone')->where(function ($query) {
                if(!auth()->guard('member')->check()) {
                    return $query->where('phone', $this->input('billing_phone'))
                                 ->where('status', 1);
                }
            }) : ''],
            'billing_email' => ['email', Rule::requiredIf(function () {
                return $this->input('delivery_type') == 'delivery';
            }), !auth()->guard('member')->check() ? Rule::unique('members', 'email')->where(function ($query) {
                    return $query->where('email', $this->input('billing_email'))
                                ->where('status', 1);
            }) : ''],

            'shipping_address'        => 'required_if:is_shipping_address,shipping_address && required_if:delivery_type,delivery',
            'shipping_address_detail' => 'required_if:is_shipping_address,shipping_address && required_if:delivery_type,delivery',
            'shipping_first_name'     => 'required_if:is_shipping_address,shipping_address && required_if:delivery_type,delivery',
            'shipping_last_name'      => 'required_if:is_shipping_address,shipping_address && required_if:delivery_type,delivery',
            'shipping_phone'          => 'required_if:is_shipping_address,shipping_address && required_if:delivery_type,delivery',
            'shipping_email'          => 'required_if:is_shipping_address,shipping_address && required_if:delivery_type,delivery',
            'pick_address'            => 'required_if:delivery_type,store_pick_up',
            'pick_address_detail'     => 'required_if:delivery_type,store_pick_up',
            'pick_first_name'         => 'required_if:delivery_type,store_pick_up',
            'pick_last_name'          => 'required_if:delivery_type,store_pick_up',
            'pick_phone'              => 'required_if:delivery_type,store_pick_up',
            'pick_email'              => 'required_if:delivery_type,store_pick_up',
        ];
    }

    public function messages()
    {
        return [
            'billing_address.required_if'         => __('frontend.validation_message.billing_address_required'),
            'billing_address_detail.required_if'  => __('frontend.validation_message.billing_address_detail_required'),
            'billing_first_name.required_if'      => __('frontend.validation_message.billing_first_name_required'),
            'billing_last_name.required_if'       => __('frontend.validation_message.billing_last_name_required'),
            'billing_phone.required_if'           => __('frontend.validation_message.billing_phone_required'),
            'billing_email.required_if'           => __('frontend.validation_message.billing_email_required'),
            'shipping_address.required_if'        => __('frontend.validation_message.shipping_address_required'),
            'shipping_address_detail.required_if' => __('frontend.validation_message.shipping_address_detail_required'),
            'shipping_first_name.required_if'     => __('frontend.validation_message.shipping_first_name_required'),
            'shipping_last_name.required_if'      => __('frontend.validation_message.shipping_last_name_required'),
            'shipping_phone.required_if'          => __('frontend.validation_message.shipping_phone_required'),
            'shipping_email.required_if'          => __('frontend.validation_message.shipping_email_required'),
            'pick_address.required_if'            => __('frontend.validation_message.pick_address_required'),
            'pick_address_detail.required_if'     => __('frontend.validation_message.pick_address_detail_required'),
            'pick_first_name.required_if'         => __('frontend.validation_message.pick_first_name_required'),
            'pick_last_name.required_if'          => __('frontend.validation_message.pick_last_name_required'),
            'pick_phone.required_if'              => __('frontend.validation_message.pick_phone_required'),
            'pick_email.required_if'              => __('frontend.validation_message.pick_email_required')
        ];
    }
}
