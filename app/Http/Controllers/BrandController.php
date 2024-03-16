<?php

namespace App\Http\Controllers;

use App\Modules\Brands\Services\BrandService;
use Illuminate\Http\Request;

class BrandController extends ApiServiceController
{
    public function __construct(BrandService $service)
    {
        $this->service = $service;
    }

    public function getAllBrands()
    {
        return $this->getAll();
    }

    public function createBrand(Request $request)
    {
        return $this->create($request);
    }

    public function getBrandById($brandId)
    {
        return $this->get($brandId);
    }

    public function updateBrand(Request $request, $brandId)
    {
        return $this->update($request, $brandId);
    }

    public function deleteBrand($brandId)
    {
        return $this->delete($brandId);
    }
}
