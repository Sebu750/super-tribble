<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\SupabaseService;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    protected SupabaseService $supabase;

    public function __construct(SupabaseService $supabase)
    {
        $this->supabase = $supabase;
    }

    /**
     * Show the admin login form
     */
    public function showLoginForm()
    {
        if (session('supabase_access_token')) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.auth.login');
    }

    /**
     * Handle admin login attempt
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        try {
            $result = $this->supabase->signIn(
                $request->input('email'),
                $request->input('password')
            );
        } catch (\Exception $e) {
            return back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => 'Unable to connect to authentication service. Please try again later.']);
        }

        // Check for error in response (Supabase may use 'error', 'message', or other keys)
        if (!is_array($result) || isset($result['error']) || isset($result['message']) || isset($result['msg'])) {
            $errorMsg = 'Invalid credentials.';
            if (is_array($result)) {
                $errorMsg = $result['error_description']
                    ?? $result['message']
                    ?? $result['msg']
                    ?? $result['error']
                    ?? 'Invalid credentials.';
            }
            return back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => $errorMsg]);
        }

        // Validate that access_token exists in the response
        if (!isset($result['access_token'])) {
            return back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => 'Authentication succeeded but returned an unexpected response. Please try again.']);
        }

        // Store tokens in session
        session([
            'supabase_access_token' => $result['access_token'],
            'supabase_refresh_token' => $result['refresh_token'] ?? null,
            'supabase_user' => $result['user'] ?? [],
        ]);

        $request->session()->regenerate();

        return redirect()->intended(route('admin.dashboard'));
    }

    /**
     * Handle admin logout
     */
    public function logout(Request $request)
    {
        $accessToken = session('supabase_access_token');

        if ($accessToken) {
            $this->supabase->signOut($accessToken);
        }

        session()->forget(['supabase_access_token', 'supabase_refresh_token', 'supabase_user']);
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
