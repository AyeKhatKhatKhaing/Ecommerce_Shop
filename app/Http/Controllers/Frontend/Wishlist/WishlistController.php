<?php

namespace App\Http\Controllers\Frontend\Wishlist;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Services\Frontend\WishListService;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public $wishListService;

    public function __construct(WishListService $wishListService)
    {
        $this->wishListService = $wishListService;
    }

    public function wishListPage()
    {
        $wishlists = $this->wishListService->getWishListCollection();
        $page      = Page::where('page_type', 'wishlist')->first();

        return view('frontend.wishlist.index', compact('wishlists', 'page'));
    }

    public function addWishList(Request $request) /* add to wishlists */
    {
        $wishlist    = $this->wishListService->addWishListData($request);
        $wishlists   = $this->wishListService->getWishListData();
        if (isset($wishlists)) {
            $quantity = $wishlists->count();
        }

        return response()->json(['success' => true, 'quantity' => $quantity]);
    }

    public function addWishListCart(Request $request) /* wishlists add to cart */
    {
        $cart_item    = $this->wishListService->addWishlistCart($request);

        $cart_items   = $this->wishListService->getWishListCartItem();

        $html         = view('frontend.home._cart_item', compact('cart_items'))->render();

        $response     = [
            'status'           => true,
            'quantity'         => $cart_item['cart_item']['quantity'],
            'out_of_stock'     => $cart_item['out_of_stock'],
            'total_quantity'   => $this->wishListService->totalQuantity($cart_items),
            'total_item_label' => "(" . $this->wishListService->totalItem($cart_items) . " Total items)",
            'total_amount'     => currency() . number_format($this->wishListService->totalAmount($cart_items), 2),
            'html'             => $html,
        ];

        return response()->json($response, 200);
    }

    public function getWishListItem() /* header cart icon hover */
    {
        $cart_items      = $this->wishListService->getWishListCartItem();

        $is_disabled     = true;

        if (isset($cart_items) && count($cart_items) > 0) {
            $is_disabled = false;
        }

        $html       = view('frontend.home._cart_item', compact('cart_items'))->render();

        $response   = [
            'status'           => true,
            'total_quantity'   => $this->wishListService->totalQuantity($cart_items),
            'total_item_label' => "(" . $this->wishListService->totalItem($cart_items) . " Total items)",
            'total_amount'     => currency() . number_format($this->wishListService->totalAmount($cart_items), 2),
            'html'             => $html,
            'is_disabled'      => $is_disabled
        ];

        return response()->json($response, 200);
    }

    public function addAllWishListItem(Request $request) /* add all wishlists items to cart */
    {
        $wishlists  = $this->wishListService->getAddWishListData();
        
        $cart       = $this->wishListService->getCart();

        $cart_item  = $this->wishListService->addAllWishItemToCart($wishlists, $cart, $request);

        if (isset($cart_item)){
            $cart->update(['quantity' => $cart_item->sum('quantity'), 'total_amount' => $cart_item->sum('sub_total')]);
        }

        return redirect()->back();
    }

    public function deleteWishListItem(Request $request)
    {
        $wishlists  = $this->wishListService->getWishListData();

        $wishlist   = $wishlists->where('id', $request->wishlist_id)->first();
        
        if (isset($wishlist)) {
            $wishlist->delete();
        }
        
        return redirect()->back();
    }

    public function clearAllWishListItem()
    {
        $wishlists  = $this->wishListService->getWishListData();

        foreach ($wishlists as $wishlist) {
            $wishlist->delete();
        }

        return response()->json(['success' => true]);
    }
}
