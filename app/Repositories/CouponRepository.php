<?php

namespace App\Repositories;

use App\Helpers\DataArrayHelper;
use App\Interfaces\Repositories\CouponRepositoryInterface;
use App\Models\Coupon;
use App\Models\MemberType;

class CouponRepository implements CouponRepositoryInterface
{
    public function getAllCouponList($request)
    {
        $keyword = $request->get('search');
        $perPage = $request->diaplay ? $request->diaplay : 10;
        $status  = $request->status == null ? "all" : $request->status;

        $coupon = Coupon::where(function ($query) use ($keyword, $status) {
            if ($keyword != null) {
                $query->where('code', 'LIKE', "%$keyword%");
            }

            if ($status != 'all') {
                $query->where('status', $status);
            }
        });

        $coupon = $coupon->with('updateUser')->latest('id')->paginate($perPage);

        $data = [
            'keyword' => $keyword,
            'status'  => $status,
            'perPage' => $perPage,
            'coupon'  => $coupon,
        ];

        return $data;
    }

    public function createCouponPage()
    {
        $products     = DataArrayHelper::getAllProductCodeArray();
        $member_types = MemberType::active()->pluck('name_en', 'id');

        $data = [
            'products'      => $products,
            'member_types'  => $member_types,
        ];

        return $data;
    }

    public function saveCouponData($request, $id = null)
    {
        $requestData  = $request->all();
        $descriptions = [
            'en'   => $requestData['description_en'],
            'hant' => $requestData['description_hant'],
            'hans' => $requestData['description_hans'],
        ];

        $requestData['descriptions']   = $descriptions;
        $requestData['member_type_id'] = $request->member_type_id ? $request->member_type_id : null;
        $requestData['products']       = $request->products ? $request->products : null;
        $requestData['amount']         = $request->amount ? $request->amount : null;
        $requestData['percent']        = $request->percent ? $request->percent : null;
        $requestData['start_date']     = $request->start_date ? $request->start_date : null;
        $requestData['expiry_date']    = $request->expiry_date ? $request->expiry_date : null;
        $requestData['per_coupon']     = $request->per_coupon ? $request->per_coupon : null;
        $requestData['per_user']       = $request->per_user ? $request->per_user : null;

        if ($id) {
            $requestData['updated_by']    = auth()->user()->id;
            $coupon                       = Coupon::findOrFail($id);
            $coupon->update($requestData);
        } else {
            $requestData['created_date']  = now();
            $requestData['created_by']    = auth()->user()->id;
            $coupon                       = Coupon::create($requestData);
        }

        return $coupon;
    }

    public function getCouponData($id)
    {
        $products     = DataArrayHelper::getAllProductCodeArray();
        $member_types = MemberType::active()->pluck('name_en', 'id');
        $coupon       = Coupon::findOrFail($id);

        $data = [
            'products'     => $products,
            'member_types' => $member_types,
            'coupon'       => $coupon,
        ];

        return $data;
    }

    public function deleteCoupon($id)
    {
        return Coupon::destroy($id);
    }

    public function couponStatusChange($request)
    {
        $coupon      = Coupon::findOrFail($request->id);
        $coupon->update(['status' => !$coupon->status]);

        return $coupon;
    }
}
