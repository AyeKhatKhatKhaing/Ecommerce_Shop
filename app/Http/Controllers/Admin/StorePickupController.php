<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePickupRequest;
use App\Models\StorePickup;
use App\Traits\AdminRolePermission;
use Illuminate\Http\Request;

class StorePickupController extends Controller
{
    use AdminRolePermission;

    public function index(Request $request)
    {
        if($this->adminHasPermission('can_access_listing')){
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $keyword = $request->search;
        $perPage = $request->display ? $request->display : 10;
        $status  = $request->status == null ? 'all' : $request->status;
        $type    = $request->type == null ? 'all' : $request->type;

        $pickups = StorePickup::with('updateUser')->where(function ($query) use ($keyword, $status, $type) {
            if ($keyword != null) {
                $query->where('name_en', 'like', "%$keyword%")
                    ->orWhere('name_hans', 'like', "%$keyword%")
                    ->orWhere('name_hant', 'like', "%$keyword%")
                    ->orWhere('type', 'like', "%keyword%");
            }

            if ($status != 'all') {
                $query->where('status', $status);
            }

            if ($type != 'all') {
                $query->where('type', $type);
            }
        })->latest('id')->paginate($perPage);

        return view('admin.store-pickup.index', compact('pickups', 'keyword', 'status'));
    }

    public function create()
    {
        if($this->adminHasPermission('can_access_create')){
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        return view('admin.store-pickup.create');
    }

    public function store(StorePickupRequest $request)
    {
        if($this->adminHasPermission('can_access_create')){
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $request->merge(['created_by' => auth()->id(), 'created_date' => now()]);
        $requestData = $request->all();
        StorePickup::create($requestData);

        return redirect('admin/store-pickups')->with('flash_message', 'Store Pickup added!');
    }

    public function edit($id)
    {
        if($this->adminHasPermission('can_access_edit')){
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $pickup = StorePickup::findOrFail($id);

        return view('admin.store-pickup.edit', compact('pickup'));
    }

    public function update(Request $request, $id)
    {
        if($this->adminHasPermission('can_access_edit')){
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $pickup = StorePickup::findOrFail($id);
        $request->merge(['updated_by' => auth()->id(), 'status' => $pickup->status]);
        $requestData = $request->all();

        $pickup->update($requestData);

        return redirect('admin/store-pickups')->with('flash_message', 'Store Pickup updated!');
    }

    public function destroy($id)
    {
        if($this->adminHasPermission('can_access_delete')){
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        StorePickup::destroy($id);

        return redirect('admin/store-pickups')->with('flash_message', 'Store Pickup deleted!');
    }

    public function statusChange(Request $request)
    {
        $pickup = StorePickup::findOrFail($request->id);
        $pickup->update(['status' => !$pickup->status]);

        return response()->json([
            'success'   => true,
            'isPublish' => $pickup->status,
            'id'        => $pickup->id,
        ]);
    }
}
