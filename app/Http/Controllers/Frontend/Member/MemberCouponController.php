<?php

namespace App\Http\Controllers\Frontend\Member;

use App\Http\Controllers\Controller;
use App\Models\CouponHistory;
use Illuminate\Http\Request;

class MemberCouponController extends Controller
{
    public function memberCoupon(Request $request)
    {
        $coupon_keyword  = $request->get('coupon_search');
        $history_keyword = $request->get('history_search');
        $tab             = $request->get('tab');

        $coupon_histories = CouponHistory::with('coupon')->where('member_id', auth()->guard('member')->Id())->where(function ($query) use ($history_keyword) {
            if ($history_keyword) {
                $query->orWhereHas('coupon', function ($que) use ($history_keyword) {
                    $que->where('code', 'LIKE', "%$history_keyword%");
                });
            }
           $query->where('member_id', auth()->guard('member')->Id())
                ->where('expiry_date', '<', now())
                ->orWhere('status', 0);
        })->get();

        $active_coupons = CouponHistory::with('coupon')->where('member_id', auth()->guard('member')->Id())->where(function ($query) use ($coupon_keyword) {
            if ($coupon_keyword) {
                $query->orWhereHas('coupon', function ($que) use ($coupon_keyword) {
                    $que->where('code', 'LIKE', "%$coupon_keyword%");
                });
            }
            $query->where('coupon_histories.start_date', '<', now())
                ->where('coupon_histories.expiry_date', '>', now())
                ->orWhereNull('coupon_histories.start_date')
                ->where('coupon_histories.status', 1);
        })->get();
        
        // if($history_keyword) {
        // $coupon_histories = DB::table('coupon_histories')
        //     ->join('coupons', 'coupon_histories.coupon_id', '=', 'coupons.id')
        //     ->where('coupon_histories.member_id', auth('member')->user()->id)
        //     ->where('coupon_histories.expiry_date','<', now())
        //     ->orWhere('coupon_histories.status', 0)
        //     ->where('coupons.code', $history_keyword)
        //     ->select('coupons.*')
        //     ->get();
        // }else{
        //     $coupon_histories = DB::table('coupon_histories')
        //     ->join('coupons', 'coupon_histories.coupon_id', '=', 'coupons.id')
        //     ->where('coupon_histories.member_id', auth('member')->user()->id)
        //     ->where('coupon_histories.expiry_date','<', now())
        //     ->orWhere('coupon_histories.status', 0)
        //     ->select('coupons.*')
        //     ->get();
        // }

        // if($coupon_keyword) {
        //     $active_coupons = DB::table('coupon_histories')
        //         ->join('coupons', 'coupon_histories.coupon_id', '=', 'coupons.id')
        //         ->where('coupon_histories.member_id', auth('member')->user()->id)
        //         ->where('coupon_histories.start_date','<', now())
        //         ->where('coupon_histories.expiry_date','>', now())
        //         ->where('coupon_histories.status', 1)
        //         ->where('coupons.code', $coupon_keyword)
        //         ->select('coupons.*')
        //         ->get();
        //     }else{
        //         $active_coupons = DB::table('coupon_histories')
        //         ->join('coupons', 'coupon_histories.coupon_id', '=', 'coupons.id')
        //         ->where('coupon_histories.member_id', auth('member')->user()->id)
        //         ->where('coupon_histories.start_date','<', now())
        //         ->where('coupon_histories.expiry_date','>', now())
        //         ->where('coupon_histories.status', 1)
        //         ->select('coupons.*')
        //         ->get();
        //     }

        return view('frontend.member.coupon.index', compact('tab', 'active_coupons', 'coupon_keyword', 'history_keyword', 'coupon_histories'));
    }
}
