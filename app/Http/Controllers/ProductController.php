<?php

namespace App\Http\Controllers;

use App\Modules\Products\Services\ProductService;

class ProductController extends ApiServiceController
{
    public function __construct(ProductService $service) {
        $this->service = $service;
    }

    public function getAllProducts() {
        //TODO: implement this method
    }

    public function createProduct() {
        //TODO: implement this method
    }

    public function getProductById($productId) {
        return $this->get($productId);
    }

    public function updateProduct($productId) {
        //TODO: implement this method
    }

    public function deleteProduct($productId) {
        //TODO: implement this method
    }
}
