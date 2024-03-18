<?php
namespace App\Modules\Orders\Services;

use App\Models\Order;
use App\Models\OrderItem;
use App\Modules\Core\Services\Service;

class OrderService extends Service {
    protected $fields= [
        'customer_id',
        'address_id',
        'coupon_id',
        'order_date',
        'status',
        'amount_products',
        'total_price',
        'payment_method',
        'shipping_method',
        'tracking_number'
    ];
    protected $searchField = 'order';

    public function __construct(Order $model) {
        parent::__construct($model);
    }

    protected $rules = [
        "add" => [
            'customer_id' => 'required|exists:customers,id|integer',
            'address_id' => 'required|exists:addresses,id|integer',
            'coupon_id' => 'sometimes|exists:coupons,id',
            'order_date' => 'required|date',
            'status' => 'required|string|default:processing',
            'amount_products' => 'required|integer|min:1',
            'total_price' => 'required|numeric|min:0',
            'payment_method' => 'required|string',
            'shipping_method' => 'required|string',
            'tracking_number' => 'sometimes|string'
        ],
        "update" => [
            'customer_id' => 'sometimes|exists:customers,id|integer',
            'address_id' => 'sometimes|exists:addresses,id|integer',
            'coupon_id' => 'sometimes|exists:coupons,id',
            'order_date' => 'sometimes|date',
            'status' => 'sometimes|string|in:processing,shipped,delivered,cancelled',
            'amount_products' => 'sometimes|integer|min:1',
            'total_price' => 'sometimes|numeric|min:0',
            'payment_method' => 'sometimes|string',
            'shipping_method' => 'sometimes|string',
            'tracking_number' => 'sometimes|string'
        ],
        "get" => [
            'id' => 'required|exists:orders,id',
        ]
    ];

    protected function getRelationFields() {
        return [
            'customer:id,first_name,last_name,email,phone_number',
            'address:id,address,city,state,zip,country',
            'coupon:id,code,discount,start_date,end_date,minimum_purchase,maximum_discount,max_use'
        ];
    }

    public function cancel($id) {
        $data = ['status' => 'cancelled'];
        return $this->model->where('id', $id)->update($data);
    }

    public function getOrderItemsByOrderId($orderId) {
        return OrderItem::where('order_id', $orderId)->get();
    }
}
