<?php

namespace App\Models;

use App\Traits\Active;
use App\Traits\ActionUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class BusinessType extends Model
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
    protected $fillable = ['name_en', 'name_hans', 'name_hant', 'status', 'created_date', 'created_by', 'updated_by'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['id', 'name_en', 'name_hans', 'name_hant', 'status', 'updated_by'])
            ->setDescriptionForEvent(function ($eventName) {
                return "Business Type model has been $eventName";
            });
    }

}
