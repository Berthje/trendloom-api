<?php

namespace App\Modules\BrandLanguages\Services;

use App\Models\BrandLanguage;
use App\Modules\Core\Services\Service;
use App\Models\Language;

class BrandLanguageService extends Service
{
    protected $fields = ['brand_id', 'language_id', 'name', 'description'];
    protected $searchField = 'brandLanguage';
    protected $rules = [
        "add" => [
            'brand_id' => 'required|exists:brands,id',
            'language_id' => 'required|exists:languages,id',
            'name' => 'required|string',
            'description' => 'required|string'
        ],
        "update" => [
            'brand_id' => 'sometimes|exists:brands,id',
            'language_id' => 'sometimes|exists:languages,id',
            'name' => 'sometimes|string',
            'description' => 'sometimes|string'
        ],
        "delete" => [
            'id' => 'required|exists:brand_languages,id',
        ],
        "get" => [
            'id' => 'required|exists:brand_languages,id',
        ]
    ];

    public function __construct(BrandLanguage $model)
    {
        parent::__construct($model);
    }

    protected function getRelationFields()
    {
        return [
            'brand:id,name,description,logo_url',
            'language:id,name,code'
        ];
    }

    public function createTranslations($brand, $languages)
    {
        foreach ($languages as $languageCode => $translationData) {
            $language = Language::where('code', $languageCode)->first();

            if ($language) {
                $brand->translations()->create([
                    'language_id' => $language->id,
                    'name' => $translationData['name'],
                    'description' => $translationData['description']
                ]);
            }
        }
    }
}
