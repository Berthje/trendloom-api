<?php

namespace App\Modules\Translations\Services;

use Illuminate\Support\Facades\App;
use App\Models\Language;

class TranslationService
{
    protected $lang;

    public function __construct()
    {
        $this->lang = request('lang', 'en');
    }

    public function getTranslations()
    {
        $languages = Language::all()->pluck('code')->toArray();
        $translations = [];

        foreach ($languages as $language) {
            App::setLocale($language);
            $translations[$language] = trans('webshop');
        }

        return $translations;
    }
}
