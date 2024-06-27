<?php

namespace App\Models;

use App\Traits\Active;
use App\Traits\ActionUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Coupon extends Model
{
    use LogsActivity;
    use SoftDeletes;
    use ActionUser, Active;
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'coupons';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['code', 'products', 'amount', 'percent', 'coupon_type', 'discount_type', 'per_coupon', 'per_coupon_usage', 'per_user', 'descriptions', 'start_date', 'expiry_date', 'created_date', 'created_by', 'updated_by', 'member_type_id', 'status'];

    protected $casts    = [
        'products'     => 'array',
        'descriptions' => 'array',
    ];    

    /**
     * Change activity log event description
     *
     * @param string $eventName
     *
     * @return string
     */

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['id', 'code', 'products', 'amount', 'coupon_type', 'discount_type', 'per_coupon', 'per_coupon_usage', 'per_user', 'start_date', 'expiry_date', 'status'])
            ->setDescriptionForEvent(function ($eventName) {
                return "Coupon model has been $eventName";
            });
    }
}
