<?php

namespace App\Models;

use App\Traits\Active;
use App\Traits\ActionUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class ContactAddress extends Model
{
    use LogsActivity;
    use SoftDeletes;
    use ActionUser, Active;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'contact_addresses';

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
    protected $fillable = ['name_en', 'name_hant', 'name_hans', 'address_en', 'address_hant', 'address_hans', 'google_map', 'status', 'created_date', 'created_by', 'updated_by'];

    

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
            ->logOnly(['id', 'name_en', 'name_hant', 'name_hans', 'address_en', 'address_hant', 'address_hans', 'status', 'updated_by'])
            ->setDescriptionForEvent(function ($eventName) {
                return "Contact Address model has been $eventName";
            });
    }
}
