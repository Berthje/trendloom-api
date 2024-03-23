<?php
namespace App\Modules\Core\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

abstract class FrontService {
    protected $model;
    protected $languageCode;

    public function __construct(Model $model) {
        $this->model = $model;
        $this->languageCode = request('lang', 'en');
    }

    public function getModel($data) {
        if(App::getLocale() != $this->languageCode) {
            App::setLocale($this->languageCode);
        }

        return $this->getTranslationQuery()
            ->where('languages.code', $this->languageCode)
            ->get();
    }

    abstract protected function getTranslationQuery();
}
