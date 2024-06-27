<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Traits\AdminRolePermission;
use DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    use AdminRolePermission;
    /**
     * Display a listing of the resource.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('role:admin');
    }

    public function index()
    {
        if($this->adminHasPermission('can_access_listing')){
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }
        
        // $out_of_stock_product = DB::table('products')->where('sell_quantity', 0)->where('refill_quantity', 0)->get();
        $out_of_stock_product = DB::table('products')
            ->where('refill_quantity', 0)
            ->orWhere('refill_quantity', null)
            ->whereColumn('min_stock_quantity', 'sell_quantity')
            ->count();

        $sold_out_product     = DB::table('products')
            ->where('quantity', '0')
            ->count();
    
        return view('admin.dashboard.index', compact('out_of_stock_product', 'sold_out_product'));
    }

    public function getProductList()
    {
        // $products = DB::table('products')->where('sell_quantity', 0)->where('refill_quantity', 0)->get();
        $products = DB::table('products')
            ->where('refill_quantity', 0)
            ->orWhere('refill_quantity', null)
            ->whereColumn('min_stock_quantity', 'sell_quantity')
            ->get();

        $min_total   = $products->sortBy('quantity')->first();
        $product_ids = $products->pluck('id')->toArray();

        $html = view('admin.dashboard._get_product_list', [
            'products'           => $products,
            'min_total_quantity' => $min_total ? $min_total->quantity : 0,
            'product_ids'        => implode(',', $product_ids),
        ])->render();

        return response()->json([
            'success' => true,
            'html'    => $html,
        ]);
    }

    public function updateQuantity(Request $request)
    {
        $quantity    = (int) $request->quantity;
        $product_ids = $request->product_ids ? array_map('intval', explode(',', $request->product_ids)) : [];
        $products    = Product::whereIn('id', $product_ids)->get();

        foreach ($products as $product) {
            $refill_quantity = $product->sell_quantity + $quantity;
            $sell_quantity  = ($refill_quantity >= $product->quantity) ? $product->quantity : $refill_quantity;

            $product->update(['sell_quantity' => $sell_quantity, 'refill_quantity' => $quantity]);
        }

        return response()->json([
            'success' => true,
        ]);
    }

    public function getProductQuantityList()
    {
        $products = DB::table('products')
        ->where('quantity', 0)
        ->get();

        $min_total   = $products->sortBy('quantity')->first();
        $product_ids = $products->pluck('id')->toArray();

        $html = view('admin.dashboard._get_product_list', [
            'products'           => $products,
            'min_total_quantity' => $min_total ? $min_total->quantity : 0,
            'product_ids'        => implode(',', $product_ids),
        ])->render();

        return response()->json([
            'success' => true,
            'html'    => $html,
        ]);
    }
}
