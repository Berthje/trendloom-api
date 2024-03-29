<?php
namespace App\Modules\Core\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use App\Models\Language;

abstract class FrontService {
    //TODO: make it more abstract to fit everywhere and can be handled better with app set/getlocale (i think)
    //TODO: this works now for authenticated users, how to handle this for unauthenticated users if they want to see the product etc in dutch aswell?
    protected $model;
    protected $languageCode;

    public function __construct(Model $model) {
        $this->model = $model;

        $user = auth('api')->user();
        $preferredLocale = $user ? $user->preferred_locale : null;
        $urlLocale = request('lang', 'en');

        $this->languageCode = $this->determineLanguageCode($urlLocale, $preferredLocale);
    }

    public function getTranslatedModel() {
        return $this->getTranslationQuery()
            ->where('languages.code', $this->languageCode)
            ->get();
    }

    private function determineLanguageCode($urlLocale, $preferredLocale) {
        if ($this->localeExistsInLanguagesTable($urlLocale)) {
            return $urlLocale;
        } else if ($this->localeExistsInLanguagesTable($preferredLocale)) {
            return $preferredLocale;
        } else {
            return App::getLocale();
        }
    }

    private function localeExistsInLanguagesTable($locale) {
        return Language::where('code', $locale)->exists();
    }

    abstract protected function getTranslationQuery();
}
