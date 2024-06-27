<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BlogCategoryFormRequest;
use App\Interfaces\Repositories\BlogCategoryRepositoryInterface;
use App\Traits\AdminRolePermission;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

class BlogCategoryController extends Controller
{
    use AdminRolePermission;

    private BlogCategoryRepositoryInterface $blogCategoryRepository;

    public function __construct(BlogCategoryRepositoryInterface $blogCategoryRepository)
    {
        $this->blogCategoryRepository = $blogCategoryRepository;
    }
    
    public function index(Request $request)
    {
        if($this->adminHasPermission('can_access_listing')){
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }
        
        $data   = $this->blogCategoryRepository->getAllCategoryList($request);

        return view('admin.blog-category.index', $data);
    }


    public function create()
    {
        if($this->adminHasPermission('can_access_create')){
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        return view('admin.blog-category.create');
    }


    public function store(BlogCategoryFormRequest $request)
    {
        if($this->adminHasPermission('can_access_create')){
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $this->blogCategoryRepository->saveCategoryData($request);

        return redirect('admin/blog-category')->with('flash_message', 'BlogCategory added!');
    }


    public function edit($id)
    {
        if($this->adminHasPermission('can_access_edit')){
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $blogcategory = $this->blogCategoryRepository->getCategoryData($id);

        return view('admin.blog-category.edit', compact('blogcategory'));
    }


    public function update(BlogCategoryFormRequest $request, $id)
    {
        if($this->adminHasPermission('can_access_edit')){
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $this->blogCategoryRepository->saveCategoryData($request, $id);

        return redirect('admin/blog-category')->with('flash_message', 'BlogCategory updated!');
    }


    public function destroy($id)
    {
        if($this->adminHasPermission('can_access_delete')){
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $this->blogCategoryRepository->deleteCategory($id);

        return redirect('admin/blog-category')->with('flash_message', 'BlogCategory deleted!');
    }

    public function statusChange(Request $request)
    {
        $blogcategory  = $this->blogCategoryRepository->categoryStatusChange($request);

        return response()->json([
            "success"    => true,
            'isPublish'  => $blogcategory->status,
            'id'         => $blogcategory->id,
        ]);
    }
}
