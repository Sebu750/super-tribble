<?php

namespace App\Http\Controllers;

use App\Services\SupabaseService;
use Illuminate\Http\Request;

class ContactController extends Controller
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
            $rows = $this->supabase->from('settings')->select('key,value')->get();
            if (is_array($rows)) {
                foreach ($rows as $row) {
                    if (is_array($row) && isset($row['key'])) { $settings[$row['key']] = $row['value'] ?? ''; }
                }
            }
        } catch (\Exception $e) {}

        return view('website.contact', ['settings' => $settings]);
    }

    public function submit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:10',
            'inquiry_type' => 'nullable|string|in:general,player,partnership,media,other',
        ]);

        try {
            $this->supabase->from('contacts')->insert([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'subject' => $request->input('subject'),
                'message' => $request->input('message'),
                'inquiry_type' => $request->input('inquiry_type', 'general'),
            ]);

            return back()->with('success', 'Thank you! Your message has been sent successfully. We\'ll get back to you soon.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Something went wrong. Please try again later.');
        }
    }
}
