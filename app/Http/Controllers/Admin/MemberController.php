<?php

namespace App\Http\Controllers\Admin;

use App\Exports\MemberExport;
use App\Exports\MemberSampleExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MemberFormRequest;
use App\Imports\MemberImport;
use App\Interfaces\Repositories\MemberRepositoryInterface;
use App\Models\Member;
use App\Traits\AdminRolePermission;
use Excel;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    use AdminRolePermission;

    private MemberRepositoryInterface $memberRepository;

    public function __construct(MemberRepositoryInterface $memberRepository)
    {
        $this->memberRepository = $memberRepository;
    }

    public function index(Request $request)
    {
        if ($this->adminHasPermission('can_access_listing')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $data = $this->memberRepository->getAllMemberList($request);

        if ($request->export) {

            if ($this->adminHasPermission('can_access_export')) {
                return redirect()->back()->with('warning', 'You are not allowed to access this process');
            }

            $file_name = 'MemberReport' . date('Ymd');
            return Excel::download(new MemberExport($data['member']->latest('id')->get()), $file_name . '.xlsx');
        }

        return view('admin.member.index', $data);
    }

    public function create()
    {
        if ($this->adminHasPermission('can_access_create')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $data = $this->memberRepository->createMemberPage();

        return view('admin.member.create', $data);
    }

    public function store(MemberFormRequest $request)
    {
        if ($this->adminHasPermission('can_access_create')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $this->memberRepository->saveMemberData($request);

        return redirect('admin/member')->with('flash_message', 'Member added!');
    }

    public function show($id)
    {
        $member = Member::findOrFail($id);

        return view('admin.member.show', compact('member'));
    }

    public function edit($id)
    {
        if ($this->adminHasPermission('can_access_edit')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $data = $this->memberRepository->getMemberData($id);

        return view('admin.member.edit', $data);
    }

    public function update(Request $request, $id)
    {
        if ($this->adminHasPermission('can_access_edit')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $this->memberRepository->saveMemberData($request, $id);

        return redirect('admin/member')->with('flash_message', 'Member updated!');
    }

    public function destroy($id)
    {
        if ($this->adminHasPermission('can_access_delete')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $this->memberRepository->deleteMember($id);

        return redirect('admin/member')->with('flash_message', 'Member deleted!');
    }

    public function statusChange(Request $request)
    {
        $member = $this->memberRepository->memberStatusChange($request);

        return response()->json([
            "success"   => true,
            'isPublish' => $member->status,
            'id'        => $member->id,
        ]);
    }

    public function generateSample(Request $request)
    {
        if ($this->adminHasPermission('can_access_export')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $file_name = 'MemberImportSample.xlsx';

        return Excel::download(new MemberSampleExport, $file_name);
    }

    public function importExcel(Request $request)
    {
        if ($this->adminHasPermission('can_access_import')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $this->validate($request, [
            'file' => 'required|mimes:xlsx,xls',
        ]);

        if ($request->hasFile('file')) {

            Excel::import(new MemberImport, $request->file);

            return redirect(route('member.index'))->with('flash_message', 'Member excel imported successfully!');
        }

        return redirect(route('member.index'))->with('warning', 'Member excel invalid!');
    }
}
