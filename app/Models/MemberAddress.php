<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;

class MemberAddress extends Model
{
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
    protected $fillable = ['member_id', 'shipping_address', 'billing_address', 'created_date'];

    protected $casts = [
        'shipping_address' => 'array',
        'billing_address'  => 'array',
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
            ->logOnly(['id', 'member_id', 'billing_address', 'shipping_address'])
            ->setDescriptionForEvent(function ($eventName) {
                return "MemberAddress model has been $eventName";
            });
    }

}
