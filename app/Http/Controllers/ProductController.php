<?php

namespace App\Http\Controllers;

use App\Modules\Products\Services\ProductService;

class ProductController extends ApiServiceController
{
    public function __construct(ProductService $service) {
        $this->service = $service;
    }

    public function getAllProducts() {
        return $this->getAll();
    }

    public function createProduct() {
        return $this->create();
    }

    public function getProductById($productId) {
        return $this->get($productId);
    }

    public function updateProduct($productId) {
        return $this->update($productId);
    }

    public function deleteProduct($productId) {
        return $this->delete($productId);
    }
}
