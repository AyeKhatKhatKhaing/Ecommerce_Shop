<?php

namespace App\Enums;

enum OrderStatusEnum: int {

    case Processing         = 0;
    case Completed          = 1;
    case AwatingShipment    = 2;
    case Shipped            = 3;
    case TobePickup         = 4;
    case AlreadyPickup      = 5;
    case Cancelled          = 6;

    public function name() : string
    {
        return match ($this) {
            self::Processing        => '加工',
            self::Completed         => '完全的',
            self::AwatingShipment   => '等待發貨',
            self::Shipped           => '已出貨',
            self::TobePickup        => '待提貨',
            self::AlreadyPickup     => '已取貨',
            self::Cancelled         => '取消',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'name', 'value');
    }  

}