<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CheckPassword
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(Request): (JsonResponse|RedirectResponse) $next
     * @return JsonResponse|RedirectResponse
     */
    public function handle(Request $request, Closure $next):JsonResponse|RedirectResponse
    {
        if(!isset($request->password) || $request->password !== env('PASSWORD','DEFAULT_PASSWORD'))
        {
            return response()->json([
                'status'=>false,
                'code'=>'E001',
                'msg'=>'Unauthenticated. ',
            ]);
        }
        return $next($request);
    }
}
