<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ChangeLanguage
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(Request): (JsonResponse|RedirectResponse) $next
     * @return JsonResponse|RedirectResponse
     */
    public function handle(Request $request, Closure $next): JsonResponse|RedirectResponse
    {
        app()->setLocale('en');
        if(isset($request->lang) && $request->lang === 'ar')
        {
            app()->setLocale('ar');
        }
        return $next($request);
    }
}
