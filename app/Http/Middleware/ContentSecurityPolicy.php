<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ContentSecurityPolicy
{
    /**
     * Add Content Security Policy to every web response.
     */
    public function handle(
        Request $request,
        Closure $next
    ): Response {
        $response = $next($request);

        /*
        |--------------------------------------------------------------------------
        | Content Security Policy
        |--------------------------------------------------------------------------
        |
        | Report-only mode identifies problems without blocking resources.
        |
        */

        $policy = implode(' ', [
            "default-src 'self';",
            "base-uri 'self';",
            "object-src 'none';",
            "frame-ancestors 'none';",
            "form-action 'self';",
            "img-src 'self' data: blob:;",
            "font-src 'self' data: https://cdnjs.cloudflare.com;",
            "style-src 'self' 'unsafe-inline' https://cdnjs.cloudflare.com https://cdn.jsdelivr.net;",
            "script-src 'self' 'unsafe-inline' https://cdnjs.cloudflare.com https://cdn.jsdelivr.net;",
            "connect-src 'self';",
            "upgrade-insecure-requests;",
        ]);

        $response->headers->set(
            'Content-Security-Policy-Report-Only',
            $policy
        );

        return $response;
    }
}
