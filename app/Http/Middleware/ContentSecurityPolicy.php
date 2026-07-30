<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ContentSecurityPolicy
{
    public function handle(
        Request $request,
        Closure $next
    ): Response {
        $response = $next($request);

        /*
         * Do not add CSP to downloads or non-HTML responses.
         */
        $contentType = $response->headers->get(
            'Content-Type',
            ''
        );

        if (
            ! str_contains(
                strtolower($contentType),
                'text/html'
            )
        ) {
            return $response;
        }

        $policy = implode(' ', [
            "default-src 'self';",
            "base-uri 'self';",
            "object-src 'none';",
            "frame-ancestors 'none';",
            "form-action 'self';",

            /*
             * Add blob: only if image previews use Blob URLs.
             */
            "img-src 'self' data: blob:;",

            "font-src 'self' data:"
                . " https://cdnjs.cloudflare.com"
                . " https://cdn.jsdelivr.net;",

            /*
             * unsafe-inline is temporarily necessary because the
             * current Blade templates contain inline CSS.
             */
            "style-src 'self' 'unsafe-inline'"
                . " https://cdnjs.cloudflare.com"
                . " https://cdn.jsdelivr.net;",

            /*
             * Inline scripts are intentionally not permitted here.
             * Existing inline scripts will be reported but not blocked
             * while Report-Only mode remains active.
             */
            "script-src 'self'"
                . " https://cdnjs.cloudflare.com"
                . " https://cdn.jsdelivr.net;",

            /*
             * Required for same-origin fetch() requests.
             */
            "connect-src 'self';",

            /*
             * Prevent media loading from unknown origins.
             */
            "media-src 'self';",

            /*
             * Allows workers only from the current application.
             */
            "worker-src 'self' blob:;",

            "manifest-src 'self';",

            /*
             * Automatically upgrade HTTP resource requests to HTTPS.
             */
            "upgrade-insecure-requests;",
        ]);

        $response->headers->set(
            'Content-Security-Policy-Report-Only',
            $policy
        );

        return $response;
    }
}
