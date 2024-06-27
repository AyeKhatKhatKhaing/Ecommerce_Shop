<?php

namespace App\Models;

use App\Traits\ActionUser;
use App\Traits\Active;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Notifications\Notifiable;

class ContactForm extends Model
{
    use LogsActivity;
    use HasFactory;
    use Active, ActionUser;
    use Notifiable;


    protected $table = 'contact_forms';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name', 'email', 'phone_no', 'message', 'read_statement', 'receive_news', 'created_date', 'created_by', 'updated_by',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['id', 'name', 'email', 'phone_no', 'updated_by'])
            ->setDescriptionForEvent(function ($eventName) {
                return "Contact Form model has been $eventName";
            });
    }
}
