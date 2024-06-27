<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductLabelFormRequest;
use App\Interfaces\Repositories\ProductLabelRepositoryInterface;
use App\Traits\AdminRolePermission;
use Illuminate\Http\Request;

class ProductLabelController extends Controller
{
    use AdminRolePermission;

    private ProductLabelRepositoryInterface $productLabelRepository;

    public function __construct(ProductLabelRepositoryInterface $productLabelRepository)
    {
        $this->productLabelRepository = $productLabelRepository;
    }

    public function index(Request $request)
    {
        if ($this->adminHasPermission('can_access_listing')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $data = $this->productLabelRepository->getAllProductLabelList($request);

        return view('admin.product-label.index', $data);
    }

    public function create()
    {
        if ($this->adminHasPermission('can_access_create')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        return view('admin.product-label.create');
    }

    public function store(ProductLabelFormRequest $request)
    {
        if ($this->adminHasPermission('can_access_create')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $this->productLabelRepository->saveProductLabelData($request);

        return redirect('admin/product-label')->with('flash_message', 'ProductLabel added!');
    }

    public function edit($id)
    {
        if ($this->adminHasPermission('can_access_edit')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $productlabel = $this->productLabelRepository->getProductLabelData($id);

        return view('admin.product-label.edit', compact('productlabel'));
    }

    public function update(ProductLabelFormRequest $request, $id)
    {
        if ($this->adminHasPermission('can_access_edit')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $this->productLabelRepository->saveProductLabelData($request, $id);

        return redirect('admin/product-label')->with('flash_message', 'ProductLabel updated!');
    }

    public function destroy($id)
    {
        if ($this->adminHasPermission('can_access_delete')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $this->productLabelRepository->deleteProductLabel($id);

        return redirect('admin/product-label')->with('flash_message', 'ProductLabel deleted!');
    }

    public function statusChange(Request $request)
    {
        $productlabel = $this->productLabelRepository->productLabelStatusChange($request);

        return response()->json([
            "success"   => true,
            'isPublish' => $productlabel->status,
            'id'        => $productlabel->id,
        ]);
    }
}
