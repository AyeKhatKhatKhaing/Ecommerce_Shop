@extends('frontend.layouts.master')
@section('seo')
    <title>{{ isset($page) && isset($page->meta_titles) ? $page->meta_titles[lngKey()] : '' }}</title>
    <meta property="og:title" content="{{ isset($page) && isset($page->meta_titles) ? $page->meta_titles[lngKey()] : '' }}" />
    <meta name="description" content="{{ isset($page) && isset($page->meta_descriptions) ? $page->meta_descriptions[lngKey()] : '' }}">
    <meta property="og:description" content="{{ isset($page) && isset($page->meta_descriptions) ? $page->meta_descriptions[lngKey()] : '' }}" />
    <meta property="og:url"content="{{ route('front.cart') }}" />
    <meta property="og:locale" content="{{ lngKey() }}">
    <meta property="og:image" content="{{ isset($page) ? asset($page->meta_image) : '' }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="{{ isset($page) ? $page->meta_image_alt : '' }}">
@endsection
@section('content')
<div component-name="rem-banner">
    <div class="relative">
        <img src="{{ asset(isset($page) ? $page->image : '') }}" class="min-h-[200px] object-cover lg:min-h-auto w-full" alt="{{ isset($page) ? $page->image_alt : '' }}">
        <p class="banner-text text-whitez montserrat-bold absolute left-1/2 top-1/2 -translate-y-1/2 -translate-x-1/2">
            {{ isset($page) ? $page->titles[lngKey()] : '' }}</p>
    </div>
</div>
<div component-name="rem-cart">
    <div class="rem-cart-container">
        <div class="grid grid-cols-1 lg:grid-cols-3 lg:gap-5">
            <div class="col-span-2">
                <div class="rem-cart-list mb-[30px] ">
                    <table class="w-full">
                        <thead>
                            <th>{{__('frontend.cart.product_name')}}</th>
                            <th>{{__('frontend.cart.price')}}</th>
                            <th>{{__('frontend.cart.quantity')}}</th>
                            <th>{{__('frontend.cart.subtotal')}}</th>
                        </thead>
                        @if(!blank($cart_items))
                        
                            @foreach($cart_items as $item)
                                <tr class="adminWarningMeg_{{ $item->product_id }} cart-row {{ $item->product->isSoldOut($item->product) ? 'warning-msg' : '' }}">
                                    <td data-label="Product Name" class="product-name">
                                        <div class="flex flex-wrap xl:flex-nowrap items-center product">
                                            <div class="flex items-center">
                                                <div class="product-close w-[40px] cursor-pointer removeCartItem" data-id="{{ $item->id }}">
                                                    <img src="{{ asset('frontend/img/mb-menu-close.svg') }}" />
                                                </div>
                                                <img src="{{ asset($item->product_image) }}" alt="product"
                                                    class="max-w-[109px] h-[100px] object-cover mx-[20px]" />
                                            </div>
                                            <p class="name pt-3 xs:pt-0 lg:pt-3 xl:pt-0">{{ $item->product_name }}</p>
                                        </div>
                                    </td>
                                    <td data-label="Price" class="price">
                                        {{ currency() }}<span class="priceValue">{{ $item->amount }}</span>
                                    </td>
                                    <td data-label="Quantity" class="quantity">
                                        <div class="adminCartForm flex items-center quantity-btns max-w-[95px] lg:mx-auto">
                                            <div class="value-button decrease adminCartUpdate {{ $item->product->isSoldOut($item->product) ? 'rem-disabled' : '' }}" value="" data-itemid="{{ $item->product_id }}" type="button" data-action="decrease">
                                                <img src="{{ asset('frontend/img/minus.svg') }}" />
                                            </div>
                                            <input type="number" name="{{ "number_".$item->product_id }}" data-itemid="{{ $item->product_id }}" value="{{ $item->quantity }}" min="0" class="adminInputNumber max-w-[50px] text-center number" />
                                            <div class="value-button increase adminCartUpdate {{ $item->product->isSoldOut($item->product) ? 'rem-disabled' : '' }}" value="" data-itemid="{{ $item->product_id }}" type="button" data-action="increase">
                                                <img src="{{ asset('frontend/img/add.svg') }}" />
                                            </div>
                                            <input type="hidden" name="{{ "name_".$item->product_id }}" value="{{ $item->product_name }}">
                                            <input type="hidden" name="{{ "image_".$item->product_id }}" value="{{ $item->product_image }}">
                                            <input type="hidden" name="{{ "type_".$item->product_id }}" value="{{ $item->type }}">
                                            <input type="hidden" name="{{ "sell_quantity_".$item->product_id }}" value="{{ $item->product->sell_quantity }}">
                                            <input type="hidden" name="{{ "min_stock_qty_".$item->product_id }}" value="{{ $item->product->min_stock_quantity }}">
                                            <input type="hidden" name="{{ "sale_price_".$item->product_id }}" value="{{ $item->amount }}">
                                        </div>
                                    </td>
                                    <td data-label="SubTotal" class="subtotal">
                                        {{ currency() }}<span class="total">{{ (int)$item->subtotal }}</span>
                                    </td>
                                </tr>
                                <tr class="warning-row adminOutOfStockText_{{ $item->product_id }}"></tr>
                                @if ($item->product->isSoldOut($item->product))
                                    <tr class="adminWarningRow adminOutOfStock_{{ $item->product_id }} warning-row {{ $item->product->isSoldOut($item->product) ? '' : 'invisible' }}">
                                        <td colspan="4">
                                            <div class="flex items-center border-2 border-mainyellow rounded py-1 px-2">
                                                <span class="w-6 h-6 flex items-center justify-center rounded-full border-2 border-[#F79E1B] mr-2 text-[#F79E1B]">i</span>
                                                <p class="montserrat-medium text-remdark rem-text-16 flex-[0_1_80%] max-w-[80%]">This product is
                                                    temporarily out of stock because of high demand, you can add maximum <span class="adminAssignQauntity_{{ $item->product_id }}"></span> item to cart.
                                                </p>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        @endif
                    </table>
                </div>
                <div class="flex flex-col md:flex-row lg:flex-col xl:flex-row justify-between my-[30px]">
                    <div class="cupon-code flex flex-col md:flex-row mb-4">
                        <div class="relative">
                            <div class="rem-customdropdown relative selectbox_dropdown @if(!auth('member')->check()) rem-disabled @endif">
                                <input type="text" hidden>
                                <div class="flex items-center justify-between xl:gap-3 px-[10px] customdropdown-btn py-3 cursor-pointer border-dropdown min-w-[220px]">
                                    <p class="adminCheckText montserrat rem-text-16 text-remdark">
                                        {{__('frontend.cart.select_coupon')}}
                                    </p>
                                    <div class="flex items-center">
                                        <span class="adminCouponStatus pr-3 hidden">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
                                                <path d="M11.2502 0.758276C11.1731 0.681023 11.0815 0.619733 10.9807 0.577915C10.8799 0.536097 10.7718 0.514572 10.6627 0.514572C10.5535 0.514572 10.4455 0.536097 10.3447 0.577915C10.2439 0.619733 10.1523 0.681023 10.0752 0.758276L6.00019 4.82494L1.92519 0.749942C1.84803 0.67279 1.75644 0.61159 1.65564 0.569836C1.55484 0.528082 1.4468 0.506592 1.33769 0.506592C1.22858 0.506592 1.12054 0.528082 1.01973 0.569836C0.91893 0.61159 0.827338 0.67279 0.750186 0.749942C0.673035 0.827094 0.611835 0.918686 0.57008 1.01949C0.528326 1.12029 0.506836 1.22833 0.506836 1.33744C0.506836 1.44655 0.528326 1.55459 0.57008 1.6554C0.611835 1.7562 0.673035 1.84779 0.750186 1.92494L4.82519 5.99994L0.750186 10.0749C0.673035 10.1521 0.611835 10.2437 0.57008 10.3445C0.528326 10.4453 0.506836 10.5533 0.506836 10.6624C0.506836 10.7716 0.528326 10.8796 0.57008 10.9804C0.611835 11.0812 0.673035 11.1728 0.750186 11.2499C0.827338 11.3271 0.91893 11.3883 1.01973 11.43C1.12054 11.4718 1.22858 11.4933 1.33769 11.4933C1.4468 11.4933 1.55484 11.4718 1.65564 11.43C1.75644 11.3883 1.84803 11.3271 1.92519 11.2499L6.00019 7.17494L10.0752 11.2499C10.1523 11.3271 10.2439 11.3883 10.3447 11.43C10.4455 11.4718 10.5536 11.4933 10.6627 11.4933C10.7718 11.4933 10.8798 11.4718 10.9806 11.43C11.0814 11.3883 11.173 11.3271 11.2502 11.2499C11.3273 11.1728 11.3885 11.0812 11.4303 10.9804C11.472 10.8796 11.4935 10.7716 11.4935 10.6624C11.4935 10.5533 11.472 10.4453 11.4303 10.3445C11.3885 10.2437 11.3273 10.1521 11.2502 10.0749L7.17519 5.99994L11.2502 1.92494C11.5669 1.60828 11.5669 1.07494 11.2502 0.758276Z" fill="black"/>
                                            </svg>
                                        </span>
                                        <img src="{{ asset('frontend/img/arrow-down.svg') }}" class="" />
                                    </div>
                                </div>
                                <div class="hidden w-full customdropdown-content min-w-[166px] absolute right-0 top-14 rounded-[3px] p-4 bg-white z-[1]">
                                    <span class="triangle absolute right-4"></span>
                                    <ul>
                                        {{-- <li class="pb-[10px] last-of-type:pb-0 montserrat text-blackcustom cursor-pointer selected-item">
                                            Select Coupon Code</li> --}}
                                        @if(isset($member_coupons))
                                            @foreach( $member_coupons as $member_coupon)
                                                <li data-couponHisId="{{ $member_coupon->id }}" data-couponId={{ $member_coupon->coupon_id }}  data-couponCode="{{ $member_coupon->coupon->code }}" class="adminCoupon pb-[10px] last-of-type:pb-0 montserrat text-blackcustom cursor-pointer ">{{ $member_coupon->coupon->code}}</li>
                                            @endforeach
                                        @endif


                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="cupon-code-apply">
                            <input type="hidden" name="coupon_code" id="coupon-code">
                            <input type="hidden" name="original_sub_total" value="{{ $total_amounts }}">
                            <input type="hidden" name="update_sub_total">
                            <input type="hidden" id="no-coupon" name="no_coupon">
                            <button type="button" class="adminApplyCoupon px-5 py-[13px] bg-[#54301A] text-white w-full md:w-auto @if(!auth('member')->check()) rem-disabled @endif">{{__('frontend.cart.apply_coupon')}}</button>
                        </div>                        
                    </div>
                    <p class="couponMessage rem-text-14 text-remred"></p>
                    <div class="continue-shopping">
                        <a href="{{ route('front.home') }}" class="px-[24px] py-[12px] w-full text-center md:w-auto inline-block border border-[#54301A] transition-all bg-white hover:bg-[#54301A] text-[#54301A] hover:text-[#FFC425]">{{__('frontend.cart.continue_shopping')}}</a>
                    </div>
                </div>
            </div>
            <div>
                <div class="rem-cart-total">
                    <p class="title mb-[20px]">{{__('frontend.cart.cart_total')}}</p>
                    <div class="rem-cart-total-info">
                        <table>
                            <tr>
                                <td class="font-bold">{{__('frontend.cart.subtotal')}}</td>
                                <td>{{ currency() }}<span class="subtotal">{{ !blank($cart_items) ? (int)$item->subtotal : '0.00' }}</span></td>
                            </tr>
                            <tr>
                                <td class="font-bold">{{__('frontend.cart.shipping')}}</td>
                                <td>{{__('frontend.cart.enter_address')}} <a href="{{ route('front.checkout') }}" class="underline">{{__('frontend.cart.calculate_shipping')}}</a></td>
                            </tr>
                            <tr class="adminCartCoupon checkout_coupon hidden">
                                <td>Coupon</td>
                                <td>- {{ currency() }} <span class="adminCouponAmt"></span></td>
                            </tr>
                            <tr class="bg-white">
                                <td class="font-bold">{{__('frontend.cart.total')}}</td>
                                <td class="font-bold">{{ currency() }}<span class="adminSubTotal subtotal">{{ !blank($cart_items) ? (int)$item->subtotal : '0.00' }}</span></td>
                            </tr>
                        </table>
                    </div>
                    <a href="{{ auth('member')->check() ? route('front.checkout') : route('front.checkout.login') }}">
                        <button class="w-full mt-[20px] proceed-btn">{{__('frontend.cart.proceed_to_checkout')}}</button>
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