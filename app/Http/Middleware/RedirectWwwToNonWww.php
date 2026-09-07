<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectWwwToNonWww
{
    /**
     * Handle an incoming request and redirect www subdomain to non-www canonical URL.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $host = $request->getHost();

        if (str_starts_with($host, 'www.')) {
            $canonicalHost = substr($host, 4);
            $url = $request->getScheme() . '://' . $canonicalHost . $request->getRequestUri();

            return new RedirectResponse($url, 301);
        }

        return $next($request);
    }
}
