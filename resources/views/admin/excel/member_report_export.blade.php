<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Report Export</title>
</head>

<body>
    <table class="table" border="1" cellspacing="0">
        <thead>
            <tr>
                <th style="font-weight: bold;">#</th>
                <th style="font-weight: bold;">電子郵件</th>
                <th style="font-weight: bold;">姓名</th>
                <th style="font-weight: bold;">地址</th>
                <th style="font-weight: bold;">接觸</th>
                <th style="font-weight: bold;">公司名稱</th>
                <th style="font-weight: bold;">產業</th>
                <th style="font-weight: bold;">網站</th>
                <th style="font-weight: bold;">零售批發</th>
                <th style="font-weight: bold;">客戶等級</th>
            </tr>
        </thead>
        <tbody>
            @foreach($members as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->getFullName() }}</td>
                    <td>
                        {{ isset($item->member_address) && $item->member_address['billing_address'] ? $item->member_address['billing_address']['address'].', '.$item->member_address['billing_address']['address_detail'] : '' }}
                    </td>
                    <td>{{ $item->phone }}</td>
                    <td>{{ $item->company_name ? $item->company_name : '' }}</td>
                    <td>{{ $item->business_type ? $item->business_type : '' }}</td>
                    <td>{{ $item->company_website ? $item->company_website : '' }}</td>
                    <td>
                        @if ($item->account_type == 'individual')
                            Retail
                        @else
                            WholeSale
                        @endif
                    </td>
                    <td>{{ isset($item->member_type) ? $item->member_type->name_hant : '' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
