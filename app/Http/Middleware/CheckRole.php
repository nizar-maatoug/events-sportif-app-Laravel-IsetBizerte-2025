<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        Log::info('CheckRole middleware called', [
            'user' => $request->user(),
            'roles' => $roles,
        ]);
        if (!$request->user() || !in_array($request->user()->role->name, $roles)) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        return $next($request);
    }
}
