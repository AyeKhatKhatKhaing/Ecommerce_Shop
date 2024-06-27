<?php

use App\Http\Controllers\Admin\AboutRemflyController;
use App\Http\Controllers\Admin\ActivityLogsController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\BusinessTypeController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ClassificationController;
use App\Http\Controllers\Admin\CommonProblemController;
use App\Http\Controllers\Admin\ContactAddressController;
use App\Http\Controllers\Admin\ContactFormSubmissionController;
use App\Http\Controllers\Admin\ContactPageController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\MemberCountryController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ExclusiveOfferController;
use App\Http\Controllers\Admin\FileManagerController;
use App\Http\Controllers\Admin\FooterController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\MemberExclusiveOfferController;
use App\Http\Controllers\Admin\MemberReportController;
use App\Http\Controllers\Admin\MemberTypeController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\OfferPromotionController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\OrderReportController;
use App\Http\Controllers\Admin\OtherProductController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PermissionsController;
use App\Http\Controllers\Admin\PrivacyPolicyController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductLabelController;
use App\Http\Controllers\Admin\ProductReportController;
use App\Http\Controllers\Admin\PromotionController;
use App\Http\Controllers\Admin\RegionController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\ShippingController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\StoreController;
use App\Http\Controllers\Admin\StoreDistributionController;
use App\Http\Controllers\Admin\StorePickupController;
use App\Http\Controllers\Admin\SubscribeNotificationController;
use App\Http\Controllers\Admin\SubscriptionController;
use App\Http\Controllers\Admin\TermConditionController;
use App\Http\Controllers\Admin\UsersController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'middleware' => ['web', 'auth']], function () {
    Route::get('generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@getGenerator']);
    Route::post('generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@postGenerator']);
});

Route::group(['prefix' => 'admin', 'middleware' => ['web', 'auth']], function () {
    // Route::redirect('/', 'admin/dashboard');
    Route::get('/', function () {
        if (auth()->user()->email == 'laramaster@visibleone.com') {
            return redirect('admin/dashboard');
        } else if (auth()->user()->hasRole('Editor') || auth()->user()->hasRole(strtolower('editor')) || auth()->user()->hasRole(strtoupper('editor'))) {
            return redirect('admin/home');
        } else {
            return redirect('admin/member');
        }
    });

    Route::controller(DashboardController::class)->group(function () {
        Route::get('dashboard', 'index')->name('admin.dashboard');
        Route::get('get-product-list', 'getProductList')->name('admin.get.product.list');
        Route::get('get-product-quantity-list', 'getProductQuantityList')->name('admin.get.product.quantity.list');
        Route::post('update-quantity', 'updateQuantity')->name('admin.update.quantity');
    });

    /*
    |--------------------------------------------------------------------------
    | This is the route for Resource
    |--------------------------------------------------------------------------
     */
    Route::resources([
        'blog'              => BlogController::class,
        'blog-category'     => BlogCategoryController::class,
        'business-types'    => BusinessTypeController::class,
        'category'          => CategoryController::class,
        'classification'    => ClassificationController::class,
        'contact-address'   => ContactAddressController::class,
        'countries'         => CountryController::class,
        'member-country'    => MemberCountryController::class,
        'coupon'            => CouponController::class,
        'exclusive-offer'   => ExclusiveOfferController::class,
        'member'            => MemberController::class,
        'member-type'       => MemberTypeController::class,
        'menu'              => MenuController::class,
        'offer-promotion'   => OfferPromotionController::class,
        'page'              => PageController::class,
        'permissions'       => PermissionsController::class,
        'product'           => ProductController::class,
        'other-product'     => OtherProductController::class,
        'product-attribute' => AttributeController::class,
        'product-label'     => ProductLabelController::class,
        'promotion'         => PromotionController::class,
        'regions'           => RegionController::class,
        'roles'             => RolesController::class,
        'settings'          => SettingsController::class,
        'shipping'          => ShippingController::class,
        'slider'            => SliderController::class,
        'store'             => StoreController::class,
        'store-pickups'     => StorePickupController::class,
        'users'             => UsersController::class,
    ]);

    /*
    |--------------------------------------------------------------------------
    | This is the route for ActivityLogsController
    |--------------------------------------------------------------------------
     */
    Route::controller(ActivityLogsController::class)->group(function () {
        Route::get('activitylogs', 'index')->name('activitylogs.index');
        Route::get('/activitylogs/{id}', 'show')->name('activitylogs.show');
        Route::delete('/activitylogs/{id}', 'delete')->name('activitylogs.delete');
    });

    Route::controller(SiteSettingController::class)->group(function () {
        Route::get('site-setting', 'index');
        Route::post('site-setting', 'update');
    });

    /*
    |--------------------------------------------------------------------------
    | This is the route for HomeController
    |--------------------------------------------------------------------------
     */
    Route::controller(HomeController::class)->group(function () {
        Route::get('home', 'index');
        Route::post('home', 'update');
        Route::post('get-brand-logo', 'getBrandLogo')->name('get-brand-logo');
    });

    /*
    |--------------------------------------------------------------------------
    | This is the route for AboutRemflyController
    |--------------------------------------------------------------------------
     */
    Route::controller(AboutRemflyController::class)->group(function () {
        Route::get('about-remfly', 'index');
        Route::post('about-remfly', 'update');
    });

    /*
    |--------------------------------------------------------------------------
    | This is the route for ContactPageController
    |--------------------------------------------------------------------------
     */
    Route::controller(ContactPageController::class)->group(function () {
        Route::get('contact-page', 'index');
        Route::post('contact-page', 'update');
    });

    /*
    |--------------------------------------------------------------------------
    | This is the route for MemberExclusiveOfferController
    |--------------------------------------------------------------------------
     */
    Route::controller(MemberExclusiveOfferController::class)->group(function () {
        Route::get('member-exclusive-offer', 'index');
        Route::post('member-exclusive-offer', 'update');
    });

    /*
    |--------------------------------------------------------------------------
    | This is the route for CommonProblemController
    |--------------------------------------------------------------------------
     */
    Route::controller(CommonProblemController::class)->group(function () {
        Route::get('common-problem', 'index');
        Route::post('common-problem', 'update');
    });

    /*
    |--------------------------------------------------------------------------
    | This is the route for PrivacyPolicyController
    |--------------------------------------------------------------------------
     */
    Route::controller(PrivacyPolicyController::class)->group(function () {
        Route::get('privacy-policy', 'index');
        Route::post('privacy-policy', 'update');
    });

    /*
    |--------------------------------------------------------------------------
    | This is the route for TermConditionController
    |--------------------------------------------------------------------------
     */
    Route::controller(TermConditionController::class)->group(function () {
        Route::get('term-condition', 'index');
        Route::post('term-condition', 'update');
    });

    /*
    |--------------------------------------------------------------------------
    | This is the route for FooterController
    |--------------------------------------------------------------------------
     */
    Route::get('footer', [FooterController::Class, 'index']);
    Route::post('footer', [FooterController::Class, 'update']);

    /*
    |--------------------------------------------------------------------------
    | This is the route for SubscribeNotificationController
    |--------------------------------------------------------------------------
     */
    Route::controller(SubscribeNotificationController::class)->group(function () {
        Route::get('subscribe-notification', 'index');
        Route::post('subscribe-notification', 'update');
    });

    /*
    |--------------------------------------------------------------------------
    | This is the route for StoreDistributionController
    |--------------------------------------------------------------------------
     */
    Route::controller(StoreDistributionController::class)->group(function () {
        Route::get('store-distribution', 'index');
        Route::post('store-distribution', 'update');
    });

    /*
    |--------------------------------------------------------------------------
    | This is the route for SubscriptionController
    |--------------------------------------------------------------------------
     */
    Route::get('subscription', [SubscriptionController::class, 'index']);

    /*
    |--------------------------------------------------------------------------
    | This is the route for OrderController
    |--------------------------------------------------------------------------
     */
    Route::controller(OrderController::class)->group(function () {
        Route::get('order', 'index')->name('admin.order.index');
        Route::get('order/{order_id}', 'show')->name('admin.order.show');
        Route::put('order-status/update', [OrderController::class, 'orderStatusUpdate'])->name('admin.order.status.update');
        Route::get('order/send-status-mail/{order_id}', 'sendStatusMail')->name('admin.send.status.mail');
    });

    /*
    |--------------------------------------------------------------------------
    | This is the route for FileManagerController
    |--------------------------------------------------------------------------
     */
    Route::get('filemanager', [FileManagerController::class, 'filemanager']);

    /*
    |--------------------------------------------------------------------------
    | This is the route for MemberController
    |--------------------------------------------------------------------------
     */
    Route::controller(MemberController::class)->group(function () {
        Route::post('member/status-change', 'statusChange');
        Route::post('member-import-excel', 'importExcel')->name('admin.member.import.excel');
        Route::get('member-sample-excel', 'generateSample')->name('admin.member.sample.excel');
    });

    /*
    |--------------------------------------------------------------------------
    | This is the route for ProductController
    |--------------------------------------------------------------------------
     */
    Route::controller(ProductController::class)->group(function () {
        Route::post('product/status-change', 'statusChange');
        Route::post('product/get-attribute', 'getAttribute')->name('admin.product.get.attribute');
        Route::post('product/get-region-list', 'getRegionList')->name('admin.product.get.region.list');
        Route::post('product-import-excel', 'importExcel')->name('admin.product.import.excel');
        Route::get('product-sample-excel', 'generateSample')->name('admin.product.sample.excel');
        Route::post('updateproductSort', 'updateproductSort')->name('admin.updateproductSort');
    });

    /*
    |--------------------------------------------------------------------------
    | This is the route for OtherProductController
    |--------------------------------------------------------------------------
    */
    Route::controller(OtherProductController::class)->group(function () {
        Route::post('other-product/status-change', 'statusChange');
        Route::post('other-product/get-attribute', 'getAttribute')->name('admin.other.product.get.attribute');
        Route::post('other-product/get-region-list', 'getRegionList')->name('admin.other.product.get.region.list');
        Route::post('other-product/update-sorting', 'updateSorting')->name('admin.other.product.update.sorting');
    });

    /*
    |--------------------------------------------------------------------------
    | This is the route for ContactFormSubmissionController
    |--------------------------------------------------------------------------
     */
    Route::get('contact-form-submission', [ContactFormSubmissionController::class, 'index']);

    /*
    |--------------------------------------------------------------------------
    | This is the route for ProductReportController
    |--------------------------------------------------------------------------
     */
    Route::get('product-report', [ProductReportController::class, 'index']);

    /*
    |--------------------------------------------------------------------------
    | This is the route for OrderReportController
    |--------------------------------------------------------------------------
     */
    Route::get('order-report', [OrderReportController::class, 'index']);

    /*
    |--------------------------------------------------------------------------
    | This is the route for MemberReportController
    |--------------------------------------------------------------------------
     */
    Route::get('member-report', [MemberReportController::class, 'index']);

    /*
    |--------------------------------------------------------------------------
    | This is the route for MemberTypeController
    |--------------------------------------------------------------------------
     */
    Route::post('member-type/status-change', [MemberTypeController::class, 'statusChange']);

    /*
    |--------------------------------------------------------------------------
    | This is the route for ProductLabelController
    |--------------------------------------------------------------------------
     */
    Route::post('product-label/status-change', [ProductLabelController::class, 'statusChange']);

    /*
    |--------------------------------------------------------------------------
    | This is the route for PromotionController
    |--------------------------------------------------------------------------
     */
    Route::post('promotion/status-change', [PromotionController::class, 'statusChange']);

    /*
    |--------------------------------------------------------------------------
    | This is the route for OfferPromotionController
    |--------------------------------------------------------------------------
     */
    Route::post('offer-promotion/status-change', [OfferPromotionController::class, 'statusChange']);

    /*
    |--------------------------------------------------------------------------
    | This is the route for CountryController
    |--------------------------------------------------------------------------
     */
    Route::post('countries/status-change', [CountryController::class, 'statusChange']);

    /*
    |--------------------------------------------------------------------------
    | This is the route for MemberConutryController
    |--------------------------------------------------------------------------
     */
    Route::post('member-country/status-change', [MemberCountryController::class, 'statusChange']);

    /*
    |--------------------------------------------------------------------------
    | This is the route for RegionController
    |--------------------------------------------------------------------------
     */
    Route::post('regions/status-change', [RegionController::class, 'statusChange']);

    /*
    |--------------------------------------------------------------------------
    | This is the route for ClassificationController
    |--------------------------------------------------------------------------
     */
    Route::post('classification/status-change', [ClassificationController::class, 'statusChange']);

    /*
    |--------------------------------------------------------------------------
    | This is the route for BlogCategoryController
    |--------------------------------------------------------------------------
     */
    Route::post('blog/status-change', [BlogController::class, 'statusChange']);

    /*
    |--------------------------------------------------------------------------
    | This is the route for BlogCategoryController
    |--------------------------------------------------------------------------
     */
    Route::post('coupon/status-change', [CouponController::class, 'statusChange']);

    /*
    |--------------------------------------------------------------------------
    | This is the route for BlogCategoryController
    |--------------------------------------------------------------------------
     */
    Route::post('blog-category/status-change', [BlogCategoryController::class, 'statusChange']);

    /*
    |--------------------------------------------------------------------------
    | This is the route for AttributeController
    |--------------------------------------------------------------------------
     */
    Route::post('product-attribute/status-change', [AttributeController::class, 'statusChange']);

    /*
    |--------------------------------------------------------------------------
    | This is the route for CategoryController
    |--------------------------------------------------------------------------
     */
    Route::post('category/status-change', [CategoryController::class, 'statusChange']);

    /*
    | This is the route for StorePickUpController
    |--------------------------------------------------------------------------
     */
    Route::post('store-pickups/status-change', [StorePickupController::class, 'statusChange']);

    /*
    |--------------------------------------------------------------------------
    | This is the route for ShippingController
    |--------------------------------------------------------------------------
     */
    Route::post('shipping/status-change', [ShippingController::class, 'statusChange']);

    /*
    |--------------------------------------------------------------------------
    | This is the route for BusinessTypeController
    |--------------------------------------------------------------------------
     */
    Route::post('business-types/status-change', [BusinessTypeController::class, 'statusChange']);

    /*
    |--------------------------------------------------------------------------
    | This is the route for StoreController
    |--------------------------------------------------------------------------
     */
    Route::post('store/status-change', [StoreController::class, 'statusChange']);

    /*
    |--------------------------------------------------------------------------
    | This is the route for PageController
    |--------------------------------------------------------------------------
     */
    Route::post('page/status-change', [PageController::class, 'statusChange']);

    /*
    |--------------------------------------------------------------------------
    | This is the route for ContactAddressController
    |--------------------------------------------------------------------------
     */
    Route::post('contact-address/status-change', [ContactAddressController::class, 'statusChange']);

    /*
    |--------------------------------------------------------------------------
    | This is the route for ExclusiveOfferController
    |--------------------------------------------------------------------------
     */
    Route::post('exclusive-offer/status-change', [ExclusiveOfferController::class, 'statusChange']);

    /*
    |--------------------------------------------------------------------------
    | This is the route for MenuController
    |--------------------------------------------------------------------------
     */
    Route::post('menu/status-change', [MenuController::class, 'statusChange']);

     /*
    |--------------------------------------------------------------------------
    | This is the route for SliderController
    |--------------------------------------------------------------------------
     */
    Route::post('slider/status-change', [SliderController::class, 'statusChange']);

});
