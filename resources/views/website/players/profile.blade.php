@extends('layouts.app')
@section('title', ($player['first_name'] ?? '') . ' ' . ($player['last_name'] ?? '') . ' - Sportika')
@section('content')

<!-- Hero with Dark Banner -->
<section class="relative overflow-hidden bg-gradient-to-br from-slate-900 via-blue-950 to-slate-900 border-b border-white/5">
    <div class="absolute inset-0 opacity-[0.04]">
        <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <pattern id="profileGrid" width="60" height="60" patternUnits="userSpaceOnUse">
                    <path d="M 60 0 L 0 0 0 60" fill="none" stroke="white" stroke-width="0.5"/>
                </pattern>
            </defs>
            <rect width="100%" height="100%" fill="url(#profileGrid)"/>
        </svg>
    </div>
    <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-blue-500/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/3"></div>
    <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-cyan-500/8 rounded-full blur-3xl translate-y-1/2 -translate-x-1/3"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
        <!-- Breadcrumb -->
        <nav class="flex items-center gap-2 text-sm text-blue-200/40 mb-8">
            <a href="{{ route('players.directory') }}" class="hover:text-blue-300 transition-colors">Players</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-blue-100/60 font-medium">{{ $player['first_name'] }} {{ $player['last_name'] }}</span>
        </nav>

        <div class="flex flex-col sm:flex-row items-center sm:items-start gap-8">
            <!-- Photo -->
            <div class="w-36 h-36 rounded-3xl bg-gradient-to-br from-blue-100 to-blue-50 flex items-center justify-center overflow-hidden flex-shrink-0 shadow-xl shadow-blue-600/10 ring-4 ring-white">
                @if($player['photo'] ?? false)
                    <img src="{{ $player['photo'] }}" class="w-full h-full object-cover">
                @else
                    <span class="text-4xl font-bold text-blue-300">{{ strtoupper(substr($player['first_name'] ?? '', 0, 1)) }}{{ strtoupper(substr($player['last_name'] ?? '', 0, 1)) }}</span>
                @endif
            </div>
            <div class="text-center sm:text-left flex-1">
                <div class="flex items-center gap-3 justify-center sm:justify-start mb-2">
                    <h1 class="text-3xl sm:text-4xl font-extrabold text-white font-display">{{ $player['first_name'] }} {{ $player['last_name'] }}</h1>
                    @if($player['is_featured'] ?? false)
                    <span class="badge-pill bg-gradient-to-r from-amber-400 to-amber-500 text-white text-xs shadow-sm">
                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        Featured
                    </span>
                    @endif
                </div>
                <p class="text-lg font-semibold gradient-text">{{ $player['sport'] }}@if($player['position'] ?? false) &middot; {{ $player['position'] }}@endif</p>
                <div class="mt-4 flex flex-wrap gap-4 justify-center sm:justify-start text-sm text-blue-100/50">
                    @if($player['city'] ?? false)
                    <span class="flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-blue-200/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        {{ $player['city'] }}@if($player['country'] ?? false), {{ $player['country'] }}@endif
                    </span>
                    @endif
                    @if($player['current_team'] ?? false)
                    <span class="flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-blue-200/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        {{ $player['current_team'] }}
                    </span>
                    @endif
                    @if($player['experience_years'] ?? false)
                    <span class="flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-blue-200/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        {{ $player['experience_years'] }} years experience
                    </span>
                    @endif
                </div>
                @if(count($socialLinks) > 0)
                <div class="mt-5 flex gap-2 justify-center sm:justify-start">
                    @foreach($socialLinks as $link)
                    @php $platform = strtolower($link['platform']); @endphp
                    <a href="{{ $link['url'] }}" target="_blank" rel="noopener noreferrer" class="w-9 h-9 rounded-lg bg-white/10 border border-white/10 hover:border-blue-400/40 hover:bg-white/20 flex items-center justify-center text-blue-200/50 hover:text-white transition-all" title="{{ ucfirst($platform) }}">
                        @if($platform === 'instagram')
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                        @elseif($platform === 'twitter' || $platform === 'x')
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                        @elseif($platform === 'facebook')
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        @elseif($platform === 'youtube')
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                        @elseif($platform === 'tiktok')
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/></svg>
                        @elseif($platform === 'linkedin')
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                        @else
                        <span class="text-xs font-semibold">{{ ucfirst(substr($platform, 0, 2)) }}</span>
                        @endif
                    </a>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Content -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-10">
            @if($player['bio'] ?? false)
            <div class="bg-white rounded-2xl border border-gray-100 p-8">
                <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                    <span class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center"><svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg></span>
                    About
                </h2>
                <p class="text-gray-600 leading-relaxed whitespace-pre-line">{{ $player['bio'] }}</p>
            </div>
            @endif

            @if(count($careerHistory) > 0)
            <div class="bg-white rounded-2xl border border-gray-100 p-8">
                <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                    <span class="w-8 h-8 rounded-lg bg-green-100 flex items-center justify-center"><svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg></span>
                    Career History
                </h2>
                <div class="space-y-4">
                    @foreach($careerHistory as $ch)
                    <div class="flex gap-4 p-5 bg-gray-50 rounded-xl border border-gray-100 hover:border-blue-100 hover:bg-blue-50/30 transition-all">
                        <div class="text-sm font-semibold text-blue-600 w-24 flex-shrink-0">{{ $ch['start_year'] ?? '' }}@if($ch['end_year'] ?? false) - {{ $ch['end_year'] }}@else - Present @endif</div>
                        <div>
                            <h3 class="font-bold text-gray-900">{{ $ch['team_name'] }}</h3>
                            @if($ch['league'] ?? false)
                            <p class="text-sm text-gray-500 mt-0.5">{{ $ch['league'] }}@if($ch['position'] ?? false) &middot; {{ $ch['position'] }}@endif</p>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            @if(count($achievements) > 0)
            <div class="bg-white rounded-2xl border border-gray-100 p-8">
                <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                    <span class="w-8 h-8 rounded-lg bg-amber-100 flex items-center justify-center"><svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg></span>
                    Achievements
                </h2>
                <div class="space-y-3">
                    @foreach($achievements as $a)
                    <div class="flex items-start gap-4 p-4 rounded-xl hover:bg-amber-50/50 transition-colors">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-amber-400 to-amber-500 flex items-center justify-center flex-shrink-0 shadow-md shadow-amber-400/20">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        </div>
                        <div>
                            <p class="font-bold text-gray-900">{{ $a['title'] }}@if($a['year'] ?? false) <span class="text-gray-400 font-normal">({{ $a['year'] }})</span>@endif</p>
                            @if($a['description'] ?? false)<p class="text-sm text-gray-500 mt-1">{{ $a['description'] }}</p>@endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            @if(count($gallery) > 0)
            <div class="bg-white rounded-2xl border border-gray-100 p-8">
                <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                    <span class="w-8 h-8 rounded-lg bg-purple-100 flex items-center justify-center"><svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg></span>
                    Gallery
                </h2>
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                    @foreach($gallery as $img)
                    <div class="aspect-square rounded-xl overflow-hidden bg-gray-100 group">
                        <img src="{{ $img['image_url'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            @if(count($videos) > 0)
            <div class="bg-white rounded-2xl border border-gray-100 p-8">
                <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                    <span class="w-8 h-8 rounded-lg bg-rose-100 flex items-center justify-center"><svg class="w-4 h-4 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></span>
                    Videos
                </h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @foreach($videos as $vid)
                    <div class="aspect-video rounded-xl overflow-hidden bg-gray-100">
                        @if(str_contains($vid['video_url'], 'youtube.com') || str_contains($vid['video_url'], 'youtu.be'))
                        <iframe src="https://www.youtube.com/embed/{{ Str::after(Str::after($vid['video_url'], 'v='), '&') }}" class="w-full h-full" allowfullscreen></iframe>
                        @else
                        <a href="{{ $vid['video_url'] }}" target="_blank" class="flex items-center justify-center h-full text-blue-600 font-medium hover:bg-blue-50 transition-colors">
                            <svg class="w-12 h-12 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/></svg>
                            Watch Video
                        </a>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            @if(count($skills) > 0)
            <div class="bg-white rounded-2xl border border-gray-100 p-6">
                <h3 class="font-bold text-gray-900 mb-5 flex items-center gap-2">
                    <span class="w-7 h-7 rounded-lg bg-cyan-100 flex items-center justify-center"><svg class="w-4 h-4 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg></span>
                    Skills
                </h3>
                <div class="space-y-4">
                    @foreach($skills as $s)
                    <div>
                        <div class="flex justify-between text-sm mb-1.5">
                            <span class="font-medium text-gray-700">{{ $s['skill_name'] }}</span>
                            <span class="text-gray-400 font-medium">{{ $s['rating'] }}%</span>
                        </div>
                        <div class="h-2 bg-gray-100 rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-blue-500 to-cyan-500 rounded-full transition-all duration-500" style="width: {{ $s['rating'] }}%"></div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            @if(count($statistics) > 0)
            <div class="bg-white rounded-2xl border border-gray-100 p-6">
                <h3 class="font-bold text-gray-900 mb-5 flex items-center gap-2">
                    <span class="w-7 h-7 rounded-lg bg-green-100 flex items-center justify-center"><svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg></span>
                    Statistics
                </h3>
                <dl class="space-y-3">
                    @foreach($statistics as $stat)
                    <div class="flex justify-between items-center py-2 border-b border-gray-50 last:border-0">
                        <dt class="text-sm text-gray-500">{{ $stat['stat_key'] }}</dt>
                        <dd class="font-bold text-gray-900">{{ $stat['stat_value'] }}</dd>
                    </div>
                    @endforeach
                </dl>
            </div>
            @endif

            @if($player['email'] ?? false)
            <div class="bg-white rounded-2xl border border-gray-100 p-6">
                <h3 class="font-bold text-gray-900 mb-5 flex items-center gap-2">
                    <span class="w-7 h-7 rounded-lg bg-blue-100 flex items-center justify-center"><svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg></span>
                    Contact
                </h3>
                <div class="space-y-3 text-sm">
                    <p class="text-gray-600 flex items-center gap-2">
                        <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        {{ $player['email'] }}
                    </p>
                    @if($player['phone'] ?? false)
                    <p class="text-gray-600 flex items-center gap-2">
                        <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        {{ $player['phone'] }}
                    </p>
                    @endif
                    @if($player['website'] ?? false)
                    <a href="{{ $player['website'] }}" target="_blank" class="text-blue-600 hover:text-blue-700 font-medium flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                        Visit Website
                    </a>
                    @endif
                </div>
            </div>
            @endif

            @if($player['cv_url'] ?? false)
            <a href="{{ $player['cv_url'] }}" target="_blank" class="block w-full text-center px-6 py-4 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-2xl hover:from-blue-700 hover:to-blue-800 shadow-lg shadow-blue-600/20 transition-all">
                <svg class="w-5 h-5 inline-block mr-2 -mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                Download CV
            </a>
            @endif
        </div>
    </div>
</div>
@endsection
