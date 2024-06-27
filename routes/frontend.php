<?php

use App\Http\Controllers\Frontend\AboutRemflyController;
use App\Http\Controllers\Frontend\Auth\ForgetPasswordController;
use App\Http\Controllers\Frontend\Auth\LoginController;
use App\Http\Controllers\Frontend\Auth\RegisterController;
use App\Http\Controllers\Frontend\Blog\BlogController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\CommonProblemController;
use App\Http\Controllers\Frontend\ContactUs\ContactUsController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\MemberExclusiveOffer\MemberExclusiveOfferController;
use App\Http\Controllers\Frontend\Member\MemberAddressController;
use App\Http\Controllers\Frontend\Member\MemberCartController;
use App\Http\Controllers\Frontend\Member\MemberChangePasswordController;
use App\Http\Controllers\Frontend\Member\MemberCouponController;
use App\Http\Controllers\Frontend\Member\MemberDashboardController;
use App\Http\Controllers\Frontend\Member\MemberInformationController;
use App\Http\Controllers\Frontend\Member\MemberOrderController;
use App\Http\Controllers\Frontend\Member\MemberWishListController;
use App\Http\Controllers\Frontend\PrivacyPolicyController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\StoreDistribution\StoreDistributionController;
use App\Http\Controllers\Frontend\TermConditionController;
use App\Http\Controllers\Frontend\Wishlist\WishlistController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'XssSanitizer']], function () {
    /*
    |--------------------------------------------------------------------------
    | This is the route for RegisterController
    |--------------------------------------------------------------------------
     */
    Route::controller(RegisterController::class)->group(function () {
        Route::get('member-register', 'registerForm')->name('front.register');
        Route::post('member-register', 'register')->name('front.register-post');
        Route::post('get-otp', 'getOTP')->name('front.get-otp');
        Route::post('verify-otp', 'verifyOTP')->name('front.verify-otp');
    });

    /*
    |--------------------------------------------------------------------------
    | This is the route for ForgetPasswordController
    |--------------------------------------------------------------------------
     */
    Route::controller(ForgetPasswordController::class)->group(function () {
        Route::get('forget-password', 'index')->name('front.forget.password');
        Route::post('forget-password', 'forgetPassword')->name('front.forget.password.post');
        Route::get('reset-password/{type}/{token}', 'getResetPassoword')->name('front.reset.password');
        Route::post('reset-password', 'submitResetPasswordForm')->name('front.reset.password.post');
    });

    /*
    |--------------------------------------------------------------------------
    | This is the route for LoginController
    |--------------------------------------------------------------------------
     */
    Route::controller(LoginController::class)->group(function () {
        Route::get('member-login', 'loginForm')->name('front.login');
        Route::get('checkout-member-login', 'checkoutloginForm')->name('front.checkout.login');
        Route::post('member-login', 'login')->name('front.login-post');
        Route::post('member-logout', 'logout')->name('front.logout')->middleware('auth:member');
    });

    /*
    |--------------------------------------------------------------------------
    | This is the route for Member Dashboard
    |--------------------------------------------------------------------------
     */
    Route::group(['prefix' => 'member', 'middleware' => ['auth:member']], function () {

        Route::redirect('/', 'member/dashboard');

        /*
        |--------------------------------------------------------------------------
        | This is the route for MemberDashboardController
        |--------------------------------------------------------------------------
        */
        Route::controller(MemberDashboardController::class)->group(function () {
            Route::get('dashboard', 'memberDashboard')->name('front.member.dashboard');
            Route::get('membership-tier', 'membershipTier')->name('front.member.membership');
        });

        /*
        |--------------------------------------------------------------------------
        | This is the route for MemberInformationController
        |--------------------------------------------------------------------------
        */
        Route::controller(MemberInformationController::class)->group(function () {
            Route::get('information', 'memberInformation')->name('front.member.information');
            Route::post('information', 'updateMemberInformation')->name('front.member.updateinformation');
        });

        /*
        |--------------------------------------------------------------------------
        | This is the route for MemberOrderController
        |--------------------------------------------------------------------------
        */
        Route::get('order', [MemberOrderController::class, 'memberOrder'])->name('front.member.order');
        Route::get('order/{code}/detail', [MemberOrderController::class, 'memberOrderDetail'])->name('front.member.order-detail');

        /*
        |--------------------------------------------------------------------------
        | This is the route for MemberOrderController
        |--------------------------------------------------------------------------
        */
        Route::get('coupon', [MemberCouponController::class, 'memberCoupon'])->name('front.member.coupon');

        /*
        |--------------------------------------------------------------------------
        | This is the route for MemberWishListController
        |--------------------------------------------------------------------------
        */
        Route::get('wishlist', [MemberWishListController::class, 'memberWishList'])->name('front.member.wishlist');

        /*
        |--------------------------------------------------------------------------
        | This is the route for MemberCartController
        |--------------------------------------------------------------------------
        */
        Route::get('cart', [MemberCartController::class, 'memberCart'])->name('front.member.cart');

        /*
        |--------------------------------------------------------------------------
        | This is the route for MemberAddressController
        |--------------------------------------------------------------------------
        */
        Route::controller(MemberAddressController::class)->group(function () {
            Route::get('address', 'memberAddress')->name('front.member.address');
            Route::post('address', 'storeMemberAddress')->name('front.member.store.address');
        });

        /*
        |--------------------------------------------------------------------------
        | This is the route for MemberChangePasswordController
        |--------------------------------------------------------------------------
        */
        Route::controller(MemberChangePasswordController::class)->group(function () {
            Route::get('change-password', 'memberChangePassword')->name('front.member.change.password');
            Route::post('change-password', 'memberUpdatePassword')->name('front.member.update.password');
        });
    });

    /*
    |--------------------------------------------------------------------------
    | This is the route for HomeController
    |--------------------------------------------------------------------------
    */
    Route::controller(HomeController::class)->group(function () {
        Route::get('/', 'index')->name('front.home');
        Route::post('subscrie/newsletter', 'subscribeNewsletter')->name('front.subscribe.newsletter');
    });

    /*
    |--------------------------------------------------------------------------
    | This is the route for AboutRemflyController
    |--------------------------------------------------------------------------
    */
    Route::get('about-remfly', [AboutRemflyController::class, 'aboutRemfly'])->name('front.about-remfly');

    /*
    |--------------------------------------------------------------------------
    | This is the route for ProductController
    |--------------------------------------------------------------------------
    */
    Route::controller(ProductController::class)->group(function () {
        Route::get('product', 'index')->name('front.product');
        Route::get('product/{code}', 'productDetail')->name('front.product.detail');
    });

    /*
    |--------------------------------------------------------------------------
    | This is the route for ContactUsController
    |--------------------------------------------------------------------------
    */
    Route::controller(ContactUsController::class)->group(function () {
        Route::get('contact-us', 'contactPage')->name('front.contact');
        Route::post('contact-us/store', 'storeContactData')->name('front.contact.store');
    });

    /*
    |--------------------------------------------------------------------------
    | This is the route for BlogController
    |--------------------------------------------------------------------------
    */
    Route::controller(BlogController::class)->group(function () {
        Route::get('blog', 'blog')->name('front.blog');
        Route::get('blog/{slug}/detail', 'blogDetail')->name('front.blog.detail');
    });

    /*
    |--------------------------------------------------------------------------
    | This is the route for StoreDistributionController
    |--------------------------------------------------------------------------
    */
    Route::get('store-distribution', [StoreDistributionController::class, 'storeDistribution'])->name('front.store.distribution');

    /*
    |--------------------------------------------------------------------------
    | This is the route for PrivacyPolicyController
    |--------------------------------------------------------------------------
    */
    Route::get('privacy-policy', [PrivacyPolicyController::class, 'privacyPolicy'])->name('front.privacy-policy');

    /*
    |--------------------------------------------------------------------------
    | This is the route for TermConditionController
    |--------------------------------------------------------------------------
    */
    Route::get('term-condition', [TermConditionController::class, 'termCondition'])->name('front.term-condition');

    /*
    |--------------------------------------------------------------------------
    | This is the route for CommonProblemController
    |--------------------------------------------------------------------------
    */
    Route::get('common-problem', [CommonProblemController::class, 'commonProblem'])->name('front.common-problem');

    /*
    |--------------------------------------------------------------------------
    | This is the route for MemberExclusiveOfferController
    |--------------------------------------------------------------------------
    */
    Route::get('member-exclusive-offer', [MemberExclusiveOfferController::class, 'memberExclusiveOffer'])->name('front.member.exclusive.offer');

    /*
    |--------------------------------------------------------------------------
    | This is the route for Cart Controller
    |--------------------------------------------------------------------------
    */
    Route::controller(CartController::class)->group(function () {
        Route::get('cart', 'cart')->name('front.cart');
        Route::post('check-cart', 'checkCart')->name('front.check.cart');
        Route::post('add-cart', 'addCart')->name('front.add.to.cart'); /* will use product detail add to cart */
        Route::post('update-cart', 'updateCart')->name('front.update.to.cart');
        Route::get('get-cart-item', 'getItem')->name('front.get.cart.item');
        Route::delete('remove-cart-item', 'removeCartItem')->name('front.remove.cart.item');
        Route::post('get-coupon-amount', 'getCouponAmount')->name('front.get.coupon.amount');
    });

    /*
    |--------------------------------------------------------------------------
    | This is the route for WishlistController
    |--------------------------------------------------------------------------
    */
    Route::controller(WishlistController::class)->group(function () {
        Route::get('wishlist', 'wishListPage')->name('front.wishlist');
        Route::post('add-wishlist-cart', 'addWishlistCart')->name('front.add.wishlist.to.cart');
        Route::post('get-wishlist', 'addWishList')->name('front.add.wishlist');
        Route::get('get-wishlist-cart-item', 'getWishListItem')->name('front.get.wishlist.cart.item');
        Route::post('add-all-wishlist-item-cart', 'addAllWishListItem')->name('front.add.all.item');
        Route::delete('delete-wishlist-item', 'deleteWishListItem')->name('front.wishlist.item.delete');
        Route::post('clear-wishlist-item', 'clearAllWishListItem')->name('front.clear.wishlist.item');
    });

    /*
    |--------------------------------------------------------------------------
    | This is the route for CheckoutController
    |--------------------------------------------------------------------------
    */
    Route::controller(CheckoutController::class)->group(function () {
        Route::get('checkout', 'checkout')->name('front.checkout');
        Route::post('get-checkout-coupon-amount', 'checkoutCouponAmount')->name('front.get.checkout.coupon.amount');
        Route::post('checkout/order', 'checkoutOrder')->name('front.checkout.order');
        Route::get('checkout/{code}/order-complete', 'checkoutOrderComplete')->name('front.checkout.order.complete');
        Route::get('checkout/payment-unsuccessful', 'checkoutOrderFail')->name('front.checkout.order.fail');
        // Route::post('/notify/{token}', 'notify');
        Route::post('recon-return', 'reconReturn')->name('front.recon.return');
        Route::post('recon-notify', 'reconNotify')->name('front.recon.notify');
    });
});

Route::controller(CheckoutController::class)->group(function () {
    Route::post('/notify/{token}', 'notify');
    Route::get('notify', 'notify')->name('notify');
    Route::post('return/{orderID}', 'return')->name('return');
});
