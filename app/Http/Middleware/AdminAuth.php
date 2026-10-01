<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAuth
{
    /**
     * Handle an incoming request.
     * Checks if the user has a valid Supabase session stored in the Laravel session.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $accessToken = session('supabase_access_token');
        $refreshToken = session('supabase_refresh_token');

        if (!$accessToken) {
            return redirect()->route('admin.login');
        }

        // Optionally verify the token is still valid by calling Supabase
        // For performance, we rely on session expiry instead of checking every request

        return $next($request);
    }
}
