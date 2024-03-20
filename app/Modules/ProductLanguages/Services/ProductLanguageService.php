<?php
namespace App\Modules\ProductLanguages\Services;

use App\Models\ProductLanguage;
use App\Modules\Core\Services\Service;

class ProductLanguageService extends Service {
    protected $fields= ['product_id', 'language_id', 'name', 'description', 'price', 'tags'];
    protected $searchField = 'productLanguage';
    protected $rules = [
        "add" => [
            'product_id' => 'required|exists:products,id',
            'language_id' => 'required|exists:languages,id',
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'tags' => 'required|array'
        ],
        "update" => [
            'product_id' => 'sometimes|exists:products,id',
            'language_id' => 'sometimes|exists:languages,id',
            'name' => 'sometimes|string',
            'description' => 'sometimes|string',
            'price' => 'sometimes|numeric',
            'tags' => 'sometimes|array'
        ],
        "delete" => [
            'id' => 'required|exists:product_languages,id',
        ],
        "get" => [
            'id' => 'required|exists:product_languages,id',
        ]
    ];

    public function __construct(ProductLanguage $model) {
        parent::__construct($model);
    }

    protected function getRelationFields() {
        return [
            'product:id,name,description,price,sku,status,ean_barcode',
            'language:id,name,code',
        ];
    }
}
