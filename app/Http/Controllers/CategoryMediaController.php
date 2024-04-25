<?php

namespace App\Http\Controllers;

use App\Modules\CategoryMedia\Services\CategoryMediaService;
use Illuminate\Http\Request;

class CategoryMediaController extends ApiServiceController
{
    public function __construct(CategoryMediaService $service)
    {
        $this->service = $service;
    }

    public function getAllCategoryMedias(Request $request)
    {
        return $this->getAll($request);
    }

    public function createCategoryMedia(Request $request)
    {
        return $this->create($request);
    }

    public function getCategoryMediaById($categoryMediaId)
    {
        return $this->get($categoryMediaId);
    }

    public function updateCategoryMedia(Request $request, $categoryMediaId)
    {
        return $this->update($request, $categoryMediaId);
    }

    public function deleteCategoryMedia($categoryMediaId)
    {
        return $this->delete($categoryMediaId);
    }
}
