<?php

namespace App\Http\Controllers;

use App\Modules\ProductCoupons\Services\ProductCouponService;
use Illuminate\Http\Request;

class ProductCouponController extends ApiServiceController
{
    public function __construct(ProductCouponService $service)
    {
        $this->service = $service;
    }

    public function getAllProductCoupons(Request $request)
    {
        return $this->getAll($request);
    }

    public function createProductCoupon(Request $request)
    {
        return $this->create($request);
    }

    public function getProductCouponById($productCouponId)
    {
        return $this->get($productCouponId);
    }

    public function updateProductCoupon(Request $request, $productCouponId)
    {
        return $this->update($request, $productCouponId);
    }

    public function deleteProductCoupon($productCouponId)
    {
        return $this->delete($productCouponId);
    }
}
