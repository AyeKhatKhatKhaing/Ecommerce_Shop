<?php

namespace App\Models;

use App\Enums\AccountTypeEnum;
use App\Traits\ActionUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Member extends Authenticatable
{
    const STATUS_DELETED      = -1;
    const STATUS_OFF          = 0;
    const STATUS_ACTIVE       = 1;
    const STATUS_UNREGISTERED = 2;

    use LogsActivity, Notifiable;
    use SoftDeletes;
    use ActionUser;

    protected $guard = 'member';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'members';

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
    protected $fillable = [
        'code', 'member_type_id', 'country_id', 'region_id', 'first_name', 'last_name',
        'account_type', 'country_code', 'phone', 'email', 'company', 'company_website', 'business_type',
        'address', 'address_detail', 'city', 'state', 'postal_code', 'password', 'remember_token',
        'ip_address', 'point', 'purchased_amount', 'is_term_condition', 'is_marketing', 'status', 'dob',
        'created_date', 'created_by', 'updated_by', 'deleted_at'
    ];

    public function member_type()
    {
        return $this->belongsTo(MemberType::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function member_country()
    {
        return $this->belongsTo(MemberCountry::class, 'country_id');
    }

    public function recent()
    {
        return $this->hasMany(RecentView::class);
    }

    public function subscription()
    {
        return $this->hasOne(Subscription::class);
    }

    public function coupon_histories()
    {
        return $this->hasMany(CouponHistory::class);
    }

    public function recents()
    {
        return $this->hasMany(RecentView::class);
    }

    public function cart()
    {
        return $this->hasOne(Cart::class);
    }

    public function member_address()
    {
        return $this->hasOne(MemberAddress::class);
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
            ->logOnly(['id', 'code', 'member_type_id', 'country_id', 'region_id', 'first_name', 'last_name', 'account_type', 'phone', 'email', 'company', 'business_type', 'address', 'city', 'state', 'postal_code', 'password', 'remember_token', 'ip_address', 'point', 'status', 'dob'])
            ->setDescriptionForEvent(function ($eventName) {
                return "Member model has been $eventName";
            });
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    public function setAccountTypeAttribute($value)
    {
        $this->attributes['account_type'] = $value == "individual" ? AccountTypeEnum::individual : AccountTypeEnum::company;
    }

    public function setIsTermConditionAttribute($value)
    {
        $this->attributes['is_term_condition'] = $value ? true : false;
    }

    public function setIsMarketingAttribute($value)
    {

        $this->attributes['is_marketing'] = $value ? true : false;
    }

    public function memberTypeName($id)
    {
        return MemberType::find($id);
    }

    public function getFullNameAttribute()
    {
        return $this->getName();
    }

    public function getName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public static function getAddress()
    {
        $member_address = auth('member')->user()->member_address;

        return $member_address ?? null;
    }

    public function getFullName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public static function getMemberCoupon()
    {
        if (auth()->guard('member')->check()) {

            $coupon_history = CouponHistory::with('coupon')->where('member_id', auth()->guard('member')->Id())->where('status', true)->get();
        }

        return $coupon_history ?? null;
    }

}
