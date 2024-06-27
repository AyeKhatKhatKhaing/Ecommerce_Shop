@extends('frontend.layouts.master')
@section('seo')
    <title>{{ isset($home) && isset($home->meta_titles[lngKey()]) ? $home->meta_titles[lngKey()] : config('app.name') }}</title>
    <meta property="og:title" content="{{ isset($home) && isset($home->meta_titles[lngKey()]) ? $home->meta_titles[lngKey()] : '' }}" />
    <meta name="description" content="{{ isset($home) && isset($home->meta_descriptions[lngKey()]) ? $home->meta_descriptions[lngKey()] : '' }}">
    <meta property="og:description" content="{{ isset($home) && isset($home->meta_descriptions[lngKey()]) ? $home->meta_descriptions[lngKey()] : '' }}" />
    <meta property="og:url"content="{{ url('/') }}" />
    <meta property="og:locale" content="{{ lngKey() }}">
    <meta property="og:image" content="{{ isset($home) ? asset($home->meta_image) : '' }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="{{ isset($home) ? $home->meta_image_alt : '' }}">
@endsection
@section('content')
    @php
        $product_name  = "name_".lngKey();
        $locale_name  = "name_".lngKey();
    @endphp
    <div component-name="rem-home-slide">
        <div id="rem-homeslider">
            @if (isset($sliders) && $sliders->count() > 0)
                @foreach ($sliders as $slider)
                    <div class="relative">
                        <img src="{{ asset($slider->banner_image) }}" alt="{{ $slider->banner_image_alt }}" class="show-from-tablet w-full md:h-[400px] xl:h-auto">
                        <img src="{{ asset($slider->mb_banner_image) }}" alt="{{ $slider->mb_banner_image_alt }}" class="show-only-mobile w-full">
                        <div class="absolute px-5 2xs:px-0 2xs:left-1/2 2xs:-translate-x-1/2 top-1/2 -translate-y-1/2 text-center home-slidertext-container">
                            <p class="montserrat rem-text-20 text-whitez">{{ $slider->names[lngKey()] }}</p>
                            <h2 class="montserrat rem-text-64 text-whitez leading-[1]">{{ $slider->titles[lngKey()] }}</h2>
                            {{-- <p class="montserrat rem-text-20 text-whitez py-3 pb-5 3xl:pb-9">Australian Wine Limited Time Clearance Offer</p> --}}
                            {!! $slider->descriptions[lngKey()] !!}
                            <button type="button" onclick="window.location.href='{{ url($slider->link) }}'" class="text-rembrown px-9 py-2 2xs:py-3 border border-whitez bg-whitez hover:bg-transparent hover:text-whitez">{{ __('frontend.home.view_detail') }}</button>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    <!-- Begin::Latest Product Section -->
    @if(isset($latest_products) && $latest_products->count() > 0)
        @include('frontend.home._latest_product')
    @endif
    <!-- end::Latest Product Section -->

    <div component-name="rem-homefeature" class="py-4 md:py-50">
        <div class="rem-homefeature bg-mainlinen md:flex md:items-center 7xl:justify-center">
            <div class="pb-5 md:pb-0 md:pr-10 xl:pr-[95px]">
                <p class="pb-5 text-remdark montserrat rem-text-20 capitalize">{{ isset($home) && isset($home->feature_names) ? $home->feature_names[lngKey()] : '' }}</p>
                <h3 class="rem-text-40 montserrat-semibold text-remdark">{{ isset($home) && isset($home->feature_titles) ? $home->feature_titles[lngKey()] : '' }}</h3>
                {!! isset($home) && isset($home->feature_descriptions) ? $home->feature_descriptions[lngKey()] : '' !!}
                {{-- <p class="pt-4 pb-5 md:pt-9 md:pb-12 montserrat rem-text-18 text-remdark">Among many world-renowned wine brands, Remfly carefully recommends them for you</p> --}}
                <a href="{{ isset($home) ? $home->feature_link : '' }}" class="inline-block bg-rembrown border border-rembrown py-3 px-9 hover:bg-transparent text-whitez hover:text-rembrown montserrat-semibold rem-text-20 text-center capitalize">{{ __('frontend.home.more_products') }}</a>
            </div>
            <p><img src="{{ isset($home) && isset($home->feature_image) ? asset($home->feature_image) : asset('frontend/img/rhome-feat.png') }}" alt="{{ isset($home) && isset($home->feature_image_alt) ? $home->feature_image_alt : '' }}"></p>
        </div>
    </div>

    <!-- Begin::Hot Seller Section -->
    @if (isset($hot_sellers) && $hot_sellers->count() > 0)
        @include('frontend.home._hot_seller')
    @endif
    <!-- end::Hot Seller Section -->

    <div component-name="rem-homepenhold" class="w-full relative py-4 md:py-50">
        <img src="{{ isset($home->penfold_image) ? asset($home->penfold_image) : asset('frontend/img/member.png') }}" alt="{{ isset($home) && isset($home->penfold_image_alt) ? $home->penfold_image_alt : '' }}" class="w-full object-cover h-[367px] lg:h-auto">
        <div class="absolute top-1/2 -translate-y-1/2 w-full text-center">
            <p class="text-whitez montserrat rem-text-20 capitalize">{{ isset($home) && isset($home->penfold_names) ? $home->penfold_names[lngKey()] : '' }}</p>
            <h1 class="rem-text-64 montserrat text-whitez">{{ isset($home) && isset($home->penfold_titles) ? $home->penfold_titles[lngKey()] : '' }}</h1>
            {!! isset($home) && isset($home->penfold_descriptions) ? $home->penfold_descriptions[lngKey()] : '' !!}
            {{-- <p class="pb-5 md:pb-8 montserrat text-22 text-whitez">Australian Wine Limited Time Clearance Offer</p> --}}
            <a href="{{ isset($home) ? $home->penfold_link : '' }}" class="inline-block bg-whitez border border-whitez py-3 px-9 hover:bg-transparent text-rembrown hover:text-whitez montserrat-semibold rem-text-20 text-center capitalize">{{ __('frontend.home.check_the_detail') }}</a>
        </div>
    </div>
    
    <!-- Begin::Exclusive Agency Product Section -->
    @if(isset($exclusive_products) && $exclusive_products->count() > 0)
        @include('frontend.home._exclusive_agency_product')
    @endif
    <!-- end::Exclusive Agency Product Section -->

    <div component-name="rem-membercard" class="rem-container160 py-50">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:gap-[35px]">
            <div class="flex flex-col justify-between rem-membercard">
                <div>
                    <img src="{{ isset($home->exclusive_image) ? asset($home->exclusive_image) : asset('frontend/img/member.png') }}" alt="{{ isset($home) && isset($home->exclusive_image_alt) ? $home->exclusive_image_alt : '' }}" class="pb-6 md:pb-9 w-full rounded-tr-[50px]">
                    <p class="pb-3 md:pb-5 montserrat-semibold md:montserrat text-remdark rem-text-36">Member Exclusive Offers</p>
                    {{-- <p class="montserrat text-remdark rem-memberdes pb-5">Member exclusive offers will be announced soon, please pay close attention to this website or visit the Facebook page for details!</p> --}}
                    {!! isset($home) && isset($home->exclusive_descriptions) ? $home->exclusive_descriptions[lngKey()] : '' !!}
                </div>
                <a href="{{ isset($home) ? $home->exclusive_link : '' }}" class="inline-block w-fit py-3 px-6 border border-rembrown bg-whitez text-rembrown montserrat-bold text-center hover:bg-rembrown hover:text-mainyellow">{{ __('frontend.home.learn_more') }}</a>
            </div>
        
            <div class="flex flex-col justify-between rem-membercard">
                <div>
                    <img src="{{ isset($home->about_image) ? asset($home->about_image) : asset('frontend/img/member2.png') }}" alt="{{ isset($home) && isset($home->about_image_alt) ? $home->about_image_alt : '' }}" class="pb-6 md:pb-9 w-full rounded-tr-[50px]">
                    <p class="pb-3 md:pb-5 montserrat-semibold md:montserrat text-remdark rem-text-36">{{ isset($home) && isset($home->about_titles) ? $home->about_titles[lngKey()] : '' }}</p>
                    {{-- <p class="montserrat text-remdark rem-memberdes pb-5">What you are reading now is not real copywriting. These texts only show where the copy will be placed.</p> --}}
                    {!! isset($home) && isset($home->about_descriptions) ? $home->about_descriptions[lngKey()] : '' !!}
                </div>
                <a href="{{ isset($home) ? $home->about_link : '' }}" class="inline-block w-fit py-3 px-6 border border-rembrown bg-whitez text-rembrown montserrat-bold text-center hover:bg-rembrown hover:text-mainyellow">{{ __('frontend.home.learn_more') }}</a>
            </div>
        
            <div class="flex flex-col justify-between rem-membercard">
                <div>
                    <img src="{{ isset($home->store_image) ? asset($home->store_image) : asset('frontend/img/member3.png') }}" alt="{{ isset($home) && isset($home->store_image_alt) ? $home->store_image_alt : '' }}" class="pb-6 md:pb-9 w-full rounded-tr-[50px]">
                    <p class="pb-3 md:pb-5 montserrat-semibold md:montserrat text-remdark rem-text-36">{{ isset($home) && isset($home->store_titles) ? $home->store_titles[lngKey()] : '' }}</p>
                    {{-- <p class="montserrat text-remdark rem-memberdes pb-5">What you are reading now is not real copywriting. These texts only show where the copy will be placed.</p> --}}
                    {!! isset($home) && isset($home->store_descriptions) ? $home->store_descriptions[lngKey()] : '' !!}
                </div>
                <a href="{{ isset($home) ? $home->store_link : '' }}" class="inline-block w-fit py-3 px-6 border border-rembrown bg-whitez text-rembrown montserrat-bold text-center hover:bg-rembrown hover:text-mainyellow">{{ __('frontend.home.learn_more') }}</a>
            </div> 
        </div>
    </div>
    <div component-name="rem-partnerslide" class="md:pt-50 pb-11">
        <div class="" id="partner-slide">
            @if (isset($home))
                @foreach($home->brand_logo as $logo)
                <a href="{{ ($logo['url']) }}" class="mr-4 md:mr-0">
                    <img src="{{ ($logo['image']) }}" alt="{{ $logo['image_alt'] }}" class="mx-auto">
                </a>
                @endforeach
            @endif            
        </div>
    </div>
@endsection