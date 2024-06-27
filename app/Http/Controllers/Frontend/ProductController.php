<?php

namespace App\Http\Controllers\Frontend;

use App\Events\ViewedProduct;
use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Product;
use App\Models\RecentView;
use App\Services\Frontend\ProductService;
use DB;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(Request $request)
    {
        $locale_name = "name_" . lngKey();
        $is_other    = false;

        $breadcrumb['name'] = null;
        $breadcrumb['url']  = null;

        $query       = Product::query()->active()->sort()->where('type', area())->select("*");

        $selected_promotions      = $request->pro ? array_map('intval', explode(',', $request->pro)) : [];
        $selected_categories      = $request->cat ? array_map('intval', explode(',', $request->cat)) : [];
        $exclusive                = ($request->exc == 'yes') ? true : false;
        $selected_countries       = $request->cou ? array_map('intval', explode(',', $request->cou)) : [];
        $selected_regions         = $request->reg ? array_map('intval', explode(',', $request->reg)) : [];
        $selected_classifications = $request->cla ? array_map('intval', explode(',', $request->cla)) : [];
        $selected_attributes      = $request->att ? array_map('intval', explode(',', $request->att)) : [];

        /* f - will use main filter id come from header menu */
        $promotion_id   = $request->pf;
        $category_id    = $request->catf;
        $country_id     = $request->cf;
        $region_id      = $request->rf;

        if ($promotion_id || count($selected_promotions) > 0) {
            $query->join('product_promotion as pp', 'products.id', '=', 'pp.product_id');
            (isset($promotion_id) && $promotion_id != 'all') ? $query->where('pp.promotion_id', $promotion_id) : '';
            count($selected_promotions) > 0 ? $query->whereIn('pp.promotion_id', $selected_promotions) : '';
        }

        if ($category_id || count($selected_categories) > 0) {
            $category = DB::table('categories')->find($category_id);
            $is_other = (boolean) (isset($category) ? $category->is_other : 0);

            $query->join('category_product as cp', 'products.id', '=', 'cp.product_id');
            (isset($category_id)) ? $query->where('cp.category_id', $category_id) : '';
            count($selected_categories) > 0 ? $query->whereIn('cp.category_id', $selected_categories) : '';
        }

        $exclusive ? $query->exclusive() : '';

        if ($country_id || count($selected_countries) > 0) {
            $country_id ? $query->where('country_id', $country_id) : '';
            count($selected_countries) > 0 ? $query->whereIn('country_id', $selected_countries) : '';
        }

        if ($region_id || count($selected_regions) > 0) {
            $region_id ? $query->where('region_id', $region_id) : '';
            count($selected_regions) > 0 ? $query->whereIn('region_id', $selected_regions) : '';
        }

        if (count($selected_classifications) > 0) {
            $query->join('classification_product as cp', 'products.id', '=', 'cp.product_id')
                ->whereIn('cp.classification_id', $selected_classifications);
        }
        if (count($selected_attributes) > 0) {
            $query->join('attribute_product as ap', 'products.id', '=', 'ap.product_id')->whereIn('ap.attribute_id', $selected_attributes);
        }

        $query = $this->productService->homePageListingQuery($query, $request); /* request value set y, those 3 will come from home page product listing */

        $query = $this->productService->sortingFilterQuery($query, $request); /* arrange sorting query */

        $query = $this->productService->ratingFilterQuery($query, $request); /* arrange rating filter then return query */

        $query = $this->productService->priceFilterQuery($query, $request); /* arrange price filter then return query */

        $is_other ? $query->isOther() : $query->isNotOther();

        $product_ids = $query->pluck('id', 'id')->toArray();
        $products    = $query->with(['label', 'product_meta'])->paginate(16);

        if (!$request->ajax()) {
            // dd($request->getMethod() , 'here');
            if ($promotion_id) {
                $filter_seo  = Page::where('page_type', 'promotion')->first();
            }else if ($category_id) {
                $filter_seo  = Page::where('page_type', 'category')->where('category_id', $category_id)->first();
            } else {
                $seo_product = $query->latest()->first(); /* to bind seo data */
            }

            $promotions      = $this->productService->getPromotions($product_ids);
            $categories      = $this->productService->getCategories($product_ids, $category_id);
            $classifications = $this->productService->getClassifications($product_ids);
            $attribute_terms = $this->productService->getAttributes($product_ids);
            $countries       = $this->productService->getCountries($product_ids);
            $regions         = $this->productService->getRegions($product_ids);
            $product_ratings = $this->productService->getProductRatings($product_ids);

            $breadcrumb = $this->productService->getFilterBreadcrumb($request);
        }

        $data = [
            'products'                 => $products,
            'seo_product'              => $seo_product ?? null,
            'filter_seo'               => $filter_seo ?? null,
            'promotions'               => $promotions ?? null,
            'categories'               => $categories ?? null,
            'classifications'          => $classifications ?? null,
            'attribute_terms'          => $attribute_terms ?? null,
            'countries'                => $countries ?? null,
            'regions'                  => $regions ?? null,
            'product_ratings'          => $product_ratings ?? null,
            'breadcrumb_array'         => (isset($breadcrumb['breadcrumb_array']) && $breadcrumb['breadcrumb_array']) > 0 ? $breadcrumb['breadcrumb_array'] : null,
            'breadcrumb_name'          => $breadcrumb['breadcrumb_name'] ?? null,
            'selected_promotions'      => $selected_promotions,
            'selected_categories'      => $selected_categories,
            'exclusive'                => $request->exc,
            'selected_countries'       => $selected_countries,
            'selected_regions'         => $selected_regions,
            'selected_classifications' => $selected_classifications,
            'selected_attributes'      => $selected_attributes,
            'is_other'                 => $is_other,
        ];

        if ($request->ajax()) {
            return view('frontend.product.product._list', ['products' => $products, 'locale_name' => $locale_name, 'is_other' => $is_other])->render();
        } else {
            return view('frontend.product.product.product_filter', $data);
        }

    }

    public function productDetail($code)
    {
        $shipping = DB::table('shippings')->where('country_type', area())->first();

        $product            = Product::with('country', 'product_meta', 'product_rating', 'categories', 'offer_promotion')->where('code', $code)->firstOrFail();
        $recommend_products = collect();
        $categories         = $product->categories->pluck('id')->toArray();

        if (auth()->guard('member')->check()) {
            $member       = auth()->guard('member')->user();
            $recent_views = RecentView::with(['product' => function ($query) {
                $query->select('id', 'name_en', 'name_hant', 'name_hans', 'sale_price', 'feature_image');
            }])
                ->where('member_id', $member->id)
                ->where('type', area())
                ->get();

            /* create recent view event */
            ViewedProduct::dispatch($member, $product);
        }

        $query = Product::query()->active()->sort()->where('type', area())->where('id', '!=', $product->id);

        if (isset($product->recommendations)) { /* recommendations section */
            $recommend_products = $query->whereIn('id', $product->recommendations)->limit(15)->get();
        }

        $related_products = $query->whereHas('categories', function ($query) use ($categories) { /* you may also like section */
            return $query->whereIn('id', $categories);
        })
            ->limit(15)
            ->get();

        $buy_products = $query->where('ordered_count', '!=', 0)->orderBy('ordered_count', 'desc')->limit(15)->get(); /* people also buy section */

        return view('frontend.product.product_detail.product_detail', [
            'recent_views'         => $recent_views ?? false,
            'product'              => $product,
            'recommend_products'   => $recommend_products,
            'buy_products'         => $buy_products,
            'related_products'     => $related_products,
            'free_shipping_amount' => $shipping->free_shipping_amount ?? 0,
        ]); /* use for product detail page */

    }

}
