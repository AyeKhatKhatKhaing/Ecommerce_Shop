<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class MemberExclusiveOffer extends Model
{
    use LogsActivity;
    use SoftDeletes;
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'member_exclusive_offers';

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
    protected $fillable = ['tier_benefit_en', 'tier_benefit_hant', 'tier_benefit_hans', 'work_en', 'work_hant', 'work_hans', 'notes', 'banner_titles', 'banner_image', 'banner_image_alt', 'meta_titles', 'meta_descriptions', 'meta_image', 'meta_image_alt', 'status', 'created_date', 'created_by', 'updated_by'];

    protected $casts    = [
        'banner_titles'     => 'array',
        'notes'             => 'array',
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
            ->logOnly(['id', 'meta_titles', 'status', 'updated_by'])
            ->setDescriptionForEvent(function ($eventName) {
                return "Member Exclusive Offer model has been $eventName";
            });
    }
}
