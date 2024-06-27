@extends('frontend.layouts.master')
@section('seo')
    <title>{{ __('frontend.seo.member_coupon.title') }}</title>
    <meta property="og:title" content="{{ __('frontend.seo.member_coupon.meta_title') }}" />
    <meta name="description" content="{{ __('frontend.seo.member_coupon.meta_description') }}">
    <meta property="og:description" content="{{ __('frontend.seo.member_coupon.meta_description') }}" />
    <meta property="og:url"content="{{ route('front.member.coupon') }}" />
    <meta property="og:locale" content="{{ lngKey() }}">
    <meta property="og:image" content="">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="">
@endsection
@section('content')
@php
    $lng = lngKey();
@endphp
<div component-name="rem-coupons" class="memberdashboard member-coupons">
    @include('frontend.member.layouts.breadcrumb')

    <div class="container200 pt-5 md:pt-60 pb-10 md:pb-100 flex flex-col-reverse lg:flex-row xl:gap-[60px]">
        @include('frontend.member.layouts.sidebar')

        <div class=" lg:flex-[none] lg:w-[70%]">
            <h3 class="member-title montserrat-bold text-black pb-5">{{ __('frontend.member.my_coupon') }}</h3>
            <div class="flex items-center flex-wrap border-b border-remDF md:flex-nowrap xl:gap-5 6xl:gap-10 tabs-header">

                <p id="active-coupon" class="montserrat text-remdark flex items-center justify-between {{ isset($tab) && $tab == 'history' ? '' : 'active-tab' }} cursor-pointer mr-4 last-of-type:mr-0 xl:mr-0 py-5 lg:pt-0">
                    {{ __('frontend.member.active_coupon') }}
                </p>

                <p id="history-coupon" class="montserrat text-remdark flex items-center justify-between  {{ isset($tab) && $tab == 'history' ? 'active-tab' : '' }} cursor-pointer mr-4 last-of-type:mr-0 xl:mr-0 py-5 lg:pt-0">
                    {{ __('frontend.member.coupon_history') }}
                </p>

            </div>

            <div class="tabs-content pt-4 {{ isset($tab) && $tab == 'history' ? 'hidden' : ''  }}" data-id="active-coupon">
                <form action="{{ route('front.member.coupon') }}" method="get">
                    <div class="sm:flex items-center">
                        <input type="hidden" name="tab" value="{{ old('tab') ? old('tab') : 'active' }}">
                        <input type="text" value="{{ $coupon_keyword ? $coupon_keyword : '' }}" class="w-full focus-visible:outline-none border border-remDF py-3 pl-5 montserrat rem-text-16" placeholder="Enter Coupon Code" name="coupon_search">
                        <button type="submit" class="py-3 px-5 montserrat-semibold rem-text-16 bg-rembrown text-whitez border border-rembrown mt-2 sm:mt-0 w-full sm:w-auto">{{ __('frontend.member.search') }}</button>
                </form>
            </div>

            <div class="md:flex xl:gap-[25px] 2xl:gap-[30px] pt-6 flex-wrap justify-between">
                @foreach($active_coupons as $active)
                    <div class="p-5 border border-dashed border-remDF mb-3 last-of-type:mb-0 xl:mb-0 h-full md:flex-[none] md:w-[49%] xl:w-[48%]">
                        <p class="montserrat-semibold rem-text-16 text-rembrown2 pb-2 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M2.00586 9.5V4C2.00586 3.73478 2.11122 3.48043 2.29875 3.29289C2.48629 3.10536 2.74064 3 3.00586 3H21.0059C21.2711 3 21.5254 3.10536 21.713 3.29289C21.9005 3.48043 22.0059 3.73478 22.0059 4V9.5C21.3428 9.5 20.7069 9.76339 20.2381 10.2322C19.7692 10.7011 19.5059 11.337 19.5059 12C19.5059 12.663 19.7692 13.2989 20.2381 13.7678C20.7069 14.2366 21.3428 14.5 22.0059 14.5V20C22.0059 20.2652 21.9005 20.5196 21.713 20.7071C21.5254 20.8946 21.2711 21 21.0059 21H3.00586C2.74064 21 2.48629 20.8946 2.29875 20.7071C2.11122 20.5196 2.00586 20.2652 2.00586 20V14.5C2.6689 14.5 3.30479 14.2366 3.77363 13.7678C4.24247 13.2989 4.50586 12.663 4.50586 12C4.50586 11.337 4.24247 10.7011 3.77363 10.2322C3.30479 9.76339 2.6689 9.5 2.00586 9.5ZM14.0059 5H4.00586V7.968C4.75707 8.3403 5.38933 8.91505 5.83136 9.62746C6.2734 10.3399 6.50762 11.1616 6.50762 12C6.50762 12.8384 6.2734 13.6601 5.83136 14.3725C5.38933 15.085 4.75707 15.6597 4.00586 16.032V19H14.0059V5ZM16.0059 5V19H20.0059V16.032C19.2547 15.6597 18.6224 15.085 18.1804 14.3725C17.7383 13.6601 17.5041 12.8384 17.5041 12C17.5041 11.1616 17.7383 10.3399 18.1804 9.62746C18.6224 8.91505 19.2547 8.3403 20.0059 7.968V5H16.0059Z" fill="#5B514F" />
                            </svg>
                            {{ $active->coupon->code }}
                        </p>
                        <p class="montserrat rem-text-18 text-remdark pb-6">{{ currency() }}{{ $active->coupon->amount }}</p>
                        <p class="montserrat rem-text-16 text-rembrown2">{{ $active->coupon->descriptions[$lng] }}</p>
                        <p class="montserrat rem-text-16 text-rembrown2">
                            @if (isset($active->expiry_date))
                                Valid Until {{  date('Y-m-d', strtotime($active->expiry_date)) }}
                            @endif
                        </p>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="tabs-content pt-4 {{ isset($tab) && $tab == 'history' ? '' : 'hidden'  }}" data-id="history-coupon">
            <form action="{{ route('front.member.coupon') }}" method="get">
                <div class="sm:flex items-center">
                    <input type="hidden" name="tab" value="{{ old('tab') ? old('tab') : 'history' }}">
                    <input type="text" value="{{ $history_keyword ? $history_keyword : '' }}" name="history_search" class="w-full focus-visible:outline-none border border-remDF py-3 pl-5 montserrat rem-text-16" placeholder="Enter Coupon Code">
                    <button type="submit" class="py-3 px-5 montserrat-semibold rem-text-16 bg-rembrown text-whitez border border-rembrown mt-2 sm:mt-0 w-full sm:w-auto">{{ __('frontend.member.search') }}</button>
                </div>
            </form>
            <div class="md:flex xl:gap-[25px] 2xl:gap-[30px] pt-6 flex-wrap justify-between">
                @foreach( $coupon_histories as $coupon_history)
                <div class="p-5 border border-dashed border-remDF bg-[#FEFCFA] opacity-50 mb-3 last-of-type:mb-0 xl:mb-0 h-full md:flex-[none] md:w-[49%] xl:w-[48%]">
                    <p class="montserrat-semibold rem-text-16 text-rembrown2 pb-2 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M2.00586 9.5V4C2.00586 3.73478 2.11122 3.48043 2.29875 3.29289C2.48629 3.10536 2.74064 3 3.00586 3H21.0059C21.2711 3 21.5254 3.10536 21.713 3.29289C21.9005 3.48043 22.0059 3.73478 22.0059 4V9.5C21.3428 9.5 20.7069 9.76339 20.2381 10.2322C19.7692 10.7011 19.5059 11.337 19.5059 12C19.5059 12.663 19.7692 13.2989 20.2381 13.7678C20.7069 14.2366 21.3428 14.5 22.0059 14.5V20C22.0059 20.2652 21.9005 20.5196 21.713 20.7071C21.5254 20.8946 21.2711 21 21.0059 21H3.00586C2.74064 21 2.48629 20.8946 2.29875 20.7071C2.11122 20.5196 2.00586 20.2652 2.00586 20V14.5C2.6689 14.5 3.30479 14.2366 3.77363 13.7678C4.24247 13.2989 4.50586 12.663 4.50586 12C4.50586 11.337 4.24247 10.7011 3.77363 10.2322C3.30479 9.76339 2.6689 9.5 2.00586 9.5ZM14.0059 5H4.00586V7.968C4.75707 8.3403 5.38933 8.91505 5.83136 9.62746C6.2734 10.3399 6.50762 11.1616 6.50762 12C6.50762 12.8384 6.2734 13.6601 5.83136 14.3725C5.38933 15.085 4.75707 15.6597 4.00586 16.032V19H14.0059V5ZM16.0059 5V19H20.0059V16.032C19.2547 15.6597 18.6224 15.085 18.1804 14.3725C17.7383 13.6601 17.5041 12.8384 17.5041 12C17.5041 11.1616 17.7383 10.3399 18.1804 9.62746C18.6224 8.91505 19.2547 8.3403 20.0059 7.968V5H16.0059Z" fill="#5B514F" />
                        </svg>
                        {{ $coupon_history->coupon->code }}
                    </p>
                    <p class="montserrat rem-text-18 text-remdark pb-6">HK$ {{ $coupon_history->coupon->amount }}</p>
                    @if ($coupon_history->status == 1 && $coupon_history->expiry_date < now())
                        <div class="xl:flex items-center justify-between">
                            <div class="pb-4 xl:pb-0">
                                <p class="montserrat rem-text-16 text-rembrown2">{{ $coupon_history->coupon->descriptions[$lng] }}</p>
                                <p class="montserrat rem-text-16 text-rembrown2">
                                    @if (isset($coupon_history->expiry_date))
                                        Valid Until {{ date('Y-m-d', strtotime($coupon_history->expiry_date)) }}
                                    @endif
                                </p>
                            </div>
                            <p class="py-3 px-6 border border-rembrown montserrat-bold rem-text-16 text-rembrown hover:bg-rembrown hover:text-mainyellow">
                                {{ __('frontend.member.expired') }}
                            </p>
                        </div>
                    @else
                        <div class="xl:flex items-center justify-between">
                            <div class="pb-4 xl:pb-0">
                                <p class="montserrat rem-text-16 text-rembrown2">{{ $coupon_history->coupon->descriptions[$lng] }}</p>
                                <p class="montserrat rem-text-16 text-rembrown2">
                                    @if (isset($coupon_history->expiry_date))
                                        Valid Until {{ date('Y-m-d', strtotime($coupon_history->expiry_date)) }}
                                    @endif
                                </p>
                            </div>
                            <p class="py-3 px-6 border border-rembrown montserrat-bold rem-text-16 text-rembrown hover:bg-rembrown hover:text-mainyellow"> Used
                            </p>
                        </div>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
</div>
@endsection