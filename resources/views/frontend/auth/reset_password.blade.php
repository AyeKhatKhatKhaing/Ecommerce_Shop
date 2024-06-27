@extends('frontend.layouts.master')
@section('content')
    <div component-name="rem-forgotpassword" class="rem-container160 py-60 lg:py-20 4xl:py-200">
        <div class="lg:max-w-[851px] mx-auto">
            <p class="rem-text-40 montserrat-semibold text-black text-center">{{__('frontend.auth.create_new_password')}}</p>
            <hr class="my-[30px] h-[2px] w-full bg-rembrown">
            <p class="rem-text-18 montserrat text-black text-center pb-7">{{__('frontend.auth.previous_used_password')}}</p>

            <form action="{{ route('front.reset.password.post') }}" method="POST">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <input type="hidden" name="email" value="{{ $email }}">

                <div>
                    <label for="password" class="block pb-2 montserrat rem-text-18 text-remdark">{{__('frontend.auth.password')}}*</label>
                    <input type="password" id="password" name= "password" value="{{ old('password') }}"
                        class="border border-remDF p-3 h-[54px] w-full rem-text-16 montserrat @error('password') rem-errorborder @enderror ">
                        @error('password')
                        <p class="text-remred rem-text-16 montserrat">{{ $message }}</p>
                        @enderror
                </div>

                <div class="pt-5">
                    <label for="confirm-password" class="block pb-2 montserrat rem-text-18 text-remdark">{{__('frontend.auth.confirm_password')}}*</label>
                    <input type="password" id="confirm-password" name="password_confirmation"
                        class="border border-remDF p-3 h-[54px] w-full rem-text-16 montserrat @error('password') rem-errorborder @enderror ">
                        @error('password')
                        <p class="text-remred rem-text-16 montserrat">{{ $message }}</p>
                        @enderror
                </div>
                <button type="submit"
                    class="w-full py-4 px-3 montserrat-semibold uppercase bg-rembrown mt-7 rem-text-18 text-whitez">{{__('frontend.auth.reset_password')}}</button>
            </form>
        </div>
    </div>
@endsection