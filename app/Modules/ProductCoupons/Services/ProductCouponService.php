<?php
namespace App\Modules\ProductCoupons\Services;

use App\Models\ProductCoupon;
use App\Modules\Core\Services\Service;

class ProductCouponService extends Service {
    protected $fields= ['product_id', 'coupon_id'];
    protected $searchField = 'productCoupon';

    public function __construct(ProductCoupon $model) {
        parent::__construct($model);
    }

    protected $rules = [
        "add" => [
            'product_id' => 'required|exists:products,id',
            'coupon_id' => 'required|exists:coupons,id'
        ],
        "update" => [
            'product_id' => 'sometimes|exists:products,id',
            'coupon_id' => 'sometimes|exists:coupons,id'
        ],
        "delete" => [
            'id' => 'required|exists:product_coupons,id',
        ],
        "get" => [
            'id' => 'required|exists:product_coupons,id',
        ],
    ];

    protected function getRelationFields() {
        return [
            'product',
            'coupon'
        ];
    }
}
