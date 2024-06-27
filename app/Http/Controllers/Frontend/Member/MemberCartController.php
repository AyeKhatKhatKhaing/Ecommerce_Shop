<?php

namespace App\Http\Controllers\Frontend\Member;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Services\Frontend\CartService;
use Illuminate\Support\Facades\Auth;

class MemberCartController extends Controller
{
    protected $cartService;
    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }
    public function memberCart()
    {

        $member     = Auth::guard('member')->user();
        $cart       = Cart::with('cart_items.product')->where('member_id', $member->id)->first();
        $cart_items = $cart->cart_items ?? null;
        // dd($cart, $cart_items->toArray());

        return view('frontend.member.cart.index', compact('cart_items'));
    }
}
