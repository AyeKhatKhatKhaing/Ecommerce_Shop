<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\DataArrayHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryFormRequest;
use App\Interfaces\Repositories\ProductCategoryRepositoryInterface;
use App\Traits\AdminRolePermission;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use AdminRolePermission;

    private ProductCategoryRepositoryInterface $categoryRepository;

    public function __construct(ProductCategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index(Request $request)
    {
        if ($this->adminHasPermission('can_access_listing')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $data = $this->categoryRepository->getAllCategoryList($request);

        return view('admin.category.index', $data);
    }

    public function create()
    {
        if ($this->adminHasPermission('can_access_create')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $categories = DataArrayHelper::getParentCategoryArray();

        return view('admin.category.create', compact('categories'));
    }

    public function store(CategoryFormRequest $request)
    {
        if ($this->adminHasPermission('can_access_create')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $this->categoryRepository->saveCategoryData($request);

        return redirect('admin/category')->with('flash_message', 'Category added!');
    }

    public function edit($id)
    {
        if ($this->adminHasPermission('can_access_edit')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $category   = $this->categoryRepository->getCategoryData($id);
        $categories = DataArrayHelper::getParentCategoryArray();

        return view('admin.category.edit', compact('category', 'categories'));
    }

    public function update(CategoryFormRequest $request, $id)
    {
        if ($this->adminHasPermission('can_access_edit')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $this->categoryRepository->saveCategoryData($request, $id);

        return redirect('admin/category')->with('flash_message', 'Category updated!');
    }

    public function destroy($id)
    {
        if ($this->adminHasPermission('can_access_delete')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $this->categoryRepository->deleteCategory($id);

        return redirect('admin/category')->with('flash_message', 'Category deleted!');
    }

    public function statusChange(Request $request)
    {
        $category = $this->categoryRepository->categoryStatusChange($request);

        return response()->json([
            "success"   => true,
            'isPublish' => $category->status,
            'id'        => $category->id,
        ]);
    }
}
