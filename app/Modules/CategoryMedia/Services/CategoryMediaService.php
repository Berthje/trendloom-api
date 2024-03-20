<?php
namespace App\Modules\CategoryMedia\Services;

use App\Models\CategoryMedia;
use App\Modules\Core\Services\Service;

class CategoryMediaService extends Service {
    protected $fields= ['category_id', 'image_url'];
    protected $searchField = 'categoryMedia';
    protected $rules = [
        "add" => [
            'category_id' => 'required|exists:categories,id',
            'image_url' => 'required|string'
        ],
        "update" => [
            'category_id' => 'sometimes|exists:categories,id',
            'image_url' => 'sometimes|string'
        ],
        "delete" => [
            'id' => 'required|exists:category_media,id',
        ],
        "get" => [
            'id' => 'required|exists:category_media,id',
        ]
    ];

    public function __construct(CategoryMedia $model) {
        parent::__construct($model);
    }

    protected function getRelationFields() {
        return [
            'category:id,name,description,parent_category_id',
        ];
    }
}
