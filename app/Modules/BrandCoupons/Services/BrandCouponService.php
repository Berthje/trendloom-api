<?php
namespace App\Modules\BrandCoupons\Services;

use App\Models\BrandCoupon;
use App\Modules\Core\Services\Service;

class BrandCouponService extends Service {
    protected $fields= ['brand_id', 'coupon_id'];
    protected $searchField = 'brandCoupon';
    protected $rules = [
        "add" => [
            'brand_id' => 'required|exists:brands,id',
            'coupon_id' => 'required|exists:coupons,id'
        ],
        "update" => [
            'brand_id' => 'sometimes|exists:brands,id',
            'coupon_id' => 'sometimes|exists:coupons,id'
        ],
        "delete" => [
            'id' => 'required|exists:brand_coupons,id',
        ],
        "get" => [
            'id' => 'required|exists:brand_coupons,id',
        ]
    ];

    public function __construct(BrandCoupon $model) {
        parent::__construct($model);
    }

    protected function getRelationFields() {
        return [
            'brand',
            'coupon'
        ];
    }
}
