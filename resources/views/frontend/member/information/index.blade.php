@extends('frontend.layouts.master')
@section('seo')
    <title>{{ __('frontend.seo.member_information.title') }}</title>
    <meta property="og:title" content="{{ __('frontend.seo.member_information.meta_title') }}" />
    <meta name="description" content="{{ __('frontend.seo.member_information.meta_description') }}">
    <meta property="og:description" content="{{ __('frontend.seo.member_information.meta_description') }}" />
    <meta property="og:url"content="{{ route('front.member.information') }}" />
    <meta property="og:locale" content="{{ lngKey() }}">
    <meta property="og:image" content="">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="">
@endsection
@section('content')
<div component-name="rem-personalform" class="memberdashboard">
    @include('frontend.member.layouts.breadcrumb')

    <div class="container200 pt-5 md:pt-60 pb-10 md:pb-100 flex flex-col-reverse lg:flex-row xl:gap-[60px]">
        @include('frontend.member.layouts.sidebar')

        @php $member = auth('member')->user() @endphp
        <div class=" lg:flex-[none] lg:w-[70%]">
            <h3 class="member-title montserrat-bold text-black pb-5">{{ __('frontend.member.personal_information') }}</h3>
            <form action="{{ route('front.member.updateinformation') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 xl:gap-5 pb-5">
                    <div class="pb-5 md:pb-0 md:pr-3 xl:pr-0">
                        <div class="w-full space-y-[10px] @error('first_name') rem-error @enderror">
                            <label for="info_firstname" class="block rem-text-18 text-remdark">{{ __('frontend.member.first_name') }}<span class="text-rembrown ">*</span>
                            </label>

                            <input type="text" id="info_firstname" name="first_name" value="{{ $member ? $member->first_name : old('first_name') }}" class="w-full h-[52px] border border-remDF px-[21px] py-[13px] rem-text-16 montserrat text-remdark focus:bg-[#F3EFEA] focus:outline-none" />
                            @error('first_name')
                            <p class="rem-text-14 text-remred hidden" id="info_firstname-error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div>
                        <div class="w-full space-y-[10px] @error('last_name') rem-error @enderror">
                            <label for="info_lastname" class="block rem-text-18 text-remdark">{{ __('frontend.member.last_name') }}<span class="text-rembrown ">*</span>
                            </label>

                            <input type="text" id="info_lastname" name="last_name" value="{{ $member ? $member->last_name : old('last_name') }}" class="w-full h-[52px] border border-remDF px-[21px] py-[13px] rem-text-16 montserrat text-remdark focus:bg-[#F3EFEA] focus:outline-none" />
                            @error('last_name')
                            <p class="rem-text-14 text-remred hidden" id="info_lastname-error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="pb-5">
                    <div class="w-full space-y-[10px] ">
                        <label for="info_companyname" class="block rem-text-18 text-remdark">{{ __('frontend.member.company_name') }}
                        <span class="text-rembrown hidden">*</span>
                        </label>

                        <input type="text" id="info_companyname" name="company_name" value="{{ $member ? $member->company : old('company_name') }}" placeholder="" class="w-full h-[52px] border border-remDF px-[21px] py-[13px] rem-text-16 montserrat text-remdark focus:bg-[#F3EFEA] focus:outline-none" />
                        <p class="rem-text-14 text-remred hidden" id="info_companyname-error"></p>

                    </div>
                </div>
                <div class="pb-5">
                    <div component-name="rem-select-box" class="w-full space-y-[10px] @error('country_code') rem-error @enderror info_selectbox">
                        <label for="info_countrycode" class="rem-text-18 text-remdark">{{ __('frontend.member.country_region') }}<span class="text-rembrown @@star">*</span></label>
                        <div type="button" class="custom-select-container w-full relative rem-text-16 montserrat text-remdark select-none">
                            <input type="text" name="country_id" id="info_countrycode" hidden />
                            <select class="hidden">
                                @foreach($countries as $country)
                                <option value="{{ $country->id }}" @if($country->id == $member->country_id) selected @endif>{{ langbind($country,'name') }}
                                </option>
                                @endforeach
                            </select>
                            <div class="select-arrow absolute top-[23px] right-[21px] w-[12px] h-[6px] pointer-events-none">
                                <img src="{{ asset('frontend/img/arrow-down.svg') }}" alt="Arrow Down" />
                            </div>
                        </div>
                        @error('country_id')
                        <p class="rem-text-14 text-remred">{{ __('frontend.member.please_select_one') }}</p>
                        @enderror
                    </div>
                </div>
                <div class="pb-5">
                    <div class="w-full space-y-[10px] @error('address') rem-error @enderror">
                        <label for="info_streetaddress" class="block rem-text-18 text-remdark">{{ __('frontend.member.street_address') }}<span class="text-rembrown ">*</span>
                        </label>

                        <input type="text" id="info_streetaddress" name="address" value="{{ $member ? $member->address : old('address') }}" placeholder="" class="w-full h-[52px] border border-remDF px-[21px] py-[13px] rem-text-16 montserrat text-remdark focus:bg-[#F3EFEA] focus:outline-none" />
                        @error('address')
                        <p class="rem-text-14 text-remred" id="info_streetaddress-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="pb-5">
                    <div class="w-full space-y-[10px] @error('address_detail') rem-error @enderror">
                        <label for="info_apartment" class="block rem-text-18 text-remdark"><span class="text-rembrown hidden">*</span>
                        </label>

                        <input type="text" id="info_apartment" name="address_detail" value="{{ $member ? $member->address_detail : old('address_detail') }}" placeholder="Apartment, suite, unit, etc." class="w-full h-[52px] border border-remDF px-[21px] py-[13px] rem-text-16 montserrat text-remdark focus:bg-[#F3EFEA] focus:outline-none" />
                        @error('address_detail')
                        <p class="rem-text-14 text-remred" id="info_apartment-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 xl:gap-5 pb-5">
                    <div class="pb-5 md:pb-0 md:pr-3 xl:pr-0">
                        <div class="w-full space-y-[10px] @error('city')  rem-error  @enderror">
                            <label for="info_town" class="block rem-text-18 text-remdark">{{ __('frontend.member.town_city') }}<span class="text-rembrown ">*</span>
                            </label>

                            <input type="text" id="info_town" name="city" value="{{ $member ? $member->city : old('city') }}" placeholder="" class="w-full h-[52px] border border-remDF px-[21px] py-[13px] rem-text-16 montserrat text-remdark focus:bg-[#F3EFEA] focus:outline-none" />
                            @error('city')
                            <p class="rem-text-14 text-remred" id="info_town-error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div>
                        <div class="w-full space-y-[10px] @error('state')  rem-error  @enderror">
                            <label for="info_state" class="block rem-text-18 text-remdark">{{ __('frontend.member.state_country') }}<span class="text-rembrown ">*</span>
                            </label>

                            <input type="text" id="info_state" name="state" value="{{ $member ? $member->state : old('state') }}" placeholder="" class="w-full h-[52px] border border-remDF px-[21px] py-[13px] rem-text-16 montserrat text-remdark focus:bg-[#F3EFEA] focus:outline-none" />
                            @error('state')
                            <p class="rem-text-14 text-remred" id="info_state-error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="pb-5">
                    <div class="w-full space-y-[10px] @error('postal_code')  rem-error  @enderror">
                        <label for="info_postalcode" class="block rem-text-18 text-remdark">{{ __('frontend.member.postalcode_zip') }}<span class="text-rembrown ">*</span>
                        </label>

                        <input type="text" id="info_postalcode" name="postal_code" value="{{ $member ? $member->postal_code : old('postal_code') }}" placeholder="" class="w-full h-[52px] border border-remDF px-[21px] py-[13px] rem-text-16 montserrat text-remdark focus:bg-[#F3EFEA] focus:outline-none" />
                        @error('postal_code')
                        <p class="rem-text-14 text-remred " id="info_postalcode-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 xl:gap-5 pb-5">
                    <div class="pb-5 md:pb-0 md:pr-3 xl:pr-0">
                        <div component-name="rem-select-box" class="w-full space-y-[10px] @error('country_code') rem-error @enderror country_selectbox">
                            <label for="country-code" class="rem-text-18 text-remdark">{{__('frontend.auth.country_code')}}<span class="text-rembrown @@star">*</span></label>
                            <div type="button" class="custom-select-container w-full relative rem-text-16 montserrat text-remdark select-none">
                                <input type="text" name="country_code" id="country-code" hidden value="{{ old('country_code') }}" />
                                <select class="hidden">
                                    @foreach (config('general.'.lngKey().'_codes') as $key => $country)
                                        <option value="{{ $key }}" {{ ($member ? $member->country_code : old('country_code')) == $key ? 'selected' : ($loop->first ? 'selected' : '') }}>{{ $country }}</option>
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
                    <div>
                        <div class="w-full space-y-[10px] @error('phone') rem-error @enderror">
                            <label for="phone" class="block rem-text-18 text-remdark">{{__('frontend.auth.phone_no')}}<span
                                    class="text-rembrown" aria-label="required">*</span>
                            </label>
    
                            <div class="w-full flex items-center">
                                <input type="tel" id="phone" name="phone" placeholder="{{__('frontend.auth.phone_no')}}" value="{{ $member->phone ? $member->phone : (old('phone') ? old('phone') : array_key_first(config('general.'.lngKey().'_codes'))) }}"
                                    class="w-full h-[52px] border border-remDF px-[21px] py-[13px] rem-text-16 montserrat text-remdark focus:bg-[#F3EFEA] focus:outline-none" />
                            </div>
    
                            @error('phone')
                                <p class="rem-text-14 text-remred" id="phone-error">{{ $message }}</p>
                            @else
                                <p class="rem-text-14 text-remred hidden" id="phone-error">{{__('frontend.auth.invalid_input')}}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-1 ">
                    <div class="w-full space-y-[10px] @error('email')  rem-error  @enderror">
                        <label for="info_email" class="block rem-text-18 text-remdark">{{ __('frontend.member.email') }}<span class="text-rembrown ">*</span>
                        </label>

                        <input type="email" id="info_email" name="email" value="{{ $member ? $member->email : old('email') }}" placeholder="" class="w-full h-[52px] border border-remDF px-[21px] py-[13px] rem-text-16 montserrat text-remdark focus:bg-[#F3EFEA] focus:outline-none" />
                        @error('email') 
                        <p class="rem-text-14 text-remred" id="info_email-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
              

                <div class="pt-10 flex items-center xl:gap-[10px]">
                    <a href="{{ route('front.member.dashboard') }}">
                    <button type="button" class="border border-rembrown montserrat-semibold rem-text-16 py-3 px-5 text-rembrown mr-2 xl:mr-0 min-w-[140px] text-center">{{ __('frontend.member.cancel') }}</button>
                    </a>
                    <button type="submit" class="border border-rembrown montserrat-semibold rem-text-16 py-3 px-5 text-whitez bg-rembrown min-w-[140px] text-center">{{ __('frontend.member.update_profile') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection