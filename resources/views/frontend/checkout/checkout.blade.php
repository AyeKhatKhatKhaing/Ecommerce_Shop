@extends('frontend.layouts.master')
@section('seo')
    <title>{{ isset($page) && isset($page->meta_titles) ? $page->meta_titles[lngKey()] : '' }}</title>
    <meta property="og:title" content="{{ isset($page) && isset($page->meta_titles) ? $page->meta_titles[lngKey()] : '' }}" />
    <meta name="description" content="{{ isset($page) && isset($page->meta_descriptions) ? $page->meta_descriptions[lngKey()] : '' }}">
    <meta property="og:description" content="{{ isset($page) && isset($page->meta_descriptions) ? $page->meta_descriptions[lngKey()] : '' }}" />
    <meta property="og:url"content="{{ route('front.checkout') }}" />
    <meta property="og:locale" content="{{ lngKey() }}">
    <meta property="og:image" content="{{ isset($page) ? asset($page->meta_image) : '' }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="{{ isset($page) ? $page->meta_image_alt : '' }}">
@endsection
@section('content')
@php
    $locale_name  =  'name_'.lngKey();
@endphp
<div component-name="rem-banner">
    <div class="relative">
        <img src="{{ asset(isset($page) ? $page->image : '') }}" class="min-h-[200px] object-cover lg:min-h-auto w-full" alt="{{ isset($page) ? $page->image_alt : '' }}">
        <p class="banner-text text-whitez montserrat-bold absolute left-1/2 top-1/2 -translate-y-1/2 -translate-x-1/2">
            {{ isset($page) ? $page->titles[lngKey()] : '' }}</p>
    </div>

</div>
<div component-name="rem-checkout-guest" class="rem-checkout-guest">
    <div class="rem-cart-container">
        <form action="{{ route('front.checkout.order') }}" method="post" id="order-form" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 lg:grid-cols-3 lg:gap-5">
                <div class="col-span-2">
                    <p class="rem-checkout-guest-title">{{ __('frontend.checkout.delivery_information') }}</p>
                    <!-- Buttons to change checkout method -->
                    <div class="flex flex-col sm:flex-row gap-[20px] my-[20px]">
                        <div class="flex gap-[10px]">
                            <div class="rounded-full w-[24px] h-[24px] flex flex-shrink-0 justify-center items-center relative">
                                <input id="delivery" aria-labelledby="Delivery" {{ old('delivery_type') == 'store_pick_up' ? '' : 'checked' }} type="radio" name="delivery_type" value="delivery" class="peer appearance-none focus:opacity-100 focus:ring-2 focus:ring-offset-2 focus:ring-rembrown focus:outline-none border rounded-full border-transparent absolute cursor-pointer w-full h-full checked:border-none" />
                                
                                <div class="hidden peer-checked:block w-[24px] h-[24px]">
                                    <img src="{{ asset('frontend/img/radio-checked.svg') }}" alt="Checked" />
                                </div>

                                <div class="block peer-checked:hidden w-[24px] h-[24px]">
                                    <img src="{{ asset('frontend/img/radio-unchecked.svg') }}" alt="Unchecked" />
                                </div>
                            </div>

                            <label id="Delivery" class="rem-text-18 montserrat text-remdark cursor-pointer" for="delivery">{{ __('frontend.checkout.delivery') }}</label>

                        </div>

                        <div class="flex gap-[10px]">
                            <div class="rounded-full w-[24px] h-[24px] flex flex-shrink-0 justify-center items-center relative">
                                <input id="pick-up" aria-labelledby="Store Pick Up" type="radio" {{ old('delivery_type') == 'store_pick_up' ? 'checked' : '' }} name="delivery_type" value="store_pick_up" class="peer appearance-none focus:opacity-100 focus:ring-2 focus:ring-offset-2 focus:ring-rembrown focus:outline-none border rounded-full border-transparent absolute cursor-pointer w-full h-full checked:border-none" />

                                <div class="hidden peer-checked:block w-[24px] h-[24px]">
                                    <img src="{{ asset('frontend/img/radio-checked.svg') }}" alt="Checked" />
                                </div>

                                <div class="block peer-checked:hidden w-[24px] h-[24px]">
                                    <img src="{{ asset('frontend/img/radio-unchecked.svg') }}" alt="Unchecked" />
                                </div>
                            </div>

                            <label id="Store Pick Up" class="rem-text-18 montserrat text-remdark cursor-pointer" for="pick-up">{{ __('frontend.checkout.store_pick_up') }}</label>

                        </div>
                    </div>
                    <div id="deli" class="@if (old('delivery_type') == 'store_pick_up') hidden @endif">
                        {{-- <form action="#" id="checkout-delivery-form" class=""> --}}
                            <div class="my-5">
                                <div component-name="rem-select-box" class="w-full space-y-[10px] ">
                                    <label for="location" class="rem-text-18 text-remdark">{{ __('frontend.checkout.select_location') }}<span class="text-rembrown hidden">*</span></label>
                                    <div type="button" class="custom-select-container w-full relative rem-text-16 montserrat text-remdark select-none">
                                        <input type="text" name="location" id="location" value="{{ area() == 'hk' ? 'Hong Kong' : 'Macau' }}" hidden />
                                        <select class="hidden">
                                            @if (area() == 'hk')
                                                <option value="Hong Kong">{{ __('frontend.checkout.hong_kong') }}
                                                </option>
                                            @else
                                                <option value="Macau">{{ __('frontend.checkout.macau') }}
                                                </option>
                                            @endif
                                        </select>
                                        <div class="select-arrow absolute top-[23px] right-[21px] w-[12px] h-[6px] pointer-events-none">
                                            <img src="{{ asset('frontend/img/arrow-down.svg') }}" alt="Arrow Down" />
                                        </div>
                                    </div>
                                    <p class="rem-text-14 text-remred hidden"></p>
                                </div>
                            </div>
                            <div class="my-5 des">
                                {!! isset($page) ? $page->descriptions[lngKey()] : '' !!}
                            </div>
                            <div class="my-[20px]">
                                <div class="w-full space-y-[10px] @error('billing_address') rem-error @enderror">
                                    <label for="address" class="block rem-text-18 text-remdark">{{ __('frontend.checkout.street_address') }}<span class="text-rembrown ">*</span>
                                    </label>

                                    <input type="text" id="address" name="billing_address" value="{{ isset($member) && isset($member->member_address) ? $member->member_address->billing_address['address'] : old('billing_address') }}" placeholder="House number and street name" class="w-full h-[52px] border border-remDF px-[21px] py-[13px] rem-text-16 montserrat text-remdark focus:bg-[#F3EFEA] focus:outline-none" />
                                    @error('billing_address')
                                        <p class="rem-text-14 text-remred" id="address-error">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="my-[20px]">
                                <div class="w-full space-y-[10px] @error('billing_address_detail') rem-error @enderror">
                                    <label for="apartment" class="block rem-text-18 text-remdark"><span class="text-rembrown hidden">*</span>
                                    </label>

                                    <input type="text" id="apartment" name="billing_address_detail" value="{{ isset($member) && isset($member->member_address) ? $member->member_address->billing_address['address_detail'] : old('billing_address_detail') }}" placeholder="Apartment, suite, unit, etc." class="w-full h-[52px] border border-remDF px-[21px] py-[13px] rem-text-16 montserrat text-remdark focus:bg-[#F3EFEA] focus:outline-none" />
                                    @error('billing_address_detail')
                                        <p class="rem-text-14 text-remred" id="apartment-error">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="my-[20px] grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div>
                                    <div class="w-full space-y-[10px]  @error('billing_first_name') rem-error @enderror">
                                        <label for="first-name" class="block rem-text-18 text-remdark">{{ __('frontend.checkout.first_name') }}
                                        <span class="text-rembrown ">*</span>
                                        </label>

                                        <input type="text" id="first-name" value="{{ isset($member) && isset($member->member_address) && isset($member->member_address->billing_address) ? $member->member_address->billing_address['first_name'] : $member->first_name ?? old('billing_first_name') }}" name="billing_first_name" placeholder="" class="w-full h-[52px] border border-remDF px-[21px] py-[13px] rem-text-16 montserrat text-remdark focus:bg-[#F3EFEA] focus:outline-none" />
                                        @error('billing_first_name')
                                            <p class="rem-text-14 text-remred" id="first-name-error">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div>
                                    <div class="w-full space-y-[10px]  @error('billing_last_name') rem-error @enderror">
                                        <label for="last-name" class="block rem-text-18 text-remdark">{{ __('frontend.checkout.last_name') }}
                                        <span class="text-rembrown ">*</span>
                                        </label>

                                        <input type="text" id="last-name" value="{{ isset($member) && isset($member->member_address) && isset($member->member_address->billing_address) ? $member->member_address->billing_address['last_name'] : $member->last_name ?? old('billing_last_name') }}" name="billing_last_name" placeholder="" class="w-full h-[52px] border border-remDF px-[21px] py-[13px] rem-text-16 montserrat text-remdark focus:bg-[#F3EFEA] focus:outline-none" />
                                        @error('billing_last_name')
                                            <p class="rem-text-14 text-remred" id="last-name-error">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div component-name="rem-select-box"
                                    class="w-full space-y-[10px] country_selectbox @error('billing_country_code') rem-error @enderror">
                                    <label for="country-code" class="rem-text-18 text-remdark">{{ __('frontend.checkout.country_code') }}<span
                                            class="text-rembrown @@star">*</span></label>
                                    <div type="button"
                                        class="custom-select-container w-full relative rem-text-16 montserrat text-remdark select-none">
                                        <input type="text" name="billing_country_code" id="country-code" value="{{ isset($member) && $member->country_code ? $member->country_code : old('billing_country_code') }}" hidden />
                                        <select class="hidden">
                                            @foreach (config('general.'.lngKey().'_codes') as $key => $country)
                                                <option value="{{ $key }}" {{ old('billing_country_code') == $key || isset($member) && $member->country_code == $key ? 'selected' : ($loop->first ? 'selected' : '') }}>{{ $country }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div
                                            class="select-arrow absolute top-[23px] right-[21px] w-[12px] h-[6px] pointer-events-none">
                                            <img src="{{ asset('frontend/img/arrow-down.svg') }}" alt="Arrow Down" />
                                        </div>
                                    </div>
                                    @error('billing_country_code')
                                        <p class="rem-text-14 text-remred hidden">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <div class="w-full space-y-[10px]  @error('billing_phone') rem-error @enderror">
                                        <label for="phone" class="block rem-text-18 text-remdark">{{ __('frontend.checkout.phone') }}<span class="text-rembrown ">*</span>
                                        </label>

                                        <input type="text" id="phone" value="{{ isset($member) && isset($member->member_address) && isset($member->member_address->billing_address) ? $member->member_address->billing_address['phone'] : $member->phone ?? old('billing_phone') }}" name="billing_phone" placeholder="" class="w-full h-[52px] border border-remDF px-[21px] py-[13px] rem-text-16 montserrat text-remdark focus:bg-[#F3EFEA] focus:outline-none" />
                                        @error('billing_phone')
                                            <p class="rem-text-14 text-remred " id="phone-error">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="w-full space-y-[10px] @error('billing_email') rem-error @enderror">
                                    <label for="email" class="block rem-text-18 text-remdark">{{ __('frontend.checkout.email_address') }}<span class="text-rembrown ">*</span>
                                    </label>

                                    <input type="email" id="email" value="{{ isset($member) && isset($member->member_address) && isset($member->member_address->billing_address) ? $member->member_address->billing_address['email'] : $member->email ?? old('billing_email') }}" name="billing_email" placeholder="" class="w-full h-[52px] border border-remDF px-[21px] py-[13px] rem-text-16 montserrat text-remdark focus:bg-[#F3EFEA] focus:outline-none" />
                                    @error('billing_email')
                                        <p class="rem-text-14 text-remred" id="email-error">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="my-[20px] flex items-center">
                                <label class="rem-checkout-guest-different" for="diff-address">
                                    {{ __('frontend.checkout.different_address') }}
                                    <input type="checkbox" id="diff-address" name="is_shipping_address" value="shipping_address" @if (old('is_shipping_address')) checked @endif />
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div id="diff-address-blog" class="hidden">
                                <div class="my-[20px] grid grid-cols-1 md:grid-cols-2 gap-5">
                                    <div>
                                        <div class="w-full space-y-[10px] @error('shipping_first_name') rem-error @enderror">
                                            <label for="add-first-name" class="block rem-text-18 text-remdark">{{ __('frontend.checkout.first_name') }}
                                            <span class="text-rembrown ">*</span>
                                            </label>

                                            <input type="text" id="add-first-name" name="shipping_first_name" value="{{ isset($member) && isset($member->member_address) && isset($member->member_address->shipping_address) ? $member->member_address->shipping_address['first_name'] : old('shipping_first_name') }}" placeholder="" class="w-full h-[52px] border border-remDF px-[21px] py-[13px] rem-text-16 montserrat text-remdark focus:bg-[#F3EFEA] focus:outline-none" />
                                            @error('shipping_first_name')
                                                <p class="rem-text-14 text-remred" id="add-first-name-error">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div>
                                        <div class="w-full space-y-[10px] @error('shipping_last_name') rem-error @enderror">
                                            <label for="add-last-name" class="block rem-text-18 text-remdark">
                                                {{ __('frontend.checkout.last_name') }}
                                            <span class="text-rembrown ">*</span>
                                            </label>

                                            <input type="text" id="add-last-name" name="shipping_last_name" value="{{ isset($member) && isset($member->member_address) && isset($member->member_address->shipping_address) ? $member->member_address->shipping_address['last_name'] : old('shipping_last_name') }}" placeholder="" class="w-full h-[52px] border border-remDF px-[21px] py-[13px] rem-text-16 montserrat text-remdark focus:bg-[#F3EFEA] focus:outline-none" />
                                            @error('shipping_last_name')
                                                <p class="rem-text-14 text-remred hidden" id="add-last-name-error">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="my-[20px]">
                                    <div class="w-full space-y-[10px] @error('shipping_address') rem-error @enderror">
                                        <label for="add-address" class="block rem-text-18 text-remdark">{{ __('frontend.checkout.street_address') }}
                                        <span class="text-rembrown ">*</span>
                                        </label>

                                        <input type="text" id="add-address" name="shipping_address" value="{{ isset($member) && isset($member->member_address) && isset($member->member_address->shipping_address) ? $member->member_address->shipping_address['address'] : old('shipping_address') }}" placeholder="House number and street name" class="w-full h-[52px] border border-remDF px-[21px] py-[13px] rem-text-16 montserrat text-remdark focus:bg-[#F3EFEA] focus:outline-none" />
                                        @error('shipping_address')
                                            <p class="rem-text-14 text-remred hidden" id="add-address-error">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="my-[20px]">
                                    <div class="w-full space-y-[10px]  @error('shipping_address_detail') rem-error @enderror">
                                        <label for="add-apartment" class="block rem-text-18 text-remdark"><span class="text-rembrown hidden">*</span>
                                        </label>

                                        <input type="text" id="add-apartment" name="shipping_address_detail" value="{{ isset($member) && isset($member->member_address) && isset($member->member_address->shipping_address) ? $member->member_address->shipping_address['address_detail'] : old('shipping_address_detail') }}" placeholder="Apartment, suite, unit, etc." class="w-full h-[52px] border border-remDF px-[21px] py-[13px] rem-text-16 montserrat text-remdark focus:bg-[#F3EFEA] focus:outline-none" />

                                        @error('shipping_address_detail')
                                            <p class="rem-text-14 text-remred hidden" id="add-address-error">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="my-[20px] grid grid-cols-1 md:grid-cols-2 gap-5">
                                    <div component-name="rem-select-box"
                                        class="w-full space-y-[10px] country_selectbox @error('shipping_country_code') rem-error @enderror">
                                        <label for="country-code" class="rem-text-18 text-remdark">{{ __('frontend.checkout.country_code') }}<span
                                                class="text-rembrown @@star">*</span></label>
                                        <div type="button"
                                            class="custom-select-container w-full relative rem-text-16 montserrat text-remdark select-none">
                                            <input type="text" name="shipping_country_code" id="country-code" hidden />
                                            <select class="hidden">
                                                @foreach (config('general.'.lngKey().'_codes') as $key => $country)
                                                    <option value="{{ $key }}" {{ old('shipping_country_code') == $key ? 'selected' : ($loop->first ? 'selected' : '') }}>{{ $country }}</option>
                                                @endforeach
                                            </select>
                                            <div
                                                class="select-arrow absolute top-[23px] right-[21px] w-[12px] h-[6px] pointer-events-none">
                                                <img src="{{ asset('frontend/img/arrow-down.svg') }}" alt="Arrow Down" />
                                            </div>
                                        </div>
                                        @error('shipping_country_code')
                                            <p class="rem-text-14 text-remred hidden">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="w-full space-y-[10px] @error('shipping_phone') rem-error @enderror">
                                        <label for="phone" class="block rem-text-18 text-remdark">{{ __('frontend.checkout.phone') }}<span
                                                class="text-rembrown ">*</span>
                                        </label>

                                        <input type="text" id="phone" name="shipping_phone" placeholder="" value="{{ isset($member) && isset($member->member_address) && isset($member->member_address->shipping_address) ? $member->member_address->shipping_address['phone'] : old('shipping_phone') }}"
                                            class="w-full h-[52px] border border-remDF px-[21px] py-[13px] rem-text-16 montserrat text-remdark focus:bg-[#F3EFEA] focus:outline-none" />

                                        @error('shipping_phone')
                                            <p class="rem-text-14 text-remred hidden" id="add-phone-error">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div>
                                    <div class="w-full space-y-[10px] @error('shipping_email') rem-error @enderror">
                                        <label for="add-email" class="block rem-text-18 text-remdark">
                                            {{ __('frontend.checkout.email_address') }}
                                        <span class="text-rembrown ">*</span>
                                        </label>

                                        <input type="email" id="add-email" name="shipping_email" value="{{ isset($member) && isset($member->member_address) && isset($member->member_address->shipping_address) ? $member->member_address->shipping_address['email'] : old('shipping_email') }}" placeholder="" class="w-full h-[52px] border border-remDF px-[21px] py-[13px] rem-text-16 montserrat text-remdark focus:bg-[#F3EFEA] focus:outline-none" />
                                        @error('shipping_email')
                                            <p class="rem-text-14 text-remred hidden" id="add-email-error">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="my-[20px] note">
                                    <label>{{ __('frontend.checkout.order_note') }}</label>
                                    <textarea name="note" rows="4" class="w-full mt-[10px] outline-0">{{ old('note') }}</textarea>
                                </div>
                            </div>
                            {{-- </form> --}}
                    </div>
                    <div id="pickup" class="@if (old('delivery_type') == 'delivery') hidden @endif">
                        <div component-name="rem-pick-up" class="rem-pick-up">
                            {{-- <form action="#" id="checkout-pick-form" class=""> --}}
                                <div class="my-[20px]">
                                    <div component-name="rem-select-box" class="w-full space-y-[10px] @@clz">
                                        <label for="pick-location" class="rem-text-18 text-remdark">
                                            {{ __('frontend.checkout.select_location') }}
                                        <span class="text-rembrown hidden">*</span></label>
                                        <div type="button" class="custom-select-container w-full relative rem-text-16 montserrat text-remdark select-none">
                                            <input type="text" name="pick_location" id="pick-location" value="{{ area() == 'hk' ? 'Hong Kong' : 'Macau' }}" hidden />
                                            <select class="hidden">
                                                @if (area() == 'hk')
                                                    <option value="Hong Kong">{{ __('frontend.checkout.hong_kong') }}
                                                    </option>
                                                @else
                                                    <option value="Macau">{{ __('frontend.checkout.macau') }}
                                                    </option>
                                                @endif
                                            </select>
                                            <div class="select-arrow absolute top-[23px] right-[21px] w-[12px] h-[6px] pointer-events-none">
                                                <img src="{{ asset('frontend/img/arrow-down.svg') }}" alt="Arrow Down" />
                                            </div>
                                        </div>
                                        <p class="rem-text-14 text-remred hidden">@@errortext</p>
                                    </div>
                                </div>
                                <p class="mesg my-[20px]">{{ __('frontend.checkout.contact_customer') }}</p>
                                <div class="my-[20px] methods">
                                    <p class="text mb-[10px]">{{ __('frontend.checkout.store_pick_up') }}:</p>
                                    {{-- <div class="hongkong-pickups"> --}}
                                        @foreach($store_pickups as $pickup)
                                            <div class="mb-[10px]">
                                                <div class="flex gap-[10px]">
                                                    <div class="rounded-full w-[24px] h-[24px] flex flex-shrink-0 justify-center items-center relative">
                                                        <input id="{{ $pickup->id }}" aria-labelledby="{{ langbind( $pickup,'name') }}" value="{{ langbind( $pickup,'name') }}" checked type="radio" name="pick_name" class="peer appearance-none focus:opacity-100 focus:ring-2 focus:ring-offset-2 focus:ring-rembrown focus:outline-none border rounded-full border-transparent absolute cursor-pointer w-full h-full checked:border-none" />

                                                        <div class="hidden peer-checked:block w-[24px] h-[24px]">
                                                            <img src="{{ asset('frontend/img/radio-checked.svg') }}" alt="Checked" />
                                                        </div>

                                                        <div class="block peer-checked:hidden w-[24px] h-[24px]">
                                                            <img src="{{ asset('frontend/img/radio-unchecked.svg') }}" alt="Unchecked" />
                                                        </div>

                                                    </div>

                                                    <label id="{{ langbind( $pickup,'name') }}" class="rem-text-18 montserrat text-remdark cursor-pointer" for="{{ $pickup->id }}">{{ langbind( $pickup,'name') }}</label>

                                                </div>
                                            </div>
                                        @endforeach
                                    {{-- </div> --}}

                                    <div class="my-[20px]">
                                        <div class="w-full space-y-[10px] @@clz">
                                            <label for="pick-address" class="block rem-text-18 text-remdark">
                                                {{ __('frontend.checkout.street_address') }}
                                            <span class="text-rembrown ">*</span>
                                            </label>

                                            <input type="text" id="pick-address" value="{{ old('pick_address') }}" name="pick_address" placeholder="House number and street name" class="w-full h-[52px] border border-remDF px-[21px] py-[13px] rem-text-16 montserrat text-remdark focus:bg-[#F3EFEA] focus:outline-none" />
                                            @error('pick_address')
                                                <p class="rem-text-14 text-remred" id="pick-address-error">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="my-[20px]">
                                        <div class="w-full space-y-[10px] @@clz">
                                            <label for="pick-apartment" class="block rem-text-18 text-remdark"><span class="text-rembrown hidden">*</span>
                                            </label>

                                            <input type="text" id="pick-apartment" name="pick_address_detail" value="{{ old('pick_address_detail') }}" placeholder="Apartment, suite, unit, etc." class="w-full h-[52px] border border-remDF px-[21px] py-[13px] rem-text-16 montserrat text-remdark focus:bg-[#F3EFEA] focus:outline-none" />
                                            @error('pick_address_detail')
                                                <p class="rem-text-14 text-remred" id="pick-apartment-error">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="my-[20px] grid grid-cols-1 md:grid-cols-2 gap-5">
                                        <div>
                                            <div class="w-full space-y-[10px] @@clz">
                                                <label for="pick-first-name" class="block rem-text-18 text-remdark">{{ __('frontend.checkout.first_name') }}<span class="text-rembrown ">*</span>
                                                </label>

                                                <input type="text" id="pick-first-name" name="pick_first_name" value="{{ old('pick_first_name') }}" placeholder="" class="w-full h-[52px] border border-remDF px-[21px] py-[13px] rem-text-16 montserrat text-remdark focus:bg-[#F3EFEA] focus:outline-none" />
                                                @error('pick_first_name')
                                                    <p class="rem-text-14 text-remred" id="pick-first-name-error">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div>
                                            <div class="w-full space-y-[10px] @@clz">
                                                <label for="pick-last-name" class="block rem-text-18 text-remdark">{{ __('frontend.checkout.last_name') }}<span class="text-rembrown ">*</span>
                                                </label>

                                                <input type="text" id="pick-last-name" name="pick_last_name" value="{{ old('pick_last_name') }}" placeholder="" class="w-full h-[52px] border border-remDF px-[21px] py-[13px] rem-text-16 montserrat text-remdark focus:bg-[#F3EFEA] focus:outline-none" />
                                                @error('pick_last_name')
                                                    <p class="rem-text-14 text-remred" id="pick-last-name-error">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div component-name="rem-select-box"
                                            class="w-full space-y-[10px] country_selectbox @error('pick_country_code') rem-error @enderror">
                                            <label for="country-code" class="rem-text-18 text-remdark">{{ __('frontend.checkout.country_code') }}<span class="text-rembrown @@star">*</span></label>
                                            <div type="button"
                                                class="custom-select-container w-full relative rem-text-16 montserrat text-remdark select-none">
                                                <input type="text" name="pick_country_code" id="country-code" hidden />
                                                <select class="hidden">
                                                    @foreach (config('general.'.lngKey().'_codes') as $key => $country)
                                                        <option value="{{ $key }}" {{ old('pick_country_code') == $key ? 'selected' : ($loop->first ? 'selected' : '') }}>{{ $country }}</option>
                                                    @endforeach
                                                </select>
                                                <div
                                                    class="select-arrow absolute top-[23px] right-[21px] w-[12px] h-[6px] pointer-events-none">
                                                    <img src="{{ asset('frontend/img/arrow-down.svg') }}" alt="Arrow Down" />
                                                </div>
                                            </div>
                                            @error('pick_country_code')
                                                <p class="rem-text-14 text-remred hidden">{{ __('frontend.checkout.please_select_one') }}</p>
                                            @enderror
                                        </div>

                                        <div class="w-full space-y-[10px] @error('pick_phone') rem-error @enderror">
                                            <label for="phone" class="block rem-text-18 text-remdark">{{ __('frontend.checkout.phone') }}<span
                                                    class="text-rembrown ">*</span>
                                            </label>

                                            <input type="text" id="phone" name="pick_phone" placeholder="" value="{{ old('pick_phone') }}"
                                                class="w-full h-[52px] border border-remDF px-[21px] py-[13px] rem-text-16 montserrat text-remdark focus:bg-[#F3EFEA] focus:outline-none" />

                                            @error('pick_phone')
                                                <p class="rem-text-14 text-remred" id="pick-phone-error">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="w-full space-y-[10px] @@clz">
                                        <label for="pick-email" class="block rem-text-18 text-remdark">{{ __('frontend.checkout.email_address') }}
                                        <span class="text-rembrown ">*</span>
                                        </label>

                                        <input type="email" id="pick-email" name="pick_email" value="{{ old('pick_email') }}" placeholder="" class="w-full h-[52px] border border-remDF px-[21px] py-[13px] rem-text-16 montserrat text-remdark focus:bg-[#F3EFEA] focus:outline-none" />
                                        @error('pick_email')
                                            <p class="rem-text-14 text-remred" id="pick-email-error">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            {{-- </form> --}}
                        </div>
                    </div>

                </div>
                <div>
                    <div component-name="rem-checkout-guest-card">
                        <div class="py-[24px]  bg-[#F6F1EB] rem-checkout-guest-card">
                            <p class="title pb-5 px-[20px]">{{ __('frontend.checkout.product') }}</p>
                            @if(!blank($cart_items))
                                <div class="rem-checkout-guest-card-inner scrollbar-inner">
                                
                                    @foreach($cart_items as $item)
                                    <div class=" flex flex-col  5xl:flex-row 5xl:items-center md:flex-wrap 3xl:flex-nowrap  mb-[20px]  px-[20px]">
                                        <div class="product mr-[15px] mt-2">
                                            <img src="{{ asset($item->product_image) }}" class="max-w-[109px] h-[100px] object-cover" />
                                        </div>
                                        <div class="col-span-2 desc max-w-[214px] mr-[15px] mt-2">
                                            <p class="name">{{ $item->product_name }}</p>
                                            <p class="qty">Qty: <span>{{ $item->quantity }}</span></p>
                                        </div>
                                        <div class="price mt-2">
                                            <p>{{ currency() }} {{ $item->amount }}</p>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="product-table pt-5 px-[20px]">
                                    <table>
                                        <tr>
                                            <td>{{ __('frontend.checkout.subtotal') }}</td>
                                            <td>{{ currency() }} {{ $total_amounts }}.00</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('frontend.checkout.shipping') }}</td>
                                            <td>{{ currency() }} {{ $shipping_fee ==0 ? 'Free Shipping' : $shipping_fee }}</td>
                                        </tr>
                                        <tr class="checkout_coupon">
                                            <td>{{ __('frontend.checkout.coupon') }}</td>
                                            <td>- {{ currency() }} <span class="adminCouponAmount">{{ $coupon_amount ?? 0.00 }}</span></td>
                                        </tr>
                                        <tr>
                                            <td>Total</td>
                                            <td class="price"><span>{{ currency() }} </span><span class="adminCheckSubTotal">{{ $overall_amount }}.00</span></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="select-menu mt-5 mx-5">
                                    <input type="hidden" name="total_quantity" value="{{ $total_quantity ? $total_quantity : 0 }}">
                                    <input type="hidden" name="shipping_amount" id="shipping-amount" value="{{ $shipping_fee }}">
                                    <input type="hidden" name="original_total_amount" id="original-total-amount" value="{{ $original_total_amount }}">
                                    <input type="hidden" name="original_sub_total" id="original-sub-total" value="{{ $overall_amount }}">
                                    <input type="hidden" name="update_check_sub_total" id="update-check-sub-total">
                                    <input type="hidden" name="coupon_amount" id="coupon-amount" value="{{ $coupon_amount }}">
                                    <input type="hidden" id="coupon-code" name="check_coupon_code" value="{{ isset($coupon_code) ? $coupon_code : '' }}" />
                                    <input type="hidden" id="coupon-id" name="coupon_id" value="{{ isset($coupon_id) ? $coupon_id : '' }}">
                                    <input type="hidden" id="coupon-his-id" name="coupon_his_id" value="{{ isset($coupon_his_id) ? $coupon_his_id : '' }}">
                                    <input type="hidden" id="no-coupon" name="no_coupon">
                                    <div class="select-btn @if(!auth('member')->check()) rem-disabled @endif">
                                        <span class="adminSelectText sBtn-text">{{ isset($coupon_code) ? $coupon_code : 'Select your option' }}</span>
                                        <div class="flex items-center">
                                            <span class="adminCouponStatus pr-3 {{ isset($coupon_code) ? $coupon_code : 'hidden' }} s-value-remove">    
                                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
                                                    <path d="M11.2502 0.758276C11.1731 0.681023 11.0815 0.619733 10.9807 0.577915C10.8799 0.536097 10.7718 0.514572 10.6627 0.514572C10.5535 0.514572 10.4455 0.536097 10.3447 0.577915C10.2439 0.619733 10.1523 0.681023 10.0752 0.758276L6.00019 4.82494L1.92519 0.749942C1.84803 0.67279 1.75644 0.61159 1.65564 0.569836C1.55484 0.528082 1.4468 0.506592 1.33769 0.506592C1.22858 0.506592 1.12054 0.528082 1.01973 0.569836C0.91893 0.61159 0.827338 0.67279 0.750186 0.749942C0.673035 0.827094 0.611835 0.918686 0.57008 1.01949C0.528326 1.12029 0.506836 1.22833 0.506836 1.33744C0.506836 1.44655 0.528326 1.55459 0.57008 1.6554C0.611835 1.7562 0.673035 1.84779 0.750186 1.92494L4.82519 5.99994L0.750186 10.0749C0.673035 10.1521 0.611835 10.2437 0.57008 10.3445C0.528326 10.4453 0.506836 10.5533 0.506836 10.6624C0.506836 10.7716 0.528326 10.8796 0.57008 10.9804C0.611835 11.0812 0.673035 11.1728 0.750186 11.2499C0.827338 11.3271 0.91893 11.3883 1.01973 11.43C1.12054 11.4718 1.22858 11.4933 1.33769 11.4933C1.4468 11.4933 1.55484 11.4718 1.65564 11.43C1.75644 11.3883 1.84803 11.3271 1.92519 11.2499L6.00019 7.17494L10.0752 11.2499C10.1523 11.3271 10.2439 11.3883 10.3447 11.43C10.4455 11.4718 10.5536 11.4933 10.6627 11.4933C10.7718 11.4933 10.8798 11.4718 10.9806 11.43C11.0814 11.3883 11.173 11.3271 11.2502 11.2499C11.3273 11.1728 11.3885 11.0812 11.4303 10.9804C11.472 10.8796 11.4935 10.7716 11.4935 10.6624C11.4935 10.5533 11.472 10.4453 11.4303 10.3445C11.3885 10.2437 11.3273 10.1521 11.2502 10.0749L7.17519 5.99994L11.2502 1.92494C11.5669 1.60828 11.5669 1.07494 11.2502 0.758276Z" fill="black"/>
                                                </svg>
                                            </span>
                                            <img src="{{ asset('frontend/img/arrow-down.svg') }}" class="" />
                                        </div>
                                    </div>
                                    <ul class="options">
                                        @if($member_coupons)
                                            @foreach($member_coupons as $coupon)
                                                <li class="adminCheckCoupon option" data-couponHisId="{{ $coupon->id }}" data-couponId="{{ $coupon->coupon_id }}" data-couponCode="{{ $coupon->coupon->code }}">
                                                    <span class="option-text">{{ $coupon->coupon->code }}</span>
                                                    {{-- <span class="">{{ $coupon->coupon->descriptions[lngKey()] }}</span> --}}
                                                </li>
                                            @endforeach
                                        @endif
                                    
                                    </ul>
                                </div>
                                <span class="adminCouponMessage"></span>
                                <div class="apply-btn mt-[10px] mb-[20px] px-[20px] @if(!auth('member')->check()) rem-disabled @endif">
                                    <button type="button" class="adminCheckApplyCoupon w-full px-[21px] py-[13px] bg-[#54301A] text-white">{{ __('frontend.checkout.apply_coupon') }}</button>
                                </div>
                            @endif
                            <div class="p-[20px] border border-[#DFDFDF] mb-[20px] px-[20px]">

                                <div class="flex gap-[10px]">
                                    <div class="rounded-full w-[24px] h-[24px] flex flex-shrink-0 justify-center items-center relative">
                                        <input id="payment" aria-labelledby="payment" checked="" type="radio" name="payment" value="recon" class="peer appearance-none focus:opacity-100 focus:outline-none border rounded-full border-transparent absolute cursor-pointer w-full h-full checked:border-none">

                                        <div class="hidden peer-checked:block w-[24px] h-[24px]">
                                            <img src="{{ asset('frontend/img/radio-checked.svg') }}" alt="Checked">
                                        </div>

                                        <div class="block peer-checked:hidden w-[24px] h-[24px]">
                                            <img src="{{ asset('frontend/img/radio-unchecked.svg') }}" alt="Unchecked">
                                        </div>

                                    </div>

                                    <label id="payment" class="rem-text-18 montserrat text-remdark cursor-pointer" for="payment">{{ __('frontend.checkout.recon_payment') }}</label>

                                </div>
                                <div class="flex flex-wrap mt-[20px ml-[36px]">
                                    <img src="{{ asset('frontend/img/visa.png') }}" class="m-1" />
                                    <img src="{{ asset('frontend/img/mastercard.png') }}" class="m-1" />
                                    <img src="{{ asset('frontend/img/jcb.png') }}" class="m-1" />
                                    <img src="{{ asset('frontend/img/alipay.png') }}" class="m-1" />
                                    <img src="{{ asset('frontend/img/wechatpay.png') }}" class="m-1" />
                                    <img src="{{ asset('frontend/img/union.png') }}" />
                                </div>
                            </div>
                            <div class="order px-[20px]">
                                <button type="submit" class="w-full py-[12px] px-[24px]">
                                    {{ __('frontend.checkout.place_order') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        {{-- Begin::Discount Product Section --}}
        @include('frontend.checkout._discount_progress')
        {{-- end::Discount Product Section --}}

    </div>
</div>

{{-- Begin::Discount Product Section --}}
@include('frontend.checkout._discount_product')
{{-- end::Discount Product Section --}}

{{-- Begin::Discount Product Section --}}
@include('frontend.checkout._you_may_interested_in')
{{-- end::Discount Product Section --}}

@endsection

@push('scripts')
<script src="{{ asset('frontend/custom/checkout.js') }}" type="text/javascript"></script>
<script>
    $(document).ready(function() {
       
    });
</script>
@endpush