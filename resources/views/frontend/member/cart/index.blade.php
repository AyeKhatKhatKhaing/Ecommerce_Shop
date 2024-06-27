@extends('frontend.layouts.master')
@section('seo')
    <title>{{ __('frontend.seo.member_cart.title') }}</title>
    <meta property="og:title" content="{{ __('frontend.seo.member_cart.meta_title') }}" />
    <meta name="description" content="{{ __('frontend.seo.member_cart.meta_description') }}">
    <meta property="og:description" content="{{ __('frontend.seo.member_cart.meta_description') }}" />
    <meta property="og:url"content="{{ route('front.member.cart') }}" />
    <meta property="og:locale" content="{{ lngKey() }}">
    <meta property="og:image" content="">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="">
@endsection
@section('content')
<div component-name="rem-member-dashboard-mycart" class="memberdashboard">
    @include('frontend.member.layouts.breadcrumb')

    <div class="container200 pt-5 md:pt-60 pb-10 md:pb-100 flex flex-col-reverse lg:flex-row xl:gap-[60px]">
        @include('frontend.member.layouts.sidebar')

        <div class="lg:flex-[none] lg:w-[70%]">
            <p class="member-title montserrat-bold text-black pb-5 md:pb-10">{{ __('frontend.member.my_cart') }}</p>
            <div class="rem-cart-list rem-my-cart mb-[30px] ">
                <table class="w-full hidden lg:block">
                    <thead>
                        <th class="w-[366px]">{{ __('frontend.member.product_name') }}</th>
                        <th class="w-[250px]">{{ __('frontend.member.price') }}</th>
                        <th class="w-[250px]">{{ __('frontend.member.quantity') }}</th>
                        <th class="w-[250px]">{{ __('frontend.member.subtotal') }}</th>
                    </thead>
                    @if(!blank($cart_items))
                        @foreach($cart_items as $item)
                            <tr class="cart-row {{ $item->isSoldOut($item->product) ? 'warning-msg' : '' }}">
                                <td data-label="Product Name" class="product-name">
                                    <div class="flex flex-wrap xl:flex-nowrap items-center product">
                                        <div class="flex items-center">
                                            <div class="product-close w-[40px] cursor-pointer removeCartItem" data-id="{{ $item->id }}">
                                                <img src="{{ asset('frontend/img/mb-menu-close.svg') }}" />
                                            </div>
                                            <img src="{{ asset($item->product_image) }}" alt="product" class="max-w-[109px] h-[100px] object-cover mx-[20px]" />
                                        </div>
                                        <p class="name pt-3 xs:pt-0 lg:pt-3 xl:pt-0">{{ $item->product_name }}</p>
                                    </div>
                                </td>
                                <td data-label="Price" class="price">
                                    {{ currency() }}<span class="priceValue">{{ $item->amount }}</span>
                                </td>
                                <td data-label="Quantity" class="quantity">
                                    <div class="adminCartForm flex items-center quantity-btns max-w-[95px] lg:mx-auto">
                                        <div class="value-button decrease adminCartUpdate" value="Decrease Value" data-itemid="{{ $item->product_id }}">
                                            <img src="{{ asset('frontend/img/minus.svg') }}" />
                                        </div>
                                        <input type="text" name="{{ "number_".$item->product_id }}" value="{{ $item->quantity }}" min="0" class="max-w-[50px] text-center number" />
                                        <div class="value-button increase adminCartUpdate" value="Increase Value" data-itemid="{{ $item->product_id }}">
                                            <img src="{{ asset('frontend/img/add.svg') }}" />
                                        </div>
                                        <input type="hidden" name="{{ "name_".$item->product_id }}" value="{{ $item->product_name }}">
                                        <input type="hidden" name="{{ "image_".$item->product_id }}" value="{{ $item->product_image }}">
                                        <input type="hidden" name="{{ "type_".$item->product_id }}" value="{{ $item->type }}">
                                        <input type="hidden" name="{{ "min_stock_qty_".$item->product_id }}" value="{{ $item->product->min_stock_quantity }}">
                                        <input type="hidden" name="{{ "sell_quantity_".$item->product_id }}" value="{{ $item->quantity }}">
                                        <input type="hidden" name="{{ "sale_price_".$item->product_id }}" value="{{ $item->amount }}">
                                    </div>

                                </td>
                                <td data-label="SubTotal" class="subtotal">
                                    {{ currency() }}<span class="total">{{ $item->subtotal }}</span>
                                </td>
                            </tr>
                            <tr class="warning-row adminOutOfStock_{{ $item->product_id }}"></tr>
                                @if ($item->product->isSoldOut($item->product))
                                    <tr class="adminWarningRow adminOutOfStock_{{ $item->product_id }} warning-row {{ $item->product->isSoldOut($item->product) ? '' : 'invisible' }}">
                                        <td colspan="4">
                                            <div class="flex items-center border-2 border-mainyellow rounded py-1 px-2">
                                                <span class="w-6 h-6 flex items-center justify-center rounded-full border-2 border-[#F79E1B] mr-2 text-[#F79E1B]">i</span>
                                                <p class="montserrat-medium text-remdark rem-text-16 flex-[0_1_80%] max-w-[80%]">{{ __('frontend.member.temporarily') }}<span class="adminAssignQauntity_{{ $item->product_id }}"></span> {{ __('frontend.member.item_to_cart') }}.
                                                </p>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                        @endforeach
                    @endif
                </table>
                <!-- mobile -->
                <div class="lg:hidden">
                    <table class="w-full">
                        @if(!blank($cart_items))
                            @foreach($cart_items as $item)
                                <tr class="cart-row {{ $item->isSoldOut($item->product) ? 'warning-msg' : '' }}">
                                    <td>
                                        <div class="flex items-start rem-mb-mycart-list">
                                            <div class="product-img">
                                                <img src="{{ asset($item->product_image) }}" alt="product" class="max-w-[109px]">
                                            </div>
                                            <div class="product-info w-full">
                                                <div class="flex items-center justify-between pb-[20px]">
                                                    <div>
                                                        <p class="name pb-1">{{ $item->product_name }}</p>
                                                        <p class="pb-2 price">{{ currency() }}<span class="priceValue">{{ $item->amount }}</span>
                                                        </p>
                                                        <p class="qty-txt pb-0.5">Quantity:</p>
                                                        <div class="adminCartForm flex items-center quantity-btns max-w-[95px]">
                                                            <div class="value-button decrease adminCartUpdate" value="Decrease Value" data-itemid="{{ $item->product_id }}">
                                                                <img src="{{ asset('frontend/img/minus.svg') }}" />
                                                            </div>
                                                            <input type="text" name="{{ "number_".$item->product_id }}" value="{{ $item->quantity }}" min="0" class="max-w-[50px] text-center number">
                                                            <div class="value-button increase adminCartUpdate" value="Increase Value" data-itemid="{{ $item->product_id }}">
                                                                <img src="{{ asset('frontend/img/add.svg') }}" />
                                                            </div>
                                                            <input type="hidden" name="{{ "name_".$item->product_id }}" value="{{ $item->product_name }}">
                                                            <input type="hidden" name="{{ "image_".$item->product_id }}" value="{{ $item->product_image }}">
                                                            <input type="hidden" name="{{ "type_".$item->product_id }}" value="{{ $item->type }}">
                                                            <input type="hidden" name="{{ "sell_quantity_".$item->product_id }}" value="{{ $item->quantity }}">
                                                            <input type="hidden" name="{{ "sale_price_".$item->product_id }}" value="{{ $item->amount }}">
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <div class="product-close w-[40px] cursor-pointer removeCartItem" data-id="{{ $item->id }}">
                                                            <img src="{{ asset('frontend/img/mb-menu-close.svg') }}" class="ml-auto" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="flex flex-wrap items-center justify-between">
                                                    <p class="total-txt">{{ __('frontend.member.subtotal') }}:</p>
                                                    <p class="total-num">{{ currency() }}<span class="total">{{ $item->subtotal }}</span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="warning-row adminOutOfStock_{{ $item->product_id }}"></tr>
                                @if ($item->product->isSoldOut($item->product))
                                    <tr class="adminWarningRow adminOutOfStock_{{ $item->product_id }} warning-row {{ $item->product->isSoldOut($item->product) ? '' : 'invisible' }}">
                                        <td colspan="4">
                                            <div class="flex items-center border-2 border-mainyellow rounded py-1 px-2">
                                                <span class="w-6 h-6 flex items-center justify-center rounded-full border-2 border-[#F79E1B] mr-2 text-[#F79E1B]">i</span>
                                                <p class="montserrat-medium text-remdark rem-text-16 flex-[0_1_80%] max-w-[80%]">{{ __('frontend.member.temporarily') }}<span class="adminAssignQauntity_{{ $item->product_id }}"></span> {{ __('frontend.member.item_to_cart') }}.
                                                </p>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        @endif
                    </table>

                </div>
                <div class="btns mt-[34px]">
                    <a href="{{ route('front.checkout') }}">
                        <button class="p-to-checkout w-full md:w-auto">{{ __('frontend.cart.proceed_to_checkout') }}</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('frontend/custom/cart.js') }}" type="text/javascript"></script>
@endpush