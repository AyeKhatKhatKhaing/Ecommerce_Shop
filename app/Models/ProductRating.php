<?php

namespace App\Models;

use App\Traits\ActionUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class ProductRating extends Model
{
    use HasFactory;
    use LogsActivity;
    use ActionUser;

    protected $table = 'product_ratings';

    protected $fillable =
    [
        'product_id', 'score_rp', 'score_ws', 'score_jh', 'score_bc', 'score_js', 'score_bh',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['id', 'product_id', 'score_rp', 'score_ws', 'score_jh', 'score_bc', 'score_js', 'score_bh'])
            ->setDescriptionForEvent(function ($eventName) {
                return "Product Rating model has been $eventName";
            });
    }
}
