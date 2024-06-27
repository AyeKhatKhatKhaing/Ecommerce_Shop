@if( (auth()->guard('member')->check() && !auth()->guard('member')->user()->subscription) || !auth()->guard('member')->check() )
<div component-name="rem-newsletter-popup">
    <div id="rem-newsletter-popup" class="rem-newsletter-popup-wrapper fixed top-0 left-0 w-full h-full bg-[#000000ba] hidden">
        <div class="rem-newsletter-popup-card absolute bg-white min-w-[300px] max-w-[709px] left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 ">
            <div class="rem-newsletter-popup-content p-[20px] lg:p-[28px] 3xl:p-[48px] ">
                <div class="inner relative border border-[#54301A] py-[30px] lg:py-[50px] 3xl:py-[74px] px-[20px] lg:px-[30px] xl:px-[44px]"> 
                    <div data-url="{{ $url ?? '/' }}" onclick="closenewsletterpopup('rem-newsletter-popup')" class="adminCloseNewLetter close absolute -top-[20px] lg:-top-[25px] -right-[20px] bg-white p-5 rounded-[30px] cursor-pointer">
                        <img src="{{ asset('frontend/img/close-br.svg') }}" alt="close" />
                    </div>
                    <h3 class="title mb-[18px] text-center">{{ $title ?? '' }}</h3>
                    <div class="inner-container text-center">
                        {!! $description ?? '' !!}
                        {{-- <form action="{{ route('front.subscribe.newsletter') }}" id="newletter-form" method="post"> --}}
                            {{-- @csrf --}}
                            <input type="text" placeholder="johnsmithh334@gmail.com" id="header_newsletter_email" name="email"/>
                            <span class="adminSubscribeMessage"></span>
                            <div class="rem-newsletter-popup-btn mt-[22px]">
                                <button type="submit" class="adminHeaderSubsctibeForm subscribe">{{__('frontend.newletter_popup.subscribe_now')}}</button>
                                <button type="button" onclick="closenewsletterpopup('rem-newsletter-popup')" class="adminCloseNewLetter no-thank" data-url="{{ $url ?? '/' }}">{{__('frontend.newletter_popup.thank_you')}}</button>
                            </div>
                        {{-- </form> --}}
                    </div>                    
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@push('scripts')
    <script>
        $('.adminHeaderSubsctibeForm').on('click', function (){

            $('.adminSubscribeMessage').addClass('hidden');

            let email   = $('#header_newsletter_email').val();
            console.log(email);
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