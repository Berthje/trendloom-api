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

    public function get($id, $ruleKey = "get") {
        $this->validate(['id' => $id], $ruleKey);

        if ($this->hasErrors()) {
            return;
        }

        return $this->model->with($this->getRelationFields())->find($id);
    }

    public function add($data, $ruleKey = "add") {
        $this->validate($data, $ruleKey);

        if ($this->HasErrors()) {
            return;
        }

        return $this->model->create($data);
    }

    public function update($id, $data, $ruleKey = "update") {
        $this->validate($data, $ruleKey);

        if ($this->HasErrors()) {
            return;
        }

        return $this->model->where('id', $id)->update($data);
    }

    public function delete($id, $ruleKey = "delete") {
        $this->validate(['id' => $id], $ruleKey);

        if ($this->HasErrors()) {
            return;
        }

        return $this->model->where('id', $id)->delete();
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