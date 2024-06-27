<?php

if (!function_exists('lng')) {
    function lng()
    {
        $lng = request()->segment(1);
        if (in_array($lng, ['en-hk', 'zh-hant', 'zh-hans'])) {
            return $lng;
        }

        return "zh-hant";
    }
}

if (!function_exists('lngKey')) {
    function lngKey()
    {
        return [
            'zh-hant' => 'hant',
            'zh-hans' => 'hans',
            'en-hk'   => 'en',
        ][app()->getLocale()];
    }
}

function langbind($obj,$value){
    $lang = lngKey();
    $value = $value."_".$lang;
    if($obj){
        return $obj->$value;
    }
    return "";
}

if (!function_exists('area')) {
    function area()
    {
        return session('area') ?? config('locale.area');
    }
}

if (!function_exists('currency')) {
    function currency()
    {
        return area() == 'hk' ? 'HK$' : 'MOP$';
    }
}

if (!function_exists('rm_number_format')) {
    function rm_number_format($number = 0)
    {
        return number_format($number, 2, '.', '');
    }
}

if (!function_exists('getPercentage')) {
    function getPercentage($product)
    {
        $original_price = $product->original_price ?? 0;
        $sale_price = $product->sale_price ?? 0;

        $percentage = null;
        /* percentage = ((Original Price - Sales Price) / Original Price) * 100 */
        if($original_price > 0 && $sale_price > 0) {
            $percentage = (($original_price - $sale_price) / $original_price) * 100;
        }

        return $percentage ? round($percentage, 1) : null;

    }
}
