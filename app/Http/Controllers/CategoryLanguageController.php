<?php

namespace App\Http\Controllers;

use App\Modules\CategoryLanguages\Services\CategoryLanguageService;
use Illuminate\Http\Request;

class CategoryLanguageController extends ApiServiceController
{
    public function __construct(CategoryLanguageService $service)
    {
        $this->service = $service;
    }

    public function getAllCategoryLanguages()
    {
        return $this->getAll();
    }

    public function createCategoryLanguage(Request $request)
    {
        return $this->create($request);
    }

    public function getCategoryLanguageById($categoryLanguageId)
    {
        return $this->get($categoryLanguageId);
    }

    public function updateCategoryLanguage(Request $request, $categoryLanguageId)
    {
        return $this->update($request, $categoryLanguageId);
    }

    public function deleteCategoryLanguage($categoryLanguageId)
    {
        return $this->delete($categoryLanguageId);
    }
}
