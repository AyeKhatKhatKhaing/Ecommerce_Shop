<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Enums\OrderStatusEnum;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Order extends Model
{
    use HasFactory, Notifiable;
    use LogsActivity;

    const PAYMENT_PENDING = 0, PAYMENT_SUCCESS = 1;

    protected $table = 'orders';

    protected $primaryKey = 'id';

    protected $fillable = [
        'member_id',
        'coupon_id',
        'coupon_history_id',
        'code',
        'location',
        'delivery_type',
        'payment_method',
        'payment_type',
        'coupon_code',
        'total_quantity',
        'coupon_amount',
        'shipping_amount',
        'total_amount',
        'hk_change_amount',
        'currency_rate',
        'lang_key',
        'notes',
        'payment_status',
        'order_status',
        'delivery_status',
        'pickup_datas',
        'billing_addresses',
        'shipping_addresses',
        'is_whole_sale',
        'is_email',
        'is_trashed',
        'created_date',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'pickup_datas'       => 'array',
        'billing_addresses'  => 'array',
        'shipping_addresses' => 'array',
        'order_status'       => OrderStatusEnum::class,
    ];

    public function order_items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }

    public function order_options()
    {
        return $this->hasMany(OrderOption::class);
    }

    public function scopeNotTrashed($query)
    {
        return $query->where('is_trashed', 0);
    }

    public function scopeIsTrashed($query)
    {
        return $query->where('is_trashed', 1);
    }

    public function getOrderStatus($status = 0)
    {
        $status = '<span class="badge badge-light-warning fw-bolder px-2 py-2">' . OrderStatusEnum::Processing->name() . '</span>';

        switch ($this->order_status) {
            case (OrderStatusEnum::Processing):
                $status = '<span class="badge badge-light-warning fw-bolder px-2 py-2">' . $this->order_status->name() . '</span>';
                break;
            case (OrderStatusEnum::Completed):
                $status = '<span class="badge badge-light-success fw-bolder px-2 py-2">' . $this->order_status->name() . '</span>';
                break;
            case (OrderStatusEnum::AwatingShipment);
                $status = '<span class="badge badge-light-info fw-bolder px-2 py-2">' . $this->order_status->name() . '</span>';
                break;
            case (OrderStatusEnum::Shipped);
                $status = '<span class="badge badge-light-primary fw-bolder px-2 py-2">' . $this->order_status->name() . '</span>';
                break;
            case (OrderStatusEnum::TobePickup);
                $status = '<span class="badge badge-light-primary fw-bolder px-2 py-2">' . $this->order_status->name() . '</span>';
                break;
            case (OrderStatusEnum::AlreadyPickup);
                $status = '<span class="badge badge-light-primary fw-bolder px-2 py-2">' . $this->order_status->name() . '</span>';
                break;

            case (OrderStatusEnum::Cancelled):
                $status = '<span class="badge badge-light-danger fw-bolder px-2 py-2">' . $this->order_status->name() . '</span>';
                break;
        }

        echo $status;
    }

    public function getOrderStatusName($order_status)
    {
        switch ($order_status) {
            case (OrderStatusEnum::Processing):
                return '加工';
                break;
            case (OrderStatusEnum::Completed):
                return '完全的';
                break;
            case (OrderStatusEnum::AwatingShipment);
                return '等待發貨';
                break;
            case (OrderStatusEnum::Shipped);
                return '已出貨';
                break;
            case (OrderStatusEnum::TobePickup);
                return '待提貨';
                break;
            case (OrderStatusEnum::AlreadyPickup);
                return '已取貨';
                break;
            case (OrderStatusEnum::Cancelled):
                return '取消';
                break;
        }
    }

    public function getPaymentStatus($status = 0)
    {
        $status = '<span class="text-warning">付款等待中</span>';

        switch ($this->payment_status) {
            case (self::PAYMENT_PENDING):
                $status = '<span class="text-warning">付款等待中</span>';
                break;
            case (self::PAYMENT_SUCCESS);
                $status = '<span class="text-success">支付成功</span>';
                break;
        }

        echo $status;
    }

    public function getCurrency($code = null)
    {
        $area = $code ? substr($code, 0, 2) : substr($this->code, 0, 2);

        return $area == 'hk' ? 'HK$' : 'MOP$';
    }

    public function getShippingTo()
    {
        $ship_to = '';
        $addresses = $this->shipping_addresses ? $this->shipping_addresses : $this->billing_addresses;

        if($addresses) {
            $ship_to .= isset($addresses['first_name']) && $addresses['first_name'] ? $addresses['first_name']. ' ' : '';
            $ship_to .= isset($addresses['last_name']) && $addresses['last_name'] ? $addresses['last_name'] . ', ' : '';
            $ship_to .= isset($addresses['address']) && $addresses['address'] ? $addresses['address'] . ', ' : '';
            $ship_to .= isset($addresses['address_detail']) && $addresses['address_detail'] ? $addresses['address_detail'] . ', ' : '';
            $ship_to .= isset($addresses['phone']) && $addresses['phone'] ? $addresses['phone'] : '';
        }

        return $ship_to;
    }

    public function getPaymentType()
    {
        $payment = '';

        if($this->payment_method == 'recon') {
            $recon_payments = config('general.recon_payment');
            $payment = isset($recon_payments[$this->payment_type]) ? $recon_payments[$this->payment_type] : '';
        }

        return $payment;
    }

    public function routeNotificationForMail($notification)
    {
        $email = (isset($this->billing_addresses['email']) && !empty($this->billing_addresses['email'])) ? $this->billing_addresses['email'] : $this->member->email;

        return $email;
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['id', 'member_id', 'coupon_id', 'coupon_history_id', 'code', 'location', 'total_quantity', 'total_amount', 'payment_status', 'updated_by'])
            ->setDescriptionForEvent(function ($eventName) {
                return "Order model has been $eventName";
            });
    }
}
