<?php

namespace App\Modules\Translations\Services;

class TranslationService
{
    protected $lang;

    public function __construct($lang)
    {
        $this->lang = request('lang', 'en');
    }

    public function getTranslation()
    {
        App::setLocale($this->lang);

        $translations = [
            "en" => [
                "hello" => "Hello",
                "world" => "World"
            ],
            "nl" => [
                "hello" => "Hallo",
                "world" => "Wereld"
            ]
        ];
    }
}
