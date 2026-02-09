<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // 1. Check if user is logged in and has a role
        if (!$request->user() || !$request->user()->role) {
            abort(403, 'Unauthorized action.');
        }

        /** * 2. Check if the user's role matches the required role
         * We compare the string directly (e.g., 'admin' === 'admin')
         * because your DB stores roles as strings, not objects.
         */
        if ($request->user()->role !== $role) {
            abort(403, 'You do not have permission to access this page.');
        }

        return $next($request);
    }
}