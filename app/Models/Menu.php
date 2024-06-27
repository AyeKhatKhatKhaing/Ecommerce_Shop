<?php

namespace App\Models;

use App\Traits\Active;
use App\Traits\ActionUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Models\Country;
use App\Models\Promotion;

class Menu extends Model
{
    use LogsActivity;
    use SoftDeletes;
    use Active, ActionUser;
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'menus';

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
    protected $fillable = ['category_id', 'type', 'countries', 'promotions', 'name_en', 'name_hant', 'name_hans', 'description_en', 'description_hant', 'description_hans', 'image', 'image_alt', 'sort', 'show_submenu', 'status', 'created_date', 'created_by', 'updated_by'];

    protected $casts    = [
        'countries'  => 'array',
        'promotions' => 'array',
        'show_submenu' => 'boolean',
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
            ->logOnly(['id', 'category_id', 'countries', 'name_en', 'name_hant', 'name_hans', 'sort', 'show_submenu', 'status', 'updated_by'])
            ->setDescriptionForEvent(function ($eventName) {
                return "Menu model has been $eventName";
            });
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function getCountriesName($countries = null)
    {
        $data = $countries ? Country::whereIn('id', $countries)->pluck('name_en')->toArray() : null;

        if (isset($data)) {
            return implode(", ", $data);
        } else {
            return "";
        }

    }


    public function getPromotionsName($promotions = null)
    {
        $data = $promotions ? Promotion::whereIn('id', $promotions)->pluck('name_en')->toArray() : null;

        if (isset($data)) {
            return implode(", ", $data);
        } else {
            return "";
        }

    }
}
