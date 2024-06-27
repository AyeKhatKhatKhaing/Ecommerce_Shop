<?php

namespace App\Http\Controllers\Frontend\Member;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Coupon;

use Illuminate\Support\Facades\Auth;



use Illuminate\Http\Request;

class MemberOrderController extends Controller
{
    public function memberOrder()
    {
        $member       = Auth::guard('member')->user();
        $order        = Order::notTrashed()->with('order_items')->orderBy('id', 'desc')->where('member_id', $member->id)->paginate(10);
        $member_order = $order ? $order : null;

        return view('frontend.member.order.index', compact('member_order'));
    }

    public function memberOrderDetail($code)
    {
        $order           = Order::with('order_items')->where('code', $code)->first();
        $order_item      = $order ? $order->order_items : null;

        return view('frontend.member.order.order_detail', compact('order_item', 'order'));
    }
}
