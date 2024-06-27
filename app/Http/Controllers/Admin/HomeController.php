<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\HomeFormRequest;
use App\Interfaces\Repositories\HomeRepositoryInterface;
use App\Traits\AdminRolePermission;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    use AdminRolePermission;

    private HomeRepositoryInterface $homeRepository;

    public function __construct(HomeRepositoryInterface $homeRepository)
    {
        $this->homeRepository = $homeRepository;
    }

    public function index(Request $request)
    {
        if ($this->adminHasPermission('can_access_listing')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $home = $this->homeRepository->getHomePageIndex();

        return view('admin.home.edit', compact('home'));
    }

    public function edit($id)
    {
        $home = $this->homeRepository->getHomePageData($id);

        return view('admin.home.edit', compact('home'));
    }

    public function update(HomeFormRequest $request)
    {
        if ($this->adminHasPermission('can_access_edit')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $this->homeRepository->saveHomePageData($request);

        return redirect('admin/home')->with('flash_message', 'Home updated!');
    }

    public function getBrandLogo(Request $request)
    {
        $index      = $request->index;
        $returnHtml = [];
        $html       = view('admin.home.brand-logo')
            ->with(["index" => $index])
            ->render();
        array_push($returnHtml, $html);
        return $returnHtml;
    }
}
