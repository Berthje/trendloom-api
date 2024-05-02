<?php

namespace App\Http\Controllers;

use App\Modules\ProductStock\Services\ProductStockService;
use Illuminate\Http\Request;

class ProductStockController extends ApiServiceController
{
    public function __construct(ProductStockService $service)
    {
        $this->service = $service;
    }

    public function getAllProductStocks(Request $request)
    {
        return $this->getAll($request);
    }

    public function createProductStock(Request $request)
    {
        return $this->create($request);
    }

    public function getProductStockByProductId($productId)
    {
        return $this->service->getProductStockByProductId($productId);
    }

    public function updateProductStock(Request $request, $productStockId)
    {
        return $this->update($request, $productStockId);
    }

    public function deleteProductStock($productStockId)
    {
        return $this->delete($productStockId);
    }
}
