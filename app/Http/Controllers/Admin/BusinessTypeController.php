<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BusinessTypeRequest;
use App\Interfaces\Repositories\BusinessTypeRepositoryInterface;
use App\Traits\AdminRolePermission;
use Illuminate\Http\Request;

class BusinessTypeController extends Controller
{
    use AdminRolePermission;

    private BusinessTypeRepositoryInterface $businessTypeRepository;

    public function __construct(BusinessTypeRepositoryInterface $businessTypeRepository)
    {
        $this->businessTypeRepository = $businessTypeRepository;
    }

    public function index(Request $request)
    {
        if ($this->adminHasPermission('can_access_listing')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $data = $this->businessTypeRepository->getAllBusinessTypeList($request);

        return view('admin.business-type.index', $data);
    }

    public function create()
    {
        if ($this->adminHasPermission('can_access_create')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        return view('admin.business-type.create');
    }

    public function store(BusinessTypeRequest $request)
    {
        if ($this->adminHasPermission('can_access_create')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $this->businessTypeRepository->saveBusinessTypeData($request);

        return redirect('admin/business-types')->with('flash_message', 'Business Type added!');
    }

    public function edit($id)
    {
        if ($this->adminHasPermission('can_access_edit')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $type = $this->businessTypeRepository->getBusinessTypeData($id);

        return view('admin.business-type.edit', compact('type'));
    }

    public function update(BusinessTypeRequest $request, $id)
    {
        if ($this->adminHasPermission('can_access_edit')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $this->businessTypeRepository->saveBusinessTypeData($request, $id);

        return redirect('admin/business-types')->with('flash_message', 'Business Type updated!');
    }

    public function destroy($id)
    {
        if ($this->adminHasPermission('can_access_delete')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $this->businessTypeRepository->deleteBusinessType($id);

        return redirect('admin/business-types')->with('flash_message', 'Business Type deleted!');
    }

    public function statusChange(Request $request)
    {
        $type = $this->businessTypeRepository->businessTypeStatusChange($request);

        return response()->json([
            'success'   => true,
            'isPublish' => $type->status,
            'id'        => $type->id,
        ]);
    }
}
