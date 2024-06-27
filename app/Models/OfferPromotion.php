<?php

namespace App\Models;

use App\Traits\ActionUser;
use App\Traits\Active;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Str;

class OfferPromotion extends Model
{
    use LogsActivity;
    use SoftDeletes;
    use ActionUser, Active;
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'offer_promotions';

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
    protected $fillable = ['name_en', 'name_hant', 'name_hans', 'slug', 'descriptions', 'is_percent', 'percent', 'amount', 'status', 'start_date', 'end_date', 'created_date', 'created_by', 'updated_by'];

    protected $casts    = [
        'descriptions' => 'array',
    ];

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
 
         $this->attributes['slug']    = Str::slug($value);
     }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['id', 'name_en', 'name_hant', 'name_hans', 'slug', 'descriptions', 'is_percent', 'percent', 'amount', 'status', 'start_date', 'end_date', 'updated_by'])
            ->setDescriptionForEvent(function ($eventName) {
                return "OfferPromotion model has been $eventName";
            });
    }
}
