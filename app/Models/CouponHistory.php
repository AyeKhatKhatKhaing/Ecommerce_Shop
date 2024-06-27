<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class CouponHistory extends Model
{
    use HasFactory;
    use LogsActivity;


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'coupon_histories';

    protected $fillable = [
        'member_id',
        'coupon_id',
        'usage_count',
        'start_date',
        'expiry_date',
        'status',
        'created_date',
    ];

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['id', 'member_id', 'coupon_id', 'usage_count', 'start_date', 'expiry_date', 'status'])
            ->setDescriptionForEvent(function ($eventName) {
                return "Coupon History model has been $eventName";
            });
    }
}
