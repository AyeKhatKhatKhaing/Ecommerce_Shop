<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class WishList extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $table = 'wish_lists';

    protected $fillable = [
        'member_id',
        'product_id',
        'type',
        'key',
        'quantity',
        'amount',
        'sub_total',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function isSoldOut($product)
    {
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
            ->logOnly(['id', 'member_id', 'product_id', 'type', 'key', 'quantity', 'amount', 'sub_total'])
            ->setDescriptionForEvent(function ($eventName) {
                return "WishList model has been $eventName";
            });
    }
}
