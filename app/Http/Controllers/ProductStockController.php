<?php

namespace App\Http\Controllers;

use App\Modules\Brands\Services\ProductStockService;
use Illuminate\Http\Request;

class ProductStockController extends ApiServiceController
{
    public function __construct(ProductStockService $service)
    {
        $this->service = $service;
    }

    public function getAllProductStocks()
    {
        return $this->getAll();
    }

    public function createProductStock(Request $request)
    {
        return $this->create($request);
    }

    public function getProductStockById($productStockId)
    {
        return $this->get($productStockId);
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
