<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckLanguageMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $lang = $request->header('Accept-Language');
        $acceptLocales = config('translatable.locales');
        $lang  = !in_array($lang, $acceptLocales) ? config('app.locale') : $lang ;
        
        app()->setLocale($lang);
        return $next($request);
    }
}
