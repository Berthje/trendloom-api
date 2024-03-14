<?php
namespace App\Modules\Products\Services;

use App\Models\Product;
use App\Modules\Core\Services\Service;

class ProductService extends Service {
    protected $fields= ['name', 'description', 'price', 'sku', 'status', 'ean_barcode', 'brand_id', 'category_id'];
    protected $searchField = 'product';

    public function __construct(Product $model) {
        parent::__construct($model);
    }

    protected $rules = [
        "add" => [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'sku' => 'required|string|unique:products,sku',
            'status' => 'required|in:active,hidden,draft',
            'ean_barcode' => 'required|string|unique:products,ean_barcode',
            'brand_id' => 'required|integer|exists:brands,id',
            'category_id' => 'required|integer|exists:categories,id',
        ],
        "update" => [
            'name' => 'sometimes|string',
            'description' => 'sometimes|string',
            'price' => 'sometimes|numeric',
            'sku' => 'sometimes|string',
            'status' => 'sometimes|string',
            'ean_barcode' => 'sometimes|string',
            'brand_id' => 'sometimes|integer|exists:brands,id',
            'category_id' => 'sometimes|integer|exists:categories,id',
        ],
        "delete" => [
            'id' => 'required|exists:products,id',
        ],
        "get" => [
            'id' => 'required|exists:products,id',
        ]
    ];

    protected function getRelationFields() {
        return [
            'brand',
            'category'
        ];
    }
}
