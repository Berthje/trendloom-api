<?php

namespace App\Modules\Brands\Services;

use App\Models\Brand;
use App\Modules\Core\Services\FrontService;

class BrandFrontService extends FrontService
{
    public function __construct(Brand $model)
    {
        parent::__construct($model);
    }

    protected function getTranslationQuery()
    {
        return $this->model
            ->select('brands.id as brand_id', 'brand_languages.name', 'brand_languages.description', 'brands.logo_url', 'languages.id as language_id', 'languages.code')
            ->join('brand_languages', 'brands.id', '=', 'brand_languages.brand_id')
            ->join('languages', 'languages.id', '=', 'brand_languages.language_id');
    }

    public function getBrandById($request, $brandId)
    {
        $query = $this->getTranslationQuery()
            ->where('brands.id', $brandId);

        if ($request->has('lang')) {
            $query->where('languages.code', $request->input('lang'));
        }

        $brand = $query->first();

        return $brand;
    }
}