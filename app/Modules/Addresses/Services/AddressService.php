<?php
namespace App\Modules\Addresses\Services;

use App\Models\Address;
use App\Models\Customer;
use App\Modules\Core\Services\AuthenticatedService;

class AddressService extends AuthenticatedService {
    protected $fields= ['address', 'city', 'state', 'zip', 'type', 'country'];
    protected $searchField = 'address';
    protected $rules = [
        "add" => [
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zip' => 'required|string',
            'type' => 'sometimes|string',
            'country' => 'required|string'
        ],
        "update" => [
            'address' => 'sometimes|string',
            'city' => 'sometimes|string',
            'state' => 'sometimes|string',
            'zip' => 'sometimes|string',
            'type' => 'sometimes|string',
            'country' => 'sometimes|string'
        ],
        "delete" => [
            'id' => 'required|exists:addresses,id',
        ],
        "get" => [
            'id' => 'required|exists:addresses,id',
        ]
    ];

    public function __construct(Address $model) {
        parent::__construct($model);
    }

    public function isAllowed(int $entityAddressId, int $userId): bool
    {
        $user = Customer::find($userId);

        return $user->address_id === $entityAddressId || $user->isAdmin();
    }
}
