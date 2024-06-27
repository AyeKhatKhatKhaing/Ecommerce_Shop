@extends('frontend.layouts.master')
@section('seo')
    <title>{{ __('frontend.seo.member_wishlist.title') }}</title>
    <meta property="og:title" content="{{ __('frontend.seo.member_wishlist.meta_title') }}" />
    <meta name="description" content="{{ __('frontend.seo.member_wishlist.meta_description') }}">
    <meta property="og:description" content="{{ __('frontend.member_wishlist.meta_description') }}" />
    <meta property="og:url"content="{{ route('front.member.wishlist') }}" />
    <meta property="og:locale" content="{{ lngKey() }}">
    <meta property="og:image" content="">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="">
@endsection
@section('content')
@php
    $name = "name_".lngKey();
@endphp
<div component-name="rem-member-dashboard-wishlist" class="memberdashboard">
    @include('frontend.member.layouts.breadcrumb')

    <div class="container200 pt-5 md:pt-60 pb-10 md:pb-100 flex flex-col-reverse lg:flex-row xl:gap-[60px]">
        @include('frontend.member.layouts.sidebar')

        <div class="lg:flex-[none] lg:w-[70%]">
            <p class="member-title montserrat-bold text-black pb-5 md:pb-10">{{ __('frontend.member.my_wishlist') }}</p>
            <form action="{{ route('front.add.all.item') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="rem-cart-list rem-wish-list mb-[30px] ">
                    <table class="w-full hidden lg:block">
                        <thead>
                            <tr>
                                <th class="w-[366px]">{{ __('frontend.member.product_name') }}</th>
                                <th class="w-[250px]">{{ __('frontend.member.price') }}</th>
                                <th class="w-[250px]">{{ __('frontend.member.status') }}</th>
                                <th class="w-[250px]"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($wishlists))
                                @foreach ($wishlists as $wishlist)
                                    <tr class="cart-row {{ $wishlist->isSoldOut($wishlist->product) ? 'warning-msg' : '' }}">
                                        <td data-label="Product Name" class="product-name">
                                            <div class="flex flex-wrap xl:flex-nowrap items-center product">
                                                <div class="flex items-center">
                                                    <div class="adminRemoveWishList product-close w-[40px] cursor-pointer" data-id="{{ $wishlist->id }}">
                                                        <img src="{{ asset('frontend/img/mb-menu-close.svg') }}">
                                                    </div>
                                                    <img src="{{ isset($wishlist->product->feature_image) ? asset($wishlist->product->feature_image) : '' }}" alt="product" class="max-w-[109px] h-[100px] object-cover mx-[20px]">
                                                </div>
                                                <p class="name pt-3 xs:pt-0 lg:pt-3 xl:pt-0">{{ isset($wishlist->product->$name) ? $wishlist->product->$name : '' }}</p>
                                            </div>
                                        </td>
                                        <td data-label="Price" class="price">
                                            {{ currency() }} <span class="priceValue">{{ $wishlist->amount }}</span>
                                        </td>

                                        <input type="hidden" name="{{ "wish_list_number_".$wishlist->id }}" value="{{ $wishlist->quantity }}">
                                        <input type="hidden" name="{{ "wish_list_name_".$wishlist->product->id }}" value="{{ $wishlist->product->$name }}">
                                        <input type="hidden" name="{{ "wish_list_image_".$wishlist->product->id }}" value="{{ $wishlist->product->feature_image }}">
                                        <input type="hidden" name="{{ "wish_list_type_".$wishlist->product->id }}" value="{{ $wishlist->product->type }}">
                                        <input type="hidden" name="{{ "wish_list_sell_quantity_".$wishlist->product->id }}" value="{{ $wishlist->product->sell_quantity }}">
                                        <input type="hidden" name="{{ "wish_list_min_stock_qty_".$wishlist->product->id }}" value="{{ $wishlist->product->min_stock_quantity }}">
                                        <input type="hidden" name="{{ "wish_list_sale_price_".$wishlist->product->id }}" value="{{ $wishlist->product->sale_price != 0 ? $wishlist->product->sale_price : $wishlist->product->original_price }}">
                                        <td data-label="Status" class="status {{ $wishlist->isSoldOut($wishlist->product) ? 'out-of-stock' : 'text-rembrown2' }}">
                                            {{ $wishlist->isSoldOut($wishlist->product) ? 'Out Of Stock' : 'Instock' }}
                                        </td>
                                        <td class="add-to-cart">
                                            @if(!$wishlist->isSoldOut($wishlist->product))
                                            <button type="button" class="py-4 px-5 bg-rembrown text-white adminWishListCart" data-product-id="{{ $wishlist->product_id }}" data-wishlist-id="{{ $wishlist->id }}">
                                                Add to Cart
                                            </button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    <div class="lg:hidden">
                        <table class="w-full">
                            @if(isset($wishlists))
                                @foreach($wishlists as $wishlist)
                                    <tr class="cart-row {{$wishlist->isSoldOut($wishlist->product) ? 'warning-msg' : ''}}">
                                        <td>
                                            <div class="flex items-start rem-mb-mywish-list">
                                                <div class="product-img">
                                                    <img src="{{ isset($wishlist->product->feature_image) ? asset($wishlist->product->feature_image) : '' }}" alt="product" class="max-w-[109px]">
                                                </div>
                                                <div class="product-info w-full">
                                                    <div class="flex items-center justify-between pb-[10px]">
                                                        <div>
                                                            <p class="name pb-1">{{ isset($wishlist->product->$name) ? $wishlist->product->$name : '' }}</p>
                                                            <p class="pb-2 price">{{ currency() }}<span class="priceValue">{{ $wishlist->amount }}</span>
                                                            </p>
                                                        </div>
                                                        <div>
                                                            <div class="adminRemoveWishList product-close w-[40px] cursor-pointer" data-id="{{ $wishlist->id }}">
                                                                <img src="{{ asset('frontend/img/mb-menu-close.svg') }}" class="ml-auto" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="flex flex-wrap items-center justify-between">
                                                        <div>
                                                            <p class="{{ $wishlist->isSoldOut($wishlist->product) == true ? 'out-of-stock rem-text-14 ' : 'text-rembrown2 rem-text-14 pb-3 2xs:pb-0' }}">
                                                                {{ $wishlist->isSoldOut($wishlist->product) == true ? 'Out Of Stock' : 'Instock' }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        @if(!$wishlist->isSoldOut($wishlist->product))
                                                            <button type="button" class="py-3 px-5 bg-[#54301A] text-white adminWishListCart" data-product-id="{{ $wishlist->product_id }}" data-wishlist-id="{{ $wishlist->id }}">
                                                                {{ __('frontend.member.add_to_cart') }}
                                                            </button>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </table>

                    </div>
                    <div class="btns md:flex mt-[34px]">
                        <button type="button" class="clear-wish w-full md:w-auto mb-[12px] md:mb-0 clear-wish" onclick="openDeleteModal('delete-modal')">
                            {{ __('frontend.member.clear_wishlist') }}
                        </button>
                        <button class="add-all-cart w-full md:w-auto @if (count($wishlists) == 0) rem-disabled @endif">
                            {{ __('frontend.member.add_all_to_cart') }}
                        </button>
                    </div>
                </div>
            </form>
            <form action="{{ route('front.wishlist.item.delete') }}" method="post" id="wishlist-item-delete-form">
                <input type="hidden" name="wishlist_id" id="wishlist-item-id">
                @method("DELETE")
                @csrf
            </form>
        </div>
    </div>
    <div id="delete-modal" class="rem-newsletter-popup-wrapper fixed top-0 left-0 w-full h-full bg-[#000000ba] hidden">
        <div class="rem-newsletter-popup-card absolute bg-white min-w-[300px] max-w-[709px] left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 ">
            <div class="rem-newsletter-popup-content p-[20px] lg:p-[28px] 3xl:p-[48px] ">
                <div class="inner relative py-[30px] lg:py-[50px] 3xl:py-[74px]">
                    <div onclick="closeDeleteModal('delete-modal')" class="close absolute -top-[20px] lg:-top-[25px] -right-[20px] bg-white p-5 rounded-[30px] cursor-pointer">
                        <img src="{{ asset('frontend/img/close-br.svg') }}" alt="close" />
                    </div>
                    <h3 class="pb-5 text-center rem-text-24 text-remdark montserrat-semibold">{{ __('frontend.member.shopping_cart') }}</h3>

                    <div class="pt-5 sm:flex items-center xl:gap-5">
                        <button type="button" class="py-3 px-5 mb-5 sm:mb-0 bg-remred text-whitez rem-text-16 border border-remred hover:bg-transparent hover:text-remred montserrat w-full sm:mr-4 xl:mr-0" onclick="closeDeleteModal('delete-modal')">{{ __('frontend.member.no') }}</button>
                        <button type="button" class="py-3 px-5 bg-rembrown text-whitez rem-text-16 border border-rembrown hover:bg-transparent hover:text-rembrown montserrat w-full adminClearWishList">{{ __('frontend.member.yes') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script src="{{ asset('frontend/custom/wishlist.js?v='.time()) }}" type="text/javascript"></script>
@endpush