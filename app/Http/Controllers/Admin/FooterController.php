<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FooterFormRequest;
use App\Interfaces\Repositories\FooterRepositoryInterface;
use App\Traits\AdminRolePermission;
use Illuminate\Http\Request;

class FooterController extends Controller
{
    use AdminRolePermission;

    private FooterRepositoryInterface $footerRepository;

    public function __construct(FooterRepositoryInterface $footerRepository)
    {
        $this->footerRepository = $footerRepository;
    }

    public function index(Request $request)
    {
        if ($this->adminHasPermission('can_access_listing')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $footer = $this->footerRepository->getFooterIndex();

        return view('admin.footer.edit', compact('footer'));
    }

    public function edit($id)
    {
        $footer = $this->footerRepository->getFooterData($id);

        return view('admin.footer.edit', compact('footer'));
    }

    public function update(FooterFormRequest $request)
    {
        if ($this->adminHasPermission('can_access_edit')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $this->footerRepository->saveFooterData($request);

        return redirect('admin/footer')->with('flash_message', 'Footer updated!');
    }

}
