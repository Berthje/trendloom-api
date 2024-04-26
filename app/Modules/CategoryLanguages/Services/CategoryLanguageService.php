<?php

namespace App\Modules\CategoryLanguages\Services;

use App\Models\CategoryLanguage;
use App\Modules\Core\Services\Service;
use App\Models\Language;

class CategoryLanguageService extends Service
{
    protected $fields = ['name', 'description', 'category_id', 'language_id'];
    protected $searchField = 'categoryLanguage';
    protected $rules = [
        "add" => [
            'name' => 'required|string',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'language_id' => 'required|exists:languages,id'
        ],
        "update" => [
            'name' => 'sometimes|string',
            'description' => 'sometimes|string',
            'category_id' => 'sometimes|exists:categories,id',
            'language_id' => 'sometimes|exists:languages,id'
        ],
        "delete" => [
            'id' => 'required|exists:category_languages,id',
        ],
        "get" => [
            'id' => 'required|exists:category_languages,id',
        ]
    ];

    public function __construct(CategoryLanguage $model)
    {
        parent::__construct($model);
    }

    protected function getRelationFields()
    {
        return [
            'category:id,name,description,parent_category_id',
            'language:id,name,code',
        ];
    }

    public function createTranslations($category, $languages)
    {
        foreach ($languages as $languageCode => $translationData) {
            $language = Language::where('code', $languageCode)->first();

            if ($language) {
                $category->translations()->create([
                    'name' => $translationData['name'],
                    'description' => $translationData['description'],
                    'category_id' => $translationData['category_id'],
                    'language_id' => $language->id
                ]);
            }
        }
    }
}
