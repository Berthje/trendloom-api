<?php
namespace App\Modules\Core\Services;

use App\Modules\Core\Services\Service;
use App\Modules\Languages\Services\LanguageService;
use App\Models\Language;

class TranslatableService extends Service {
    protected $translationService;

    public function __construct($model, $translationService) {
        parent::__construct($model);
        $this->translationService = $translationService;
    }

    public function create($data, $ruleKey = "add") {
        $this->validate($data, $ruleKey);

        if ($this->HasErrors()) {
            return;
        }

        $languageService = new LanguageService(new Language());

        if (!$languageService->areLanguagesValid($data)) {
            return response()->json(['error' => 'All available languages must be provided.'], 400);
        }

        $model = $this->model->create($data);

        $this->translationService->createTranslations($model, $data['languages']);

        return $model;
    }
}
