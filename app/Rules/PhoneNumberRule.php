<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PhoneNumberRule implements Rule
{
    protected $countryCode;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($countryCode)
    {
        $this->countryCode = $countryCode;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $countryCode = $this->countryCode; // Assuming 'country_code' is the input key
        $phone       = '';

        if (Str::startsWith($value, $countryCode)) {
            $phone = Str::replaceFirst($countryCode, '', $value);

        }
        $phone = $countryCode . $phone;

        return Validator::make(
            [$attribute => $phone],
            [$attribute => 'unique:members,phone'],
        )->passes();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'This phone number is already taken';
    }
}
