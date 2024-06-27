<?php

namespace App\Traits;

use App\Events\OrderEmailCreatedEvent;
use App\Models\Order;
use Illuminate\Http\Request;

trait CheckoutTrait
{
    public function reconReturn(Request $request)
    {
        $input = $request->all();

        $state      = (int) $input['state'];
        $order_code = $input['merRef'];

        $order = Order::where('code', $order_code)->first();

        if ($order) {
            session()->put('order_id', $order->id);

            $order->order_options()->create([
                'name'   => 'recon-return',
                'values' => $input,
            ]);

            if ($state == 1) { // state - 1 payment response success status
                $order->update([
                    'payment_status' => Order::PAYMENT_SUCCESS,
                    'payment_type' => $input['payType'],
                    'is_email'     => 1,
                ]);

                OrderEmailCreatedEvent::dispatch($order); /* send order email */

                return redirect()->route('front.checkout.order.complete', ['code' => $order->code]);

            } else {
                $order->update([
                    'payment_status' => Order::PAYMENT_PENDING,
                ]);
            }
        }

        return redirect()->route('front.checkout.order.fail');
    }

    public function reconNotify(Request $request)
    {
        $input = $request->all();

        $order_code = $input['merRef'];

        $order = Order::where('code', $order_code)->first();

        if ($order) {
            $order->order_options()->create([
                'name'   => 'recon-notify',
                'values' => $input,
            ]);

            $order->update([
                'payment_status' => Order::PAYMENT_PENDING,
            ]);
        }

        return redirect()->route('front.checkout.order.fail');

    }
}
