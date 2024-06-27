@php
    $shipping = \DB::table('shippings')->where('country_type', area())->first();
@endphp
<div component-name="rem-header">
    <div id="remHeader" class="rem-header-container">
        <div class="rem-header-sm hidden lg:flex">
            <div class="rem-header-region-outer">
                <div class="flex ">
                    <p class="mr-[10px]">{{ __('frontend.home.area') }}</p>
                    <div class="rem-header-region relative">
                        <div class="dropdown">
                            <div class="region-s-btn"><a href="javascript:void(0)" ><span class="flex">{{ area() == 'hk' ? __('locale.hong_kong') : __('locale.macau') }}<img class="flag w-[20px] object-contain ml-2" src="{{ area() == 'hk' ? asset('frontend/img/hongkong.png') : asset('frontend/img/macau.png') }}" alt="" /><span class="value">{{ area() == 'hk' ? 'hongkong' : 'macau' }}</span></span></a></div>
                            <dd>
                                <ul>
                                    <li><a href="{{ route('front.set-area', 'hk') }}" class="flex justify-center">{{ __('locale.hong_kong') }}<img class="flag w-[20px] object-contain ml-2" src="{{ asset('frontend/img/hongkong.png') }}" alt="" /><span class="value">hongkong</span></a></li>
                                    <li><a href="{{ route('front.set-area', 'ma') }}" class="flex justify-center">{{ __('locale.macau') }}<img class="flag w-[20px] object-contain ml-2" src="{{ asset('frontend/img/macau.png') }}" alt="" /><span class="value">macau</span></a></li>                                   
                                </ul>
                            </dd>
                        </div>
                    </div>
                </div>               
            </div>
            <div class="rem-header-sm-txt">
                <p>{{ __('frontend.footer.law') }}</p>                
            </div>
            <div class="flex items-center rem-header-sm-social">
                <div class="flex rem-header-sm-social-icon">
                    <a href="" target="_blank" class="w-4 mr-3">
                        <img src="{{ asset('frontend/img/insta.svg') }}"  alt="instagram" />
                    </a>
                    <a href="" target="_blank" class="w-4">
                        <img src="{{ asset('frontend/img/fb.svg') }}"  alt="facebook" />
                    </a>
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
        </div>
        <div class="rem-header-sm-mb py-[12px] lg:hidden">
            <div class="rem-header-sm-txt flex items-center justify-between">
                <p>{{ __('frontend.footer.law') }}</p>
                <div class="w-[50px] header-sm-mb-close" onclick="headerSMclose('rem-header-sm-mb')">
                    <img src="{{ asset('frontend/img/close-sm.svg') }}" alt="close" />
                </div>
            </div>
        </div>
        <div class="rem-header-white">
            <div class="flex items-center justify-between">
                <div class="hidden lg:flex items-center rem-disabled"> <!-- will remove 'rem-disabled class' in pharse 2 -->
                    <div class="rem-header-white-search">
                        <div class="flex border-b border-[#1E1D1B]">
                            <input type="search" placeholder="{{ __('frontend.home.search') }}">
                            <button type="submit" onclick="openSearch()">{{ __('frontend.home.search') }}</button>
                        </div>
                    </div>
                </div>
                <div>
                    <a href="{{ route('front.home') }}">
                        <img src="{{ asset('frontend/img/logo.svg') }}" alt="logo" />
                    </a>
                </div>
                <div class="flex items-center">
                    <div class="rem-disabled rem-header-white-search-mb mr-[11px] lg:hidden" onclick="openSearch()"><!-- will remove 'rem-disabled class' in pharse 2 -->  
                        <img src="{{ asset('frontend/img/search.svg') }}" alt="search" />                       
                    </div>
                    <div class="rem-header-white-user hidden lg:flex items-center lg:mr-[22px]">
                        @if(auth('member')->check())
                            <img src="{{ asset('frontend/img/user.svg') }}" alt="user" />
                            <a href="{{ route('front.member.dashboard') }}" class="flex items-center">
                                <p class="ml-[8px] -mb-[4px]"> {{ auth('member')->user()->full_name }} </p>
                            </a>
                        @else
                            <img src="{{ asset('frontend/img/user.svg') }}" alt="user" />
                            <a href="{{ route('front.login') }}" class="flex items-center">
                                <p class="ml-[8px] -mb-[4px]">{{ __('frontend.home.login') }} / </p>
                            </a> 
                            <a href="{{ route('front.register') }}" class="flex items-center">
                                <p class="ml-[8px] -mb-[4px]">{{ __('frontend.home.register') }}</p>
                            </a>
                        @endif
                                             
                    </div>
                    <div class="rem-header-white-fav mr-2 lg:mr-[20px] relative">
                        @if (auth()->guard('member')->check())
                            <a href="{{ route('front.member.wishlist') }}">
                                <img src="{{ asset('frontend/img/heart.svg') }}" alt="favourite" />
                            </a>
                            <a href="{{ route('front.member.wishlist') }}"><div id="adminWishlistCount"
                                class="favourite_count absolute inline-flex items-center justify-center w-6 h-6 text-sm text-white bg-[#CC1F1F] rounded-full -top-1 -right-3 ">
                                <x-frontend.wishlist-count /></div></a>
                        @else
                            <a href="{{ route('front.wishlist') }}">
                                <img src="{{ asset('frontend/img/heart.svg') }}" alt="favourite" />
                            </a>
                            <a href="{{ route('front.wishlist') }}"><div id="adminWishlistCount"
                                class="favourite_count absolute inline-flex items-center justify-center w-6 h-6 text-sm text-white bg-[#CC1F1F] rounded-full -top-1 -right-3 ">
                            <x-frontend.wishlist-count /></div></a>
                        @endif
                    </div>
                    <!-- Please do not remove id & class name which are starting admin --> 
                    <div class="adminCartIcon rem-header-white-cart mr-[20px] relative">
                        <img src="{{ asset('frontend/img/cart.svg') }}" class="adminCartIcon carticon" alt="cart" />
                        <span class="sr-only">Notifications</span>
                        <div id="adminCartCount" class="adminCartIcon carticon absolute inline-flex items-center justify-center w-6 h-6 text-sm text-white bg-[#CC1F1F] rounded-full -top-1 -right-3 "><x-frontend.cart-count /></div>
                        <!-- cart -->
                        <div class="cart-item absolute hidden ">
                            <img src="{{ asset('frontend/img/Polygon 2.png') }}" class="absolute -top-[15px] cart-item-triangle" alt="triangle" />
                            <div class="cart-item-title space flex justify-between items-center ">
                                My Cart
                                <img src="{{ asset('frontend/img/mb-menu-close.svg') }}" class="lg:hidden my-cart-close" alt="close">
                            </div>
                            <div class="cart-item-inner scrollbar-inner">
                                <div class="adminCartItemList"></div>
                                {{-- @include('frontend.home._cart_item') --}}
                            </div>                           
                            <div class="space cart-item-btns">
                                <div class="cart-item-btns-txt flex justify-between">
                                    <p class="qty">Subtotal <span id="adminCartItemLabel"></span></p>
                                    <p class="price" id="adminTotalAmount"></p>
                                </div>
                                <a href="{{ route('front.cart') }}">
                                <button class="view">View Cart</button>
                                </a>
                                @if(!auth('member')->check())
                                    <a href="{{ route('front.checkout.login') }}" class="adminDisabled">
                                        <button class="checkout">Checkout</button>
                                    </a>
                                @else
                                    <a href="{{ route('front.checkout') }}" class="adminDisabled">
                                        <button class="checkout">Checkout</button>
                                    </a>
                                @endif
                            </div>
                            {{-- <div class="space cart-item-note">
                                <p class="title">Free Delivery</p>
                                <p class="des">Spend <span>{{ currency() }}{{ $shipping->free_shipping_amount }}</span> more to enjoy free delivery.</p>
                            </div> --}}
                        </div>
                        <!-- cart -->
                    </div>
                    <div class="rem-header-white-more-menu lg:hidden"  onclick="menuMbOpen()">
                        <img src="{{ asset('frontend/img/more-menu.svg') }}" alt="cart" />                        
                    </div>
                </div>
            </div>
            <!-- Menu Header Web & Mobile Component -->
            <x-frontend.menu-header :isAuth="$isAuth" :authMember="$authMember" />
        </div>
    </div>
    <!-- search dropdown -->
    <div id="search-dropdown" class="search-dropdown bg-white fixed top-0 w-full hide z-[13]">
        <div class="search-dropdown-close cursor-pointer" onclick="closeSearch()">
            <img src="{{ asset('frontend/img/close.svg') }}" alt="close" />
        </div>
        <div id="keyword" class="search-tabcontent">
            <div class="search-dropdown-container border-b border-[#BCBEC0]">           
                <div class="normal-search">
                    <p class="search-dropdown-title">What are you looking for?</p>
                    <div class="search-dropdown-search">
                    <form>
                        <input type="search" placeholder="Search for a wine name, brand or type...">
                        <button type="submit">Search</button>
                    </form>
                    </div>
                    <div class="search-dropdown-search-popular flex flex-wrap items-center mt-[24px]">
                        <p class="mr-[22px]">Popular Searches:</p>
                        <div class="flex flex-wrap">                    
                            <a href="">Wine</a>
                            <a href="">White Wine</a>
                            <a href="">Whisky</a>
                            <a href="">Champagne</a>
                            <a href="">Brandy</a>
                        </div>
                    </div>
                    <div class="search-dropdown-search-items lg:mt-[20px] 3xl:mt-[40px]">
                        <div>
                            <div class="suggest-brand-mb lg:hidden">
                                <p class="mb-[10px]">Suggested Brands<span>(1)</span></p>
                                <div class="flex flex-wrap">
                                    <a href="" class="mr-[20px]">
                                        <img src="{{ asset('frontend/img/suggest-product.png') }}" class="max-w-[150px]" />
                                    </a>
                                    <a href="">
                                        <img src="{{ asset('frontend/img/suggest-product.png') }}" class="max-w-[150px]" />
                                    </a>
                                </div>
                            </div>
                            <div class="recommen-product-mb lg:hidden">
                                <p class="mb-[]10px">Recommended Products<span>(50)</span></p>
                                <div class="product">
                                    <img src="{{ asset('frontend/img/p1.png') }}" class="mr-[33px]" />
                                    <div class="product-txt">
                                        <p class="title">
                                            Macallan Concept 2
                                        </p>
                                        <p class="price-old relative super-lasttwo"><span>HK$</span><span>4,59000</span></p>
                                        <p class="price relative super-lasttwo"><span>HK$</span><span>3,28000</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="scrollbar-inner hidden lg:block">
                            <div class="mt-[30px] grid grid-cols-1 lg:grid-cols-2 2xl:grid-cols-3 ">
                                <div component-name="product-item" class="mb-[40px]">
                                    <a href="#" class="block">
                                        <div class="flex items-center">
                                            <div class="product-item-img">
                                                <img src="{{ asset('frontend/img/p1.png') }}" alt="product" />
                                            </div>
                                            <div class="product-item-txt">
                                                <h3 class="mb-[10px]">Macallan Concept 2</h3>
                                                <p>HK$4,59000</p>
                                                <h2>HK$3,28000</h2>
                                            </div>
                                        </div>
                                    </a>    
                                </div>
                                <div component-name="product-item" class="mb-[40px]">
                                    <a href="#" class="block">
                                        <div class="flex items-center">
                                            <div class="product-item-img">
                                                <img src="{{ asset('frontend/img/p2.png') }}" alt="product" />
                                            </div>
                                            <div class="product-item-txt">
                                                <h3 class="mb-[10px]">French Earl de Quintus (selection) red wine, Bordeaux 2012</h3>
                                                <p></p>
                                                <h2>HK$10000</h2>
                                            </div>
                                        </div>
                                    </a>    
                                </div>
                                <div component-name="product-item" class="mb-[40px]">
                                    <a href="#" class="block">
                                        <div class="flex items-center">
                                            <div class="product-item-img">
                                                <img src="{{ ('frontend/img/p3.png') }}" alt="product" />
                                            </div>
                                            <div class="product-item-txt">
                                                <h3 class="mb-[10px]">Macallan Concept 2</h3>
                                                <p>HK$4,59000</p>
                                                <h2>HK$3,28000</h2>
                                            </div>
                                        </div>
                                    </a>    
                                </div>
                                <div component-name="product-item" class="mb-[40px]">
                                    <a href="#" class="block">
                                        <div class="flex items-center">
                                            <div class="product-item-img">
                                                <img src="{{ asset('frontend/img/p1.png') }}" alt="product" />
                                            </div>
                                            <div class="product-item-txt">
                                                <h3 class="mb-[10px]">Macallan Concept 2</h3>
                                                <p>HK$4,59000</p>
                                                <h2>HK$3,28000</h2>
                                            </div>
                                        </div>
                                    </a>    
                                </div>
                                <div component-name="product-item" class="mb-[40px]">
                                    <a href="#" class="block">
                                        <div class="flex items-center">
                                            <div class="product-item-img">
                                                <img src="{{ asset('frontend/img/p2.png') }}" alt="product" />
                                            </div>
                                            <div class="product-item-txt">
                                                <h3 class="mb-[10px]">French Earl de Quintus (selection) red wine, Bordeaux 2012</h3>
                                                <p></p>
                                                <h2>HK$10000</h2>
                                            </div>
                                        </div>
                                    </a>    
                                </div>
                                <div component-name="product-item" class="mb-[40px]">
                                    <a href="#" class="block">
                                        <div class="flex items-center">
                                            <div class="product-item-img">
                                                <img src="{{ ('frontend/img/p3.png') }}" alt="product" />
                                            </div>
                                            <div class="product-item-txt">
                                                <h3 class="mb-[10px]">Macallan Concept 2</h3>
                                                <p>HK$4,59000</p>
                                                <h2>HK$3,28000</h2>
                                            </div>
                                        </div>
                                    </a>    
                                </div>
                                <div component-name="product-item" class="mb-[40px]">
                                    <a href="#" class="block">
                                        <div class="flex items-center">
                                            <div class="product-item-img">
                                                <img src="{{ asset('frontend/img/p1.png') }}" alt="product" />
                                            </div>
                                            <div class="product-item-txt">
                                                <h3 class="mb-[10px]">Macallan Concept 2</h3>
                                                <p>HK$4,59000</p>
                                                <h2>HK$3,28000</h2>
                                            </div>
                                        </div>
                                    </a>    
                                </div>
                                <div component-name="product-item" class="mb-[40px]">
                                    <a href="#" class="block">
                                        <div class="flex items-center">
                                            <div class="product-item-img">
                                                <img src="{{ asset('frontend/img/p2.png') }}" alt="product" />
                                            </div>
                                            <div class="product-item-txt">
                                                <h3 class="mb-[10px]">French Earl de Quintus (selection) red wine, Bordeaux 2012</h3>
                                                <p></p>
                                                <h2>HK$10000</h2>
                                            </div>
                                        </div>
                                    </a>    
                                </div>
                                <div component-name="product-item" class="mb-[40px]">
                                    <a href="#" class="block">
                                        <div class="flex items-center">
                                            <div class="product-item-img">
                                                <img src="{{ asset('frontend/img/p3.png') }}" alt="product" />
                                            </div>
                                            <div class="product-item-txt">
                                                <h3 class="mb-[10px]">Macallan Concept 2</h3>
                                                <p>HK$4,59000</p>
                                                <h2>HK$3,28000</h2>
                                            </div>
                                        </div>
                                    </a>    
                                </div>
                            </div>
                        </div>                    
                        <div class="flex justify-center mt-[40px]">
                            <a href="#" class="view-all-items inline-block">
                                Views all results
                            </a>
                        </div>
                    </div>                    
                </div>           
            </div>
            <div class="search-dropdown-advance-btn py-[18px] flex justify-center">
                <button class="flex items-center changeSearchBtn" onclick="changeSearchView(event, 'advance')">
                    Advance Search
                    <div class="ml-[12px]">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <path d="M5.34984 14.6663L4.1665 13.483L9.64984 7.99967L4.1665 2.51634L5.34984 1.33301L12.0165 7.99967L5.34984 14.6663Z" fill="#1E1D1B"/>
                        </svg>
                    </div>                
                </button>
            </div>
        </div>
        <div id="advance" class="search-tabcontent">
            <div class="search-dropdown-container border-b border-[#BCBEC0]">
                <p class="advance-title text-center mb-[24px]">Advance Search</p>
                <div class="advance-search-inputs">
                    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-3">
                        <div class="w-full">
                            <input type="text" id="hfilter-country" hidden>
                            <select class="px-4 4xl:px-5 bg-[#F5F5F5] filter-multiselect w-full h-[40px] 4xl:h-[45px] border-transparent border-r-[15px] rounded-[9px] focus-visible:outline-none" placeholder="All Countries"
                              multiple
                              name="country"
                              multiselect-search="true" 
                              multiselect-select-all="true" 
                              multiselect-max-items="3"
                              multiselect-hide-x = "true">
                              <option value="1">Argentina</option>
                              <option value="2">Austria</option>
                              <option value="3">Canada</option>
                              <option value="4">Chile</option>
                              <option value="5">China</option>
                            </select>
                        </div>
                        <div class="w-full">
                            <input type="text" id="hfilter-region" hidden>
                            <select class="px-4 4xl:px-5 bg-[#F5F5F5] filter-multiselect w-full h-[40px] 4xl:h-[45px] border-transparent border-r-[15px] rounded-[9px] focus-visible:outline-none" placeholder="All Regions"
                              multiple
                              name="region"
                              multiselect-search="true" 
                              multiselect-select-all="true" 
                              multiselect-max-items="3"
                              multiselect-hide-x = "true">
                              <option value="">Area 1</option>
                              <option value="">Area 2</option>
                              <option value="">Area 3</option>
                              <option value="">Area 4</option>
                              <option value="">Area 5</option>
                              <option value="">Area 6</option>
                            </select>
                        </div>
                        <div class="w-full">
                            <input type="text" id="hfilter-alcohol" hidden>
                            <select class="px-4 4xl:px-5 bg-[#F5F5F5] filter-multiselect w-full h-[40px] 4xl:h-[45px] border-transparent border-r-[15px] rounded-[9px] focus-visible:outline-none" placeholder="All Alcohol"
                              multiple
                              name="alcohol"
                              multiselect-search="true" 
                              multiselect-select-all="true" 
                              multiselect-max-items="3"
                              multiselect-hide-x = "true">
                              <option value="">Cognac</option>
                              <option value="">Vodka</option>
                              <option value="">Gin</option>
                              <option value="">Rum</option>
                              <option value="">Tequila</option>
                              <option value="">Port Wine</option>
                            </select>
                        </div>
                        <div class="w-full">
                            <input type="text" id="hfilter-varieties" hidden>
                            <select class="px-4 4xl:px-5 bg-[#F5F5F5] filter-multiselect w-full h-[40px] 4xl:h-[45px] border-transparent border-r-[15px] rounded-[9px] focus-visible:outline-none" placeholder="All grape Varieties"
                              multiple
                              name="country"
                              multiselect-search="true" 
                              multiselect-select-all="true" 
                              multiselect-max-items="3"
                              multiselect-hide-x = "true">
                              <option value="">Grape Variety 1</option>
                              <option value="">Grape Variety 2</option>
                              <option value="">Grape Variety 3</option>
                              <option value="">Grape Variety 4</option>
                              <option value="">Grape Variety 5</option>
                              <option value="">Grape Variety 6</option>
                            </select>
                        </div>
                        <div class="w-full relative custom-selectbox">
                            <input type="text" id="hfilter-region" hidden>
                            <p class="border border-rembrown w-full custom-selectboxbtn pl-[1.6rem] 5xl:pl-6 pr-4 5xscustom:pr-[1.1rem] 5xs:pr-[1.2rem] 2xs:pr-[1.3rem] xs:pr-6 sm:pr-[1.2rem] 2xl:pr-[1.3rem] 6xl:pr-[1.4rem] py-3 h-full montserrat text-rembrown flex items-center justify-between">
                                Price
                            </p>
                            <div class="absolute left-0 top-12 custom-selectboxcontent w-full bg-white py-5 border border-rembrown hidden">
                                <div class="border-b border-rembrown">
                                    <div class="flex items-center pb-4 xl:gap-2 px-4 price-rangecontainer">
                                        <div>
                                            <label for="lowest" class="montserrat text-rembrown2 rem-text-12 block pb-1">Lowest</label>
                                            
                                            <div class="flex items-center px-3 py-2 montserrat rem-text-14 border border-rembrown lowest-price">
                                                <span>HK$</span>
                                                <input type="number" class="rem-text-14 bg-transparent w-full outline-none" id="lowest-price" value="38" min="0">
                                            </div>
                                        </div>
                                        <span class="mt-4 mx-1 xl:mx-0">-</span>
                                        <div>
                                            <label for="highest" class="montserrat text-rembrown2 rem-text-12 block pb-1">Highest</label>
                                            <div class="flex items-center px-3 py-2 montserrat rem-text-14 border border-rembrown highest-price">
                                                <span>HK$</span>
                                                <input type="number" class="rem-text-14 bg-transparent w-full outline-none" id="highest-price"  value="500000" min="0">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pb-6 px-4">
                                        <div class="price-filterslider"></div>
                                    </div>
                                </div>

                                <div class="flex xl:gap-3 items-center pt-5 px-4">
                                    <button type="button" class="border border-rembrown montserrat-bold text-center rem-text-16 text-rembrown hover:bg-mainyellow hover:text-rembrown hover:border-mainyellow py-3 px-5 w-full mr-4 xl:mr-0">重設</button>
                                    <button type="button" class="border border-rembrown montserrat-bold text-center rem-text-16 text-whitez bg-rembrown hover:bg-mainyellow hover:text-rembrown  hover:border-mainyellow py-3 px-5 w-full">Search</button>
                                </div>
                            </div>
                        </div>
                        <div class="w-full">
                            <input type="text" id="hfilter-years" hidden>
                            <select class="px-4 4xl:px-5 bg-[#F5F5F5] filter-multiselect w-full h-[40px] 4xl:h-[45px] border-transparent border-r-[15px] rounded-[9px] focus-visible:outline-none" placeholder="All Years"
                              multiple
                              name="alcohol"
                              multiselect-search="true" 
                              multiselect-select-all="true" 
                              multiselect-max-items="3"
                              multiselect-hide-x = "true">
                              <option value="">N.V.</option>
                              <option value="">1990</option>
                              <option value="">1990</option>
                              <option value="">1994</option>
                              <option value="">1996</option>
                              <option value="">2000</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-3 pt-4">
                    </div>
                </div>
                <div class="flex justify-center mt-[40px]">
                    <a href="#" class="view-all-items inline-block">
                        搜尋
                    </a>
                </div>
            </div>
            <div class="search-dropdown-advance-btn py-[18px] flex justify-center">
                <button class="flex items-center changeSearchBtn" onclick="changeSearchView(event, 'keyword')">
                    <div class="mr-[12px]">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <path d="M10.6497 14.6654L11.833 13.482L6.34967 7.9987L11.833 2.51536L10.6497 1.33203L3.98301 7.9987L10.6497 14.6654Z" fill="#1E1D1B"/>
                        </svg>
                    </div> 
                    Back to Keyword Search                                      
                </button>
           </div>
        </div>
    </div>
</div>
<div id="location-warning" class="fixed top-0 left-0 w-full h-full bg-[#000000ba] hidden z-[12]" style="display: {{ session('location-warning-popup') ? 'block' : 'none' }}">
    <div
        class="absolute bg-white min-w-[300px] max-w-[709px] left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 ">
        <div class="rem-newsletter-popup-content p-[20px] lg:p-[28px] 3xl:p-[48px] ">
            <div class="inner relative py-[30px] lg:py-[50px] 3xl:py-[74px]">
                <div
                    class="adminCloseWarningPopup close absolute -top-[20px] lg:-top-[25px] -right-[20px] bg-white p-5 rounded-[30px] cursor-pointer">
                    <img src="{{ asset('frontend/img/close-br.svg') }}" alt="close" />
                </div>
                <p class="pb-6 text-center rem-text-32 text-remdark montserrat-semibold">{{ __('frontend.header.important_notice') }}</p>

                <p class="montserrat location-des text-remdark pb-4">
                    {{ __('frontend.header.online_store') }}
                </p>

                <p class="montserrat location-des text-remdark">
                    {{ __('frontend.header.enter') }}<span class="montserrat-medium text-rembrown">
                        {{ __('frontend.header.invalid_shipping_region') }}</span>, 
                        {{ __('frontend.header.your_order') }}<span class="montserrat-medium text-rembrown">
                        {{ __('frontend.header.proceed') }}</span>
                </p>

                <div class="pt-5 text-center">
                    <button
                        class="adminCloseWarningPopup py-3 px-9 bg-rembrown text-whitez rem-text-16 border border-rembrown hover:bg-transparent hover:text-rembrown montserrat-semibold">{{ __('frontend.header.understand') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        $(document).on('click', '.adminCloseWarningPopup', function (){
            closeLocationModal()
            location.reload();
        })
    </script>
@endpush
