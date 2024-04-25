<?php

namespace App\Http\Controllers;

use App\Modules\Addresses\Services\AddressService;
use Illuminate\Http\Request;

class AddressController extends ApiServiceController
{
    public function __construct(AddressService $service)
    {
        $this->service = $service;
    }

    public function getAllAddresses(Request $request)
    {
        return $this->getAll($request);
    }

    public function createAddress(Request $request)
    {
        return $this->create($request);
    }

    public function getAddressById($brandId)
    {
        return $this->get($brandId);
    }

    public function updateAddress(Request $request, $brandId)
    {
        return $this->update($request, $brandId);
    }

    public function deleteAddress($brandId)
    {
        return $this->delete($brandId);
    }
}
