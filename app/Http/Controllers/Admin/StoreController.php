<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreFormRequest;
use App\Interfaces\Repositories\StoreRepositoryInterface;
use App\Models\Store;
use App\Traits\AdminRolePermission;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    use AdminRolePermission;

    private StoreRepositoryInterface $storeRepository;

    public function __construct(StoreRepositoryInterface $storeRepository)
    {
        $this->storeRepository = $storeRepository;
    }

    public function index(Request $request)
    {
        if ($this->adminHasPermission('can_access_listing')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $data = $this->storeRepository->getAllStoreList($request);

        return view('admin.store.index', $data);
    }

    public function create()
    {
        if ($this->adminHasPermission('can_access_create')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        return view('admin.store.create');
    }

    public function store(StoreFormRequest $request)
    {
        if ($this->adminHasPermission('can_access_create')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $this->storeRepository->saveStoreData($request);

        return redirect('admin/store')->with('flash_message', 'Store added!');
    }

    public function edit($id)
    {
        if ($this->adminHasPermission('can_access_edit')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $store = $this->storeRepository->getStoreData($id);

        return view('admin.store.edit', compact('store'));
    }

    public function update(StoreFormRequest $request, $id)
    {
        if ($this->adminHasPermission('can_access_edit')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $this->storeRepository->saveStoreData($request, $id);

        return redirect('admin/store')->with('flash_message', 'Store updated!');
    }

    public function destroy($id)
    {
        if ($this->adminHasPermission('can_access_delete')) {
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $this->storeRepository->deleteStore($id);

        return redirect('admin/store')->with('flash_message', 'Store deleted!');
    }

    public function statusChange(Request $request)
    {
        $store = $this->storeRepository->storeStatusChange($request);

        return response()->json([
            "success"   => true,
            'isPublish' => $store->status,
            'id'        => $store->id,
        ]);
    }
}
