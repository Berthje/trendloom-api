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

    public function update($id, $data, $ruleKey = "update") {
        $this->validate($data, $ruleKey);

        if ($this->HasErrors()) {
            return;
        }

        $languageService = new LanguageService(new Language());

        if (!$languageService->areLanguagesValid($data)) {
            return response()->json(['error' => 'All available languages must be provided.'], 400);
        }

        $modelData = $data;
        unset($modelData['languages']);
        $model = $this->model->find($id);
        $model->update($modelData);

        $this->updateTranslations($model, $data['languages']);

        return $model;
    }

    public function updateTranslations($model, $translations) {
        foreach ($translations as $language => $translationData) {
            $languageId = Language::where('code', $language)->first()->id;

            $translation = $model->translations()->where('language_id', $languageId)->first();

            if ($translation) {
                $translation->update($translationData);
            }
        }
    }
}
