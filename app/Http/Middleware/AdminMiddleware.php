<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $user = auth('api')->user();
        $notLoggedIn = !$user;
        $notAdmin = $user && !$user->roles->contains('name', 'admin');

        if ($notLoggedIn || $notAdmin) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        return $next($request);
    }
}
