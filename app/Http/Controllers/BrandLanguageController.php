<?php

namespace App\Http\Controllers;

use App\Modules\BrandLanguages\Services\BrandLanguageService;
use Illuminate\Http\Request;

class BrandLanguageController extends ApiServiceController
{
    public function __construct(BrandLanguageService $service)
    {
        $this->service = $service;
    }

    public function getAllBrandLanguages(Request $request)
    {
        return $this->getAll($request);
    }

    public function createBrandLanguage(Request $request)
    {
        return $this->create($request);
    }

    public function getBrandLanguageById($brandLanguageId)
    {
        return $this->get($brandLanguageId);
    }

    public function updateBrandLanguage(Request $request, $brandLanguageId)
    {
        return $this->update($request, $brandLanguageId);
    }

    public function deleteBrandLanguage($brandLanguageId)
    {
        return $this->delete($brandLanguageId);
    }
}
