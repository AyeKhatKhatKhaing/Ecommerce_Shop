<?php

namespace App\Helpers;

use App\Models\Country;
use App\Models\Menu;
use DB;

class FrontendHelper
{
    public static function getMenus()
    {
        $menu_name        = "name_" . lngKey();
        $menu_description = "description_" . lngKey();

        $menus = Menu::active()->orderBy('sort')->get();

        $promotion      = $menus->where('type', 'promotion')->first();
        $category_menus = $menus->where('type', 'category');

        $countries = Country::select('id', 'name_en', 'name_hant', 'name_hans')->with('region_names')->active()->get();

        $header_menus = [];


        /* promotion menu function */
        if ($promotion) {
            $menuData               = new \stdClass();
            $menuData->id           = $promotion->id;
            $menuData->name         = $promotion->$menu_name;
            $menuData->type         = $promotion->type;
            $menuData->category_id  = $promotion->category_id;
            $menuData->description  = $promotion->$menu_description;
            $menuData->image        = $promotion->image;
            $menuData->show_submenu = $promotion->show_submenu;
            $menuData->sub_menus    = self::arrangePromotionSubMenu($promotion->promotions);

            $header_menus[] = $menuData;
        }

        /* category menu function */
        if ($category_menus->count() > 0) {
            foreach ($category_menus as $category_menu) {
                $menuData               = new \stdClass();
                $menuData->id           = $category_menu->id;
                $menuData->name         = $category_menu->$menu_name;
                $menuData->type         = $category_menu->type;
                $menuData->category_id  = $category_menu->category_id;
                $menuData->show_submenu = $category_menu->show_submenu;
                $menuData->description  = $category_menu->$menu_description;
                $menuData->image        = $category_menu->image;
                $menuData->sub_menus    = self::arrangeCategorySubMenu($countries, $category_menu->countries);

                $header_menus[] = $menuData;
            }
        }

        return count($header_menus) > 0 ? collect($header_menus) : null;
    }

    public static function arrangePromotionSubMenu($promotion_ids)
    {
        if (isset($promotion_ids) && count($promotion_ids) > 0) {
            $data = DB::table('promotions')->select('id', 'name_en', 'name_hant', 'name_hans')->where('status', true)->whereIn('id', $promotion_ids)->get();
        }

        return $data ?? null;
    }

    public static function arrangeCategorySubMenu($countries, $country_ids)
    {
        if (isset($country_ids) && count($country_ids) > 0) {
            $select_countries = $countries->whereIn('id', $country_ids);
        }

        return $select_countries ?? null;
    }

}
