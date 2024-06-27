<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ProductExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\OtherProductFormRequest;
use App\Models\Product;
use App\Models\Region;
use App\Traits\AdminRolePermission;
use App\Services\Admin\OtherProductService;
use Excel;
use Illuminate\Http\Request;

class OtherProductController extends Controller
{
    use AdminRolePermission;

    protected $otherProductService;

    public function __construct(OtherProductService $otherProductService)
    {
        $this->otherProductService = $otherProductService;
    }

    public function index(Request $request)
    {
        if($this->adminHasPermission('can_access_listing')){
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $keyword = $request->get('search');
        $perPage = $request->display ? $request->display : 10;
        $type    = $request->type;
        $status  = $request->status == null ? 'all' : $request->status;

        $other_products = Product::query()->where('is_other', 1)->sort();

        $other_products->when(request('search'), function ($products) use ($status) {
            $products->where('name_en', 'LIKE', '%' . request('search') . '%')
                ->orWhere('name_hant', 'LIKE', '%' . request('search') . '%')
                ->orWhere('name_hans', 'LIKE', '%' . request('search') . '%');
        });

        if ($status != 'all') {
            $other_products = $other_products->where('type', $status);
        }

        if ($request->export) {

            if($this->adminHasPermission('can_access_export')){
                return redirect()->back()->with('warning', 'You are not allowed to access this process');
            }

            $file_name       = 'OtherProductExport' . date('Ymd');
            $product_exports = $other_products->with(['categories', 'classifications', 'attributes', 'product_meta', 'product_label', 'country', 'region'])->get();
            return Excel::download(new ProductExport($product_exports), $file_name . '.xlsx');
        }

        $other_products = $other_products->with('categories')->paginate($perPage);

        return view('admin.other-product.index', compact('other_products', 'keyword'));
    }

    public function create()
    {
        if($this->adminHasPermission('can_access_create')){
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $data = $this->otherProductService->getFormData();

        return view('admin.other-product.create', $data);
    }

    public function store(OtherProductFormRequest $request)
    {
        if($this->adminHasPermission('can_access_create')){
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $other_product = $this->otherProductService->storeProductData($request);

        $this->otherProductService->storeProductRelatedData($request, $other_product);

        return redirect('admin/other-product')->with('flash_message', 'Other Product added!');
    }

    public function edit($id)
    {
        if($this->adminHasPermission('can_access_edit')){
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $data                 = $this->otherProductService->getFormData();
        $other_product        = Product::findOrFail($id);
        $region_list          = Region::active()->where('country_id', $other_product->country_id)->get();
        $promotion_array      = ($other_product->promotions->count() > 0) ? $other_product->promotions()->pluck('promotion_id', 'promotion_id')->toArray() : [];
        $classification_array = ($other_product->classifications->count() > 0) ? $other_product->classifications()->pluck('classification_id', 'classification_id')->toArray() : [];
        $category_array       = ($other_product->categories->count() > 0) ? $other_product->categories()->pluck('category_id', 'category_id')->toArray() : [];

        return view('admin.other-product.edit', $data, compact('other_product', 'promotion_array', 'classification_array', 'category_array', 'region_list'));
    }

    public function update(OtherProductFormRequest $request, $id)
    {
        if($this->adminHasPermission('can_access_edit')){
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $other_product = Product::with('promotions', 'classifications')->findOrFail($id);
        $other_product = $this->otherProductService->storeProductData($request, $other_product);

        $this->otherProductService->storeProductRelatedData($request, $other_product);

        return redirect('admin/other-product')->with('flash_message', 'Other Product updated!');
    }

    public function destroy($id)
    {
        if($this->adminHasPermission('can_access_delete')){
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        Product::destroy($id);

        return redirect('admin/other-product')->with('flash_message', 'Other Product deleted!');
    }

    public function getAttribute(Request $request)
    {
        $html = $this->otherProductService->getProductAttributeForm($request);

        echo $html;
    }

    public function getRegionList(Request $request)
    {
        $country_id  = $request->country_id;
        $region_list = Region::active()->where('country_id', $country_id)->get(['id', 'country_id', 'name_en']);

        $returnHtml  = view('admin.other-product._other_product_region_list')
            ->with('region_list', $region_list)
            ->render();

        return $returnHtml;
    }

    public function statusChange(Request $request)
    {
        $other_product = Product::findOrFail($request->id);
        $other_product->update(['status' => !$other_product->status]);

        return response()->json([
            'success'   => true,
            'isPublish' => $other_product->status,
            'id'        => $other_product->id,
        ]);
    }

    public function updateSorting(Request $request)
    {
        $product_id  = $request->product_id;
        $sort_number = $request->sort_number;

        $other_product = Product::find($product_id);

        $other_product->update(['sort' => $sort_number]);

        return response()->json([
            'success' => true,
        ]);
    }

}
