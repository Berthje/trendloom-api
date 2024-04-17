<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Language;


class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //get language parameter from request if set and set locale
        $lang = $request->get('lang');
        if ($lang && Language::where('code', $lang)->exists()) {
            App::setLocale($lang);
        }

        return $next($request);
    }
}
