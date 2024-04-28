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

    abstract protected function getTranslationQuery();
}
