<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BlogFormRequest;
use App\Interfaces\Repositories\BlogRepositoryInterface;
use App\Traits\AdminRolePermission;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    use AdminRolePermission;

    private BlogRepositoryInterface $blogRepository;

    public function __construct(BlogRepositoryInterface $blogRepository)
    {
        $this->blogRepository = $blogRepository;
    }

    public function index(Request $request)
    {
        if ($this->adminHasPermission('can_access_listing')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $data = $this->blogRepository->getAllBlogList($request);

        return view('admin.blog.index', $data);
    }

    public function create()
    {
        if ($this->adminHasPermission('can_access_create')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $blogcategory = $this->blogRepository->createBlogPage();

        return view('admin.blog.create', compact('blogcategory'));
    }

    public function store(BlogFormRequest $request)
    {
        if ($this->adminHasPermission('can_access_create')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $this->blogRepository->saveBlogData($request);

        return redirect('admin/blog')->with('flash_message', 'Blog added!');
    }

    public function edit($id)
    {
        if ($this->adminHasPermission('can_access_edit')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $data = $this->blogRepository->getBlogData($id);

        return view('admin.blog.edit', $data);
    }

    public function update(BlogFormRequest $request, $id)
    {
        if ($this->adminHasPermission('can_access_edit')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $this->blogRepository->saveBlogData($request, $id);

        return redirect('admin/blog')->with('flash_message', 'Blog updated!');
    }

    public function destroy($id)
    {
        if ($this->adminHasPermission('can_access_delete')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $this->blogRepository->deleteBlog($id);

        return redirect('admin/blog')->with('flash_message', 'Blog deleted!');
    }

    public function statusChange(Request $request)
    {
        $blog = $this->blogRepository->blogStatusChange($request);

        return response()->json([
            "success"   => true,
            'isPublish' => $blog->status,
            'id'        => $blog->id,
        ]);
    }
}
