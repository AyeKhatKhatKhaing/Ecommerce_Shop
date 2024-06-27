@if(isset($cart_items) && $cart_items->count() > 0)
    @foreach ($cart_items as $item)
        <div class="cart-item-pro space flex items-center">
            <img src="{{ asset($item->product_image) }}" alt="product" />
            <div class="cart-item-pro-txt cart-item-pro-txt w-full">
                <p>{{ $item->product_name }}</p>
                <h3>{{ currency() }}{{ $item->amount }}</h3>                                   
                <div class="flex justify-between mt-[10px]">
                    <p>Qty: <span>{{ $item->quantity ?? 0 }}</span></p>
                    <img onclick="removeCartItem({{ $item->id }})" src="{{ asset('frontend/img/delete-icon.svg') }}" class="cursor-pointer" alt="delete" />
                </div>
            </div>                                
        </div>
    @endforeach
@endif
{{-- <div class="cart-item-pro space flex items-center">
    <img src="{{ asset('frontend/img/cart-product.png') }}" alt="product" />
    <div class="cart-item-pro-txt">
        <p>Languedoc Roussillon 2014</p>
        <h3>HK$21000</h3>                                   
        <div class="flex justify-between mt-[10px]">
            <p>Qty: <span>{{ 00 }}</span></p>
            <img src="{{ asset('frontend/img/delete-icon.svg') }}" class="cursor-pointer" alt="delete" />
        </div>
    </div>                                
</div> --}}
