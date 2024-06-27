<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MemberRegisterRequest extends FormRequest
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
            'first_name'            => 'required_if:account_type,individual',
            'last_name'             => 'required_if:account_type,individual',
            'password'              => 'required_if:account_type,individual|min:6|confirmed',
            'is_term_condition'     => 'required_if:account_type,individual',

            'email'                 => ['email', Rule::requiredIf(function () {
                return $this->input('phone') == null && $this->input('account_type') == 'individual';
            }), Rule::unique('members')->where(function ($query) {
                return $query->where('email', $this->input('email'))
                    ->where('status', 1);
            }),
            ],

            'phone'                 => [Rule::requiredIf(function () {
                return $this->input('email') == null && $this->input('account_type') == 'individual';
            }), $this->input('account_type') == 'individual' ? Rule::unique('members')->where(function ($query) {
                return $query->where('phone', $this->input('phone'))
                    ->where('status', 1);
            }) : '',
            ],

            'com_email'             => ['email', Rule::requiredIf(function () {
                return $this->input('com_phone') == null && $this->input('account_type') == 'company';
            }), Rule::unique('members', 'email')->where(function ($query) {
                return $query->where('email', $this->input('com_email'))
                    ->where('status', 1);
            })],

            'com_phone'             => [Rule::requiredIf(function () {
                return $this->input('com_email') == null && $this->input('account_type') == 'company';
            }), $this->input('account_type') == 'company' ? Rule::unique('members', 'phone')->where(function ($query) {
                return $query->where('phone', $this->input('com_phone'))
                    ->where('status', 1);
            }) : '',
            ],

            'com_first_name'        => 'required_if:account_type,company',
            'com_last_name'         => 'required_if:account_type,company',
            'business_type'         => 'required_if:account_type,company',
            'company_name'          => 'required_if:account_type,company',
            'com_is_term_condition' => 'required_if:account_type,company',
            'com_password'          => 'required_if:account_type,company|min:6',
            'com_confirm_password'  => 'required_if:account_type,company|required_with:com_password|same:com_password|min:6',
        ];
    }

    public function messages()
    {
        return [
            'first_name.required_if'            => __('frontend.validation_message.first_name_required'),
            'last_name.required_if'             => __('frontend.validation_message.last_name_required'),
            'email.required_if'                 => __('frontend.validation_message.email_required'),
            'email.required'                    => __('frontend.validation_message.email_required'),
            'phone.required'                    => __('frontend.validation_message.phone_required'),
            'email.unique'                      => __('frontend.validation_message.email_unique'),
            'email.email'                       => __('frontend.validation_message.email_type'),
            'password.required_if'              => __('frontend.validation_message.password_required'),
            'password.min'                      => __('frontend.validation_message.password_limit'),
            'password.confirmed'                => __('frontend.validation_message.password_confirm'),
            'is_term_condition.required_if'     => __('frontend.validation_message.term_condition_required'),
            'com_first_name.required_if'        => __('frontend.validation_message.com_first_name_required'),
            'com_last_name.required_if'         => __('frontend.validation_message.com_last_name_required'),
            'com_email.required_if'             => __('frontend.validation_message.com_email_required'),
            'com_email.required'                => __('frontend.validation_message.com_email_required'),
            'com_email.unique'                  => __('frontend.validation_message.com_email_unique'),
            'com_email.email'                   => __('frontend.validation_message.com_email_name'),
            'com_phone.required'                => __('frontend.validation_message.phone_required'),
            'business_type.required_if'         => __('frontend.validation_message.business_type_required'),
            'company_name.required_if'          => __('frontend.validation_message.company_name_required'),
            'com_is_term_condition.required_if' => __('frontend.validation_message.com_term_condition_required'),
            'com_password.required_if'          => __('frontend.validation_message.com_password_required'),
            'com_password.min'                  => __('frontend.validation_message.com_password_limit'),
            'com_confirm_password.required_if'  => __('frontend.validation_message.com_confirm_password'),
            'com_confirm_password.same'         => __('frontend.validation_message.password_confirm'),

            // 'phone.required_if'          => 'Phone Field is required.',
            // 'phone.unique'               => 'Phone Field must be unique.',
            // 'password.required'          => 'Password Field is required.',
            // 'country_code.required'      => 'Country Code Field is required.',
            // 'business_type.required_if'  => 'Business Type Field is required.',
            // 'is_term_condition.required' => 'Please accept the terms and conditions if you want to proceed.',
        ];
    }
}
