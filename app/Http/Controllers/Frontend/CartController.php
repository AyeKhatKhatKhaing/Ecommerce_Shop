<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Member;
use App\Models\Page;
use App\Services\Frontend\CartService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Session;

class CartController extends Controller
{
    public $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function cart()
    {
        $cart_items     = $this->cartService->getCartItem();
        $member_coupons = Member::getMemberCoupon();
        $total_amounts  = $this->cartService->totalAmount($cart_items);
        $page           = Page::where('page_type', 'cart')->first();

        return view('frontend.cart.cart', compact('cart_items', 'member_coupons', 'total_amounts', 'page'));
    }

    public function checkCart(Request $request)
    {
        $quantity   = $this->cartService->checkCart($request);

        $cart_items = $this->cartService->getCartItem();

        $html       = view('frontend.home._cart_item', compact('cart_items'))->render();

        $response   = [
            'status'           => true,
            'quantity'         => $quantity,
            'total_quantity'   => $this->cartService->totalQuantity($cart_items),
            'total_item_label' => "(" . $this->cartService->totalItem($cart_items) . " Total items)",
            'total_amount'     => currency() . number_format($this->cartService->totalAmount($cart_items), 2),
            'html'             => $html,
        ];

        return response()->json($response, 200);
    }

    public function addCart(Request $request)
    {
        $product_id  = $request->product_id;

        $cart_item   = $this->cartService->addCart($request);

        $cart_items  = $this->cartService->getCartItem();

        $detail_item = $this->cartService->getProductDetailItem($product_id); /* product detail page mobile cart item */

        $html        = view('frontend.home._cart_item', compact('cart_items'))->render();

        $detail_html = view('frontend.product.product_detail._detail_cart_item', compact('detail_item'))->render(); /* product detail page mobile cart item */

        $response    = [
            'status'           => true,
            'quantity'         => $cart_item->quantity,
            'total_quantity'   => $this->cartService->totalQuantity($cart_items),
            'total_item_label' => "(" . $this->cartService->totalItem($cart_items) . " Total items)",
            'total_amount'     => currency() . number_format($this->cartService->totalAmount($cart_items), 2),
            'html'             => $html,
            'detail_quantity'  => "(" . $detail_item->quantity . " Total items)",         /* product detail page mobile cart item */
            'detail_total'     => currency() . number_format($detail_item->sub_total, 2),
            'detail_html'      => $detail_html,
        ];

        return response()->json($response, 200);
    }

    public function updateCart(Request $request)
    {
        $quantity   = $this->cartService->updateCart($request);

        $cart_items = $this->cartService->getCartItem();

        $html       = view('frontend.home._cart_item', compact('cart_items'))->render();

        $response   = [
            'status'           => true,
            'quantity'         => $quantity,
            'total_quantity'   => $this->cartService->totalQuantity($cart_items),
            'total_item_label' => "(" . $this->cartService->totalItem($cart_items) . " Total items)",
            'total_amount'     => currency() . number_format($this->cartService->totalAmount($cart_items), 2),
            'html'             => $html,
        ];

        return response()->json($response, 200);
    }

    public function removeCartItem(Request $request)
    {
        $status     = $this->cartService->removeCartItem(strip_tags($request->item_id));

        $cart_items = $this->cartService->getCartItem();  /* if not have cart items, completely remove cart */

        if (count($cart_items) == 0) {
            $this->cartService->removeCart();
        }

        return response()->json(['status' => $status], 200);
    }

    public function getItem()
    {
        // sleep(1);
        $cart_items  = $this->cartService->getCartItem();
        $is_disabled = true;

        if (isset($cart_items) && count($cart_items) > 0) {
            $is_disabled = false;
        }

        $html     = view('frontend.home._cart_item', compact('cart_items'))->render();

        $response = [
            'status'           => true,
            'total_quantity'   => $this->cartService->totalQuantity($cart_items),
            'total_item_label' => "(" . $this->cartService->totalItem($cart_items) . " Total items)",
            'total_amount'     => currency() . number_format($this->cartService->totalAmount($cart_items), 2),
            'html'             => $html,
            'is_disabled'      => $is_disabled,
        ];

        return response()->json($response, 200);
    }

    public function getCouponAmount(Request $request)
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

        $get_coupon_data     = Coupon::where('code', $coupon_code)->first();

        if ($no_coupon == 'true') {
            $coupon_id           = '';
            $coupon_his_id       = '';
            $coupon_code         = '';
            $update_total_amount = $original_sub_total;

            Session::forget(['coupon_id', 'coupon_his_id', 'coupon_code', 'total_amount', 'coupon_amount']);
        } else {
            if ($get_coupon_data->expiry_date > $today_date && $get_coupon_data->start_date < $today_date || empty($get_coupon_data->expiry_date)) {

                if ($get_coupon_data->discount_type == 'amount') {
                    $coupon_amount       = $get_coupon_data->amount;
                    $update_total_amount = round($original_sub_total - $coupon_amount, 2);
                }
    
                if ($get_coupon_data->discount_type == 'percentage') {
                    $percentage          = 100;
                    $coupon_amount       = $original_sub_total * ($get_coupon_data->percent / $percentage);
                    $update_total_amount = round($original_sub_total - $coupon_amount, 2);
                }
                $message .= "<p class='montserrat rem-text-14 text-[#1AAD19] pb-5 pt-1'>Coupon Applied.</p>";
                $status   = true;
            } else {
                $message .= "<p class='montserrat rem-text-14 text-remred pb-5 pt-1'>Coupon Expired.</p>";
                $status   = false;
            }

            Session::put([
                'coupon_id'     => $coupon_id,
                'coupon_his_id' => $coupon_his_id,
                'coupon_code'   => $coupon_code,
                'total_amount'  => $update_total_amount ? $update_total_amount : $original_sub_total,
                'coupon_amount' => $coupon_amount,
            ]);
        }

        return response()->json([
            'update_total_amount' => $update_total_amount ? $update_total_amount : $original_sub_total,
            'coupon_amount'       => $coupon_amount,
            'message'             => $message,
            'status'              => $status
        ]);
    }
}
