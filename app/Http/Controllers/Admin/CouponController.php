<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\DataArrayHelper;
use App\Http\Controllers\Controller;
use App\Interfaces\Repositories\CouponRepositoryInterface;
use App\Models\Coupon;
use App\Models\MemberType;
use App\Traits\AdminRolePermission;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    use AdminRolePermission;

    private CouponRepositoryInterface $couponRepository;

    public function __construct(CouponRepositoryInterface $couponRepository)
    {
        $this->couponRepository = $couponRepository;
    }

    public function index(Request $request)
    {
        if($this->adminHasPermission('can_access_listing')){
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $data  = $this->couponRepository->getAllCouponList($request);

        return view('admin.coupon.index', $data);
    }

    public function create()
    {
        if($this->adminHasPermission('can_access_create')){
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $data = $this->couponRepository->createCouponPage();

        return view('admin.coupon.create', $data);
    }

    public function store(Request $request)
    {
        if($this->adminHasPermission('can_access_create')){
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $this->couponRepository->saveCouponData($request);

        return redirect('admin/coupon')->with('flash_message', 'Coupon added!');
    }

    public function edit($id)
    {
        if($this->adminHasPermission('can_access_edit')){
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $data = $this->couponRepository->getCouponData($id);

        return view('admin.coupon.edit', $data);
    }

    public function update(Request $request, $id)
    {
        if($this->adminHasPermission('can_access_edit')){
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $this->couponRepository->saveCouponData($request, $id);

        return redirect('admin/coupon')->with('flash_message', 'Coupon updated!');
    }

    public function destroy($id)
    {
        if($this->adminHasPermission('can_access_delete')){
            return redirect()->back()->with('warning', 'You are not allowed to access this process');
        }

        $this->couponRepository->deleteCoupon($id);

        return redirect('admin/coupon')->with('flash_message', 'Coupon deleted!');
    }

    public function statusChange(Request $request)
    {
        $coupon = $this->couponRepository->couponStatusChange($request);

        return response()->json([
            "success"    => true,
            'isPublish'  => $coupon->status,
            'id'         => $coupon->id,
        ]);
    }
}
