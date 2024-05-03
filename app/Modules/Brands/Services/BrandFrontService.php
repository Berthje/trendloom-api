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

    protected function getTranslationQuery($request)
    {
        return $this->model
            ->select('brands.id', 'brand_languages.name', 'brand_languages.description', 'brands.logo_url', 'languages.id as language_id', 'languages.code')
            ->join('brand_languages', 'brands.id', '=', 'brand_languages.brand_id')
            ->join('languages', 'languages.id', '=', 'brand_languages.language_id');
    }

    public function getBrandById($request, $brandId)
    {
        $query = $this->getTranslationQuery($request)
            ->where('brands.id', $brandId);

        if ($request->has('lang')) {
            $query->where('languages.code', $request->input('lang', 'en'));
        }

        $brand = $query->first();

        return $brand;
    }

    public function getProductsByBrandId($request, $brandId)
    {
        $itemCount = $request->input('itemCount', 12);
        $lang = $request->input('lang', 'en');
        $sort = $request->input('sort', 'default');

        $productsQuery = $this->model->find($brandId)->products();
        $productsQuery->with(['brand', 'category', 'media', 'sizes']);

        if ($lang) {
            $this->applyLanguageFilter($productsQuery, $lang);
        }

        $products = $productsQuery->get();

        $products = $this->sortProducts($products, $sort);

        return $this->paginate($products, $request->input('page', 1), $itemCount);
    }
}
