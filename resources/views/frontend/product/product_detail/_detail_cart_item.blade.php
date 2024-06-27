<div class="cart-item-pro space flex items-center pb-5 border-b border-b-remDF">
    <img src="{{ asset($detail_item->product_image) }}" alt="{{ isset($detail_item->product_image_alt) ? $detail_item->product_image_alt : ''}}"
        class="w-[82px] h-20 object-cover">
    <div class="cart-item-pro-txt pl-4">
        <p class="montserrat-semibold rem-text-12 text-remdark">{{ $detail_item->product_name }}</p>
        <p class="montserrat rem-text-12 text-remdark">@if (area() == 'hk') HK$ @else MOP$ @endif {{ $detail_item->sale_price ? $detail_item->sale_price : $detail_item->original_price }}</p>
        <div class="flex justify-between mt-[10px]">
            <p class="montserrat-medium rem-text-12 text-rembrown">{{__('frontend.product_detail.qty')}}
                <span>{{ $detail_item->quantity }}</span></p>
        </div>
    </div>
</div>