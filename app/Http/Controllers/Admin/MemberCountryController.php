<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\Repositories\MemberCountryRepositoryInterface;
use App\Traits\AdminRolePermission;
use Illuminate\Http\Request;

class MemberCountryController extends Controller
{
    use AdminRolePermission;

    private MemberCountryRepositoryInterface $memberCountryRepository;

    public function __construct(MemberCountryRepositoryInterface $memberCountryRepository)
    {
        $this->memberCountryRepository = $memberCountryRepository;
    }

    public function index(Request $request)
    {
        if ($this->adminHasPermission('can_access_listing')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $data = $this->memberCountryRepository->getAllMemberCountryList($request);

        return view('admin.member-country.index', $data);
    }

    public function create()
    {
        if ($this->adminHasPermission('can_access_create')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        return view('admin.member-country.create');
    }

    public function store(Request $request)
    {
        if ($this->adminHasPermission('can_access_create')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $this->memberCountryRepository->saveMemberCountryData($request);

        return redirect('admin/member-country')->with('flash_message', 'MemberCountry added!');
    }

    public function edit($id)
    {
        if ($this->adminHasPermission('can_access_edit')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $membercountry = $this->memberCountryRepository->getMemberCountryData($id);

        return view('admin.member-country.edit', compact('membercountry'));
    }

    public function update(Request $request, $id)
    {
        if ($this->adminHasPermission('can_access_edit')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $this->memberCountryRepository->saveMemberCountryData($request, $id);

        return redirect('admin/member-country')->with('flash_message', 'MemberCountry updated!');
    }

    public function destroy($id)
    {
        if ($this->adminHasPermission('can_access_delete')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $this->memberCountryRepository->deleteMemberCountry($id);

        return redirect('admin/member-country')->with('flash_message', 'MemberCountry deleted!');
    }

    public function statusChange(Request $request)
    {
        $membercountry = $this->memberCountryRepository->memberCountryStatusChange($request);

        return response()->json([
            'success'   => true,
            'isPublish' => $membercountry->status,
            'id'        => $membercountry->id,
        ]);
    }
}
