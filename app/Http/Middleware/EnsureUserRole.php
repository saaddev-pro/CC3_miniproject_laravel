<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserRole
{
    public function handle(Request $request, Closure $next): Response
    {
        $requiredRole = 'user';
        if (!auth()->check() || auth()->user()->role !== $requiredRole) {
            abort(403, 'Unauthorized action');
        }
        return $next($request);
    }
}
