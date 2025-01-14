<?php
namespace App\Modules\Orders\Services;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Customer;
use App\Modules\Core\Services\AuthenticatedService;
use Illuminate\Auth\Access\AuthorizationException;

class OrderService extends AuthenticatedService {
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
    protected $rules = [
        "add" => [
            'customer_id' => 'required|exists:customers,id|integer',
            'address_id' => 'required|exists:addresses,id|integer',
            'coupon_id' => 'sometimes|nullable|exists:coupons,id',
            'order_date' => 'required|date',
            'status' => 'required|string|in:processing,shipped,delivered,cancelled,not_completed',
            'amount_products' => 'required|integer',
            'total_price' => 'required|numeric',
            'payment_method' => 'required|string',
            'shipping_method' => 'required|string',
            'tracking_number' => 'sometimes|nullable|string'
        ],
        "update" => [
            'customer_id' => 'sometimes|exists:customers,id|integer',
            'address_id' => 'sometimes|exists:addresses,id|integer',
            'coupon_id' => 'sometimes|nullable|exists:coupons,id',
            'order_date' => 'sometimes|date',
            'status' => 'sometimes|string|in:processing,shipped,delivered,cancelled,not_completed',
            'amount_products' => 'sometimes|integer',
            'total_price' => 'sometimes|numeric',
            'payment_method' => 'sometimes|string',
            'shipping_method' => 'sometimes|string',
            'tracking_number' => 'sometimes|nullable|string'
        ],
        "get" => [
            'id' => 'required|exists:orders,id',
        ]
    ];

    public function __construct(Order $model) {
        parent::__construct($model);
    }

    public function isAllowed(int $entityOrderId, int $userId): bool
    {
        $user = Customer::find($userId);
        $order = Order::find($entityOrderId);

        return $order->customer_id === $userId || $user->isAdmin();
    }

    public function getRelationFields() {
        return [
            'customer:id,first_name,last_name,email,phone_number',
            'address:id,address,city,state,zip,country',
            'coupon:id,code,discount,start_date,end_date,minimum_purchase,maximum_discount,max_use',
            'orderItems'
        ];
    }

    public function cancel($id) {
        $data = ['status' => 'cancelled'];

        if (!$this->isAllowed($id, auth('api')->user()->id)) {
            throw new AuthorizationException('Unauthorized');
        }

        return $this->model->where('id', $id)->update($data);
    }

    public function getOrderItemsByOrderId($orderId) {
        if (!$this->isAllowed($orderId, auth('api')->user()->id)) {
            throw new AuthorizationException('Unauthorized');
        }

        return OrderItem::with('product', 'size', 'order')->where('order_id', $orderId)->get();
    }
}
