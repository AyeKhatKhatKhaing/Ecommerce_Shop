<?php

namespace App\Helpers;

use DB;
use File;
use Illuminate\Support\Str;

class AdminHelper
{
    public static function tableLength($data)
    {
        $html = "<span class='text-gray-600 fw-bold'>" . __('backend.filter.display_item') . $data->currentPage() . " " . __('backend.filter.to') . $data->perPage() . " " . __('backend.filter.of_total') . $data->total() .  __('backend.filter.items') ."</span>";

        echo $html;
    }

    public static function getMemberCode()
    {
        $total = DB::table('members')->count();
        $code  = "MB" . Str::padLeft(++$total, 6, 0);

        return $code;
    }

    public static function storageFileExist($file_path)
    {
        $file_dir = null;
        if ($file_path) {
            $path_arr = preg_split("/\/storage/", $file_path);
            if (count($path_arr) > 1) {
                $path = "storage" . end($path_arr);
            } else {
                $path = end($path_arr);
            }

            if (File::exists(public_path($path))) {
                $file_dir = $path;
            }
        }
        return $file_dir;
    }

    public static function checkPhoneFormat($country_code, $phone)
    {
        if (Str::startsWith($phone, $country_code)) {
            $phone = Str::replaceFirst($country_code, '', $phone);

        }
        
        return $country_code.$phone;
    }

    public static function getPageTypes()
    {
        return [
            'promotion' => 'Promotion',
            'category'  => 'Category',
            'cart'      => 'Cart',
            'wishlist'  => 'Wishlist',
            'checkout'  => 'Checkout',
            'default'   => 'Default Page',
        ];
    }

}
