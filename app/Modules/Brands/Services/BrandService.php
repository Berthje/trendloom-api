<?php

namespace App\Modules\Brands\Services;

use App\Models\Brand;
use App\Models\BrandLanguage;
use App\Models\Language;
use App\Modules\Core\Services\Service;
use App\Modules\BrandLanguages\Services\BrandLanguageService;
use App\Modules\Languages\Services\LanguageService;

class BrandService extends Service
{
    protected $fields = ['name', 'description', 'logo_url'];
    protected $searchField = 'brand';
    protected $rules = [
        "add" => [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'logo_url' => 'required|string'
        ],
        "update" => [
            'name' => 'sometimes|string',
            'description' => 'sometimes|string',
            'logo_url' => 'sometimes|string'
        ],
        "delete" => [
            'id' => 'required|exists:brands,id',
        ],
        "get" => [
            'id' => 'required|exists:brands,id',
        ]
    ];

    public function __construct(Brand $model)
    {
        parent::__construct($model);
    }

    public function create($data, $ruleKey = "add")
    {
        $this->validate($data, $ruleKey);

        if ($this->HasErrors()) {
            return;
        }

        $languageService = new LanguageService(new Language());

        if (!$languageService->areLanguagesValid($data)) {
            return response()->json(['error' => 'All available languages must be provided.'], 400);
        }

        $brand = $this->model->create($data);
        $brandLanguageService = new BrandLanguageService(new BrandLanguage());

        $brandLanguageService->createTranslations($brand, $data['languages']);

        return $brand;
    }
}
