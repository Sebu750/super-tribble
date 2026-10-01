@extends('layouts.app')
@section('title', 'Sportika - Where Athletes Shine')
@section('content')

<!-- Hero with Dark Banner Background -->
<section class="relative overflow-hidden bg-gradient-to-br from-slate-900 via-blue-950 to-slate-900">
    <!-- Background pattern overlay -->
    <div class="absolute inset-0 opacity-[0.04]">
        <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <pattern id="heroGrid" width="60" height="60" patternUnits="userSpaceOnUse">
                    <path d="M 60 0 L 0 0 0 60" fill="none" stroke="white" stroke-width="0.5"/>
                </pattern>
            </defs>
            <rect width="100%" height="100%" fill="url(#heroGrid)"/>
        </svg>
    </div>
    <!-- Decorative gradient orbs -->
    <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-blue-500/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/3"></div>
    <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-cyan-500/8 rounded-full blur-3xl translate-y-1/2 -translate-x-1/3"></div>
    <!-- Diagonal accent line -->
    <div class="absolute top-0 left-1/4 w-px h-full bg-gradient-to-b from-transparent via-blue-400/10 to-transparent"></div>
    <div class="absolute top-0 right-1/3 w-px h-full bg-gradient-to-b from-transparent via-cyan-400/10 to-transparent"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-32 lg:py-44">
        <div class="text-center max-w-4xl mx-auto">
            <!-- Badge -->
            <div class="inline-flex items-center px-4 py-1.5 rounded-full bg-white/5 border border-white/10 backdrop-blur-sm mb-8">
                <span class="w-2 h-2 rounded-full bg-cyan-400 mr-2 animate-pulse"></span>
                <span class="text-xs font-semibold text-blue-200 tracking-wide uppercase">The Platform for Athletes</span>
            </div>

            <h1 class="text-5xl sm:text-6xl lg:text-7xl font-extrabold tracking-tight text-white font-display leading-[1.1]">
                Where <span class="bg-gradient-to-r from-blue-400 to-cyan-300 bg-clip-text text-transparent">Athletes</span><br class="hidden sm:block"> Shine Bright
            </h1>
            <p class="mt-7 text-lg sm:text-xl text-blue-100/70 max-w-2xl mx-auto leading-relaxed">
                The premier platform for athletes to showcase their talent, build their professional portfolio, and connect with opportunities worldwide.
            </p>
            <div class="mt-10 flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('join.index') }}" class="group inline-flex items-center justify-center px-8 py-4 rounded-xl text-sm font-semibold text-slate-900 bg-gradient-to-r from-blue-400 to-cyan-300 hover:from-blue-300 hover:to-cyan-200 shadow-xl shadow-blue-500/20 transition-all duration-300 hover:shadow-2xl hover:shadow-blue-400/30">
                    Join Sportika
                    <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                </a>
                <a href="{{ route('players.directory') }}" class="inline-flex items-center justify-center px-8 py-4 rounded-xl text-sm font-semibold text-white bg-white/5 border border-white/10 hover:bg-white/10 backdrop-blur-sm transition-all duration-200">
                    <svg class="w-4 h-4 mr-2 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    Browse Players
                </a>
            </div>

            <!-- Trust badges -->
            <div class="mt-14 flex items-center justify-center gap-8 text-sm text-blue-200/50">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    <span>Verified Profiles</span>
                </div>
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    <span>Fast Setup</span>
                </div>
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span>Global Reach</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom fade to white -->
    <div class="absolute bottom-0 left-0 right-0 h-24 bg-gradient-to-t from-white to-transparent"></div>
</section>

<!-- Stats Bar -->
<section class="relative -mt-1 bg-white border-b border-gray-100">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            <div class="text-center">
                <p class="text-3xl sm:text-4xl font-extrabold text-gray-900 stat-number font-display">500<span class="gradient-text">+</span></p>
                <p class="mt-1 text-sm text-gray-500 font-medium">Athletes Registered</p>
            </div>
            <div class="text-center">
                <p class="text-3xl sm:text-4xl font-extrabold text-gray-900 stat-number font-display">20<span class="gradient-text">+</span></p>
                <p class="mt-1 text-sm text-gray-500 font-medium">Sports Categories</p>
            </div>
            <div class="text-center">
                <p class="text-3xl sm:text-4xl font-extrabold text-gray-900 stat-number font-display">50<span class="gradient-text">+</span></p>
                <p class="mt-1 text-sm text-gray-500 font-medium">Countries Represented</p>
            </div>
            <div class="text-center">
                <p class="text-3xl sm:text-4xl font-extrabold text-gray-900 stat-number font-display">100<span class="gradient-text">%</span></p>
                <p class="mt-1 text-sm text-gray-500 font-medium">Verified Profiles</p>
            </div>
        </div>
    </div>
</section>

<!-- Featured Players -->
@if(count($featuredPlayers) > 0)
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14">
            <span class="badge-pill bg-blue-50 text-blue-700 mb-4">Featured Athletes</span>
            <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 font-display">Top Players on Our Platform</h2>
            <p class="mt-4 text-lg text-gray-500 max-w-2xl mx-auto">Discover talented athletes who are making waves in their sports</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($featuredPlayers as $player)
            <a href="{{ route('players.profile', $player['slug']) }}" class="group card-hover bg-white rounded-2xl border border-gray-100 overflow-hidden">
                <div class="aspect-[4/3] bg-gradient-to-br from-gray-50 to-gray-100 flex items-center justify-center relative overflow-hidden">
                    @if($player['photo'] ?? false)
                        <img src="{{ $player['photo'] }}" alt="{{ $player['first_name'] }} {{ $player['last_name'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                        <div class="w-20 h-20 rounded-full bg-gradient-to-br from-blue-100 to-blue-50 flex items-center justify-center">
                            <span class="text-2xl font-bold text-blue-300">{{ strtoupper(substr($player['first_name'] ?? '', 0, 1)) }}{{ strtoupper(substr($player['last_name'] ?? '', 0, 1)) }}</span>
                        </div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </div>
                <div class="p-6">
                    <h3 class="text-lg font-bold text-gray-900 group-hover:text-blue-600 transition-colors">{{ $player['first_name'] }} {{ $player['last_name'] }}</h3>
                    <div class="flex items-center gap-2 mt-2">
                        <span class="badge-pill bg-blue-50 text-blue-700 text-xs">{{ $player['sport'] }}</span>
                        @if($player['position'] ?? false)
                        <span class="text-sm text-gray-400">{{ $player['position'] }}</span>
                        @endif
                    </div>
                    @if($player['current_team'] ?? false)
                    <p class="text-sm text-gray-400 mt-3 flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        {{ $player['current_team'] }}
                    </p>
                    @endif
                </div>
            </a>
            @endforeach
        </div>
        <div class="text-center mt-12">
            <a href="{{ route('players.directory') }}" class="inline-flex items-center px-6 py-3 rounded-xl text-sm font-semibold text-blue-600 bg-blue-50 hover:bg-blue-100 transition-colors">
                View all players
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
            </a>
        </div>
    </div>
</section>
@endif

<!-- Sport Categories -->
@if(count($categories) > 0)
<section class="py-24 bg-gray-50/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14">
            <span class="badge-pill bg-cyan-50 text-cyan-700 mb-4">Explore Sports</span>
            <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 font-display">Find Athletes by Sport</h2>
            <p class="mt-4 text-lg text-gray-500">Browse our diverse range of sports categories</p>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4">
            @foreach($categories as $cat)
            <a href="{{ route('players.directory', ['category_id' => $cat['id']]) }}" class="group flex flex-col items-center p-6 bg-white rounded-2xl border border-gray-100 hover:border-blue-200 hover:shadow-lg hover:shadow-blue-600/5 transition-all duration-300 card-hover">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-blue-50 to-cyan-50 flex items-center justify-center mb-3 group-hover:from-blue-100 group-hover:to-cyan-100 transition-colors">
                    <svg class="w-7 h-7 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 18.75h-9m9 0a3 3 0 013 3h-15a3 3 0 013-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.007 0H9.497m5.007 0a7.454 7.454 0 01-.982-3.172M9.497 14.25a7.454 7.454 0 00.981-3.172M5.25 4.236c-.982.143-1.954.317-2.916.52A6.003 6.003 0 007.73 9.728M5.25 4.236V4.5c0 2.108.966 3.99 2.48 5.228M5.25 4.236V2.721C7.456 2.41 9.71 2.25 12 2.25c2.291 0 4.545.16 6.75.47v1.516M7.73 9.728a6.726 6.726 0 002.748 1.35m3.044-6.842a6.003 6.003 0 005.392 4.992M12 2.25c.72 0 1.43.03 2.132.088M18.75 4.236V4.5c0 2.108-.966 3.99-2.48 5.228m0 0a6.726 6.726 0 01-2.749 1.35m0 0a6.772 6.772 0 01-3.044 0"/>
                    </svg>
                </div>
                <span class="text-sm font-semibold text-gray-700 group-hover:text-blue-600 transition-colors">{{ $cat['name'] }}</span>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Why Sportika -->
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <span class="badge-pill bg-purple-50 text-purple-700 mb-4">Why Choose Us</span>
            <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 font-display">Why Sportika?</h2>
            <p class="mt-4 text-lg text-gray-500 max-w-2xl mx-auto">Everything you need to build your athletic presence online</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="relative group p-8 rounded-2xl bg-gradient-to-br from-blue-50 to-white border border-blue-100/50 hover:shadow-xl hover:shadow-blue-600/5 transition-all duration-300">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center mb-6 shadow-lg shadow-blue-500/20">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </div>
                <h3 class="text-xl font-bold mb-3 text-gray-900">Build Your Portfolio</h3>
                <p class="text-gray-500 leading-relaxed">Create a professional player profile to showcase your career, stats, achievements, and highlight reels.</p>
            </div>
            <div class="relative group p-8 rounded-2xl bg-gradient-to-br from-green-50 to-white border border-green-100/50 hover:shadow-xl hover:shadow-green-600/5 transition-all duration-300">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-green-500 to-emerald-600 flex items-center justify-center mb-6 shadow-lg shadow-green-500/20">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </div>
                <h3 class="text-xl font-bold mb-3 text-gray-900">Get Discovered</h3>
                <p class="text-gray-500 leading-relaxed">Connect with scouts, coaches, and teams looking for talent in your sport. Your next opportunity awaits.</p>
            </div>
            <div class="relative group p-8 rounded-2xl bg-gradient-to-br from-purple-50 to-white border border-purple-100/50 hover:shadow-xl hover:shadow-purple-600/5 transition-all duration-300">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-purple-500 to-violet-600 flex items-center justify-center mb-6 shadow-lg shadow-purple-500/20">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                </div>
                <h3 class="text-xl font-bold mb-3 text-gray-900">Verified Profiles</h3>
                <p class="text-gray-500 leading-relaxed">All profiles are reviewed and approved by our team to maintain quality, authenticity, and trust.</p>
            </div>
        </div>
    </div>
</section>

<!-- Latest Blogs -->
@if(count($latestBlogs) > 0)
<section class="py-24 bg-gray-50/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-end justify-between mb-14">
            <div>
                <span class="badge-pill bg-orange-50 text-orange-700 mb-4">Our Blog</span>
                <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 font-display">Latest from the Blog</h2>
            </div>
            <a href="{{ route('blog.index') }}" class="hidden sm:inline-flex items-center text-sm font-semibold text-blue-600 hover:text-blue-700">
                View all posts
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
            </a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($latestBlogs as $blog)
            <a href="{{ route('blog.show', $blog['slug']) }}" class="group card-hover bg-white rounded-2xl border border-gray-100 overflow-hidden">
                @if($blog['featured_image'] ?? false)
                <div class="aspect-video bg-gray-100 overflow-hidden">
                    <img src="{{ $blog['featured_image'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                </div>
                @else
                <div class="aspect-video bg-gradient-to-br from-blue-50 to-cyan-50 flex items-center justify-center">
                    <svg class="w-12 h-12 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                </div>
                @endif
                <div class="p-6">
                    <h3 class="text-lg font-bold text-gray-900 group-hover:text-blue-600 transition-colors line-clamp-2">{{ $blog['title'] }}</h3>
                    <p class="mt-2 text-sm text-gray-500 line-clamp-2">{{ Str::limit($blog['excerpt'] ?? '', 100) }}</p>
                    <div class="mt-4 flex items-center text-xs text-gray-400">
                        <span>{{ isset($blog['published_at']) ? \Carbon\Carbon::parse($blog['published_at'])->format('M d, Y') : '' }}</span>
                        <span class="mx-2">&middot;</span>
                        <span class="text-blue-600 font-medium">Read more &rarr;</span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- CTA with Dark Banner -->
<section class="py-24 relative overflow-hidden bg-gradient-to-br from-slate-900 via-blue-950 to-slate-900">
    <!-- Background pattern -->
    <div class="absolute inset-0 opacity-[0.04]">
        <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <pattern id="ctaGrid" width="60" height="60" patternUnits="userSpaceOnUse">
                    <path d="M 60 0 L 0 0 0 60" fill="none" stroke="white" stroke-width="0.5"/>
                </pattern>
            </defs>
            <rect width="100%" height="100%" fill="url(#ctaGrid)"/>
        </svg>
    </div>
    <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-blue-500/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/3"></div>
    <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-cyan-500/8 rounded-full blur-3xl translate-y-1/2 -translate-x-1/3"></div>
    <div class="relative max-w-4xl mx-auto px-4 text-center">
        <h2 class="text-3xl sm:text-4xl font-bold text-white font-display">Ready to showcase your talent?</h2>
        <p class="mt-5 text-lg text-blue-100/70 max-w-2xl mx-auto">Join Sportika today and build your professional athlete portfolio. It's free to get started.</p>
        <div class="mt-10 flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('join.index') }}" class="inline-flex items-center justify-center px-8 py-4 rounded-xl text-sm font-semibold text-slate-900 bg-gradient-to-r from-blue-400 to-cyan-300 hover:from-blue-300 hover:to-cyan-200 shadow-xl shadow-blue-500/20 transition-all duration-200">
                Join Now - It's Free
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
            </a>
            <a href="{{ route('contact') }}" class="inline-flex items-center justify-center px-8 py-4 rounded-xl text-sm font-semibold text-white border-2 border-white/20 hover:border-white/40 hover:bg-white/5 transition-all duration-200">Contact Us</a>
        </div>
    </div>
</section>
@endsection
