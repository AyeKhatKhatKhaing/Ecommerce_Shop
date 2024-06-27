<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\SoftDeletes;

class CommonProblem extends Model
{
    use LogsActivity;
    use SoftDeletes;
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'common_problems';

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
    protected $fillable = ['title_en', 'title_hant', 'title_hans', 'description_en', 'description_hant', 'description_hans', 'meta_titles', 'meta_descriptions', 'meta_image', 'meta_image_alt', 'status'];

    protected $casts = [
       
        'meta_titles'            => 'array',
        'meta_descriptions'      => 'array',
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
            ->logOnly(['id', 'title_en', 'title_hant', 'title_hans', 'meta_titles', 'status'])
            ->setDescriptionForEvent(function ($eventName) {
                return "CommonProblem model has been $eventName";
            });
    }
}
