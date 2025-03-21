<?php
namespace App\Modules\Wishlists\Services;

use App\Models\Wishlist;
use App\Models\Customer;
use App\Modules\Core\Services\AuthenticatedService;

class WishlistService extends AuthenticatedService {
    protected $fields= ['customer_id', 'product_id'];
    protected $searchField = 'wishlist';
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

    public function __construct(Wishlist $model) {
        parent::__construct($model);
    }

    public function isAllowed(int $entityWishlistId, int $userId): bool
    {
        $user = Customer::find($userId);
        $wishlist = Wishlist::find($entityWishlistId);

        return $wishlist->customer_id === $userId || $user->isAdmin();
    }

    public function getProductsByCustomerId($customerId)
    {
        $customer = Customer::find($customerId);

        if ($customer) {
            $products = $customer->wishlist->flatMap->products;
            return $products;
        }

        return null;
    }

    protected function getRelationFields() {
        return [
            'customer',
            'products'
        ];
    }
}
