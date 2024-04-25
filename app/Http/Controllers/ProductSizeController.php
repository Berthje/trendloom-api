<?php

namespace App\Http\Controllers;

use App\Modules\ProductSizes\Services\ProductSizeService;
use Illuminate\Http\Request;

class ProductSizeController extends ApiServiceController
{
    public function __construct(ProductSizeService $service)
    {
        $this->service = $service;
    }

    public function getAllProductSizes(Request $request)
    {
        return $this->getAll($request);
    }

    public function createProductSize(Request $request)
    {
        return $this->create($request);
    }

    public function getProductSizeById($productSize)
    {
        return $this->get($productSize);
    }

    public function updateProductSize(Request $request, $productSize)
    {
        return $this->update($request, $productSize);
    }

    public function deleteProductSize($productSize)
    {
        return $this->delete($productSize);
    }
}
