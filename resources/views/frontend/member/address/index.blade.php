@extends('frontend.layouts.master')
@section('seo')
    <title>{{ __('frontend.seo.member_address.title') }}</title>
    <meta property="og:title" content="{{ __('frontend.seo.member_address.meta_title') }}" />
    <meta name="description" content="{{ __('frontend.seo.member_address.meta_description') }}">
    <meta property="og:description" content="{{ __('frontend.seo.member_address.meta_description') }}" />
    <meta property="og:url"content="{{ route('front.member.address') }}" />
    <meta property="og:locale" content="{{ lngKey() }}">
    <meta property="og:image" content="">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="">
@endsection
@section('content')
<div component-name="rem-address" class="memberdashboard">
    @include('frontend.member.layouts.breadcrumb')
    <div class="container200 pt-5 md:pt-60 pb-10 md:pb-100 flex flex-col-reverse lg:flex-row xl:gap-[60px]">
        @include('frontend.member.layouts.sidebar')
        <div class=" lg:flex-[none] lg:w-[70%]">
            <p class="member-title montserrat-bold text-black pb-5 md:pb-10">{{ __('frontend.member.my_address') }}</p>
            
                <div class="pb-10 last-of-type:pb-0">
                    <div class="flex items-center justify-between pb-4 border-b border-b-[#E1D8CD]">
                        <p class="montserrat-semibold rem-text-18 text-blackcustom">{{ __('frontend.member.billing_address') }}</p>
                        <img src="{{ asset('frontend/img/edit-icon.svg') }}" alt="edit icon" onclick="handleEditIcon(event)" class="cursor-pointer">
                        <div class="hidden flex items-center xl:gap-2">
                            <button type="button" class="py-3 px-5 text-rembrown montserrat-semibold rem-text-16" onclick="handleCancel(event)">{{ __('frontend.member.cancel') }}</button>
                            <button type="button" class="py-3 px-5 bg-rembrown border border-rembrown text-whitez hover:bg-transparent hover:text-rembrown montserrat-semibold rem-text-16" id="billingUpdateBtn">{{ __('frontend.member.update') }}</button>
                        </div>
                    </div>

                    <form class="address-form pt-5" action="{{ route('front.member.store.address') }}" method="post" id="billing-address-form">
                        @csrf
                        <input type="hidden" name="billing_address" value="true">
                        <div>
                            <div class="flex items-center xl:gap-5 pb-4">
                                <p class="montserrat rem-text-18 text-remgray90">{{ __('frontend.member.street_address') }}:</p>
                                <input type="text" placeholder="House number and street name" name="address" value="{{ $member_address->billing_address['address'] ?? '' }}" class="montserrat rem-text-18 text-remdark xl:pl-0 focus-visible:outline-none" readonly />
                            </div>
                        </div>
    
                        <div>
                            <div class="flex items-center xl:gap-5 pb-4">
                                <input type="text" placeholder="Apartment, suite, unit, etc." name="address_detail" value="{{ $member_address->billing_address['address_detail'] ?? '' }}" class="montserrat rem-text-18 text-remdark xl:pl-0 focus-visible:outline-none" readonly />
                            </div>
                        </div>
    
                        <div class="md:grid md:grid-cols-2 pb-4 xl:gap-5">
                            <div class="flex items-center xl:gap-5 pb-4 md:pb-0 md:pr-3 xl:pr-0">
                                <p class="montserrat rem-text-18 text-remgray90">{{ __('frontend.member.first_name') }}:</p>
                                <input type="text" placeholder="First Name" name="first_name" value="{{ $member_address->billing_address['first_name'] ?? '' }}" class="montserrat rem-text-18 text-remdark xl:pl-0 focus-visible:outline-none" readonly />
                            </div>
    
                            <div class="flex items-center xl:gap-5">
                                <p class="montserrat rem-text-18 text-remgray90">{{ __('frontend.member.last_name') }}:</p>
                                <input type="text" placeholder="Last Name" name="last_name" value="{{ $member_address->billing_address['last_name'] ?? '' }}" class="montserrat rem-text-18 text-remdark xl:pl-0 focus-visible:outline-none" readonly />
                            </div>
                        </div>

                        <div class="md:grid md:grid-cols-2 pb-4 xl:gap-5">
                            <div class=" pb-4 md:pb-0 md:pr-3 xl:pr-0">
                                <div class="add-country-code">
                                    <p class="montserrat rem-text-18 text-remgray90">{{ __('frontend.member.country_code') }}:<span class="montserrat rem-text-18 text-remdark xl:pl-0">
                                        {{ isset($member_address->billing_address['country_code']) ? config('general.'.lngKey().'_codes')[$member_address->billing_address['country_code']] : '' }}
                                    </span></p>
                                </div>
                                <div class="hidden add-ph">
                                    <div component-name="rem-select-box" class="w-full space-y-[10px]  country_selectbox">
                                        <label for="country-code" class="rem-text-18 text-remdark">Country Code:<span class="text-rembrown hidden">*</span></label>
                                        <div type="button" class="custom-select-container w-full relative rem-text-16 montserrat text-remdark select-none">
                                            <input type="text" name="country_code" id="country-code" hidden value="{{ old('country_code') }}" />
                                            <select class="hidden">
                                                @foreach (config('general.'.lngKey().'_codes') as $key => $country)
                                                    <option value="{{ $key }}" {{ ($member_address->billing_address['country_code'] ?? '852') == $key ? 'selected' : ($loop->first ? 'selected' : '') }}>{{ $country }}</option>
                                                @endforeach
                                            </select>
                                            <div class="select-arrow absolute top-[23px] right-[21px] w-[12px] h-[6px] pointer-events-none">
                                                <img src="{{ asset('frontend/img/arrow-down.svg') }}" alt="Arrow Down" />
                                            </div>
                                        </div>
                                        @error('country_code')
                                        <p class="rem-text-14 text-remred hidden"></p>
                                        @enderror
                                    </div>
                                </div>                                
                            </div>

                            <div class="flex items-center xl:gap-5 pb-4 md:pb-0 md:pr-3 xl:pr-0">
                                <p class="montserrat rem-text-18 text-remgray90">{{ __('frontend.member.phone') }}:</p>
                                <input type="text" id="phone" name="phone" placeholder="Phone No" value="{{ isset($member_address->billing_address['phone']) ? $member_address->billing_address['phone'] : ( old('phone') ? old('phone') : array_key_first(config('general.'.lngKey().'_codes')) ) }}" class="montserrat rem-text-18 text-remdark xl:pl-0 focus-visible:outline-none" readonly/>
                            </div>
                        </div>
                        <div>
                            <div class="flex items-center xl:gap-5">
                            <p class="montserrat rem-text-18 text-remgray90">{{ __('frontend.member.email') }}:</p>
                            <input type="email" placeholder="Email Address" name="email" value="{{ $member_address->billing_address['email'] ?? '' }}" class="montserrat rem-text-18 text-remdark xl:pl-0 focus-visible:outline-none" readonly />
                        </div>
                        </div>
                    </form>
                </div>
            
                <div class="pb-10 last-of-type:pb-0">
                    <div class="flex items-center justify-between pb-4 border-b border-b-[#E1D8CD]">
                        <p class="montserrat-semibold rem-text-18 text-blackcustom">{{ __('frontend.member.shipping_address') }}</p>
                        <img src="{{ asset('frontend/img/edit-icon.svg') }}" alt="edit icon" onclick="handleEditIcon(event)" class="cursor-pointer">
                        <div class="hidden flex items-center xl:gap-2">
                            <button type="button" class="py-3 px-5 text-rembrown montserrat-semibold rem-text-16" onclick="handleCancel(event)">{{ __('frontend.member.cancel') }}</button>
                            <button type="button" class="py-3 px-5 bg-rembrown border border-rembrown text-whitez hover:bg-transparent hover:text-rembrown montserrat-semibold rem-text-16" id="shippingUpdateBtn">{{ __('frontend.member.update') }}</button>
                        </div>
                    </div>

                    <form class="address-form pt-5" action="{{ route('front.member.store.address') }}" method="post" id="shipping-address-form">
                        @csrf
                        <input type="hidden" name="shipping_address" value="true">
                            <div>
                                <div class="flex items-center xl:gap-5 pb-4">
                                    <p class="montserrat rem-text-18 text-remgray90">{{ __('frontend.member.street_address') }}:</p>
                                    <input type="text" name="address" placeholder="House number and street name" value="{{ $member_address->shipping_address['address'] ?? '' }}" class="montserrat rem-text-18 text-remdark xl:pl-0 focus-visible:outline-none" readonly />
                                </div>
                            </div>
        
                            <div>
                                <div class="flex items-center xl:gap-5 pb-4">
                                    <input type="text" name="address_detail" value="{{ $member_address->shipping_address['address_detail'] ?? '' }}" placeholder="Apartment, suite, unit, etc." class="montserrat rem-text-18 text-remdark xl:pl-0 focus-visible:outline-none" readonly />
                                </div>
                            </div>
        
                            <div class="md:grid md:grid-cols-2 pb-4 xl:gap-5">
                                <div class="flex items-center xl:gap-5 pb-4 md:pb-0 md:pr-3 xl:pr-0">
                                    <p class="montserrat rem-text-18 text-remgray90">{{ __('frontend.member.first_name') }}:</p>
                                    <input type="text" name="first_name" value="{{ $member_address->shipping_address['first_name'] ?? '' }}" placeholder="First Name" class="montserrat rem-text-18 text-remdark xl:pl-0 focus-visible:outline-none" readonly />
                                </div>
        
                                <div class="flex items-center xl:gap-5">
                                    <p class="montserrat rem-text-18 text-remgray90">{{ __('frontend.member.last_name') }}:</p>
                                    <input type="text" placeholder="Last Name" name="last_name" value="{{ $member_address->shipping_address['last_name'] ?? '' }}" class="montserrat rem-text-18 text-remdark xl:pl-0 focus-visible:outline-none" readonly />
                                </div>
                            </div>

                        <div class="md:grid md:grid-cols-2 pb-4 xl:gap-5">
                            <div class=" pb-4 md:pb-0 md:pr-3 xl:pr-0">
                                <div class="add-country-code">
                                    <p class="montserrat rem-text-18 text-remgray90">{{ __('frontend.member.country_code') }}:<span class="montserrat rem-text-18 text-remdark xl:pl-0">
                                        {{ isset($member_address->shipping_address['country_code']) ? config('general.'.lngKey().'_codes')[$member_address->shipping_address['country_code']] : '' }}
                                    </span></p>
                                </div>
                                <div class="hidden add-ph">
                                    <div component-name="rem-select-box" class="w-full space-y-[10px]  country_selectbox">
                                        <label for="country-code" class="rem-text-18 text-remdark">Country Code:<span class="text-rembrown hidden">*</span></label>
                                        <div type="button" class="custom-select-container w-full relative rem-text-16 montserrat text-remdark select-none">
                                            <input type="text" name="country_code" id="country-code" hidden value="{{ old('country_code') }}" />
                                            <select class="hidden">
                                                @foreach (config('general.'.lngKey().'_codes') as $key => $country)
                                                    <option value="{{ $key }}" {{ ($member_address->shipping_address['country_code'] ?? '852') == $key ? 'selected' : ($loop->first ? 'selected' : '') }}>{{ $country }}</option>
                                                @endforeach
                                            </select>
                                            <div class="select-arrow absolute top-[23px] right-[21px] w-[12px] h-[6px] pointer-events-none">
                                                <img src="{{ asset('frontend/img/arrow-down.svg') }}" alt="Arrow Down" />
                                            </div>
                                        </div>
                                        @error('country_code')
                                        <p class="rem-text-14 text-remred hidden"></p>
                                        @enderror
                                    </div>
                                </div>                                
                            </div>

                            <div class="flex items-center xl:gap-5 pb-4 md:pb-0 md:pr-3 xl:pr-0">
                                <p class="montserrat rem-text-18 text-remgray90">{{ __('frontend.member.phone') }}:</p>
                                <input type="text" id="phone" name="phone" placeholder="Phone No" value="{{ isset($member_address->shipping_address['phone']) ? $member_address->shipping_address['phone'] : ( old('phone') ? old('phone') : array_key_first(config('general.'.lngKey().'_codes')) ) }}" class="montserrat rem-text-18 text-remdark xl:pl-0 focus-visible:outline-none" readonly/>
                            </div>
                        </div>
                        <div>
                            <div class="flex items-center xl:gap-5">
                                <p class="montserrat rem-text-18 text-remgray90">{{ __('frontend.member.email') }}:</p>
                                <input type="email" placeholder="Email Address" name="email" value="{{ $member_address->shipping_address['email'] ?? '' }}" class="montserrat rem-text-18 text-remdark xl:pl-0 focus-visible:outline-none" readonly />
                            </div>
                        </div>
                    </form>
                </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        $('#billingUpdateBtn').on('click', function() {
            $('#billing-address-form').submit();

        });

        $('#shippingUpdateBtn').on('click', function() {
            $('#shipping-address-form').submit();

        });
    })
</script>
@endpush