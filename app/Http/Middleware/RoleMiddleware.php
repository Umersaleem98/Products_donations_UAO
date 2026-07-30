<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * Examples:
     * role:admin
     * role:admin,donor
     */
    public function handle(
        Request $request,
        Closure $next,
        string ...$allowedRoles
    ): Response {
        $user = $request->user();

        /*
         * The user is not authenticated.
         */
        if (! $user) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Unauthenticated.',
                ], 401);
            }

            return redirect()
                ->route('login')
                ->with(
                    'error',
                    'Please log in to access this page.'
                );
        }

        /*
         * Protect against an incorrectly configured middleware
         * such as ->middleware('role:') without a role.
         */
        if ($allowedRoles === []) {
            abort(500, 'Role middleware is not configured correctly.');
        }

        /*
         * Ensure the authenticated user has one of the allowed roles.
         */
        if (! in_array($user->role, $allowedRoles, true)) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Resource not found.',
                ], 404);
            }

            /*
             * Return 404 to avoid exposing protected admin URLs.
             *
             * Use abort(403) instead if you want to explicitly tell
             * logged-in users that access is forbidden.
             */
            abort(404);
        }

        /*
         * Optional account-status protection.
         * Keep this only if your users table contains a status column.
         */
        if (
            isset($user->status) &&
            $user->status !== 'active'
        ) {
            auth()->logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Your account is not active.',
                ], 403);
            }

            return redirect()
                ->route('login')
                ->with(
                    'error',
                    'Your account is not active. Contact the administrator.'
                );
        }

        return $next($request);
    }
}
