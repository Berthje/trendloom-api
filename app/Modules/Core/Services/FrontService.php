<?php
namespace App\Modules\Core\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Pagination\LengthAwarePaginator;

abstract class FrontService {
    protected $model;
    protected $languageCode;

    public function __construct(Model $model) {
        $this->model = $model;
        $this->languageCode = App::getLocale();
    }

    public function getTranslatedModel($request) {
        $itemCount = $request->input('itemCount', 12);

        return $this->getTranslationQuery()
            ->where('languages.code', $this->languageCode)
            ->paginate($itemCount)->withQueryString();
    }

    public function paginate($items, $currentPage, $perPage)
    {
        return new LengthAwarePaginator($items->forPage($currentPage, $perPage), $items->count(), $perPage);
    }

    public function applyLanguageFilter($query, $lang)
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

    abstract protected function getTranslationQuery();
}
