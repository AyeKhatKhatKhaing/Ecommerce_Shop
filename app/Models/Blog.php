<?php

namespace App\Models;

use App\Traits\Active;
use App\Traits\ActionUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Blog extends Model
{
    use LogsActivity;
    use SoftDeletes;
    use Active, ActionUser;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'blogs';

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
    protected $fillable = ['category_id', 'titles', 'short_descriptions', 'descriptions', 'slug', 'blog_image', 'blog_image_alt', 'status', 'published_status', 'published_date', 'meta_titles', 'meta_descriptions', 'meta_image', 'meta_image_alt', 'created_date', 'created_by', 'updated_by'];

    protected $casts    = [
        'titles'             => 'array',
        'short_descriptions' => 'array',
        'descriptions'       => 'array',
        'meta_titles'        => 'array',
        'meta_descriptions'  => 'array',
    ];

    public function blog_category()
    {
        return $this->belongsTo(BlogCategory::class, 'category_id');
    }
    
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
            ->logOnly(['id', 'category_id', 'titles', 'status', 'published_status', 'published_date', 'meta_titles', 'updated_by'])
            ->setDescriptionForEvent(function ($eventName) {
                return "Blog model has been $eventName";
            });
    }
}
