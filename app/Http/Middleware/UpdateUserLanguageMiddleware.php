<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UpdateUserLanguageMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()) {
            if (str($request->getPreferredLanguage())->before('_')->toString() !== auth()->user()->language) {
                auth()->user()->update([
                    'language' => str($request->getPreferredLanguage())->before('_')->toString(),
                ]);
            }

            app()->setLocale(auth()->user()->language);
        } else {
            app()->setLocale(str($request->getPreferredLanguage())->before('_')->toString());
        }

        return $next($request);
    }
}
