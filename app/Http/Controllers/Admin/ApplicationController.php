<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\SupabaseService;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    protected SupabaseService $supabase;

    public function __construct(SupabaseService $supabase)
    {
        $this->supabase = $supabase;
    }

    public function index(Request $request)
    {
        $query = $this->supabase->from('player_applications')->select('*');

        if ($request->filled('status')) {
            $query->where('status', 'eq', $request->input('status'));
        }

        $query->orderBy('created_at', false)->limit(50);
        $applications = [];
        try { $applications = $query->get(); } catch (\Exception $e) {}

        return view('admin.applications.index', [
            'applications' => $applications,
            'filters' => $request->only(['status']),
        ]);
    }

    public function show(int $id)
    {
        $application = null;
        try {
            $application = $this->supabase->from('player_applications')->select('*')->where('id', 'eq', $id)->first();
        } catch (\Exception $e) {}

        if (!$application) abort(404);

        $careerHistory = [];
        $achievements = [];
        $statistics = [];
        try { $careerHistory = $this->supabase->from('player_career_history')->select('*')->where('application_id', 'eq', $id)->get(); } catch (\Exception $e) {}
        try { $achievements = $this->supabase->from('player_achievements')->select('*')->where('application_id', 'eq', $id)->get(); } catch (\Exception $e) {}
        try { $statistics = $this->supabase->from('player_statistics')->select('*')->where('application_id', 'eq', $id)->get(); } catch (\Exception $e) {}

        return view('admin.applications.show', [
            'application' => $application,
            'careerHistory' => $careerHistory,
            'achievements' => $achievements,
            'statistics' => $statistics,
        ]);
    }

    public function approve(int $id)
    {
        try {
            $app = $this->supabase->from('player_applications')->select('*')->where('id', 'eq', $id)->first();
            if (!$app) abort(404);

            // Create player from application
            $slug = Str::slug($app['first_name'] . '-' . $app['last_name']);
            $playerResult = $this->supabase->from('players')->insert([
                'first_name' => $app['first_name'],
                'last_name' => $app['last_name'],
                'slug' => $slug,
                'sport' => $app['sport'],
                'position' => $app['position'] ?? '',
                'bio' => $app['bio'] ?? '',
                'photo' => $app['photo'] ?? '',
                'city' => $app['city'] ?? '',
                'country' => $app['country'] ?? '',
                'current_team' => $app['current_team'] ?? '',
                'email' => $app['email'],
                'phone' => $app['phone'] ?? '',
                'is_published' => true,
                'is_approved' => true,
            ]);

            $playerId = $playerResult[0]['id'] ?? null;

            // Copy sub-table data from application to player
            if ($playerId) {
                $subTables = [
                    'player_career_history' => ['team_name', 'league', 'position', 'start_year', 'end_year'],
                    'player_achievements' => ['title', 'year', 'description'],
                    'player_statistics' => ['stat_key', 'stat_value'],
                    'player_galleries' => ['image_url', 'caption'],
                    'player_videos' => ['video_url', 'title'],
                    'player_social_links' => ['platform', 'url'],
                ];
                foreach ($subTables as $table => $fields) {
                    try {
                        $rows = $this->supabase->from($table)->select('*')->where('application_id', 'eq', $id)->get();
                        foreach ($rows as $row) {
                            $data = ['player_id' => $playerId];
                            foreach ($fields as $f) { if (isset($row[$f])) $data[$f] = $row[$f]; }
                            $this->supabase->from($table)->insert($data);
                        }
                    } catch (\Exception $e) {}
                }
            }

            // Update application
            $this->supabase->from('player_applications')->where('id', 'eq', $id)->update([
                'status' => 'approved',
                'player_id' => $playerId,
                'reviewed_at' => now()->toIso8601String(),
            ]);

            return redirect()->route('admin.applications.index')->with('success', 'Application approved and player profile created.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to approve application: ' . $e->getMessage());
        }
    }

    public function reject(int $id)
    {
        try {
            $this->supabase->from('player_applications')->where('id', 'eq', $id)->update([
                'status' => 'rejected',
                'reviewed_at' => now()->toIso8601String(),
            ]);
            return redirect()->route('admin.applications.index')->with('success', 'Application rejected.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to reject application.');
        }
    }
}
