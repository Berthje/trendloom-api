<?php

namespace App\Modules\Categories\Services;

use App\Models\Category;
use App\Modules\Core\Services\Service;

class CategoryService extends Service
{
    protected $fields = ['name', 'description', 'parent_category_id'];
    protected $searchField = 'category';

    public function __construct(Category $model)
    {
        parent::__construct($model);
    }

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

    protected function getRelationFields() {
        return [
            'parent'
        ];
    }
}
