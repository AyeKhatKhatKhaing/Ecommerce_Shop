<?php

namespace App\View\Components\Frontend;

use App\Models\Cart;
use Cookie;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class CartCount extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $count = 0;

    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        if (Auth::guard('member')->check()) {
            $cart = Cart::with('cart_items')->where('member_id', auth()->guard('member')->Id())->first();
        } else {
            $key  = Cookie::get('cart');
            $cart = Cart::with('cart_items')->where('key', $key)->first();
        }

        if ($cart && $cart->cart_items->count() > 0) {
            $this->count = $cart->cart_items->where('type', area())->sum('quantity');
        }

        return view('components.frontend.cart-count');
    }
}
