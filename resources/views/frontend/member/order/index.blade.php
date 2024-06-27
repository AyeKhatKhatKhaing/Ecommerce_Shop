@extends('frontend.layouts.master')
@section('seo')
    <title>{{ __('frontend.seo.member_order.title') }}</title>
    <meta property="og:title" content="{{ __('frontend.seo.member_order.meta_title') }}" />
    <meta name="description" content="{{ __('frontend.seo.member_order.meta_description') }}">
    <meta property="og:description" content="{{ __('frontend.seo.member_order.meta_description') }}" />
    <meta property="og:url"content="{{ route('front.member.order') }}" />
    <meta property="og:locale" content="{{ lngKey() }}">
    <meta property="og:image" content="">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="">
@endsection
@section('content')
    <div component-name="rem-ordertable" class="memberdashboard">
        @include('frontend.member.layouts.breadcrumb')

        <div class="container200 pt-5 md:pt-60 pb-10 md:pb-100 flex flex-col-reverse lg:flex-row xl:gap-[60px]">
            @include('frontend.member.layouts.sidebar')
            <div class=" lg:flex-[none] lg:w-[70%]">
                <h3 class="member-title montserrat-bold text-black pb-5">{{ __('frontend.member.my_order') }}</h3>
                <div class="order-table">
                    <table class="w-full">
                        <thead>
                            <tr>

                                <th class="montserrat-semibold text-remdark rem-text-16 py-4 px-3 bg-remlinear">
                                    {{ __('frontend.member.order_no') }}</th>

                                <th class="montserrat-semibold text-remdark rem-text-16 py-4 px-3 bg-remlinear">{{ __('frontend.member.date') }}
                                </th>

                                <th class="montserrat-semibold text-remdark rem-text-16 py-4 px-3 bg-remlinear">{{ __('frontend.member.item') }}
                                </th>

                                <th class="montserrat-semibold text-remdark rem-text-16 py-4 px-3 bg-remlinear">
                                    {{ __('frontend.member.status') }}</th>

                                <th class="montserrat-semibold text-remdark rem-text-16 py-4 px-3 bg-remlinear">
                                    {{ __('frontend.member.total_amount') }}</th>

                                <th class="montserrat-semibold text-remdark rem-text-16 py-4 px-3 bg-remlinear">
                                    {{ __('frontend.member.action') }}</th>

                            </tr>
                        </thead>
                        <tbody>
                           
                            @foreach($member_order as $item)
                            <tr>
                                <td headers="Order No"
                                    class="py-5 border-b border-b-remDF text-center montserrat-semibold text-blackcustom rem-text-18">
                                    {{ $item->code }}</td>
                                    @php
                                    $member_order_date = Carbon\Carbon::parse($item->created_date)->format('M d, Y');
                                    @endphp
                                <td headers="Date"
                                    class="py-5 border-b border-b-remDF text-center montserrat-medium text-rembrown rem-text-16">
                                    {{ $member_order_date }}</td>
                                <td headers="Item"
                                    class="py-5 border-b border-b-remDF text-center montserrat-semibold text-blackcustom rem-text-18">
                                    {{ $item->total_quantity }}</td>
                                <td headers="Status" class="py-5 border-b border-b-remDF text-center">
                                    @if($item->order_status == 1)
                                    <p class="montserrat-semibold rem-text-14 px-2 py-[2px] rounded-[3px] order-complete">{{ __('frontend.member.complete') }}</p>
                                    @else 
                                    <p class="montserrat-semibold rem-text-14 px-2 py-[2px] rounded-[3px] order-processing">{{ __('frontend.member.processing') }}</p>
                                    @endif
                                </td>
                                <td headers="Total Amount"
                                    class="py-5 border-b border-b-remDF text-center montserrat-semibold text-blackcustom rem-text-18">
                                    {{ $item->getCurrency($item->code) }}{{ $item->total_amount }}</td>
                                <td headers="Action" class="py-5 border-b border-b-remDF text-center">
                                    <a href="{{ route('front.member.order-detail', $item->code) }}"
                                        class="montserrat-semibold text-rembrown rem-text-14 bg-remlinear px-2 py-[2px] rounded-[3px]">{{ __('frontend.member.view') }}</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {!! $member_order->appends([])->links('frontend.member.order._pagination')->render() !!}
            </div>
        </div>
    </div>
@endsection