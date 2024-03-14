<?php

namespace App\Http\Controllers;

use App\Modules\Products\Services\ProductService;

class ProductController extends ApiServiceController
{
    protected $service;
    
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
        $this->service->get($productId);
    }

    public function updateProduct($productId) {
        //TODO: implement this method
    }

    public function deleteProduct($productId) {
        //TODO: implement this method
    }
}
