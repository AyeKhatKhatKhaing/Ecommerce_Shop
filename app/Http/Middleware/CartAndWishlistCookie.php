<?php

namespace App\Http\Middleware;

use Closure;
use Cookie;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CartAndWishlistCookie
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $id = Str::uuid();

        if (is_null(Cookie::get('cart'))) {
            Cookie::queue('cart', $id, 43800); // 1- month cookie minutes

            \Log::info("cart-id => $id");
        }

        if (is_null(Cookie::get('wishlist'))) {
            Cookie::queue('wishlist', $id, 43800); // 1- month cookie minutes

            \Log::info("wishlist-id => $id");
        }

        return $next($request);
    }
}
