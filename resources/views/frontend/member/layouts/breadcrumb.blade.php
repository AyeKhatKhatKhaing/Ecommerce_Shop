<div class="border-b border-b-remlinear">
    <div class="rem-breadcrumb py-10 flex items-center flex-wrap md:flex-nowrap container200">

        <a href="./" class="text-remdark montserrat flex items-center ">
            {{ __('frontend.member.home') }}
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                <path d="M10 17.5L15 12.5L10 7.5" stroke="black" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
        </a>

        <a href="./" class="text-remdark montserrat flex items-center ">
            {{ __('frontend.member.my_account') }}
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                <path d="M10 17.5L15 12.5L10 7.5" stroke="black" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
        </a>

        @if (Route::currentRouteName() == 'front.member.dashboard')
            <a href="" class="text-remdark montserrat flex items-center active">
                {{ __('frontend.member.dashboard') }}
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                    <path d="M10 17.5L15 12.5L10 7.5" stroke="black" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </a>
        @endif

        @if (Route::currentRouteName() == 'front.member.information')
            <a href="" class="text-remdark montserrat flex items-center active">
                {{ __('frontend.member.personal_information') }}
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                    <path d="M10 17.5L15 12.5L10 7.5" stroke="black" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </a>
        @endif

        @if (Route::currentRouteName() == 'front.member.order')
            <a href="" class="text-remdark montserrat flex items-center active">
                {{ __('frontend.member.my_order') }}
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                    <path d="M10 17.5L15 12.5L10 7.5" stroke="black" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </a>
        @endif

        @if (Route::currentRouteName() == 'front.member.coupon')
            <a href="." class="text-remdark montserrat flex items-center active">
                {{ __('frontend.member.my_coupon') }}
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                    <path d="M10 17.5L15 12.5L10 7.5" stroke="black" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </a>
        @endif

        @if (Route::currentRouteName() == 'front.member.wishlist')
            <a href="" class="text-remdark montserrat flex items-center active">
                {{ __('frontend.member.my_wishlist') }}
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                    <path d="M10 17.5L15 12.5L10 7.5" stroke="black" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </a>
        @endif

        @if (Route::currentRouteName() == 'front.member.cart')
            <a href="" class="text-remdark montserrat flex items-center active">
                {{ __('frontend.member.my_cart') }}
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                    <path d="M10 17.5L15 12.5L10 7.5" stroke="black" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </a>
        @endif

        @if (Route::currentRouteName() == 'front.member.address')
            <a href="." class="text-remdark montserrat flex items-center active">
                {{ __('frontend.member.my_address') }}
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                    <path d="M10 17.5L15 12.5L10 7.5" stroke="black" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </a>
        @endif

        @if (Route::currentRouteName() == 'front.member.change.password')
            <a href="." class="text-remdark montserrat flex items-center active">
                {{ __('frontend.member.change_password') }}
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                    <path d="M10 17.5L15 12.5L10 7.5" stroke="black" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </a>
        @endif

    </div>
</div>