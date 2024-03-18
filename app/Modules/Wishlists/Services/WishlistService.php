<?php
namespace App\Modules\Wishlists\Services;

use App\Models\Wishlist;
use App\Modules\Core\Services\Service;

class WishlistService extends Service {
    protected $fields= ['customer_id', 'product_id'];
    protected $searchField = 'wishlist';

    public function __construct(Wishlist $model) {
        parent::__construct($model);
    }

    protected $rules = [
        "add" => [
            'customer_id' => 'required|exists:customers,id',
            'product_id' => 'required|exists:products,id'
        ],
        "update" => [
            'customer_id' => 'sometimes|exists:customers,id',
            'product_id' => 'sometimes|exists:products,id'
        ],
        "delete" => [
            'id' => 'required|exists:wishlists,id',
        ],
        "get" => [
            'id' => 'required|exists:wishlists,id',
        ]
    ];

    protected function getRelationFields() {
        return [
            'customer',
            'product'
        ];
    }
}
