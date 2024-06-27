<?php

namespace App\Models;

use App\Traits\Active;
use App\Traits\ActionUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Str;

class AttributeTerm extends Model
{
    use Active, ActionUser;
    use SoftDeletes;
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
    protected $fillable = ['name_en', 'name_hans', 'name_hant', 'slug', 'status', 'created_date', 'created_by', 'updated_by'];

    public function setNameEnAttribute($value)
    {
        $this->attributes['name_en'] = $value;

        $this->attributes['slug']    = Str::slug($value);
    }

    public function attributes()
    {
        return $this->hasMany(Attribute::class, 'attribute_term_id');
    }

    public function getAttributeString($attributes)
    {
        $attributes = $attributes->pluck('name')->toArray();

        return implode(', ', $attributes);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['id', 'name_en', 'name_hans', 'status', 'updated_by'])
            ->setDescriptionForEvent(function ($eventName) {
                return "Attribute Term model has been $eventName";
            });
    }
}
