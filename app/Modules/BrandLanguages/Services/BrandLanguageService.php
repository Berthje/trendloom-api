<?php
namespace App\Modules\BrandLanguages\Services;

use App\Models\BrandLanguage;
use App\Modules\Core\Services\Service;

class BrandLanguageService extends Service {
    protected $fields= ['brand_id', 'language_id', 'name', 'description'];
    protected $searchField = 'brandLanguage';

    public function __construct(BrandLanguage $model) {
        parent::__construct($model);
    }

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

    protected function getRelationFields() {
        return [
            'brand:id,name,description,logo_url',
            'language:id,name,code'
        ];
    }
}
