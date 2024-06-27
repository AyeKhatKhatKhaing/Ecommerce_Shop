<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ProductReportExport;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Traits\AdminRolePermission;
use Excel;
use Illuminate\Http\Request;

class ProductReportController extends Controller
{
    use AdminRolePermission;

    public function index(Request $request)
    {
        if($this->adminHasPermission('can_access_listing')){
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $min_price       = $request->min_price ? $request->min_price : null;
        $max_price       = $request->max_price ? $request->max_price : null;
        $sku             = $request->sku ? $request->sku : null;
        $status          = $request->status  == null ? 'all' : $request->status;
        $perPage         = $request->display ? $request->display : 10;

        $products        = Product::where(function ($query) use ($min_price, $max_price, $sku, $status){
            if ($min_price != null) {
                $query->where('original_price', $min_price)
                      ->orWhere('sale_price', $min_price);
            }

            if ($max_price != null) {
                $query->where('original_price', $max_price)
                      ->orWhere('sale_price', $max_price);
            }

            if ($sku != null) {
                $query->where('sku', $sku);
            }

            if ($status != 'all') {
                $query->where('status', $status);
            }
        });

        if ($request->export) {
            if($this->adminHasPermission('can_access_export')){
                return redirect()->back()->with('warning', 'You are not allowed to access this process');
            }

            $file_name = 'ProductReport' . date('Ymd');
            return Excel::download(new ProductReportExport($products->get()), $file_name . '.xlsx');
        }

        $product_reports = $products->latest()->paginate($perPage);

        return view('admin.product-report.index', compact('product_reports', 'status', 'max_price', 'min_price', 'sku', 'perPage'));
    }
}
