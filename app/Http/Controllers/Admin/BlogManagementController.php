<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\SupabaseService;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class BlogManagementController extends Controller
{
    protected SupabaseService $supabase;

    public function __construct(SupabaseService $supabase)
    {
        $this->supabase = $supabase;
    }

    public function index()
    {
        $posts = [];
        try {
            $posts = $this->supabase->from('blog_posts')->select('*')->orderBy('created_at', false)->limit(50)->get();
        } catch (\Exception $e) {}

        return view('admin.blog.index', ['posts' => $posts]);
    }

    public function create()
    {
        $categories = [];
        try {
            $categories = $this->supabase->from('blog_categories')->select('id,name')->orderBy('name', true)->get();
        } catch (\Exception $e) {}

        return view('admin.blog.form', ['post' => null, 'categories' => $categories]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $slug = Str::slug($request->input('title'));

        try {
            $this->supabase->from('blog_posts')->insert([
                'title' => $request->input('title'),
                'slug' => $slug,
                'content' => $request->input('content'),
                'excerpt' => $request->input('excerpt'),
                'featured_image' => $request->input('featured_image'),
                'category_id' => $request->input('category_id'),
                'author_name' => $request->input('author_name'),
                'status' => $request->input('status', 'draft'),
                'is_featured' => $request->has('is_featured'),
                'published_at' => $request->input('published_at'),
            ]);

            return redirect()->route('admin.blog.index')->with('success', 'Blog post created.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Failed to create post.');
        }
    }

    public function edit(int $id)
    {
        $post = null;
        $categories = [];
        try { $post = $this->supabase->from('blog_posts')->select('*')->where('id', 'eq', $id)->first(); } catch (\Exception $e) {}
        try { $categories = $this->supabase->from('blog_categories')->select('id,name')->orderBy('name', true)->get(); } catch (\Exception $e) {}

        if (!$post) abort(404);
        return view('admin.blog.form', ['post' => $post, 'categories' => $categories]);
    }

    public function update(Request $request, int $id)
    {
        $request->validate(['title' => 'required|string|max:255', 'content' => 'required|string']);

        try {
            $data = [
                'title' => $request->input('title'),
                'content' => $request->input('content'),
                'excerpt' => $request->input('excerpt'),
                'featured_image' => $request->input('featured_image'),
                'category_id' => $request->input('category_id'),
                'author_name' => $request->input('author_name'),
                'status' => $request->input('status', 'draft'),
                'is_featured' => $request->has('is_featured'),
                'published_at' => $request->input('published_at'),
            ];

            $this->supabase->from('blog_posts')->where('id', 'eq', $id)->update($data);
            return redirect()->route('admin.blog.index')->with('success', 'Post updated.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Failed to update post.');
        }
    }

    public function destroy(int $id)
    {
        try {
            $this->supabase->from('blog_posts')->where('id', 'eq', $id)->delete();
            return redirect()->route('admin.blog.index')->with('success', 'Post deleted.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to delete post.');
        }
    }
}
