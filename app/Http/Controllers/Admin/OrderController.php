<?php

namespace App\Http\Controllers\Admin;

use App\Exports\OrderExport;
use App\Http\Controllers\Controller;
use App\Mail\OrderStatusMail;
use App\Models\Order;
use App\Models\SiteSetting;
use App\Traits\AdminRolePermission;
use Carbon\Carbon;
use Excel;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    use AdminRolePermission;

    public function index(Request $request)
    {
        if ($this->adminHasPermission('can_access_listing')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $keyword           = $request->get('search');
        $perPage           = $request->display ? $request->display : 10;
        $order_type        = $request->type;
        $from_date         = $request->from_date ? $request->from_date : null;
        $to_date           = $request->to_date ? $request->to_date : null;
        $status            = $request->status == null ? 'all' : $request->status;
        $order_type_filter = $request->order_type_filter == null ? 'all' : $request->order_type_filter;

        if (is_null($request->type)) {
            return redirect()->route('admin.order.index', ['type' => 'hk']);
        }

        $orders = Order::notTrashed()->with('member')->where('location', $order_type)->latest('id');

        $orders = $orders->where(function ($query) use ($keyword, $status, $from_date, $to_date, $order_type_filter) {
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
        });


        if ($request->type == 'hk') {
            if ($request->export) {
                if($this->adminHasPermission('can_access_export')){
                    return redirect()->back()->with('warning', 'You are not allowed to access this process');
                }

                $file_name    = 'HongKongOrderReport' . date('Ymd');
                $order_export = $orders->with('order_items')->get();
                return Excel::download(new OrderExport($order_export), $file_name . '.xlsx');
            }

            $orders = $orders->with('order_items')->paginate($perPage);

            return view('admin.order.hk-order.index', compact('orders', 'keyword', 'order_type', 'status', 'from_date', 'to_date', 'order_type_filter'));
        }

        if ($request->type == 'ma') {
            if ($request->export) {
                if($this->adminHasPermission('can_access_export')){
                    return redirect()->back()->with('warning', 'You are not allowed to access this process');
                }
                $file_name = 'MacauOrderReport' . date('Ymd');
                $order_export = $orders->with('order_items')->get();
                return Excel::download(new OrderExport($order_export), $file_name . '.xlsx');
            }

            $orders = $orders->with('order_items')->paginate($perPage);

            return view('admin.order.ma-order.index', compact('orders', 'keyword', 'order_type', 'status', 'from_date', 'to_date', 'order_type_filter'));
        }
    }

    public function show(Request $request, $id)
    {
        if ($this->adminHasPermission('can_access_view')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $order        = Order::find($id);
        $order_items  = $order ? $order->order_items : null;
        $order_type   = $request->type;
        $total_amount = 0;

        if ($order_type == 'ma') {
            $site_setting = SiteSetting::where('type', 'currency')->first();
            if ($site_setting && isset($site_setting->options['ma_rate'])) {
                $total_amount = ($order->total_amount * $site_setting->options['ma_rate']);
            } else {
                $total_amount = ($order->total_amount * 1.03); /* this is default ma currency rate */
            }
        }

        if (is_null($request->type)) {
            return redirect()->route('admin.order.show', ['type' => 'hk']);
        }

        return view('admin.order.show', compact('order', 'order_items', 'order_type', 'total_amount'));
    }

    public function orderStatusUpdate(Request $request) /* listing order status popup */
    {
        // if (!$request->order_status) {
        //     return redirect()->back()->with('warning', "Please select status, unsuccessfully.");
        // }

        $order_status = (int) $request->order_status ?? 1;
        $order        = Order::find($request->order_id);

        if ($order) {
            $order->update(['order_status' => $order_status, 'updated_at' => Carbon::now()]);

            $data = [
                'order'  => $order,
                'member' => $order->member,
                'status' => $order->getOrderStatusName($order->order_status),
            ];

            \Mail::to($order->member->email)->send(new OrderStatusMail($data));
        }

        return redirect()->back()->with('flash_message', "Status has been updated.");
    }

    public function sendStatusMail(Request $request, $id) /* send mail button popup */
    {
        if ($this->adminHasPermission('can_access_send')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $order  = Order::with('member')->find($id);
        $status = $request->order_status;
        $member = $order->member ? $order->member : null;

        if ($order) {
            $order->update(['order_status' => $status, 'updated_at' => Carbon::now()]);

            $data = [
                'order'  => $order,
                'member' => $member,
                'status' => $order->getOrderStatusName($order->order_status),
            ];

            \Mail::to($member->email)->send(new OrderStatusMail($data));

            $order->update(['is_email' => 1]);

            return redirect()->back()->with('flash_message', "Email Send Successfully.");
        }

        return redirect()->back()->with('warning', "Member doesn't exit.");
    }
}
