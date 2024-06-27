<?php

namespace App\View\Components\Backend;

use DB;
use Illuminate\View\Component;

class PopularSearchCoupon extends Component
{
    public $most_use_coupons;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $coupons  = DB::table('coupons')->where('status', true)->where('per_coupon_usage', '!=', 0)->orderBy('per_coupon_usage', 'asc')->get();

        $this->most_use_coupons = $coupons;

        return view('components.backend.popular-search-coupon');
    }
}
