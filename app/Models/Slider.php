<?php

namespace App\Models;

use App\Traits\Active;
use App\Traits\ActionUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Slider extends Model
{
    use LogsActivity;
    use SoftDeletes;
    use ActionUser, Active;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sliders';

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
    protected $fillable = ['names', 'titles', 'descriptions', 'link', 'banner_image', 'banner_image_alt', 'mb_banner_image', 'mb_banner_image_alt', 'status', 'created_date', 'created_by', 'updated_by'];

    protected $casts    = [
        'names'        => 'array',
        'titles'       => 'array',
        'descriptions' => 'array',
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
            ->logOnly(['id', 'names', 'titles', 'link', 'status', 'created_date', 'updated_by'])
            ->setDescriptionForEvent(function ($eventName) {
                return "Slider model has been $eventName";
            });
    }
}
