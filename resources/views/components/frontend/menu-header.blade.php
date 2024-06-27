<div>
    <div class="rem-header-white-nav hidden lg:block">
        @php
            $locale_name = "name_".lngKey();
        @endphp
        <ul>
            @if($header_menus && $header_menus->count() > 0)
                @foreach ($header_menus as $menu)
                    @if($menu->type === 'promotion')
                        <li>
                            {{ $menu->name }}
                            <div class="rem-header-white-subnav-content">
                                <div class="rem-header-white-subnav-content-container">
                                    <div class="grid grid-cols-3 2xl:grid-cols-2">
                                        <div
                                            class="rem-header-white-subnav-content-items col-span-2 2xl:col-span-1">
                                            <div class="grid grid-cols-3">
                                                <div>
                                                    <p>{{ __('home.header.promotion_type') }}</p>
                                                    @if($menu->show_submenu && ($menu->sub_menus && $menu->sub_menus->count() > 0))
                                                        <ul>
                                                            @foreach ($menu->sub_menus as $promotion)
                                                                <li>
                                                                    <a href="{{ route('front.product', ['pf' => $promotion->id]) }}">
                                                                        {{ $promotion->$locale_name }}
                                                                    </a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </div>
                                            </div>

                                        </div>
                                        <div>
                                            <div component-name="product-item-card">
                                                <div class="flex flex-col 2xl:flex-row items-stretch">
                                                    <div class="2xl:w-[47%] product-item-card-txt">
                                                        {!! $menu->description !!}
                                                        <a href="{{ route('front.product', ['pf' => 'all']) }}" class="flex uppercase underline"> view all <img
                                                                src="{{ asset('frontend/img/pro-card-arrow.svg') }}" alt="arrow"
                                                                class="ml-[12px] object-contain" /></a>
                                                    </div>
                                                    <div class="2xl:w-[53%]">
                                                        <img src="{{ asset($menu->image) }}" alt="product"
                                                            class="object-cover h-full" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endif

                    @if($menu->type === 'category' && $menu->show_submenu)
                        <li>
                            {{ $menu->name }}
                            <div class="rem-header-white-subnav-content">
                                <div class="rem-header-white-subnav-content-container">
                                    <div class="grid grid-cols-3 2xl:grid-cols-2">
                                        <div
                                            class="rem-header-white-subnav-content-items col-span-2 2xl:col-span-1">
                                            <div class="grid grid-cols-3">
                                                <div>
                                                    <p>{{ __('home.header.by_country') }}</p>
                                                    @if($menu->sub_menus && $menu->sub_menus->count() > 0)
                                                        <ul class="subitems">
                                                            @foreach ($menu->sub_menus as $country)
                                                                <li data-id="{{ $menu->id }}{{ $country->id }}" class="subitem">
                                                                    <a href="{{ ($country->region_names && $country->region_names->count() > 0) ? '#' : url('product?catf='. $menu->category_id.'&cf='.$country->id) }}" class="{{ ($country->region_names && $country->region_names->count() > 0) ? 'pointer-events-none' : '' }}">
                                                                        {{ $country->$locale_name }}
                                                                    </a>

                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </div>
                                                <div class="country-region col-span-2">
                                                    @if($menu->sub_menus && $menu->sub_menus->count() > 0)
                                                        @foreach ($menu->sub_menus as $country)
                                                            <div id="region-{{ $menu->id }}{{ $country->id }}" class="hidden">
                                                                @if($country->region_names && $country->region_names->count() > 0)
                                                                <ul>
                                                                    @foreach ($country->region_names as $region)
                                                                    <li>
                                                                        <a href="{{ url('product?catf='. $menu->category_id.'&rf='.$region->id) }}">
                                                                            {{ $region->$locale_name }}
                                                                        </a>
                                                                    </li>
                                                                    @endforeach
                                                                </ul>
                                                                @endif
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="flex flex-col 2xl:flex-row">
                                                <div component-name="product-item-card">
                                                    <div class="flex flex-col 2xl:flex-row items-stretch">
                                                        <div class="2xl:w-[47%] product-item-card-txt">
                                                            {!! $menu->description !!}
                                                            <a href="{{ route('front.product', ['catf' => $menu->category_id]) }}" class="flex uppercase underline"> view all
                                                                <img src="{{ asset('frontend/img/pro-card-arrow.svg') }}" alt="arrow"
                                                                    class="ml-[12px] object-contain" /></a>
                                                        </div>
                                                        <div class="2xl:w-[53%]">
                                                            <img src="{{ asset($menu->image) }}" alt="product"
                                                                class="object-cover h-full" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </li>
                    @endif

                    @if($menu->type === 'category' && !$menu->show_submenu)
                        <li>
                            <a href="{{ route('front.product', ['catf' => $menu->category_id]) }}" class="inline-block" >{{ $menu->name }}</a>
                        </li>
                    @endif
                @endforeach
            @endif
        </ul>
    </div>

    <!-- header mobile dropdown -->
    <div class="rem-header-mb fixed left-0 top-0 w-full hidden bg-white z-[11] px-[20px] pt-[20px]">
        <div class="flex items-center justify-between pb-5 border-b border-[#DFDFDF]">
            <a href="./">
                <img src="{{ asset('frontend/img/logo.svg') }}" />
            </a>
            <div class="rem-header-mb-close" onclick="headerSMclose('rem-header-mb')">
                <img src="{{ asset('frontend/img/mb-menu-close.svg') }}" alt="close" />
            </div>
        </div>
        <div class="rem-header-white-user flex pt-5 lg:hidden">
            <a href="{{ $isAuth ? route('front.member.dashboard') :  route('front.login') }}" class="flex items-start">
                <img src="{{ asset('frontend/img/user.svg') }}" alt="user">
                <div class="ml-[8px]">
                    <p class="-mb-[4px] font-semibold">
                        @if($isAuth)
                            {{ $authMember->full_name ?? '' }}
                        @else
                            {{ __('home.header.login_register') }}
                        @endif
                    </p>
                    @if($isAuth)
                    <span class="afterlogin rem-text-12 text-rembrown">{{ __('home.header.member_dashboard') }}</span>
                    @endif
                </div>
            </a>
        </div>
        <div class="rem-header-mb-items  scrollbar-inner  mt-[24px]">
            <ul>
                @if($header_menus && $header_menus->count() > 0)
                    @foreach ($header_menus as $menu)
                        @if($menu->type === 'promotion')
                            <li class="rem-header-mb-items-outer">
                                <div class="flex items-center justify-between mb-[16px] subitem-show">
                                    <p class="rem-header-mb-items-title">{{ $menu->name }}</p>
                                    <img src="{{ asset('frontend/img/arrow-down.svg') }}" alt="arrow"
                                        class="object-contain transition-all" />
                                </div>
                                <div class="rem-header-mb-items-wrapper hidden" style="display: none;">
                                    <ul class="rem-header-mb-items-wrapper-item pl-[20px]">
                                        <li>
                                            <div
                                                class="flex items-center justify-between mb-[10px] subitem-inner-show">
                                                <p class="rem-header-mb-items-subtitle">{{ __('home.header.promotion_type') }}</p>
                                                <img src="{{ asset('frontend/img/arrow-down.svg') }}" alt="arrow" />
                                            </div>
                                            <div class="hidden rem-header-mb-items-wrapper-item-inner pl-[20px]">
                                                @if($menu->show_submenu && ($menu->sub_menus && $menu->sub_menus->count() > 0))
                                                    <ul>
                                                        @foreach ($menu->sub_menus as $promotion)
                                                        <li>
                                                            <a href="{{ route('front.product', ['pf' => $promotion->id]) }}">{{ $promotion->$locale_name }}</a>
                                                        </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        @endif

                        @if($menu->type === 'category' && $menu->show_submenu)
                            <li class="rem-header-mb-items-outer">
                                <div class="flex items-center justify-between mb-[16px] subitem-show">
                                    <p class="rem-header-mb-items-title">{{ $menu->name }}</p>
                                    <img src="{{ asset('frontend/img/arrow-down.svg') }}" alt="arrow"
                                        class="object-contain transition-all" />
                                </div>
                                <div class="rem-header-mb-items-wrapper hidden" style="display: none;">
                                    <ul class="rem-header-mb-items-wrapper-item pl-[20px]">
                                        <li>
                                            <div
                                                class="flex items-center justify-between mb-[10px] subitem-inner-show">
                                                <p class="rem-header-mb-items-subtitle">{{ __('home.header.by_country') }}</p>
                                                <img src="{{ asset('frontend/img/arrow-down.svg') }}" alt="arrow" />
                                            </div>
                                            <div class="hidden rem-header-mb-items-wrapper-item-inner pl-[20px]">
                                                <ul>
                                                    @if($menu->sub_menus && $menu->sub_menus->count() > 0)
                                                        @foreach ($menu->sub_menus as $country)
                                                            <li class="flex-col">
                                                                <div
                                                                    class="flex items-center justify-between mb-[10px] {{ ($country->region_names && $country->region_names->count() > 0) ? 'subitem-inner-in-show' : '' }}">
                                                                    <a href="{{ ($country->region_names && $country->region_names->count() > 0) ? '#' : url('product?catf='. $menu->category_id.'&cf='.$country->id) }}" class="{{ ($country->region_names && $country->region_names->count() > 0) ? 'pointer-events-none' : '' }}">{{ $country->$locale_name }}</a>
                                                                    <img src="{{ asset('frontend/img/arrow-down.svg') }}" alt="arrow" class="{{ ($country->region_names && $country->region_names->count() > 0) ? '' : 'hidden' }}" />
                                                                </div>
                    
                                                                <div
                                                                    class="hidden rem-header-mb-items-wrapper-item-inner-in ml-[20px]">
                                                                    @if($country->region_names && $country->region_names->count() > 0)
                                                                        <ul>
                                                                            @foreach ($country->region_names as $region)
                                                                            <li>
                                                                                <a href="{{ url('product?catf='. $menu->category_id.'&rf='.$region->id) }}">{{ $region->$locale_name }}</a>
                                                                            </li>
                                                                            @endforeach
                                                                        </ul>
                                                                    @endif
                                                                </div>
                                                            </li>
                                                        @endforeach
                                                    @endif
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        @endif

                        @if($menu->type === 'category' && !$menu->show_submenu)
                            <li class="rem-header-mb-items-outer">
                                <a href="{{ route('front.product', ['catf' => $menu->category_id]) }}" class="block rem-header-mb-items-title mb-[16px]">{{ $menu->name }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            </ul>
        </div>
        <div class="fixed bottom-[36px] w-auto left-[20px] right-[20px]">
            <div class="flex justify-between pb-[20px] border-b border-[#DFDFDF]">
                <div class="rem-header-region-outer">
                    <div class="flex ">
                        <p class="mr-[10px]">{{ __('frontend.home.area') }}</p>
                        <div class="rem-header-region relative">
                            <div class="dropdown">
                                <div class="region-s-btn"><a href="javascript:void(0)"><span class="flex">{{ area() == 'hk' ? __('locale.hong_kong') : __('locale.macau') }}<img
                                                class="flag w-[20px] object-contain ml-2"
                                                src="{{ area() == 'hk' ? asset('frontend/img/hong-kong-sar.svg') : asset('frontend/img/macau-sar.svg') }}" alt="" /><span
                                                class="value">{{ area() == 'hk' ? 'hongkong' : 'macau' }}</span></span></a></div>
                                <dd>
                                    <ul>
                                        <li><a href="{{ route('front.set-area', 'hk') }}" class="flex justify-center">{{ __('locale.hong_kong') }}<img
                                                    class="flag w-[20px] object-contain ml-2"
                                                    src="{{ asset('frontend/img/hong-kong-sar.svg') }}" alt="" /><span
                                                    class="value">hongkong</span></a></li>
                                        <li><a href="{{ route('front.set-area', 'ma') }}" class="flex justify-center">{{ __('locale.macau') }}<img
                                                    class="flag w-[20px] object-contain ml-2"
                                                    src="{{ asset('frontend/img/macau-sar.svg') }}" alt="" /><span
                                                    class="value">macau</span></a></li>
                                    </ul>
                                </dd>
                            </div>
                        </div>
                    </div>               
                </div>
                <div class="flex items-center rem-header-sm-social-lang">
                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        @if($localeCode == 'zh-hant') 
                            <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}" class="@if($localeCode == App::currentLocale()) active @endif">
                                繁 
                            </a>
                        @elseif($localeCode == 'zh-hans') 
                            <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}" class="@if($localeCode == App::currentLocale()) active @endif">
                                简 
                            </a>
                        @else
                            <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}" class="@if($localeCode == App::currentLocale()) active @endif">
                        
                                EN 
                            </a>
                        @endif
                        @if(!$loop->last)
                            <p class="mx-[6px] text-white">|</p>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="mt-[20px] flex justify-center">
                <a href="" target="_blank" class="mr-[12px]">
                    <img src="{{ asset('frontend/img/instagram.svg') }}" alt="instagram" />
                </a>
                <a href="" target="_blank">
                    <img src="{{ asset('frontend/img/facebook.svg') }}" alt="instagram" />
                </a>
            </div>
        </div>
    </div>
</div>