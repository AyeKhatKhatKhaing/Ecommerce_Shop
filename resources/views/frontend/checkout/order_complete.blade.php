@extends('frontend.layouts.master')
@section ('content')
    @php
        $locale_name = "name_".lngKey();
    @endphp
    <div component-name="rem-order-complete" class="rem-order-complete">
        <div class="rem-order-complete-container">
            <p class="title text-center">
                Your Order <span class="text-[#CC1F1F]">{{ $order ? $order->code : '' }}</span> is complete.
            </p>
            <div class="greet mt-[50px] md:mt-[100px]">
                <p>
                    {{ __('frontend.checkout.hi') }} {{ isset($order) && isset($order->member) ? $order->member->getFullName() : '' }},</br>
                    {{ __('frontend.checkout.thanks_for_shopping') }}
                </p>
            </div>
            <div class="alert text-center p-5 my-[40px]">
                <p>{{ __('frontend.checkout.order_online_shopping') }}</p>
            </div>
            <div class="scroll-wrapper rem-checkout-guest-card-inner scrollbar-inner">
                @if (isset($order) && count($order->order_items) > 0)
                    @foreach ($order->order_items as $item)
                        <div class="product flex flex-col md:flex-row md:items-center mb-[40px]">
                            <div class="flex flex-col md:flex-row  md:items-center md:w-1/2">
                                <img src="{{ asset($item->product_datas['feature_image']) }}" class="max-w-[109px] h-[100px] object-cover" alt="product" />
                                <div class="des md:ml-3 mt-3 md:mt-0">
                                    <p>{{ $item->product_datas[$locale_name] }}</p>
                                    <p class="font-bold">Qty: {{ $item->quantity }}</p>
                                </div>
                            </div>
                            <div class="price md:w-1/2 md:text-right">
                                <p>{{ $order->getCurrency() }}{{ rm_number_format($item->sub_total) }}</p>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="detail  py-[20px] border-t border-[#D4D8D3]">
                <div class=" flex flex-col md:flex-row md:items-center mb-[10px]">
                    <div class="md:w-1/2">
                        <p class="font-bold">{{ __('frontend.checkout.subtotal') }}</p>
                    </div>
                    <div class="md:w-1/2 md:text-right">
                        <p>{{ $order->getCurrency() }}{{ isset($order->order_items) ? rm_number_format($order->order_items->sum('sub_total')) : '' }}</p>
                    </div>
                </div>
                @if ($order->delivery_type == 'delivery')
                    <div class=" flex flex-col md:flex-row md:items-center mb-[10px]">
                        <div class="md:w-1/2">
                            <p class="font-bold">{{ __('frontend.checkout.shipping') }}</p>
                        </div>
                        <div class="md:w-1/2 md:text-right">
                            {{-- <p>Enter your address to view shipping options.</p> --}}
                            <p>{{ $order->getCurrency() }}{{ rm_number_format($order->shipping_amount) }}</p>
                        </div>
                    </div>
                @endif
                @if (!empty($order->coupon_code) && $order->coupon_amount > 0)
                    <div class=" flex flex-col md:flex-row md:items-center mb-[10px]">
                        <div class="md:w-1/2">
                            <p class="font-bold">{{ __('frontend.checkout.coupon') }}</p>
                        </div>
                        <div class="md:w-1/2 md:text-right">
                            <p> - {{ $order->getCurrency() }}{{ rm_number_format($order->coupon_amount) }}</p>
                        </div>
                    </div>
                @endif
                <div class=" flex flex-col md:flex-row md:items-center mb-[10px]">
                    <div class="md:w-1/2">
                        <p class="font-bold">{{ __('frontend.checkout.total') }}</p>
                    </div>
                    <div class="md:w-1/2 md:text-right">
                        <p class="font-bold">
                            {{ $order->getCurrency() }}{{ rm_number_format($order->total_amount) }} 
                        </p>
                        <p class="font-bold">
                            @if ($order->location == 'ma') 
                                (HK$ {{ $order->hk_change_amount }})
                            @endif
                        </p>
                    </div>
                </div>
            </div>
            <div class="payment py-[20px] border-t border-b border-[#D4D8D3]">
                <div class=" flex flex-col md:flex-row md:items-center mb-[10px]">
                    <div class="md:w-1/2">
                        <p class="font-bold">{{ __('frontend.checkout.payment') }}</p>
                    </div>
                    <div class="md:w-1/2 md:text-right">
                        <p class="font-bold">{{ $order->payment_type ? $order->getPaymentType() : '' }}</p>
                    </div>
                </div>
            </div>
            @if ($order->delivery_type == 'delivery')
                <div class="shipping py-[20px] ">
                    <div class=" flex flex-col md:flex-row md:items-center mb-[10px]">
                        <div class="md:w-1/2">
                            <p class="font-bold">{{ __('frontend.checkout.shipping_form') }}:</p>
                            <p>{{ __('frontend.checkout.online_shopping') }}</p>
                        </div>
                        <div class="md:w-1/2 mt-5 md:mt-0">
                            <p class="font-bold">{{ __('frontend.checkout.shipping_to') }}:</p>
                            <p>
                                {{ $order->getShippingTo() }}
                            </p>
                        </div>
                    </div>
                </div>
            @else
                <div class="shipping py-[20px] ">
                    <div class=" flex flex-col md:flex-row md:items-center mb-[10px]">
                        <div class="md:w-1/2">
                            <p class="font-bold">{{ __('frontend.checkout.pickup_form') }}:</p>
                            <p>{{ $order->pickup_datas ? $order->pickup_datas['pick_name'] : '' }}</p>
                        </div>
                    </div>
                </div>
            @endif
            <div class="question mt-[60px] py-[40px] px-[20px] bg-[#F6F1EB] text-center">
                <p class="title">{{ __('frontend.checkout.question') }}</p>
                <p class="desc mt-[20px]">{{ __('frontend.checkout.call_us') }} <a href="tel:+852 1234 5468">+852 1234
                        5468</a> </p>
                <a class="phone" href="tel:+85212345468">+852 1234 5468</a>
            </div>
        </div>
    </div>
@endsection