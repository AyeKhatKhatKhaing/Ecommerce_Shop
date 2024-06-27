@extends('frontend.layouts.master')
@section('seo')
    <title>{{ isset($page) && isset($page->meta_titles) ? $page->meta_titles[lngKey()] : '' }}</title>
    <meta property="og:title" content="{{ isset($page) && isset($page->meta_titles) ? $page->meta_titles[lngKey()] : '' }}" />
    <meta name="description" content="{{ isset($page) && isset($page->meta_descriptions) ? $page->meta_descriptions[lngKey()] : '' }}">
    <meta property="og:description" content="{{ isset($page) && isset($page->meta_descriptions) ? $page->meta_descriptions[lngKey()] : '' }}" />
    <meta property="og:url"content="{{ route('front.wishlist') }}" />
    <meta property="og:locale" content="{{ lngKey() }}">
    <meta property="og:image" content="{{ isset($page) ? asset($page->meta_image) : '' }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="{{ isset($page) ? $page->meta_image_alt : '' }}">
@endsection
@section('content')
    @php
       $name = "name_".lngKey(); 
    @endphp
    <div component-name="rem-banner">
        <div class="relative">
            <img src="{{ asset(isset($page) ? $page->image : '') }}" class="min-h-[200px] object-cover lg:min-h-auto w-full"
                alt="{{ isset($page) ? $page->image_alt : '' }}">

            <h1
                class="banner-text text-whitez montserrat-bold absolute left-1/2 top-1/2 -translate-y-1/2 -translate-x-1/2">
                {{ isset($page) ? $page->titles[lngKey()] : '' }}</h1>
        </div>
    </div>
    <div component-name="rem-wishlist">
        <div class="rem-cart-container">
            <form action="{{ route('front.add.all.item') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="rem-cart-list rem-wish-list mb-[30px] ">
                    <table class="w-full">
                        <thead>
                            <tr>
                                <th class="w-[366px]">{{__('frontend.wishlist.product_name')}}</th>
                                <th class="w-[250px]">{{__('frontend.wishlist.price')}}</th>
                                <th class="w-[250px]">{{__('frontend.wishlist.status')}}</th>
                                <th class="w-[250px]"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($wishlists))
                                @foreach ($wishlists as $wishlist)
                                    @if (isset($wishlist->product) && $wishlist->product->count() > 0)
                                        <tr class="adminWishlistRow{{ $wishlist->id }} cart-row {{ $wishlist->product->isSoldOut($wishlist->product) ? 'warning-msg' : '' }}">
                                            <td data-label="Product Name" class="product-name">
                                                <div class="flex flex-wrap xl:flex-nowrap items-center product">
                                                    <div class="flex items-center">
                                                        <div class="adminRemoveWishList product-close w-[40px] cursor-pointer" data-id="{{ $wishlist->id }}">
                                                            <img src="{{ asset('frontend/img/mb-menu-close.svg') }}">
                                                        </div>
                                                        <img src="{{ isset($wishlist->product->feature_image) ? asset($wishlist->product->feature_image) : '' }}" alt="product" class="max-w-[109px] mx-[20px]">
                                                    </div>
                                                    <p class="name pt-3 xs:pt-0 lg:pt-3 xl:pt-0">{{ isset($wishlist->product->$name) ? $wishlist->product->$name : '' }}</p>
                                                </div>
                                            </td>
                                            <td data-label="Price" class="price">
                                                @if (area() == 'hk') HK$ @else MOP$ @endif<span class="priceValue">{{ $wishlist->amount }}</span>
                                            </td>
                                                <input type="hidden" name="{{ "wish_list_number_".$wishlist->id }}" value="{{ $wishlist->quantity }}">
                                                <input type="hidden" name="{{ "wish_list_name_".$wishlist->product->id }}" value="{{ $wishlist->product->$name }}" >
                                                <input type="hidden" name="{{ "wish_list_image_".$wishlist->product->id }}" value="{{ $wishlist->product->feature_image }}" >
                                                <input type="hidden" name="{{ "wish_list_type_".$wishlist->product->id }}" value="{{ $wishlist->product->type }}" >
                                                <input type="hidden" name="{{ "wish_list_min_stock_qty_".$wishlist->product->id }}" value="{{ $wishlist->product->min_stock_quantity }}">
                                                <input type="hidden" name="{{ "wish_list_sell_quantity_".$wishlist->product->id }}" value="{{ $wishlist->product->sell_quantity }}">
                                                <input type="hidden" name="{{ "wish_list_sale_price_".$wishlist->product->id }}" value="{{ $wishlist->product->sale_price != 0 ? $wishlist->product->sale_price : $wishlist->product->original_price }}">

                                            @if ($wishlist->product->isSoldOut($wishlist->product))
                                                <td data-label="Status" class="adminStatusText status out-of-stock">
                                                    {{__('frontend.wishlist.out_of_stock')}}
                                                </td>
                                            @else
                                                <td data-label="Status" class="adminStatusText status text-rembrown2">
                                                    {{__('frontend.wishlist.in_stock')}}
                                                </td>
                                                <td class="add-to-cart">
                                                    <button type="button" class="adminWishListCart" data-product-id="{{ $wishlist->product_id }}" data-wishlist-id="{{ $wishlist->id }}">
                                                        {{__('frontend.wishlist.add_to_cart')}}
                                                    </button>
                                                </td>
                                            @endif
                                        </tr>
                                    @endif
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    <div class="btns flex mt-[34px]">
                        <button type="button" class="adminClearWishList clear-wish">
                            {{__('frontend.wishlist.clear_wishlist')}}
                        </button>
                        <button type="submit" class="add-all-cart @if (count($wishlists) == 0) rem-disabled @endif">
                            {{__('frontend.wishlist.add_all_to_cart')}}
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
@endsection
@push('scripts')
    <script src="{{ asset('frontend/custom/wishlist.js?v='.time()) }}" type="text/javascript"></script>
@endpush