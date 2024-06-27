<?php

namespace App\View\Components\Backend;

use Illuminate\View\Component;
use App\Models\Order;
use DB;

class OrderDashboard extends Component
{
    public $orders;
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
        $latest_orders    = Order::leftJoin('members', function ($join) {
            $join->on('members.id', "=", 'orders.member_id');
        })
        ->leftJoin('member_types', function ($join) {
            $join->on('members.member_type_id', "=", 'member_types.id');
        })
        ->select('orders.*', 'member_types.name_hant as member_type_name')
        ->where('order_status', !-1)
        ->whereBetween('orders.updated_at', [now()->subMonth(), now()])->get();
        
        $this->orders     = $latest_orders;

        return view('components.backend.order-dashboard');
    }
}
