<?php

namespace App\Http\Requests\Frontend;

use App\Helpers\AdminHelper;
use DB;
use Illuminate\Foundation\Http\FormRequest;

class ForgetPasswordRequest extends FormRequest
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
        if ($this->login_type == 'email') {
            $required_email = 'required|email|exists:members,email';
            $required_phone = '';
        } else {
            $required_email = '';
            $required_phone = 'required|numeric';
        }

        return [
            'email' => $required_email,
            'phone' => $required_phone,
        ];
    }

    public function withValidator($validator)
    {
        if (($this->country_code == $this->phone) && $this->login_type == 'phone') {
            $validator->after(function ($validator) {
                $validator->errors()->add('phone', 'Please enter valid phone number.');
            });
        }

        if ($this->login_type == 'phone') {
            $phone  = AdminHelper::checkPhoneFormat($this->country_code, $this->phone);
            $member = DB::table('members')->where('phone', $phone)->first();

            if (!$member) {
                $validator->after(function ($validator) {
                    $validator->errors()->add('phone', 'Phone number not defined in system.');
                });
            }

            $this->merge(['format_phone' => $phone]);
        }
    }

    public function messages()
    {
        return [
            'email.exists'   => 'Your email not defined in system.',
            'phone.required' => 'Please enter a valid phone number',
        ];
    }
}
