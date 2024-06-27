@extends('frontend.layouts.master')
@section ('content')
    <div component-name="rem-paymentunsuccessful" class="container200 py-10 md:py-100">
        <div class="lg:px-20 3xl:px-[200px]">
            <p class="montserrat-semibold rem-text-40 text-remdark pb-8 lg:pb-20 xl:pb-100 text-center">{{ __('frontend.checkout.sorry_payment') }}
            <span class="text-remred">{{ __('frontend.checkout.failed') }}!</span></p>
            <img src="{{ asset('frontend/img/warning 1.png') }}" alt="" class="mx-auto">
            <p class="montserrat rem-text-18 text-blackcustom pt-6 lg:pt-10">{{ __('frontend.checkout.different_payment_method') }}</p>
        </div>
    </div>
@endsection