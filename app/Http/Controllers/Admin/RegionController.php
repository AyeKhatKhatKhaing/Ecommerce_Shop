<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RegionRequest;
use App\Interfaces\Repositories\RegionRepositoryInterface;
use App\Traits\AdminRolePermission;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    use AdminRolePermission;

    private RegionRepositoryInterface $regionRepository;

    public function __construct(RegionRepositoryInterface $regionRepository)
    {
        $this->regionRepository = $regionRepository;
    }

    public function index(Request $request)
    {
        if ($this->adminHasPermission('can_access_listing')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $data = $this->regionRepository->getAllRegionList($request);

        return view('admin.region.index', $data);
    }

    public function create()
    {
        if ($this->adminHasPermission('can_access_create')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $countries = $this->regionRepository->getRegionCreatePage();

        return view('admin.region.create', compact('countries'));
    }

    public function store(RegionRequest $request)
    {
        if ($this->adminHasPermission('can_access_create')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $this->regionRepository->saveRegionData($request);

        return redirect('admin/regions')->with('flash_message', 'Region added!');
    }

    public function edit($id)
    {
        if ($this->adminHasPermission('can_access_edit')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $data = $this->regionRepository->getRegionData($id);

        return view('admin.region.edit', $data);
    }

    public function update(RegionRequest $request, $id)
    {
        if ($this->adminHasPermission('can_access_edit')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $this->regionRepository->saveRegionData($request, $id);

        return redirect('admin/regions')->with('flash_message', 'Region updated!');
    }

    public function destroy($id)
    {
        if ($this->adminHasPermission('can_access_delete')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $this->regionRepository->deleteRegion($id);

        return redirect('admin/regions')->with('flash_message', 'Region deleted!');
    }

    public function statusChange(Request $request)
    {
        $region = $this->regionRepository->regionStatusChange($request);

        return response()->json([
            'success'   => true,
            'isPublish' => $region->status,
            'id'        => $region->id,
        ]);
    }
}
