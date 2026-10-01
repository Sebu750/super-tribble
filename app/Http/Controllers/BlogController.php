<?php

namespace App\Http\Controllers;

use App\Services\SupabaseService;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    protected SupabaseService $supabase;

    public function __construct(SupabaseService $supabase)
    {
        $this->supabase = $supabase;
    }

    public function index(Request $request)
    {
        $query = $this->supabase->from('blog_posts')
            ->select('id,title,slug,excerpt,featured_image,published_at,category_id')
            ->where('status', 'eq', 'published');

        if ($request->filled('category')) {
            $query->where('category_id', 'eq', $request->input('category'));
        }

        if ($request->filled('search')) {
            $query->where('title', 'ilike', "%{$request->input('search')}%");
        }

        $query->orderBy('published_at', false)->limit(12);

        $posts = [];
        $featuredPost = null;
        $categories = [];

        try {
            $posts = $query->get();
        } catch (\Exception $e) {}

        // Get featured post
        try {
            $featuredPost = $this->supabase->from('blog_posts')
                ->select('id,title,slug,excerpt,featured_image,published_at,author_name,content')
                ->where('status', 'eq', 'published')
                ->where('is_featured', 'eq', true)
                ->orderBy('published_at', false)
                ->first();
        } catch (\Exception $e) {}

        try {
            $categories = $this->supabase->from('blog_categories')
                ->select('id,name,slug')
                ->where('is_active', 'eq', true)
                ->orderBy('name', true)
                ->get();
        } catch (\Exception $e) {}

        return view('website.blog.index', [
            'posts' => $posts,
            'featuredPost' => $featuredPost,
            'categories' => $categories,
            'filters' => $request->only(['search', 'category']),
        ]);
    }

    public function show(string $slug)
    {
        $post = null;
        try {
            $post = $this->supabase->from('blog_posts')
                ->select('*')
                ->where('slug', 'eq', $slug)
                ->where('status', 'eq', 'published')
                ->first();
        } catch (\Exception $e) {}

        if (!$post) {
            abort(404);
        }

        // Related posts
        $relatedPosts = [];
        try {
            $relatedPosts = $this->supabase->from('blog_posts')
                ->select('id,title,slug,excerpt,featured_image,published_at')
                ->where('status', 'eq', 'published')
                ->where('category_id', 'eq', $post['category_id'] ?? 0)
                ->orderBy('published_at', false)
                ->limit(3)
                ->get();
            // Filter out current post
            $relatedPosts = array_filter($relatedPosts, fn($p) => $p['id'] !== $post['id']);
        } catch (\Exception $e) {}

        return view('website.blog.show', [
            'post' => $post,
            'relatedPosts' => array_values($relatedPosts),
        ]);
    }
}
