<?php

namespace App\Http\Controllers;

use App\Modules\Wishlists\Services\WishlistService;
use App\Models\Customer;
use Illuminate\Http\Request;

class WishlistController extends ApiServiceController
{
    public function __construct(WishlistService $service)
    {
        $this->service = $service;
    }

    public function getAllWishlists(Request $request)
    {
        return $this->getAll($request);
    }

    public function createWishlist(Request $request)
    {
        return $this->create($request);
    }

    public function getWishlistById($wishlistId)
    {
        return $this->get($wishlistId);
    }

    public function updateWishlist(Request $request, $wishlistId)
    {
        return $this->update($request, $wishlistId);
    }

    public function deleteWishlist($wishlistId)
    {
        return $this->delete($wishlistId);
    }

    public function getProducts($customerId)
    {
        $products = $this->service->getProductsByCustomerId($customerId);

        if ($products) {
            return response()->json($products);
        }

        return response()->json(['message' => 'Customer not found'], 404);
    }
}
