<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modules\Coupons\Services\CouponService;

class CouponController extends ApiServiceController
{
    public function __construct(CouponService $service)
    {
        $this->service = $service;
    }

    public function getAllCoupons(Request $request)
    {
        return $this->getAll($request);
    }

    public function createCoupon(Request $request)
    {
        return $this->create($request);
    }

    public function getCouponById($couponId)
    {
        return $this->get($couponId);
    }

    public function updateCoupon(Request $request, $couponId)
    {
        return $this->update($request, $couponId);
    }

    public function deleteCoupon($couponId)
    {
        return $this->delete($couponId);
    }
}
