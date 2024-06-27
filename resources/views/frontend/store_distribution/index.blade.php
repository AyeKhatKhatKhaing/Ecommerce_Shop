@extends('frontend.layouts.master')
@section('seo')
    <title>{{ isset($store_page) && isset($store_page->meta_titles) ? $store_page->meta_titles[lngKey()] : '' }}</title>
    <meta property="og:title" content="{{ isset($store_page) && isset($store_page->meta_titles) ? $store_page->meta_titles[lngKey()] : '' }}" />
    <meta name="description" content="{{ isset($store_page) && isset($store_page->meta_descriptions) ? $store_page->meta_descriptions[lngKey()] : '' }}">
    <meta property="og:description" content="{{ isset($store_page) && isset($store_page->meta_descriptions) ? $store_page->meta_descriptions[lngKey()] : '' }}" />
    <meta property="og:url"content="{{ route('front.store.distribution') }}" />
    <meta property="og:locale" content="{{ lngKey() }}">
    <meta property="og:image" content="{{ isset($store_page) ? asset($store_page->meta_image) : '' }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="{{ isset($store_page) ? $store_page->meta_image_alt : '' }}">
@endsection
@section('content')
    @php
        $name = 'name_'.lngKey();
    @endphp
    <div component-name="rem-banner">
        <div class="relative">
            <img src="{{ isset($store_page) ? asset($store_page->banner_image) : ''}}" class="min-h-[200px] object-cover lg:min-h-auto w-full"
                alt="{{ isset($store_page) ? $store_page->banner_image_alt : '' }}">

            <p class="banner-text text-whitez montserrat-bold absolute left-1/2 top-1/2 -translate-y-1/2 -translate-x-1/2">{{ isset($store_page) ? $store_page->banner_titles[lngKey()] : '' }}</p>

        </div>


    </div>
    <div component-name="rem-store-distribution" class="rem-store-distribution-container">
        <div class="md:px-100 7xl:px-[257px] mt-10 md:mt-24">
            <h1 class="text-center rem-text-40 font-semibold">{{ isset($store_page) ? $store_page->titles[lngKey()] : '' }}</h1>
            {!! isset($store_page) ? $store_page->descriptions[lngKey()] : '' !!}
            {{-- <p class="text-center rem-text-18 mt-10 leading-7">The chain stores of Remfly Wines & Spirits have a
                luxurious image, providing high quality professional service. The stores showcase the fine and rare
                collection over the world, which is a rendezvous for connoisseur and wine-lovers.</p> --}}
        </div>
        <hr class="h-[2px] w-full bg-gray-200 my-16" />
        <div class="lg:flex xl:gap-16">
            <div class="lg:w-[340px] 3xl:w-[400px] flex-shrink-0 flex flex-col xl:gap-3 store-buttons pr-5 xl:pr-0 pb-4 lg:pb-0">
                @if (isset($stores))
                    @foreach ($stores as $key => $store)
                        <button data-index="{{ $key }}"
                            class="px-9 py-3 text-left rem-text-20 font-semibold transition duration-300 border border-rembrown hover:text-white hover:bg-rembrown mb-3 xl:mb-0 last-of-type:mb-0 @if ($loop->first) active bg-rembrown text-white @endif">
                            {{ $store->$name }}
                        </button>
                    @endforeach
                @endif
            </div>
            <div class="flex-1 overflow-hidden">
                <div class="contents info">
                    @if (isset($stores))
                        @foreach ($stores as $store_info)
                            <div>
                                <h2 class="rem-text-24 font-bold">{{ $store_info->$name }}</h2>
                                <p class="rem-text-18 mt-4">{{ isset($store_info->addresses) ? $store_info->addresses[lngKey()] : '' }}</p>
                                <p class="rem-text-18">{{ $store_info->phone }}</p>
                            </div>
                        @endforeach
                    @endif

                    {{-- <div>
                        <h2 class="rem-text-24 font-bold">Macau Flagship Store</h2>
                        <p class="rem-text-18 mt-4">Address: MAlameda Dr. Carlos D’assumpcao Edf China Civil Plaza
                            No. 235-243 R/c Q, R Macau</p>
                        <p class="rem-text-18">Tel: (853) 2857 5243</p>
                    </div>

                    <div>
                        <h2 class="rem-text-24 font-bold">Remfly Whisky Speciality Shop</h2>
                        <p class="rem-text-18 mt-4">Address: Avenida Dr. Sun Yat-sen, Vista Magnifica Court, R/C AA,
                            AB, Z</p>
                        <p class="rem-text-18">Tel: (853) 2884 5183</p>
                    </div>

                    <div>
                        <h2 class="rem-text-24 font-bold">Remfly Independent Whisky Bottler Specialty</h2>
                        <p class="rem-text-18 mt-4">Address: AAvenida Dr. Sun Yat-Sen, Vista Magnifica Court R/C D,E
                        </p>
                        <p class="rem-text-18">Tel: (853) 2884 3553</p>
                    </div>

                    <div>
                        <h2 class="rem-text-24 font-bold">Remfly Place</h2>
                        <p class="rem-text-18 mt-4">Address: Avenida Dr. Sun Yat-Sen, Vista Magnifica Court R/C
                            U,V,W,X</p>
                        <p class="rem-text-18">Tel: (853) 2883 6695</p>
                    </div> --}}

                </div>
                <hr class="h-[2px] w-full bg-gray-200 mt-5" />
                <div class="flex mt-4 gap-3 slick-root relative">
                    <button type="button" class="btn-prev"><img src="{{ asset('frontend/img/prev-arrow.svg') }}" alt=""></button>
                    <div class="stores flex-1">
                        @if (isset($stores))
                            @foreach ($stores as $store_image)
                                <div class="space-y-3">
                                    <img src="{{ asset($store_image->store_image) }}" alt={{ $store_image->store_image_alt }} class="w-full" />
                                    <div>{{ $store_image->$name }}</div>
                                </div>
                            @endforeach
                        @endif

                        {{-- <div class="space-y-3">
                            <img src="{{ asset('frontend/img/store-2.png') }}" class="w-full" />
                            <div>Macau Flagship Store</div>
                        </div>

                        <div class="space-y-3">
                            <img src="{{ asset('frontend/img/store-3.png') }}" class="w-full" />
                            <div>Remfly Whisky Speciality Shop</div>
                        </div>

                        <div class="space-y-3">
                            <img src="{{ asset('frontend/img/store-4.png') }}" class="w-full" />
                            <div>Remfly Independent Whisky Bottler Specialty</div>
                        </div>

                        <div class="space-y-3">
                            <img src="{{ asset('frontend/img/store-5.png') }}" class="w-full" />
                            <div>Remfly Place</div>
                        </div> --}}

                    </div>
                    <div class="thumbs w-1/5">
                        @if (isset($stores))
                            @foreach ($stores as $sub_image)
                                <img src="{{ asset($sub_image->store_image) }}" alt={{ $sub_image->store_image_alt }} class="w-full" />

                                {{-- <img src="{{ asset('frontend/img/store-2.png') }}" class="w-full" />

                                <img src="{{ asset('frontend/img/store-3.png') }}" class="w-full" />

                                <img src="{{ asset('frontend/img/store-4.png') }}" class="w-full" />

                                <img src="{{ asset('frontend/img/store-5.png') }}" class="w-full" /> --}}
                            @endforeach
                        @endif
                    </div>
                    <button type="button" class="btn-next"><img src="{{ asset('frontend/img/next-arrow.svg') }}" alt=""></button>
                </div>
            </div>
        </div>
    </div>
@endsection