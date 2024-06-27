<?php

namespace App\Models;

use App\Traits\Active;
use App\Traits\ActionUser;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\SoftDeletes;

class Store extends Model
{
    use LogsActivity;
    use SoftDeletes;
    use Active, ActionUser;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'stores';

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
    protected $fillable = ['name_en', 'name_hant', 'name_hans', 'addresses', 'email', 'phone', 'store_image', 'store_image_alt', 'gallery_images', 'status','created_date', 'created_by', 'updated_by'];

    protected $casts    = [
        'addresses'            => 'array',
        'gallery_images'       => 'array',
    ];

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
            ->logOnly(['id', 'name_en', 'name_hant', 'name_hans', 'status','created_date', 'updated_by'])
            ->setDescriptionForEvent(function ($eventName) {
                return "Store model has been $eventName";
            });
    }
}
