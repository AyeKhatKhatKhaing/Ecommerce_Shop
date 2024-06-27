<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Report Export</title>
</head>

<body>
    <table class="table" border="1" cellspacing="0">
        <tr>
            <td colspan="8" style="text-align: center; background-color: #fbff00;">
                以每日下晝3點為截單時間    
            </td>
        </tr>
        <tr>
            <td colspan="8" style="text-align: center; height: 50px; font-size: 15px; font-weight: 400; background-color: #D3D3D3; top: 0;">
                私人客    
            </td>
        </tr>
        <thead>
            <tr>
                <th style="font-weight: bold;">發票編號</th>
                <th style="font-weight: bold;">日期</th>
                <th style="font-weight: bold;">客戶編號</th>
                <th style="font-weight: bold;">客戶中文名稱</th>
                <th style="font-weight: bold;">貨品簡稱</th>
                <th style="font-weight: bold;">數量</th>
                <th style="font-weight: bold;">單價</th>
                <th style="font-weight: bold;">總銷售額</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $item)
                @foreach ($item->order_items as $order_item)
                <div>
                    @if ($loop->first)
                        <tr>
                            <td>{{ $item->code }}</td>
                            <td>{{ date('d/m/Y', strtotime($item->created_date)) }}</td>
                            <td>{{ isset($item->billing_addresses) && isset($item->billing_addresses['member_code']) ? $item->billing_addresses['member_code'] : ''  }}</td>
                            <td>
                                {{ isset($item->billing_addresses) && isset($item->billing_addresses['first_name']) || isset($item->billing_addresses['last_name']) ? $item->billing_addresses['first_name'].' '.$item->billing_addresses['last_name'] : ''  }}
                            </td>
                            <td>
                                {{ isset($order_item) && isset($order_item->product_datas) && isset($order_item->product_datas['name_hant']) ? $order_item->product_datas['name_hant'] : '' }}
                            </td>
                            <td>
                                {{ $order_item->quantity }}
                            </td>
                            <td>
                                {{ $order_item->unit_price }}
                            </td>
                            <td>
                                {{ $order_item->sub_total }}
                            </td>
                        </tr>
                    @endif
                    @if (!$loop->first)
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                {{ isset($order_item) && isset($order_item->product_datas) && isset($order_item->product_datas['name_hant']) ? $order_item->product_datas['name_hant'] : '' }}
                            </td>
                            <td>
                                {{ $order_item->quantity }}
                            </td>
                            <td>
                                {{ $order_item->unit_price }}
                            </td>
                            <td>
                                {{ $order_item->sub_total }}
                            </td>
                        </tr>
                    @endif
                @endforeach
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>{{ $item->total_quantity }}</td>
                    <td></td>
                    <td>{{ $item->total_amount }}</td>
                </tr>
            </div>
            @endforeach
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td style="text-align: center;">總數</td>
                <td>{{ $orders->sum('total_quantity') }}</td>
                <td></td>
                <td>{{ $orders->sum('total_amount') }}</td>
            </tr>
        </tbody>
    </table>
</body>

</html>
