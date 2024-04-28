<?php

namespace App\Modules\Brands\Services;

use App\Models\Brand;
use App\Modules\Core\Services\FrontService;
use Illuminate\Pagination\LengthAwarePaginator;

class BrandFrontService extends FrontService
{
    public function __construct(Brand $model)
    {
        parent::__construct($model);
    }

    protected function getTranslationQuery()
    {
        return $this->model
        ->select('brands.id', 'brand_languages.name', 'brand_languages.description', 'brands.logo_url', 'languages.id as language_id', 'languages.code')
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

    public function getProductsByBrandId($request, $brandId)
    {
        $itemCount = $request->input('itemCount', 12);
        $lang = $request->input('lang');
        $sort = $request->input('sort', 'default');

        $productsQuery = $this->model->find($brandId)->products();

        if ($lang) {
            $this->applyLanguageFilter($productsQuery, $lang);
        }

        $products = $productsQuery->get();

        $products = $this->sortProducts($products, $sort);

        return $this->paginate($products, $request->input('page', 1), $itemCount);
    }

    private function applyLanguageFilter($query, $lang)
    {
        $query->select('products.id', 'product_languages.name', 'product_languages.description', 'products.price', 'products.sku', 'products.status', 'products.ean_barcode', 'products.brand_id', 'products.category_id')
            ->join('product_languages', 'products.id', '=', 'product_languages.product_id')
            ->join('languages', 'languages.id', '=', 'product_languages.language_id')
            ->where('languages.code', $lang);
    }

    public function sortProducts($allProducts, $sort)
    {
        switch ($sort) {
            case 'price_low_high':
                return $allProducts->sortBy('price')->values();
            case 'price_high_low':
                return $allProducts->sortByDesc('price')->values();
            case 'latest':
                return $allProducts->sortByDesc('created_at')->values();
            default:
                return $allProducts;
        }
    }

    private function paginate($items, $currentPage, $perPage)
    {
        return new LengthAwarePaginator($items->forPage($currentPage, $perPage), $items->count(), $perPage);
    }
}
