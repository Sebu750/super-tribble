<?php

namespace App\Http\Controllers;

use App\Services\SupabaseService;

class HomeController extends Controller
{
    protected SupabaseService $supabase;

    public function __construct(SupabaseService $supabase)
    {
        $this->supabase = $supabase;
    }

    public function index()
    {
        $featuredPlayers = [];
        $categories = [];
        $latestBlogs = [];
        $settings = $this->getSettings();

        try {
            $result = $this->supabase->from('players')
                ->select('id,first_name,last_name,slug,photo,sport,position,current_team')
                ->where('is_featured', 'eq', true)
                ->where('is_published', 'eq', true)
                ->orderBy('created_at', false)
                ->limit(6)
                ->get();
            $featuredPlayers = array_filter($result, 'is_array');
        } catch (\Exception $e) {}

        try {
            $result = $this->supabase->from('categories')
                ->select('id,name,slug,icon,image')
                ->where('is_active', 'eq', true)
                ->orderBy('sort_order', true)
                ->get();
            $categories = array_filter($result, 'is_array');
        } catch (\Exception $e) {}

        try {
            $result = $this->supabase->from('blog_posts')
                ->select('id,title,slug,excerpt,featured_image,published_at')
                ->where('status', 'eq', 'published')
                ->orderBy('published_at', false)
                ->limit(3)
                ->get();
            $latestBlogs = array_filter($result, 'is_array');
        } catch (\Exception $e) {}

        return view('website.home', [
            'featuredPlayers' => $featuredPlayers,
            'categories' => $categories,
            'latestBlogs' => $latestBlogs,
            'settings' => $settings,
        ]);
    }

    public function about()
    {
        $settings = $this->getSettings();
        return view('website.about', ['settings' => $settings]);
    }

    public function contact()
    {
        $settings = $this->getSettings();
        return view('website.contact', ['settings' => $settings]);
    }

    protected function getSettings(): array
    {
        try {
            $rows = $this->supabase->from('settings')->select('key,value,type')->get();
            $settings = [];
            if (is_array($rows)) {
                foreach ($rows as $row) {
                    if (is_array($row) && isset($row['key'])) {
                        $settings[$row['key']] = $row['value'] ?? '';
                    }
                }
            }
            return $settings;
        } catch (\Exception $e) {
            return [];
        }
    }
}
