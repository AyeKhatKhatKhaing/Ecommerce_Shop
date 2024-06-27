@extends('frontend.layouts.master')
@section('content')
<div component-name="rem-memberdashboard" class="memberdashboard">
    @include('frontend.member.layouts.breadcrumb')

    <div class="container200 pt-5 md:pt-60 pb-10 md:pb-100 flex flex-col-reverse lg:flex-row xl:gap-[60px]">
        @include('frontend.member.layouts.sidebar')

        <div class=" lg:flex-[none] lg:w-[70%]">
            <p class="member-title montserrat-bold text-black pb-5">Membership Tiers Description</p>

            <div
                class="flex items-center flex-wrap border-b border-remDF md:flex-nowrap xl:gap-5 6xl:gap-10 tabs-header">

                <p id="silver-tier"
                    class="montserrat-bold text-remdark/30 flex items-center justify-between active-tab cursor-pointer mr-4 last-of-type:mr-0 xl:mr-0 py-5 lg:pt-0">
                    {{ __('frontend.member.silver_tier') }}
                </p>

                <p id="gold-tier"
                    class="montserrat-bold text-remdark/30 flex items-center justify-between  cursor-pointer mr-4 last-of-type:mr-0 xl:mr-0 py-5 lg:pt-0">
                    {{ __('frontend.member.gold_tier') }}
                </p>

                <p id="platinum-tier"
                    class="montserrat-bold text-remdark/30 flex items-center justify-between  cursor-pointer mr-4 last-of-type:mr-0 xl:mr-0 py-5 lg:pt-0">
                    {{ __('frontend.member.platinum_tier') }}
                </p>

            </div>
            {{-- @php 
                $member_types = ["silver" => "Silver", "gold" => "Gold", "platinum" => "Platinum"];
            @endphp --}}
             @foreach($member_types as $key => $value)
                <div class="{{ strtolower($value->name_en) =='silver' ? '' : 'hidden'}} pt-7 tabs-content" data-id="{{ strtolower($value->name_en) }}-tier">
                    <p
                        class="montserrat-semibold rem-text-18 text-remdark md:pb-3 md:flex items-center justify-between">
                        ({{ strtolower($value->name_en) =='silver' ? 'Gold' : 'Platinum'}}) Accumulated Spending
                        <span class="font-normal rem-text-18 text-remdark hidden md:block">
                            {{ currency() }}
                            @if (strtolower($value->name_en) =='silver')
                                {{ $gold_tier->min_purchase_amount }}
                            @endif
                            @if (strtolower($value->name_en) == 'gold')
                                {{ $platinum_tier->min_purchase_amount }}
                            @endif
                            @if (strtolower($value->name_en) == 'platinum')
                                {{ $platinum_tier->min_purchase_amount }}
                            @endif
                        </span>
                    </p>
                    <div class="md:flex items-center justify-between">
                        <p class="montserrat rem-text-16 text-remdark pb-3 md:pb-0">Last updated on 
                            @if (strtolower($value->name_en) =='silver')
                                {{ date('d M, Y', strtotime($gold_tier->updated_at)) }}
                            @endif
                            @if (strtolower($value->name_en) == 'gold')
                                {{ date('d M, Y', strtotime($platinum_tier->updated_at)) }}
                            @endif
                            @if (strtolower($value->name_en) == 'platinum')
                                {{ date('d M, Y', strtotime($platinum_tier->updated_at)) }}
                            @endif
                        </p>
                        <p class="montserrat rem-text-12 text-remdark md:hidden">
                            {{ currency() }}
                            @if (strtolower($value->name_en) =='silver')
                                {{ $gold_tier->min_purchase_amount }}
                            @endif
                            @if (strtolower($value->name_en) == 'gold')
                                {{ $platinum_tier->min_purchase_amount }}
                            @endif
                            @if (strtolower($value->name_en) == 'platinum')
                                {{ $platinum_tier->min_purchase_amount }}
                            @endif
                        </p>
                        <p class="font-semibold rem-text-16 text-remdark">
                            <span class="member-inputvalue">
                                {{ $member->purchased_amount ?? 0 }}
                            </span>/<span class="max-value">
                                @if (strtolower($value->name_en) =='silver')
                                    {{ $gold_tier->min_purchase_amount }}
                                @endif
                                @if (strtolower($value->name_en) == 'gold')
                                    {{ $platinum_tier->min_purchase_amount }}
                                @endif
                                @if (strtolower($value->name_en) == 'platinum')
                                    {{ $platinum_tier->min_purchase_amount }}
                                @endif
                            </span>
                        </p>
                    </div>
                    <div class="py-3">
                        <div class="progress-bar h-[5px] bg-remlinear rounded-[50px] relative" data-max="{{ $value->min_purchase_amount ?? 0 }}">
                            <p class="active-progressbar absolute h-[5px] left-0 top-0 bg-mainyellow rounded-[50px]"
                                data-value="" data-min="{{ $member->point ?? 0 }}"></p>
                        </div>
                    </div>
                    {!! $value->descriptions[lngKey()]  !!}
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection