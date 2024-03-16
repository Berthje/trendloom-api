<?php

namespace App\Http\Controllers;

use App\Modules\Languages\Services\LanguageService;
use Illuminate\Http\Request;

class LanguageController extends ApiServiceController
{
    public function __construct(LanguageService $service)
    {
        $this->service = $service;
    }

    public function getAllLanguages()
    {
        return $this->getAll();
    }

    public function createLanguage(Request $request)
    {
        return $this->create($request);
    }

    public function getLanguageById($languageId)
    {
        return $this->get($languageId);
    }

    public function updateLanguage(Request $request, $languageId)
    {
        return $this->update($request, $languageId);
    }

    public function deleteLanguage($languageId)
    {
        return $this->delete($languageId);
    }
}
