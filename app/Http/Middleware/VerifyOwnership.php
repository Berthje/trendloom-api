<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class verifyOwnership
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();
        $resource = $request->route('id');

        $ownerId = $resource->user_id ?? $resource->getUserId();

        if (!$user || ($user->id !== $ownerId && !$user->roles->contains('name', 'admin'))) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        return $next($request);
    }
}
