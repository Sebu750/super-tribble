<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\SupabaseService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected SupabaseService $supabase;

    public function __construct(SupabaseService $supabase)
    {
        $this->supabase = $supabase;
    }

    public function index()
    {
        $user = session('supabase_user');
        $stats = [
            'total_players' => 0,
            'pending_applications' => 0,
            'published_players' => 0,
            'blog_posts' => 0,
            'contacts' => 0,
            'recent_applications' => [],
        ];

        try {
            $stats['total_players'] = count(
                $this->supabase->from('players')->select('id')->get()
            );
        } catch (\Exception $e) {}

        try {
            $stats['pending_applications'] = count(
                $this->supabase->from('player_applications')->select('id')->where('status', 'eq', 'pending')->get()
            );
        } catch (\Exception $e) {}

        try {
            $stats['published_players'] = count(
                $this->supabase->from('players')->select('id')->where('is_published', 'eq', true)->get()
            );
        } catch (\Exception $e) {}

        try {
            $stats['blog_posts'] = count(
                $this->supabase->from('blog_posts')->select('id')->get()
            );
        } catch (\Exception $e) {}

        try {
            $stats['contacts'] = count(
                $this->supabase->from('contacts')->select('id')->where('is_read', 'eq', false)->get()
            );
        } catch (\Exception $e) {}

        try {
            $stats['recent_applications'] = $this->supabase->from('player_applications')
                ->select('id,first_name,last_name,sport,status,created_at')
                ->orderBy('created_at', false)->limit(5)->get();
        } catch (\Exception $e) {}

        return view('admin.dashboard', ['user' => $user, 'stats' => $stats]);
    }
}
