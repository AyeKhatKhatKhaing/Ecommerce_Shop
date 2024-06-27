<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Export</title>
</head>

<body>
    <table class="table" border="1" cellspacing="0">
        <thead>
            <tr>
                <th style="font-weight: bold;">#</th>
                <th style="font-weight: bold;">Product Number</th>
                <th style="font-weight: bold;">Product Name Hant</th>
                <th style="font-weight: bold;">Product Name Hans</th>
                <th style="font-weight: bold;">Product Name En</th>
                <th style="font-weight: bold;">Type</th>
                <th style="font-weight: bold;">Original Price</th>
                <th style="font-weight: bold;">Sale Price</th>
                <th style="font-weight: bold;">Quantity</th>
                <th style="font-weight: bold;">Sell Quantity</th>
                <th style="font-weight: bold;">Refill Quantity</th>
                <th style="font-weight: bold;">Min Stock Quantity</th>
                <th style="font-weight: bold;">Capacity</th>
                <th style="font-weight: bold;">Product Label Hant</th>
                <th style="font-weight: bold;">Product Label Hans</th>
                <th style="font-weight: bold;">Product Label En</th>
                <th style="font-weight: bold;">Member Offer Label Hant</th>
                <th style="font-weight: bold;">Member Offer Label Hans</th>
                <th style="font-weight: bold;">Member Offer Label En</th>
                <th style="font-weight: bold;">Country Name Hant</th>
                <th style="font-weight: bold;">Country Name Hans</th>
                <th style="font-weight: bold;">Country Name En</th>
                <th style="font-weight: bold;">Region Name Hant</th>
                <th style="font-weight: bold;">Region Name Hans</th>
                <th style="font-weight: bold;">Region Name En</th>
                <th style="font-weight: bold;">Category Hant</th>
                <th style="font-weight: bold;">Category Hans</th>
                <th style="font-weight: bold;">Category En</th>
                <th style="font-weight: bold;">Promotion Hant</th>
                <th style="font-weight: bold;">Promotion Hans</th>
                <th style="font-weight: bold;">Promotion En</th>
                <th style="font-weight: bold;">Classification Hant</th>
                <th style="font-weight: bold;">Classification Hans</th>
                <th style="font-weight: bold;">Classification En</th>
                <th style="font-weight: bold;">Vintage</th>
                <th style="font-weight: bold;">Bottle Size</th>
                <th style="font-weight: bold;">Package Size</th>
                <th style="font-weight: bold;">Content Hant</th>
                <th style="font-weight: bold;">Content Hans</th>
                <th style="font-weight: bold;">Content En</th>
                <th style="font-weight: bold;">Rating RP</th>
                <th style="font-weight: bold;">Rating WS</th>
                <th style="font-weight: bold;">Rating JH</th>
                <th style="font-weight: bold;">Rating BC</th>
                <th style="font-weight: bold;">Rating JS</th>
                <th style="font-weight: bold;">Rating BH</th>
                <th style="font-weight: bold;">Description Hant</th>
                <th style="font-weight: bold;">Description Hans</th>
                <th style="font-weight: bold;">Description En</th>
                <th style="font-weight: bold;">Testing Note Hant</th>
                <th style="font-weight: bold;">Testing Note Hans</th>
                <th style="font-weight: bold;">Testing Note En</th>
                <th style="font-weight: bold;">Product Detail Hant</th>
                <th style="font-weight: bold;">Product Detail Hans</th>
                <th style="font-weight: bold;">Product Detail En</th>
                <th style="font-weight: bold;">Award Hant</th>
                <th style="font-weight: bold;">Award Hans</th>
                <th style="font-weight: bold;">Award En</th>
                <th style="font-weight: bold;">Image</th>
                <th style="font-weight: bold;">Is Publish</th>
                <th style="font-weight: bold;">Is Exclusive Product</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->code }}</td>
                    <td>{{ $item->name_hant }}</td>
                    <td>{{ $item->name_hans }}</td>
                    <td>{{ $item->name_en }}</td>
                    <td>{{ $item->type }}</td>
                    <td>{{ $item->original_price }}</td>
                    <td>{{ $item->sale_price }}</td>
                    <td>{{ $item->quantity }}</td>
                    <th>{{ $item->sell_quantity }}</th>
                    <th>{{ $item->refill_quantity }}</th>
                    <th>{{ $item->min_stock_quantity }}</th>
                    <th>{{ $item->capacity }}</th>
                    <th>{{ isset($item->product_label) ? $item->product_label->name_hant : '' }}</th>
                    <th>{{ isset($item->product_label) ? $item->product_label->name_hans : '' }}</th>
                    <th>{{ isset($item->product_label) ? $item->product_label->name_en : '' }}</th>
                    <th>{{ isset($item->product_label) ? $item->product_label->name_hant : '' }}</th>
                    <th>{{ isset($item->product_label) ? $item->product_label->name_hans : '' }}</th>
                    <th>{{ isset($item->product_label) ? $item->product_label->name_en : '' }}</th>
                    <th>{{ isset($item->country) ? $item->country->name_hant : '' }}</th>
                    <th>{{ isset($item->country) ? $item->country->name_hans : '' }}</th>
                    <th>{{ isset($item->country) ? $item->country->name_en : '' }}</th>
                    <th>{{ isset($item->region) ? $item->region->name_hant : '' }}</th>
                    <th>{{ isset($item->region) ? $item->region->name_hans : '' }}</th>
                    <th>{{ isset($item->region) ? $item->region->name_en : '' }}</th>
                    <th>{{ $item->getCategoriesName($item->categories) }}</th>
                    <th>{{ $item->getCategoriesName($item->categories) }}</th>
                    <th>{{ $item->getCategoriesName($item->categories) }}</th>
                    <th>{{ $item->getPromotionsName($item->promotions) }}</th>
                    <th>{{ $item->getPromotionsName($item->promotions) }}</th>
                    <th>{{ $item->getPromotionsName($item->promotions) }}</th>
                    <th>{{ $item->getClassificationsName($item->classifications) }}</th>
                    <th>{{ $item->getClassificationsName($item->classifications) }}</th>
                    <th>{{ $item->getClassificationsName($item->classifications) }}</th>
                    <td>
                        @if (isset($item->attributes))
                            @foreach ($item->attributes as $attribute)
                                @if ($attribute->attribute_term_id == 1)
                                    {{ $attribute->name }}
                                @endif
                            @endforeach
                        @endif
                    </td>
                    <td>
                        @if (isset($item->attributes))
                            @foreach ($item->attributes as $attribute)
                                @if ($attribute->attribute_term_id == 2)
                                    {{ $attribute->name }}
                                @endif
                            @endforeach
                        @endif
                    </td>
                    <td>
                        @if (isset($item->attributes))
                            @foreach ($item->attributes as $attribute)
                                @if ($attribute->attribute_term_id == 3)
                                    {{ $attribute->name }}
                                @endif
                            @endforeach
                        @endif
                    </td>
                    <td>
                        {{ isset($item->product_meta) && isset($item->product_meta->contents) ? $item->product_meta->contents['hant'] : '' }}
                    </td>
                    <td>
                        {{ isset($item->product_meta) && isset($item->product_meta->contents) ? $item->product_meta->contents['hans'] : '' }}
                    </td>
                    <td>
                        {{ isset($item->product_meta) && isset($item->product_meta->contents) ? $item->product_meta->contents['en'] : '' }}
                    </td>
                    <td>
                        {{ isset($item->product_rating) ? $item->product_rating->score_rp : '' }}
                    </td>
                    <td>
                        {{ isset($item->product_rating) ? $item->product_rating->score_ws : '' }}
                    </td>
                    <td>
                        {{ isset($item->product_rating) ? $item->product_rating->score_jh : '' }}
                    </td>
                    <td>
                        {{ isset($item->product_rating) ? $item->product_rating->score_bc : '' }}
                    </td>
                    <td>
                        {{ isset($item->product_rating) ? $item->product_rating->score_js : '' }}
                    </td>
                    <td>
                        {{ isset($item->product_rating) ? $item->product_rating->score_bh : '' }}
                    </td>
                    <td>
                        {{ isset($item->product_meta) && isset($item->product_meta->descriptions) ? $item->product_meta->descriptions['hant'] : '' }}
                    </td>
                    <td>
                        {{ isset($item->product_meta) && isset($item->product_meta->descriptions) ? $item->product_meta->descriptions['hans'] : '' }}
                    </td>
                    <td>
                        {{ isset($item->product_meta) && isset($item->product_meta->descriptions) ? $item->product_meta->descriptions['en'] : '' }}
                    </td>
                    <td>
                        {{ isset($item->product_meta) && isset($item->product_meta->testings) ? $item->product_meta->testings['hant'] : '' }}
                    </td>
                    <td>
                        {{ isset($item->product_meta) && isset($item->product_meta->testings) ? $item->product_meta->testings['hans'] : '' }}
                    </td>
                    <td>
                        {{ isset($item->product_meta) && isset($item->product_meta->testings) ? $item->product_meta->testings['en'] : '' }}
                    </td>
                    <td>
                        {{ isset($item->product_meta) && isset($item->product_meta->product_details) ? $item->product_meta->product_details['hant'] : '' }}
                    </td>
                    <td>
                        {{ isset($item->product_meta) && isset($item->product_meta->product_details) ? $item->product_meta->product_details['hans'] : '' }}
                    </td>
                    <td>
                        {{ isset($item->product_meta) && isset($item->product_meta->product_details) ? $item->product_meta->product_details['en'] : '' }}
                    </td>
                    <td>
                        {{ isset($item->product_meta) && isset($item->product_meta->awards) ? $item->product_meta->awards['hant'] : '' }}
                    </td>
                    <td>
                        {{ isset($item->product_meta) && isset($item->product_meta->awards) ? $item->product_meta->awards['hans'] : '' }}
                    </td>
                    <td>
                        {{ isset($item->product_meta) && isset($item->product_meta->awards) ? $item->product_meta->awards['en'] : '' }}
                    </td>
                    @php
                        $image        = explode('/', $item->feature_image);
                        $total_counts = count($image);
                    @endphp
                    <td>{{ $image[$total_counts-1] }}</td>
                    <td>{{ $item->status }}</td>
                    <td>{{ $item->is_exclusive_product }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
