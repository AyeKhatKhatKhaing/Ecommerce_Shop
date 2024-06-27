<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ProductExport;
use App\Exports\ProductSampleExport;
use App\Helpers\DataArrayHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductFormRequest;
use App\Imports\ProductImport;
use App\Imports\ProductValidationExcel;
use App\Models\AttributeTerm;
use App\Models\Product;
use App\Models\Region;
use App\Services\Admin\ProductService;
use App\Traits\AdminRolePermission;
use Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    use AdminRolePermission;

    protected $productService;

    public function __construct(ProductService $service)
    {
        $this->productService = $service;
    }

    public function index(Request $request)
    {
        if($this->adminHasPermission('can_access_listing')){
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $keyword         = $request->get('search');
        $perPage         = $request->display ? $request->display : 10;
        $type            = $request->type;
        $product_status  = $request->product_status == null ? 'all' : $request->product_status;
        $category_filter = $request->category_filter == null ? 'all' : $request->category_filter;
        $categories      = DataArrayHelper::getParentCategory();

        if (is_null($request->type)) {
            return redirect()->route('product.index', ['type' => 'hk']);
        }
        $import_errors = [];

        $products = Product::query()->isNotOther()->where('type', request('type'))->sort();

        $products->when(request('search'), function ($products) use ($product_status){
            $products->where('name_en', 'LIKE', '%' . request('search') . '%')
                ->orWhere('name_hant', 'LIKE', '%' . request('search') . '%')
                ->orWhere('name_hans', 'LIKE', '%' . request('search') . '%')
                ->orWhere('code', 'LIKE', '%' .request('search') . '%');

        });
        
        if ($product_status != 'all') {
            $products->where('product_status', $product_status);
        }

        if ($category_filter != 'all') {
            $products->whereHas('categories', function ($query) use ($category_filter) {
                $query->where('id', $category_filter);
            });
        }

        if ($request->type == 'hk') {
            if ($request->export) {
                if($this->adminHasPermission('can_access_export')){
                    return redirect()->back()->with('warning', 'You are not allowed to access this process');
                }

                $file_name       = 'HongKongProductExport' . date('Ymd');
                $product_exports = $products->with(['categories', 'classifications', 'attributes', 'product_meta', 'product_label', 'country', 'region'])->get();
                return Excel::download(new ProductExport($product_exports), $file_name . '.xlsx');
            }

            $products = $products->with(['categories', 'updateUser'])->paginate($perPage);

            return view('admin.product.hong-kong-product.index', compact('products', 'categories', 'keyword', 'type', 'import_errors'));
        }

        if ($request->type == 'ma') {
            if ($request->export) {
                if($this->adminHasPermission('can_access_export')){
                    return redirect()->back()->with('warning', 'You are not allowed to access this process');
                }

                $file_name       = 'MacauProductExport' . date('Ymd');
                $product_exports = $products->with(['categories', 'classifications', 'attributes', 'product_meta', 'product_label', 'country', 'region'])->get();
                return Excel::download(new ProductExport($product_exports), $file_name . '.xlsx');
            }

            $products = $products->with(['categories', 'updateUser'])->paginate($perPage);

            return view('admin.product.macau-product.index', compact('products', 'categories', 'keyword', 'type', 'import_errors'));
        }
    }

    public function create(Request $request)
    {
        if($this->adminHasPermission('can_access_create')){
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $type = $request->type;
        $data = $this->productService->getFormData($type);

        return view('admin.product.create', $data, compact('type'));
    }

    public function store(ProductFormRequest $request)
    {
        if($this->adminHasPermission('can_access_create')){
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $product = $this->productService->storeProductData($request);

        $this->productService->storeProductRelatedData($request, $product);

        if ($request->type == 'hk') {
            return redirect('admin/product?type=hk')->with('flash_message', 'Hong Kong Product added!');
        }

        if ($request->type == 'ma') {
            return redirect('admin/product?type=ma')->with('flash_message', 'Macau Product added!');
        }
    }

    public function edit(Request $request, $id)
    {
        if($this->adminHasPermission('can_access_edit')){
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $type                 = $request->type;
        $data                 = $this->productService->getFormData($type);
        $product              = Product::findOrFail($id);
        $region_list          = Region::active()->where('country_id', $product->country_id)->get();
        $promotion_array      = ($product->promotions->count() > 0) ? $product->promotions()->pluck('promotion_id', 'promotion_id')->toArray() : [];
        $classification_array = ($product->classifications->count() > 0) ? $product->classifications()->pluck('classification_id', 'classification_id')->toArray() : [];
        $category_array       = ($product->categories->count() > 0) ? $product->categories()->pluck('category_id', 'category_id')->toArray() : [];

        return view('admin.product.edit', $data, compact('type', 'region_list', 'product', 'promotion_array', 'classification_array', 'category_array'));
    }

    public function update(ProductFormRequest $request, $id)
    {
        if($this->adminHasPermission('can_access_edit')){
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $product = Product::with('promotions', 'classifications')->findOrFail($id);
        $product = $this->productService->storeProductData($request, $product);

        $this->productService->storeProductRelatedData($request, $product);

        if ($request->type == 'hk') {
            return redirect('admin/product?type=hk')->with('flash_message', 'Hong Kong Product updated!');
        }

        if ($request->type == 'ma') {
            return redirect('admin/product?type=ma')->with('flash_message', 'Macau Product updated!');
        }
    }

    public function destroy($id)
    {
        if($this->adminHasPermission('can_access_delete')){
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        Product::destroy($id);

        return redirect('admin/product')->with('flash_message', 'Product deleted!');
    }

    public function getAttribute(Request $request)
    {
        $html = $this->productService->getProductAttributeForm($request);

        echo $html;
    }

    public function getRegionList(Request $request)
    {
        $country_id = $request->country_id;

        $region_list = Region::where('country_id', $country_id)->where('status', true)->get(['id', 'country_id', 'name_en']);

        $returnHtml = view('admin.product._get_region_list')
            ->with('region_list', $region_list)
            ->render();

        return $returnHtml;
    }

    public function generateSample(Request $request)
    {
        if($this->adminHasPermission('can_access_export')){
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $file_name = 'ProductImportSample.xlsx';

        return Excel::download(new ProductSampleExport, $file_name);
    }

    public function importExcel(Request $request)
    {
        if($this->adminHasPermission('can_access_import')){
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $attribute_term = AttributeTerm::with('attributes')->pluck('id', 'name_en');

        $type = $request->type;

        $this->validate($request, [
            'file' => 'required|mimes:xlsx,xls',
        ]);

        if ($request->hasFile('file')) {

            $import     = Excel::toArray(new ProductValidationExcel(), $request->file);
            $data_array = $import[0];

            $errors = [];
            $row    = 1;
            $rules  = $this->productService->importRules();

            if (count($data_array) > 0) {
                foreach ($data_array as $key => $input) {
                    ++$row;
                    $messages = $this->productService->importValidationMessage($row);

                    $validator = Validator::make($input, $rules, $messages);

                    if ($validator->fails()) {
                        // return redirect()->back()->withErrors($validator->errors());
                        $errors[] = $validator->errors();
                    }
                }
            }

            if (count($errors) > 0) {
                return redirect()->back()->with(['import_errors' => $errors]);
            } else {
                session()->forget('rowCount');
                (new ProductImport($attribute_term))->queue($request->file);
            }

            $messages = 'Excel importing with ' . count($data_array) . ' rows in system background, please check back within a few minutes.';

            if ($type == 'hk') {
                return redirect(route('product.index', ['type' => 'hk']))->with('flash_message', $messages);
            } else {
                return redirect(route('product.index', ['type' => 'ma']))->with('flash_message', $messages);
            }
        }

        return redirect(route('product.index'))->with('warning', 'Product excel invalid!');
    }

    public function statusChange(Request $request)
    {
        $term = Product::findOrFail($request->id);
        $term->update(['status' => !$term->status]);

        return response()->json([
            'success'   => true,
            'isPublish' => $term->status,
            'id'        => $term->id,
        ]);
    }

    function updateproductSort(Request $request) {
        $product = Product::findOrFail($request->sort_id);
        $product->update(['sort' => $request->sort]);
        return response()->json([
            'success' => true
        ]);
    }
}
