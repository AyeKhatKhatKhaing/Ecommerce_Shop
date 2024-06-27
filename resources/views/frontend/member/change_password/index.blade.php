@extends('frontend.layouts.master')
@section('seo')
    <title>{{ __('frontend.seo.member_password.title') }}</title>
    <meta property="og:title" content="{{ __('frontend.seo.member_password.meta_title') }}" />
    <meta name="description" content="{{ __('frontend.seo.member_password.meta_description') }}">
    <meta property="og:description" content="{{ __('frontend.seo.member_password.meta_description') }}" />
    <meta property="og:url"content="{{ route('front.member.change.password') }}" />
    <meta property="og:locale" content="{{ lngKey() }}">
    <meta property="og:image" content="">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="">
@endsection
@section('content')
<div component-name="rem-changepassword" class="memberdashboard member-coupons">
    @include('frontend.member.layouts.breadcrumb')

    <div class="container200 pt-5 md:pt-60 pb-10 md:pb-100 flex flex-col-reverse lg:flex-row xl:gap-[60px]">
        @include('frontend.member.layouts.sidebar')
        <div class=" lg:flex-[none] lg:w-[70%]">
            <p class="member-title montserrat-bold text-black pb-5 md:pb-10">{{ __('frontend.member.change_password') }}</p>
            @if(session('success'))
                <p class="rem-text-14" style="color:green">{{ session('success') }}</p>
            @endif
            <form action="{{ route('front.member.update.password') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 pb-[10px] xl:gap-5">
                    <div class="pb-3 md:pb-0 md:mr-3 xl:mr-0">
                        <label for="" class="block pb-2 montserrat rem-text-18 text-remdark">{{ __('frontend.member.old_password') }}<span class="hidden text-remred">*</span></label>
                        <div class="relative">
                            <span id="dummy" class="absolute left-5 top-[60%] -translate-y-1/2"></span>
                            <input type="password" placeholder="" class="w-full border border-remDF montserrat rem-text-18 py-2 px-5 rem-password focus-visible:outline-none" name="current_password">
                            <img src="{{ asset('frontend/img/psw-eyeoff.svg') }}" alt="password eye" class="absolute right-5 top-1/2 -translate-y-1/2 cursor-pointer psw-icon">
                        </div>
                        @error('current_password')
                            <p class="rem-text-14 text-remred" id="confirm-password-error">{{ $message }}</p>
                        @enderror
                        @if(session('error'))
                            <p class="rem-text-14 text-remred" id="confirm-password-error">{{ session('error') }}</p>
                        @endif
                    </div>
                    <div class="">
                        <label for="" class="block pb-2 montserrat rem-text-18 text-remdark">{{ __('frontend.member.new_password') }} <span class="hidden text-remred">*</span></label>
                        <div class="relative">
                            <span id="dummy" class="absolute left-5 top-[60%] -translate-y-1/2"></span>
                            <input type="password" placeholder="" class="w-full border border-remDF montserrat rem-text-18 py-2 px-5 rem-password focus-visible:outline-none" name="new_password">
                            <img src="{{ asset('frontend/img/psw-eyeoff.svg') }}" alt="password eye" class="absolute right-5 top-1/2 -translate-y-1/2 cursor-pointer psw-icon">
                        </div>
                        @error('new_password')
                            <p class="rem-text-14 text-remred" id="confirm-password-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 pb-[10px] xl:gap-5">
                    <div class="md:mr-3 xl:mr-0">
                        <label for="" class="block pb-2 montserrat rem-text-18 text-remdark">{{ __('frontend.member.confirm_password') }}
                            <span class="hidden text-remred">*</span></label>
                        <div class="relative">
                            <span id="dummy" class="absolute left-5 top-[60%] -translate-y-1/2"></span>
                            <input type="password" placeholder="" class="w-full border border-remDF montserrat rem-text-18 py-2 px-5 rem-password focus-visible:outline-none" name="password_confirmation">
                            <img src="{{ asset('frontend/img/psw-eyeoff.svg') }}" alt="password eye" class="absolute right-5 top-1/2 -translate-y-1/2 cursor-pointer psw-icon">
                        </div>
                        @error('new_password')
                            <p class="rem-text-14 text-remred" id="confirm-password-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex flex-col-reverse sm:flex-row items-center xl:gap-[10px] pt-7 md:pt-10">
                    <a href="{{ route('front.member.dashboard') }}">
                        <button type="button" class="border border-rembrown py-3 px-5 sm:min-w-[140px] hover:bg-rembrown hover:text-mainyellow rem-text-16 text-rembrown montserrat-semibold sm:mr-4 xl:mr-0 w-full sm:w-auto">{{ __('frontend.member.cancel') }}</button>
                    </a>
                    <button type="submit" class="border border-rembrown py-3 px-5 bg-rembrown rem-text-16 text-whitez montserrat-semibold w-full sm:w-auto mb-5 sm:mb-0">
                        {{ __('frontend.member.update_password') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection