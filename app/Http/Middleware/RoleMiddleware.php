<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role): Response
    {
        // Check login
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();

        // Check active status
        if (!$user->is_active) {
            auth()->logout();
            return redirect()->route('login')
                ->with('error', 'Your account has been deactivated.');
        }

        // Check role
        if (!$user->hasRole($role)) {
            abort(403, 'Unauthorized access.');
        }

        return $next($request);
    }
}