<?php

namespace App\Http\Controllers;

use App\Modules\Products\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends ApiServiceController
{
    public function __construct(ProductService $service) {
        $this->service = $service;
    }

    public function getAllProducts(Request $request) {
        return $this->getAll($request);
    }

    public function createProduct(Request $request) {
        return $this->create($request);
    }

    public function getProductById($productId) {
        return $this->get($productId);
    }

    public function updateProduct(Request $request, $productId) {
        return $this->update($request, $productId);
    }

    public function deleteProduct($productId) {
        return $this->delete($productId);
    }
}
