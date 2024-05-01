<?php

namespace App\Http\Controllers;

use App\Modules\Translations\Services\TranslationService;
use Illuminate\Http\Request;

class TranslationController extends ApiServiceController
{
    public function __construct(TranslationService $service)
    {
        $this->service = $service;
    }

    public function getTranslations(Request $request) {
        return $this->service->getTranslations($request);
    }
}
