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
        parent::__construct($model, new CategoryLanguageService(new CategoryLanguage()));
    }

    protected function getRelationFields()
    {
        return [
            'parent'
        ];
    }
}
