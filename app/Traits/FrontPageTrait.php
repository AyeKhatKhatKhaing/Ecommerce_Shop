<?php

namespace App\Traits;

use App\Models\Home;
use App\Models\Product;
use App\Models\Slider;

trait FrontPageTrait
{
    public function getHomePageData()
    {
        $sliders = Slider::select('names', 'titles', 'descriptions', 'link', 'banner_image', 'banner_image_alt', 'mb_banner_image', 'mb_banner_image_alt')->where('status', 1)->get();
        $home    = Home::first();

        $latest_products    = Product::active()->sort()->isNotOther()->with('label')->where('type', area())->whereBetween('updated_at', [now()->subMonth(), now()])->take(10)->get();
        $exclusive_products = Product::active()->sort()->isNotOther()->with('label')->where('type', area())->exclusive()->take(10)->get();
        $hot_sellers        = Product::active()->sort()->isNotOther()->with('label')->where('type', area())
            ->hotProduct()
            ->take(10)
            ->get();

        $data = [
            'sliders'            => $sliders,
            'home'               => $home,
            'latest_products'    => $latest_products,
            'hot_sellers'        => $hot_sellers,
            'exclusive_products' => $exclusive_products,
        ];

        return $data;
    }

}
