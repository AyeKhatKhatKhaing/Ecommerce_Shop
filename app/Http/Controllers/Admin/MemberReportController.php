<?php

namespace App\Http\Controllers\Admin;

use App\Exports\MemberReportExport;
use App\Helpers\DataArrayHelper;
use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Traits\AdminRolePermission;
use Excel;
use Illuminate\Http\Request;

class MemberReportController extends Controller
{
    use AdminRolePermission;
    
    public function index(Request $request)
    {
        if($this->adminHasPermission('can_access_listing')){
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $keyword            = $request->get('search');
        $perPage            = $request->display ? $request->display : 10;
        $status             = $request->status == null ? "all" : $request->status;
        $member_type_filter = $request->member_type_filter == null ? "all" : $request->member_type_filter;
        $member_types       = DataArrayHelper::getMemberType();

        $member = Member::where(function ($query) use ($keyword, $status, $member_type_filter) {
            if ($keyword != null) {
                $query->where('code', 'LIKE', "%$keyword%")
                    ->orWhere('first_name', 'LIKE', "%$keyword%")
                    ->orWhere('last_name', 'LIKE', "%$keyword%")
                    ->orWhere('email', 'LIKE', "%$keyword%")
                    ->orWhereHas('member_type', function ($que) use ($keyword) {
                        $que->where('name_en', 'LIKE', "%$keyword%");
                    });
            }

            if ($status != "all") {
                $query->where('status', $status);
            }

            if ($member_type_filter != "all") {
                $query->where('member_type_id', $member_type_filter);
            }
        });

        if ($request->export) {
            if($this->adminHasPermission('can_access_export')){
                return redirect()->back()->with('warning', 'You are not allowed to access this process');
            }

            $file_name = 'MemberReportExcel' . date('Ymd');
            return Excel::download(new MemberReportExport($member->get()), $file_name . '.xlsx');
        }

        $member = $member->with('member_type')->latest('id')->paginate($perPage);

        return view('admin.member-report.index', compact('member', 'member_types', 'keyword', 'status', 'member_type_filter'));
    }
}
