<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Auth\Access\AuthorizationException;

class ApiServiceController extends Controller
{
    protected $service;

    public function get($id) {
        try {
            $model = $this->service->get($id);
        } catch (AuthorizationException $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_FORBIDDEN);
        }

        if (!$model) {
            return response()->json(null, Response::HTTP_NOT_FOUND);
        }

        return response()->json($model, Response::HTTP_OK);
    }

    public function delete($id) {
        try {
            $model = $this->service->delete($id);
        } catch (AuthorizationException $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_FORBIDDEN);
        }

        if (!$model) {
            return response()->json(null, Response::HTTP_NOT_FOUND);
        }

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    public function create(Request $request) {
        try {
            $model = $this->service->create($request->all());
        } catch (AuthorizationException $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_FORBIDDEN);
        }

        return $this->handleResponse($model, Response::HTTP_CREATED);
    }

    public function update(Request $request, $id) {
        try {
            $model = $this->service->update($id, $request->all());
        } catch (AuthorizationException $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_FORBIDDEN);
        }

        return $this->handleResponse($model, Response::HTTP_OK);
    }

    public function getAll() {
        try {
            $models = $this->service->getAll();
        } catch (AuthorizationException $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_FORBIDDEN);
        }

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
