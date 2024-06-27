<?php

namespace App\Http\Controllers\Frontend;

use DB;
use App\Events\OrderEmailCreatedEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\CheckoutFormRequest;
use App\Models\Coupon;
use App\Models\Member;
use App\Models\Order;
use App\Models\Page;
use App\Models\Product;
use App\Models\Shipping;
use App\Models\SiteSetting;
use App\Models\StorePickup;
use App\Services\Frontend\CartService;
use App\Services\Frontend\CheckoutService;
use App\Traits\CheckoutTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Session;
use PDF;
class CheckoutController extends Controller
{
    public $cartService;
    public $checkoutService;

    use CheckoutTrait;

    public function __construct(CartService $cartService, CheckoutService $checkoutService)
    {
        $this->cartService     = $cartService;
        $this->checkoutService = $checkoutService;
    }

    public function checkout()
    {
        $cart_items         = $this->cartService->getCartItem();
        $page               = Page::where('page_type', 'checkout')->first();
        $cross_sell_product = Product::active()->sort()->isNotOther()->where('type', area())->where('is_cross_sell', true)->get();
        $offer_products     = Product::sort()->isNotOther()->where('type', area())->join('offer_promotions', function ($join){
            $join->on('offer_promotions.id', '=', 'products.offer_promotion_id');
        })
        ->where('products.status', true)
        ->selectRaw('products.*, (offer_promotions.start_date) as start_date, (offer_promotions.end_date) as end_date')->get(); 

        if (isset($offer_products) && count($offer_products) > 0) {
            $start_date         = $offer_products->min('start_date');
            $end_date           = $offer_products->max('end_date');
        }

        if (!$cart_items) {
            return redirect()->route('front.home');
        }

        $cart_items     = $this->cartService->getCartItem();
        $total_amounts  = $this->cartService->totalAmount($cart_items); /* item total amounts */
        $store_pickups  = StorePickup::where('type', area())->where('status', true)->get();
        $member         = auth('member')->check() ? auth()->guard('member')->user() : null;
        $shipping_fee   = $this->getShippingFee($total_amounts);
        $member_coupons = Member::getMemberCoupon();

        $overall_amount = $total_amounts + $shipping_fee; /* get total amounts including shipping charges */

        $coupon_id           = Session::get('coupon_id'); /* used in cart page */
        $coupon_his_id       = Session::get('coupon_his_id'); /* used in cart page */
        $coupon_code         = Session::get('coupon_code'); /* used in cart page */
        $coupon_amount       = Session::get('coupon_amount'); /* used in cart page */
        $coupon_total_amount = Session::get('total_amount'); /* used in cart page */

        $original_total_amount = $overall_amount;
        $total_quantity        = $cart_items ? $cart_items->sum('quantity') : null;

        if ($coupon_total_amount) {
            $overall_amount = $coupon_total_amount + $shipping_fee; /* get total amounts if used coupon */
        }

        $data = [
            'coupon_id'             => $coupon_id,
            'coupon_his_id'         => $coupon_his_id,
            'cart_items'            => $cart_items,
            'cross_sell_product'    => $cross_sell_product,
            'total_amounts'         => $total_amounts,
            'store_pickups'         => $store_pickups,
            'member'                => $member,
            'shipping_fee'          => $shipping_fee,
            'member_coupons'        => $member_coupons,
            'coupon_code'           => $coupon_code,
            'coupon_amount'         => $coupon_amount,
            'coupon_total_amount'   => $coupon_total_amount,
            'overall_amount'        => $overall_amount,
            'original_total_amount' => $original_total_amount,
            'offer_products'        => $offer_products,
            'start_date'            => $start_date ?? null,
            'end_date'              => $end_date ?? null,
            'total_quantity'        => $total_quantity,
            'page'                  => $page,
        ];

        return view('frontend.checkout.checkout', $data);
    }

    public function getShippingFee($total_amount)
    {
        $shipping = Shipping::where('country_type', area())->where('status', true)->first();

        return isset($shipping) ? $total_amount > $shipping->free_shipping_amount ? 0 : $shipping->amount : null;
    }

    public function checkoutCouponAmount(Request $request)
    {
        $coupon_id           = $request->coupon_id;
        $coupon_his_id       = $request->coupon_his_id;
        $coupon_code         = $request->coupon_code;
        $original_sub_total  = $request->original_sub_total;
        $today_date          = Carbon::now();
        $update_total_amount = 0;
        $coupon_amount       = 0;
        $message             = '';
        $status              = false;
        $no_coupon           = $request->no_coupon;

        Session::forget(['coupon_id', 'coupon_his_id', 'coupon_code', 'total_amount', 'coupon_amount']);

        $coupon = Coupon::where('code', $coupon_code)->first();
        if ($no_coupon == 'true') {
            $coupon_id           = '';
            $coupon_his_id       = '';
            $coupon_code         = '';
            $update_total_amount = $original_sub_total;
        } else {
            if (($coupon->expiry_date > $today_date && $coupon->start_date < $today_date) || empty($coupon->expiry_date)) {
                if ($coupon->discount_type == 'amount') {
                    $coupon_amount       = $coupon->amount;
                    $update_total_amount = round($original_sub_total - $coupon_amount, 2);
                }

                if ($coupon->discount_type == 'percentage') {
                    $percentage          = 100;
                    $coupon_amount       = $original_sub_total * ($coupon->percent / $percentage);
                    $update_total_amount = round($original_sub_total - $coupon_amount, 2);
                }
                $message .= "<p class='montserrat rem-text-14 text-[#1AAD19] px-5 pt-1'>Coupon Applied.</p>";
                $status   = true;
            } else {
                $message .= "<p class='montserrat rem-text-14 text-remred px-5 pt-1'>Coupon Expired.</p>";
                $status   = false;
            }
        }
    
        return response()->json([
            'coupon_id'           => $coupon_id,
            'coupon_his_id'       => $coupon_his_id,
            'update_total_amount' => $update_total_amount ? $update_total_amount : $original_sub_total,
            'coupon_amount'       => $coupon_amount,
            'message'             => $message,
            'status'              => $status,
        ]);
    }

    public function checkoutOrder(CheckoutFormRequest $request)
    {
        $cart_items = $this->cartService->getCartItem();

        if (!$cart_items) {
            return redirect()->route('front.home');
        }

        $order       = $this->checkoutService->saveOrder($request); /* save order data */

        $order_items = $this->checkoutService->createOrderItem($order, $cart_items); /* save order data */

        /* delete current order cart items */
        $this->cartService->removeCartItems($cart_items);

        $order = $this->checkoutService->updateOrderPrice($order);

        $this->checkoutService->updateProductQuantity($order);/* update product quantity */

        session()->put('order_id', $order->id);

        if (app()->environment(['production', 'development'])) {
            $url = $this->checkoutService->generateReconPaymentUrl($order);

            if ($url) {
                return view('frontend.checkout.recon', ['url' => $url])->render();
            }
        }

        return redirect()->route('front.checkout.order.complete', ['code' => $order->code]);
    }

    public function checkoutOrderComplete($code)
    {
        $order        = Order::with('order_items', 'member')->where('code', $code)->first();

        /* start email pdf preview code */
        // $member = $order->member ?? null;
        // $pdf = PDF::loadView('mails.order-email-attachment',
        // [
        //     'order' => $order,
        //     'member' => $member
        // ]
        // )->setPaper('a4');

        // return $pdf->stream('Order-' . $order->code . '.pdf');
        // dd('here');
        // OrderEmailCreatedEvent::dispatch($order);

        /* end email pdf preview code */

        if(session()->has('order_id')) {
            /* update coupon data */
            $this->checkoutService->updateCouponData($order);

            /* update member tier */
            if(auth()->guard('member')->check()) {
                $this->checkoutService->updateMemberTier($order);
            }

            if (app()->environment(['local', 'Local'])) {
                OrderEmailCreatedEvent::dispatch($order);
            }
        }

        Session::forget(['coupon_id', 'coupon_his_id', 'coupon_code', 'total_amount', 'coupon_amount', 'order_id']);

        return view('frontend.checkout.order_complete', ['order' => $order]);
    }

    public function checkoutOrderFail()
    {
        return view('frontend.checkout.payment_unsuccessful');
    }

}
