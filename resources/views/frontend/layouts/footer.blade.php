@php
    $site_setting = \App\Models\SiteSetting::where('type', 'basic')->first();
    $law_name     = lngKey()."_law";

    $footer = \App\Models\Footer::first();

@endphp
<div component-name="remfly-footer" class="relative rem-footer">
    <img src="{{ asset('frontend/img/footer-bg.png') }}" alt="footer image" class="object-cover footer-bgimage w-full">
    <div class="absolute top-5 md:top-12 px-5 md:px-10 lg:px-[72px] w-full bgyellow-container">
        <div
            class="bg-lighteryellow/80 px-5 md:px-10 xl:px-20 5xl:pl-[128px] 5xl:pr-100 xl:flex xl:items-start rounded-xl pt-5 md:pt-10 lg:pt-100 pb-12 xl:gap-16 3xl:gap-20 6xl:gap-[150px]">
            <div class="pb-9 xl:pb-0 xl:pr-0 3xl:flex-[0_1_40%] 3xl:max-w-[40%]">
                <p class="rem-text-36 montserrat-medium text-remlightdark pb-6 lg:pb-20 text-center md:text-left">{{ __('frontend.footer.get_update_stay_connect') }}</p>
                <div class="flex items-center justify-between pb-4 border-b border-b-remdark">
                    <input type="text" id="newsletter_email" name="email" placeholder="{{ __('frontend.footer.your_email_address') }}"
                        class="bg-transparent rem-text-18 montserrat w-full">
                    <button type="button" class="adminSubsctibeForm montserrat-bold text-remdark join-btn" style="width:50px">{{ __('frontend.footer.join') }}</button>
                </div>
                <span class="adminSubscribeMessage"></span>
                <div class="pt-12 flex flex-wrap items-center xl:gap-[20px] justify-center xl:justify-start">

                    <a href="#" class="mr-5 xl:mr-0 last-of-type:mr-0">
                        <img src="{{ asset('frontend/img/ig.svg') }}" alt="social icon">
                    </a>

                    <a href="#" class="mr-5 xl:mr-0 last-of-type:mr-0">
                        <img src="{{ asset('frontend/img/fb-black.svg') }}" alt="social icon">
                    </a>

                </div>
            </div>

            <div class="3xl:flex-[0_1_60%] 3xl:max-w-[60%]">
                {!! isset($footer) && isset($footer->web_contents) ? $footer->web_contents[lngKey()] : '' !!}

                {!! isset($footer) && isset($footer->mobile_contents) ? $footer->mobile_contents[lngKey()] : '' !!}

                <div class="pt-4 md:flex md:items-center md:justify-end xl:gap-[20px]">
                    <p class="font-bold rem-text-16 text-remdark pb-3 md:pb-0 md:pr-4 xl:pr-0">{{ __('frontend.footer.we_accept') }}</p>
                    <div class="flex items-center xl:gap-[9px] flex-wrap">
                        <img src="{{ asset('frontend/img/visa-payment.svg') }}" alt="visa payment" class="mb-1 md:mb-0 mr-1 xl:mr-0">
                        <img src="{{ asset('frontend/img/master-payment.svg') }}" alt="master payment" class="mb-1 md:mb-0 mr-1 xl:mr-0">
                        <img src="{{ asset('frontend/img/union-payment.svg') }}" alt="master payment" class="mb-1 md:mb-0 mr-1 xl:mr-0">
                        <img src="{{ asset('frontend/img/wechat-payment.svg') }}" alt="wechat payment" class="mb-1 md:mb-0 mr-1 xl:mr-0">
                        <img src="{{ asset('frontend/img/wechat-paymentfill.svg') }}" alt="wechat payment" class="mb-1 md:mb-0 mr-1 xl:mr-0">
                        <img src="{{ asset('frontend/img/hk-payment.svg') }}" alt="hk payment" class="mb-1 md:mb-0 mr-1 xl:mr-0">
                        <img src="{{ asset('frontend/img/hk-payment2.svg') }}" alt="hk payment" class="mb-1 md:mb-0">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div
        class="lg:flex lg:items-center lg:justify-between absolute bottom-7 lg:bottom-9 pt-60 px-5 lg:px-10 lg:px-[120px] footer-copyrights w-full">
        <p class="montserrat-bold rem-text-18 text-whitez w-full pb-5 lg:pb-0 text-center lg:text-left">©{{ __('frontend.footer.copyright') }}</p>
        <div class="flex items-start justify-center lg:justify-end">
            <img src="{{ asset('frontend/img/solar_sledgehammer-bold.svg') }}" alt="solar" class="mr-1">
            <p class="montserrat-medium text-whitez">{{ isset($site_setting) && isset($site_setting->options) ? $site_setting->options[$law_name] : '' }}</p>
        </div>
    </div>
</div>

@if (area() == 'hk')
    <a href="{{ isset($site_setting) && isset($site_setting->options) && isset($site_setting->options['hk_whatsapp']) ? $site_setting->options['hk_whatsapp'] : '' }}" class="fixed bottom-24 right-4 md:right-6 5xl:right-28 hidden md:block">
        <img src="{{ asset('frontend/img/Whatsapp.svg') }}" alt="whatsapp">
    </a>
@else
    <a href="{{ isset($site_setting) && isset($site_setting->options) && isset($site_setting->options['ma_whatsapp']) ? $site_setting->options['ma_whatsapp'] : '' }}" class="fixed bottom-24 right-4 md:right-6 5xl:right-28 hidden md:block">
        <img src="{{ asset('frontend/img/Whatsapp.svg') }}" alt="whatsapp">
    </a>
@endif

@push('scripts')
    <script>
        $('.adminSubsctibeForm').on('click', function (){

            $('.adminSubscribeMessage').addClass('hidden');

            let email   = $('#newsletter_email').val();
            $.ajax({
                url : "/subscrie/newsletter",
                type: 'POST',
                dataType: 'json',
                data: {
                    _token : $('meta[name="csrf-token"]').attr('content'),
                    email : email
                },
                success:function (data) {
                    $('.adminSubscribeMessage').removeClass('hidden');
                    $('.adminSubscribeMessage').html(data.message);
                }
            })
        })
    </script>
@endpush