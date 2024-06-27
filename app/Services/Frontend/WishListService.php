<?php

namespace App\Services\Frontend;

use App\Models\Cart;
use App\Models\WishList;
use Auth;
use Cookie;

class WishListService
{
    public function getAreaType()
    {
        return area();
    }

    public function getWishListKey()
    {
        return Cookie::get('wishlist');
    }

    public function getKey()
    {
        return Cookie::get('cart');
    }

    public function getMember()
    {
        return Auth::guard('member')->user();
    }

    public function isAuth()
    {
        return auth()->guard('member')->check() ? true : false;
    }

    public function getWishListCollection()
    {
        $type  =  self::getAreaType();

        if (Auth::guard('member')->check()) {
            $member                   = self::getMember();
            $wishlists                = WishList::with('product')->where('member_id', $member->id)->where('type', $type)->get();
        }else {
            $wishlists = WishList::with('product')->where('key', $this->getWishListKey())->where('type', $type)->get();
        }

        return $wishlists;
    }

    public function addWishListData($request)
    {
        $product_id = $request->product_id;
        $quantity   = $request->quantity;
        $key        = Cookie::get('wishlist');
        $price      = $request->price;

        $store_data = [
            'product_id' => $product_id,
            'type'       => $this->getAreaType(),
            'quantity'   => $quantity,
            'key'        => $this->getWishListKey(),
            'amount'     => $price,
            'sub_total'  => round($price * $quantity, 2),
        ];

        if (Auth::guard('member')->check()) {
            $member                  = self::getMember();
            $wishlist                = WishList::where('member_id', $member->id)->where('product_id', $product_id)->where('type', $this->getAreaType())->first();
            $store_data['member_id'] = $member->id;
            if (!$wishlist) {
                $wishlist = WishList::create($store_data);
            } else {
                $wishlist->update($store_data);
            }
        } else {
            $wishlist = WishList::where('key', $key)->where('product_id', $product_id)->where('type', $this->getAreaType())->first();

            if (!$wishlist) {
                $wishlist = WishList::create($store_data);
            } else {
                $wishlist->update($store_data);
            }
        }

        return $wishlist ? $wishlist : null;
    }

    public function addWishListCart($request)
    {
        $product_id    = $request->product_id;
        $wishlist_id   = $request->wishlist_id;
        $quantity      = $request->quantity;
        $sell_quantity = $request->sell_quantity;
        $data          = [];

        $item_data     = self::getItemData($request); /* cart item store data */

        $cart          = self::getCart(); /* get/arrange cookie and member cart */

        $cart_item     = $cart->cart_items->where('product_id', $product_id)->first();


        $wishlist_item = self::updateWishListItem($wishlist_id, $quantity);

        $data['out_of_stock']  = false;

        if (!$cart_item) {
            $cart_item = $cart->cart_items()->create($item_data);
        } else {
            $item_data['quantity']  = $cart_item->quantity + $item_data['quantity'];
            $item_data['sub_total'] = $item_data['amount'] * $item_data['quantity'];
            if ($item_data['quantity'] <= $sell_quantity) {
                $cart_item->update($item_data);
            } else {
                $data['out_of_stock']  = true;
            }
        }

        $data['cart_item'] = $cart_item;

        return $data;

    }

    public function getCart()
    {
        $key = self::getKey();

        if (Auth::guard('member')->check()) {
            $member = self::getMember();

            $cart   = Cart::with('cart_items')->where('member_id', $member->id)->first();

            if (!$cart) {
                $cart = Cart::create(['member_id' => $member->id, 'key' => $key]);
            }

        } else {
            $cart = Cart::with('cart_items')->where('key', $key)->first();

            if (!$cart) {
                $cart = Cart::create(['key' => $key]);
            }
        }

        return $cart;
    }

    public function getItemData($request)
    {
        return [
            'product_id'    => $request->product_id,
            'product_name'  => $request->product_name,
            'product_image' => $request->product_image,
            'quantity'      => $request->quantity,
            'type'          => $request->type,
            'amount'        => $request->amount,
            'sub_total'     => intval($request->quantity) * floatval($request->amount),
            'is_auth'       => $this->isAuth(),
        ];
    }

    public function totalAmount($cart_items)
    {
        return $cart_items ? $cart_items->sum('sub_total') : 0;
    }

    public function totalQuantity($cart_items)
    {
        return $cart_items ? $cart_items->sum('quantity') : 0;
    }

    public function totalItem($cart_items)
    {
        return $cart_items ? $cart_items->count() : 0;
    }

    public function getWishListCartItem()
    {
        if (Auth::guard('member')->check()) {
            $member     = self::getMember();
            $cart       = Cart::with('cart_items')->where('member_id', $member->id)->first();
            $cart_items = ($cart && $cart->cart_items) ? $cart->cart_items->where('is_auth', true) : null;
        } else {
            $cart       = Cart::with('cart_items')->where('key', $this->getKey())->first();
            $cart_items = $cart->cart_items ?? null;
        }

        $cart_items     = ($cart && $cart_items) ? $cart_items->where('type', area()) : null;

        return $cart_items ?? null;
    }


    public function updateWishListItem($wishlist_id, $quantity)
    {
        $wishlist_data = WishList::findOrFail($wishlist_id);

        $wishlist_data->update(['quantity' => $quantity]);

        return $wishlist_data;
    }

    public function getAddWishListData() /* for wishlist add all item to cart items */
    {
        if (Auth::guard('member')->check()) {
            $member                   = self::getMember();
            $wishlists                = WishList::with('product')->where('member_id', $member->id)->where('quantity', '!=', 0)->get();
        }else {
            $wishlists = WishList::with('product')->where('key', $this->getWishListKey())->where('quantity', '!=', 0)->get();
        }

        return $wishlists;
    }

    public function getWishListData()
    {
        if (Auth::guard('member')->check()) {
            $member                   = self::getMember();
            $wishlists                = WishList::with('product')->where('member_id', $member->id)->get();
        }else {
            $wishlists = WishList::with('product')->where('key', $this->getWishListKey())->get();
        }

        return $wishlists;
    }

    public function addAllWishItemToCart($wishlists, $cart, $request)
    {   
        $cart_item      = null;

        foreach ($wishlists as $wishlist) {
            $amount        = $wishlist->product->sale_price ? $wishlist->product->sale_price : $wishlist->product->original_price;

            $quantity      = $request->get('wish_list_number_'.$wishlist->id);
            $sell_quantity = $wishlist->product->sell_quantity;
            $min_stock_qty = $wishlist->product->min_stock_quantity ? $wishlist->product->min_stock_quantity : 0;
            $p_sell_qty    = $sell_quantity - $min_stock_qty;

            $item_data     = [
                'product_id'    => $wishlist->product_id,
                'product_name'  => $wishlist->product->name_en,
                'product_image' => $wishlist->product->feature_image,
                'quantity'      => $quantity,
                'type'          => $wishlist->product->type,
                'amount'        => $amount,
                'sub_total'     => intval($quantity) * floatval($amount),
                'is_auth'       => $this->isAuth(),
            ];
            
            $cart_item     = $cart->cart_items->where('product_id', $wishlist->product_id)->first();


            if (!$cart_item) {
                $cart_item = $cart->cart_items()->create($item_data);
            } else {
                $item_data['quantity']  = $cart_item->quantity + $item_data['quantity'];
                $item_data['sub_total'] = $item_data['amount'] * $item_data['quantity'];

                if ($item_data['quantity'] <= $p_sell_qty ) {
                    $cart_item->update($item_data);
                }
            }

            $wishlist->update(['quantity' => $quantity]);
        }

        return $cart_item ? $cart_item : null;
    }
}
