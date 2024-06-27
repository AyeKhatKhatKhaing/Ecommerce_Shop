<?php

namespace App\Models;

use App\Traits\Active;
use App\Traits\ActionUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Country extends Model
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

    public function regions()
    {
        return $this->hasMany(Region::class, 'country_id', 'id');
    }

    public function region_names()
    {
        return $this->hasMany(Region::class, 'country_id', 'id')->select('id', 'country_id', 'name_en', 'name_hant', 'name_hans');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['id', 'name_en', 'name_hans', 'name_hant', 'status'])
            ->setDescriptionForEvent(function ($eventName) {
                return "Country model has been $eventName";
            });
    }
}
