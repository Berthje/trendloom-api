<?php
namespace App\Modules\ProductMedia\Services;

use App\Models\ProductMedia;
use App\Modules\Core\Services\Service;

class ProductMediaService extends Service {
    protected $fields= ['product_id', 'image_url', 'is_primary'];
    protected $searchField = 'productMedia';

    public function __construct(ProductMedia $model) {
        parent::__construct($model);
    }

    protected $rules = [
        "add" => [
            'product_id' => 'required|integer|exists:products,id',
            'image_url' => 'required|string',
            'is_primary' => 'required|boolean',
        ],
        "update" => [
            'product_id' => 'sometimes|integer|exists:products,id',
            'image_url' => 'sometimes|string',
            'is_primary' => 'sometimes|boolean',
        ],
        "delete" => [
            'id' => 'required|exists:product_media,id',
        ],
        "get" => [
            'id' => 'required|exists:product_media,id',
        ]
    ];

    protected function getRelationFields() {
        return [
            'product:id,name,description,price,sku,status,ean_barcode,brand_id,category_id',
        ];
    }
}
