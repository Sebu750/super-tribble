@extends('layouts.app')
@section('title', 'Join Sportika - Player Registration')
@section('content')

<!-- Hero with Dark Banner -->
<section class="relative overflow-hidden bg-gradient-to-br from-slate-900 via-blue-950 to-slate-900">
    <div class="absolute inset-0 opacity-[0.04]">
        <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <pattern id="joinGrid" width="60" height="60" patternUnits="userSpaceOnUse">
                    <path d="M 60 0 L 0 0 0 60" fill="none" stroke="white" stroke-width="0.5"/>
                </pattern>
            </defs>
            <rect width="100%" height="100%" fill="url(#joinGrid)"/>
        </svg>
    </div>
    <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-blue-500/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/3"></div>
    <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-cyan-500/8 rounded-full blur-3xl translate-y-1/2 -translate-x-1/3"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-24 text-center">
        <span class="inline-flex items-center px-4 py-1.5 rounded-full bg-white/5 border border-white/10 backdrop-blur-sm text-xs font-semibold text-blue-200 tracking-wide uppercase mb-4">Player Registration</span>
        <h1 class="text-4xl sm:text-5xl font-extrabold text-white font-display">Join <span class="bg-gradient-to-r from-blue-400 to-cyan-300 bg-clip-text text-transparent">Sportika</span></h1>
        <p class="mt-4 text-lg text-blue-100/60 max-w-2xl mx-auto">Create your professional sports portfolio and showcase your talent to the world</p>
        <!-- Steps indicator -->
        <div class="mt-8 flex items-center justify-center gap-2 flex-wrap">
            <span class="inline-flex items-center px-3 py-1 rounded-full bg-white/5 border border-white/10 text-xs font-semibold text-blue-200">Personal Info</span>
            <span class="inline-flex items-center px-3 py-1 rounded-full bg-white/5 border border-white/10 text-xs font-semibold text-blue-200">Contact</span>
            <span class="inline-flex items-center px-3 py-1 rounded-full bg-white/5 border border-white/10 text-xs font-semibold text-blue-200">Sport Details</span>
            <span class="inline-flex items-center px-3 py-1 rounded-full bg-white/5 border border-white/10 text-xs font-semibold text-blue-200">History</span>
            <span class="inline-flex items-center px-3 py-1 rounded-full bg-white/5 border border-white/10 text-xs font-semibold text-blue-200">Achievements</span>
            <span class="inline-flex items-center px-3 py-1 rounded-full bg-white/5 border border-white/10 text-xs font-semibold text-blue-200">Stats</span>
            <span class="inline-flex items-center px-3 py-1 rounded-full bg-white/5 border border-white/10 text-xs font-semibold text-blue-200">Skills</span>
            <span class="inline-flex items-center px-3 py-1 rounded-full bg-white/5 border border-white/10 text-xs font-semibold text-blue-200">Gallery</span>
            <span class="inline-flex items-center px-3 py-1 rounded-full bg-white/5 border border-white/10 text-xs font-semibold text-blue-200">Social</span>
            <span class="inline-flex items-center px-3 py-1 rounded-full bg-white/5 border border-white/10 text-xs font-semibold text-blue-200">Consent</span>
        </div>
    </div>
    <div class="absolute bottom-0 left-0 right-0 h-24 bg-gradient-to-t from-white to-transparent"></div>
</section>

<section class="py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        @if($errors->any())
        <div class="mb-8 bg-red-50 border border-red-200 rounded-2xl p-5 flex items-start gap-3">
            <div class="w-8 h-8 rounded-lg bg-red-100 flex items-center justify-center flex-shrink-0">
                <svg class="w-4 h-4 text-red-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
            </div>
            <div>
                <p class="text-sm text-red-700 font-semibold">Please fix the following errors:</p>
                <ul class="list-disc list-inside text-sm text-red-600 mt-2">
                    @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                </ul>
            </div>
        </div>
        @endif

        <form method="POST" action="{{ route('join.submit') }}" enctype="multipart/form-data" class="space-y-8">
            @csrf

            <!-- Personal Information -->
            <div class="bg-white rounded-2xl border border-gray-100 p-6 sm:p-8 shadow-sm">
                <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                    <span class="w-9 h-9 rounded-xl bg-gradient-to-br from-blue-500 to-blue-600 text-white text-sm font-bold flex items-center justify-center shadow-md shadow-blue-500/20">1</span>
                    Personal Information
                </h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">First Name <span class="text-red-500">*</span></label>
                        <input type="text" name="first_name" value="{{ old('first_name') }}" required class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-gray-50 focus:bg-white transition-colors">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Last Name <span class="text-red-500">*</span></label>
                        <input type="text" name="last_name" value="{{ old('last_name') }}" required class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-gray-50 focus:bg-white transition-colors">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Date of Birth</label>
                        <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}" class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-gray-50 focus:bg-white transition-colors">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Nationality</label>
                        <input type="text" name="nationality" value="{{ old('nationality') }}" class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-gray-50 focus:bg-white transition-colors">
                    </div>
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Profile Photo URL</label>
                        <input type="url" name="photo" value="{{ old('photo') }}" placeholder="https://example.com/photo.jpg" class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-gray-50 focus:bg-white transition-colors">
                    </div>
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Bio / Introduction</label>
                        <textarea name="bio" rows="4" class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-gray-50 focus:bg-white transition-colors resize-vertical">{{ old('bio') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="bg-white rounded-2xl border border-gray-100 p-6 sm:p-8 shadow-sm">
                <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                    <span class="w-9 h-9 rounded-xl bg-gradient-to-br from-cyan-500 to-cyan-600 text-white text-sm font-bold flex items-center justify-center shadow-md shadow-cyan-500/20">2</span>
                    Contact Information
                </h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Email <span class="text-red-500">*</span></label>
                        <input type="email" name="email" value="{{ old('email') }}" required class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-gray-50 focus:bg-white transition-colors">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Phone</label>
                        <input type="tel" name="phone" value="{{ old('phone') }}" class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-gray-50 focus:bg-white transition-colors">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">City</label>
                        <input type="text" name="city" value="{{ old('city') }}" class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-gray-50 focus:bg-white transition-colors">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Country</label>
                        <input type="text" name="country" value="{{ old('country') }}" class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-gray-50 focus:bg-white transition-colors">
                    </div>
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Personal Website</label>
                        <input type="url" name="website" value="{{ old('website') }}" placeholder="https://yourwebsite.com" class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-gray-50 focus:bg-white transition-colors">
                    </div>
                </div>
            </div>

            <!-- Sport Details -->
            <div class="bg-white rounded-2xl border border-gray-100 p-6 sm:p-8 shadow-sm">
                <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                    <span class="w-9 h-9 rounded-xl bg-gradient-to-br from-blue-600 to-blue-700 text-white text-sm font-bold flex items-center justify-center shadow-md shadow-blue-600/20">3</span>
                    Sport Details
                </h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Sport <span class="text-red-500">*</span></label>
                        <select name="category_id" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Select a sport</option>
                            @foreach($categories as $cat)
                            <option value="{{ $cat['id'] }}" {{ old('category_id') == $cat['id'] ? 'selected' : '' }}>{{ $cat['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Position / Role</label>
                        <input type="text" name="position" value="{{ old('position') }}" placeholder="e.g. Forward, Goalkeeper" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Current Team / Club</label>
                        <input type="text" name="current_team" value="{{ old('current_team') }}" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Years of Experience</label>
                        <input type="number" name="experience_years" value="{{ old('experience_years') }}" min="0" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>
            </div>

            <!-- Playing History -->
            <div class="bg-white rounded-2xl border border-gray-100 p-6 sm:p-8 shadow-sm">
                <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                    <span class="w-9 h-9 rounded-xl bg-gradient-to-br from-cyan-600 to-cyan-700 text-white text-sm font-bold flex items-center justify-center shadow-md shadow-cyan-600/20">4</span>
                    Playing History
                </h2>
                <p class="text-sm text-gray-500 mb-4">Enter one team per line. Format: Team Name, League, Position, Start Year, End Year</p>
                <div id="career-history">
                    <div class="grid grid-cols-2 sm:grid-cols-5 gap-3 mb-3 career-entry">
                        <input type="text" name="career[0][team_name]" placeholder="Team Name" class="col-span-2 sm:col-span-1 px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <input type="text" name="career[0][league]" placeholder="League" class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <input type="text" name="career[0][position]" placeholder="Position" class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <input type="text" name="career[0][start_year]" placeholder="Start Year" class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <input type="text" name="career[0][end_year]" placeholder="End Year" class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>
                <button type="button" onclick="addCareerEntry()" class="text-sm text-blue-600 font-semibold hover:text-blue-700">+ Add another team</button>
            </div>

            <!-- Achievements -->
            <div class="bg-white rounded-2xl border border-gray-100 p-6 sm:p-8 shadow-sm">
                <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                    <span class="w-9 h-9 rounded-xl bg-gradient-to-br from-blue-500 to-blue-600 text-white text-sm font-bold flex items-center justify-center shadow-md shadow-blue-500/20">5</span>
                    Achievements & Awards
                </h2>
                <p class="text-sm text-gray-500 mb-4">Enter one achievement per line. Format: Title, Year, Description</p>
                <div id="achievements">
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 mb-3 achievement-entry">
                        <input type="text" name="achievements[0][title]" placeholder="Achievement title" class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <input type="text" name="achievements[0][year]" placeholder="Year" class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <input type="text" name="achievements[0][description]" placeholder="Description (optional)" class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>
                <button type="button" onclick="addAchievementEntry()" class="text-sm text-blue-600 font-semibold hover:text-blue-700">+ Add another achievement</button>
            </div>

            <!-- Statistics -->
            <div class="bg-white rounded-2xl border border-gray-100 p-6 sm:p-8 shadow-sm">
                <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                    <span class="w-9 h-9 rounded-xl bg-gradient-to-br from-cyan-500 to-cyan-600 text-white text-sm font-bold flex items-center justify-center shadow-md shadow-cyan-500/20">6</span>
                    Statistics
                </h2>
                <p class="text-sm text-gray-500 mb-4">Enter one stat per line. Format: Stat Name, Value</p>
                <div id="statistics">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mb-3 stat-entry">
                        <input type="text" name="statistics[0][stat_key]" placeholder="e.g. Goals, Matches, Points" class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <input type="text" name="statistics[0][stat_value]" placeholder="Value" class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>
                <button type="button" onclick="addStatEntry()" class="text-sm text-blue-600 font-semibold hover:text-blue-700">+ Add another stat</button>
            </div>

            <!-- Education & Skills -->
            <div class="bg-white rounded-2xl border border-gray-100 p-6 sm:p-8 shadow-sm">
                <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                    <span class="w-9 h-9 rounded-xl bg-gradient-to-br from-blue-600 to-blue-700 text-white text-sm font-bold flex items-center justify-center shadow-md shadow-blue-600/20">7</span>
                    Education & Skills
                </h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Education / Training</label>
                        <textarea name="education" rows="3" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="e.g. Sports Academy Name, Certification courses">{{ old('education') }}</textarea>
                    </div>
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Skills (comma-separated)</label>
                        <input type="text" name="skills" value="{{ old('skills') }}" placeholder="e.g. Speed, Agility, Teamwork, Leadership" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Certifications</label>
                        <textarea name="certifications" rows="2" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="e.g. Licensed Coach, First Aid Certified">{{ old('certifications') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Gallery & Videos -->
            <div class="bg-white rounded-2xl border border-gray-100 p-6 sm:p-8 shadow-sm">
                <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                    <span class="w-9 h-9 rounded-xl bg-gradient-to-br from-cyan-600 to-cyan-700 text-white text-sm font-bold flex items-center justify-center shadow-md shadow-cyan-600/20">8</span>
                    Gallery & Videos
                </h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Gallery Image URLs (one per line)</label>
                        <textarea name="gallery_urls" rows="4" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="https://example.com/image1.jpg&#10;https://example.com/image2.jpg">{{ old('gallery_urls') }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Video URLs (one per line)</label>
                        <textarea name="video_urls" rows="4" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="https://youtube.com/watch?v=...&#10;https://vimeo.com/...">{{ old('video_urls') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Social Links -->
            <div class="bg-white rounded-2xl border border-gray-100 p-6 sm:p-8 shadow-sm">
                <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                    <span class="w-9 h-9 rounded-xl bg-gradient-to-br from-blue-500 to-blue-600 text-white text-sm font-bold flex items-center justify-center shadow-md shadow-blue-500/20">9</span>
                    Social Links & Documents
                </h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Instagram</label>
                        <input type="url" name="social_instagram" value="{{ old('social_instagram') }}" placeholder="https://instagram.com/username" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Twitter / X</label>
                        <input type="url" name="social_twitter" value="{{ old('social_twitter') }}" placeholder="https://x.com/username" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Facebook</label>
                        <input type="url" name="social_facebook" value="{{ old('social_facebook') }}" placeholder="https://facebook.com/username" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">LinkedIn</label>
                        <input type="url" name="social_linkedin" value="{{ old('social_linkedin') }}" placeholder="https://linkedin.com/in/username" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">CV / Profile Document URL</label>
                        <input type="url" name="cv_url" value="{{ old('cv_url') }}" placeholder="https://example.com/cv.pdf" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>
            </div>

            <!-- Consent -->
            <div class="bg-white rounded-2xl border border-gray-100 p-6 sm:p-8 shadow-sm">
                <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                    <span class="w-9 h-9 rounded-xl bg-gradient-to-br from-cyan-500 to-cyan-600 text-white text-sm font-bold flex items-center justify-center shadow-md shadow-cyan-500/20">10</span>
                    Consent & Submission
                </h2>
                <div class="space-y-4">
                    <label class="flex items-start gap-3 cursor-pointer">
                        <input type="checkbox" name="consent_data" required class="mt-1 w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                        <span class="text-sm text-gray-600">I confirm that all information provided is accurate and I consent to Sportika displaying this information on my player profile. <span class="text-red-500">*</span></span>
                    </label>
                    <label class="flex items-start gap-3 cursor-pointer">
                        <input type="checkbox" name="consent_terms" required class="mt-1 w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                        <span class="text-sm text-gray-600">I agree to the Sportika Terms of Service and Privacy Policy. <span class="text-red-500">*</span></span>
                    </label>
                </div>
            </div>

            <!-- Submit -->
            <div class="text-center pt-4">
                <button type="submit" class="px-12 py-4 bg-gradient-to-r from-blue-600 to-blue-700 text-white text-lg font-bold rounded-2xl hover:from-blue-700 hover:to-blue-800 transition-all shadow-xl shadow-blue-600/25 hover:shadow-2xl hover:shadow-blue-600/30 flex items-center justify-center gap-2 mx-auto">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                    Submit Application
                </button>
                <p class="mt-4 text-sm text-gray-400">Your application will be reviewed by our team before publishing.</p>
            </div>
        </form>
    </div>
</section>

<script>
let careerCount = 1, achievementCount = 1, statCount = 1;
function addCareerEntry() {
    const div = document.createElement('div');
    div.className = 'grid grid-cols-2 sm:grid-cols-5 gap-3 mb-3 career-entry';
    div.innerHTML = `
        <input type="text" name="career[${careerCount}][team_name]" placeholder="Team Name" class="col-span-2 sm:col-span-1 px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        <input type="text" name="career[${careerCount}][league]" placeholder="League" class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        <input type="text" name="career[${careerCount}][position]" placeholder="Position" class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        <input type="text" name="career[${careerCount}][start_year]" placeholder="Start Year" class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        <input type="text" name="career[${careerCount}][end_year]" placeholder="End Year" class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
    `;
    document.getElementById('career-history').appendChild(div);
    careerCount++;
}
function addAchievementEntry() {
    const div = document.createElement('div');
    div.className = 'grid grid-cols-1 sm:grid-cols-3 gap-3 mb-3 achievement-entry';
    div.innerHTML = `
        <input type="text" name="achievements[${achievementCount}][title]" placeholder="Achievement title" class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        <input type="text" name="achievements[${achievementCount}][year]" placeholder="Year" class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        <input type="text" name="achievements[${achievementCount}][description]" placeholder="Description (optional)" class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
    `;
    document.getElementById('achievements').appendChild(div);
    achievementCount++;
}
function addStatEntry() {
    const div = document.createElement('div');
    div.className = 'grid grid-cols-1 sm:grid-cols-2 gap-3 mb-3 stat-entry';
    div.innerHTML = `
        <input type="text" name="statistics[${statCount}][stat_key]" placeholder="e.g. Goals, Matches, Points" class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        <input type="text" name="statistics[${statCount}][stat_value]" placeholder="Value" class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
    `;
    document.getElementById('statistics').appendChild(div);
    statCount++;
}
</script>
@endsection
