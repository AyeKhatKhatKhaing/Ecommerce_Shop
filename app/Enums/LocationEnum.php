<?php

namespace App\Enums;

enum LocationEnum: string {
    case hongkong = 'hk';
    case macau = 'ma';

    public function name()
    {
        return match ($this) {
            self::hongkong  => 'Hong Kong',
            self::macau  => 'Macau'
        };
            
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value', 'name');
    }

}
