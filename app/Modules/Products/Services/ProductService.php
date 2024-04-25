<?php
namespace App\Modules\Products\Services;

use App\Models\Product;
use App\Modules\Core\Services\Service;
use App\Models\Language;

class ProductService extends Service {
    protected $fields= ['name', 'description', 'price', 'sku', 'status', 'ean_barcode', 'brand_id', 'category_id'];
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

    public function __construct(Product $model) {
        parent::__construct($model);
    }

    protected function getRelationFields() {
        return [
            'brand:id,name,description,logo_url',
            'category:id,name,description,parent_category_id'
        ];
    }

    public function create($data, $ruleKey = "add") {
        $this->validate($data, $ruleKey);

        if ($this->HasErrors()) {
            return;
        }

        $availableLanguages = Language::all()->pluck('code')->toArray();

        if (!isset($data['languages']) || count(array_intersect($availableLanguages, array_keys($data['languages']))) !== count($availableLanguages)) {
            return response()->json(['error' => 'All available languages must be provided.'], 400);
        }

        $product = $this->model->create($data);

        foreach ($data['languages'] as $languageCode => $translationData) {
            $language = Language::where('code', $languageCode)->first();

            if ($language) {
                $product->translations()->create([
                    'language_id' => $language->id,
                    'name' => $translationData['name'],
                    'description' => $translationData['description'],
                    'price' => $translationData['price'],
                    'tags' => $translationData['tags'],
                ]);
            }
        }

        return $product;
    }
}
