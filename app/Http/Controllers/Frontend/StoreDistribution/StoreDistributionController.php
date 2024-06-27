<?php

namespace App\Http\Controllers\Frontend\StoreDistribution;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\StoreDistribution;

class StoreDistributionController extends Controller
{
    public function storeDistribution(Request $request)
    {
        $store_page = StoreDistribution::first(['banner_titles', 'titles', 'descriptions', 'banner_image', 'banner_image_alt', 'meta_titles', 'meta_descriptions', 'meta_image', 'meta_image_alt']);
        $stores  =  Store::active()->select('id', 'name_en', 'name_hant', 'name_hans', 'addresses', 'phone', 'store_image', 'store_image_alt')->orderBy('id', 'desc')->get();

        return view('frontend.store_distribution.index', compact('stores', 'store_page'));
    }
}
