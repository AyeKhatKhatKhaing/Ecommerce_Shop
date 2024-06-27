@extends('frontend.layouts.master')
@section('seo')
    <title>{{ isset($exclusive_page) && isset($exclusive_page->meta_titles) ? $exclusive_page->meta_titles[lngKey()] : '' }}</title>
    <meta property="og:title" content="{{ isset($exclusive_page) && isset($exclusive_page->meta_titles) ? $exclusive_page->meta_titles[lngKey()] : '' }}" />
    <meta name="description" content="{{ isset($exclusive_page) && isset($exclusive_page->meta_descriptions) ? $exclusive_page->meta_descriptions[lngKey()] : '' }}">
    <meta property="og:description" content="{{ isset($exclusive_page) && isset($exclusive_page->meta_descriptions) ? $exclusive_page->meta_descriptions[lngKey()] : '' }}" />
    <meta property="og:url"content="{{ route('front.member.exclusive.offer') }}" />
    <meta property="og:locale" content="{{ lngKey() }}">
    <meta property="og:image" content="{{ isset($exclusive_page) ? asset($exclusive_page->meta_image) : '' }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="{{ isset($exclusive_page) ? $exclusive_page->meta_image_alt : '' }}">
@endsection
@section('content')
    @php
        $tier_name  = 'tier_benefit_'.lngKey();
        $work_name  = 'work_'.lngKey();
    @endphp
    <div component-name="rem-banner">
        <div class="relative">
            <img src="{{ isset($exclusive_page) ? asset($exclusive_page->banner_image) : ''  }}" class="min-h-[200px] object-cover lg:min-h-auto w-full"
                alt="{{ isset($exclusive_page) ? $exclusive_page->banner_image_alt : '' }}">

        </div>


    </div>
    <div component-name="rem-membercard" class="rem-container160 py-20">

        <h2 class="rem-text-40 montserrat-semibold text-blackcustom pb-9 md:pb-60 text-center">{{ isset($exclusive_page) && isset($exclusive_page->banner_titles) ? $exclusive_page->banner_titles[lngKey()] : '' }}</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:gap-[35px]">
            @if (isset($exclusive_offers))
                @foreach ($exclusive_offers as $exclusive_offer)
                    <div class="flex flex-col justify-between rem-membercard">
                        <div>
                            <img src="{{ asset($exclusive_offer->image) }}" alt="{{ isset($exclusive_offer) ? $exclusive_offer->image_alt : '' }}" class="pb-6 md:pb-9 w-full rounded-tr-[50px]">
                            <p class="pb-3 md:pb-5 montserrat text-remdark rem-text-36">{{ isset($exclusive_offer->titles) ? $exclusive_offer->titles[lngKey()] : '' }}</p>
                            <p class="montserrat text-remdark rem-memberdes pb-5">{{ isset($exclusive_offer->descriptions) ? $exclusive_offer->descriptions[lngKey()] : '' }}</p>
                        </div>
                        <a href="{{ $exclusive_offer->link }}"
                            class="inline-block w-fit py-3 px-6 border border-rembrown bg-whitez text-rembrown montserrat-bold text-center hover:bg-rembrown hover:text-mainyellow">{{ __('frontend.member_exclusive_offer.shop_now') }}</a>
                    </div>
                @endforeach
            @endif

            {{-- <div class="flex flex-col justify-between rem-membercard">
                <div>
                    <img src="./img/exclusive2.png" alt="item image" class="pb-6 md:pb-9 w-full rounded-tr-[50px]">
                    <p class="pb-3 md:pb-5 montserrat text-remdark rem-text-36">Friends Referral</p>
                    <p class="montserrat text-remdark rem-memberdes pb-5">What you are reading now is not real
                        copywriting. These texts only show where the copy will be placed.</p>
                </div>
                <a href="./promotion.html"
                    class="inline-block w-fit py-3 px-6 border border-rembrown bg-whitez text-rembrown montserrat-bold text-center hover:bg-rembrown hover:text-mainyellow">Shop
                    Now</a>
            </div>

            <div class="flex flex-col justify-between rem-membercard">
                <div>
                    <img src="./img/exclusive3.png" alt="item image" class="pb-6 md:pb-9 w-full rounded-tr-[50px]">
                    <p class="pb-3 md:pb-5 montserrat text-remdark rem-text-36">Birthday Coupon</p>
                    <p class="montserrat text-remdark rem-memberdes pb-5">What you are reading now is not real
                        copywriting. These texts only show where the copy will be placed.</p>
                </div>
                <a href="./promotion.html"
                    class="inline-block w-fit py-3 px-6 border border-rembrown bg-whitez text-rembrown montserrat-bold text-center hover:bg-rembrown hover:text-mainyellow">Shop
                    Now</a>
            </div> --}}

        </div>
    </div>
    <div component-name="rem-tierbenefit" class="container200 tier-benefit pb-9 md:pb-50">
        {!! isset($exclusive_page) ? $exclusive_page->$tier_name : '' !!}
        {{-- <h2 class="rem-text-40 text-blackcustom montserrat-semibold text-center pb-60">Tiers & Benefit</h2>
        <table class="w-full">
            <thead>
                <tr>

                    <th class="bg-remlinear p-5">
                        <div class="flex lg:justify-center">
                            <img src="" alt="">
                            <div class="text-left">
                                <p class="montserrat-bold rem-text-20 "></p>
                                <p class="montserrat rem-text-18 text-blackcustom"></p>
                            </div>
                        </div>
                    </th>

                    <th class="bg-remlinear p-5">
                        <div class="flex lg:justify-center">
                            <img src="./img/table-bottlewhite.svg" alt="">
                            <div class="text-left">
                                <p class="montserrat-bold rem-text-20 text-blackcustom">Sliver</p>
                                <p class="montserrat rem-text-18 text-blackcustom">Obtain HK$TBC</p>
                            </div>
                        </div>
                    </th>

                    <th class="bg-remlinear p-5">
                        <div class="flex lg:justify-center">
                            <img src="./img/table-bottleyellow.svg" alt="">
                            <div class="text-left">
                                <p class="montserrat-bold rem-text-20 text-mainyellow">Gold</p>
                                <p class="montserrat rem-text-18 text-blackcustom">Obtain HK$TBC</p>
                            </div>
                        </div>
                    </th>

                    <th class="bg-remlinear p-5">
                        <div class="flex lg:justify-center">
                            <img src="./img/table-bottlegray.svg" alt="">
                            <div class="text-left">
                                <p class="montserrat-bold rem-text-20 text-blackcustom">Platinum</p>
                                <p class="montserrat rem-text-18 text-blackcustom">Obtain HK$TBC</p>
                            </div>
                        </div>
                    </th>

                </tr>
            </thead>
            <tbody>

                <tr>
                    <td headers="" class="montserrat-semibold rem-text-20 text-remdark p-3 md:p-5">Spending</td>
                    <td headers="Silver" class="montserrat rem-text-20 text-remdark lg:text-center p-3 md:p-5">
                        $0-$1999</td>
                    <td headers="Gold" class="montserrat rem-text-20 text-remdark lg:text-center p-3 md:p-5">$2000
                    </td>
                    <td headers="Platinum" class="montserrat rem-text-20 text-remdark lg:text-center p-3 md:p-5">
                        $200,000</td>
                </tr>

                <tr>
                    <td headers="" class="montserrat-semibold rem-text-20 text-remdark p-3 md:p-5">Welcome Privilege
                    </td>
                    <td headers="Silver" class="montserrat rem-text-20 text-remdark lg:text-center p-3 md:p-5">$50
                        Off (one-time)</td>
                    <td headers="Gold" class="montserrat rem-text-20 text-remdark lg:text-center p-3 md:p-5">$50 Off
                        (one-time)</td>
                    <td headers="Platinum" class="montserrat rem-text-20 text-remdark lg:text-center p-3 md:p-5">$50
                        Off (one-time)</td>
                </tr>

                <tr>
                    <td headers="" class="montserrat-semibold rem-text-20 text-remdark p-3 md:p-5">Dedicated Offer
                        Zone</td>
                    <td headers="Silver" class="montserrat rem-text-20 text-remdark lg:text-center p-3 md:p-5"></td>
                    <td headers="Gold" class="montserrat rem-text-20 text-remdark lg:text-center p-3 md:p-5">5% Off
                        on selected products</td>
                    <td headers="Platinum" class="montserrat rem-text-20 text-remdark lg:text-center p-3 md:p-5">10%
                        Off on selected products</td>
                </tr>

            </tbody>
        </table> --}}
    </div>
    <div component-name="rem-howworks" class="container200 pb-50 lg:pb-100 lg:pt-50">
        {!! isset($exclusive_page) ? $exclusive_page->$work_name : '' !!}
        {{-- <h2 class="montserrat-semibold rem-text-40 text-blackcustom pb-9 md:pb-60 text-center">How it Works</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 xl:gap-[80px] 7xl:gap-[155px] justify-between">

            <div class="pb-4 sm:p-2 xl:p-0 xl:pb-0 last-type-of:pb-0">
                <img src="./img/signup.svg" alt="icon" class="mx-auto">
                <p class="montserrat-bold text-center text-blackcustom rem-text-24 pt-5 lg:pt-10">Sign Up For Free
                </p>
                <p class="montserrat text-center text-blackcustom rem-text-18">Sign up with your email address</p>
            </div>

            <div class="pb-4 sm:p-2 xl:p-0 xl:pb-0 last-type-of:pb-0">
                <img src="./img/medal 1.svg" alt="icon" class="mx-auto">
                <p class="montserrat-bold text-center text-blackcustom rem-text-24 pt-5 lg:pt-10">Earn Points</p>
                <p class="montserrat text-center text-blackcustom rem-text-18">Every $50 spent earns you ten point.
                </p>
            </div>

            <div class="pb-4 sm:p-2 xl:p-0 xl:pb-0 last-type-of:pb-0">
                <img src="./img/money.svg" alt="icon" class="mx-auto">
                <p class="montserrat-bold text-center text-blackcustom rem-text-24 pt-5 lg:pt-10">Get Rewarded</p>
                <p class="montserrat text-center text-blackcustom rem-text-18">Use points to redeem on Rewards
                    Boutique.</p>
            </div>

            <div class="pb-4 sm:p-2 xl:p-0 xl:pb-0 last-type-of:pb-0">
                <img src="./img/about-star.svg" alt="icon" class="mx-auto">
                <p class="montserrat-bold text-center text-blackcustom rem-text-24 pt-5 lg:pt-10">Upgraded</p>
                <p class="montserrat text-center text-blackcustom rem-text-18">Advance to next tier for even more
                    benefits.</p>
            </div>

        </div> --}}

        <div class="mt-10 lg:mt-[100px] p-5 lg:p-10 bg-remlinear">
            {!! isset($exclusive_page) && isset($exclusive_page->notes) ? $exclusive_page->notes[lngKey()] : '' !!}
            {{-- <p class="montserrat-bold rem-text-24 text-rembrown pb-5">Note:</p>
            <p class="montserrat rem-text-18 text-rembrown2 text-justify">Lorem Ipsum is simply dummy text of the
                printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever
                since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type
                specimen book. It has survived not only five centuries, but also the leap into electronic
                typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of
                Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software
                like Aldus PageMaker including versions of Lorem Ipsum.</p> --}}
        </div>

    </div>
@endsection