<?php
namespace App\Modules\OrderItems\Services;

use App\Models\OrderItem;
use App\Modules\Core\Services\Service;

class OrderItemService extends Service {
    protected $fields= ['order_id', 'product_id', 'product_size_id', 'product_details', 'quantity'];
    protected $searchField = 'orderItem';

    public function __construct(OrderItem $model) {
        parent::__construct($model);
    }

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

    protected function getRelationFields() {
        return [
            'order',
            'product',
            'size'
        ];
    }
}
