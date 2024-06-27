<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactForm;
use App\Traits\AdminRolePermission;

class ContactFormSubmissionController extends Controller
{
    use AdminRolePermission;
    
    public function index(Request $request)
    {
        if($this->adminHasPermission('can_access_listing')){
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $keyword        = $request->search;
        $perPage        = $request->display ? $request->display : 10;
        $contact_form   = ContactForm::where(function ($query) use ($keyword) {
            if ($keyword != null) {
                $query->where('name', 'like', "%$keyword%");
            }
        })->latest('id')->paginate($perPage);

        return view('admin.contact-form-submission.index', compact('contact_form', 'keyword', 'perPage'));
    }
}
