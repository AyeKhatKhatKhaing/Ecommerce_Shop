<?php

namespace App\Http\Controllers\Frontend\Member;

use App\Http\Controllers\Controller;
use App\Services\Frontend\WishListService;
use Illuminate\Http\Request;

class MemberWishListController extends Controller
{
    public $wishListService;

    public function __construct(WishListService $wishListService)
    {
        $this->wishListService = $wishListService;
    }

    public function memberWishList()
    {
        $wishlists = $this->wishListService->getWishListCollection();
        return view('frontend.member.wishlist.index', compact('wishlists'));
    }
}
