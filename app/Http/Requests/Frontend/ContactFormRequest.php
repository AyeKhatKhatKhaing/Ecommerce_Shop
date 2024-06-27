<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class ContactFormRequest extends FormRequest
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
            'name'           => 'required',
            'email'          => 'required',
            'phone_no'       => 'required',
            'read_statement' => 'required',
            'receive_news'   => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required'           => __('frontend.validation_message.name_required'),
            'email.required'          => __('frontend.validation_message.email_required'),
            'phone_no.required'       => __('frontend.validation_message.phone_no_required'),
            'read_statement.required' => __('frontend.validation_message.read_statement_required'),
            'receive_news.required'   => __('frontend.validation_message.receive_news_required'),
        ];
    }
}
