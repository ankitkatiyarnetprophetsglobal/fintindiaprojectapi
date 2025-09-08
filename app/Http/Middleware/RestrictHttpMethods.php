<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class RestrictHttpMethods
{
    /**
     * Allowed HTTP methods for the application
     */
    private const ALLOWED_METHODS = ['GET', 'POST', 'HEAD'];

    /**
     * Dangerous HTTP methods that should be blocked
     */
    private const DANGEROUS_METHODS = [
        'TRACE', 'TRACK', 'OPTIONS', 'PUT', 'DELETE', 'PATCH',
        'CONNECT', 'PROPFIND', 'PROPPATCH', 'MKCOL', 'COPY',
        'MOVE', 'LOCK', 'UNLOCK', 'DEBUG'
    ];

    /**
     * HTTP method override headers that should be blocked
     */
    private const METHOD_OVERRIDE_HEADERS = [
        'X-HTTP-Method-Override',
        'X-HTTP-Method',
        'X-Method-Override'
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Get the HTTP method
        $method = strtoupper($request->getMethod());

        // Check if method is explicitly blocked
        if (in_array($method, self::DANGEROUS_METHODS)) {
            Log::warning('Blocked dangerous HTTP method', [
                'method' => $method,
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'url' => $request->fullUrl()
            ]);

            return $this->createMethodNotAllowedResponse($method);
        }

        // Check if method is in allowed list
        if (!in_array($method, self::ALLOWED_METHODS)) {
            Log::warning('Blocked non-allowed HTTP method', [
                'method' => $method,
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'url' => $request->fullUrl()
            ]);

            return $this->createMethodNotAllowedResponse($method);
        }

        // Remove dangerous method override headers
        $this->removeDangerousHeaders($request);

        // Proceed with the request
        $response = $next($request);

        // Add security headers to response
        $this->addSecurityHeaders($response);

        return $response;
    }

    /**
     * Remove dangerous method override headers from the request
     */
    private function removeDangerousHeaders(Request $request)
    {
        foreach (self::METHOD_OVERRIDE_HEADERS as $header) {
            if ($request->headers->has($header)) {
                Log::warning('Removed method override header', [
                    'header' => $header,
                    'value' => $request->headers->get($header),
                    'ip' => $request->ip()
                ]);

                $request->headers->remove($header);
            }
        }
    }

    /**
     * Add security headers to the response
     */
    private function addSecurityHeaders($response)
    {
        // Remove Allow header that might expose supported methods
        $response->headers->remove('Allow');

        // Add security headers
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-Frame-Options', 'DENY');
        $response->headers->set('X-XSS-Protection', '1; mode=block');

        // Remove server information
        $response->headers->remove('Server');
        $response->headers->remove('X-Powered-By');
    }

    /**
     * Create a Method Not Allowed response
     */
    private function createMethodNotAllowedResponse(string $method)
    {
        $response = response()->json([
            'error' => 'Method Not Allowed',
            'message' => 'The requested HTTP method is not allowed.',
            'code' => 405
        ], 405);

        // Set allowed methods header (only show safe methods)
        $response->headers->set('Allow', implode(', ', self::ALLOWED_METHODS));

        // Add security headers
        $this->addSecurityHeaders($response);

        return $response;
    }
}

/**
 * Route-specific HTTP method restriction middleware
 */
class RestrictApiMethods
{
    /**
     * API-specific allowed methods
     */
    private const API_ALLOWED_METHODS = ['GET', 'POST'];

    public function handle(Request $request, Closure $next)
    {
        $method = strtoupper($request->getMethod());

        if (!in_array($method, self::API_ALLOWED_METHODS)) {
            Log::warning('Blocked HTTP method on API endpoint', [
                'method' => $method,
                'endpoint' => $request->path(),
                'ip' => $request->ip()
            ]);

            return response()->json([
                'error' => 'Method Not Allowed',
                'message' => 'This API endpoint only supports GET and POST methods.',
                'allowed_methods' => self::API_ALLOWED_METHODS
            ], 405)->header('Allow', implode(', ', self::API_ALLOWED_METHODS));
        }

        return $next($request);
    }
}

/**
 * Admin area HTTP method restriction
 */
class RestrictAdminMethods
{
    /**
     * Admin-specific allowed methods
     */
    private const ADMIN_ALLOWED_METHODS = ['GET', 'POST'];

    public function handle(Request $request, Closure $next)
    {
        $method = strtoupper($request->getMethod());

        if (!in_array($method, self::ADMIN_ALLOWED_METHODS)) {
            Log::warning('Blocked HTTP method on admin endpoint', [
                'method' => $method,
                'endpoint' => $request->path(),
                'ip' => $request->ip(),
                'user_id' => auth()->id()
            ]);

            return response()->view('errors.405', [
                'message' => 'This admin area only supports GET and POST methods.'
            ], 405)->header('Allow', implode(', ', self::ADMIN_ALLOWED_METHODS));
        }

        return $next($request);
    }
}

/**
 * Service class for HTTP method security management
 */
class HttpMethodSecurityService
{
    /**
     * Check if a request method is safe
     */
    public static function isSafeMethod(string $method): bool
    {
        return in_array(strtoupper($method), ['GET', 'POST', 'HEAD']);
    }

    /**
     * Check if a request method is dangerous
     */
    public static function isDangerousMethod(string $method): bool
    {
        $dangerousMethods = [
            'TRACE', 'TRACK', 'OPTIONS', 'PUT', 'DELETE', 'PATCH',
            'CONNECT', 'PROPFIND', 'PROPPATCH', 'MKCOL', 'COPY',
            'MOVE', 'LOCK', 'UNLOCK', 'DEBUG'
        ];

        return in_array(strtoupper($method), $dangerousMethods);
    }

    /**
     * Get security recommendations for HTTP methods
     */
    public static function getSecurityRecommendations(): array
    {
        return [
            'disable_dangerous_methods' => 'Disable TRACE, OPTIONS, PUT, DELETE, and other dangerous HTTP methods',
            'enable_logging' => 'Log all blocked method attempts for security monitoring',
            'use_whitelist' => 'Use a whitelist approach - only allow necessary methods',
            'remove_headers' => 'Remove server signature and method override headers',
            'monitor_requests' => 'Monitor for unusual method usage patterns',
            'regular_audits' => 'Regularly audit which methods are actually needed'
        ];
    }

    /**
     * Generate security report for HTTP methods
     */
    public static function generateSecurityReport(): array
    {
        return [
            'allowed_methods' => ['GET', 'POST', 'HEAD'],
            'blocked_methods' => [
                'TRACE' => 'Prevents cross-site tracing attacks',
                'OPTIONS' => 'Prevents information disclosure',
                'PUT' => 'Prevents unauthorized uploads',
                'DELETE' => 'Prevents unauthorized deletions',
                'PATCH' => 'Prevents unauthorized modifications'
            ],
            'security_headers' => [
                'X-Content-Type-Options' => 'nosniff',
                'X-Frame-Options' => 'DENY',
                'X-XSS-Protection' => '1; mode=block'
            ],
            'recommendations' => self::getSecurityRecommendations()
        ];
    }
}
