<?php

namespace App\Http\Controllers;

use App\Modules\Orders\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends ApiServiceController
{
    public function __construct(OrderService $service) {
        $this->service = $service;
    }

    public function getAllOrders() {
        return $this->getAll();
    }

    public function createOrder(Request $request) {
        return $this->create($request);
    }

    public function getOrderById($orderId) {
        return $this->get($orderId);
    }

    public function updateOrder(Request $request, $orderId) {
        return $this->update($request, $orderId);
    }

    //I will choose not to delete orders and instead mark them as cancelled
    public function cancelOrder($orderId) {
        return $this->service->cancel($orderId);
    }

    public function getOrderItemsByOrderId($orderId)
    {
        return $this->service->getOrderItemsByOrderId($orderId);
    }
}
