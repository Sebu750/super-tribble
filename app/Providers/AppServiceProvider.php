<?php

namespace App\Providers;

use App\Services\SupabaseService;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('layouts.admin', function ($view) {
            $pendingCount = 0;
            try {
                $supabase = app(SupabaseService::class);
                if (session('supabase_access_token')) {
                    $pendingCount = count(
                        $supabase->from('player_applications')->select('id')->where('status', 'eq', 'pending')->get()
                    );
                }
            } catch (\Exception $e) {}
            $view->with('pendingCount', $pendingCount);
        });
    }
}
