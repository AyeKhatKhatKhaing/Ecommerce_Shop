<?php

namespace App\Http\Controllers\Frontend\Member;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\MemberType;
use DB;
use Illuminate\Support\Facades\Auth;

class MemberDashboardController extends Controller
{
    public function memberDashboard()
    {
        $member        = $this->getMember();
        $member_type   = $member->member_type;
        $member_types  = MemberType::active()->get();
        $gold_tier     = $member_types->whereIn('name_en', ['Gold', 'gold'])->first();
        $platinum_tier = $member_types->whereIn('name_en', ['Platinum', 'platinum'])->first();
        $orderStatus   = $this->getOrderStatusCount();

        return view('frontend.member.dashboard.index', compact('member', 'member_type', 'gold_tier', 'platinum_tier', 'orderStatus'));
    }

    public function membershipTier()
    {
        $member        = $this->getMember();
        $member_types  = MemberType::active()->get();
        $gold_tier     = $member_types->whereIn('name_en', ['Gold', 'gold'])->first();
        $platinum_tier = $member_types->whereIn('name_en', ['Platinum', 'platinum'])->first();

        return view('frontend.member.dashboard.membership-tier', compact('member', 'member_types', 'gold_tier', 'platinum_tier'));
    }

    public function getMember()
    {
        return Auth::guard('member')->user();
    }

    public function getOrderStatusCount()
    {
        $status_counts = DB::table('orders')
            ->selectRaw('count( case when order_status = 2 then 1 end) as awating_shipment')
            ->selectRaw('count( case when order_status = 3 then 1 end) as shipped')
            ->selectRaw('count( case when order_status = 4 then 1 end) as tobe_pickup')
            ->selectRaw('count( case when order_status = 5 then 1 end) as already_pickup')
            ->first();

        return $status_counts;
    }

}
