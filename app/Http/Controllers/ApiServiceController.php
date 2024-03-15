<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modules\Core\Services\Service;
use Illuminate\Http\Response;

class ApiServiceController extends Controller
{
    protected $service;

    public function get($id) {
        $model = $this->service->get($id);

        if (!$model) {
            return response()->json(null, Response::HTTP_NOT_FOUND);
        }

        return response()->json($model, Response::HTTP_OK);
    }

    public function delete($id) {
        $model = $this->service->delete($id);

        if (!$model) {
            return response()->json(null, Response::HTTP_NOT_FOUND);
        }

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    public function create(Request $request) {
        $model = $this->service->create($request->all());

        return $this->handleResponse($model, Response::HTTP_CREATED);
    }

    public function update(Request $request, $id) {
        $model = $this->service->update($id, $request->all());

        return $this->handleResponse($model, Response::HTTP_OK);
    }

    public function getAll() {
        $models = $this->service->getAll();

        return response()->json($models, Response::HTTP_OK);
    }

    private function handleResponse($model, $statusCode) {
        if ($this->service->hasErrors()) {
            $errors = $this->service->getErrors();
            $errors = $this->presentErrors($errors);

            return response()->json($errors, Response::HTTP_BAD_REQUEST);
        }

        return response()->json($model, $statusCode);
    }

    private function presentErrors($errors){
        return [
            "success" => false,
            "errors" => $errors
        ];
    }
}
