<?php

namespace App\View\Components\Backend;

use DB;
use Illuminate\View\Component;

class TopBestSellerDashboard extends Component
{
    public $popular_products;
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
        $products = DB::table('products')->where('status', true)->where('ordered_count', '!=', 0)->orderBy('ordered_count', 'asc')->get();

        $this->popular_products = $products;

        return view('components.backend.top-best-seller-dashboard');
    }
}
