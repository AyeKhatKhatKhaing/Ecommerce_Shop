<?php

namespace App\Models;

use App\Traits\ActionUser;
use App\Traits\Active;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class ContactPage extends Model
{
    use LogsActivity;
    use SoftDeletes;
    use Active, ActionUser;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'contact_pages';

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
    protected $fillable = ['banner_titles', 'banner_image', 'banner_image_alt', 'meta_titles', 'meta_descriptions', 'meta_image', 'meta_image_alt', 'status', 'created_date', 'created_by', 'updated_by'];

    protected $casts = [
        'banner_titles'     => 'array',
        'meta_titles'       => 'array',
        'meta_descriptions' => 'array',
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
            ->logOnly(['id', 'banner_titles', 'meta_titles', 'updated_by'])
            ->setDescriptionForEvent(function ($eventName) {
                return "ContactPage model has been $eventName";
            });
    }
}
