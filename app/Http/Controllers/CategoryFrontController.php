<?php

namespace App\Http\Controllers;

use App\Modules\Categories\Services\CategoryFrontService;
use Illuminate\Http\Request;

class CategoryFrontController extends Controller
{
    protected $categoryFrontService;

    public function __construct(CategoryFrontService $categoryFrontService)
    {
        $this->categoryFrontService = $categoryFrontService;
    }

    public function getAllCategories(Request $request)
    {
        $categories = $this->categoryFrontService->getTranslatedModel($request);
        return response()->json($categories);
    }

    public function getCategoryById(Request $request, $categoryId)
    {
        $category = $this->categoryFrontService->getCategoryById($request, $categoryId);
        return response()->json($category);
    }

    public function getProductsByCategoryId(Request $request, $categoryId)
    {
        $products = $this->categoryFrontService->getProductsByCategoryId($request, $categoryId);
        return response()->json($products);
    }
}
