<?php

namespace App\Http\Controllers;

use App\Modules\Customers\Services\CustomerService;
use Illuminate\Http\Request;

class CustomerController extends ApiServiceController
{
    public function __construct(CustomerService $service)
    {
        $this->service = $service;
    }

    public function getAllCustomers()
    {
        return $this->getAll();
    }

    public function createCustomer(Request $request)
    {
        return $this->create($request);
    }

    public function getCustomerById($customerId)
    {
        return $this->get($customerId);
    }

    public function updateCustomer(Request $request, $customerId)
    {
        return $this->update($request, $customerId);
    }

    public function deleteCustomer($customerId)
    {
        return $this->delete($customerId);
    }

    public function getAddressesByCustomerId($customerId)
    {
        return $this->service->getAddressesByCustomerId($customerId);
    }
}
