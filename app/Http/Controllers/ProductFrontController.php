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
        $itemCount = $request->input('itemCount', 12);
        $products = $this->productFrontService->getTranslatedModel($itemCount);
        return response()->json($products);
    }

    public function getProductById(Request $request, $productId)
    {
        $product = $this->productFrontService->getProductById($request, $productId);
        return response()->json($product);
    }
}
