<?php

namespace App\Http\Controllers;

use App\Services\SupabaseService;
use Illuminate\Http\Request;

class JoinController extends Controller
{
    protected SupabaseService $supabase;

    public function __construct(SupabaseService $supabase)
    {
        $this->supabase = $supabase;
    }

    public function index()
    {
        $categories = [];
        try {
            $categories = $this->supabase->from('categories')
                ->select('id,name,slug')
                ->where('is_active', 'eq', true)
                ->orderBy('name', true)
                ->get();
        } catch (\Exception $e) {}

        return view('website.join', ['categories' => $categories]);
    }

    public function submit(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'category_id' => 'required|integer',
            'consent_data' => 'accepted',
            'consent_terms' => 'accepted',
        ]);

        try {
            // Resolve sport name from category
            $category = $this->supabase->from('categories')->select('name')->where('id', 'eq', $request->input('category_id'))->first();
            $sportName = $category['name'] ?? 'Unknown';

            // Insert application
            $applicationData = [
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'date_of_birth' => $request->input('date_of_birth'),
                'nationality' => $request->input('nationality'),
                'photo' => $request->input('photo'),
                'bio' => $request->input('bio'),
                'city' => $request->input('city'),
                'country' => $request->input('country'),
                'website' => $request->input('website'),
                'category_id' => $request->input('category_id'),
                'sport' => $sportName,
                'position' => $request->input('position'),
                'current_team' => $request->input('current_team'),
                'experience_years' => $request->input('experience_years'),
                'education' => $request->input('education'),
                'skills' => $request->input('skills'),
                'certifications' => $request->input('certifications'),
                'cv_url' => $request->input('cv_url'),
                'status' => 'pending',
            ];

            $result = $this->supabase->from('player_applications')->insert($applicationData);
            $applicationId = $result[0]['id'] ?? null;

            // Insert career history entries
            if ($applicationId && $request->has('career')) {
                foreach ($request->input('career', []) as $entry) {
                    if (!empty($entry['team_name'])) {
                        $this->supabase->from('player_career_history')->insert([
                            'application_id' => $applicationId,
                            'team_name' => $entry['team_name'],
                            'league' => $entry['league'] ?? null,
                            'position' => $entry['position'] ?? null,
                            'start_year' => $entry['start_year'] ?? null,
                            'end_year' => $entry['end_year'] ?? null,
                        ]);
                    }
                }
            }

            // Insert achievements
            if ($applicationId && $request->has('achievements')) {
                foreach ($request->input('achievements', []) as $entry) {
                    if (!empty($entry['title'])) {
                        $this->supabase->from('player_achievements')->insert([
                            'application_id' => $applicationId,
                            'title' => $entry['title'],
                            'year' => $entry['year'] ?? null,
                            'description' => $entry['description'] ?? null,
                        ]);
                    }
                }
            }

            // Insert statistics
            if ($applicationId && $request->has('statistics')) {
                foreach ($request->input('statistics', []) as $entry) {
                    if (!empty($entry['stat_key'])) {
                        $this->supabase->from('player_statistics')->insert([
                            'application_id' => $applicationId,
                            'stat_key' => $entry['stat_key'],
                            'stat_value' => $entry['stat_value'] ?? null,
                        ]);
                    }
                }
            }

            // Insert gallery images
            if ($applicationId && $request->filled('gallery_urls')) {
                foreach (array_filter(explode("\n", $request->input('gallery_urls'))) as $url) {
                    $url = trim($url);
                    if (!empty($url)) {
                        $this->supabase->from('player_galleries')->insert([
                            'application_id' => $applicationId,
                            'image_url' => $url,
                        ]);
                    }
                }
            }

            // Insert videos
            if ($applicationId && $request->filled('video_urls')) {
                foreach (array_filter(explode("\n", $request->input('video_urls'))) as $url) {
                    $url = trim($url);
                    if (!empty($url)) {
                        $this->supabase->from('player_videos')->insert([
                            'application_id' => $applicationId,
                            'video_url' => $url,
                        ]);
                    }
                }
            }

            // Insert social links
            if ($applicationId) {
                $socialPlatforms = ['instagram', 'twitter', 'facebook', 'linkedin'];
                foreach ($socialPlatforms as $platform) {
                    $url = $request->input("social_{$platform}");
                    if (!empty($url)) {
                        $this->supabase->from('player_social_links')->insert([
                            'application_id' => $applicationId,
                            'platform' => $platform,
                            'url' => $url,
                        ]);
                    }
                }
            }

            return redirect()->route('join.success');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Something went wrong. Please try again later.');
        }
    }

    public function success()
    {
        return view('website.join-success');
    }
}
