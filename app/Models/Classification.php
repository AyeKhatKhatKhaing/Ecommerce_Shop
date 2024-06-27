<?php

namespace App\Models;

use App\Traits\ActionUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Str;

class Classification extends Model
{
    use LogsActivity;
    use SoftDeletes;
    use ActionUser;
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'classifications';

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
    protected $fillable = ['name_en', 'name_hant', 'name_hans', 'slug', 'status', 'created_date', 'created_by', 'updated_by'];

    public function setNameEnAttribute($value)
    {
        $this->attributes['name_en'] = $value;

        $this->attributes['slug']    = Str::slug($value);
    }

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
            ->logOnly(['id', 'name_en', 'name_hant', 'name_hans', 'status', 'updated_by'])
            ->setDescriptionForEvent(function ($eventName) {
                return "Classification model has been $eventName";
            });
    }
}
