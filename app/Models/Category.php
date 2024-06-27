<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use App\Traits\ActionUser;
use App\Traits\Active;
use Str;

class Category extends Model
{
    use LogsActivity;
    use ActionUser, Active;
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'categories';

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
    protected $fillable = ['parent_id', 'name_en', 'name_hans', 'name_hant', 'slug', 'image', 'sort', 'status', 'is_other', 'created_date', 'created_by', 'updated_by'];

    

    /**
     * Change activity log event description
     *
     * @param string $eventName
     *
     * @return string
     */

    public function setNameEnAttribute($value)
    {
        $this->attributes['name_en'] = $value;

        $this->attributes['slug'] = Str::slug($value);
    }


    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['id', 'parent_id', 'name_en', 'name_hans', 'name_hant', 'status', 'updated_by'])
            ->setDescriptionForEvent(function ($eventName) {
                return "Category model has been $eventName";
            });
    }

    public function subcategories()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    public function parent_category()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
}
