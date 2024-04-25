<?php

namespace App\Modules\Categories\Services;

use App\Models\Category;
use App\Modules\Core\Services\Service;
use App\Models\Language;
use App\Models\CategoryLanguage;
use App\Modules\CategoryLanguages\Services\CategoryLanguageService;
use App\Modules\Languages\Services\LanguageService;


class CategoryService extends Service
{
    protected $fields = ['name', 'description', 'parent_category_id'];
    protected $searchField = 'category';
    protected $rules = [
        "add" => [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'parent_category_id' => 'sometimes|exists:categories,id|nullable|integer'
        ],
        "update" => [
            'name' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'parent_category_id' => 'sometimes|exists:categories,id|nullable|integer'
        ],
        "delete" => [
            'id' => 'required|exists:categories,id',
        ],
        "get" => [
            'id' => 'required|exists:categories,id',
        ]
    ];

    public function __construct(Category $model)
    {
        parent::__construct($model);
    }

    protected function getRelationFields()
    {
        return [
            'parent'
        ];
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

        $category = $this->model->create($data);
        $categoryLanguageService = new CategoryLanguageService(new CategoryLanguage());

        $categoryLanguageService->createTranslations($category, $data['languages']);

        return $category;
    }
}
