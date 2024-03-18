<?php
namespace App\Modules\ProductStock\Services;

use App\Models\ProductStock;
use App\Modules\Core\Services\Service;

class ProductStockService extends Service {
    protected $fields= ['product_id', 'size_id', 'quantity_in_stock'];
    protected $searchField = 'productStock';

    public function __construct(ProductStock $model) {
        parent::__construct($model);
    }

    protected $rules = [
        "add" => [
            'product_id' => 'required|integer|exists:products,id',
            'size_id' => 'required|integer|exists:product_sizes,id',
            'quantity_in_stock' => 'required|integer'
        ],
        "update" => [
            'product_id' => 'sometimes|integer|exists:products,id',
            'size_id' => 'sometimes|integer|exists:product_sizes,id',
            'quantity_in_stock' => 'sometimes|integer'
        ],
        "delete" => [
            'id' => 'required|exists:product_stock,id',
        ],
        "get" => [
            'id' => 'required|exists:product_stock,id',
        ]
    ];

    protected function getRelationFields() {
        return [
            'product:id,name,description,price,sku,status,ean_barcode,brand_id,category_id'
        ];
    }
}
