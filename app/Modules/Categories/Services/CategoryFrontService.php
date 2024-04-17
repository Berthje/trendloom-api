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
}
