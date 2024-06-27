@extends('frontend.layouts.master')
@section('seo')
    @if ($filter_seo)
        <title>{{ isset($filter_seo) && isset($filter_seo->meta_titles) ? $filter_seo->meta_titles[lngKey()] : '' }}</title>
        <meta property="og:title" content="{{ isset($filter_seo) && isset($filter_seo->meta_titles[lngKey()]) ? $filter_seo->meta_titles[lngKey()] : '' }}" />
        <meta name="description" content="{{ isset($filter_seo) && isset($filter_seo->meta_descriptions[lngKey()]) ? $filter_seo->meta_descriptions[lngKey()] : '' }}">
        <meta property="og:description" content="{{ isset($filter_seo) && isset($filter_seo->meta_descriptions[lngKey()]) ? $filter_seo->meta_descriptions[lngKey()] : '' }}" />
        <meta property="og:url"content="{{ route('front.product') }}" />
        <meta property="og:locale" content="{{ lngKey() }}">
        <meta property="og:image" content="{{ isset($filter_seo) ? asset($filter_seo->meta_image) : '' }}">
        <meta property="og:image:width" content="1200">
        <meta property="og:image:height" content="630">
        <meta property="og:image:alt" content="{{ isset($filter_seo) ? $filter_seo->meta_image_alt : '' }}">
    @else
        <title>{{ isset($seo_product) && isset($seo_product->product_meta) && isset($seo_product->product_meta->meta_titles[lngKey()]) ? $seo_product->product_meta->meta_titles[lngKey()] : '' }}</title>
        <meta property="og:title" content="{{ isset($seo_product) && isset($seo_product->product_meta) && isset($seo_product->product_meta->meta_titles[lngKey()]) ? $seo_product->product_meta->meta_titles[lngKey()] : '' }}" />
        <meta name="description" content="{{ isset($seo_product) && isset($seo_product->product_meta) && isset($seo_product->product_meta->meta_descriptions[lngKey()]) ? $seo_product->product_meta->meta_descriptions[lngKey()] : '' }}">
        <meta property="og:description" content="{{ isset($seo_product) && isset($seo_product->product_meta) && isset($seo_product->product_meta->meta_descriptions[lngKey()]) ? $seo_product->product_meta->meta_descriptions[lngKey()] : '' }}" />
        <meta property="og:url"content="{{ route('front.product') }}" />
        <meta property="og:locale" content="{{ lngKey() }}">
        <meta property="og:image" content="{{ isset($seo_product) && isset($seo_product->product_meta) && isset($seo_product->product_meta->meta_image) ? $$seo_product->product_meta->meta_image : '' }}">
        <meta property="og:image:width" content="1200">
        <meta property="og:image:height" content="630">
        <meta property="og:image:alt" content="{{ isset($seo_product) && isset($seo_product->product_meta) && isset($seo_product->product_meta->meta_image_alt) ? $seo_product->product_meta->meta_image_alt : '' }}">
    @endif
@endsection
@section('content')
@php
    $name        = "name_".lngKey();
    $locale_name = "name_".lngKey();
@endphp
    <div component-name="rem-banner">
        <div class="relative">
            <img src="{{ isset($filter_seo) ? asset($filter_seo->image) : asset('frontend/img/promotion-banner.png') }}" class="min-h-[200px] object-cover lg:min-h-auto w-full"
                alt="{{ isset($filter_seo) ? $filter_seo->image_alt : 'banner image' }}">


            <h1
                class="text-transparent montserrat-bold absolute left-1/2 top-1/2 -translate-y-1/2 -translate-x-1/2">
                {{ isset($filter_seo) && isset($filter_seo->titles) && isset($filter_seo->titles[lngKey()]) ? $filter_seo->titles[lngKey()] : 'Banner' }}</h1>

        </div>

        <div class="grid grid-cols-2 items-center lg:hidden mb-filter bg-remlinear">
            <div class="text-center border-r border-r-remDF h-full">
                <p class="montserrat rem-text-12 text-remdark h-full flex items-center justify-center relative"
                    onclick="showSidebar()">{{__('frontend.product.filter')}}
                    <svg xmlns="http://www.w3.org/2000/svg" class="ml-3" width="8" height="7" viewBox="0 0 8 7"
                        fill="none">
                        <path d="M1 3.5L3 5.5L7 1.5" stroke="#1E1D1B" stroke-width="2" stroke-linecap="round" />
                    </svg>
                </p>
            </div>
            <div class="">
                <div component-name="rem-customdropdown" class="rem-customdropdown relative ">
                    <input type="text" hidden>
                    <div
                        class="flex items-center justify-between xl:gap-3 px-[10px] customdropdown-btn py-3 cursor-pointer border-dropdown">
                        <p class="montserrat rem-text-16 text-remdark">
                            {{__('frontend.product.best_selling')}}
                        </p>
                        <img src="{{ asset('frontend/img/dropdownicon.svg') }}" alt="dropdown icon">
                    </div>
                    <div
                        class="hidden w-full customdropdown-content min-w-[166px] absolute right-0 top-14 rounded-[3px] p-4 bg-white z-[1]">
                        <span class="triangle absolute right-4"></span>
                        <ul>

                            <li data-value="best-sell"
                                class="adminSort pb-[10px] last-of-type:pb-0 montserrat text-blackcustom cursor-pointer selected-item">
                                {{__('frontend.product.best_selling')}}</li>

                            <li data-value="price-desc" class="adminSort pb-[10px] last-of-type:pb-0 montserrat text-blackcustom cursor-pointer ">
                                {{__('frontend.product.high_to_low')}}</li>

                            <li data-value="price-asc" class="adminSort pb-[10px] last-of-type:pb-0 montserrat text-blackcustom cursor-pointer ">
                                {{__('frontend.product.low_to_high')}}</li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>


        <div class="rem-breadcrumb container120 py-10 flex items-center flex-wrap">

            <a href="/" class="text-remdark montserrat flex items-center ">
                {{__('frontend.product.home')}}
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                    <path d="M10 17.5L15 12.5L10 7.5" stroke="black" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </a>

            @if($breadcrumb_array)
                @foreach ($breadcrumb_array as $breadcrumb)
                    <a href="{{ url($breadcrumb['url'] ?? '/') }}" class="text-remdark montserrat flex items-center active">
                        {{ $breadcrumb['name'] ?? '' }}
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                            <path d="M10 17.5L15 12.5L10 7.5" stroke="black" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </a>
                @endforeach
            @endif
        </div>

    </div>
    <div component-name="rem-promotion" class="container120 rem-productview">
        <h2 class="montserrat-semibold text-rembrown pb-6 lg:pb-10 flex items-center justify-between lg:block">
            {{ $breadcrumb_name ?? '' }}
            {{-- <p class="montserrat text-remdark rem-text-12 lg:hidden">{{ $products->total() }} Items</p> --}}
        </h2>
        <div class="lg:flex xl:gap-[50px]">

            @include('frontend.product.product._product_filter_left_sidebar')

            <div class="lg:flex-[0_1_75%] lg:max-w-[75%] lg:pl-8 xl:pl-0">
                <div class="hidden lg:flex justify-between">
                    <div class="flex xl:gap-5 pb-5 md:pb-0 lg:flex-[0_1_80%] lg:max-w-[80%]">
                        <p class="montserrat-semibold text-blackcustom rem-text-18 pr-4 xl:pr-0">{{__('frontend.product.filter')}}</p>

                        <div class="flex items-center flex-wrap filter-categories">
                        </div>

                    </div>
                    <div>
                        <div component-name="rem-customdropdown"
                            class="rem-customdropdown relative selectbox_dropdown">
                            <input type="text" hidden>
                            <input type="hidden" id="sort-by">
                            <div
                                class="flex items-center justify-between xl:gap-3 px-[10px] customdropdown-btn py-3 cursor-pointer border-dropdown min-w-[200px]">
                                <p class="montserrat rem-text-16 text-remdark">
                                    {{__('frontend.product.best_selling')}}
                                </p>
                                <img src="{{ asset('frontend/img/dropdownicon.svg') }}" alt="dropdown icon">
                            </div>
                            <div
                                class="hidden w-full customdropdown-content min-w-[166px] absolute right-0 top-14 rounded-[3px] p-4 bg-white z-[1]">
                                <span class="triangle absolute right-4"></span>
                                <ul>

                                    <li data-value="best-sell"
                                        class="adminSort pb-[10px] last-of-type:pb-0 montserrat text-blackcustom cursor-pointer selected-item">
                                        {{__('frontend.product.best_selling')}}</li>

                                    <li data-value="price-desc"
                                        class="adminSort pb-[10px] last-of-type:pb-0 montserrat text-blackcustom cursor-pointer ">
                                        {{__('frontend.product.high_to_low')}}</li>

                                    <li data-value="price-asc"
                                        class="adminSort pb-[10px] last-of-type:pb-0 montserrat text-blackcustom cursor-pointer ">
                                        {{__('frontend.product.low_to_high')}}</li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="py-10 hidden lg:flex items-center justify-between">
                    <div class="flex view-container">
                        <p data-action="grid" class="cursor-pointer active-view">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <path
                                    d="M5.5998 11.2008H10.3998C10.612 11.2008 10.8155 11.1165 10.9655 10.9665C11.1155 10.8164 11.1998 10.613 11.1998 10.4008V5.60078C11.1998 5.38861 11.1155 5.18512 10.9655 5.0351C10.8155 4.88507 10.612 4.80078 10.3998 4.80078H5.5998C5.38763 4.80078 5.18415 4.88507 5.03412 5.0351C4.88409 5.18512 4.7998 5.38861 4.7998 5.60078V10.4008C4.7998 10.613 4.88409 10.8164 5.03412 10.9665C5.18415 11.1165 5.38763 11.2008 5.5998 11.2008ZM13.5998 11.2008H18.3998C18.612 11.2008 18.8155 11.1165 18.9655 10.9665C19.1155 10.8164 19.1998 10.613 19.1998 10.4008V5.60078C19.1998 5.38861 19.1155 5.18512 18.9655 5.0351C18.8155 4.88507 18.612 4.80078 18.3998 4.80078H13.5998C13.3876 4.80078 13.1841 4.88507 13.0341 5.0351C12.8841 5.18512 12.7998 5.38861 12.7998 5.60078V10.4008C12.7998 10.613 12.8841 10.8164 13.0341 10.9665C13.1841 11.1165 13.3876 11.2008 13.5998 11.2008ZM5.5998 19.2008H10.3998C10.612 19.2008 10.8155 19.1165 10.9655 18.9665C11.1155 18.8164 11.1998 18.613 11.1998 18.4008V13.6008C11.1998 13.3886 11.1155 13.1851 10.9655 13.0351C10.8155 12.8851 10.612 12.8008 10.3998 12.8008H5.5998C5.38763 12.8008 5.18415 12.8851 5.03412 13.0351C4.88409 13.1851 4.7998 13.3886 4.7998 13.6008V18.4008C4.7998 18.613 4.88409 18.8164 5.03412 18.9665C5.18415 19.1165 5.38763 19.2008 5.5998 19.2008ZM13.5998 19.2008H18.3998C18.612 19.2008 18.8155 19.1165 18.9655 18.9665C19.1155 18.8164 19.1998 18.613 19.1998 18.4008V13.6008C19.1998 13.3886 19.1155 13.1851 18.9655 13.0351C18.8155 12.8851 18.612 12.8008 18.3998 12.8008H13.5998C13.3876 12.8008 13.1841 12.8851 13.0341 13.0351C12.8841 13.1851 12.7998 13.3886 12.7998 13.6008V18.4008C12.7998 18.613 12.8841 18.8164 13.0341 18.9665C13.1841 19.1165 13.3876 19.2008 13.5998 19.2008Z"
                                    fill="#DFDFDF" />
                            </svg>
                        </p>
                        <p data-action="list" class="cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <path
                                    d="M20.3996 11.2808V12.7208C20.3996 12.9117 20.3259 13.0949 20.1946 13.2299C20.0633 13.3649 19.8853 13.4408 19.6996 13.4408H4.29961C4.11396 13.4408 3.93591 13.3649 3.80463 13.2299C3.67336 13.0949 3.59961 12.9117 3.59961 12.7208V11.2808C3.59961 11.0898 3.67336 10.9067 3.80463 10.7717C3.93591 10.6366 4.11396 10.5608 4.29961 10.5608H19.6996C19.8853 10.5608 20.0633 10.6366 20.1946 10.7717C20.3259 10.9067 20.3996 11.0898 20.3996 11.2808ZM19.6996 16.3208H4.29961C4.11396 16.3208 3.93591 16.3966 3.80463 16.5317C3.67336 16.6667 3.59961 16.8498 3.59961 17.0408V18.4808C3.59961 18.6717 3.67336 18.8549 3.80463 18.9899C3.93591 19.1249 4.11396 19.2008 4.29961 19.2008H19.6996C19.8853 19.2008 20.0633 19.1249 20.1946 18.9899C20.3259 18.8549 20.3996 18.6717 20.3996 18.4808V17.0408C20.3996 16.8498 20.3259 16.6667 20.1946 16.5317C20.0633 16.3966 19.8853 16.3208 19.6996 16.3208ZM19.6996 4.80078H4.29961C4.11396 4.80078 3.93591 4.87664 3.80463 5.01166C3.67336 5.14669 3.59961 5.32983 3.59961 5.52078V6.96078C3.59961 7.15174 3.67336 7.33487 3.80463 7.4699C3.93591 7.60492 4.11396 7.68078 4.29961 7.68078H19.6996C19.8853 7.68078 20.0633 7.60492 20.1946 7.4699C20.3259 7.33487 20.3996 7.15174 20.3996 6.96078V5.52078C20.3996 5.32983 20.3259 5.14669 20.1946 5.01166C20.0633 4.87664 19.8853 4.80078 19.6996 4.80078Z"
                                    fill="#DFDFDF" />
                            </svg>
                        </p>
                    </div>
                    {{-- <p class="montserrat-medium text-blackcustom rem-text-16">Showing {{ $products->currentPage() }}-{{ $products->lastPage() }} of {{ $products->total() }}</p> --}}
                    <p class="montserrat-medium text-blackcustom rem-text-16">
                        {{__('frontend.product.showing')}} <span class="adminFirstItem">{{ $products->firstItem() }}</span> - <span class="adminLastItem">{{ $products->lastItem() }}</span> {{__('frontend.product.of')}} <span>{{ $products->total() }}</span>
                    </p>
                </div>
                
                <div class="product-container grid-view adminProductList">
                    @include('frontend.product.product._list', ['locale_name' => $locale_name])
                </div>
            </div>
        </div>
        {{-- {!! $products->appends([])->links('frontend.product.product._pagination')->render() !!} --}}
        <div class="py-10 md:pb-20 flex items-center xl:gap-[10px] justify-center lg:justify-end">
            <input type="hidden" name="current_page" value="{{ request('page') ?? 1 }}">
            <input type="hidden" name="last_page" value="{{ $products->lastPage() }}">
            <a href="" id="adminLeftLink" class="adminProductPagination {{ $products->currentPage() == 1 ? 'rem-disabled' : '' }}" data-option="left">
                <img src="{{ asset('frontend/img/arrow-left.svg') }}" alt="arrow right" id="adminLeftArrow" class="rotate-180 opacity-30">
            </a>
            <p class="montserrat text-[#1C1D1D] rem-text-16">{{__('frontend.product.page')}} <span class="adminCurrentPage">{{ $products->currentPage() }}</span> {{__('frontend.product.of')}} <span>{{ $products->lastPage() }}</span></p>
            <a href="" id="adminRightLink" class="adminProductPagination" data-option="right">
                <img src="{{ asset('frontend/img/arrow-left.svg') }}" alt="arrow right" id="adminRightArrow">
            </a>
        </div>
    </div>
@endsection

@push('scripts')
<script src="{{ asset('frontend/custom/product-filter.js?v='.time()) }}"></script>
<script src="{{ asset('frontend/custom/product/product.js?v='.time()) }}"></script>
{{-- <script src="{{ asset('frontend/custom/cart.js?v='.time()) }}"></script> --}}
@endpush