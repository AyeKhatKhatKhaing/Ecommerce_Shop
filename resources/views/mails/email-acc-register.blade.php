<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Remfly</title>
    <link rel="shortcut icon" href="{{ asset('frontend/img/favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('frontend/img/favicon.ico') }}" type="image/x-icon">
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
                style="margin: 0 30px;background-color: white !important;position: relative;border-radius: 25px;">
                <tbody>
                    <tr>
                        <td style="text-align: center; padding-top: 50px; padding-bottom: 20px;">
                            <img src="{{ $message->embed('frontend/img/email-register.png') }}" alt="">
                        </td>
                    </tr>
                    <tr>
                        <td
                            style="text-align: center; font-size: 18px; font-weight: 600; color: #54301A; padding-bottom: 36px;">
                            {{ __('frontend.mail.successfully_account') }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 0 36px 20px; font-size: 16px; color: #1E1D1B;">
                            {{ __('frontend.mail.hello') }}, <span style="font-weight: 700;">{{ $member->full_name ?? '' }}</span>
                        </td>
                    </tr>
                    <tr>
                        @php
                        $created_date = Carbon\Carbon::parse($member->created_at)->format('d M Y, H:i');
                        @endphp
                        <td style="padding: 0 36px 20px; font-size: 16px; font-weight: 600; color: #1E1D1B;">{{ __('frontend.mail.welcome_to') }}
                            <span style="color: #54301A;">{{ __('frontend.mail.remfly') }}!</span> {{ __('frontend.mail.successfully_account_at') }} {{ $created_date}}</td>
                    </tr>


                    <tr>
                        <td style="padding: 0 36px 20px;">
                            <a type="button" href="{{ route('front.home') }}" class="email-button">{{ __('frontend.mail.shop_now') }}</a>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 0 36px 48px; font-size: 16px; color: #1E1D1B;">
                            {{ __('frontend.mail.any_question') }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 0 36px 54px; font-size: 16px; font-weight: 700; color: #1E1D1B;">
                            {{ __('frontend.mail.remfly_group') }}
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
                        <td style=" padding: 0 30px 40px;">
                            <p style="margin: 0; font-size: 18px; color: white; text-align: center;">{{ __('frontend.mail.mon_to_fri') }}</p>
                            <p style="margin: 0; font-size: 18px; color: white; text-align: center;">{{ __('frontend.mail.sat') }}</p>
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