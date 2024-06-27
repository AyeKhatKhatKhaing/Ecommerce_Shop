@extends('frontend.layouts.master')
@section('seo')
<title>{{ isset($product) && isset($product->product_meta) && isset($product->product_meta->meta_titles) ? $product->product_meta->meta_titles[lngKey()] : '' }}</title>
<meta property="og:title" content="{{ isset($product) && isset($product->product_meta) && isset($product->product_meta->meta_titles) ? $product->product_meta->meta_titles[lngKey()] : '' }}" />
<meta name="description" content="{{ isset($product) && isset($product->product_meta) && isset($product->product_meta->descriptions) ? $product->product_meta->descriptions[lngKey()] : '' }}">
<meta property="og:description" content="{{ isset($product) && isset($product->product_meta) && isset($product->product_meta->descriptions) ? $product->product_meta->descriptions[lngKey()] : '' }}" />
<meta property="og:url"content="{{ route('front.product.detail', $product->code) }}" />
<meta property="og:locale" content="{{ lngKey() }}">
<meta property="og:image" content="{{ isset($product) && isset($product->product_meta) && isset($product->product_meta->meta_image) ? $$product->product_meta->meta_image : '' }}">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:image:alt" content="{{ isset($product) && isset($product->product_meta) && isset($product->product_meta->meta_image_alt) ? $product->product_meta->meta_image_alt : '' }}">
@endsection
@section('content')
    @php
        $name                  = "name_".lngKey();
        $locale_name           = "name_".lngKey();
        $country_name          = "name_".lngKey();    
        $offer_promotion_name  = "name_".lngKey();
    @endphp 
    <div component-name="rem-productdetail" class="detail-container">
        <div class="rem-breadcrumb pb-5 flex items-center">

            <a href="{{ url('/') }}" class="text-remdark montserrat flex items-center ">
                {{__('frontend.product_detail.home')}}
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                    <path d="M10 17.5L15 12.5L10 7.5" stroke="black" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </a>

            <a href="{{ url('product') }}" class="text-remdark montserrat flex items-center ">
                {{__('frontend.product_detail.product_list')}}
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                    <path d="M10 17.5L15 12.5L10 7.5" stroke="black" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </a>
            
            <a href="{{ route('front.product.detail', ['code' => $product->code]) }}" class="text-remdark montserrat flex items-center active">
                {{ $product->$name }}
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                    <path d="M10 17.5L15 12.5L10 7.5" stroke="black" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 xl:gap-20">
            <div class="detail-imgcontainer">
                <p class="border border-remDF">
                    <img src="{{ asset($product->feature_image) }}" alt="{{ isset($product->feature_image_alt) ? $product->feature_image_alt : '' }}" class="w-full lg:w-full">
                </p>
            </div>

            <div class="detail-rightside lg:pl-6 xl:pl-0">
                <p class="montserrat text-remdark rem-text-36">{{ $product->$name }}</p>
                <p class="montserrat-medium text-rembrown rem-text-16">{{ $product->country ? $product->country->$country_name : '' }}</p>
                @if(!$product->is_other)
                    <div class="flex flex-wrap items-center py-[30px]">
                        <p class="montserrat-bold relative super-lasttwo"><span>{{ currency() }}</span><span>{{ $product->sale_price }}</span></p>
                            <!-- admin promotion label component -->
                            <x-frontend.promotion-label :product="$product"/>
                    </div>
                    <div class="flex items-center detail-qtyinput">
                        <p class="montserrat-semibold text-blackcustom rem-text-18 pr-3">{{__('frontend.product_detail.qty')}}</p>
                        <div class="flex items-center border border-remDF p-2 rounded-[3px] max-w-[88px]">
                            <button type="button" data-action="decrease" class="{{ $product->isSoldOut($product) ? 'rem-disabled' : '' }}">-</button>
                            <input type="number" name="p_detail_number_{{ $product->id }}" min="0" value="{{ $product->isSoldOut($product) ? 0 : 1 }}" class="w-full text-center outline-0 {{ $product->isSoldOut($product) ? 'rem-disabled' : '' }}">
                            <button type="button" data-action="increase" class="{{ $product->isSoldOut($product) ? 'rem-disabled' : '' }}">+</button>
                        </div>
                    </div>
                    <div class="adminpDetailOutOfStock flex items-center border-2 border-mainyellow rounded py-1 px-2 mt-7 {{ $product->isSoldOut($product) ? '' : 'hidden' }}">
                        <span
                            class="w-6 h-6 flex items-center justify-center rounded-full border-2 border-[#F79E1B] mr-2 text-[#F79E1B]">i</span>
                        <p class="montserrat-medium text-remdark rem-text-16 flex-[0_1_80%] max-w-[80%]">{{__('frontend.product_detail.temporarily')}}<span class="adminAssignQauntity"></span> {{__('frontend.product_detail.item_to_cart')}}
                        </p>
                    </div>
                    <div class="py-[30px]">
                        <p class="montserrat-medium rem-text-18 text-blackcustom exclusive-delivery px-5">{!! isset($product->product_meta->contents) ? $product->product_meta->contents[lngKey()] : '' !!}</p>
                        @php
                            $date = Carbon\Carbon::now()->format('Y-m-d H:i:s');
                        @endphp
                        @if (isset($product->offer_promotion->start_date) && isset($product->offer_promotion->end_date))
                            @if ($date > $product->offer_promotion->start_date &&  $date < $product->offer_promotion->end_date)
                                <p class="montserrat-medium rem-text-18 text-blackcustom limited-offer px-5 mt-3 w-fit">{{ $product->offer_promotion ? $product->offer_promotion->$offer_promotion_name : '' }}</p>
                            @endif
                        @endif
                    </div>

                    <div class="md:flex items-center xl:gap-[18px] pb-[30px] detail-btncontainer">
                        <button type="button" id="detail-addcart" data-itemid="{{ $product->id }}"
                            class="adminAddCart bg-rembrown border border-rembrown md:hover:bg-transparent text-white md:hover:text-rembrown montserrat-semibold rem-text-20 py-3 px-5 6xl:px-9 w-full md:mr-3 xl:mr-0"
                            onclick="showCartDropdown()">{{__('frontend.product_detail.add_to_cart')}}</button>
                        <button type="button" id="adminAddWishList" data-id="{{ $product->id }}" data-price="{{ $product->sale_price ? $product->sale_price : $product->original_price }}"
                            class="border border-rembrown text-rembrown montserrat-semibold rem-text-20 hover:bg-rembrown hover:text-whitez py-3 px-5 6xl:px-9 w-full mt-3 md:mt-0">{{__('frontend.product_detail.add_to_wishlist')}}</button>
                    </div>
                    <input type="hidden" name="{{ "p_detail_name_".$product->id }}" value="{{ $product->$name }}" >
                    <input type="hidden" name="{{ "p_detail_image_".$product->id }}" value="{{ $product->feature_image }}" >
                    <input type="hidden" name="{{ "p_detail_type_".$product->id }}" value="{{ $product->type }}" >
                    <input type="hidden" name="{{ "p_detail_sell_quantity_".$product->id }}" value="{{ $product->sell_quantity }}">
                    <input type="hidden" name="{{ "p_detail_min_stock_qty_".$product->id }}" value="{{ $product->min_stock_quantity }}">
                    <input type="hidden" name="{{ "p_detail_sale_price_".$product->id }}" value="{{ $product->sale_price != 0 ? $product->sale_price : $product->original_price }}">
                @endif
                <div class="pb-10">
                    <div class="flex items-center pb-[10px]">
                        <p class="montserrat text-remdark rem-text-18 pr-[14px]">{{__('frontend.product_detail.rating')}}</p>
                        <img src="{{ asset('frontend/img/detail-alert-circle.svg') }}" alt="alert circle">
                        <!-- admin product rating component -->
                        <x-frontend.product-rating :product="$product" />
                    </div>

                    <p class="montserrat text-remdark rem-text-18 pb-[10px]">{{__('frontend.product_detail.category')}} {{ $product->getCategoriesName($product->categories) }}</p>

                    <div>
                        <p class="montserrat-semibold text-remdark rem-text-18">{{__('frontend.product_detail.share')}}</p>
                        <div class="flex items-center xl:gap-[4px]">
                            <a href="https://wa.me/?text={{ route('front.product.detail', $product->code) }}">
                                <img src="{{ asset('frontend/img/detail-whatsapp.svg') }}" alt="whatsapp">
                            </a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ route('front.product.detail', $product->code) }}">
                                <img src="{{ asset('frontend/img/detail-facebook.svg') }}" alt="facebook">
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ route('front.product.detail', $product->code) }}">
                                <img src="{{ asset('frontend/img/detail-twitter.svg') }}" alt="twitter">
                            </a>
                        </div>
                    </div>
                </div>

                <p class="py-3 px-5 bg-remlinear montserrat-medium rem-text-16 text-blackcustom"> {{ __('frontend.product_detail.shipping_free_text') }} <span
                        class="montserrat-bold text-remred">{{ currency().$free_shipping_amount }}</span> {{ __('frontend.product_detail.shipping_free_about') }} </p>

                <div class="pt-10 pb-5 border-b border-b-remlinear sm:grid sm:grid-cols-2">

                    <div class="flex items-center xl:gap-3 pb-5">
                        <p
                            class="bg-[#B89772] px-[5px] rounded-[3px] montserrat-medium text-whitez rem-text-16 flex-[0_1_16%] max-w-[16%] lg:flex-[0_1_22%] lg:max-w-[22%] xl:flex-[0_1_17%] xl:max-w-[17%] text-center">
                            RP</p>
                        <p class="pl-2 xl:pl-0">Robert Parker</p>
                    </div>

                    <div class="flex items-center xl:gap-3 pb-5">
                        <p
                            class="bg-[#B89772] px-[5px] rounded-[3px] montserrat-medium text-whitez rem-text-16 flex-[0_1_16%] max-w-[16%] lg:flex-[0_1_22%] lg:max-w-[22%] xl:flex-[0_1_17%] xl:max-w-[17%] text-center">
                            WS</p>
                        <p class="pl-2 xl:pl-0">Wine Spectator</p>
                    </div>

                    <div class="flex items-center xl:gap-3 pb-5">
                        <p
                            class="bg-[#B89772] px-[5px] rounded-[3px] montserrat-medium text-whitez rem-text-16 flex-[0_1_16%] max-w-[16%] lg:flex-[0_1_22%] lg:max-w-[22%] xl:flex-[0_1_17%] xl:max-w-[17%] text-center">
                            JH</p>
                        <p class="pl-2 xl:pl-0">James Halliday</p>
                    </div>

                    <div class="flex items-center xl:gap-3 pb-5">
                        <p
                            class="bg-[#B89772] px-[5px] rounded-[3px] montserrat-medium text-whitez rem-text-16 flex-[0_1_16%] max-w-[16%] lg:flex-[0_1_22%] lg:max-w-[22%] xl:flex-[0_1_17%] xl:max-w-[17%] text-center">
                            BC</p>
                        <p class="pl-2 xl:pl-0">Bob Camobell MW</p>
                    </div>

                    <div class="flex items-center xl:gap-3 pb-5">
                        <p
                            class="bg-[#B89772] px-[5px] rounded-[3px] montserrat-medium text-whitez rem-text-16 flex-[0_1_16%] max-w-[16%] lg:flex-[0_1_22%] lg:max-w-[22%] xl:flex-[0_1_17%] xl:max-w-[17%] text-center">
                            JS</p>
                        <p class="pl-2 xl:pl-0">James Suckling</p>
                    </div>

                    <div class="flex items-center xl:gap-3 pb-5">
                        <p
                            class="bg-[#B89772] px-[5px] rounded-[3px] montserrat-medium text-whitez rem-text-16 flex-[0_1_16%] max-w-[16%] lg:flex-[0_1_22%] lg:max-w-[22%] xl:flex-[0_1_17%] xl:max-w-[17%] text-center">
                            BH</p>
                        <p class="pl-2 xl:pl-0">Burghound</p>
                    </div>

                </div>
                @if($recent_views)
                    <div class="pt-10 pb-5 lg:pb-50 detail-recentviewslide">
                        <p class="flex items-center justify-between pb-7 montserrat rem-text-18 text-remdark">
                            {{__('frontend.product_detail.recent_view')}}
                            <span onclick="removeAllRecentView()">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <path
                                        d="M19 6.41L17.59 5L12 10.59L6.41 5L5 6.41L10.59 12L5 17.59L6.41 19L12 13.41L17.59 19L19 17.59L13.41 12L19 6.41Z"
                                        fill="#1E1D1B" />
                                </svg>
                            </span>
                        </p>

                        <div id="recentview-slide">
                            @foreach($recent_views as $recent)
                                <div class="border broder-remlinear rounded-[9px] py-4 px-3 lg:px-8 flex items-center xl:gap-[42px]">
                                    <p><img src="{{ asset(isset($recent->product->feature_image) ? $recent->product->feature_image : '') }}" alt="{{ isset($recent->product->feature_image_alt) ? $recent->product->feature_image_alt : ''}}" class="w-[68px] h-[68px] object-cover"></p>
                                    <div class="pl-3 xl:pl-0">
                                        <p class="montserrat-medium text-remdark rem-text-16">{{ isset($recent->product->$name) ? $recent->product->$name : '' }}</p>
                                        <p class="montserrat-bold relative super-lasttwo">
                                            <span>{{ currency() }}</span><span>{{ $recent->product->sale_price}}</span></p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
                <div id="addcart-modal" data-id="@@id"
                    class="hidden fixed z-[51] left-0 bottom-0 w-full h-full overflow-auto bg-black/[.42]">
                    <div
                        class="absolute bottom-0 px-5 pt-7 pb-10 left-0 w-full rounded-tl-[15px] rounded-tr-[15px] bg-white">
                        <div
                            class="w-full text-right py-4 border-b border-b-remDF flex items-center justify-between">
                            <p class="montserrat-semibold text-blackcustom text-16">{{__('frontend.product_detail.added_your_cart')}}</p>
                            <span onclick="closeCartDropdown()">
                                <svg class="ml-auto inline-block" width="28" height="28" viewBox="0 0 28 28"
                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g id="ep:close">
                                        <path id="Vector"
                                            d="M20.8985 5.86773L14 12.7662L7.10152 5.86773C6.9356 5.7159 6.7175 5.63393 6.49265 5.63892C6.2678 5.6439 6.05354 5.73544 5.89451 5.89447C5.73548 6.0535 5.64394 6.26776 5.63896 6.49261C5.63397 6.71746 5.71594 6.93556 5.86777 7.10148L12.7628 14L5.86602 20.8967C5.78176 20.977 5.7144 21.0734 5.66791 21.1801C5.62142 21.2868 5.59672 21.4017 5.59528 21.5181C5.59384 21.6345 5.61568 21.75 5.65952 21.8578C5.70335 21.9656 5.7683 22.0636 5.85055 22.1459C5.93279 22.2283 6.03067 22.2934 6.13843 22.3374C6.24619 22.3814 6.36166 22.4034 6.47804 22.4021C6.59443 22.4008 6.70938 22.3763 6.81615 22.3299C6.92292 22.2836 7.01935 22.2164 7.09977 22.1322L14 15.2355L20.8985 22.134C21.0644 22.2858 21.2825 22.3678 21.5074 22.3628C21.7322 22.3578 21.9465 22.2663 22.1055 22.1072C22.2646 21.9482 22.3561 21.7339 22.3611 21.5091C22.3661 21.2842 22.2841 21.0661 22.1323 20.9002L15.2338 14.0017L22.1323 7.10148C22.2165 7.02118 22.2839 6.92485 22.3304 6.81814C22.3769 6.71144 22.4016 6.59652 22.403 6.48013C22.4044 6.36375 22.3826 6.24825 22.3388 6.14043C22.2949 6.03261 22.23 5.93464 22.1477 5.85228C22.0655 5.76992 21.9676 5.70483 21.8599 5.66084C21.7521 5.61685 21.6366 5.59485 21.5202 5.59612C21.4039 5.5974 21.2889 5.62193 21.1821 5.66827C21.0754 5.71461 20.9789 5.78183 20.8985 5.86598V5.86773Z"
                                            fill="black" />
                                    </g>
                                </svg>
                            </span>
                        </div>
                        <div class="pt-5">
                            <div class="adminDetailCartItem max-h-[120px] overflow-auto">
                                
                            </div>

                            <div class="pt-5 flex items-center pl-3">
                                <p class="montserrat-semibold rem-text-14 text-blackcustom">{{__('frontend.product_detail.subtotal')}}</p>
                                <div class="pl-3">
                                    <p class="pDetailTotalamount montserrat-bold text-20 text-remdark"></p>
                                    <p class="pDetailTotalQuantity montserrat rem-text-14 text-rembrown"></p>
                                </div>
                            </div>
                            <div class="pt-10">
                                @if(!auth('member')->check())
                                    <a href="{{ route('front.cart') }}">
                                        <button type="button"
                                            class="bg-rembrown hover:bg-transparent text-whitez hover:text-rembrown border border-rembrown w-full py-3 montserrat-semibold rem-text-14">{{__('frontend.product_detail.view_cart')}}</button>
                                    </a>
                                @else
                                    <a href="{{ route('front.member.cart') }}">
                                        <button type="button"
                                            class="bg-rembrown hover:bg-transparent text-whitez hover:text-rembrown border border-rembrown w-full py-3 montserrat-semibold rem-text-14">{{__('frontend.product_detail.view_cart')}}</button>
                                    </a>
                                @endif
                                <a href="{{ route('front.product') }}">
                                    <button type="button"
                                        class="text-rembrown border border-rembrown w-full py-3 mt-3 montserrat-semibold rem-text-14">{{__('frontend.product_detail.continue_shopping')}}</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div component-name="rem-detailtab" class="container280 pb-20 hidden lg:block pt-4 lg:pt-50 detailtabs-container">
        <div
            class="lg:flex items-center flex-wrap md:flex-nowrap justify-between xl:gap-5 6xl:gap-[60px] tabs-header pb-9 lg:pb-[60px] lg:px-20 2xl:px-[200px] 7xl:px-[288px]">

            <p id="description"
                class="montserrat-bold text-remdark/30 flex items-center justify-between active-tab cursor-pointer lg:mr-4 last-of-type:mr-0 xl:mr-0 pt-5 lg:pt-0">
                {{__('frontend.product_detail.description')}}
            </p>

            <p id="tasting-note"
                class="montserrat-bold text-remdark/30 flex items-center justify-between  cursor-pointer lg:mr-4 last-of-type:mr-0 xl:mr-0 pt-5 lg:pt-0">
                {{__('frontend.product_detail.tasting_note')}}
            </p>

            <p id="product-details"
                class="montserrat-bold text-remdark/30 flex items-center justify-between  cursor-pointer lg:mr-4 last-of-type:mr-0 xl:mr-0 pt-5 lg:pt-0">
                {{__('frontend.product_detail.product_detail')}}
            </p>

            <p id="award"
                class="montserrat-bold text-remdark/30 flex items-center justify-between  cursor-pointer lg:mr-4 last-of-type:mr-0 xl:mr-0 pt-5 lg:pt-0">
                {{__('frontend.product_detail.award')}}
            </p>

        </div>


        <div class=" tabs-content" data-id="description">
            <p class="montserrat rem-text-18 text-remdark text-justify">{!! isset($product->product_meta->descriptions) ? $product->product_meta->descriptions[lngKey()] : '' !!}</p>
        </div>

        <div class="hidden tabs-content" data-id="tasting-note">
            <p class="montserrat rem-text-18 text-remdark text-justify">{!! isset($product->product_meta->testing_notes) ? $product->product_meta->testing_notes[lngKey()] : '' !!}</p>
        </div>

        <div class="hidden tabs-content" data-id="product-details">
            <p class="montserrat rem-text-18 text-remdark text-justify">{!! isset($product->product_meta->product_details) ? $product->product_meta->product_details[lngKey()] : '' !!}</p>
        </div>

        <div class="hidden tabs-content" data-id="award">
            <p class="montserrat rem-text-18 text-remdark text-justify">{!! isset($product->product_meta->awards) ? $product->product_meta->awards[lngKey()] : '' !!}</p>
        </div>

    </div>
    <div component-name="rem-faq" class="container280 pb-20 lg:hidden">

        <div class="faq-container py-3 border-b border-b-remlinear">
            <div class="flex items-center justify-between faq-title active-faq">
                <p class="montserrat-bold text-remdark/30 cursor-pointer">
                    {{__('frontend.product_detail.description')}}
                </p>
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="10" height="6" viewBox="0 0 10 6" fill="none">
                        <path d="M9 0.5L5 4.5L1 0.5" stroke="#5B514F" stroke-linecap="round" />
                    </svg>
                </span>
            </div>

            <div class="faq-content pt-4 hidden">
                <p class="montserrat rem-text-18 text-remdark text-justify">{!! isset($product->product_meta->descriptions) ? $product->product_meta->descriptions[lngKey()] : '' !!}</p>
            </div>
        </div>

        <div class="faq-container py-3 border-b border-b-remlinear">
            <div class="flex items-center justify-between faq-title ">
                <p class="montserrat-bold text-remdark/30 cursor-pointer">
                    {{__('frontend.product_detail.tasting_note')}}
                </p>
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="10" height="6" viewBox="0 0 10 6" fill="none">
                        <path d="M9 0.5L5 4.5L1 0.5" stroke="#5B514F" stroke-linecap="round" />
                    </svg>
                </span>
            </div>

            <div class="faq-content pt-4 hidden">
                <p class="montserrat rem-text-18 text-remdark text-justify">{!! isset($product->product_meta->testing_notes) ? $product->product_meta->testing_notes[lngKey()] : '' !!}</p>
            </div>
        </div>

        <div class="faq-container py-3 border-b border-b-remlinear">
            <div class="flex items-center justify-between faq-title ">
                <p class="montserrat-bold text-remdark/30 cursor-pointer">
                    {{__('frontend.product_detail.product_detail')}}
                </p>
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="10" height="6" viewBox="0 0 10 6" fill="none">
                        <path d="M9 0.5L5 4.5L1 0.5" stroke="#5B514F" stroke-linecap="round" />
                    </svg>
                </span>
            </div>

            <div class="faq-content pt-4 hidden">
                <p class="montserrat rem-text-18 text-remdark text-justify">{!! isset($product->product_meta->product_details) ? $product->product_meta->product_details[lngKey()] : '' !!}</p>
            </div>
        </div>

        <div class="faq-container py-3 border-b border-b-remlinear">
            <div class="flex items-center justify-between faq-title ">
                <p class="montserrat-bold text-remdark/30 cursor-pointer">
                    {{__('frontend.product_detail.award')}}
                </p>
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="10" height="6" viewBox="0 0 10 6" fill="none">
                        <path d="M9 0.5L5 4.5L1 0.5" stroke="#5B514F" stroke-linecap="round" />
                    </svg>
                </span>
            </div>

            <div class="faq-content pt-4 hidden">
                <p class="montserrat rem-text-18 text-remdark text-justify">{!! isset($product->product_meta->awards) ? $product->product_meta->awards[lngKey()] : '' !!}</p>
            </div>
        </div>

    </div>

    @include('frontend.product.product_detail._recommendation')

    @include('frontend.product.product_detail._you_may_also_like')
    
    @include('frontend.product.product_detail._people_also_buy')
@endsection
@push('scripts')
    <script src="{{ asset('frontend/custom/wishlist.js?v='.time()) }}" type="text/javascript"></script>
    <script src="{{ asset('frontend/custom/product/product-detail.js') }}" type="text/javascript"></script>
@endpush