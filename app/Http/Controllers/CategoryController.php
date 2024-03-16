<?php

namespace App\Http\Controllers;

use App\Modules\Categories\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends ApiServiceController
{
    public function __construct(CategoryService $service)
    {
        $this->service = $service;
    }

    public function getAllCategories()
    {
        return $this->getAll();
    }

    public function createCategory(Request $request)
    {
        return $this->create($request);
    }

    public function getCategoryById($categoryId)
    {
        return $this->get($categoryId);
    }

    public function updateCategory(Request $request, $categoryId)
    {
        return $this->update($request, $categoryId);
    }

    public function deleteCategory($categoryId)
    {
        return $this->delete($categoryId);
    }
}
