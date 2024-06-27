<?php

namespace App\Models;

use App\Traits\Active;
use App\Traits\ActionUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Region extends Model
{
    use HasFactory, SoftDeletes, Active, ActionUser;
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
    protected $fillable = ['country_id', 'name_en', 'name_hans', 'name_hant', 'status', 'created_date', 'created_by', 'updated_by'];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    // public function getCountryName($value)
    // {
    //     return Country::findOrFail($value)->name_hant;
    // }

    public function scopeSearchByCountryName($query, $keyword)
    {
        return Country::where('name_en', 'like', "%$keyword%")->get()->pluck('id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['id', 'country_id', 'name_en', 'name_hans', 'name_hant', 'status', 'created_date', 'updated_by'])
            ->setDescriptionForEvent(function ($eventName) {
                return "Region model has been $eventName";
            });
    }
}
