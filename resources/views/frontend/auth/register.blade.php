@extends('frontend.layouts.master')
@section('content')
@php
    $privacy_name  = lngKey().'_privacy';
    $law_name      = lngKey().'_register_law';
@endphp
<div component-name="rem-register" class="rem-container160 py-60 lg:py-20 4xl:py-200">
    <form action="{{ route('front.register-post') }}" class="w-full max-w-[851px] mx-auto space-y-[30px]" method="post" id="register-form">
        @csrf
        <p class="rem-text-40 montserrat-semibold text-black text-center">
            {{__('frontend.auth.register')}}
        </p>

        <hr class="my-[30px] h-[2px] w-full bg-rembrown" />
        
        <!-- Buttons to change register method -->
        <div class="flex flex-col sm:flex-row gap-[20px]">
            <div class="flex gap-[10px]">
                <div
                    class="rounded-full w-[24px] h-[24px] flex flex-shrink-0 justify-center items-center relative">
                    <input id="individual-account" aria-labelledby="Individual Account" type="radio" {{ old('account_type') && old('account_type') == 'company' ? '' : 'checked' }}
                        name="account_type" value="individual"
                        class="peer appearance-none focus:opacity-100 focus:ring-2 focus:ring-offset-2 focus:ring-rembrown focus:outline-none border rounded-full border-transparent absolute cursor-pointer w-full h-full checked:border-none" />

                        <div class="hidden peer-checked:block w-[24px] h-[24px]">
                            <img src="{{ asset('frontend/img/radio-checked.svg') }}" alt="Checked" />
                        </div>

                        <div class="block peer-checked:hidden w-[24px] h-[24px]">
                            <img src="{{ asset('frontend/img/radio-unchecked.svg') }}" alt="Unchecked" />
                        </div>
                    {{-- @if (old('account_type') == 'individual')
                        <div class="adminIndiCheck peer-checked:block w-[24px] h-[24px]">
                            <img src="{{ asset('frontend/img/radio-checked.svg') }}" alt="Checked" />
                        </div>
                        <div class="adminIndiUncheck hidden block w-[24px] h-[24px]">
                            <img src="{{ asset('frontend/img/radio-unchecked.svg') }}" alt="Unchecked" />
                        </div>
                    @elseif (old('account_type') == 'company')
                        <div class="adminIndiCheck hidden peer-checked:hidden w-[24px] h-[24px]">
                            <img src="{{ asset('frontend/img/radio-checked.svg') }}" alt="Checked" />
                        </div>
                        <div class="adminIndiUncheck block w-[24px] h-[24px]">
                            <img src="{{ asset('frontend/img/radio-unchecked.svg') }}" alt="Unchecked" />
                        </div>
                    @else
                        <div class="hidden peer-checked:block w-[24px] h-[24px]">
                            <img src="{{ asset('frontend/img/radio-checked.svg') }}" alt="Checked" />
                        </div>

                        <div class="block peer-checked:hidden w-[24px] h-[24px]">
                            <img src="{{ asset('frontend/img/radio-unchecked.svg') }}" alt="Unchecked" />
                        </div>
                    @endif --}}

                </div>

                <label id="Individual Account" class="rem-text-18 montserrat text-remdark cursor-pointer"
                    for="individual-account">{{__('frontend.auth.individual_account')}}</label>

            </div>

            <div class="flex gap-[10px]">
                <div
                    class="rounded-full w-[24px] h-[24px] flex flex-shrink-0 justify-center items-center relative">
                    <input id="company-account" aria-labelledby="Company Account" type="radio" {{ old('account_type') && old('account_type') == 'company' ? 'checked' : '' }}
                        name="account_type" value="company"
                        class="peer appearance-none focus:opacity-100 focus:ring-2 focus:ring-offset-2 focus:ring-rembrown focus:outline-none border rounded-full border-transparent absolute cursor-pointer w-full h-full checked:border-none" />

                        <div class="hidden peer-checked:block w-[24px] h-[24px]">
                            <img src="{{ asset('frontend/img/radio-checked.svg') }}" alt="Checked" />
                        </div>

                        <div class="block peer-checked:hidden w-[24px] h-[24px]">
                            <img src="{{ asset('frontend/img/radio-unchecked.svg') }}" alt="Unchecked" />
                        </div>
                    {{-- @if (old('account_type') == 'company')
                        <div class="adminComCheck peer-checked:block w-[24px] h-[24px]">
                            <img src="{{ asset('frontend/img/radio-checked.svg') }}" alt="Checked" />
                        </div>
                        <div class="adminComUncheck hidden block w-[24px] h-[24px]">
                            <img src="{{ asset('frontend/img/radio-unchecked.svg') }}" alt="Unchecked" />
                        </div>
                    @elseif (old('account_type') == 'individual')
                        <div class="hidden peer-checked:block w-[24px] h-[24px]">
                            <img src="{{ asset('frontend/img/radio-checked.svg') }}" alt="Checked" />
                        </div>
                        <div class="adminComUncheck block w-[24px] h-[24px]">
                            <img src="{{ asset('frontend/img/radio-unchecked.svg') }}" alt="Unchecked" />
                        </div>
                    @else
                        <div class="hidden peer-checked:block w-[24px] h-[24px]">
                            <img src="{{ asset('frontend/img/radio-checked.svg') }}" alt="Checked" />
                        </div>

                        <div class="block peer-checked:hidden w-[24px] h-[24px]">
                            <img src="{{ asset('frontend/img/radio-unchecked.svg') }}" alt="Unchecked" />
                        </div>
                    @endif --}}
                </div>

                <label id="Company Account" class="rem-text-18 montserrat text-remdark cursor-pointer"
                    for="company-account">{{__('frontend.auth.company_account')}}</label>

            </div>
        </div>

        <div id="individual-acc" class="@if (old('account_type') == 'company') hidden @endif">
            <div class="grid grid-cols-2 gap-[20px]">
                <div class="col-span-2 md:col-span-1">
                    <div class="w-full space-y-[10px]  @error('first_name') rem-error @enderror">
                        <label for="name" class="block rem-text-18 text-remdark">{{__('frontend.auth.name')}}<span class="text-rembrown @@star" aria-label="required">*</span>
                        </label>
    
                        <input type="text" id="name" name="first_name" placeholder="" value="{{ old('first_name') }}" class="w-full h-[52px] border border-remDF px-[21px] py-[13px] rem-text-16 montserrat text-remdark focus:bg-[#F3EFEA] focus:outline-none" />
                        @error('first_name')
                        <p class="rem-text-14 text-remred hidden" id="name-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="col-span-2 md:col-span-1">
                    <div class="w-full space-y-[10px] @error('last_name') rem-error @enderror">
                        <label for="surname" class="block rem-text-18 text-remdark">{{__('frontend.auth.surname')}}<span class="text-rembrown @@star" aria-label="required">*</span>
                        </label>
    
                        <input type="text" id="surname" name="last_name" placeholder="" value="{{ old('last_name') }}" class="w-full h-[52px] border border-remDF px-[21px] py-[13px] rem-text-16 montserrat text-remdark focus:bg-[#F3EFEA] focus:outline-none" />
                        @error('last_name')
                        <p class="rem-text-14 text-remred hidden" id="surname-error">{{ $message }}
                        </p>
                        @enderror
                    </div>
                </div>
                
                <div class="col-span-2 grid grid-cols-2 gap-[20px]">
                    <div class="col-span-2 md:col-span-1 order-last date-field">
                        <div class="w-full space-y-[10px]">
                            <label for="date-of-birth" class="block rem-text-18 text-remdark">{{__('frontend.auth.date_of_birth')}}</label>

                            <input type="date" id="date-of-birth" name="dob" value="{{ old('dob') }}"
                                class="w-full h-[52px] border border-remDF px-[21px] py-[13px] rem-text-16 montserrat text-remdark bg-transparent focus:outline-none" />

                            <p class="rem-text-14 text-remred hidden" id="date-of-birth-error">{{__('frontend.auth.invalid_input')}}
                            </p>
                        </div>
                    </div>

                    <div class="col-span-2 md:col-span-1 email-field">
                        <div class="w-full space-y-[10px] @error('email') rem-error @enderror">
                            <label for="email" class="block rem-text-18 text-remdark">{{__('frontend.auth.email_address')}}<span
                                    class="text-rembrown @@star">*</span>
                            </label>

                            <input type="email" id="email" name="email" placeholder="" value="{{ old('email') }}"
                                class="w-full h-[52px] border border-remDF px-[21px] py-[13px] rem-text-16 montserrat text-remdark focus:bg-[#F3EFEA] focus:outline-none" />

                            @error('email')
                                <p class="rem-text-14 text-remred hidden" id="email-error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="col-span-2 md:col-span-1 md:mr-4 xl:mr-0">
                    <div component-name="rem-select-box" class="w-full space-y-[10px] @error('country_code') rem-error @enderror country_selectbox">
                        <label for="country-code" class="rem-text-18 text-remdark">{{__('frontend.auth.country_code')}}<span
                                class="text-rembrown @@star">*</span></label>
                        <div
                            class="custom-select-container w-full relative rem-text-16 montserrat text-remdark select-none">
                            <input type="text" name="country_code" id="country-code" hidden value="{{ old('country_code') }}" />
                            <select class="hidden">
                                @foreach (config('general.'.lngKey().'_codes') as $key => $country)
                                    <option value="{{ $key }}" {{ old('country_code') == $key ? 'selected' : ($loop->first ? 'selected' : '') }}>{{ $country }}</option>
                                @endforeach
                            </select>
                            <div class="select-arrow absolute top-[23px] right-[21px] w-[12px] h-[6px] pointer-events-none">
                                <img src="{{ asset('frontend/img/arrow-down.svg') }}" alt="Arrow Down" />
                            </div>
                        </div>
                        @error('country_code')
                            <p class="rem-text-14 text-remred hidden">{{__('frontend.auth.please_select_one')}}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-span-2 md:col-span-1">
                    <div class="w-full space-y-[10px] @error('phone') rem-error @enderror">
                        <label for="phone" class="block rem-text-18 text-remdark">{{__('frontend.auth.phone_no')}}<span class="text-rembrown" aria-label="required">*</span>
                        </label>
    
                        <div class="w-full flex items-center">
                            <input type="tel" id="phone" name="phone" placeholder="{{__('frontend.auth.phone_no')}}" value="{{ old('phone') }}" class="w-full h-[52px] border border-remDF px-[21px] py-[13px] rem-text-16 montserrat text-remdark focus:bg-[#F3EFEA] focus:outline-none" />
                            <div class="flex-shrink-0">
                                <button type="button" id="getOTP" class="w-full py-[13px] px-[21px] h-[52px] bg-rembrown text-white border border-rembrown montserrat-semibold rem-text-16 uppercase transition hover:bg-transparent hover:text-rembrown">
                                    {{__('frontend.auth.get_otp')}}
                                </button>
                            </div>
                        </div>
                        @error('phone')
                        <p class="rem-text-14 text-remred" id="phone-error">{{ $message }}</p>
                        @else
                        <p class="rem-text-14 text-remred hidden" id="phone-error">{{__('frontend.auth.invalid_input')}}</p>
                        @enderror
                    </div>
                </div>


                
                <div class="col-span-2">
                    <div class="w-full space-y-[10px] @error('otp') rem-error @enderror">
                        <label for="otp" class="block rem-text-18 text-remdark">{{__('frontend.auth.one_time_password')}}<span class="text-rembrown @@star" aria-label="required">*</span>
                        </label>

                        <input type="text" id="otp" name="otp" placeholder="" class="w-full h-[52px] border border-remDF px-[21px] py-[13px] rem-text-16 montserrat text-remdark focus:bg-[#F3EFEA] focus:outline-none" />
                        <p class="rem-text-14 text-remred hidden" id="otp-error">{{__('frontend.auth.verified')}}</p>
                        <input type="hidden" name="verify_or_not" value="false" id="verify_or_not">

                    </div>
                </div>


                <div class="col-span-2 md:col-span-1">
                    <div class="w-full space-y-[10px] @error('password') rem-error @enderror">
                        <label for="password" class="block rem-text-18 text-remdark">{{__('frontend.auth.password')}}<span class="text-rembrown @@star" aria-label="required">*</span>
                        </label>
    
                        <input type="password" id="password" name="password" placeholder="" class="w-full h-[52px] border border-remDF px-[21px] py-[13px] rem-text-16 montserrat text-remdark focus:bg-[#F3EFEA] focus:outline-none" />
                        @error('password')
                        <p class="rem-text-14 text-remred hidden" id="password-error">{{ $message }}
                        </p>
                        @enderror
                    </div>
                </div>

                <div class="col-span-2 md:col-span-1">
                    <div class="w-full space-y-[10px] @error('password') rem-error @enderror">
                        <label for="confirm-password" class="block rem-text-18 text-remdark">{{__('frontend.auth.confirm_password')}}<span class="text-rembrown @@star" aria-label="required">*</span>
                        </label>
    
                        <input type="password" id="confirm-password" name="password_confirmation" placeholder="" class="w-full h-[52px] border border-remDF px-[21px] py-[13px] rem-text-16 montserrat text-remdark focus:bg-[#F3EFEA] focus:outline-none" />
                        @error('password')
                        <p class="rem-text-14 text-remred hidden" id="confirm-password-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="col-span-2">
                    <div>
                        <label for="read-statement" class="flex items-start relative">
                            <input type="checkbox" id="read-statement" name="is_term_condition" value="read-statement" {{ old('is_term_condition') ? 'checked' : '' }} class="peer absolute w-[20px] h-[20px] appearance-none rem-error">
                            <span class="block peer-checked:hidden flex-shrink-0 rounded-[2px] w-[20px] h-[20px]  border  @error('is_term_condition') border-remred @else border-black @enderror peer-focus:outline peer-focus:outline-1 peer-focus:outline-offset-1 peer-focus:outline-rembrown"></span>
    
                            <span class="hidden peer-checked:flex flex-shrink-0 rounded-[2px] w-[20px] h-[20px] items-center justify-center text-white border border-rembrown bg-rembrown peer-focus:outline peer-focus:outline-1 peer-focus:outline-offset-1 peer-focus:outline-rembrown">&#10003;</span>
                            <span class="ml-[10px] rem-text-18 montserrat text-black">
                                {!! isset($site_setting) && isset($site_setting->options) ? $site_setting->options[$privacy_name] : '' !!}
                            </span>
                        </label>
                        @error('is_term_condition')
                        <p class="rem-text-14 text-remred">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="col-span-2">
                    <div>
                        <label for="receive-news" class="flex items-start relative">
                            <input type="checkbox" id="receive-news" name="is_marketing" value="receive-news" {{ old('is_marketing') ? 'checked' : '' }} class="peer absolute w-[20px] h-[20px] appearance-none">
                            <span class="block peer-checked:hidden flex-shrink-0 rounded-[2px] w-[20px] h-[20px]  border border-black peer-focus:outline peer-focus:outline-1 peer-focus:outline-offset-1 peer-focus:outline-rembrown"></span>
    
                            <span class="hidden peer-checked:flex flex-shrink-0 rounded-[2px] w-[20px] h-[20px] items-center justify-center text-white border border-rembrown bg-rembrown peer-focus:outline peer-focus:outline-1 peer-focus:outline-offset-1 peer-focus:outline-rembrown">&#10003;</span>
    
                            <span class="ml-[10px] rem-text-18 montserrat text-black">{{ isset($site_setting) && isset($site_setting->options) ? $site_setting->options[$law_name] : '' }}</span>
                        </label>
                        <p class="hidden rem-text-14 text-remred">{{__('frontend.auth.please_check')}}</p>
                    </div>
                </div>
            </div>
        </div>

        <div id="company-acc" class="@if (old('account_type') == 'individual') hidden @endif">
            <div class="grid grid-cols-2 gap-[20px]">
                <div class="col-span-2 md:col-span-1">
                    <div class="w-full space-y-[10px] @error('com_first_name') rem-error @enderror">
                        <label for="name" class="block rem-text-18 text-remdark">{{__('frontend.auth.name')}}<span
                                class="text-rembrown @@star">*</span>
                        </label>

                        <input type="text" id="com_first_name" name="com_first_name" placeholder="" value="{{ old('com_first_name') }}"
                            class="w-full h-[52px] border border-remDF px-[21px] py-[13px] rem-text-16 montserrat text-remdark focus:bg-[#F3EFEA] focus:outline-none" />

                        @error('com_first_name')
                            <p class="rem-text-14 text-remred hidden" id="name-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="col-span-2 md:col-span-1">
                    <div class="w-full space-y-[10px] @error('com_last_name') rem-error @enderror">
                        <label for="surname" class="block rem-text-18 text-remdark">{{__('frontend.auth.surname')}}<span
                                class="text-rembrown @@star">*</span>
                        </label>

                        <input type="text" id="com_last_name" name="com_last_name" placeholder="" value="{{ old('com_last_name') }}"
                            class="w-full h-[52px] border border-remDF px-[21px] py-[13px] rem-text-16 montserrat text-remdark focus:bg-[#F3EFEA] focus:outline-none" />

                        @error('com_last_name')
                            <p class="rem-text-14 text-remred hidden" id="surname-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="col-span-2 md:col-span-1">
                    <div class="w-full space-y-[10px] @error('company_name') rem-error @enderror">
                        <label for="company-name" class="block rem-text-18 text-remdark">{{__('frontend.auth.company_name')}}<span
                                class="text-rembrown @@star">*</span>
                        </label>

                        <input type="text" id="company-name" name="company_name" placeholder="" value="{{ old('company_name') }}"
                            class="w-full h-[52px] border border-remDF px-[21px] py-[13px] rem-text-16 montserrat text-remdark focus:bg-[#F3EFEA] focus:outline-none" />

                        @error('company_name')
                            <p class="rem-text-14 text-remred hidden" id="company-name-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="col-span-2 md:col-span-1">
                    <div class="w-full space-y-[10px] ">
                        <label for="company-website" class="block rem-text-18 text-remdark">{{__('frontend.auth.company_website')}}<span
                                class="text-rembrown hidden">*</span>
                        </label>

                        <input type="text" id="company-website" name="company_website" placeholder="" value="{{ old('company_website') }}"
                            class="w-full h-[52px] border border-remDF px-[21px] py-[13px] rem-text-16 montserrat text-remdark focus:bg-[#F3EFEA] focus:outline-none" />

                        <p class="rem-text-14 text-remred hidden" id="company-website-error"></p>
                    </div>
                </div>

                <div class="col-span-2 grid grid-cols-2 gap-[20px]">
                    <div class="col-span-2 md:col-span-1 business-field">
                        <div component-name="rem-select-box" class="w-full space-y-[10px]  @error('business_type') rem-error @enderror">
                            <label for="business-type" class="rem-text-18 text-remdark">{{__('frontend.auth.type_of_business')}}<span class="text-rembrown @@star">*</span></label>
                            <div type="button" class="custom-select-container w-full relative rem-text-16 montserrat text-remdark select-none">
                                <input type="text" name="business_type" id="business-type" hidden />
                                <select class="hidden">
                                    <option value="">{{__('frontend.auth.select')}}</option>
                                    @foreach($business_types as $type)
                                        <option value="{{ langbind($type,'name') ?? '' }}" {{ old('business_type') === $type->id ? 'selected' : '' }}> {{ langbind($type,'name') ?? '' }}</option>
                                    @endforeach
                                </select>
                                <div class="select-arrow absolute top-[23px] right-[21px] w-[12px] h-[6px] pointer-events-none">
                                    <img src="{{ asset('frontend/img/arrow-down.svg') }}" alt="Arrow Down" />
                                </div>
                            </div>
                            @error('business_type')
                                <p class="rem-text-14 text-remred hidden">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="col-span-2 md:col-span-1 date-field">
                        <div class="w-full space-y-[10px]">
                            <label for="date-of-birth" class="block rem-text-18 text-remdark">{{__('frontend.auth.date_of_birth')}}</label>
    
                            <input type="date" id="date-of-birth" name="com_dob" value="{{ old('com_dob') }}" class="w-full h-[52px] border border-remDF px-[21px] py-[13px] rem-text-16 montserrat text-remdark focus:bg-[#F3EFEA] focus:outline-none" />
    
                            <p class="rem-text-14 text-remred hidden" id="date-of-birth-error">{{__('frontend.auth.invalid_input')}}</p>
                        </div>
                    </div>

                    <div class="col-span-2 email-field">
                        <div class="w-full space-y-[10px] @error('com_email') rem-error @enderror">
                            <label for="email" class="block rem-text-18 text-remdark">{{__('frontend.auth.email_address')}}<span
                                    class="text-rembrown @@star">*</span>
                            </label>

                            <input type="email" id="com_email" name="com_email" placeholder="" value="{{ old('com_email') }}"
                                class="w-full h-[52px] border border-remDF px-[21px] py-[13px] rem-text-16 montserrat text-remdark focus:bg-[#F3EFEA] focus:outline-none" />
                            @error('com_email')
                                <p class="rem-text-14 text-remred hidden" id="email-error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="col-span-2 md:col-span-1">
                    <div component-name="rem-select-box"
                        class="w-full space-y-[10px] @error('com_country_code') rem-error @enderror country_selectbox">
                        <label for="country-code" class="rem-text-18 text-remdark">{{__('frontend.auth.country_code')}} <span
                                class="text-rembrown @@star">*</span></label>
                        <div type="button"
                            class="custom-select-container w-full relative rem-text-16 montserrat text-remdark select-none">
                            <input type="text" name="com_country_code" id="country-code" hidden value="{{ old('com_country_code') }}" />
                            <select class="hidden">
                                @foreach (config('general.'.lngKey().'_codes') as $key => $country)
                                    <option value="{{ $key }}" {{ old('com_country_code') == $key ? 'selected' : ($loop->first ? 'selected' : '') }}>{{ $country }}</option>
                                @endforeach
                            </select>
                            <div
                                class="select-arrow absolute top-[23px] right-[21px] w-[12px] h-[6px] pointer-events-none">
                                <img src="{{ asset('frontend/img/arrow-down.svg') }}" alt="Arrow Down" />
                            </div>
                        </div>
                        @error('com_country_code')
                            <p class="rem-text-14 text-remred hidden">{{__('frontend.auth.please_select_one')}}</p>
                        @enderror
                    </div>
                </div>

                <div class="col-span-2 md:col-span-1">
                    <div class="w-full space-y-[10px] @error('com_phone') rem-error @enderror">
                        <label for="phone" class="block rem-text-18 text-remdark">{{__('frontend.auth.phone_no')}}<span
                                class="text-rembrown" aria-label="required">*</span>
                        </label>

                        <div class="w-full flex items-center">
                            <input type="tel" id="phone" name="com_phone" placeholder="{{__('frontend.auth.phone_no')}}" value="{{ old('com_phone') }}"
                                class="w-full h-[52px] border border-remDF px-[21px] py-[13px] rem-text-16 montserrat text-remdark focus:bg-[#F3EFEA] focus:outline-none" />
                            <div class="flex-shrink-0">
                                <button type="button" id="adminGetComOTP"
                                    class="w-full py-[13px] px-[21px] h-[52px] bg-rembrown text-white border border-rembrown montserrat-semibold rem-text-16 uppercase transition hover:bg-transparent hover:text-rembrown">
                                    {{__('frontend.auth.get_otp')}}
                                </button>
                            </div>
                        </div>

                        @error('com_phone')
                            <p class="rem-text-14 text-remred" id="com-phone-error">{{ $message }}</p>
                        @else
                            <p class="rem-text-14 text-remred hidden" id="com-phone-error">{{__('frontend.auth.invalid_input')}}</p>
                        @enderror
                    </div>
                </div>


                <div class="col-span-2">
                    <div class="w-full space-y-[10px] @error('com_otp') rem-error @enderror">
                        <label for="otp" class="block rem-text-18 text-remdark">{{__('frontend.auth.one_time_password')}}<span
                                class="text-rembrown @@star">*</span>
                        </label>

                        <input type="text" id="com_otp" name="com_otp" placeholder=""
                            class="w-full h-[52px] border border-remDF px-[21px] py-[13px] rem-text-16 montserrat text-remdark focus:bg-[#F3EFEA] focus:outline-none" />

                        <p class="rem-text-14 text-remred hidden" id="com-otp-error">{{__('frontend.auth.verified')}}</p>
                        <input type="hidden" name="com_verify_or_not" value="false" id="com_verify_or_not">
                    </div>
                </div>


                <div class="col-span-2 md:col-span-1">
                    <div class="w-full space-y-[10px] @error('com_password') rem-error @enderror">
                        <label for="password" class="block rem-text-18 text-remdark">{{__('frontend.auth.password')}}<span
                                class="text-rembrown @@star">*</span>
                        </label>

                        <input type="password" id="com_password" name="com_password" placeholder=""
                            class="w-full h-[52px] border border-remDF px-[21px] py-[13px] rem-text-16 montserrat text-remdark focus:bg-[#F3EFEA] focus:outline-none" />
                        @error('com_password')
                            <p class="rem-text-14 text-remred hidden" id="password-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="col-span-2 md:col-span-1">
                    <div class="w-full space-y-[10px] @error('com_confirm_password') rem-error @enderror">
                        <label for="confirm-password" class="block rem-text-18 text-remdark">{{__('frontend.auth.confirm_password')}}
                        <span class="text-rembrown @@star">*</span>
                        </label>

                        <input type="password" id="com-confirm-password" name="com_confirm_password" placeholder=""
                            class="w-full h-[52px] border border-remDF px-[21px] py-[13px] rem-text-16 montserrat text-remdark focus:bg-[#F3EFEA] focus:outline-none" />

                        @error('com_confirm_password')
                            <p class="rem-text-14 text-remred hidden" id="confirm-password-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="col-span-2">
                    <div>
                        <label for="read-statement" class="flex items-start relative">
                            <input type="checkbox" id="read-statement" name="com_is_term_condition" value="read-statement" {{ old('com_is_term_condition') ? 'checked' : '' }} class="peer absolute w-[20px] h-[20px] appearance-none rem-error">
                            <span class="block peer-checked:hidden flex-shrink-0 rounded-[2px] w-[20px] h-[20px]  border  @error('com_is_term_condition') border-remred @else border-black @enderror peer-focus:outline peer-focus:outline-1 peer-focus:outline-offset-1 peer-focus:outline-rembrown"></span>
    
                            <span class="hidden peer-checked:flex flex-shrink-0 rounded-[2px] w-[20px] h-[20px] items-center justify-center text-white border border-rembrown bg-rembrown peer-focus:outline peer-focus:outline-1 peer-focus:outline-offset-1 peer-focus:outline-rembrown">&#10003;</span>
    
                            <span class="ml-[10px] rem-text-18 montserrat text-black">
                                {!! isset($site_setting) && isset($site_setting->options) ? $site_setting->options[$privacy_name] : '' !!}    
                            </span>
                        </label>
                        @error('com_is_term_condition')
                            <p class="rem-text-14 text-remred">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="col-span-2">
                    <div>
                        <label for="receive-news" class="flex items-start relative">
                            <input type="checkbox" id="receive-news" name="com_is_marketing" value="receive-news" {{ old('com_is_marketing') ? 'checked' : '' }} class="peer absolute w-[20px] h-[20px] appearance-none">
                            <span class="block peer-checked:hidden flex-shrink-0 rounded-[2px] w-[20px] h-[20px]  border border-black peer-focus:outline peer-focus:outline-1 peer-focus:outline-offset-1 peer-focus:outline-rembrown"></span>
    
                            <span class="hidden peer-checked:flex flex-shrink-0 rounded-[2px] w-[20px] h-[20px] items-center justify-center text-white border border-rembrown bg-rembrown peer-focus:outline peer-focus:outline-1 peer-focus:outline-offset-1 peer-focus:outline-rembrown">&#10003;</span>
    
                            <span class="ml-[10px] rem-text-18 montserrat text-black">{{ isset($site_setting) && isset($site_setting->options) ? $site_setting->options[$law_name] : '' }}</span>
                        </label>
                        <p class="hidden rem-text-14 text-remred">{{__('frontend.auth.please_check')}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div
            class="col-span-2 flex flex-col space-y-[20px] md:flex-row md:space-y-0 md:space-x-[20px] mt-[10px]">
            <button id="register-btn" type="button"
                class="w-full p-[16px] bg-rembrown text-white text-center border border-rembrown montserrat-bold rem-text-18 uppercase transition hover:bg-transparent hover:text-rembrown">{{__('frontend.auth.register')}}</button>

            <a href="{{ route('front.login') }}"
                class="block w-full p-[16px] bg-rembrown text-white text-center border border-rembrown montserrat-bold rem-text-18 uppercase transition hover:bg-transparent hover:text-rembrown ">
                {{__('frontend.auth.already_account')}} {{ old('account_type') }}
            </a>
        </div>
    </form>
</div>

@endsection

@push('scripts')
<script src="{{ asset('frontend/custom/register.js') }}"></script>
<script>
    $(document).ready(function() {
        //account type choose and set to hidden text box
        $('input[name="account_type"]').change(function() {
            var selectedAccount = $('input[name="account_type"]:checked').val();
            $('#account_type').val(selectedAccount);
        })

        //verify OTP
        const otpInput = document.getElementById('otp');
        otpInput.addEventListener('input', function() {
            const otpCode = otpInput.value;
            if (/^\d{6}$/.test(otpCode)) {
                verifyOTP(otpCode);
            }
        });

        $('#getOTP').on('click', function() {
            checkBanTime();
        });

        checkAccountTypeForm();
    });

    function checkBanTime() {
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        var phone = $('#phone').val();
        var country_code = $('#country-code').val();
        var phone = checkPhoneFormat(country_code, phone);
        $.ajax({
            url: '/get-otp',
            type: 'POST',
            data: {
                _token: csrfToken,
                lngKey:lngKey,
                phone_number: country_code + phone,
            },
            success: function(resp) {
                console.log(resp);
                if(resp.status == true) {
                    $('#phone-error').text(resp.message).removeClass('hidden').css('color', 'green');
                    
                } else {
                    $('#phone-error').text(resp.message).removeClass("hidden").css('color', 'red');
                }                

            },
            error: function(error) {
                console.log("Error:", error);
            }
        });
    }

    function verifyOTP(otp) {
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        var phone = $('#phone').val();
        var country_code = $('#country-code').val();
        var phone = checkPhoneFormat(country_code, phone);
        $.ajax({
            url: '/verify-otp',
            type: 'POST',
            data: {
                _token: csrfToken,
                phone: country_code + phone,
                otp_code: otp,
            },
            success: function(resp) {
                if (resp.status == true) {
                    $("#otp").prop("disabled", true);
                    $("#otp-error").text(resp.message).removeClass('hidden').css('color', 'green');
                    $("#register-btn").prop("disabled", false);
                    $('#verify_or_not').val(true)
                } else {
                    $("#otp").prop("disabled", false);
                    $("#otp-error").text(resp.message).removeClass('hidden').css('color', 'red');
                    $('#verify_or_not').val(false)
                }
            },
            error: function(error) {

            }
        });
    }

    function checkPhoneFormat(country_code, phone) {

        if (phone.startsWith(country_code)) {
            var cutString = phone.replace(country_code, "");
            return cutString;
        } else {
            return phone;
        }
    }

    $('#register-btn').on('click', function() {
        let account_type = $('input[name="account_type"]:checked').val();
        console.log($('#com_verify_or_not').val());
        if (account_type == 'individual'){
            if (($('#verify_or_not').val() == "true") || $('input[name="email"]').val().length > 0) {
                    $('#register-form').submit();
            } else if ($('#com_verify_or_not').val() == "false") {
                $('#register-form').submit();
            }
            else {
                $('#otp-error').text("Please verify OTP first!").removeClass('hidden').css('color', 'red')
                $("#register-btn").prop("disabled", false);
            }
        } else {
            if (($('#com_verify_or_not').val() == "true") || $('input[name="com_email"]').val().length > 0) {
                    $('#register-form').submit();
            } else if ($('#com_verify_or_not').val() == "false") {
                $('#register-form').submit();
            }
            else {
                $('#com-otp-error').text("Please verify OTP first!").removeClass('hidden').css('color', 'red')
                $("#register-btn").prop("disabled", false);
            }
        }
    });

    function checkAccountTypeForm() {
        var checked_account_type = $('input[name="account_type"]:checked').val();

        if(checked_account_type == 'company')  {
            $('#individual-acc').addClass('hidden');
            $('#company-acc').removeClass('hidden');
        } else {
            $('#individual-acc').removeClass('hidden');
            $('#company-acc').addClass('hidden');
        }
    }
</script>
@endpush