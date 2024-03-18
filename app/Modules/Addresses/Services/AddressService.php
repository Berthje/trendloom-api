<?php
namespace App\Modules\Addresses\Services;

use App\Models\Address;
use App\Modules\Core\Services\Service;

class AddressService extends Service {
    protected $fields= ['address', 'city', 'state', 'zip', 'country'];
    protected $searchField = 'address';

    public function __construct(Address $model) {
        parent::__construct($model);
    }

    protected $rules = [
        "add" => [
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zip' => 'required|string',
            'country' => 'required|string'
        ],
        "update" => [
            'address' => 'sometimes|string',
            'city' => 'sometimes|string',
            'state' => 'sometimes|string',
            'zip' => 'sometimes|string',
            'country' => 'sometimes|string'
        ],
        "delete" => [
            'id' => 'required|exists:addresses,id',
        ],
        "get" => [
            'id' => 'required|exists:addresses,id',
        ]
    ];
}
