<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Type Export</title>
</head>

<body>
    <table class="table" border="1" cellspacing="0">
        <thead>
            <tr>
                <th style="font-weight: bold;">#</th>
                <th style="font-weight: bold;">代碼</th>
                <th style="font-weight: bold;">產品名稱</th>
                <th style="font-weight: bold;">優質的</th>
                {{-- <th style="font-weight: bold;">Year</th>
                <th style="font-weight: bold;">Volume</th> --}}
                <th style="font-weight: bold;">庫存總量</th>
                <th style="font-weight: bold;">入庫/出庫</th>
                <th style="font-weight: bold;">產品類別</th>
                <th style="font-weight: bold;">原價</th>
                <th style="font-weight: bold;">打折後價格</th>
                {{-- <th style="font-weight: bold;">Increased Quantity (bottle)</th> --}}
                <th style="font-weight: bold;">產品總價</th>
                <th style="font-weight: bold;">訂單庫存總量</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->code }}</td>
                    <td>{{ $item->name_hant }}</td>
                    <td>
                        @if (isset($item->attributes))
                            @foreach ($item->attributes as $attribute)
                                @if ($attribute->attribute_term_id == 1)
                                    {{ $attribute->name }}
                                @endif
                            @endforeach
                        @endif
                    </td>
                    <td>{{ $item->quantity }}</td>
                    <td>
                        @if ($item->quantity > 0)
                            In Stock
                        @else
                            Out Of Stock
                        @endif
                    </td>
                    <td>
                        @if ($item->type == 'hk')
                            Hong Kong
                        @else
                            Macau
                        @endif
                    </td>
                    <td>{{ $item->original_price }}</td>
                    <td>{{ $item->sale_price }}</td>
                    <td>{{ $item->sale_price != 0 ? round($item->sale_price * $item->quantity, 2) : round($item->original_price * $item->quantity, 2) }}</td>
                    <td>{{ $item->ordered_count ?? 0 }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
