@php
    $hide_popup = (Request::routeIs('front.forget.password') || Request::routeIs('front.reset.password')) ? false : true;
@endphp
@if($hide_popup)
<div component-name="rem-region-popup" id="region-popup" class="hidden">
    <div class="region-wrapper fixed w-full  h-full left-0 top-0 bg-[#000000ba] z-[12]">
        <div class="region-card absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 bg-white pt-[20px] 3xl:pt-[48px] pb-[30px] 3xl:pb-[69px] px-[20px] md:px-[50px] 3xl:px-[80px] 3xl:px-[100px]">
            <div class="region-card-title text-center">
                <h3>選擇地區:</h3>
                <p>select region</p>
            </div>
            <div class="flex items-center">
                <label class="region-card-radio" onclick="adminAreaChange('hk')">
                    <input type="radio" name="region" value="HongKong" onchange="displayRadioValue()">
                    <span class="region-card-radio-btn">
                        <div class="hobbies-icon">
                            <img src="{{ asset('frontend/img/hong-kong-sar.svg') }}" alt="hong kong" />
                            <h3>香港</h3>                        
                            <p class="title">Hong Kong</p>
                            <p class="desc">港幣 (HK$)</p>
                        </div>
                    </span>
                </label>
                <label class="region-card-radio" onclick="adminAreaChange('ma')">
                    <input type="radio" name="region" value="Macau" onchange="displayRadioValue()">
                    <span class="region-card-radio-btn">
                        <div class="hobbies-icon">
                            <img src="{{ asset('frontend/img/macau-sar.svg') }}" alt="macau" />
                            <h3>澳門</h3>      
                            <p class="title">Macau</p>
                            <p class="desc">澳門幣 (MOP)</p>
                        </div>
                    </span>
                </label>
            </div>
        </div>
    </div>
</div>
@endif