<?php

namespace App\Models;

use App\Traits\Active;
use App\Traits\ActionUser;
use App\Enums\LocationEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class StorePickup extends Model
{
    use SoftDeletes;
    use Active, ActionUser;
    use LogsActivity;

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
    protected $fillable = ['type', 'name_en', 'name_hans', 'name_hant', 'status', 'created_date', 'created_by', 'updated_by'];

    /**
     * Write code on Method
     *
     * @return response()
     */
    protected $casts = [
        'type' => LocationEnum::class
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['id', 'type', 'name_en', 'name_hans', 'name_hant', 'status', 'created_date', 'updated_by'])
            ->setDescriptionForEvent(function ($eventName) {
                return "Store Pickup model has been $eventName";
            });
    }


}
