<?php
namespace App\Modules\Languages\Services;

use App\Models\Language;
use App\Modules\Core\Services\Service;

class LanguageService extends Service {
    protected $fields= ['name', 'code'];
    protected $searchField = 'language';
    protected $rules = [
        "add" => [
            'name' => 'required|string',
            'code' => 'required|string'
        ],
        "update" => [
            'name' => 'required|string',
            'code' => 'required|string'
        ],
        "delete" => [
            'id' => 'required|exists:languages,id',
        ],
        "get" => [
            'id' => 'required|exists:languages,id',
        ],
    ];

    public function __construct(Language $model) {
        parent::__construct($model);
    }

    public function areLanguagesValid($data)
    {
        $availableLanguages = Language::all()->pluck('code')->toArray();

        return isset($data['languages']) && count(array_intersect($availableLanguages, array_keys($data['languages']))) === count($availableLanguages);
    }
}
