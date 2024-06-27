<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Str;

class Attribute extends Model
{
    use HasFactory, SoftDeletes;
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
    protected $fillable = ['attribute_term_id', 'name', 'slug', 'status', 'created_date', 'created_by', 'updated_by'];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;

        $this->attributes['slug'] = Str::slug($value);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['id', 'attribute_term_id', 'name', 'status', 'updated_by'])
            ->setDescriptionForEvent(function ($eventName) {
                return "Attribute model has been $eventName";
            });
    }
}
