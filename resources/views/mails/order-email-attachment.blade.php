<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Remfly</title>
    {{-- <link rel="shortcut icon" href="./img/favicon.ico" type="image/x-icon">
    <link rel="icon" href="./img/favicon.ico" type="image/x-icon"> --}}
    <style>
        @font-face {
            font-family: "chinese";
            /* src: url(http://eclecticgeek.com/dompdf/fonts/cjk/fireflysung.ttf) format('truetype'); */
            src: url('{{base_path()."/public/fonts/fireflysung.ttf"}}') format('truetype');
            /* src: url('{{ public_path('fonts/fireflysung.ttf') }}') format('truetype'); */
        }

        .chinese {
            font-family:"chinese" !important;
        }
        /* body,
        html {
            font-size: 16px;
            font-family: 'Montserrat', Verdana, Geneva, Tahoma, sans-serif;
        }

        body>* {
            font-family: 'Montserrat', Verdana, Geneva, Tahoma, sans-serif;
        } */

        .email-button {
            padding: 12px 36px;
            background-color: #54301A;
            text-align: center;
            font-size: 16px;
            color: white;
            border: 1px solid #54301A;
        }

        .email-button:hover {
            background-color: transparent;
            color: #54301A;
        }

        .emailfooter-table {
            width: 100%;
        }

        .emailfooter-table td,
        .emailfooter-table td p {
            font-size: 18px;
            color: white;
            text-align: center;
        }
    </style>
</head>

<body class="chinese">
    <div>
        <div class="remfly-email" style="margin: 0 auto;max-width: 640px;">
            <div class="email-logo"
                style="text-align: center; padding-top: 80px; background-color: #f6f1ebb5; position: relative;">
                <img src="{{ public_path('frontend/img/email-logo.png')}}" alt="logo" style="padding-bottom: 60px;">
                <div
                    style="background-color: white; height: 50px; width: 580px; margin: 0 auto; border-top-left-radius: 20px; border-top-right-radius: 20px;">
                </div>
            </div>
            <div style="background-color: #54301A;">
                <table bgColor="white" width="580px" align="center" valign="middle" border="0"
                    style="margin: 0 30px;background-color: white !important;position: relative;border-bottom-left-radius: 25px; border-bottom-right-radius: 25px; margin-bottom: 20px;">
                    <tbody>
                        <tr>
                            <td style="text-align: center; padding-top: 50px; padding-bottom: 20px;">
                                <img src="{{ public_path('frontend/img/email-order.png')}}" alt="">
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; font-size: 18px;  color: #54301A; padding-bottom: 36px;">
                                <a href="{{ route('front.member.order')}}">
                                    @if ($order->lang_key == 'en')
                                        Thank you for your purchase
                                    @elseif ($order->lang_key == 'hans')
                                        感谢您的购买
                                    @else
                                        感謝您的購買
                                    @endif
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 0 36px 20px; font-size: 16px; color: #1E1D1B;">
                                @if ($order->lang_key == 'en')
                                    Hello
                                @elseif ($order->lang_key == 'hans')
                                    你好
                                @else
                                    你好
                                @endif, <span style="">{{ isset($member) ? $member->full_name : '' }}<</span>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 0 36px 20px; font-size: 16px;  color: #1E1D1B;">
                                @if ($order->lang_key == 'en')
                                    Your order number
                                @elseif ($order->lang_key == 'hans')
                                    您的订单号
                                @else
                                    您的訂單編號
                                @endif  
                                {{ isset($order) ? $order->code : '' }}
                                @if ($order->lang_key == 'en')
                                    is processing. Check your order status below.
                                @elseif ($order->lang_key == 'hans')
                                    正在处理。请在下面检查您的订单状态。   
                                @else
                                    正在處理。請在下面檢查您的訂單狀態。
                                @endif
                            </td>
                        </tr>


                        <tr>
                            <td style="padding: 0 36px 20px;">
                                <a type="button" href="{{ route('front.member.order-detail', isset($order) ? $order->code : '' ) }}" class="email-button">
                                    @if ($order->lang_key == 'en')
                                        Check Order Status
                                    @elseif ($order->lang_key == 'hans')
                                        检查订单状态
                                    @else
                                        檢查訂單狀態
                                    @endif
                                </a>
                            </td>
                        </tr>

                        <tr>
                            <td style="padding: 0 36px 48px; font-size: 16px; color: #1E1D1B;">
                                @if ($order->lang_key == 'en')
                                    If you have any questions, just reply to this email—we're always happy to help out.
                                @elseif ($order->lang_key == 'hans')
                                    如果您有任何疑问，请回复此电子邮件 - 我们随时乐意为您提供帮助。
                                @else
                                    如果您有任何疑問，請回覆此電子郵件 - 我們隨時樂意為您提供協助。
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 0 36px; font-size: 16px; color: #1E1D1B;">
                                @if ($order->lang_key == 'en')
                                    Cheers,
                                @elseif ($order->lang_key == 'hans')
                                    干杯，
                                @else
                                    乾杯，  
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 0 36px 54px; font-size: 16px;  color: #1E1D1B;">
                                @if ($order->lang_key == 'en')
                                    Remfly Group
                                @elseif ($order->lang_key == 'hans')
                                    蓝飞集团
                                @else
                                    藍飛集團 
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>

                <table bgColor="white" width="580px" align="center" valign="middle" border="0"
                    style="margin: 0 30px;background-color: white !important;position: relative;border-radius: 25px;">
                    <tbody>
                        <tr>
                            <td style="padding: 40px 36px 20px; font-size: 16px; color: #1E1D1B; ">
                                @if ($order->lang_key == 'en')
                                    Order Information
                                @elseif ($order->lang_key == 'hans')
                                    订单信息
                                @else
                                    訂單資訊 
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <td style="padding: 0 36px; font-size: 16px; color: #1E1D1B;">
                                @if ($order->lang_key == 'en')
                                    Order Number:
                                @elseif ($order->lang_key == 'hans')
                                    订单号：
                                @else
                                    訂單號碼：
                                @endif
                                <span style="">{{ isset($order) ? $order->code : '' }}</span>
                            </td>
                        </tr>

                        <tr>
                            <td style="padding: 0 36px; font-size: 16px; color: #1E1D1B;">
                                @if ($order->lang_key == 'en')
                                    Date:
                                @elseif ($order->lang_key == 'hans')
                                    日期：
                                @else
                                    日期：
                                @endif
                                <span style="">{{ isset($order) ? date('d/m/Y', strtotime($order->created_date)) : '' }}</span>
                            </td>
                        </tr>

                        <tr>
                            <td style="padding: 0 36px; font-size: 16px; color: #1E1D1B;">
                                @if ($order->lang_key == 'en')
                                    Status:
                                @elseif ($order->lang_key == 'hans')
                                    地位：
                                @else
                                    地位：
                                @endif
                                <span style="">{{ isset($order) && $order->is_email == 1 ? 'Yes' : 'No' }}</span>
                        </tr>
                        <tr>
                            <td style="padding: 0 36px; font-size: 16px; color: #1E1D1B;">
                                @if ($order->lang_key == 'en')
                                    Payment Method:
                                @elseif ($order->lang_key == 'hans')
                                    付款方式：
                                @else
                                    付款方式：
                                @endif
                                <span style="">{{ $order->getPaymentType() }}</span>
                            </td>
                        </tr>
                        <td style="padding: 0 36px; font-size: 16px; color: #1E1D1B;">
                            @if ($order->lang_key == 'en')
                                Total Amount :
                            @elseif ($order->lang_key == 'hans')
                                总金额 ：
                            @else
                                總金額 ：
                            @endif
                            <span style="">
                                {{ $order->getCurrency() }}{{ rm_number_format($order->total_amount) }} 
                                
                                @if ($order->location == 'ma') 
                                    (HK$ {{ $order->hk_change_amount }})
                                @endif
                            </span>
                        </td>
                        <tr>
                            <td style="padding: 24px 36px 40px;">
                                {{-- <div style="max-height: 100px; overflow: auto;"> --}}
                                    @if(!empty($order))
                                        @foreach ($order->order_items as $item)
                                            <div style="display: flex;">
                                                <div>
                                                    <img src="{{ public_path(isset($item->product_datas) ? $item->product_datas['feature_image'] : '') }}" alt="" style="width: 79px; height: 91px;">
                                                </div>
                                                <div style="padding-left: 16px;">
                                                    <p style="padding-bottom: 8px; margin: 0; font-size: 16px;  color: #1E1D1B;">
                                                        {{ isset($item->product_datas) ? $item->product_datas['name_hant'] : '' }}</p>
                                                    <p style="padding-bottom: 8px; margin: 0; font-size: 14px; color: #1E1D1B;">
                                                        {{ isset($item->product_datas) ? $item->product_datas['currency_type'] : '' }}{{ $item->unit_price }}</p>
                                                    <p style="margin: 0; font-size: 14px; color: #1E1D1B;">
                                                        @if ($order->lang_key == 'en')
                                                            Quantity :
                                                        @elseif ($order->lang_key == 'hans')
                                                            数量 ：
                                                        @else
                                                            數量 ：
                                                        @endif {{ $item->quantity }}
                                                    </p>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                {{-- </div> --}}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div style="background-color: #54301A;max-width: 640px;margin: 0 auto;padding: 48px 0;text-align: center;">
            <table class="emailfooter-table">
                <tbody>
                    <tr>
                        <td style=" padding: 0 30px 10px;">
                            @if ($order->lang_key == 'en')
                                Opening Hours
                            @elseif ($order->lang_key == 'hans')
                                营业时间
                            @else
                                營業時間
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td style=" padding: 0 30px 40px;">
                            <p style="margin: 0;">
                                @if ($order->lang_key == 'en')
                                    9:30aam – 6:00pm (Monday to Friday)
                                @elseif ($order->lang_key == 'hans')
                                    上午 9:30 – 下午 6:00（周一至周五）
                                @else
                                    上午 9:30 – 下午 6:00（週一至週五）
                                @endif
                            </p>
                            <p style="margin: 0;">
                                @if ($order->lang_key == 'en')
                                    9:30Aam – 1:00pm (Saturday)
                                @elseif ($order->lang_key == 'hans')
                                    上午 9:30 – 下午 1:00（星期六）
                                @else
                                    上午 9:30 – 下午 1:00（星期六）
                                @endif
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style=" padding: 0 30px 10px;">
                            @if ($order->lang_key == 'en')
                                Tel
                            @elseif ($order->lang_key == 'hans')
                                电话
                            @else
                                電話
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td style=" padding: 0 30px 40px;">
                            @if ($order->lang_key == 'en')
                                Customers can chat with our Customer Care team by WhatsApp us on
                            @elseif ($order->lang_key == 'hans')
                                客户可以通过 WhatsApp us 与我们的客户服务团队聊天
                            @else
                                客戶可以透過 WhatsApp us 與我們的客戶服務團隊聊天
                            @endif +852 54946711.
                        </td>
                    </tr>
                    <tr>
                        <td style=" padding: 0 30px 10px;">
                            @if ($order->lang_key == 'en')
                                Email
                            @elseif ($order->lang_key == 'hans')
                                电子邮件
                            @else
                                電子郵件
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 0 30px 80px;">
                            <a href="mailto:cs@remflyhk.com"
                                style="font-size: 18px; color: white; text-decoration: none;">cs@remflyhk.com</a>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 0 30px;">
                            <div style="padding-bottom: 20px; border-bottom: 1px solid white;">
                                <a href="#" style="margin-right: 25px;"><img src="{{ public_path('frontend/img/email-fb.png') }}"
                                        alt="facebook"></a>
                                <a href="#" style="margin-right: 25px;"><img src="{{ public_path('frontend/img/email-ig.png') }}"
                                        alt="instagram"></a>
                                <a href="#" style="margin-right: 25px;"><img src="{{ public_path('frontend/img/email-whatsapp.png') }}"
                                        alt="whatsapp"></a>
                                <a href="#"><img src="{{ public_path('frontend/img/email-twitter.png') }}" alt="twitter"></a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td
                            style="padding: 20px 30px; font-size: 13px;  color: white; text-align: left;">
                            @if ($order->lang_key == 'en')
                                According to Hong Kong law, it is not allowed to sell or supply intoxicating alcohol to
                                minors in the course of business.
                            @elseif ($order->lang_key == 'hans')
                                根据香港法律，不得在营业过程中向未成年人出售或供应致醉酒类。
                            @else
                                根據香港法律，不得在營業過程中向未成年人出售或供應致醉酒類。
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>