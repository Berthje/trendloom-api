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


    protected function getTranslationQuery($request)
    {
        $searchParameter = $request->search;
        $query = $this->model
            ->with(['brand', 'category', 'sizes', 'media', 'stock'])
            ->join('product_languages', 'product_languages.product_id', '=', 'products.id')
            ->join('languages', 'languages.id', '=', 'product_languages.language_id')
            ->select('products.*', 'languages.code', 'product_languages.name', 'product_languages.description', 'product_languages.price', 'product_languages.tags');

        if ($searchParameter) {
            $searchParameter = strtolower($searchParameter);
            $query->where(function ($query) use ($searchParameter) {
                $query->whereRaw('LOWER(product_languages.name) LIKE ?', ['%' . $searchParameter . '%'])
                    ->orWhereRaw('JSON_CONTAINS(JSON_UNQUOTE(JSON_EXTRACT(LOWER(product_languages.tags), "$")), ?)', [json_encode($searchParameter)]);
            });
        }

        return $query;
    }

    public function getProductById($request, $productId)
    {
        $query = $this->getTranslationQuery($request)
            ->where('products.id', $productId);

        if ($request->has('lang')) {
            $query->where('languages.code', $request->input('lang', 'en'));
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
        return $this->getTranslationQuery($request)->where('languages.code', $this->languageCode);
    }

    public function applySorting($query, $request, $defaultSort = 'default')
    {
        $sort = $request->input('sort', $defaultSort);

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

    public function paginateQuery($query, $request, $defaultItemCount = 12)
    {
        $itemCount = $request->input('itemCount', $defaultItemCount);

        if ($itemCount === 'all') {
            $itemCount = $query->count();
        }

        return $query->paginate($itemCount)->withQueryString();
    }
}
