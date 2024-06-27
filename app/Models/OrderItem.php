<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class OrderItem extends Model
{
    use HasFactory;
    use LogsActivity;
    
    protected $table      = 'order_items';

    protected $primaryKey = 'id';

    protected $fillable   = [
        'order_id',
        'product_id',
        'quantity',
        'unit_price',
        'sub_total',
        'product_datas',
        'created_date',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'product_datas'   => 'array',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['id', 'order_id', 'product_id', 'quantity', 'unit_price', 'sub_total', 'updated_by'])
            ->setDescriptionForEvent(function ($eventName) {
                return "Order Item model has been $eventName";
            });
    }
}
