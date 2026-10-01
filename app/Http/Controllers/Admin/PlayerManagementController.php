<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\SupabaseService;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PlayerManagementController extends Controller
{
    protected SupabaseService $supabase;

    public function __construct(SupabaseService $supabase)
    {
        $this->supabase = $supabase;
    }

    public function index(Request $request)
    {
        $query = $this->supabase->from('players')->select('*');

        if ($request->filled('status')) {
            if ($request->input('status') === 'published') {
                $query->where('is_published', 'eq', true);
            } elseif ($request->input('status') === 'draft') {
                $query->where('is_published', 'eq', false);
            }
        }
        if ($request->filled('featured')) {
            $query->where('is_featured', 'eq', $request->input('featured') === 'yes');
        }

        $query->orderBy('created_at', false)->limit(50);
        $players = [];
        try { $players = $query->get(); } catch (\Exception $e) {}

        return view('admin.players.index', ['players' => $players, 'filters' => $request->only(['status', 'featured'])]);
    }

    public function create()
    {
        $categories = [];
        try {
            $categories = $this->supabase->from('categories')->select('id,name')->orderBy('name', true)->get();
        } catch (\Exception $e) {}

        return view('admin.players.form', ['player' => null, 'categories' => $categories]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'sport' => 'required|string|max:255',
        ]);

        $slug = Str::slug($request->input('first_name') . '-' . $request->input('last_name'));

        try {
            $this->supabase->from('players')->insert([
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'slug' => $slug,
                'sport' => $request->input('sport'),
                'position' => $request->input('position'),
                'bio' => $request->input('bio'),
                'photo' => $request->input('photo'),
                'city' => $request->input('city'),
                'country' => $request->input('country'),
                'current_team' => $request->input('current_team'),
                'category_id' => $request->input('category_id'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'is_published' => $request->has('is_published'),
                'is_featured' => $request->has('is_featured'),
                'is_approved' => true,
            ]);

            return redirect()->route('admin.players.index')->with('success', 'Player created successfully.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Failed to create player: ' . $e->getMessage());
        }
    }

    public function edit(int $id)
    {
        $player = null;
        $categories = [];
        try {
            $player = $this->supabase->from('players')->select('*')->where('id', 'eq', $id)->first();
        } catch (\Exception $e) {}
        try {
            $categories = $this->supabase->from('categories')->select('id,name')->orderBy('name', true)->get();
        } catch (\Exception $e) {}

        if (!$player) abort(404);
        return view('admin.players.form', ['player' => $player, 'categories' => $categories]);
    }

    public function update(Request $request, int $id)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'sport' => 'required|string|max:255',
        ]);

        try {
            $this->supabase->from('players')->where('id', 'eq', $id)->update([
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'sport' => $request->input('sport'),
                'position' => $request->input('position'),
                'bio' => $request->input('bio'),
                'photo' => $request->input('photo'),
                'city' => $request->input('city'),
                'country' => $request->input('country'),
                'current_team' => $request->input('current_team'),
                'category_id' => $request->input('category_id'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'is_published' => $request->has('is_published'),
                'is_featured' => $request->has('is_featured'),
            ]);

            return redirect()->route('admin.players.index')->with('success', 'Player updated successfully.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Failed to update player.');
        }
    }

    public function destroy(int $id)
    {
        try {
            $this->supabase->from('players')->where('id', 'eq', $id)->delete();
            return redirect()->route('admin.players.index')->with('success', 'Player deleted.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to delete player.');
        }
    }

    public function togglePublish(int $id)
    {
        try {
            $player = $this->supabase->from('players')->select('is_published')->where('id', 'eq', $id)->first();
            $this->supabase->from('players')->where('id', 'eq', $id)->update([
                'is_published' => !$player['is_published'],
            ]);
            return back()->with('success', 'Player status updated.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to update status.');
        }
    }

    public function toggleFeatured(int $id)
    {
        try {
            $player = $this->supabase->from('players')->select('is_featured')->where('id', 'eq', $id)->first();
            $this->supabase->from('players')->where('id', 'eq', $id)->update([
                'is_featured' => !$player['is_featured'],
            ]);
            return back()->with('success', 'Featured status updated.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to update featured status.');
        }
    }
}
