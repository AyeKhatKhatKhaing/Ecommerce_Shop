<?php

namespace App\Interfaces\Repositories;

interface CouponRepositoryInterface
{
    /**
     * get the coupon list
     * @param $request
     * @return $coupon
     */
    public function getAllCouponList($request);

    /**
     * get the member create page
     * @return $member_types, $products
     */
    public function createCouponPage();

    /**
     * get the request data
     * @param $request, $id
     * @return $coupon
     */
    public function saveCouponData($request, $id);

    /**
     * get the member by id
     * @param $id
     * @return $member
     */
    public function getCouponData($id);

    /**
     * get the member by id
     * @param $id
     * @return $member
     */
    public function deleteCoupon($id);

    /**
     * get the member by request id
     * @param $request
     * @return $member
     */
    public function couponStatusChange($request);

}