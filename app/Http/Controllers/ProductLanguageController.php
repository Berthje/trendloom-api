<?php

namespace App\Http\Controllers;

use App\Modules\ProductLanguages\Services\ProductLanguageService;
use Illuminate\Http\Request;

class ProductLanguageController extends ApiServiceController
{
    public function __construct(ProductLanguageService $service)
    {
        $this->service = $service;
    }

    public function getAllProductLanguages(Request $request)
    {
        return $this->getAll($request);
    }

    public function createProductLanguage(Request $request)
    {
        return $this->create($request);
    }

    public function getProductLanguageById($productLanguageId)
    {
        return $this->get($productLanguageId);
    }

    public function updateProductLanguage(Request $request, $productLanguageId)
    {
        return $this->update($request, $productLanguageId);
    }

    public function deleteProductLanguage($productLanguageId)
    {
        return $this->delete($productLanguageId);
    }
}
