<?php

namespace App\Listeners;

use App\Events\MemberLoggedIn;
use App\Models\Cart;
use Illuminate\Support\Facades\Cookie;

class UpdateCart
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\MemberLoggedIn  $event
     * @return void
     */
    public function handle(MemberLoggedIn $event)
    {
        $member = $event->member;

        $key = Cookie::get('cart');

        Cart::where('member_id', $member->id)->where('key', '!=', $key)->delete(); // delete member cart after expired cookie

        $cart = Cart::with('cart_items')->where('key', $key)->first();

        if ($cart && $cart->cart_items->count() > 0) {
            $cart->update(['member_id' => $member->id]);
            $cart->cart_items()->update(['is_auth' => true]);
        }

    }
}
