<?php

namespace App\Http\Controllers;

use App\Modules\Brands\Services\CustomerService;
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

    public function getCustomerById($brandId)
    {
        return $this->get($brandId);
    }

    public function updateCustomer(Request $request, $brandId)
    {
        return $this->update($request, $brandId);
    }

    public function deleteCustomer($brandId)
    {
        return $this->delete($brandId);
    }
}
