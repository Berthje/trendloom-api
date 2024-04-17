<?php

namespace App\Http\Middleware;

use Closure;

class VerifyUserOwnership
{
    public function handle($request, Closure $next, $model)
    {
        $modelInstance = resolve($model);
        $record = $modelInstance->find($request->route('id'));

        $user = auth('api')->user();


        if ($record && ($user->id === $record->id || $user->isAdmin())) {
            return $next($request);
        }

        return response()->json(['message' => 'Unauthorized'], 403);
    }
}
