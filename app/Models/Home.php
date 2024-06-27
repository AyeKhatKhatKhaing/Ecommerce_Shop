<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Home extends Model
{
    use LogsActivity;
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'homes';

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
    protected $fillable = ['feature_names', 'feature_titles', 'feature_descriptions', 'feature_link', 'feature_image', 'feature_image_alt', 'penfold_names', 'penfold_titles', 'penfold_descriptions', 'penfold_link', 'penfold_image', 'penfold_image_alt', 'exclusive_titles', 'exclusive_descriptions', 'exclusive_link', 'exclusive_image', 'exclusive_image_alt', 'about_titles', 'about_descriptions', 'about_link', 'about_image', 'about_image_alt', 'store_titles', 'store_descriptions', 'store_link', 'store_image', 'store_image_alt', 'meta_titles', 'meta_descriptions', 'meta_image', 'meta_image_alt', 'brand_logo', 'status', 'created_date', 'created_by', 'updated_by'];

    protected $casts = [
        'feature_names'          => 'array',
        'feature_titles'         => 'array',
        'feature_descriptions'   => 'array',
        'penfold_names'          => 'array',
        'penfold_titles'         => 'array',
        'penfold_descriptions'   => 'array',
        'exclusive_titles'       => 'array',
        'exclusive_descriptions' => 'array',
        'about_titles'           => 'array',
        'about_descriptions'     => 'array',
        'store_titles'           => 'array',
        'store_descriptions'     => 'array',
        'meta_titles'            => 'array',
        'meta_descriptions'      => 'array',
        'brand_logo'             => 'array',
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
            ->logOnly(['id', 'feature_names', 'feature_titles', 'feature_link', 'penfold_names', 'penfold_titles', 'penfold_link', 'exclusive_titles', 'exclusive_link', 'about_titles', 'about_link', 'store_titles', 'store_link', 'meta_titles', 'status'])
            ->setDescriptionForEvent(function ($eventName) {
                return "Home model has been $eventName";
            });
    }
}
