<?php
namespace App\Modules\Customers\Services;

use App\Models\Customer;
use App\Modules\Core\Services\Service;

class CustomerService extends Service {
    protected $fields= ['first_name', 'last_name', 'email', 'phone_number', 'password', 'address_id'];
    protected $searchField = 'customer';
    protected $rules = [
        "add" => [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:customers,email',
            'phone_number' => 'required|string',
            'password' => 'required|string|min:6',
            'address_id' => 'required|exists:addresses,id'
        ],
        "update" => [
            'first_name' => 'sometimes|string',
            'last_name' => 'sometimes|string',
            'email' => 'sometimes|email|unique:customers,email',
            'phone_number' => 'sometimes|string',
            'password' => 'sometimes|string|min:6',
            'address_id' => 'sometimes|exists:addresses,id'
        ],
        "delete" => [
            'id' => 'required|exists:customers,id',
        ],
        "get" => [
            'id' => 'required|exists:customers,id',
        ]
    ];

    public function __construct(Customer $model) {
        parent::__construct($model);
    }

    protected function getRelationFields() {
        return [
            'addresses:id,address,city,state,zip,country'
        ];
    }

    public function getAddressesByCustomerId($customerId) {
        return $this->model->find($customerId)->addresses;
    }
}
