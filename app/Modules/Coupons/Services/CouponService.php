<?php
namespace App\Modules\Coupons\Services;

use App\Models\Coupon;
use App\Modules\Core\Services\Service;

class CouponService extends Service {
    protected $fields= ['code', 'discount', 'start_date', 'end_date', 'minimum_purchase', 'maximum_discount', 'max_use'];
    protected $searchField = 'coupon';

    public function __construct(Coupon $model) {
        parent::__construct($model);
    }

    protected $rules = [
        "add" => [
            'code' => 'required|string',
            'discount' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'minimum_purchase' => 'required|numeric',
            'maximum_discount' => 'required|numeric',
            'max_use' => 'required|numeric'
        ],
        "update" => [
            'code' => 'sometimes|string',
            'discount' => 'sometimes|numeric',
            'start_date' => 'sometimes|date',
            'end_date' => 'sometimes|date',
            'minimum_purchase' => 'sometimes|numeric',
            'maximum_discount' => 'sometimes|numeric',
            'max_use' => 'sometimes|numeric'
        ],
        "delete" => [
            'id' => 'required|exists:coupons,id',
        ],
        "get" => [
            'id' => 'required|exists:coupons,id',
        ]
    ];
}
