<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MemberTypeFormRequest;
use App\Interfaces\Repositories\MemberTypeRepositoryInterface;
use App\Traits\AdminRolePermission;
use Illuminate\Http\Request;

class MemberTypeController extends Controller
{
    use AdminRolePermission;

    private MemberTypeRepositoryInterface $memberTypeRepository;

    public function __construct(MemberTypeRepositoryInterface $memberTypeRepository)
    {
        $this->memberTypeRepository = $memberTypeRepository;
    }

    public function index(Request $request)
    {
        if ($this->adminHasPermission('can_access_listing')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $data = $this->memberTypeRepository->getAllMemberTypeList($request);

        return view('admin.member-type.index', $data);
    }

    public function create()
    {
        if ($this->adminHasPermission('can_access_create')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        return view('admin.member-type.create');
    }

    public function store(MemberTypeFormRequest $request)
    {
        if ($this->adminHasPermission('can_access_create')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $this->memberTypeRepository->saveMemberTypeData($request);

        return redirect('admin/member-type')->with('flash_message', 'MemberType added!');
    }

    public function edit($id)
    {
        if ($this->adminHasPermission('can_access_edit')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $membertype = $this->memberTypeRepository->getMemberTypeData($id);

        return view('admin.member-type.edit', compact('membertype'));
    }

    public function update(MemberTypeFormRequest $request, $id)
    {
        if ($this->adminHasPermission('can_access_edit')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $this->memberTypeRepository->saveMemberTypeData($request, $id);

        return redirect('admin/member-type')->with('flash_message', 'MemberType updated!');
    }

    public function destroy($id)
    {
        if ($this->adminHasPermission('can_access_delete')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $this->memberTypeRepository->deleteMemberType($id);

        return redirect('admin/member-type')->with('flash_message', 'MemberType deleted!');
    }

    public function statusChange(Request $request)
    {
        $membertype = $this->memberTypeRepository->memberTypeStatusChange($request);

        return response()->json([
            "success"   => true,
            'isPublish' => $membertype->status,
            'id'        => $membertype->id,
        ]);
    }
}
