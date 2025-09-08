<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApiSecurityHeaders
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // X-Content-Type-Options - Prevents MIME type sniffing
        $response->headers->set('X-Content-Type-Options', 'nosniff');

        // X-Frame-Options - Prevents clickjacking (important even for APIs)
        $response->headers->set('X-Frame-Options', 'DENY');

        // Strict Transport Security (HTTPS only)
        if ($request->secure()) {
            $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains; preload');
        }

        // Referrer Policy - Controls referrer information
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');

        // X-XSS-Protection (legacy but still useful)
        $response->headers->set('X-XSS-Protection', '1; mode=block');

        // Content Security Policy for APIs
        $response->headers->set('Content-Security-Policy', "default-src 'none'; frame-ancestors 'none'");

        // Permissions Policy - Disable potentially dangerous features
        $response->headers->set('Permissions-Policy',
            'accelerometer=(), ambient-light-sensor=(), autoplay=(), battery=(), ' .
            'bluetooth=(), browsing-topics=(), camera=(), clipboard-read=(), ' .
            'clipboard-write=(), compass=(), cross-origin-isolated=(), display-capture=(), ' .
            'document-domain=(), encrypted-media=(), execution-while-not-rendered=(), ' .
            'execution-while-out-of-viewport=(), fullscreen=(), geolocation=(), ' .
            'gyroscope=(), hid=(), idle-detection=(), interest-cohort=(), ' .
            'keyboard-map=(), local-fonts=(), magnetometer=(), microphone=(), ' .
            'midi=(), navigation-override=(), payment=(), picture-in-picture=(), ' .
            'publickey-credentials-get=(), screen-wake-lock=(), serial=(), ' .
            'speaker-selection=(), storage-access=(), usb=(), web-share=(), ' .
            'window-management=(), xr-spatial-tracking=()'
        );

        // Cache Control for API responses
        $response->headers->set('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0');
        $response->headers->set('Pragma', 'no-cache');

        // Remove server information
        $response->headers->remove('Server');
        $response->headers->remove('X-Powered-By');

        // API-specific headers
        $response->headers->set('X-API-Version', config('app.api_version', '1.0'));

        // CORS headers (if not handled by Laravel's CORS middleware)
        if (config('api.cors.enabled', false)) {
            $response->headers->set('Access-Control-Allow-Origin', config('api.cors.allowed_origins', '*'));
            $response->headers->set('Access-Control-Allow-Methods', config('api.cors.allowed_methods', 'GET, POST, PUT, DELETE, OPTIONS'));
            $response->headers->set('Access-Control-Allow-Headers', config('api.cors.allowed_headers', 'Content-Type, Authorization, X-Requested-With'));
            $response->headers->set('Access-Control-Max-Age', config('api.cors.max_age', '86400'));
        }

        return $response;
    }
}
