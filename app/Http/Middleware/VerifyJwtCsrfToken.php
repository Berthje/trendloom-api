<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyJwtCsrfToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (
            $request->cookie('X-XSRF-TOKEN')  !==
            auth()->payload()->get('X-XSRF-TOKEN')
        ) {
            return response()->json(['Invalid request'], 400);
        }

        return $next($request);
    }
}
