<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\SupabaseService;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    protected SupabaseService $supabase;

    public function __construct(SupabaseService $supabase)
    {
        $this->supabase = $supabase;
    }

    public function index()
    {
        $settings = [];
        try {
            $rows = $this->supabase->from('settings')->select('*')->orderBy('group_name', true)->orderBy('key', true)->get();
            if (is_array($rows)) {
                foreach ($rows as $row) {
                    if (is_array($row) && isset($row['group_name'])) {
                        $settings[$row['group_name']][] = $row;
                    }
                }
            }
        } catch (\Exception $e) {}

        return view('admin.settings.index', ['settings' => $settings]);
    }

    public function update(Request $request)
    {
        try {
            foreach ($request->except('_token', '_method') as $key => $value) {
                $this->supabase->from('settings')->where('key', 'eq', $key)->update(['value' => $value]);
            }
            return back()->with('success', 'Settings updated successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to update settings.');
        }
    }
}
