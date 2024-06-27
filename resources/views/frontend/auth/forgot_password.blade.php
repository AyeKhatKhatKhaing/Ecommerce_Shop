@extends('frontend.layouts.master')
@section('content')
    <div component-name="rem-forgotpassword" class="rem-container160 py-60 lg:py-20 4xl:py-200">
        <div class="lg:max-w-[851px] mx-auto">
            <p class="rem-text-40 montserrat-semibold text-black text-center">{{__('frontend.auth.forgot_password')}}</p>
            <hr class="my-[30px] h-[2px] w-full bg-rembrown">
            <p class="rem-text-18 montserrat text-black text-center pb-7">{{__('frontend.auth.account_recovery')}}{{ old('login_type') }}</p>
            <div class="flex flex-col sm:flex-row gap-[20px] pb-7">
                <div class="flex gap-[10px]">
                    <div
                        class="rounded-full w-[24px] h-[24px] flex flex-shrink-0 justify-center items-center relative">
                        <input data-id="email" id="email-login" aria-labelledby="Email Address" @if((!old('login_type') || old('login_type') == 'email')) checked="" @endif type="radio"
                            name="login-method"
                            class="adminLoginType peer appearance-none focus:opacity-100 focus:ring-2 focus:ring-offset-2 focus:ring-rembrown focus:outline-none border rounded-full border-transparent absolute cursor-pointer w-full h-full checked:border-none">

                        <div class="hidden peer-checked:block w-[24px] h-[24px]">
                            <img src="{{ asset('frontend/img/radio-checked.svg') }}" alt="Checked">
                        </div>

                        <div class="block peer-checked:hidden w-[24px] h-[24px]">
                            <img src="{{ asset('frontend/img/radio-unchecked.svg') }}" alt="Unchecked">
                        </div>

                    </div>

                    <label id="email-address" class="rem-text-18 montserrat text-remdark cursor-pointer"
                        for="email-login">{{__('frontend.auth.email_address')}}</label>
                </div>

                <div class="flex gap-[10px]">
                    <div
                        class="rounded-full w-[24px] h-[24px] flex flex-shrink-0 justify-center items-center relative">
                        <input data-id="phone" id="phone-login" aria-labelledby="Phone No" type="radio" name="login-method" @if(old('login_type') == 'phone') checked="" @endif
                            class="adminLoginType peer appearance-none focus:opacity-100 focus:ring-2 focus:ring-offset-2 focus:ring-rembrown focus:outline-none border rounded-full border-transparent absolute cursor-pointer w-full h-full checked:border-none">

                        <div class="hidden peer-checked:block w-[24px] h-[24px]">
                            <img src="{{ asset('frontend/img/radio-checked.svg') }}" alt="Checked">
                        </div>

                        <div class="block peer-checked:hidden w-[24px] h-[24px]">
                            <img src="{{ asset('frontend/img/radio-unchecked.svg') }}" alt="Unchecked">
                        </div>

                    </div>

                    <label id="phone-no" class="rem-text-18 montserrat text-remdark cursor-pointer"
                        for="phone-login">{{__('frontend.auth.phone_no')}}</label>
                </div>
            </div>

            <form method="POST" action="{{ route('front.forget.password.post') }}" class="rem-forgotpassword-form">
                @csrf
                @if(session('message'))
                    <p class="montserrat rem-text-16 text-[#1AAD19]">{{ session('message') }}</p>
                @endif
                <input type="hidden" name="login_type" value="{{ old('login_type') ?? 'email' }}">
                <div class="email-form-group">
                    <label for="email" class="block pb-2 montserrat rem-text-18 text-remdark">{{__('frontend.auth.email_address')}}*</label>
                    <input type="email" id="email" name="email"
                        class="border border-remDF p-3 h-[54px] w-full rem-text-16 montserrat @error('email') rem-errorborder @enderror">
                        @error('email')
                        <p class="text-remred rem-text-16 montserrat">{{ $message }}</p>
                        @enderror
                </div>

                <div class="phone-form-group xl:gap-5 hidden">
                    <div class="lg:flex-[0_1_25%] lg:max-w-[25%] lg:mr-2 xl:mr-0">
                        <div component-name="rem-select-box" class="w-full space-y-[10px] country_selectbox">
                            <label for="country-code" class="rem-text-18 text-remdark">{{__('frontend.auth.country_code')}}<span
                                    class="text-rembrown @@star">*</span></label>
                            <div type="button"
                                class="custom-select-container w-full relative rem-text-16 montserrat text-remdark select-none">
                                <input type="text" name="country_code" id="country-code" hidden value="{{ old('country_code') }}"/>
                                <select class="hidden">
                                    @foreach (config('general.'.lngKey().'_codes') as $key => $country)
                                        <option value="{{ $key }}" {{ old('country_code') == $key ? 'selected' : ($loop->first ? 'selected' : '') }}>{{ $country }}
                                        </option>
                                    @endforeach
                                </select>
                                <div
                                    class="select-arrow absolute top-[23px] right-[21px] w-[12px] h-[6px] pointer-events-none">
                                    <img src="{{ asset('frontend/img/arrow-down.svg') }}" alt="Arrow Down" />
                                </div>
                            </div>
                            <p class="rem-text-14 text-remred hidden"></p>
                        </div>
                    </div>

                    <div class="lg:flex-[0_1_75%] lg:max-w-[75%] space-y-[10px] pt-4 lg:pt-0">
                        <label for="phone" class="block rem-text-18 text-remdark">{{__('frontend.auth.phone_no')}}<span
                                class="text-rembrown" aria-label="required">*</span>
                        </label>
                        <input type="tel" id="phone" name="phone" placeholder="Phone No" required value="{{ old('phone') ?? array_key_first(config('general.'.lngKey().'_codes')) }}"
                            class="w-full h-[52px] @error('phone') rem-errorborder @enderror border border-remDF px-[21px] py-[13px] rem-text-16 montserrat text-remdark focus:bg-[#F3EFEA] focus:outline-none" />
                            @error('phone')
                            <p class="rem-text-14 text-remred montserrat">{{ $message }}</p>
                            @enderror
                    </div>
                </div>
                <button type="submit"
                    class="w-full py-4 px-3 montserrat-semibold uppercase bg-rembrown mt-7 rem-text-18 text-whitez">{{__('frontend.auth.submit')}}</button>
            </form>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $('.adminLoginType').on('change', function() {
            let type = $(this).data('id');

            $('input:hidden[name=login_type]').val(type);
        })
    </script>
@endpush


