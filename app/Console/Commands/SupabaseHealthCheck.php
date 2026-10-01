<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class SupabaseHealthCheck extends Command
{
    protected $signature = 'supabase:health';
    protected $description = 'Check Supabase connection status across all APIs';

    public function handle(): int
    {
        $url = config('services.supabase.url');
        $anonKey = config('services.supabase.anon_key');
        $serviceKey = config('services.supabase.service_role_key');

        $this->newLine();
        $this->info('  Supabase Connection Health Check');
        $this->line('  ================================');
        $this->newLine();

        // Config
        $this->line("  URL:        {$url}");
        $this->line("  Key format: " . (str_starts_with($anonKey, 'eyJ') ? 'JWT (standard)' : 'sb_publishable_ (new)'));
        $this->line("  Service key: " . ($serviceKey === 'your_service_role_key_here' ? 'NOT SET' : 'Configured'));
        $this->newLine();

        $allOk = true;

        // 1. Auth API
        $this->line('  Checking Auth API...');
        try {
            $r = Http::withHeaders([
                'apikey' => $anonKey,
                'Authorization' => "Bearer {$anonKey}",
            ])->timeout(10)->get("{$url}/auth/v1/settings");

            if ($r->successful()) {
                $this->info("  [OK] Auth API connected (HTTP {$r->status()})");
                $settings = $r->json();
                $emailEnabled = $settings['external']['email'] ?? false;
                $this->line("       Email auth: " . ($emailEnabled ? 'enabled' : 'disabled'));
            } else {
                $this->error("  [FAIL] Auth API returned HTTP {$r->status()}");
                $allOk = false;
            }
        } catch (\Exception $e) {
            $this->error("  [FAIL] Auth API: {$e->getMessage()}");
            $allOk = false;
        }

        // 2. REST API (PostgREST)
        $this->newLine();
        $this->line('  Checking REST API (Database)...');
        try {
            $r = Http::withHeaders([
                'apikey' => $anonKey,
                'Authorization' => "Bearer {$anonKey}",
            ])->timeout(10)->get("{$url}/rest/v1/test_nonexistent");

            $sbError = $r->header('sb-error-code');

            if ($r->successful()) {
                $this->info("  [OK] REST API connected (HTTP {$r->status()})");
            } elseif ($r->status() === 404 || $sbError === 'PGRST001') {
                $this->info("  [OK] REST API connected (DB reachable, table not found - expected)");
            } elseif ($r->status() === 401 && $sbError === 'UNAUTHORIZED_INVALID_API_KEY_TYPE') {
                $this->warn("  [WARN] Root listing needs service_role key (table queries still work with anon key)");
            } else {
                $this->error("  [FAIL] REST API returned HTTP {$r->status()}");
                $allOk = false;
            }
        } catch (\Exception $e) {
            $this->error("  [FAIL] REST API: {$e->getMessage()}");
            $allOk = false;
        }

        // 3. Auth login test
        $this->newLine();
        $this->line('  Checking Auth login flow...');
        try {
            $r = Http::withHeaders([
                'apikey' => $anonKey,
                'Authorization' => "Bearer {$anonKey}",
            ])->timeout(10)->post("{$url}/auth/v1/token?grant_type=password", [
                'email' => 'healthcheck@test.com',
                'password' => 'invalid',
            ]);

            if ($r->status() === 400) {
                $this->info("  [OK] Auth login flow working (correctly rejects bad credentials)");
            } else {
                $this->warn("  [WARN] Unexpected response: HTTP {$r->status()}");
            }
        } catch (\Exception $e) {
            $this->error("  [FAIL] Auth login: {$e->getMessage()}");
            $allOk = false;
        }

        // Summary
        $this->newLine();
        if ($allOk) {
            $this->info('  All systems connected and ready!');
        } else {
            $this->warn('  Some checks had warnings. See above for details.');
        }
        $this->newLine();

        return $allOk ? self::SUCCESS : self::FAILURE;
    }
}
