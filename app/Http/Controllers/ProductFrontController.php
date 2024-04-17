<?php

namespace App\Http\Controllers;

use App\Modules\Products\Services\ProductFrontService;
use Illuminate\Http\Request;

class ProductFrontController extends Controller
{
    protected $productFrontService;

    public function __construct(ProductFrontService $productFrontService)
    {
        $this->productFrontService = $productFrontService;
    }

    public function getAllProducts(Request $request)
    {
        $products = $this->productFrontService->getTranslatedModel($request);
        return response()->json($products);
    }

    public function getProductById(Request $request, $productId)
    {
        $product = $this->productFrontService->getProductById($request, $productId);
        return response()->json($product);
    }
}
