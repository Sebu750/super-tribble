<?php

namespace App\Http\Controllers;

use App\Services\SupabaseService;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    protected SupabaseService $supabase;

    public function __construct(SupabaseService $supabase)
    {
        $this->supabase = $supabase;
    }

    /**
     * Player directory with search & filters
     */
    public function directory(Request $request)
    {
        $query = $this->supabase->from('players')
            ->select('id,first_name,last_name,slug,photo,sport,position,city,country,current_team,is_featured')
            ->where('is_published', 'eq', true);

        // Sport filter
        if ($request->filled('sport')) {
            $query->where('sport', 'eq', $request->input('sport'));
        }

        // Category filter
        if ($request->filled('category_id')) {
            $query->where('category_id', 'eq', $request->input('category_id'));
        }

        // Location filter
        if ($request->filled('country')) {
            $query->where('country', 'eq', $request->input('country'));
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('first_name', 'ilike', "%{$search}%");
        }

        $query->orderBy('is_featured', false);
        $query->orderBy('created_at', false);
        $query->limit(12);

        $players = [];
        try {
            $players = $query->get();
        } catch (\Exception $e) {}

        $categories = [];
        try {
            $categories = $this->supabase->from('categories')
                ->select('id,name,slug')
                ->where('is_active', 'eq', true)
                ->orderBy('name', true)
                ->get();
        } catch (\Exception $e) {}

        return view('website.players.directory', [
            'players' => $players,
            'categories' => $categories,
            'filters' => $request->only(['search', 'sport', 'category_id', 'country']),
        ]);
    }

    /**
     * Individual player profile
     */
    public function profile(string $slug)
    {
        $player = null;
        try {
            $player = $this->supabase->from('players')
                ->select('*')
                ->where('slug', 'eq', $slug)
                ->where('is_published', 'eq', true)
                ->first();
        } catch (\Exception $e) {}

        if (!$player) {
            abort(404);
        }

        $achievements = [];
        $careerHistory = [];
        $statistics = [];
        $skills = [];
        $gallery = [];
        $videos = [];
        $socialLinks = [];

        try {
            $achievements = $this->supabase->from('player_achievements')
                ->select('*')->where('player_id', 'eq', $player['id'])->get();
        } catch (\Exception $e) {}

        try {
            $careerHistory = $this->supabase->from('player_career_history')
                ->select('*')->where('player_id', 'eq', $player['id'])
                ->orderBy('start_year', false)->get();
        } catch (\Exception $e) {}

        try {
            $statistics = $this->supabase->from('player_statistics')
                ->select('*')->where('player_id', 'eq', $player['id'])->get();
        } catch (\Exception $e) {}

        try {
            $skills = $this->supabase->from('player_skills')
                ->select('*')->where('player_id', 'eq', $player['id'])
                ->orderBy('rating', false)->get();
        } catch (\Exception $e) {}

        try {
            $gallery = $this->supabase->from('player_galleries')
                ->select('*')->where('player_id', 'eq', $player['id'])
                ->orderBy('sort_order', true)->get();
        } catch (\Exception $e) {}

        try {
            $videos = $this->supabase->from('player_videos')
                ->select('*')->where('player_id', 'eq', $player['id'])
                ->orderBy('sort_order', true)->get();
        } catch (\Exception $e) {}

        try {
            $socialLinks = $this->supabase->from('player_social_links')
                ->select('*')->where('player_id', 'eq', $player['id'])->get();
        } catch (\Exception $e) {}

        return view('website.players.profile', [
            'player' => $player,
            'achievements' => $achievements,
            'careerHistory' => $careerHistory,
            'statistics' => $statistics,
            'skills' => $skills,
            'gallery' => $gallery,
            'videos' => $videos,
            'socialLinks' => $socialLinks,
        ]);
    }
}
