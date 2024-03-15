<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modules\Orders\Services\OrderService;

class OrderController extends Controller
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

    public function getOrderById($brandId) {
        return $this->get($brandId);
    }

    public function updateOrder(Request $request, $brandId) {
        return $this->update($request, $brandId);
    }

    //I will choose not to delete orders and instead mark them as cancelled
    public function cancelOrder($brandId) {
        return $this->cancel($brandId);
    }
}
