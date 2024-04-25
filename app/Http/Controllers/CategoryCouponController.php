<?php

namespace App\Http\Controllers;

use App\Modules\CategoryCoupons\Services\CategoryCouponService;
use Illuminate\Http\Request;

class CategoryCouponController extends ApiServiceController
{
    public function __construct(CategoryCouponService $service)
    {
        $this->service = $service;
    }

    public function getAllCategoryCoupons(Request $request)
    {
        return $this->getAll($request);
    }

    public function createCategoryCoupon(Request $request)
    {
        return $this->create($request);
    }

    public function getCategoryCouponById($categoryCouponId)
    {
        return $this->get($categoryCouponId);
    }

    public function updateCategoryCoupon(Request $request, $categoryCouponId)
    {
        return $this->update($request, $categoryCouponId);
    }

    public function deleteCategoryCoupon($categoryCouponId)
    {
        return $this->delete($categoryCouponId);
    }
}
