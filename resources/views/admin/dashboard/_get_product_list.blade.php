@php
    $locale_name = "name_".lngKey();
@endphp
@if (isset($products) && count($products) > 0)
    @foreach ($products as $product)
        <div class="notice d-flex bg-light-primary rounded border-primary border border-dashed mb-9 p-6">
            <span class="svg-icon svg-icon-2tx svg-icon-warning me-4">
                <img src="{{ asset($product->feature_image) }}" alt="{{ $product->feature_image_alt }}" class="w-100px h-70px">
            </span>
            <div class="d-flex flex-stack flex-grow-1">
                <div class="fw-bold">
                    <h4 class="text-gray-900 fw-bolder"><a href="{{ url('/admin/product/' . $product->id . '/edit?type='.$product->type) }}">{{ $product->$locale_name }}</a></h4>
                    <p>
                        Stock Quantity :<span> {{ $product->quantity }}</span><br>
                        Sell Quantity :<span class="text-warning"> {{ $product->sell_quantity ?? 0 }}</span> , Min Stock Quantity : <span class="text-warning"> {{ $product->min_stock_quantity ?? 0 }}</span>
                    </p>
                </div>
            </div>
        </div>
    @endforeach
@endif
<input type="hidden" name="min_total_quantity" value="{{ $min_total_quantity }}">
<input type="hidden" name="product_ids" value="{{ $product_ids }}">