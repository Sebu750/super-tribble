@extends('layouts.admin')
@section('title', 'Dashboard')
@section('header', 'Dashboard')
@section('content')
<div class="space-y-6">

    <!-- Welcome Banner -->
    <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-blue-600 via-blue-700 to-indigo-800 shadow-xl shadow-blue-600/10">
        <!-- Decorative background -->
        <div class="absolute inset-0 pointer-events-none">
            <svg class="absolute top-0 right-0 w-80 h-80 opacity-10 -translate-y-1/4 translate-x-1/4" viewBox="0 0 200 200" fill="none">
                <circle cx="100" cy="100" r="80" stroke="white" stroke-width="0.5"/>
                <circle cx="100" cy="100" r="60" stroke="white" stroke-width="0.5"/>
                <circle cx="100" cy="100" r="40" stroke="white" stroke-width="0.5"/>
            </svg>
            <svg class="absolute bottom-0 left-0 w-64 h-64 opacity-10 translate-y-1/3 -translate-x-1/4" viewBox="0 0 200 200" fill="none">
                <rect x="20" y="20" width="160" height="160" rx="30" stroke="white" stroke-width="0.5"/>
                <rect x="50" y="50" width="100" height="100" rx="20" stroke="white" stroke-width="0.5"/>
            </svg>
            <div class="absolute top-0 right-1/3 w-48 h-48 bg-white/5 rounded-full blur-3xl"></div>
        </div>

        <div class="relative px-6 py-8 sm:px-8 sm:py-10">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-5">
                <div>
                    <h2 class="text-2xl font-bold text-white">Welcome back</h2>
                    <p class="mt-1.5 text-sm text-blue-100/80">Signed in as <span class="font-semibold text-white">{{ $user['email'] ?? 'Admin' }}</span></p>
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ route('admin.players.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-white/15 hover:bg-white/25 text-white text-sm font-semibold rounded-xl backdrop-blur-sm border border-white/10 transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        Add Player
                    </a>
                    <a href="{{ route('admin.blog.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-white/15 hover:bg-white/25 text-white text-sm font-semibold rounded-xl backdrop-blur-sm border border-white/10 transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        New Post
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 border-l-4 border-l-blue-500 p-5 card-lift">
            <div class="flex items-center gap-4">
                <span class="inline-flex items-center justify-center w-11 h-11 rounded-xl bg-gradient-to-br from-blue-50 to-blue-100">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </span>
                <div>
                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">Total Players</p>
                    <p class="text-xl font-bold text-gray-900">{{ $stats['total_players'] }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 border-l-4 border-l-amber-500 p-5 card-lift">
            <div class="flex items-center gap-4">
                <span class="inline-flex items-center justify-center w-11 h-11 rounded-xl bg-gradient-to-br from-amber-50 to-amber-100">
                    <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </span>
                <div>
                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">Pending</p>
                    <p class="text-xl font-bold text-gray-900">{{ $stats['pending_applications'] }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 border-l-4 border-l-emerald-500 p-5 card-lift">
            <div class="flex items-center gap-4">
                <span class="inline-flex items-center justify-center w-11 h-11 rounded-xl bg-gradient-to-br from-emerald-50 to-emerald-100">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </span>
                <div>
                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">Published</p>
                    <p class="text-xl font-bold text-gray-900">{{ $stats['published_players'] }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 border-l-4 border-l-violet-500 p-5 card-lift">
            <div class="flex items-center gap-4">
                <span class="inline-flex items-center justify-center w-11 h-11 rounded-xl bg-gradient-to-br from-violet-50 to-violet-100">
                    <svg class="w-5 h-5 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                </span>
                <div>
                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">Blog Posts</p>
                    <p class="text-xl font-bold text-gray-900">{{ $stats['blog_posts'] }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 border-l-4 border-l-rose-500 p-5 card-lift">
            <div class="flex items-center gap-4">
                <span class="inline-flex items-center justify-center w-11 h-11 rounded-xl bg-gradient-to-br from-rose-50 to-rose-100">
                    <svg class="w-5 h-5 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                </span>
                <div>
                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">Messages</p>
                    <p class="text-xl font-bold text-gray-900">{{ $stats['contacts'] }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Applications & Quick Actions -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Recent Applications -->
        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                <h3 class="text-sm font-semibold text-gray-900">Recent Applications</h3>
                <a href="{{ route('admin.applications.index') }}" class="text-xs text-blue-600 font-semibold hover:text-blue-700 transition-colors">View all</a>
            </div>
            <div class="divide-y divide-gray-50">
                @forelse($stats['recent_applications'] as $app)
                <a href="{{ route('admin.applications.show', $app['id']) }}" class="flex items-center justify-between px-6 py-3.5 hover:bg-blue-50/40 transition-colors">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center text-xs font-bold text-gray-500">{{ strtoupper(substr($app['first_name'] ?? '?', 0, 1)) }}{{ strtoupper(substr($app['last_name'] ?? '?', 0, 1)) }}</div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">{{ $app['first_name'] ?? '' }} {{ $app['last_name'] ?? '' }}</p>
                            <p class="text-xs text-gray-500">{{ $app['sport'] ?? 'N/A' }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        @php $status = $app['status'] ?? 'pending'; @endphp
                        <span class="status-dot {{ $status == 'pending' ? 'bg-amber-400' : ($status == 'approved' ? 'bg-emerald-400' : 'bg-red-400') }}"></span>
                        <span class="text-xs font-medium {{ $status == 'pending' ? 'text-amber-600' : ($status == 'approved' ? 'text-emerald-600' : 'text-red-600') }}">{{ ucfirst($status) }}</span>
                    </div>
                </a>
                @empty
                <div class="px-6 py-12 text-center">
                    <svg class="mx-auto w-10 h-10 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    <p class="mt-3 text-sm text-gray-400">No applications yet.</p>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
            <h3 class="text-sm font-semibold text-gray-900 mb-4">Quick Actions</h3>
            <div class="space-y-2.5">
                <a href="{{ route('admin.applications.index') }}" class="flex items-center gap-3 p-3 rounded-xl border border-gray-100 hover:border-amber-200 hover:bg-amber-50/50 transition-all group">
                    <span class="inline-flex items-center justify-center w-9 h-9 rounded-lg bg-gradient-to-br from-amber-50 to-amber-100 group-hover:from-amber-100 group-hover:to-amber-200 transition-colors">
                        <svg class="w-4.5 h-4.5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </span>
                    <span class="text-sm font-medium text-gray-700">Review Applications</span>
                </a>
                <a href="{{ route('admin.players.create') }}" class="flex items-center gap-3 p-3 rounded-xl border border-gray-100 hover:border-blue-200 hover:bg-blue-50/50 transition-all group">
                    <span class="inline-flex items-center justify-center w-9 h-9 rounded-lg bg-gradient-to-br from-blue-50 to-blue-100 group-hover:from-blue-100 group-hover:to-blue-200 transition-colors">
                        <svg class="w-4.5 h-4.5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                    </span>
                    <span class="text-sm font-medium text-gray-700">Add New Player</span>
                </a>
                <a href="{{ route('admin.blog.create') }}" class="flex items-center gap-3 p-3 rounded-xl border border-gray-100 hover:border-violet-200 hover:bg-violet-50/50 transition-all group">
                    <span class="inline-flex items-center justify-center w-9 h-9 rounded-lg bg-gradient-to-br from-violet-50 to-violet-100 group-hover:from-violet-100 group-hover:to-violet-200 transition-colors">
                        <svg class="w-4.5 h-4.5 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    </span>
                    <span class="text-sm font-medium text-gray-700">Write Blog Post</span>
                </a>
                <a href="{{ route('admin.settings.index') }}" class="flex items-center gap-3 p-3 rounded-xl border border-gray-100 hover:border-gray-300 hover:bg-gray-50 transition-all group">
                    <span class="inline-flex items-center justify-center w-9 h-9 rounded-lg bg-gradient-to-br from-gray-50 to-gray-100 group-hover:from-gray-100 group-hover:to-gray-200 transition-colors">
                        <svg class="w-4.5 h-4.5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </span>
                    <span class="text-sm font-medium text-gray-700">Site Settings</span>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
