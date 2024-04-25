<?php

namespace App\Http\Controllers;

use App\Modules\Orders\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Auth\Access\AuthorizationException;

class OrderController extends ApiServiceController
{
    public function __construct(OrderService $service)
    {
        $this->service = $service;
    }

    public function getAllOrders(Request $request)
    {
        return $this->getAll($request);
    }

    public function createOrder(Request $request)
    {
        return $this->create($request);
    }

    public function getOrderById($orderId)
    {
        return $this->get($orderId);
    }

    public function updateOrder(Request $request, $orderId)
    {
        return $this->update($request, $orderId);
    }

    //I will choose not to delete orders and instead mark them as cancelled
    public function cancelOrder($orderId)
    {
        try {
            return $this->service->cancel($orderId);
        } catch (AuthorizationException $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function getOrderItemsByOrderId($orderId)
    {
        try {
            return $this->service->getOrderItemsByOrderId($orderId);
        } catch (AuthorizationException $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_UNAUTHORIZED);
        }
    }
}
