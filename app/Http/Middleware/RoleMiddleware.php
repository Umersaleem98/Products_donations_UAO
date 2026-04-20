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

    $userRole = auth()->user()->role;

    // If roles are defined, check access
    if (!empty($roles) && !in_array($userRole, $roles)) {
        abort(403, 'Unauthorized access');
    }

        return $next($request);
    }
}