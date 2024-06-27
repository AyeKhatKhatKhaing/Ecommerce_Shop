<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CommonProblemFormRequest;
use App\Interfaces\Repositories\CommonProblemRepositoryInterface;
use App\Traits\AdminRolePermission;
use Illuminate\Http\Request;

class CommonProblemController extends Controller
{
    use AdminRolePermission;

    private CommonProblemRepositoryInterface $commonRepository;

    public function __construct(CommonProblemRepositoryInterface $commonRepository)
    {
        $this->commonRepository = $commonRepository;
    }

    public function index(Request $request)
    {
        if ($this->adminHasPermission('can_access_listing')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $commonproblem = $this->commonRepository->getCommonProblemIndex($request);

        return view('admin.common-problem.edit', compact('commonproblem'));
    }

    public function edit($id)
    {
        $commonproblem = $this->commonRepository->getCommonProblemData($id);

        return view('admin.common-problem.edit', compact('commonproblem'));
    }

    public function update(CommonProblemFormRequest $request)
    {
        if ($this->adminHasPermission('can_access_edit')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $this->commonRepository->saveCommonProblemData($request);

        return redirect('admin/common-problem')->with('flash_message', 'CommonProblem updated!');
    }
}
