<?php
namespace App\Modules\ProductSizes\Services;

use App\Models\ProductSize;
use App\Modules\Core\Services\Service;

class ProductSizeService extends Service {
    protected $fields= ['product_id', 'size'];
    protected $searchField = 'productSize';
    protected $rules = [
        "add" => [
            'product_id' => 'required|integer|exists:products,id',
            'size' => ['required', 'string', 'regex:/^(\d{2}|EU \d{2})$/']
        ],
        "update" => [
            'product_id' => 'sometimes|integer|exists:products,id',
            'size' => ['required', 'string', 'regex:/^(\d{2}|EU \d{2})$/']
        ],
        "delete" => [
            'id' => 'required|exists:product_sizes,id',
        ],
        "get" => [
            'id' => 'required|exists:product_sizes,id',
        ]
    ];

    public function __construct(ProductSize $model) {
        parent::__construct($model);
    }

    protected function getRelationFields() {
        return [
            'product:id,name,description,price,sku,status,ean_barcode,brand_id,category_id'
        ];
    }
}
