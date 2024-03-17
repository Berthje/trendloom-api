<?php

namespace App\Http\Controllers;

use App\Modules\ProductMedia\Services\ProductMediaService;
use Illuminate\Http\Request;

class ProductMediaController extends ApiServiceController
{
    public function __construct(ProductMediaService $service)
    {
        $this->service = $service;
    }

    public function getAllProductMedia()
    {
        return $this->getAll();
    }

    public function createProductMedia(Request $request)
    {
        return $this->create($request);
    }

    public function getProductMediaById($productMedia)
    {
        return $this->get($productMedia);
    }

    public function updateProductMedia(Request $request, $productMedia)
    {
        return $this->update($request, $productMedia);
    }

    public function deleteProductMedia($productMedia)
    {
        return $this->delete($productMedia);
    }
}
