<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SupabaseService
{
    protected string $url;
    protected string $anonKey;
    protected string $serviceRoleKey;

    public function __construct()
    {
        $this->url = config('services.supabase.url');
        $this->anonKey = config('services.supabase.anon_key');
        $this->serviceRoleKey = config('services.supabase.service_role_key');
    }

    /**
     * Sign up a new user via Supabase Auth API
     */
    public function signUp(string $email, string $password, array $metadata = []): array
    {
        $response = Http::withHeaders($this->getAuthHeaders())
            ->post("{$this->url}/auth/v1/signup", [
                'email' => $email,
                'password' => $password,
                'data' => $metadata,
            ]);

        return $response->json();
    }

    /**
     * Sign in an existing user
     */
    public function signIn(string $email, string $password): array
    {
        try {
            $response = Http::withHeaders($this->getAuthHeaders())
                ->post("{$this->url}/auth/v1/token?grant_type=password", [
                    'email' => $email,
                    'password' => $password,
                ]);

            $json = $response->json();

            if (!is_array($json)) {
                return ['error' => 'invalid_response', 'message' => 'Authentication service returned an invalid response.'];
            }

            // If HTTP failed but we got a JSON error body, ensure 'error' key exists
            if ($response->failed() && !isset($json['error'])) {
                $json['error'] = $json['message'] ?? $json['msg'] ?? 'authentication_failed';
            }

            return $json;
        } catch (\Exception $e) {
            Log::error('Supabase signIn error: ' . $e->getMessage());
            return ['error' => 'connection_error', 'message' => 'Unable to reach authentication service.'];
        }
    }

    /**
     * Get user by access token
     */
    public function getUser(string $accessToken): array
    {
        $response = Http::withHeaders([
            'apikey' => $this->anonKey,
            'Authorization' => "Bearer {$accessToken}",
        ])->get("{$this->url}/auth/v1/user");

        return $response->json();
    }

    /**
     * Refresh access token
     */
    public function refreshToken(string $refreshToken): array
    {
        $response = Http::withHeaders($this->getAuthHeaders())
            ->post("{$this->url}/auth/v1/token?grant_type=refresh_token", [
                'refresh_token' => $refreshToken,
            ]);

        return $response->json();
    }

    /**
     * Sign out user
     */
    public function signOut(string $accessToken): bool
    {
        $response = Http::withHeaders([
            'apikey' => $this->anonKey,
            'Authorization' => "Bearer {$accessToken}",
        ])->post("{$this->url}/auth/v1/logout");

        return $response->successful();
    }

    /**
     * Query Supabase database table
     */
    public function from(string $table): SupabaseQueryBuilder
    {
        return new SupabaseQueryBuilder($table, $this->url, $this->anonKey);
    }

    /**
     * Query Supabase database table with service role key (bypasses RLS)
     */
    public function serviceFrom(string $table): SupabaseQueryBuilder
    {
        return new SupabaseQueryBuilder($table, $this->url, $this->serviceRoleKey);
    }

    /**
     * Get auth headers for API requests
     */
    protected function getAuthHeaders(): array
    {
        return [
            'apikey' => $this->anonKey,
            'Authorization' => "Bearer {$this->anonKey}",
            'Content-Type' => 'application/json',
        ];
    }
}
