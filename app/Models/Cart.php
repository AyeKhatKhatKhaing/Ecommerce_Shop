<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Cart extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $fillable = [
        'member_id',
        'key',
        'quantity',
        'coupon_code',
        'coupon_amount',
        'total_amount'
    ];

    public function cart_items()
    {
        return $this->hasMany(CartItem::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['id', 'member_id', 'key', 'quantity', 'coupon_code', 'total_amount'])
            ->setDescriptionForEvent(function ($eventName) {
                return "Cart model has been $eventName";
            });
    }
}
