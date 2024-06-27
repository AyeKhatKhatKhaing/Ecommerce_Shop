<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class AboutRemfly extends Model
{
    use LogsActivity;
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'about_remflies';

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
    protected $fillable = ['banner_titles', 'banner_image', 'banner_image_alt', 'description_en', 'description_hant', 'description_hans', 'key_operation_en', 'key_operation_hant', 'key_operation_hans', 'meta_titles', 'meta_descriptions', 'meta_image', 'meta_image_alt', 'status'];

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
            ->logOnly(['id', 'status', 'banner_titles', 'meta_titles'])
            ->setDescriptionForEvent(function ($eventName) {
                return "AboutRemfly model has been $eventName";
            });
    }
}
