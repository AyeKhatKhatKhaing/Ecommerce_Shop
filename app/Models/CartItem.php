<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class CartItem extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $fillable = [
        'cart_id',
        'product_id',
        'type',
        'product_name',
        'product_image',
        'quantity',
        'amount',
        'sub_total',
        'is_auth', // true - member login , false - cookie key
    ];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function isSoldOut($product)
    {
        // $product = Product::find($productId);
        $status = false;

        if($product) {
            if (($product->min_stock_quantity == $product->sell_quantity) || $product->sell_quantity == 0 || is_null($product->sell_quantity)) {
                $status = true;
            }
        }

        return $status;
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['id', 'cart_id', 'product_id', 'type', 'product_name', 'quantity', 'amount', 'sub_total'])
            ->setDescriptionForEvent(function ($eventName) {
                return "Cart Item model has been $eventName";
            });
    }
}
