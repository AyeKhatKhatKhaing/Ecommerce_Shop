<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\SoftDeletes;

class StoreDistribution extends Model
{
    use LogsActivity;
    use SoftDeletes;
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'store_distributions';

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
    protected $fillable = ['banner_titles', 'titles', 'descriptions', 'banner_image', 'banner_image_alt', 'meta_titles', 'meta_descriptions', 'meta_image', 'meta_image_alt', 'status','created_date', 'created_by', 'updated_by'];



    protected $casts    = [
        'banner_titles'       => 'array',
        'titles'              => 'array',
        'descriptions'        => 'array',
        'meta_titles'         => 'array',
        'meta_descriptions'   => 'array',
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
            ->logOnly(['id', 'banner_titles', 'titles', 'meta_titles', 'status','created_date', 'updated_by'])
            ->setDescriptionForEvent(function ($eventName) {
                return "StoreDistribution model has been $eventName";
            });
    }
}
