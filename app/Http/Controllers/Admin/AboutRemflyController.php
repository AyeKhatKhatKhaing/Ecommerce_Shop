<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AboutRemflyFormRequest;
use App\Interfaces\Repositories\AboutRemflyRepositoryInterface;
use App\Traits\AdminRolePermission;
use Illuminate\Http\Request;

class AboutRemflyController extends Controller
{
    use AdminRolePermission;

    private AboutRemflyRepositoryInterface $aboutRemflyRepository;

    public function __construct(AboutRemflyRepositoryInterface $aboutRemflyRepository)
    {
        $this->aboutRemflyRepository = $aboutRemflyRepository;
    }

    public function index(Request $request)
    {
        if ($this->adminHasPermission('can_access_listing')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $aboutremfly = $this->aboutRemflyRepository->getAboutRemflyIndex();

        return view('admin.about-remfly.edit', compact('aboutremfly'));
    }

    public function edit($id)
    {
        $aboutremfly = $this->aboutRemflyRepository->getAboutRemflyData($id);

        return view('admin.about-remfly.edit', compact('aboutremfly'));
    }

    public function update(AboutRemflyFormRequest $request)
    {
        if ($this->adminHasPermission('can_access_edit')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $this->aboutRemflyRepository->saveAboutRemflyData($request);

        return redirect('admin/about-remfly')->with('flash_message', 'AboutRemfly updated!');
    }

}
