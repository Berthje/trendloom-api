<?php

namespace App\Modules\Categories\Services;

use App\Models\Category;
use App\Modules\Core\Services\FrontService;
use Illuminate\Pagination\LengthAwarePaginator;

class CategoryFrontService extends FrontService
{
    public function __construct(Category $model)
    {
        parent::__construct($model);
    }

    protected function getTranslationQuery()
    {
        return $this->model
            ->with(['parent'])
            ->join('category_languages', 'category_languages.category_id', '=', 'categories.id')
            ->join('languages', 'languages.id', '=', 'category_languages.language_id')
            ->select('categories.*', 'languages.*', 'category_languages.*');
    }

    public function getCategoryById($request, $categoryId)
    {
        $query = $this->getTranslationQuery()
            ->where('categories.id', $categoryId);

        if ($request->has('lang')) {
            $query->where('languages.code', $request->input('lang'));
        }

        $category = $query->first();

        return $category;
    }

    public function getProductsByCategoryId($request, $categoryId)
    {
        $itemCount = $request->input('itemCount', 12);
        $lang = $request->input('lang');

        $category = $this->getCategoryWithProducts($categoryId, $lang);

        if ($category === null) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        $products = $this->getProductsWithLanguage($category, $lang);

        $childProducts = $this->getProductsFromChildCategories($category->children, $lang);

        $allProducts = $products->concat($childProducts);

        return $this->paginate($allProducts, $request->input('page', 1), $itemCount);
    }

    private function getCategoryWithProducts($categoryId, $lang)
    {
        return $this->model
            ->with(['products' => function ($query) use ($lang) {
                if ($lang) {
                    $this->applyLanguageFilter($query, $lang);
                }
            }, 'children.products'])
            ->where('id', $categoryId)
            ->first();
    }

    private function getProductsWithLanguage($category, $lang)
    {
        $query = $category->products();

        if ($lang) {
            $this->applyLanguageFilter($query, $lang);
        } else {
            $query->select('products.*');
        }

        $query->with(['brand', 'category', 'media', 'sizes']);

        return $query->get();
    }

    private function getProductsFromChildCategories($children, $lang)
    {
        $products = collect();

        foreach ($children as $child) {
            $childProducts = $this->getProductsWithLanguage($child, $lang);

            $products = $products->concat($childProducts);

            if ($child->children->isNotEmpty()) {
                $products = $products->concat($this->getProductsFromChildCategories($child->children, $lang));
            }
        }

        return $products;
    }

    private function applyLanguageFilter($query, $lang)
    {
        $query->select('products.id', 'product_languages.name', 'product_languages.description', 'products.price', 'products.sku', 'products.status', 'products.ean_barcode', 'products.brand_id', 'products.category_id')
            ->join('product_languages', 'products.id', '=', 'product_languages.product_id')
            ->join('languages', 'languages.id', '=', 'product_languages.language_id')
            ->where('languages.code', $lang);
    }

    private function paginate($items, $currentPage, $perPage)
    {
        return new LengthAwarePaginator($items->forPage($currentPage, $perPage), $items->count(), $perPage);
    }
}
