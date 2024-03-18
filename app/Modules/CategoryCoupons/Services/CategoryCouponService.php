<?php
namespace App\Modules\CategoryCoupons\Services;

use App\Models\CategoryCoupon;
use App\Modules\Core\Services\Service;

class BrandService extends Service {
    protected $fields= ['category_id', 'coupon_id'];
    protected $searchField = 'categoryCoupon';

    public function __construct(CategoryCoupon $model) {
        parent::__construct($model);
    }

    protected $rules = [
        "add" => [
            'category_id' => 'required|exists:categories,id',
            'coupon_id' => 'required|exists:coupons,id'
        ],
        "update" => [
            'category_id' => 'sometimes|exists:categories,id',
            'coupon_id' => 'sometimes|exists:coupons,id'
        ],
        "delete" => [
            'id' => 'required|exists:category_coupons,id',
        ],
        "get" => [
            'id' => 'required|exists:category_coupons,id',
        ]
    ];
}
