<div class="pt-5 lg:pt-0 lg:pr-5 xl:pr-0 lg:flex-[none] lg:w-[30%]">
    <div component-name="rem-membersidebar" class="member-sidebar relative lg:after:content-[''] lg:after:block lg:after:w-[1px] after:h-[80%] after:absolute after:top-0 lg:after:right-[-.5rem] xl:after:right-[-1.6rem] after:bg-[#E1D8CD]">

        <a href="{{ route('front.member.dashboard') }}" class="flex items-center py-4 border border-remlinear px-5 lg:mb-4 last-of-type:mb-0 xl:gap-[10px] 
    {{ active_class((Active::checkUriPattern('member/dashboard') || Active::checkUriPattern('member/membership-tier')), 'active') }}">
            <span class="mr-2 xl:mr-0 flex-[none] lg:w-[15%]">
                <img src="{{ asset('frontend/img/view-dashboard.svg') }}" alt="member icon">
            </span>
            <span class="montserrat-medium text-rembrown rem-text-16">
                {{ __('frontend.member.dashboard') }}
            </span>
        </a>

        <a href="{{ route('front.member.information') }}" class="flex items-center py-4 border border-remlinear px-5 lg:mb-4 last-of-type:mb-0 xl:gap-[10px]
    {{ active_class((Active::checkUriPattern('member/information')), 'active') }}">
            <span class="mr-2 xl:mr-0 flex-[none] lg:w-[15%]">
                <img src="{{ asset('frontend/img/member-user-profile.svg') }}" alt="member icon">
            </span>
            <span class="montserrat-medium text-rembrown rem-text-16">
                {{ __('frontend.member.personal_information') }}
            </span>
        </a>

        <a href="{{ route('front.member.order') }}" class="flex items-center py-4 border border-remlinear px-5 lg:mb-4 last-of-type:mb-0 xl:gap-[10px] 
    {{ active_class((Active::checkUriPattern('member/order')), 'active') }}">
            <span class="mr-2 xl:mr-0 flex-[none] lg:w-[15%]">
                <img src="{{ asset('frontend/img/member-transaction-order.svg') }}" alt="member icon">
            </span>
            <span class="montserrat-medium text-rembrown rem-text-16">
                {{ __('frontend.member.my_order') }}
            </span>
        </a>

        <a href="{{ route('front.member.coupon') }}" class="flex items-center py-4 border border-remlinear px-5 lg:mb-4 last-of-type:mb-0 xl:gap-[10px] 
    {{ active_class((Active::checkUriPattern('member/coupon')), 'active') }}">
            <span class="mr-2 xl:mr-0 flex-[none] lg:w-[15%]">
                <img src="{{ asset('frontend/img/member-coupon-fill.svg') }}" alt="member icon">
            </span>
            <span class="montserrat-medium text-rembrown rem-text-16">
                {{ __('frontend.member.my_coupon') }}
            </span>
        </a>

        <a href="{{ route('front.member.wishlist') }}" class="flex items-center py-4 border border-remlinear px-5 lg:mb-4 last-of-type:mb-0 xl:gap-[10px] 
    {{ active_class((Active::checkUriPattern('member/wishlist')), 'active') }}">
            <span class="mr-2 xl:mr-0 flex-[none] lg:w-[15%]">
                <img src="{{ asset('frontend/img/member-ph_heart.svg') }}" alt="member icon">
            </span>
            <span class="montserrat-medium text-rembrown rem-text-16">
                {{ __('frontend.member.my_wishlist') }}
            </span>
        </a>

        <a href="{{ route('front.member.cart') }}" class="flex items-center py-4 border border-remlinear px-5 lg:mb-4 last-of-type:mb-0 xl:gap-[10px] 
    {{ active_class((Active::checkUriPattern('member/cart')), 'active') }}">
            <span class="mr-2 xl:mr-0 flex-[none] lg:w-[15%]">
                <img src="{{ asset('frontend/img/member-cart.svg') }}" alt="member icon">
            </span>
            <span class="montserrat-medium text-rembrown rem-text-16">
                {{ __('frontend.member.my_cart') }}
            </span>
        </a>

        <a href="{{ route('front.member.address') }}" class="flex items-center py-4 border border-remlinear px-5 lg:mb-4 last-of-type:mb-0 xl:gap-[10px] 
    {{ active_class((Active::checkUriPattern('member/address')), 'active') }}">
            <span class="mr-2 xl:mr-0 flex-[none] lg:w-[15%]">
                <img src="{{ asset('frontend/img/member-address-card.svg') }}" alt="member icon">
            </span>
            <span class="montserrat-medium text-rembrown rem-text-16">
                {{ __('frontend.member.my_address') }}
            </span>
        </a>

        <a href="{{ route('front.member.change.password') }}" class="flex items-center py-4 border border-remlinear px-5 lg:mb-4 last-of-type:mb-0 xl:gap-[10px] 
    {{ active_class((Active::checkUriPattern('member/change-password')), 'active') }}">
            <span class="mr-2 xl:mr-0 flex-[none] lg:w-[15%]">
                <img src="{{ asset('frontend/img/member-password.svg') }}" alt="member icon">
            </span>
            <span class="montserrat-medium text-rembrown rem-text-16">
                {{ __('frontend.member.change_password') }}
            </span>
        </a>

        <a href="#" class="flex items-center py-4 border border-remlinear px-5 lg:mb-4 last-of-type:mb-0 xl:gap-[10px] 
    {{ active_class((Active::checkUriPattern('member/logout')), 'active') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <span class="mr-2 xl:mr-0 flex-[none] lg:w-[15%]">
                <img src="{{ asset('frontend/img/member-logout.svg') }}" alt="member icon">
            </span>
            <span class="montserrat-medium text-rembrown rem-text-16">
                {{ __('frontend.member.logout') }}
            </span>
        </a>
        <form id="logout-form" action="{{ route('front.logout') }}" method="POST">
            @csrf
        </form>

    </div>
</div>