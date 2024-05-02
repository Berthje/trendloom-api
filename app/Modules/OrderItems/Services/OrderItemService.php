<?php

namespace App\Modules\OrderItems\Services;

use App\Models\OrderItem;
use App\Models\Customer;
use App\Models\ProductStock;
use App\Modules\Core\Services\AuthenticatedService;

class OrderItemService extends AuthenticatedService
{
    protected $fields = ['order_id', 'product_id', 'product_size_id', 'product_details', 'quantity'];
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

    public function __construct(OrderItem $model)
    {
        parent::__construct($model);
    }

    public function isAllowed(int $entityOrderItemId, int $userId): bool
    {
        $user = Customer::find($userId);
        $orderItem = OrderItem::find($entityOrderItemId);

        return $orderItem->order->customer_id === $userId || $user->isAdmin();
    }

    public function create($data, $ruleKey = "add")
    {
        $orderItem = parent::create($data, $ruleKey);

        if ($orderItem && !$this->hasErrors()) {
            $this->updateProductStock($orderItem, 'decrease');
        }

        return $orderItem;
    }

    public function delete($id, $ruleKey = "delete")
    {
        $orderItem = $this->model->find($id);
        $deleted = parent::delete($id, $ruleKey);

        if ($deleted && !$this->hasErrors()) {
            $this->updateProductStock($orderItem, 'increase');
        }

        return $deleted;
    }

    private function updateProductStock(OrderItem $orderItem, $operation)
    {
        $productStock = ProductStock::where('product_id', $orderItem->product_id)
            ->where('size_id', $orderItem->product_size_id)
            ->first();

        if ($productStock) {
            if ($operation === 'decrease') {
                if ($productStock->quantity_in_stock < $orderItem->quantity) {
                    $errorMessage = $productStock->quantity_in_stock > 0
                        ? 'The requested quantity is not available in stock. Only ' . $productStock->quantity_in_stock . ' left in stock.'
                        : 'No more products in stock.';
                    $this->errors->add('quantity', $errorMessage);
                    return;
                }
                $productStock->quantity_in_stock -= $orderItem->quantity;
            } elseif ($operation === 'increase') {
                $productStock->quantity_in_stock += $orderItem->quantity;
            }

            $productStock->save();
        }
    }

    protected function getRelationFields()
    {
        return [
            'order',
            'product',
            'size'
        ];
    }
}
