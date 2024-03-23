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

    public function getProduct(Request $request)
    {
        $products = $this->productFrontService->getModel($request);
        return response()->json($products);
    }
}
