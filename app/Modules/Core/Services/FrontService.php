<?php
namespace App\Modules\Core\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use App\Models\Language;

abstract class FrontService {
    //TODO: make it more abstract to fit everywhere and can be handled better with app set/getlocale
    //TODO: this works now for authenticated users, how to handle this for unauthenticated users if they want to see the product etc in dutch aswell?
    protected $model;
    protected $languageCode;

    public function __construct(Model $model) {
        $this->model = $model;

        $user = auth('api')->user();
        $preferredLocale = $user ? $user->preferred_locale : null;
        $localeExistsInLanguagesTable = Language::where('code', $preferredLocale)->exists();

        $this->languageCode = $localeExistsInLanguagesTable ? $preferredLocale : App::getLocale();
    }

    public function getTranslatedModel() {
        return $this->getTranslationQuery()
            ->where('languages.code', $this->languageCode)
            ->get();
    }

    abstract protected function getTranslationQuery();
}
