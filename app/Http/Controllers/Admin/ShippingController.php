<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ShippingFormRequest;
use App\Models\Shipping;
use App\Traits\AdminRolePermission;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
    use AdminRolePermission;

    public function index(Request $request)
    {
        if($this->adminHasPermission('can_access_listing')){
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $keyword   = $request->search;
        $perPage   = $request->display ? $request->display : 10;
        $status    = $request->status == null ? "all" : $request->status;

        $shipping  = Shipping::with('updateUser')->where(function ($query) use ($keyword) {
            if ($keyword != '') {
                $query->where('country_type', 'LIKE', "%$keyword%")
                ->orWhere('currency_type', 'LIKE', "%$keyword%")
                ->orWhere('amount', 'LIKE', "%$keyword%");
            }
        })->latest()->paginate($perPage);;

        return view('admin.shipping.index', compact('shipping', 'keyword', 'status'));
    }

    public function create()
    {
        if($this->adminHasPermission('can_access_create')){
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        return view('admin.shipping.create');
    }

    public function store(ShippingFormRequest $request)
    {
        if($this->adminHasPermission('can_access_create')){
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $request->merge(['created_date' => now(), 'created_by' => auth()->user()->id]);
        $requestData = $request->all();

        Shipping::create($requestData);

        return redirect('admin/shipping')->with('flash_message', 'Shipping added!');
    }

    public function edit($id)
    {
        if($this->adminHasPermission('can_access_edit')){
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $shipping = Shipping::findOrFail($id);

        return view('admin.shipping.edit', compact('shipping'));
    }

    public function update(ShippingFormRequest $request, $id)
    {
        if($this->adminHasPermission('can_access_edit')){
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $request->merge(['updated_by' => auth()->user()->id]);
        $requestData = $request->all();

        $shipping = Shipping::findOrFail($id);
        $shipping->update($requestData);

        return redirect('admin/shipping')->with('flash_message', 'Shipping updated!');
    }

    public function destroy($id)
    {
        if($this->adminHasPermission('can_access_delete')){
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        Shipping::destroy($id);

        return redirect('admin/shipping')->with('flash_message', 'Shipping deleted!');
    }

    public function statusChange(Request $request)
    {
        $shipping = Shipping::findOrFail($request->id);
        $shipping->update(['status' => !$shipping->status]);

        return response()->json([
            "success"   => true,
            'isPublish' => $shipping->status,
            'id'        => $shipping->id,
        ]);
    }
}
