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

    public function getCategory(Request $request)
    {
        $categories = $this->categoryFrontService->getTranslatedModel($request);
        return response()->json($categories);
    }
}
