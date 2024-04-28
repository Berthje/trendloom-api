<?php

namespace App\Modules\Products\Services;

use App\Models\Product;
use App\Modules\Core\Services\FrontService;

class ProductFrontService extends FrontService
{
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }

    protected function getTranslationQuery()
    {
        return $this->model
            ->with(['brand', 'category', 'sizes', 'media'])
            ->join('product_languages', 'product_languages.product_id', '=', 'products.id')
            ->join('languages', 'languages.id', '=', 'product_languages.language_id')
            ->select('products.*', 'languages.*', 'product_languages.*');
    }

    public function getProductById($request, $productId)
    {
        $query = $this->getTranslationQuery()
            ->where('products.id', $productId);

        if ($request->has('lang')) {
            $query->where('languages.code', $request->input('lang'));
        }

        $product = $query->first();

        return $product;
    }

    public function getTranslatedModel($request)
    {
        $query = $this->prepareQuery($request);
        $query = $this->applySorting($query, $request);
        return $this->paginateQuery($query, $request);
    }

    private function prepareQuery($request)
    {
        $itemCount = $request->input('itemCount', 12);
        return $this->getTranslationQuery()->where('languages.code', $this->languageCode);
    }

    private function applySorting($query, $request)
    {
        $sort = $request->input('sort', 'default');

        switch ($sort) {
            case 'price_low_high':
                return $query->orderBy('products.price', 'asc');
            case 'price_high_low':
                return $query->orderBy('products.price', 'desc');
            case 'latest':
                return $query->orderBy('products.created_at', 'desc');
            default:
                return $query;
        }
    }

    private function paginateQuery($query, $request)
    {
        $itemCount = $request->input('itemCount', 12);

        if ($itemCount === 'all') {
            $itemCount = $query->count();
        }

        return $query->paginate($itemCount)->withQueryString();
    }
}
