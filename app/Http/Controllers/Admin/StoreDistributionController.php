<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDistributionFormRequest;
use App\Interfaces\Repositories\StoreDistributionRepositoryInterface;
use App\Traits\AdminRolePermission;
use Illuminate\Http\Request;

class StoreDistributionController extends Controller
{
    use AdminRolePermission;

    private StoreDistributionRepositoryInterface $storeDistributionRepository;

    public function __construct(StoreDistributionRepositoryInterface $storeDistributionRepository)
    {
        $this->storeDistributionRepository = $storeDistributionRepository;
    }

    public function index(Request $request)
    {
        if ($this->adminHasPermission('can_access_listing')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $storedistribution = $this->storeDistributionRepository->getStoreDistributionIndex();

        return view('admin.store-distribution.edit', compact('storedistribution'));
    }

    public function edit($id)
    {
        $storedistribution = $this->storeDistributionRepository->getStoreDistributionData($id);

        return view('admin.store-distribution.edit', compact('storedistribution'));
    }

    public function update(StoreDistributionFormRequest $request)
    {
        if ($this->adminHasPermission('can_access_edit')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $this->storeDistributionRepository->saveStoreDistributionData($request);

        return redirect('admin/store-distribution')->with('flash_message', 'StoreDistribution updated!');
    }

}
