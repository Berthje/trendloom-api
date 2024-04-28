<?php

namespace App\Http\Controllers;

use App\Modules\Brands\Services\BrandFrontService;
use Illuminate\Http\Request;

class BrandFrontController extends Controller
{
    protected $brandFrontService;

    public function __construct(BrandFrontService $brandFrontService)
    {
        $this->brandFrontService = $brandFrontService;
    }

    public function getAllBrands(Request $request)
    {
        $brands = $this->brandFrontService->getTranslatedModel($request);
        return response()->json($brands);
    }

    public function getBrandById(Request $request, $id)
    {
        $brand = $this->brandFrontService->getBrandById($request, $id);
        return response()->json($brand);
    }

    public function getProductsByBrandId(Request $request, $id)
    {
        $products = $this->brandFrontService->getProductsByBrandId($request, $id);
        return response()->json($products);
    }
}
