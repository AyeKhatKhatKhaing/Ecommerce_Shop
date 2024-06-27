<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use App\Traits\AdminRolePermission;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
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

        $subscription = Subscription::with('member')->where(function ($query) use ($keyword, $status) {
            if ($keyword != null) {
                $query->where('email', 'like', "%$keyword%");
                $query->orWhereHas('member', function ($que) use ($keyword) {
                    $que->where('first_name', 'like', "%$keyword%")
                        ->orWhere('last_name', 'like', "%$keyword%");
                });
            }

            if ($status != 'all') {
                $query->where('status', $status);
            }
        })->latest('id')->paginate($perPage);

        return view('admin.subscription.index', compact('subscription', 'keyword', 'perPage', 'status'));
    }
}
