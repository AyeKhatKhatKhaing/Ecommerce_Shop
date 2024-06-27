<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\ActionUser;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class ProductMeta extends Model
{
    use LogsActivity;
    use ActionUser;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'product_metas';

     /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['product_id', 'contents', 'descriptions', 'testing_notes', 'product_details', 'awards', 'product_descriptions', 'meta_titles', 'meta_descriptions', 'meta_image', 'meta_image_alt'];

    protected $casts    = [
        'contents'             => 'array',
        'descriptions'         => 'array',
        'testing_notes'        => 'array',
        'product_details'      => 'array',
        'awards'               => 'array',
        'product_descriptions' => 'array',
        'meta_titles'          => 'array',
        'meta_descriptions'    => 'array',
    ];
    
    
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['id', 'product_id'])
            ->setDescriptionForEvent(function ($eventName) {
                return "Product Meta model has been $eventName";
            });
    }
}
