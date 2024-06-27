<?php

namespace App\Services\Frontend;

use App\Models\AttributeTerm;
use DB;

class ProductService
{

    public function getPromotions($product_ids = [])
    {
        $promotions = DB::table('promotions')->join('product_promotion', function ($join) use ($product_ids) {
            $join->on('product_promotion.promotion_id', '=', 'promotions.id')
                ->whereIn('product_promotion.product_id', $product_ids);
        })
            ->selectRaw('promotions.*, count(promotions.id) as product_count')
            ->where('promotions.status', true)
            ->whereNull('promotions.deleted_at')
            ->groupBy('promotions.id')
            ->get();

        return $promotions ? $promotions : null;
    }

    public static function getCategories($product_ids = [], $category_id)
    {
        /*
        join(inner join) will retrieve only category that have related category_product,
        leftJoin() will retrieve all category if no category_product.
         */
        $query = DB::table('categories');

        $category_id ? $query->where('id', $category_id) : '';

        $categories = $query->join('category_product', function ($join) use ($product_ids) {
            $join->on('category_product.category_id', '=', 'categories.id')
                ->whereIn('category_product.product_id', $product_ids);
        })
        // ->whereIn('category_product.product_id', $product_id)
            ->selectRaw('categories.*, count(categories.id) as product_count')
            ->where('categories.status', true)
            ->whereNull('categories.deleted_at')
            ->groupBy('categories.id')
            ->orderBy('sort', 'desc')
            ->get();

        return $categories ? $categories : null;
    }

    public function getClassifications($product_ids = [])
    {
        $classifications = DB::table('classifications')->join('classification_product', function ($join) use ($product_ids) {
            $join->on('classification_product.classification_id', '=', 'classifications.id')
                ->whereIn('classification_product.product_id', $product_ids);
        })
            ->selectRaw('classifications.*, count(classifications.id) as product_count')
            ->where('classifications.status', true)
            ->whereNull('classifications.deleted_at')
            ->groupBy('classifications.id')
            ->get();

        return $classifications ? $classifications : null;
    }

    public function getCountries($product_ids = [])
    {
        $countries = DB::table('countries')->join('products', function ($join) use ($product_ids) {
            $join->on('products.country_id', '=', 'countries.id')
                ->whereIn('products.id', $product_ids);
        })
            ->selectRaw('countries.*, count(products.id) as product_count')
            ->where('countries.status', true)
            ->whereNull('countries.deleted_at')
            ->groupBy('countries.id')
            ->get();

        return $countries ? $countries : null;
    }

    public function getRegions($product_ids = [])
    {
        $regions = DB::table('regions')->join('products', function ($join) use ($product_ids) {
            $join->on('products.region_id', '=', 'regions.id')
                ->whereIn('products.id', $product_ids);
        })
            ->selectRaw('regions.*, count(products.id) as product_count')
            ->where('regions.status', true)
            ->whereNull('regions.deleted_at')
            ->groupBy('regions.id')
            ->get();

        return $regions ? $regions : null;
    }

    public function getAttributes($product_ids = [])
    {
        $attribute_terms = AttributeTerm::with(['attributes' => function ($query) use ($product_ids) {
            $query->join('attribute_product', 'attribute_product.attribute_id', '=', 'attributes.id')
                ->join('products', 'products.id', '=', 'attribute_product.product_id')
                ->where('products.status', true)
                ->whereIn('products.id', $product_ids)
                ->whereNull('products.deleted_at')
                ->where('attributes.status', true)
                ->selectRaw('attributes.*, count(products.id) as product_count')
                ->groupBy('attributes.id');
        }])
            ->where('attribute_terms.status', true)
            ->selectRaw('attribute_terms.*')
            ->get();

        return $attribute_terms;
    }

    public function getProductRatings($product_ids)
    {
        $product_ratings = DB::table('product_ratings')->join('products', function ($join) use ($product_ids) {
            $join->on('product_ratings.product_id', '=', 'products.id')
                ->whereIn('product_ratings.product_id', $product_ids);
        })
            ->selectRaw('product_ratings.*, count(products.id) as product_count')
            ->groupBy('product_ratings.id')
            ->get();

        return $product_ratings ? $product_ratings : null;
    }

    public function ratingFilterQuery($query, $request)
    {
        $rp_arr = $request->rp ? array_map('intval', explode('-', $request->rp)) : [];
        $ws_arr = $request->ws ? array_map('intval', explode('-', $request->ws)) : [];
        $jh_arr = $request->jh ? array_map('intval', explode('-', $request->jh)) : [];
        $bc_arr = $request->bc ? array_map('intval', explode('-', $request->bc)) : [];
        $js_arr = $request->js ? array_map('intval', explode('-', $request->js)) : [];
        $bh_arr = $request->bh ? array_map('intval', explode('-', $request->bh)) : [];

        if ($request->rp || $request->ws || $request->jh || $request->bc || $request->js || $request->bh) {
            $query->select('products.*')->join('product_ratings as pr', 'products.id', '=', 'pr.product_id');
            if (count($rp_arr) == 2) {
                $query->whereBetween('score_rp', [$rp_arr[0], $rp_arr[1]]);
            }

            if (count($ws_arr) == 2) {
                $query->whereBetween('score_ws', [$ws_arr[0], $ws_arr[1]]);
            }

            if (count($jh_arr) == 2) {
                $query->whereBetween('score_jh', [$jh_arr[0], $jh_arr[1]]);
            }

            if (count($bc_arr) == 2) {
                $query->whereBetween('score_bc', [$bc_arr[0], $bc_arr[1]]);
            }

            if (count($js_arr) == 2) {
                $query->whereBetween('score_js', [$js_arr[0], $js_arr[1]]);
            }

            if (count($bh_arr) == 2) {
                $query->whereBetween('score_bh', [$bh_arr[0], $bh_arr[1]]);
            }
        }

        return $query;
    }

    public function priceFilterQuery($query, $request)
    {
        [$price_from, $price_to] = $request->price ? array_map('intval', explode('-', $request->price)) : [0, 0];

        if (($price_from > 0 && $price_to > 0) && ($price_from <= $price_to)) {
            $query->whereBetween('original_price', [$price_from, $price_to]);
        }

        return $query;
    }

    public function sortingFilterQuery($query, $request)
    {
        $sort = isset($request->sort) ? $request->sort : 'best-sell'; /* best sell will use as defaut sorting */

        switch ($sort) {
            case 'best-sell':
                $query->sortBestSell();
                break;
            case 'price-asc':
                $query->priceAsc();
                break;
            case 'price-desc':
                $query->priceDesc();
                break;
        }

        return $query;
    }

    public function homePageListingQuery($query, $request)
    {
        ($request->lasth == 'y') ? $query->whereBetween('products.updated_at', [now()->subMonth(), now()]) : '';
        ($request->hoth == 'y') ? $query->hotProduct() : '';
        ($request->exch == 'y') ? $query->exclusive() : '';

        return $query;
    }

    public function getFilterBreadcrumb($request)
    {
        $locale_name = 'name_' . lngKey();

        $filter['name'] = null;
        $filter['url']  = null;

        /* this request come from header menu */
        $promotion_id = ($request->pf && $request->pf != 'all') ? (int) $request->pf : $request->pf;
        $category_id  = $request->catf ? (int) $request->catf : null;
        $country_id   = $request->cf ? (int) $request->cf : null;
        $region_id    = $request->rf ? (int) $request->rf : null;

        /* this request come from header home page view all lists */
        $latest         = ($request->lasth == 'y') ? true : false;
        $hot            = ($request->hoth == 'y') ? true : false;
        $exclusive_home = ($request->exch == 'y') ? true : false;

        $filter_array = [];
        $filter_name  = '';

        if ($promotion_id) {
            if ($promotion_id == 'all') {
                $filter['name'] = __('frontend.product.promotion');
                $filter['url']  = 'product?pf=all';
            } else {
                $promotion      = DB::table('promotions')->find($promotion_id);
                $filter['name'] = $promotion->$locale_name ?? null;
                $filter['url']  = 'product?pf=' . $promotion_id;
            }
            $filter_name = $filter['name'] ?? null;
            array_push($filter_array, $filter);
        } elseif ($category_id && $region_id) {
            $category = DB::table('categories')->find($category_id);
            $region   = DB::table('regions')->find($region_id);
            if ($category) {
                $filter['name'] = $category->$locale_name ?? null;
                $filter['url']  = 'product?catf=' . $category_id;
                array_push($filter_array, $filter);
            }
            if ($region) {
                $filter['url']  = 'product?rf=' . $region->id;
                $filter['name'] = $region->$locale_name ?? null;
                array_push($filter_array, $filter);
            }
            $filter_name = $region->$locale_name ?? null;

        } elseif ($category_id && $country_id) {
            $category = DB::table('categories')->find($category_id);
            $country  = DB::table('countries')->find($country_id);
            if ($category) {
                $filter['name'] = $category->$locale_name ?? null;
                $filter['url']  = 'product?catf=' . $category_id;
                array_push($filter_array, $filter);
            }
            if ($country) {
                $filter['url']  = 'product?rf=' . $country->id;
                $filter['name'] = $country->$locale_name ?? null;
                array_push($filter_array, $filter);
            }
            $filter_name = $country->$locale_name ?? null;

        } elseif ($category_id) {
            $category       = DB::table('categories')->find($category_id);
            $filter['name'] = $category->$locale_name ?? null;
            $filter['url']  = 'product?catf=' . $category_id;
            $filter_name    = $filter['name'] ?? null;
            array_push($filter_array, $filter);
        } elseif ($country_id) {
            $country        = DB::table('countries')->find($country_id);
            $filter['name'] = $country->$locale_name ?? null;
            $filter['url']  = 'product?cf=' . $country_id;
            $filter_name    = $filter['name'] ?? null;
            array_push($filter_array, $filter);
        } elseif ($region_id) {
            $region         = DB::table('regions')->find($region_id);
            $filter['name'] = $region->$locale_name ?? null;
            $filter['url']  = 'product?rf=' . $region_id;
            $filter_name    = $filter['name'] ?? null;
            array_push($filter_array, $filter);
        } elseif ($latest) {
            $filter['name'] = __('home.latest_product');
            $filter['url']  = 'product?lasth=y';
            $filter_name    = $filter['name'] ?? null;
            array_push($filter_array, $filter);
        } elseif ($hot) {
            $filter['name'] = __('home.hot_seller');
            $filter['url']  = 'product?hoth=y';
            $filter_name    = $filter['name'] ?? null;
            array_push($filter_array, $filter);
        } elseif ($exclusive_home) {
            $filter['name'] = __('home.exclusive_agency_product');
            $filter['url']  = 'product?exch=y';
            $filter_name    = $filter['name'] ?? null;
            array_push($filter_array, $filter);
        }

        return [
            'breadcrumb_array' => $filter_array,
            'breadcrumb_name'  => $filter_name,
        ];

    }

}
