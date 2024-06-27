@extends('frontend.layouts.master')
@section('content')
    <div component-name="rem-ordertable" class="memberdashboard">
        @include('frontend.member.layouts.breadcrumb')

        <div class="container200 pt-5 md:pt-60 pb-10 md:pb-100 flex flex-col-reverse lg:flex-row xl:gap-[60px]">
            @include('frontend.member.layouts.sidebar')
            <div class=" lg:flex-[none] lg:w-[70%]">
                <p class="member-title montserrat-bold text-black pb-5">{{ __('frontend.member.my_order') }}</p>
                <p class="montserrat-semibold rem-text-18 text-blackcustom pb-5">{{ $order->code }}</p>
                <div class="pb-5 lg:pb-10 border-b border-b-[#E1D8CD]">
                    <table class="orderdetail-itemstable w-full">
                        <tr>
                            <td class="pb-2 montserrat-medium rem-text-16 text-remlight">Confirmation sent to:</td>
                            <td class="md:pl-10 pb-2 2xs:text-right md:text-left">
                                <a href="mailto:admin@gmail.com"
                                    class="montserrat-medium rem-text-16 text-rembrown2">{{ $order->member->email }}</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="pb-2 montserrat-medium rem-text-16 text-remlight">{{ __('frontend.member.order_number') }}:</td>
                            <td
                                class="md:pl-10 pb-2 montserrat-medium rem-text-16 text-rembrown2 2xs:text-right md:text-left">
                                {{ $order->code }}</td>
                        </tr>
                        @php
                        $order_date = Carbon\Carbon::parse($order->created_date)->format('d M, Y H:i A');
                        @endphp
                        <tr>
                            <td class="pb-2 montserrat-medium rem-text-16 text-remlight">{{ __('frontend.member.created_date') }}:</td>
                            <td
                                class="md:pl-10 pb-2 montserrat-medium rem-text-16 text-rembrown2 2xs:text-right md:text-left">
                                {{  $order_date  }} 
                                {{-- <span class="text-remlight">10:39 AM</span></td> --}}
                        </tr>
                        <tr>
                            <td class="pb-2 montserrat-medium rem-text-16 text-remlight">{{ __('frontend.member.status') }}:</td>
                            <td class="md:pl-10 pb-2 2xs:text-right md:text-left">
                                @if($order->order_status == 1)
                                <p class="montserrat-semibold rem-text-14 px-2 py-[2px] rounded-[3px] order-complete w-fit 2xs:ml-auto md:mr-auto md:ml-0">Complete</p>
                                @else
                                <p class="montserrat-semibold rem-text-14 px-2 py-[2px] rounded-[3px] order-processing w-fit 2xs:ml-auto md:mr-auto md:ml-0">Processing</p>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="montserrat-medium rem-text-16 text-remlight">{{ __('frontend.member.payment_method') }}:</td>
                            <td class="md:pl-10 montserrat-semibold rem-text-16 text-rembrown2 2xs:text-right md:text-left">
                                {{ $order->payment_method }}</td>
                        </tr>
                    </table>
                </div>
                <div class="pt-5 lg:pt-10">
                    <p class="montserrat-semibold rem-text-18 text-blackcustom pb-5">{{ $order->total_quantity }} Items</p>
                    <div class="pb-10 border-b border-b-[#E1D8CD]">
                        @foreach($order_item as $item)
                        <div class="2xs:flex items-center justify-between pb-2 last-of-type:pb-0">
                            <p class="2xs:flex-[0_1_20%] 2xs:max-w-[20%] sm:flex-[0_1_10%] sm:max-w-[10%]">
                                <img src="{{ asset($item->product_datas['feature_image']) }}" alt="item image"
                                    class="border border-remlinear w-[100px]">
                            </p>
                            <div
                                class="md:flex items-center justify-between xl:gap-5 2xs:flex-[0_1_80%] 2xs:max-w-[80%] sm:flex-[0_1_88%] sm:max-w-[88%] 2xs:pl-5 sm:pl-0">
                                <p class="montserrat-medium rem-text-16 text-remdark pt-3 2xs:pt-0">{{ $item->product_datas['name_en'] }}</p>
                                <p class="montserrat-medium rem-text-16 text-remdark">{{ $order->getCurrency($order->code) }}{{ $item->product_datas['sale_price'] }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="py-5 lg:py-10 border-b border-b-[#E1D8CD]">

                    <div class="flex items-center justify-between pb-2 last-of-type:pb-0">
                        <p class="montserrat-semibold rem-text-16 text-remlight">{{ __('frontend.member.subtotal') }}</p>
                        <p class="montserrat-semibold rem-text-16 text-remdark">{{ $order->getCurrency($order->code) }} {{ $order_item[0]['sub_total'] }}</p>
                    </div>

                    <div class="flex items-center justify-between pb-2 last-of-type:pb-0">
                        <p class="montserrat-semibold rem-text-16 text-remlight">{{ __('frontend.member.coupon_code_amount_applied') }}</p>
                        <p class="montserrat-semibold rem-text-16 text-remdark">{{ $order->getCurrency($order->code) }}{{ $order->coupon_amount }}</p>
                    </div>

                    {{-- <div class="flex items-center justify-between pb-2 last-of-type:pb-0">
                        <p class="montserrat-semibold rem-text-16 text-remlight">Promotion Discount</p>
                        <p class="montserrat-semibold rem-text-16 text-remdark">HK$0</p>
                    </div> --}}

                </div>
                <div class="flex items-center justify-between py-5 lg:py-10 border-b border-b-[#E1D8CD]">
                    <p class="montserrat-semibold rem-text-16 text-remlight">{{ __('frontend.member.shipping_fee') }}</p>
                    <p class="montserrat-semibold rem-text-16 text-remdark">{{ $order->getCurrency($order->code) }} {{ $order->shipping_amount }}</p>
                </div>
                <div class="flex items-center justify-between pt-5 lg:pt-10">
                    <p class="montserrat-semibold rem-text-18 text-remdark">{{ __('frontend.member.total_amount') }}</p>
                    <p class="montserrat-semibold rem-text-18 text-remdark">{{ $order->getCurrency($order->code) }} {{ $order->total_amount }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection

