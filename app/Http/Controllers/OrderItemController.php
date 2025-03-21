<?php

namespace App\Http\Controllers;

use App\Modules\OrderItems\Services\OrderItemService;
use Illuminate\Http\Request;

class OrderItemController extends ApiServiceController
{
    public function __construct(OrderItemService $service)
    {
        $this->service = $service;
    }

    public function getAllOrderItems(Request $request)
    {
        return $this->getAll($request);
    }

    public function createOrderItem(Request $request)
    {
        return $this->create($request);
    }

    public function getOrderItemById($orderItemId)
    {
        return $this->get($orderItemId);
    }

    public function updateOrderItem(Request $request, $orderItemId)
    {
        return $this->update($request, $orderItemId);
    }

    public function deleteOrderItem($orderItemId)
    {
        return $this->delete($orderItemId);
    }
}
