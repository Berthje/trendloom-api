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

    public function getAllProductSizes()
    {
        return $this->getAll();
    }

    public function createProductSiz(Request $request)
    {
        return $this->create($request);
    }

    public function getProductSizById($productSize)
    {
        return $this->get($productSize);
    }

    public function updateProductSiz(Request $request, $productSize)
    {
        return $this->update($request, $productSize);
    }

    public function deleteProductSiz($productSize)
    {
        return $this->delete($productSize);
    }
}
