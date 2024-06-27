<?php

namespace App\Services\Frontend;

use App\Models\Cart;
use App\Models\CartItem;
use Auth;
use Cookie;
class CartService
{
    public function checkCart($request)
    {
        $cart          = self::getCart(); /* get/arrange cookie and member cart */

        $cart_item     = $cart ? $cart->cart_items->where('product_id', $request->product_id)->first() : null;
        $quantity      = isset($cart_item) ? $cart_item->quantity + 1 : 1;
        $sell_quantity = $request->sell_quantity;
        $min_stock_qty = $request->min_stock_qty;

        $item_data = [
            'product_id'    => $request->inputData['product_id'],
            'product_name'  => $request->inputData['product_name'],
            'product_image' => $request->inputData['product_image'],
            'quantity'      => $quantity,
            'type'          => $request->inputData['type'] ?? area(),
            'amount'        => $request->inputData['amount'],
            'sub_total'     => intval($quantity) * floatval($request->inputData['amount']),
            'is_auth'       => auth()->guard('member')->check() ? true : false,
        ];

        // if ($quantity < $sell_quantity && $sell_quantity != $min_stock_qty || $quantity == $sell_quantity) {
        if ($quantity <= $sell_quantity) {
            if ($cart_item) {
                if ($request->inputData['quantity'] == 0) {
                    $cart_item->delete();
                    $cart_item = null;
                } else {
                    $cart_item->update($item_data);
                }
            } else {
                $cart_item = $cart->cart_items()->create($item_data);
            }

            return $cart_item ? $cart_item->quantity : 0;
        } else {

            $out_of_stock  = [
                'status'    => true,
                'quantity'  => $sell_quantity,
            ];

            return $out_of_stock;
        }

    }

    public function addCart($request)
    {
        $product_id             = $request->product_id;
        $sell_quantity          = $request->sell_quantity;
        $item_data              = self::getItemData($request); /* cart item store data */
        $cart                   = self::getCart(); /* get/arrange cookie and member cart */
        $cart_item              = $cart->cart_items->where('product_id', $product_id)->first();
        $cart_item_quantity     = $cart_item ? $cart_item->quantity : 0;
        $item_data['quantity']  = $item_data['quantity'] + $cart_item_quantity;
        $item_data['sub_total'] = $item_data['amount'] * $item_data['quantity'];
        // dd($item_data['quantity'], $item_data['sub_total']);

        if ($item_data['quantity'] <= $sell_quantity) {
            if (!$cart_item) {
                $cart_item = $cart->cart_items()->create($item_data);
            } else {
                $cart_item->update($item_data);
            }
        }
        
        return $cart_item;
    }

    public function updateCart($request)
    {
        $product_id = $request->product_id;

        $item_data  = self::getItemData($request); /* cart item store data */

        $cart       = self::getCart(); /* get/arrange cookie and member cart */

        $cart_item  = $cart->cart_items->where('product_id', $product_id)->first();

        if ($cart_item) {
            if ($request->quantity == 0) {
                $cart_item->delete();
                $cart_item = null;
            } else {
                $cart_item->update($item_data);
            }
        } else {
            $cart_item = $cart->cart_items()->create($item_data);
        }

        return $cart_item ? $cart_item->quantity : 0;
    }

    public function getCart()
    {
        $key = self::getKey();

        if (Auth::guard('member')->check()) {
            $member   = self::getMember();

            $cart     = Cart::with('cart_items')->where('member_id', $member->id)->first();

            if (!$cart) {
                $cart = Cart::create(['member_id' => $member->id, 'key' => $key]);
            }
        } else {
            $cart     = Cart::with('cart_items')->where('key', $key)->first();

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
            'type'          => $request->type ?? area(),
            'amount'        => $request->amount,
            'sub_total'     => intval($request->quantity) * floatval($request->amount),
            'is_auth'       => auth()->guard('member')->check() ? true : false,
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

    public function getCartItem()
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

    /* product detail page mobile cart item */
    public function getProductDetailItem($product_id)
    {
        if (Auth::guard('member')->check()) {
            $member     = self::getMember();
            $cart       = Cart::with('cart_items')->where('member_id', $member->id)->first();
            $cart_items = ($cart && $cart->cart_items) ? $cart->cart_items->where('is_auth', true) : null;
        } else {
            $cart       = Cart::with('cart_items')->where('key', $this->getKey())->first();
            $cart_items = $cart->cart_items ?? null;
        }

        $cart_items     = ($cart && $cart_items) ? $cart_items->where('type', area())->where('product_id', $product_id )->first() : null;

        return $cart_items ?? null;
    }


    public function removeCart()
    {
        $cart      = self::getCart();

        return $cart->delete() ? true : false;
    }

    public function removeCartItem($item_id)
    {
        $cart_item = CartItem::find($item_id);

        return $cart_item->delete() ? true : false;
    }

    public function removeCartItems($cart_items)
    {
        $cart_items->map(function($item) {
            $item->delete();
        });

        return true;
    }

    public function getKey()
    {
        return Cookie::get('cart');
    }

    public function getMember()
    {
        return Auth::guard('member')->user();
    }

}
