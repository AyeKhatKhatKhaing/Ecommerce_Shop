<?php

namespace App\Helpers;

use App\Models\AttributeTerm;
use App\Models\Category;
use App\Models\Country;
use App\Models\MemberType;
use App\Models\Promotion;
use DB;

class DataArrayHelper
{
    public static function getMemberType()
    {
        $member_types = MemberType::active()->get();

        return $member_types;
    }

    public static function getProductCodeArray($type)
    {
        $products = DB::table('products')->select('id', DB::raw('CONCAT(name_en,"(", code, ")") AS product_code'))->where('type', $type)->whereNull('deleted_at')->orderBy('name_en', 'asc')->pluck('product_code', 'id')->toArray();

        return $products;
    }

    public static function getAllProductCodeArray()
    {
        $products = DB::table('products')->select('id', DB::raw('CONCAT(name_en,"(", code, ")") AS product_code'))->whereNull('deleted_at')->orderBy('name_en', 'asc')->pluck('product_code', 'id')->toArray();

        return $products;
    }

    public static function getPromotionArray()
    {
        $promotions = Promotion::active()->whereNull('deleted_at')->get(['id', 'name_en', 'name_hant', 'name_hans']);

        return $promotions;
    }

    public static function getAttributes()
    {
        $attribute_terms = AttributeTerm::with(['attributes' => function ($q) {
            $q->select('id', 'attribute_term_id', 'name')->orderBy('name', 'asc');
        }])->select('id', 'name_en')->active()->orderBy('name_en', 'asc')->get();

        return $attribute_terms;
    }

    public static function getParentCategory()
    {
        $categories = Category::with(['subcategories' => function ($q) {
            $q->select('id', 'parent_id', 'name_hant');
        }])->select('id', 'name_hant')->whereNull('parent_id')->active()->withCount('subcategories')->get();

        return $categories;
    }

    public static function getParentCategoryArray()
    {
        $categories = Category::whereNull('parent_id')->active()->pluck('name_en', 'id')->toArray();
        return $categories;
    }

    public static function getCategories()
    {
        return Category::active()->pluck('name_hant', 'id');
    }

    public static function getCountries()
    {
        return Country::active()->pluck('name_hant', 'id');
    }

    public static function getPromotions()
    {
        return Promotion::active()->pluck('name_hant', 'id');
    }
}
