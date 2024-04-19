<?php
namespace App\Modules\OrderItems\Services;

use App\Models\OrderItem;
use App\Models\Customer;
use App\Modules\Core\Services\AuthenticatedService;

class OrderItemService extends AuthenticatedService {
    protected $fields= ['order_id', 'product_id', 'product_size_id', 'product_details', 'quantity'];
    protected $searchField = 'orderItem';
    protected $rules = [
        "add" => [
            'order_id' => 'required|integer|exists:orders,id',
            'product_id' => 'required|integer|exists:products,id',
            'product_size_id' => 'required|integer|exists:product_sizes,id',
            'product_details' => 'required|json',
            'quantity' => 'required|integer',
        ],
        "update" => [
            'order_id' => 'sometimes|integer|exists:orders,id',
            'product_id' => 'sometimes|integer|exists:products,id',
            'product_size_id' => 'sometimes|integer|exists:product_sizes,id',
            'product_details' => 'sometimes|json',
            'quantity' => 'sometimes|integer|min:1',
        ],
        "delete" => [
            'id' => 'required|exists:order_items,id',
        ],
        "get" => [
            'id' => 'required|exists:order_items,id',
        ]
    ];

    public function __construct(OrderItem $model) {
        parent::__construct($model);
    }

    public function isAllowed(int $entityOrderItemId, int $userId): bool
    {
        $user = Customer::find($userId);
        $orderItem = OrderItem::find($entityOrderItemId);

        return $orderItem->order->customer_id === $userId || $user->isAdmin();
    }

    protected function getRelationFields() {
        return [
            'order',
            'product',
            'size'
        ];
    }
}
