<?php

namespace App\Modules\Products\Services;

use App\Models\Product;
use App\Modules\Core\Services\Service;
use App\Models\ProductLanguage;
use App\Models\Language;
use App\Modules\ProductLanguages\Services\ProductLanguageService;
use App\Modules\Languages\Services\LanguageService;

class ProductService extends Service
{
    protected $fields = ['name', 'description', 'price', 'sku', 'status', 'ean_barcode', 'brand_id', 'category_id'];
    protected $searchField = 'product';
    protected $rules = [
        "add" => [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'sku' => 'required|string|unique:products,sku',
            'status' => 'required|in:active,hidden,draft',
            'ean_barcode' => 'required|string|unique:products,ean_barcode',
            'brand_id' => 'required|integer|exists:brands,id',
            'category_id' => 'required|integer|exists:categories,id',
        ],
        "update" => [
            'name' => 'sometimes|string',
            'description' => 'sometimes|string',
            'price' => 'sometimes|numeric',
            'sku' => 'sometimes|string',
            'status' => 'sometimes|string|in:active,hidden,draft',
            'ean_barcode' => 'sometimes|string|unique:products,ean_barcode',
            'brand_id' => 'sometimes|integer|exists:brands,id',
            'category_id' => 'sometimes|integer|exists:categories,id',
        ],
        "delete" => [
            'id' => 'required|exists:products,id',
        ],
        "get" => [
            'id' => 'required|exists:products,id',
        ]
    ];

    public function __construct(Product $model)
    {
        parent::__construct($model);
    }

    protected function getRelationFields()
    {
        return [
            'brand:id,name,description,logo_url',
            'category:id,name,description,parent_category_id'
        ];
    }

    public function create($data, $ruleKey = "add")
    {
        $this->validate($data, $ruleKey);

        if ($this->HasErrors()) {
            return;
        }

        $languageService = new LanguageService(new Language());

        if (!$languageService->areLanguagesValid($data)) {
            return response()->json(['error' => 'All available languages must be provided.'], 400);
        }

        $product = $this->model->create($data);
        $productLanguageService = new ProductLanguageService(new ProductLanguage());

        $productLanguageService->createTranslations($product, $data['languages']);

        return $product;
    }
}
