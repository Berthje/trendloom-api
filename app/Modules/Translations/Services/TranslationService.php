<?php

namespace App\Modules\Translations\Services;

use Illuminate\Support\Facades\App;

class TranslationService
{
    protected $lang;

    public function __construct()
    {
        $this->lang = request('lang', 'en');
    }

    public function getTranslation()
    {
        App::setLocale($this->lang);

        return trans('webshop');
    }
}
