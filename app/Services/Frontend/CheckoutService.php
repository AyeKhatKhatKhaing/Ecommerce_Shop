<?php

namespace App\Services\Frontend;

use App\Helpers\AdminHelper;
use App\Models\CouponHistory;
use App\Models\Member;
use App\Models\MemberAddress;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\SiteSetting;
use DB;
use Illuminate\Support\Facades\Hash;

class CheckoutService
{
    public function saveOrder($request)
    {
        $member              = auth()->guard('member')->user();
        $delivery_type       = $request->delivery_type;
        $is_shipping_address = $request->is_shipping_address ? $request->is_shipping_address : null;
        $order_code          = self::getCode();

        $billing_addresses = [
            'address'        => $request->billing_address,
            'address_detail' => $request->billing_address_detail,
            'first_name'     => $request->billing_first_name,
            'last_name'      => $request->billing_last_name,
            'country_code'   => $request->billing_country_code,
            'phone'          => $request->billing_phone ? AdminHelper::checkPhoneFormat($request->billing_country_code, $request->billing_phone) : null,
            'email'          => $request->billing_email,
        ];

        $shipping_addresses = [
            'address'        => $request->shipping_address,
            'address_detail' => $request->shipping_address_detail,
            'first_name'     => $request->shipping_first_name,
            'last_name'      => $request->shipping_last_name,
            'country_code'   => $request->shipping_country_code,
            'phone'          => $request->shipping_phone ? AdminHelper::checkPhoneFormat($request->shipping_country_code, $request->shipping_phone) : null,
            'email'          => $request->shipping_email,
        ];

        $pickup_datas = [
            'pick_name'      => $request->pick_name,
            'address'        => $request->pick_address,
            'address_detail' => $request->pick_address_detail,
            'first_name'     => $request->pick_first_name,
            'last_name'      => $request->pick_last_name,
            'country_code'   => $request->pick_country_code,
            'phone'          => $request->pick_phone ? AdminHelper::checkPhoneFormat($request->pick_country_code, $request->pick_phone) : null,
            'email'          => $request->pick_email,
        ];

        if (auth()->guard('member')->check()) { /* update member address if have login membership */
            $member_address = $member->member_address ? $member->member_address : null;
            $is_whole_sale  = $member->account_type == 'company' ? 1 : 0;

            if ($member_address) {
                $member_address = $member_address->update([
                    'billing_address'  => $billing_addresses,
                    'shipping_address' => (isset($delivery_type) && $delivery_type == 'delivery' && isset($is_shipping_address)) ? $shipping_addresses : null,
                ]);
            } else {
                $member_address = MemberAddress::create([
                    'member_id'        => $member->id,
                    'billing_address'  => $billing_addresses,
                    'shipping_address' => (isset($delivery_type) && $delivery_type == 'delivery' && isset($is_shipping_address)) ? $shipping_addresses : null,
                ]);
            }
        } else {
            $is_whole_sale = 0;
            /* if order with guest checkout will create/update member with status-2 unregistered */
            $member_data = self::memberData($request);
            $member      = Member::where('status', '!=', 1)->where('email', $request->billing_email)->orWhere('phone', AdminHelper::checkPhoneFormat($request->billing_country_code, $request->billing_phone))->first();
            if ($member) {
                $member->update($member_data);
            } else {
                $member = Member::create($member_data);
            }
        }
        $billing_addresses['member_code']  = $member->code;

        $coupon_code = ($request->check_coupon_code == 'Select Your Option') ? null : ($request->coupon_his_id ? $request->check_coupon_code : null);
        $store_data  = [
            'member_id'          => $member ? $member->id : null,
            'coupon_id'          => $request->coupon_id ? $request->coupon_id : null,
            'coupon_history_id'  => $request->coupon_his_id ? $request->coupon_his_id : null,
            'code'               => $order_code,
            'location'           => area(),
            'delivery_type'      => $request->delivery_type,
            'payment_method'     => $request->payment,
            // 'payment_type'       => $request->payment,
            'coupon_code'        => $coupon_code,
            'total_quantity'     => $request->total_quantity ? $request->total_quantity : 0,
            'coupon_amount'      => $request->coupon_amount ? $request->coupon_amount : 0,
            'shipping_amount'    => $request->shipping_amount ? $request->shipping_amount : 0,
            'total_amount'       => $request->update_check_sub_total ? $request->update_check_sub_total : $request->original_total_amount,
            'lang_key'           => lngKey(),
            'notes'              => $request->note ? $request->note : '',
            'payment_status'     => 0,
            'order_status'       => 0,
            'delivery_status'    => 0,
            'pickup_datas'       => isset($delivery_type) && $delivery_type == 'store_pick_up' ? $pickup_datas : null,
            'billing_addresses'  => isset($delivery_type) && $delivery_type == 'delivery' ? $billing_addresses : null,
            'shipping_addresses' => isset($delivery_type) && $delivery_type == 'delivery' && isset($is_shipping_address) ? $shipping_addresses : null,
            'is_whole_sale'      => $is_whole_sale,
            'is_email'           => 0,
            'created_date'       => now(),
            'created_by'         => $member ? $member->id : null,
            'updated_by'         => $member ? $member->id : null,
        ];

        $order = Order::create($store_data);

        return $order;
    }

    public function updateOrderPrice($order)
    {
        $order              = Order::with('order_items')->find($order->id);
        $total_amount       = 0;
        $hk_change_amount   = 0;
        $item_sub_total     = $order->order_items->sum('sub_total');
        $total_amount       = ($item_sub_total + $order->shipping_amount) - $order->coupon_amount;

        if (area() == 'ma') {
            $site_setting = SiteSetting::where('type', 'currency')->first();
            if ($site_setting && isset($site_setting->options['ma_rate'])) {
                $hk_change_amount = ($total_amount * $site_setting->options['ma_rate']);
            } else {
                $hk_change_amount = ($total_amount * 1.03); /* this is default ma currency rate */
            }
        }

        $order->update([
            'total_amount'      => round($total_amount, 2),
            'hk_change_amount'  => $hk_change_amount,
            'currency_rate'     => isset($site_setting) && isset($site_setting->options['ma_rate']) ? $site_setting->options['ma_rate'] : 1.03,
        ]);

        return $order;
    }

    public function getCode()
    {
        $number     = DB::table('orders')->whereDate('created_date', now())->count();
        $order_code = area() . date('ymd') . str_pad(++$number, 3, 0, STR_PAD_LEFT);

        return $order_code;
    }

    public function createOrderItem($order, $cart_items)
    {
        foreach ($cart_items as $cart_item) {
            $product_datas = [
                'name_en'            => $cart_item->product->name_en,
                'name_hant'          => $cart_item->product->name_hant,
                'name_hans'          => $cart_item->product->name_hans,
                'code'               => $cart_item->product->code,
                'type'               => $cart_item->product->type,
                'sku'                => $cart_item->product->code,
                'currency_type'      => $cart_item->product->currency_type,
                'original_price'     => $cart_item->product->original_price,
                'sale_price'         => $cart_item->product->sale_price,
                'quantity'           => $cart_item->product->quantity,
                'sell_quantity'      => $cart_item->product->sell_quantity,
                'refill_quantity'    => $cart_item->product->refill_quantity,
                'min_stock_quantity' => $cart_item->product->min_stock_quantity,
                'feature_image'      => $cart_item->product->feature_image,
            ];

            $store_data = [
                // 'order_id'      => $order->id,
                'product_id'    => $cart_item->product->id,
                'quantity'      => $cart_item->quantity,
                'unit_price'    => $cart_item->amount,
                'sub_total'     => $cart_item->sub_total,
                'product_datas' => $product_datas,
            ];

            $order->order_items()->create($store_data);
        }

        return $order;
    }

    public function generateReconPaymentUrl($order = null)
    {
        $secret     = config('recon.secret_key');
        $mer_code   = config('recon.mer_code');
        $recon_url  = config('recon.recon_url');
        $return_url = config('recon.return_url');
        $notify_url = config('recon.notify_url');
        $timeout    = config('recon.timeout');

        $total_amount = $order->location == 'hk' ? $order->total_amount : $order->hk_change_amount;

        $total_amount = round($total_amount, 2);

        $order_code  = $order ? $order->code : rand(1000, 100000); /* need to remove rand condition if order completed code done */
        $amount      = $order ? ($total_amount) * 100 : '100'; /* later need to calculate based on area hk/ma */
        $currency    = 'HKD';
        $description = "Remfly Order";
        $lang        = 'en';

        $based = "amt=" . $amount . "&curr=" . $currency . "&desc=" . $description . "&lang=" . $lang . "&merCode=" . $mer_code . "&merRef=" . $order_code . "&notifyUrl=" . $notify_url . "&returnUrl=" . $return_url . "&timeout=" . $timeout . "&ver=1&" . $secret;
        $sign  = hash('sha256', $based);
        $url   = $recon_url . "?amt=" . $amount . "&curr=" . $currency . "&desc=" . $description . "&lang=" . $lang . "&merCode=" . $mer_code . "&merRef=" . $order_code . "&notifyUrl=" . $notify_url . "&returnUrl=" . $return_url . "&sign=" . $sign . "&signType=SHA-256&timeout=" . $timeout . "&ver=1";

        return $url;
    }

    public function updateCouponData($order)
    {
        if (isset($order->coupon_history_id)) {
            $coupon_history = CouponHistory::with('coupon')->where('id', $order->coupon_history_id)->first();

            $per_user    = $coupon_history->coupon ? $coupon_history->coupon->per_user : 0;
            $usage_count = $coupon_history->usage_count + 1;
            $status      = 1;
            if ($per_user == $usage_count) {
                $status = 0;
            }
            $coupon_history->update(['status' => $status, 'usage_count' => $usage_count]);
            $coupon_history->coupon->increment('per_coupon_usage');
        }

        return true;
    }

    public function updateMemberTier($order)
    {
        $member = Member::with('member_type')->findOrFail(auth()->guard('member')->Id());

        $current_tier = $member->member_type;

        $type = $current_tier ? strtolower($current_tier->name_en) : '';

        if ($type == 'silver') {
            $member_tier = DB::table('member_types')->whereIn('name_en', ['Gold', 'gold'])->first();
        } elseif ($type == 'gold' || $type == 'platinum') {
            $member_tier = DB::table('member_types')->whereIn('name_en', ['Platinum', 'platinum'])->first();
        }

        $member->increment('purchased_amount', $order->total_amount);

        if (isset($member_tier) && ($member->purchased_amount >= $member_tier->min_purchase_amount)) {
            $coupon = DB::table('coupons')->where('member_type_id', $member_tier->id)->first();
            if ($coupon) {
                $coupon_history = DB::table('coupon_histories')->where('member_id', $member->id)->where('coupon_id', $coupon->id)->first();
                if (!$coupon_history) {
                    CouponHistory::create([
                        'member_id'    => $member->id,
                        'coupon_id'    => $coupon->id,
                        'usage_count'  => 0,
                        'start_date'   => $coupon->start_date,
                        'expiry_date'  => $coupon->expiry_date,
                        'created_date' => now(),
                    ]);
                }
            }

            $member->update(['member_type_id' => $member_tier->id]);
        }

        return true;
    }

    public function memberData($request)
    {
        return [
            'code'           => AdminHelper::getMemberCode(),
            'member_type_id' => 1,
            'first_name'     => $request->billing_first_name,
            'last_name'      => $request->billing_last_name,
            'email'          => $request->billing_email,
            'password'       => Hash::make('123456'),
            'status'         => 2,
        ];
    }

    public function updateProductQuantity($order)
    {
        $order_items = $order ? $order->order_items : '';

        foreach ($order_items as $item) {
            $product     = $item->product;

            $product->update([
                'quantity'         => $product->quantity - $item->quantity,
                'sell_quantity'    => $product->sell_quantity - $item->quantity,
                'ordered_quantity' => ($product->ordered_quantity ? $item->product->ordered_quantity : 0) + $item->quantity,
                'ordered_count'    => ($product->ordered_count ? $item->product->ordered_count : 0) + 1,
            ]);

            /* when member bought all products */
            if ($product->sell_quantity == $item->quantity || $product->sell_quantity == 0 || $product->sell_quantity == $product->min_stock_quantity) {
                $product->update(['product_status' => 0]);
            }
        }

        return true;
    }
}
