<?php

namespace App\Http\Controllers\Admin;

use App\Enums\OrderStatusEnum;
use App\Exports\OrderReportExport;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Traits\AdminRolePermission;
use Excel;
use Illuminate\Http\Request;

class OrderReportController extends Controller
{
    use AdminRolePermission;

    public function index(Request $request)
    {
        if ($this->adminHasPermission('can_access_listing')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $keyword           = $request->get('search');
        $perPage           = $request->display ? $request->display : 10;
        $from_date         = $request->from_date ? $request->from_date : null;
        $to_date           = $request->to_date ? $request->to_date : null;
        $status            = $request->status == null ? 'all' : $request->status;
        $order_number      = $request->order_number ? $request->order_number : null;
        $order_type_filter = $request->order_type_filter == null ? 'all' : $request->order_type_filter;
        $location_filter   = $request->location_filter == null ? 'all' : $request->location_filter;
        $order_status      = OrderStatusEnum::values();

        $orders = Order::query()->notTrashed()->latest('id');

        $orders = $orders->where(function ($query) use ($keyword, $from_date, $to_date, $status, $order_number, $order_type_filter, $location_filter) {
            if ($keyword != null) {
                $query->where('code', 'LIKE', "%$keyword%")
                    ->orWhereHas('member', function ($que) use ($keyword) {
                        $que->where('first_name', 'LIKE', "%$keyword%")
                            ->orWhere('last_name', 'LIKE', "%$keyword%");
                    });
            }

            if ($from_date != null && $to_date != null) {
                $query->whereDate('created_date', '>=', $from_date)
                    ->whereDate('created_date', '<=', $to_date);
            }

            if ($status != 'all') {
                $query->where('order_status', $status);
            }

            if ($order_type_filter != 'all') {
                $query->where('is_whole_sale', $order_type_filter);
            }

            if ($location_filter != 'all') {
                $query->where('location', $location_filter);
            }

            if ($order_number != null) {
                $query->where('code', 'LIKE', "%$order_number%");
            }
        });

        if ($request->export) {
            if ($this->adminHasPermission('can_access_export')) {
                return redirect()->back()->with('warning', 'You are not allowed to access this process');
            }

            $file_name     = 'OrderReportExport' . date('Ymd');
            $order_exports = $orders->with('order_items')->get();
            return Excel::download(new OrderReportExport($order_exports), $file_name . '.xlsx');
        }

        $orders = $orders->with('order_items')->paginate($perPage);

        return view('admin.order-report.index', compact('orders', 'keyword', 'status', 'from_date', 'to_date', 'order_number', 'order_status', 'location_filter'));
    }
}
