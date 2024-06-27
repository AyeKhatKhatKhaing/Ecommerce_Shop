@extends('frontend.layouts.master')
@section('seo')
    <title>{{ isset($contact_page) && isset($contact_page->meta_titles) ? $contact_page->meta_titles[lngKey()] : '' }}</title>
    <meta property="og:title" content="{{ isset($contact_page) && isset($contact_page->meta_titles) ? $contact_page->meta_titles[lngKey()] : '' }}" />
    <meta name="description" content="{{ isset($contact_page) && isset($contact_page->meta_descriptions) ? $contact_page->meta_descriptions[lngKey()] : '' }}">
    <meta property="og:description" content="{{ isset($contact_page) && isset($contact_page->meta_descriptions) ? $contact_page->meta_descriptions[lngKey()] : '' }}" />
    <meta property="og:url"content="{{ route('front.contact') }}" />
    <meta property="og:locale" content="{{ lngKey() }}">
    <meta property="og:image" content="{{ isset($contact_page) ? asset($contact_page->meta_image) : '' }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="{{ isset($contact_page) ? $contact_page->meta_image_alt : '' }}">
@endsection
@section('content')
@php
    $name     = "name_".lngKey();
    $address  = "address_".lngKey();
@endphp
    <div component-name="rem-banner">
        <div class="relative">
            <img src="{{ isset($contact_page) && isset($contact_page->banner_image) ? asset($contact_page->banner_image) : '' }}" class="min-h-[200px] object-cover lg:min-h-auto w-full"
                alt="{{ isset($contact_page) && isset($contact_page->banner_titles[lngKey()]) ? $contact_page->banner_titles[lngKey()] : '' }}">

            <p
                class="banner-text text-whitez montserrat-bold absolute left-1/2 top-1/2 -translate-y-1/2 -translate-x-1/2">
                {{ isset($contact_page) && isset($contact_page->banner_titles[lngKey()]) ? $contact_page->banner_titles[lngKey()] : '' }}</p>

        </div>


    </div>
    <div component-name="rem-contact" class="container200 py-20">
        <div class="lg:flex xl:gap-20">
            <div class="lg:flex-[0_1_30%] lg:max-w-[30%] pb-5 lg:pb-0">
                <ul class="contact-sidebar">
                    @foreach ($contact_addresses as $contact_name)
                        <li data-id="tab-{{ $contact_name->id }}"
                            class="py-3 px-9 montserrat-semibold rem-text-20 text-rembrown border border-rembrown hover:bg-rembrown hover:text-whitez mb-3 last-of-type:mb-0 cursor-pointer @if($loop->first) active @endif">
                            {{ $contact_name->$name }}
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="lg:flex-[0_1_70%] lg:max-w-[70%] lg:pl-5 xl:pl-0">
                @foreach ($contact_addresses as $contact_address)
                    <div class="contact-tabcontent @if(!$loop->first) hidden @endif" data-id="tab-{{ $contact_address->id }}">
                        <div class="pb-10">
                            {!! $contact_address->google_map !!}
                        </div>
                        {!! $contact_address->$address !!}
                    </div>
                @endforeach

                <div class="pt-60">
                    <h2 class="montserrat-semibold rem-text-40 text-blackcustom py-7 md:py-10 border-t border-t-remDF">{{ __('frontend.contact.contact_form') }}</h2>
                    <form action="{{ route('front.contact.store') }}" method="post" enctype="multipart/form-data" id="contact-popup">
                        @csrf
                        <div class="pb-[10px]">
                            <div class="w-full space-y-[10px] @if ($errors->has('name')) rem-error @endif">
                                <label for="name" class="block rem-text-18 text-remdark">{{ __('frontend.contact.name') }}<span
                                        class="text-rembrown ">*</span>
                                </label>

                                <input type="text" id="name" name="name" placeholder="" value="{{ old('name') }}"
                                    class="w-full h-[52px] border border-remDF px-[21px] py-[13px] rem-text-16 montserrat text-remdark focus:bg-[#F3EFEA] focus:outline-none" />
                                @if ($errors->has('name'))
                                    <p class="rem-text-14 text-remred hidden" id="name-error">{{ __('frontend.contact.enter_name') }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 pb-[10px] xl:gap-5">
                            <div class="md:pr-3 xl:pr-0">
                                <div class="w-full space-y-[10px] @if ($errors->has('phone_no')) rem-error @endif">
                                    <label for="phone_no" class="block rem-text-18 text-remdark">{{ __('frontend.contact.phone_no') }}<span
                                            class="text-rembrown ">*</span>
                                    </label>

                                    <input type="number" id="phone_no" name="phone_no" placeholder="" value="{{ old('phone_no') }}"
                                        class="w-full h-[52px] border border-remDF px-[21px] py-[13px] rem-text-16 montserrat text-remdark focus:bg-[#F3EFEA] focus:outline-none" />

                                    @if ($errors->has('phone_no'))
                                        <p class="rem-text-14 text-remred hidden" id="phone_no-error">{{ __('frontend.contact.enter_phone_no') }}</p>
                                    @endif 
                                </div>
                            </div>
                            <div class="w-full space-y-[10px] @if ($errors->has('email')) rem-error @endif">
                                <label for="email_address" class="block rem-text-18 text-remdark">{{ __('frontend.contact.email_address') }}<span
                                        class="text-rembrown ">*</span>
                                </label>

                                <input type="email" id="email_address" name="email" placeholder="" value="{{ old('email') }}"
                                    class="w-full h-[52px] border border-remDF px-[21px] py-[13px] rem-text-16 montserrat text-remdark focus:bg-[#F3EFEA] focus:outline-none" />

                                @if ($errors->has('email'))
                                    <p class="rem-text-14 text-remred hidden" id="email_address-error">{{ __('frontend.contact.enter_email_address') }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="py-[20px] note">
                            <label>{{ __('frontend.contact.message') }}*</label>
                            <textarea name="message" rows="4"
                                class="w-full mt-[10px] outline-0 border border-remDF p-3">{{ old('message') }}</textarea>
                        </div>

                        <div>
                            <label for="read-statement" class="flex items-start relative">
                                <input type="checkbox" id="read-statement" name="read_statement" {{ old('read_statement') ? 'checked' : '' }}
                                    value="read-statement" class="peer absolute w-[20px] h-[20px] appearance-none">
                                <span
                                    class="block peer-checked:hidden flex-shrink-0 rounded-[2px] w-[20px] h-[20px]  border border-black peer-focus:outline peer-focus:outline-1 peer-focus:outline-offset-1 peer-focus:outline-rembrown"></span>

                                <span
                                    class="hidden peer-checked:flex flex-shrink-0 rounded-[2px] w-[20px] h-[20px] items-center justify-center text-white border border-rembrown bg-rembrown peer-focus:outline peer-focus:outline-1 peer-focus:outline-offset-1 peer-focus:outline-rembrown">&#10003;</span>

                                <span class="ml-[10px] rem-text-18 montserrat text-black">{{ __('frontend.contact.read_understand') }}<a href="{{ route('front.privacy-policy') }}"> {{ __('frontend.contact.privacy_statement') }}</a></span>
                            </label>
                            @error('read_statement')
                            <p class="rem-text-14 text-remred">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="receive-news" class="flex items-start relative">
                                <input type="checkbox" id="receive-news" name="receive_news" value="receive-news" {{ old('receive_news') ? 'checked' : '' }}
                                    class="peer absolute w-[20px] h-[20px] appearance-none">
                                <span
                                    class="block peer-checked:hidden flex-shrink-0 rounded-[2px] w-[20px] h-[20px]  border border-black peer-focus:outline peer-focus:outline-1 peer-focus:outline-offset-1 peer-focus:outline-rembrown"></span>

                                <span
                                    class="hidden peer-checked:flex flex-shrink-0 rounded-[2px] w-[20px] h-[20px] items-center justify-center text-white border border-rembrown bg-rembrown peer-focus:outline peer-focus:outline-1 peer-focus:outline-offset-1 peer-focus:outline-rembrown">&#10003;</span>

                                <span class="ml-[10px] rem-text-18 montserrat text-black">{{ __('frontend.contact.declare') }}</span>
                            </label>
                            @error('receive_news')
                            <p class="rem-text-14 text-remred">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="pt-7">
                            <button type="submit"
                            class="border border-rembrown py-3 px-5 bg-rembrown rem-text-18 text-whitez montserrat-semibold w-full sm:w-auto mb-5 sm:mb-0"
                            id="contact-submit">{{ __('frontend.contact.submit') }}</button>
                        </div>
                        <div id="thankyou-modal" class="rem-newsletter-popup-wrapper fixed top-0 left-0 w-full h-full bg-[#000000ba] {{ session('contact_success') ? '' : 'hidden' }}">
                            <div class="absolute bg-white min-w-[80%] md:min-w-[640px] left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 ">
                                <div class="p-[20px] lg:p-[28px] 3xl:p-[48px] ">
                                    <div class="inner relative py-[30px] lg:py-[50px] 3xl:py-[74px]">
                                        <div onclick="closeThankYou()" class="close absolute -top-[20px] lg:-top-[25px] -right-[20px] bg-white p-5 rounded-[30px] cursor-pointer">
                                            <img src="{{ asset('frontend/img/close-br.svg')}}" alt="close" />
                                        </div>
                                        <div class="text-center">
                                            <img src="{{ asset('frontend/img/green_check.svg')}}" alt="check" class="mx-auto">
                                            <p class="pt-10 rem-text-32 text-black montserrat-semibold">{{ __('frontend.contact.submitted') }}</p>
                                            <p class="rem-text-20 text-black montserrat">{{ __('frontend.contact.thank_you') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection