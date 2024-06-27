<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TermConditionFormRequest;
use App\Interfaces\Repositories\TermConditionRepositoryInterface;
use App\Traits\AdminRolePermission;
use Illuminate\Http\Request;

class TermConditionController extends Controller
{
    use AdminRolePermission;

    private TermConditionRepositoryInterface $termConditionRepository;

    public function __construct(TermConditionRepositoryInterface $termConditionRepository)
    {
        $this->termConditionRepository = $termConditionRepository;
    }

    public function index(Request $request)
    {
        if ($this->adminHasPermission('can_access_listing')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $termcondition = $this->termConditionRepository->getTermConditionIndex();

        return view('admin.term-condition.edit', compact('termcondition'));
    }

    public function edit($id)
    {
        $termcondition = $this->termConditionRepository->getTermConditionData($id);

        return view('admin.term-condition.edit', compact('termcondition'));
    }

    public function update(TermConditionFormRequest $request)
    {
        if ($this->adminHasPermission('can_access_edit')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $this->termConditionRepository->saveTermConditionData($request);

        return redirect('admin/term-condition')->with('flash_message', 'TermCondition updated!');
    }

}
