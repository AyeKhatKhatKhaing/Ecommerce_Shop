@extends('frontend.layouts.master')
@section('seo')
    <title>{{ __('frontend.seo.member_dashboard.title') }}</title>
    <meta property="og:title" content="{{ __('frontend.seo.member_dashboard.meta_title') }}" />
    <meta name="description" content="{{ __('frontend.seo.member.dashboard.meta_description') }}">
    <meta property="og:description" content="{{ __('frontend.seo.member.dashboard.meta_description') }}" />
    <meta property="og:url"content="{{ route('front.member.dashboard') }}" />
    <meta property="og:locale" content="{{ lngKey() }}">
    <meta property="og:image" content="">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="">
@endsection
@section('content')
    <div component-name="rem-memberdashboard" class="memberdashboard">
        @include('frontend.member.layouts.breadcrumb')

        <div class="container200 pt-5 md:pt-60 pb-10 md:pb-100 flex flex-col-reverse lg:flex-row xl:gap-[60px]">            
            @include('frontend.member.layouts.sidebar')
            <div class="lg:flex-[none] lg:w-[70%]">
                <h3 class="member-title montserrat-bold text-black pb-5">{{ __('frontend.member.hello') }} {{ $member->first_name }} {{ $member->last_name }}!</h3>
                <p class="montserrat-semibold rem-text-18 text-remdark pb-5">{{ __('frontend.member.my_point') }}: <span
                        class="text-remred">{{ $member->point ?? 0 }} {{ __('frontend.member.point') }}</span></p>
                <div class="flex items-center pb-10">
                    <p
                        class="border border-rembrown py-3 px-6 montserrat-bold rem-text-16 tex-center text-rembrown hover:bg-rembrown hover:text-mainyellow">
                        {{ langbind($member_type,'name') ?? ''}}</p>
                    <a href="{{ route('front.member.membership') }}"
                        class="montserrat rem-text-18 text-[#00447C] pl-5">{{ __('frontend.member.membership_tiers_description') }}</a>
                </div>

                <div>
                    <p
                        class="montserrat-semibold rem-text-18 text-remdark md:pb-3 md:flex items-center justify-between">
                        ({{ isset($member_type) && strtolower($member_type->name_en) == 'silver' ? 'Gold' : 'Platinum' }}) Accumulated Spending
                        <span class="font-normal rem-text-18 text-remdark hidden md:block">
                            @if (isset($member_type) && strtolower($member_type->name_en) == 'silver')
                                {{ isset($gold_tier) ? $gold_tier->min_purchase_amount : 0.00}}
                            @endif
                            @if (isset($member_type) && strtolower($member_type->name_en) == 'gold')
                                {{ isset($platinum_tier) ? $platinum_tier->min_purchase_amount : 0.00}}
                            @endif
                            @if (isset($member_type) && strtolower($member_type->name_en) == 'platinum')
                                {{ isset($platinum_tier) ? $platinum_tier->min_purchase_amount : 0.00}}
                            @endif
                            {{ currency() }}
                        </span>
                    </p>
                    <div class="md:flex items-center justify-between">
                        <p class="montserrat rem-text-16 text-remdark pb-3 md:pb-0">{{ __('frontend.member.last_updated') }}
                            @if (isset($member_type) && strtolower($member_type->name_en) =='silver')
                                {{ date('d M, Y', strtotime($gold_tier->updated_at)) }}
                            @endif
                            @if (isset($member_type) && strtolower($member_type->name_en) == 'gold')
                                {{ date('d M, Y', strtotime($platinum_tier->updated_at)) }}
                            @endif
                            @if (isset($member_type) && strtolower($member_type->name_en) == 'platinum')
                                {{ date('d M, Y', strtotime($platinum_tier->updated_at)) }}
                            @endif
                        </p>
                       
                        <p class="montserrat rem-text-12 text-remdark md:hidden">
                            {{ currency() }}
                                @if (isset($member_type) && strtolower($member_type->name_en) =='silver')
                                    {{ $gold_tier->min_purchase_amount }}
                                @endif
                                @if (isset($member_type) && strtolower($member_type->name_en) == 'gold')
                                    {{ $platinum_tier->min_purchase_amount }}
                                @endif
                                @if (isset($member_type) && strtolower($member_type->name_en) == 'platinum')
                                    {{ $platinum_tier->min_purchase_amount }}
                                @endif
                            </p>
                        <p class="font-semibold rem-text-16 text-remdark">
                            <span class="member-inputvalue">
                                {{ $member->purchased_amount ?? 0 }} 
                            </span>/<span class="max-value">
                                @if (isset($member_type) && strtolower($member_type->name_en) =='silver')
                                    {{ $gold_tier->min_purchase_amount }}
                                @endif
                                @if (isset($member_type) && strtolower($member_type->name_en) == 'gold')
                                    {{ $platinum_tier->min_purchase_amount }}
                                @endif
                                @if (isset($member_type) && strtolower($member_type->name_en) == 'platinum')
                                    {{ $platinum_tier->min_purchase_amount }}
                                @endif
                            </span>
                        </p>
                    </div>
                    <div class="py-3">
                        <div class="progress-bar h-[5px] bg-remlinear rounded-[50px] relative" data-max="{{ $member_type->min_purchase_amount ?? 0 }}">
                            <p class="active-progressbar absolute h-[5px] left-0 top-0 bg-mainyellow rounded-[50px]"
                                data-value="" data-min="{{ $member->point ?? 0 }}"></p>
                        </div>
                    </div>
                    @php
                        $result_amt = 0;
                        if($member_type && strtolower($member_type->name_en) =='silver'){
                            $purchased_amt = $gold_tier->min_purchase_amount - $member->purchased_amount ;
                        }
                        if($member_type && strtolower($member_type->name_en) =='gold'){
                            $purchased_amt = $platinum_tier->min_purchase_amount - $member->purchased_amount ;
                        }
                        if($member_type && strtolower($member_type->name_en) =='platinum'){
                            $purchased_amt = $platinum_tier->min_purchase_amount - $member->purchased_amount ;
                        }
                    @endphp
                    <p class="montserrat rem-text-14 text-rembrown2 pb-5">
                        {{ __('frontend.member.spend_more') }} <span class="font-semibold text-remred">{{ currency() }}{{ $purchased_amt ?? 0 }}</span> {{ __('frontend.member.accumulated_purchase') }}
                        <span class="font-semibold text-remred">{{ currency() }}{{ $purchased_amt ?? 0 }}</span> {{ __('frontend.member.upgrate_to') }}
                        (<span class="font-semibold">{{ __('frontend.member.gold') }}</span>)
                    </p>

                    <div
                        class="justify-between border border-remDF py-5 lg:py-10 px-5 5xl:px-[45px] xl:flex order-container xl:gap-5 7xl:gap-10">
                        <div class="2xs:flex pb-3 xl:pb-0 xl:gap-5 7xl:gap-10 justify-between">

                            <div class="pb-3 2xs:pb-0 2xs:mr-5 last-of-type:mr-0 xl:mr-0">
                                <p class="text-center text-remdark montserrat-semibold">{{ $orderStatus ? $orderStatus->awating_shipment : 0  }}</p>
                                <p class="text-center text-remdark montserrat">{{ __('frontend.member.awaiting_shipment') }}</p>
                            </div>

                            <div class="pb-3 2xs:pb-0 2xs:mr-5 last-of-type:mr-0 xl:mr-0">
                                <p class="text-center text-remdark montserrat-semibold">{{ $orderStatus ? $orderStatus->shipped : 0  }}</p>
                                <p class="text-center text-remdark montserrat">{{ __('frontend.member.shipped') }}</p>
                            </div>

                            <div class="pb-3 2xs:pb-0 2xs:mr-5 last-of-type:mr-0 xl:mr-0">
                                <p class="text-center text-remdark montserrat-semibold">{{ $orderStatus ? $orderStatus->tobe_pickup : 0  }}</p>
                                <p class="text-center text-remdark montserrat">{{ __('frontend.member.to_be_pick_up') }}</p>
                            </div>

                            <div class="pb-3 2xs:pb-0 2xs:mr-5 last-of-type:mr-0 xl:mr-0">
                                <p class="text-center text-remdark montserrat-semibold">{{ $orderStatus ? $orderStatus->already_pickup : 0  }}</p>
                                <p class="text-center text-remdark montserrat">{{ __('frontend.member.already_pick_up') }}</p>
                            </div>

                        </div>

                        <a href="{{ route('front.member.order')}}"
                            class="montserrat-semibold inline-block py-3 px-5 6xl:px-9 bg-rembrown text-whitez border border-rembrown hover:bg-transparent hover:text-rembrown w-full xl:w-auto text-center">{{ __('frontend.member.view_order') }}</a>
                    </div>

                    <div
                        class="border border-remDF mt-5 py-5 lg:py-10 px-5 5xl:px-[45px] 2xs:flex order-container xl:gap-20 7xl:gap-[138px] personal-container justify-between">

                        <div class="pb-4 2xs:pb-0 2xs:mr-5 xl:mr-0 last-of-type:mr-0 last-of-type:pb-0 text-center">
                            <img src="{{ asset('frontend/img/member-user-profile.svg') }}" alt="icon" class="mx-auto">
                            <a href="{{ route('front.member.information')}}" class="montserrat text-remdark">{{ __('frontend.member.personal_information') }}</a>
                        </div>

                        <div class="pb-4 2xs:pb-0 2xs:mr-5 xl:mr-0 last-of-type:mr-0 last-of-type:pb-0 text-center">
                            <img src="{{ asset('frontend/img/member-coupon.svg') }}" alt="icon" class="mx-auto">
                            <a href="{{ route('front.member.coupon')}}" class="montserrat text-remdark">{{ __('frontend.member.my_coupon') }}</a>
                        </div>

                        <div class="pb-4 2xs:pb-0 2xs:mr-5 xl:mr-0 last-of-type:mr-0 last-of-type:pb-0 text-center">
                            <img src="{{ asset('frontend/img/member-ph_heart.svg') }}" alt="icon" class="mx-auto">
                            <a href="{{ route('front.member.wishlist')}}" class="montserrat text-remdark">{{ __('frontend.member.my_wishlist') }}</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection