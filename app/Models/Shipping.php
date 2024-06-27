<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\ActionUser;


class Shipping extends Model
{
    use LogsActivity;
    use SoftDeletes;
    use ActionUser;

    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'shippings';

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
    protected $fillable = ['country_type', 'currency_type', 'amount', 'free_shipping_amount', 'status','created_date', 'created_by', 'updated_by'];

    

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
            ->logOnly(['id', 'country_type', 'currency_type', 'amount', 'free_shipping_amount', 'status', 'created_date', 'updated_by'])
            ->setDescriptionForEvent(function ($eventName) {
                return "Shipping model has been $eventName";
            });
    }
}
