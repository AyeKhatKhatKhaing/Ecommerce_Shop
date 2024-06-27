<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\ContactAddress;
use App\Traits\AdminRolePermission;
use Illuminate\Http\Request;

class ContactAddressController extends Controller
{
    use AdminRolePermission;

    public function index(Request $request)
    {
        if($this->adminHasPermission('can_access_listing')){
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }
        
        $keyword        = $request->get('search');
        $perPage        = $request->display ? $request->display : 10;

        $contactaddress = ContactAddress::where(function($query) use ($keyword) {
            if ($keyword != null) {
                $query->where('name_en', 'LIKE', "%$keyword%");
            }
        });

        $contactaddress = $contactaddress->with('updateUser')->latest('id')->paginate($perPage);

        return view('admin.contact-address.index', compact('contactaddress', 'keyword'));
    }


    public function create()
    {
        if($this->adminHasPermission('can_access_create')){
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        return view('admin.contact-address.create');
    }


    public function store(Request $request)
    {
        if($this->adminHasPermission('can_access_store')){
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $request->merge(['created_date' => now(), 'created_by' => auth()->user()->id]);
        $requestData = $request->all();
        
        ContactAddress::create($requestData);

        return redirect('admin/contact-address')->with('flash_message', 'ContactAddress added!');
    }


    public function edit($id)
    {
        if($this->adminHasPermission('can_access_edit')){
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $contactaddress = ContactAddress::findOrFail($id);

        return view('admin.contact-address.edit', compact('contactaddress'));
    }


    public function update(Request $request, $id)
    {
        if($this->adminHasPermission('can_access_edit')){
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $request->merge(['updated_by' => auth()->user()->id]);
        $requestData = $request->all();
        
        $contactaddress = ContactAddress::findOrFail($id);
        $contactaddress->update($requestData);

        return redirect('admin/contact-address')->with('flash_message', 'ContactAddress updated!');
    }


    public function destroy($id)
    {
        if($this->adminHasPermission('can_access_delete')){
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        ContactAddress::destroy($id);

        return redirect('admin/contact-address')->with('flash_message', 'ContactAddress deleted!');
    }


    public function statusChange(Request $request)
    {
        $contactaddress      = ContactAddress::findOrFail($request->id);
        $contactaddress->update(['status' => !$contactaddress->status]);

        return response()->json([
            "success"    => true,
            'isPublish'  => $contactaddress->status,
            'id'         => $contactaddress->id,
        ]);
    }
}
