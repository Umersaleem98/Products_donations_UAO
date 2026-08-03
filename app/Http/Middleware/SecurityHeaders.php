<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    /**
     * Add HTTP security headers to every web response.
     */
    public function handle(
        Request $request,
        Closure $next
    ): Response {
        $response = $next($request);

        /*
        |--------------------------------------------------------------------------
        | Prevent Clickjacking
        |--------------------------------------------------------------------------
        */

        $response->headers->set(
            'X-Frame-Options',
            'DENY'
        );

        /*
        |--------------------------------------------------------------------------
        | Prevent MIME-Type Sniffing
        |--------------------------------------------------------------------------
        */

        $response->headers->set(
            'X-Content-Type-Options',
            'nosniff'
        );

        /*
        |--------------------------------------------------------------------------
        | Control Referrer Information
        |--------------------------------------------------------------------------
        */

        $response->headers->set(
            'Referrer-Policy',
            'strict-origin-when-cross-origin'
        );

        /*
        |--------------------------------------------------------------------------
        | Disable Unused Browser Features
        |--------------------------------------------------------------------------
        */

        $response->headers->set(
            'Permissions-Policy',
            'geolocation=(), microphone=(), camera=()'
        );

        return $response;
    }
}
