<!DOCTYPE html>
<html lang="hant">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Remfly</title>
    {{-- <link rel="shortcut icon" href="./img/favicon.ico" type="image/x-icon">
    <link rel="icon" href="./img/favicon.ico" type="image/x-icon"> --}}
    <style>
        /* @import url("https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap"); */
        /* @import url("https://fonts.googleapis.com/css2?family=Noto+Sans+SC:wght@400;500;600;700;800&family=Noto+Sans+TC:wght@400;500;600;700&display=swap"); */

        /* @font-face{
            font-family:"chinese";
            src:url("https://candyfonts.com/wp-data/2021/01/26/120531/wts11.ttf") format("woff"),
            url("https://candyfonts.com/wp-data/2021/01/26/120531/wts11.ttf") format("opentype"),
            url("https://candyfonts.com/wp-data/2021/01/26/120531/wts11.ttf") format("truetype");
        } */
        /* htm_tag{font-family:"hanwang-kaibold-gb5";font-size:45px;text-transform:none;color:#F32951} */

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
        <div class="remfly-email"
            style="background-color: #54301A;padding-top: 3rem;margin: 0 auto;max-width: 640px;">
            <div class="email-logo" style="text-align: center;padding-bottom: 36px;padding-top: 36px;">
                <img src="{{ public_path('frontend/img/email-logo.png')}}" alt="logo">
            </div>
            <table bgColor="white" width="580px" align="center" valign="middle" border="0"
                style="margin: 0 30px;background-color: white !important;position: relative;border-radius: 25px; margin-bottom: 20px;">
                <tbody>
                    <tr>
                        <td style="text-align: center; padding-top: 50px; padding-bottom: 20px;">
                            <img src="{{ public_path('frontend/img/email-order.png')}}" alt="">
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: center; font-size: 18px;  color: #54301A; padding-bottom: 36px;">
                            <a href="{{ route('front.member.order')}}">{{ trans('frontend.mail.your_purchase') }}</a>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 0 36px 20px; font-size: 16px; color: #1E1D1B;">
                            Hello Here, <span style="">{{ isset($member) ? $member->full_name : '' }} , {{ lngKey() }}<</span>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 0 36px 20px; font-size: 16px;  color: #1E1D1B;">您的订单号 {{ isset($order) ? $order->code : '' }} {{ trans('frontend.mail.processing_order_number') }}</td>
                    </tr>


                    <tr>
                        <td style="padding: 0 36px 20px;">
                            <a type="button" href="{{ route('front.member.order-detail', isset($order) ? $order->code : '' ) }}" class="email-button">{{ trans('frontend.mail.check_order_status') }}</a>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 0 36px 48px; font-size: 16px; color: #1E1D1B;">
                            如果您有任何疑问，请回复此电子邮件 - 我们很乐意为您提供帮助。
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 0 36px; font-size: 16px; color: #1E1D1B;">
                            {{ trans('frontend.mail.cheers') }},
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 0 36px 54px; font-size: 16px;  color: #1E1D1B;">
                            {{ trans('frontend.mail.remfly_group') }}
                        </td>
                    </tr>
                </tbody>
            </table>

             <table bgColor="white" width="580px" align="center" valign="middle" border="0"
                style="margin: 0 30px;background-color: white !important;position: relative;border-radius: 25px;">
                <tbody>
                    <tr>
                        <td style="padding: 40px 36px 20px; font-size: 16px; color: #1E1D1B; ">
                            {{ trans('frontend.mail.order_information') }}
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 0 36px; font-size: 16px; color: #1E1D1B;">
                            {{ trans('frontend.mail.order_number') }}:
                            <span style="">{{ isset($order) ? $order->code : '' }}</span>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 0 36px; font-size: 16px; color: #1E1D1B;">
                            {{ trans('frontend.mail.date') }}:
                            <span style="">{{ isset($order) ? date('d/m/Y', strtotime($order->created_date)) : '' }}</span>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 0 36px; font-size: 16px; color: #1E1D1B;">
                            {{ trans('frontend.mail.status') }}:
                            <span style="">{{ isset($order) && $order->is_email == 1 ? 'Yes' : 'No' }}</span>
                    </tr>
                    <tr>
                        <td style="padding: 0 36px; font-size: 16px; color: #1E1D1B;">
                            {{ trans('frontend.mail.payment_method') }}:
                            <span style="">{{ isset($order) ? $order->payment_method == 'recon' ? 'Recon Payment' : '' : '' }}</span>
                        </td>
                    </tr>
                    <td style="padding: 0 36px; font-size: 16px; color: #1E1D1B;">
                        {{ trans('frontend.mail.total_amount') }}:
                        <span style="">{{ isset($order) ? $order->total_amount : '' }}{{ currency() }}</span>
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
                                                <p style="margin: 0; font-size: 14px; color: #1E1D1B;">Quantity: {{ $item->quantity }}</p>
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
        <div style="background-color: #54301A;max-width: 640px;margin: 0 auto;padding: 48px 0;text-align: center;">
            <table class="emailfooter-table">
                <tbody>
                    <tr>
                        <td style=" padding: 0 30px 10px;">{{ trans('frontend.mail.opening_hour') }}</td>
                    </tr>
                    <tr>
                        <td style=" padding: 0 30px 40px;">
                            <p style="margin: 0;">{{ trans('frontend.mail.mon_to_fri') }}</p>
                            <p style="margin: 0;">{{ trans('frontend.mail.sat') }}</p>
                        </td>
                    </tr>
                    <tr>
                        <td style=" padding: 0 30px 10px;">{{ trans('frontend.mail.tel') }}</td>
                    </tr>
                    <tr>
                        <td style=" padding: 0 30px 40px;">
                            {{ trans('frontend.mail.whatsapp') }} +852 54946711.
                        </td>
                    </tr>
                    <tr>
                        <td style=" padding: 0 30px 10px;">{{ trans('frontend.mail.email') }}</td>
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
                            {{ trans('frontend.mail.law') }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>