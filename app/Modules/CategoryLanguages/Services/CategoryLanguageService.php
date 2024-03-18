<?php
namespace App\Modules\CategoryLanguages\Services;

use App\Models\CategoryLanguage;
use App\Modules\Core\Services\Service;

class CategoryLanguageService extends Service {
    protected $fields= ['name', 'description', 'category_id', 'language_id'];
    protected $searchField = 'categoryLanguage';

    public function __construct(CategoryLanguage $model) {
        parent::__construct($model);
    }

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

    protected function getRelationFields() {
        return [
            'category:id,name,description,parent_category_id',
            'language:id,name,code',
        ];
    }
}
