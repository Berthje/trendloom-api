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
        $category = $this->model
            ->with(['products', 'children.products'])
            ->where('id', $categoryId)
            ->first();

        $products = $category->products;

        $products = $products->concat($this->getProductsFromChildren($category->children));

        return $products;
    }

    private function getProductsFromChildren($children)
    {
        $products = collect();

        foreach ($children as $child) {
            $products = $products->concat($child->products);

            if ($child->children->isNotEmpty()) {
                $products = $products->concat($this->getProductsFromChildren($child->children));
            }
        }

        return $products;
    }
}
