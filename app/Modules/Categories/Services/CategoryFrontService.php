<?php

namespace App\Modules\Categories\Services;

use App\Models\Category;
use App\Modules\Core\Services\FrontService;

class CategoryFrontService extends FrontService
{
    public function __construct(Category $model)
    {
        parent::__construct($model);
    }

    protected function getTranslationQuery($request)
    {
        return $this->model
            ->with('parent', 'media')
            ->join('category_languages', 'category_languages.category_id', '=', 'categories.id')
            ->join('languages', 'languages.id', '=', 'category_languages.language_id')
            ->select('categories.*', 'languages.*', 'category_languages.*');
    }

    public function getCategoryById($request, $categoryId)
    {
        $query = $this->getTranslationQuery($request)
            ->where('categories.id', $categoryId);

        if ($request->has('lang')) {
            $query->where('languages.code', $request->input('lang', 'en'));
        }

        $category = $query->first();

        return $category;
    }

    public function getProductsByCategoryId($request, $categoryId)
    {
        $itemCount = $request->input('itemCount', 12);
        $lang = $request->input('lang', 'en');
        $sort = $request->input('sort', 'default');

        $category = $this->getCategoryWithProducts($categoryId, $lang);

        if ($category === null) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        $products = $this->getProductsWithLanguage($category, $request);

        $childProducts = $this->getProductsFromChildCategories($category->children, $request);

        $allProducts = $products->concat($childProducts);

        $allProducts = $this->sortProducts($allProducts, $sort);

        //This extra step is needed to get absolute paths in my links for pagination for this specific exception endpoint, laravel normally
        //generates relative paths but because it is an exception endpoint I need to generate absolute paths (/brands and /products etc work fine without this step)
        $paginator = $this->paginate($allProducts, $request->input('page', 1), $itemCount);

        $paginator->setPath(url("api/categories/{$categoryId}/products"));

        $paginator->appends('itemCount', $itemCount);

        return $paginator;
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

    private function getProductsWithLanguage($category, $request)
    {
        $query = $category->products();

        if ($request->has('lang')) {
            $this->applyLanguageFilter($query, $request->input('lang', 'en'));
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
}
