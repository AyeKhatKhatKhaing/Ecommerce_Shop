<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Remfly</title>
    {{-- <link rel="shortcut icon" href="{{ $message->embed('frontend/img/favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ $message->embed('frontend/img/favicon.ico') }}" type="image/x-icon"> --}}
</head>

<body>
    <div>
        <div class="remfly-email"
            style="background: linear-gradient(to bottom, #f6f1ebb5 312px, #54301A 312px);padding-top: 3rem;margin: 0 auto;max-width: 640px;">
            <style>
                @import url("https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap");

                body,
                html {
                    font-size: 16px;
                    font-family: 'Montserrat', Verdana, Geneva, Tahoma, sans-serif;
                }

                body>* {
                    font-family: 'Montserrat', Verdana, Geneva, Tahoma, sans-serif;
                }

                .email-button {
                    padding: 12px 36px;
                    background-color: #54301A;
                    text-align: center;
                    font-size: 16px;
                    font-weight: 600;
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
            <div class="email-logo" style="text-align: center;padding-bottom: 36px;padding-top: 36px;">
                <img src="{{ $message->embed('frontend/img/email-logo.png') }}" alt="logo">
            </div>
            <table bgColor="white" width="580px" align="center" valign="middle" border="0"
                style="margin: 0 30px;background-color: white !important;position: relative;border-radius: 25px; margin-bottom: 20px;">
                <tbody>
                    <tr>
                        <td style="text-align: center; padding-top: 50px; padding-bottom: 20px;">
                            <img src="{{ $message->embed('frontend/img/email-order.png') }}" alt="">
                        </td>
                    </tr>
                    <tr>
                        <td
                            style="text-align: center; font-size: 18px; font-weight: 600; color: #54301A; padding-bottom: 36px;">
                            {{ __('frontend.mail.your_purchase') }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 0 36px 20px; font-size: 16px; color: #1E1D1B;">
                            {{ __('frontend.mail.hello') }}, <span style="font-weight: 700;">{{ $data['member']->full_name }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 0 36px 20px; font-size: 16px; font-weight: 600; color: #1E1D1B;"> {{ __('frontend.mail.your_order_number') }} {{ $data['order']->code }} {{ __('frontend.mail.processing_order_number') }}</td>
                    </tr>


                    <tr>
                        <td style="padding: 0 36px 20px;">
                            <a type="button" href="{{ route('front.member.order-detail', $data['order']->code)}}" class="email-button"> {{ __('frontend.mail.check_order_status') }}</a>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 0 36px 48px; font-size: 16px; color: #1E1D1B;">
                            {{ __('frontend.mail.any_question') }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 0 36px; font-size: 16px; color: #1E1D1B;">
                            {{ __('frontend.mail.cheers') }},
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 0 36px 54px; font-size: 16px; font-weight: 700; color: #1E1D1B;">
                            {{ __('frontend.mail.remfly_group') }}
                        </td>
                    </tr>
                </tbody>
            </table>

            <table bgColor="white" width="580px" align="center" valign="middle" border="0"
                style="margin: 0 30px;background-color: white !important;position: relative;border-radius: 25px;">
                <tbody>
                    <tr>
                        <td style="padding: 40px 36px 20px; font-size: 16px; color: #1E1D1B; font-weight: 700;">
                            {{ __('frontend.mail.order_information') }}
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 0 36px; font-size: 16px; color: #1E1D1B;">
                            {{ __('frontend.mail.order_number') }}:
                            <span style="font-weight: 700;">{{ $data['order']->code }}</span>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 0 36px; font-size: 16px; color: #1E1D1B;">
                            {{ __('frontend.mail.date') }}:
                            <span style="font-weight: 700;">{{ date('d/m/Y', strtotime($data['order']->created_date)) }}</span>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 0 36px; font-size: 16px; color: #1E1D1B;">
                            {{ __('frontend.mail.status') }}:
                            <span style="font-weight: 700;">{{ $data['status'] }}</span>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 0 36px; font-size: 16px; color: #1E1D1B;">
                            {{ __('frontend.mail.payment_method') }}:
                            <span style="font-weight: 700;">{{ $data['order']->payment_method == 'recon' ? 'Recon Payment' : '' }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 0 36px; font-size: 16px; color: #1E1D1B;">
                            {{ __('frontend.mail.total_amount') }}:
                            <span style="font-weight: 700;">{{ $data['order']->total_amount ?? '' }}{{ currency() }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 24px 36px 40px;">
                            <div style="max-height: 100px; overflow: auto;">
                                @foreach ($data['order']->order_items as $item)
                                    <div style="display: flex;">
                                        <div>
                                            <img src="{{ asset(isset($item->product_datas) ? $item->product_datas['feature_image'] : '') }}" alt="">
                                        </div>
                                        <div style="padding-left: 16px;">
                                            <p style="padding-bottom: 8px; margin: 0; font-size: 16px; font-weight: 600; color: #1E1D1B;">
                                                {{ isset($item->product_datas) ? $item->product_datas['name_hant'] : '' }}</p>
                                            <p style="padding-bottom: 8px; margin: 0; font-size: 14px; color: #1E1D1B;">
                                                {{ isset($item->product_datas) ? $item->product_datas['currency_type'] : '' }}{{ $item->unit_price }}</p>
                                            <p style="margin: 0; font-size: 14px; color: #1E1D1B;">Quantity: {{ $item->quantity }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div style="background-color: #54301A;max-width: 640px;margin: 0 auto;padding: 48px 0;text-align: center;">
            <table class="emailfooter-table">
                <tbody>
                    <tr>
                        <td style="font-weight: 600; padding: 0 30px 10px; font-size: 18px; color: white; text-align: center;">{{ __('frontend.mail.opening_hour') }}</td>
                    </tr>
                    <tr>
                        <td style=" padding: 0 30px 40px; font-size: 18px; color: white; text-align: center;">
                            <p style="margin: 0;">{{ __('frontend.mail.mon_to_fri') }}</p>
                            <p style="margin: 0;">{{ __('frontend.mail.sat') }}</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight: 600; padding: 0 30px 10px; font-size: 18px; color: white; text-align: center;">{{ __('frontend.mail.tel') }}</td>
                    </tr>
                    <tr>
                        <td style=" padding: 0 30px 40px; font-size: 18px; color: white; text-align: center;">
                            {{ __('frontend.mail.whatsapp') }} +852 54946711.
                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight: 600; padding: 0 30px 10px; font-size: 18px; color: white; text-align: center;">{{ __('frontend.mail.email') }}</td>
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
                                <a href="#" style="margin-right: 25px;"><img src="{{ $message->embed('frontend/img/email-fb.png') }}"
                                        alt="facebook"></a>
                                <a href="#" style="margin-right: 25px;"><img src="{{ $message->embed('frontend/img/email-ig.png') }}"
                                        alt="instagram"></a>
                                <a href="#" style="margin-right: 25px;"><img src="{{ $message->embed('frontend/img/email-whatsapp.png') }}"
                                        alt="whatsapp"></a>
                                <a href="#"><img src="{{ $message->embed('frontend/img/email-twitter.png') }}" alt="twitter"></a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td
                            style="padding: 20px 30px; font-size: 13px; font-weight: 400; color: white; text-align: left;">
                            {{ __('frontend.mail.law') }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>