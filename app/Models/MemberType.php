<?php

namespace App\Models;

use App\Traits\ActionUser;
use App\Traits\Active;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class MemberType extends Model
{
    use LogsActivity;
    use SoftDeletes;
    use ActionUser, Active;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'member_types';

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
    protected $fillable = ['name_en', 'name_hant', 'name_hans', 'descriptions', 'currency_type', 'min_purchase_amount', 'status', 'created_date', 'created_by', 'updated_by'];

    protected $casts = [
        'descriptions' => 'array',
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
            ->logOnly(['id', 'name_en', 'name_hant', 'name_hans', 'currency_type', 'min_purchase_amount', 'status', 'updated_by'])
            ->setDescriptionForEvent(function ($eventName) {
                return "Member Type model has been $eventName";
            });
    }

    public function getMinPurchaseAmount($current_member_type)
    {
        $lng = lngKey();
        if (is_string($current_member_type) == false) {
            $current_member_type = MemberType::find($current_member_type)->name_en;
        }

        if ($current_member_type == "Silver") {
            $member_type = MemberType::where('name_en', "Gold")->first();
            if ($member_type) {
                return [
                    "min_purchase_amount" => $member_type->min_purchase_amount, 
                    "description"         => $member_type->descriptions[$lng],
                ];
            }
        } else {
            $member_type = MemberType::where('name_en', "Platinum")->first();
            if ($member_type) {
                return [
                    "min_purchase_amount" => $member_type->min_purchase_amount, 
                    "description"         => $member_type->descriptions[$lng],
                ];
            }
        }
    }

}
