<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PageFormRequest;
use App\Interfaces\Repositories\PageRepositoryInterface;
use App\Traits\AdminRolePermission;
use Illuminate\Http\Request;

class PageController extends Controller
{
    use AdminRolePermission;

    private PageRepositoryInterface $pageRepository;

    public function __construct(PageRepositoryInterface $pageRepository)
    {
        $this->pageRepository = $pageRepository;
    }

    public function index(Request $request)
    {
        if ($this->adminHasPermission('can_access_listing')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $data = $this->pageRepository->getAllPageList($request);

        return view('admin.page.index', $data);
    }

    public function create()
    {
        if ($this->adminHasPermission('can_access_create')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $categories = $this->pageRepository->createPage();

        return view('admin.page.create', compact('categories'));
    }

    public function store(PageFormRequest $request)
    {
        if ($this->adminHasPermission('can_access_create')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $this->pageRepository->savePageData($request);

        return redirect('admin/page')->with('flash_message', 'Page added!');
    }

    public function edit($id)
    {
        if ($this->adminHasPermission('can_access_edit')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $data = $this->pageRepository->getPageData($id);

        return view('admin.page.edit', $data);
    }

    public function update(PageFormRequest $request, $id)
    {
        if ($this->adminHasPermission('can_access_edit')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $this->pageRepository->savePageData($request, $id);

        return redirect('admin/page')->with('flash_message', 'Page updated!');
    }

    public function destroy($id)
    {
        if ($this->adminHasPermission('can_access_delete')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $this->pageRepository->deletePage($id);

        return redirect('admin/page')->with('flash_message', 'Page deleted!');
    }

    public function statusChange(Request $request)
    {
        $page = $this->pageRepository->pageStatusChange($request);

        return response()->json([
            "success"   => true,
            'isPublish' => $page->status,
            'id'        => $page->id,
        ]);
    }
}
