<?php

namespace App\View\Components\Frontend;

use App\Models\WishList;
use Cookie;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class WishlistCount extends Component
{
    public $count  = 0;
    /**
     * Create a new component instance.
     *
     * @return void
     */
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
            $wishlists = WishList::with('product')->where('member_id', auth()->guard('member')->Id())->get();
        }else {
            $key       = Cookie::get('wishlist');
            $wishlists = WishList::with('product')->where('key', $key)->get();
        }

        if ($wishlists && $wishlists->count() > 0) {
            $wishlists     = $wishlists->where('type', area());
            $this->count   = count($wishlists);
        }

        return view('components.frontend.wishlist-count');
    }
}
