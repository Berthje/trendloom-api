<?php
namespace App\Modules\Core\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

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

    abstract protected function getTranslationQuery();
}
