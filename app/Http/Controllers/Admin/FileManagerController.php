<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\AdminRolePermission;
use Illuminate\Http\Request;

class FileManagerController extends Controller
{
    use AdminRolePermission;
    
    public function __construct()
    {
        // $this->middleware('auth');
    }


    public function filemanager(Request $request)
    {
        if($this->adminHasPermission('can_access_listing')){
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        return view('admin.filemanager.filemanager');
    }
}
