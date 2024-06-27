<?php

namespace App\Models;

use App\Traits\Active;
use App\Traits\ActionUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class ExclusiveOffer extends Model
{
    use LogsActivity;
    use SoftDeletes;
    use Active, ActionUser;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'exclusive_offers';

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
    protected $fillable = ['titles', 'descriptions', 'image', 'image_alt', 'link', 'status', 'created_date', 'sort', 'created_by', 'updated_by'];

    protected $casts    = [
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
            ->logOnly(['id', 'titles', 'status', 'sort'])
            ->setDescriptionForEvent(function ($eventName) {
                return "ExclusiveOffer model has been $eventName";
            });
    }
}
