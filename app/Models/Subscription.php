<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Subscription extends Model
{
    use HasFactory, Notifiable;
    use LogsActivity;

    protected $table = 'subscriptions';

    protected $fillable = [
        'member_id',
        'email',
        'status',
        'creted_date',
        'updated_by',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['id', 'member_id', 'email', 'status', 'created_date', 'updated_by'])
            ->setDescriptionForEvent(function ($eventName) {
                return "Subscribe model has been $eventName";
            });
    }
}
