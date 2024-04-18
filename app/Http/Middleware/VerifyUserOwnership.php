<?php

namespace App\Http\Middleware;

use Closure;

class VerifyUserOwnership
{
    public function handle($request, Closure $next)
    {
        $user = auth('api')->user();

        if ($user->isAdmin()) {
            return $next($request);
        }

        return response()->json(['message' => 'Unauthorized'], 403);
    }
}
