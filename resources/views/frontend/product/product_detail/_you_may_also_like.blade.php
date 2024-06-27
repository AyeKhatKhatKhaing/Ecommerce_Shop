@if (count($related_products) > 0)
    <div component-name="rem-product" class="rem-container160 py-50 @@bg">

        <div class="md:flex justify-between items-center pb-6 md:pb-12">
            <h2 class="rem-text-40 montserrat-semibold text-remdark text-center md:text-left flex items-center">
                {{__('frontend.product_detail.you_may_also_like')}}

            </h2>
            <a href="#" class="hidden md:flex items-center view-all hide-viewall">
                <span class="text-remdark montserrat-bold rem-text-18 underline">{{__('frontend.product_detail.view_all')}}</span>
                <svg width="40" height="6" viewBox="0 0 28 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path id="Arrow 1"
                        d="M27.8868 3L25 0.113249L22.1132 3L25 5.88675L27.8868 3ZM0 3.5H25V2.5H0V3.5Z"
                        fill="black" />
                </svg>
            </a>
        </div>


        <div class="border-r border-r-remDF product-container" id="hotseller">

            @foreach ($related_products as $related_product)
                <div class="product-cardcontainer border border-remDF bannerheight">
                    <a href="{{ route('front.product.detail', $related_product->code) }}" class="product-cardimg">
                        <div class="relative seller-imagescontainer">
                            @if(isset($related_product->offer_labels[lngKey()]) && isset($related_product->label))
                                <p
                                    class="min-w-[80px] md:min-w-[100px] 3xl:min-w-[130px] w-fit status-hot rem-btn-polygon status capitalize montserrat-semibold rem-text-9 md:rem-text-13 text-whitez px-3 md:px-6 py-2 text-center">
                                    {{ $related_product->label->$locale_name }}</p>
                            @else
                                @if(getPercentage($related_product))
                                    <p
                                        class="discount text-center absolute left-5 top-2 4xl:top-5 flex items-center justify-center leading-[1.2] rem-text-12 montserrat-semibold text-[#80757C] w-[50px] h-[50px] rounded-full">
                                        {{ getPercentage($related_product) }}% OFF</p>
                                @endif
                            @endif

                            @if($related_product->isSoldOut($related_product))
                                <p
                                    class="min-w-[80px] md:min-w-[100px] 3xl:min-w-[130px] w-fit ml-auto sold-out uppercase status capitalize montserrat-semibold rem-text-9 md:rem-text-13 text-whitez px-3 md:px-6 py-2 text-center">
                                    {{ __('home.product.sold_out') }}</p>
                            @endif

                            <img src="{{ asset($related_product->feature_image) }}" alt="{{ isset($related_product->feature_image_alt) ? $related_product->feature_image_alt : '' }}" class="mx-auto h-full object-contain">

                            @if(isset($related_product->offer_labels[lngKey()]))
                                <p
                                    class="rem-text-9 md:rem-text-15 promotion-banner w-fit xl:w-[200px] 7xl:w-[273px] flex items-center absolute left-0 bottom-0 capitalize montserrat-semibold text-whitez px-6 py-2 text-center">
                                    <img src="{{ asset('frontend/img/brightness-percent.svg') }}" alt="brightness percent" class="mr-2" />{{ $related_product->offer_labels[lngKey()] }}</p>
                            @else
                                @if(getPercentage($related_product))
                                    <p
                                        class="rem-text-9 md:rem-text-13 on-sale min-w-[80px] md:min-w-[100px] 3xl:min-w-[130px] w-fit rem-btn-polygon absolute left-0 bottom-0 capitalize montserrat-semibold text-whitez px-6 py-2 text-center">
                                        {{ __('home.product.on_sale') }}</p>
                                @else
                                    @if(isset($related_product->label))
                                        <x-frontend.common-product-label :label="$related_product->label" />
                                    @endif
                                @endif
                            @endif

                        </div>
                        <p class="montserrat rem-text-16 text-remdark pt-5 px-3">{{ $related_product->$name }}</p>
                    </a>

                    <div class="adminLikeCartForm product-cardcontent pb-7 px-3">
                        <div class="flex justify-between items-center lg:block">
                            @if(getPercentage($related_product))
                                <a href="{{ route('front.product.detail', $related_product->code) }}" class="flex flex-wrap items-center">
                                    <p class="montserrat-bold relative super-lasttwo"><span>{{ currency() }}</span><span>{{ $related_product->sale_price }}</span>
                                    </p>

                                    <p class="montserrat text-dolphin relative super-lasttwo super-linethrought">
                                        <span>{{ currency() }}</span><span>{{ $related_product->original_price }}</span></p>

                                </a>
                            @else
                                <a herf="{{ route('front.product.detail', $related_product->code) }}" class="flex flex-wrap items-center">
                                    <p class="montserrat-bold relative super-lasttwo"><span>{{ currency() }}</span><span>{{ $related_product->original_price }}</span></p>                                    
                                </a>
                            @endif
                            <div class="justify-between stock-list">
                                
                                <p class="adminLikeOutOfStock_{{ $related_product->id }} montserrat-medium text-remdark rem-text-16 hidden lg:flex items-center @if ($related_product->sell_quantity == $related_product->min_stock_quantity) '' @else invisible @endif">
                                    <span
                                        class="w-6 h-6 flex items-center justify-center rounded-full border-2 border-[#F79E1B] mr-2 text-[#F79E1B]">i</span>{{__('frontend.product_detail.out_of_stock')}}
                                </p>

                                <div class="btncontainer text-right">
                                    <p data-id="related-{{ $related_product->id }}" data-itemid="{{ $related_product->id }}"
                                        class="adminLikeCheckCart bg-remred text-white w-11 h-11 flex items-center justify-center rounded-full ml-auto cursor-pointer">
                                        +</p>
                                    <div
                                        class="increse-decreasecontainer flex items-center mx-auto lg:mr-[unset] border border-remred w-[140px] lg:w-[99px] h-11 rounded-[22px] px-4 ml-auto">
                                        <button data-listing="true" data-itemid="{{ $related_product->id }}" class="adminLikeCartUpdate" type="button" data-action="decrease">-</button>
                                        <input name="{{ "like_product_number_".$related_product->id }}" type="number" min="0" value="0" class="w-full text-center outline-0">
                                        <button data-listing="true" data-itemid="{{ $related_product->id }}" class="adminLikeCartUpdate" type="button" data-action="increase">+</button>
                                    </div>
                                </div>
                                <input type="hidden" name="{{ "like_product_name_".$related_product->id }}" value="{{ $related_product->$name }}" >
                                <input type="hidden" name="{{ "like_product_image_".$related_product->id }}" value="{{ $related_product->feature_image }}" >
                                <input type="hidden" name="{{ "like_product_type_".$related_product->id }}" value="{{ $related_product->type }}" >
                                <input type="hidden" name="{{ "like_product_sell_quantity_".$related_product->id }}" value="{{ $related_product->sell_quantity }}">
                                <input type="hidden" name="{{ "like_product_min_stock_qty_".$related_product->id }}" value="{{ $related_product->min_stock_quantity }}">
                                <input type="hidden" name="{{ "like_product_sale_price_".$related_product->id }}" value="{{ $related_product->sale_price != 0 ? $related_product->sale_price : $related_product->original_price }}">
                            </div>
                        </div>
                        
                        <p class="adminLikeOutOfStock_{{ $related_product->id }} montserrat-medium text-remdark rem-text-16 flex lg:hidden items-center @if ($related_product->sell_quantity == $related_product->min_stock_quantity) '' @else invisible @endif">
                            <span
                                class="w-6 h-6 flex items-center justify-center rounded-full border-2 border-[#F79E1B] mr-2 text-[#F79E1B]">i</span>{{ __('home.product.out_of_stock') }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
        @foreach ($related_products as $mb_related_product)
            <div id="cart-modal" data-id="related-{{ $mb_related_product->id }}"
                class="hidden fixed z-[51] left-0 bottom-0 w-full h-full overflow-auto bg-black/[.42]">
                <div class="absolute bottom-0 left-0 w-full rounded-tl-[15px] rounded-tr-[15px] bg-white">
                    <div class="w-full text-right pr-5 pt-4">
                        <span onclick="closeCart()">
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
                    <div class="adminMbLikeCartForm px-8 pb-6">
                        <p class="text-20 4xl:text-24 font-semibold text-center pb-4">{{ $mb_related_product->$name }}</p>
                        <div
                            class="increse-decreasecontainer flex items-center mx-auto lg:mr-[unset] border border-remred w-[140px] lg:w-[99px] h-11 rounded-[22px] px-4 ml-auto">
                            <button type="button" data-action="decrease">-</button>
                            <input name="{{ "mb_like_product_number_".$mb_related_product->id }}" type="number" min="0" value="0" class="w-full text-center outline-0">
                            <button type="button" data-action="increase">+</button>
                        </div>
                        <input type="hidden" name="{{ "mb_like_product_name_".$mb_related_product->id }}" value="{{ $mb_related_product->$name }}" >
                        <input type="hidden" name="{{ "mb_like_product_image_".$mb_related_product->id }}" value="{{ $mb_related_product->feature_image }}" >
                        <input type="hidden" name="{{ "mb_like_product_type_".$mb_related_product->id }}" value="{{ $mb_related_product->type }}" >
                        <input type="hidden" name="{{ "mb_like_product_sell_quantity_".$mb_related_product->id }}" value="{{ $mb_related_product->sell_quantity }}">
                        <input type="hidden" name="{{ "mb_like_product_min_stock_qty_".$mb_related_product->id }}" value="{{ $mb_related_product->min_stock_quantity }}">
                        <input type="hidden" name="{{ "mb_like_product_sale_price_".$mb_related_product->id }}" value="{{ $mb_related_product->sale_price != 0 ? $mb_related_product->sale_price : $mb_related_product->original_price }}">
                    
                        <p class="adminMbLikeOutOfStock_{{ $mb_related_product->id }} montserrat-medium text-remdark rem-text-16 flex items-center @if ($mb_related_product->sell_quantity == $mb_related_product->min_stock_quantity) '' @else invisible @endif">
                            <span
                                class="w-6 h-6 flex items-center justify-center rounded-full border-2 border-[#F79E1B] mr-2 text-[#F79E1B]">i</span>{{ __('home.product.out_of_stock') }}
                        </p>

                        <button type="button" data-itemid="{{ $mb_related_product->id }}"
                            class="adminMbLikeCartUpdate bg-rembrown hover:bg-transparent text-mainyellow hover:text-rembrown border border-rembrown w-full py-3 mt-4 montserrat-bold rem-text-14">{{__('frontend.product_detail.add_to_cart')}}</button>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="md:hidden pt-6">
            <a href="" class="flex justify-center items-center view-all">
                <span class="text-remdark montserrat-bold rem-text-18 underline">{{__('frontend.product_detail.view_all')}}</span>
                <svg width="28" height="6" class="ml-5" viewBox="0 0 28 6" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path id="Arrow 1"
                        d="M27.8868 3L25 0.113249L22.1132 3L25 5.88675L27.8868 3ZM0 3.5H25V2.5H0V3.5Z"
                        fill="black" />
                </svg>
            </a>
        </div>
    </div>
@endif
@push('scripts')
    <script src="{{ asset('frontend/custom/product/you-may-also-like.js') }}" type="text/javascript"></script>
@endpush