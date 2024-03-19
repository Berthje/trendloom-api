<?php

namespace App\Http\Controllers;

use App\Modules\BrandCoupons\Services\BrandCouponService;
use Illuminate\Http\Request;

class BrandCouponController extends ApiServiceController
{
    public function __construct(BrandCouponService $service)
    {
        $this->service = $service;
    }

    public function getAllBrandCoupons()
    {
        return $this->getAll();
    }

    public function createBrandCoupon(Request $request)
    {
        return $this->create($request);
    }

    public function getBrandCouponById($brandCouponId)
    {
        return $this->get($brandCouponId);
    }

    public function updateBrandCoupon(Request $request, $brandCouponId)
    {
        return $this->update($request, $brandCouponId);
    }

    public function deleteBrandCoupon($brandCouponId)
    {
        return $this->delete($brandCouponId);
    }
}
