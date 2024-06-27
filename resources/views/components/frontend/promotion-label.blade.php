<div>
    @if($product->original_price > $product->sale_price)
        <p class="montserrat text-dolphin relative super-lasttwo super-linethrought">
            <span>{{ currency() }}</span><span>{{ $product->original_price }}</span>
        </p>
    @endif
</div>