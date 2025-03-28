<?php

namespace App\Modules\Brands\Services;

use App\Models\Brand;
use App\Models\BrandLanguage;
use App\Modules\BrandLanguages\Services\BrandLanguageService;
use App\Modules\Core\Services\TranslatableService;

class BrandService extends TranslatableService
{
    protected $fields = ['name', 'description', 'logo_url'];
    protected $searchField = 'brand';
    protected $rules = [
        "add" => [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'logo_url' => 'required|string'
        ],
        "update" => [
            'name' => 'sometimes|string',
            'description' => 'sometimes|string',
            'logo_url' => 'sometimes|string'
        ],
        "delete" => [
            'id' => 'required|exists:brands,id',
        ],
        "get" => [
            'id' => 'required|exists:brands,id',
        ]
    ];

    public function __construct(Brand $model)
    {
        parent::__construct($model, new BrandLanguageService(new BrandLanguage()));
    }
}
