<?php
namespace App\Modules\Core\Services;

use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Validator;

abstract class Service {
    protected $model;
    protected $fields;
    protected $searchField;
    protected $rules;
    protected $errors;

    public function __construct($model) {
        $this->model = $model;
        $this->errors = new MessageBag();
    }

    protected function getRelationFields() {
        return [];
    }

    public function find($id) {
        return $this->model->select($this->fields)->with($this->getRelationFields())->find($id);
    }

    public function create($data, $ruleKey = "add") {
        $this->validate($data, $ruleKey);

        if ($this->HasErrors()) {
            return;
        }

        return $this->model->create($data);
    }

    public function validate($data, $ruleKey) {
        $rules = isset($this->rules[$ruleKey]) ? $this->rules[$ruleKey] : $this->rules;

        $this->errors = new MessageBag();
        $validator = Validator::make($data, $rules);

        if($validator->fails()){
            $this->errors = $validator->errors();
        }
    }

    public function getErrors() {
        return $this->errors;
    }

    public function hasErrors() {
        return $this->errors->isNotEmpty();
    }
}
