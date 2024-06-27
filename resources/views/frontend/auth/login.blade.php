@extends('frontend.layouts.master')
@section('content')

<div component-name="rem-login" class="rem-container160 py-60 lg:py-20 4xl:py-200">
    <div class="flex flex-col items-center justify-center space-y-[60px] lg:flex-row lg:items-stretch lg:space-y-0 lg:space-x-[60px]">

        <div class="w-full max-w-[415px] space-y-[30px]">
            <h2 class="rem-text-40 montserrat-semibold text-black">
                {{ $method=="checkout" ? __('frontend.auth.member_checkout') : __('frontend.auth.login')}}
            </h2>

            <hr class="h-[2px] w-full bg-rembrown" />

            <!-- Buttons to change login method -->
            <div class="flex flex-col sm:flex-row gap-[20px]">
                <div class="flex gap-[10px]">
                    <div class="rounded-full w-[24px] h-[24px] flex flex-shrink-0 justify-center items-center relative">
                        <input id="email-login" aria-labelledby="Email Address" {{ old('login_method') == "email" ? 'checked' : 'checked' }} type="radio" name="login-method" value="email" class="peer appearance-none focus:opacity-100 focus:ring-2 focus:ring-offset-2 focus:ring-rembrown focus:outline-none border rounded-full border-transparent absolute cursor-pointer w-full h-full checked:border-none" />

                        <div class="hidden peer-checked:block w-[24px] h-[24px]">
                            <img src="{{ asset('frontend/img/radio-checked.svg') }}" alt="Checked" />
                        </div>

                        <div class="block peer-checked:hidden w-[24px] h-[24px]">
                            <img src="{{ asset('frontend/img/radio-unchecked.svg') }}" alt="Unchecked" />
                        </div>

                    </div>

                    <label id="Email Address" class="rem-text-18 montserrat text-remdark cursor-pointer" for="email-login">{{__('frontend.auth.email_address')}}</label>

                </div>

                <div class="flex gap-[10px]">
                    <div class="rounded-full w-[24px] h-[24px] flex flex-shrink-0 justify-center items-center relative">
                        <input id="phone-login" aria-labelledby="Phone No" type="radio" name="login-method" value="phone" {{ old('login_method') == "phone" ? 'checked' : '' }} class="peer appearance-none focus:opacity-100 focus:ring-2 focus:ring-offset-2 focus:ring-rembrown focus:outline-none border rounded-full border-transparent absolute cursor-pointer w-full h-full checked:border-none" />

                        <div class="hidden peer-checked:block w-[24px] h-[24px]">
                            <img src="{{ asset('frontend/img/radio-checked.svg') }}" alt="Checked" />
                        </div>

                        <div class="block peer-checked:hidden w-[24px] h-[24px]">
                            <img src="{{ asset('frontend/img/radio-unchecked.svg') }}" alt="Unchecked" />
                        </div>

                    </div>

                    <label id="Phone No" class="rem-text-18 montserrat text-remdark cursor-pointer" for="phone-login">{{__('frontend.auth.phone_no')}}</label>

                </div>
            </div>
            @error('invalid')
            <p style="color:red">{{ $message }}</p>
            @enderror
            <form action="{{ route('front.login-post') }}" id="login-form" class="space-y-[30px]" method="POST">
                @csrf
                <input type="hidden" name="login_method" id="login_method" value="email">
                <input type="hidden" name="is_checkout" id="login_method" value="{{ $method }}">
                <div class="email-form-group">
                    <div class="w-full space-y-[10px] @error('email') rem-error @enderror">
                        <label for="email" class="block rem-text-18 text-remdark">{{__('frontend.auth.email_address')}}<span class="text-rembrown " aria-label="required">*</span>
                        </label>

                        <input type="email" id="email" name="email" placeholder="" value="{{ old('email') }}" class="w-full h-[52px] border border-remDF px-[21px] py-[13px] rem-text-16 montserrat text-remdark focus:bg-[#F3EFEA] focus:outline-none" />
                        @error('email')
                        <p class="rem-text-14 text-remred" id="email-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="phone-form-group hidden space-y-[30px]">

                    <div component-name="rem-select-box" class="w-full space-y-[10px] @error('country_code') rem-error @enderror country_selectbox">
                        <label for="country-code" class="rem-text-18 text-remdark">Country Code<span class="text-rembrown @@star">*</span></label>
                        <div type="button" class="custom-select-container w-full relative rem-text-16 montserrat text-remdark select-none">
                            <input type="text" name="country_code" id="country-code" hidden />
                            <select class="hidden">
                                @foreach (config('general.'.lngKey().'_codes') as $key => $country)
                                    <option value="{{ $key }}" {{ old('country_code') == $key ? 'selected' : '' }}>{{ $country }}
                                    </option>
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

                    <div class="w-full space-y-[10px]  @error('phone') rem-error @enderror">
                        <label for="phone" class="block rem-text-18 text-remdark">{{__('frontend.auth.phone_no')}}<span class="text-rembrown " aria-label="required">*</span>
                        </label>

                        <input type="tel" id="phone" name="phone" placeholder="" value="{{ old('phone') ?? array_key_first(config('general.'.lngKey().'_codes')) }}" class="w-full h-[52px] border border-remDF px-[21px] py-[13px] rem-text-16 montserrat text-remdark focus:bg-[#F3EFEA] focus:outline-none" />

                        @error('phone')
                        <p class="rem-text-14 text-remred " id="phone-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="w-full space-y-[10px] @error('password') rem-error @enderror">
                    <label for="password" class="block rem-text-18 text-remdark">{{__('frontend.auth.password')}}<span class="text-rembrown " aria-label="required">*</span>
                    </label>

                    <input type="password" id="password" name="password" placeholder="" class="w-full h-[52px] border border-remDF px-[21px] py-[13px] rem-text-16 montserrat text-remdark focus:bg-[#F3EFEA] focus:outline-none" />
                    @error('password')
                    <p class="rem-text-14 text-remred" id="password-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-between gap-[20px] flex-wrap">
                    <div>
                        <label for="remember-me" class="flex items-start relative">
                            <input type="checkbox" id="remember-me" name="remember-me" value="remember-me" class="peer absolute w-[20px] h-[20px] appearance-none">
                            <span class="block peer-checked:hidden flex-shrink-0 rounded-[2px] w-[20px] h-[20px]  border border-black peer-focus:outline peer-focus:outline-1 peer-focus:outline-offset-1 peer-focus:outline-rembrown"></span>

                            <span class="hidden peer-checked:flex flex-shrink-0 rounded-[2px] w-[20px] h-[20px] items-center justify-center text-white border border-rembrown bg-rembrown peer-focus:outline peer-focus:outline-1 peer-focus:outline-offset-1 peer-focus:outline-rembrown">&#10003;</span>

                            <span class="ml-[10px] rem-text-18 montserrat text-black">{{__('frontend.auth.remember_me')}}</span>
                        </label>
                        <p class="hidden rem-text-14 text-remred">{{__('frontend.auth.please_check')}}</p>
                    </div>

                    <a href="{{ route('front.forget.password') }}" class="rem-text-16 montserrat text-remdark hover:underline">
                        {{__('frontend.auth.forgot_password')}}<span class="text-rembrown">*</span>
                    </a>
                </div>

                <div class="w-full overflow-hidden">
                    <div class="g-recaptcha" data-sitekey="{{ config('general.captcha_sitekey') }}"></div>
                </div>
                @error('g-recaptcha-response')
                <p class="rem-text-14 text-remred" id="password-error">{{ $message }}</p>
                @enderror

                <div class="">
                    <button type="submit" class="w-full py-[16px] bg-rembrown text-white border border-rembrown montserrat-semibold rem-text-18 uppercase transition hover:bg-transparent hover:text-rembrown">{{__('frontend.auth.login')}}</button>
                </div>

            </form>
        </div>
        <div class="hidden lg:block w-[1px] bg-remDF"></div>

        <div class="w-full max-w-[415px]">
            <h2 class="rem-text-40 montserrat-semibold text-black text-center">
                {{ $method=="checkout" ? __('frontend.auth.guest_checkout') : __('frontend.auth.register') }}
            </h2>

            <hr class="my-[30px] h-[2px] w-full bg-rembrown" />

            <p class="montserrat rem-text-18 mb-[20px]">{{ $method=="checkout" ? __('frontend.auth.faster_checkout_experience') : __('frontend.auth.create_now') }}</p>

            <a href="{{ $method=='checkout' ? route('front.checkout') : route('front.register')  }}" class="block w-full py-[16px] bg-rembrown text-white text-center border border-rembrown montserrat-semibold rem-text-18 uppercase transition hover:bg-transparent hover:text-rembrown">
                {{ $method=="checkout" ? __('frontend.auth.checkout_as_guest') : __('frontend.auth.create_an_account') }}
            </a>
        </div>

    </div>
</div>

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('input[name="login-method"]').change(function() {
            var selectedAccount = $('input[name="login-method"]:checked').val();
            $('#login_method').val(selectedAccount);
        })
    });
</script>
@endpush