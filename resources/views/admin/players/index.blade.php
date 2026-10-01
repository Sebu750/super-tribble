@extends('layouts.admin')
@section('title', 'Players')
@section('header', 'Players')
@section('content')
<div class="space-y-6">

    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-xl font-bold text-gray-900">All Players</h2>
            <p class="text-sm text-gray-500 mt-1">Manage player profiles, publish and feature players</p>
        </div>
        <a href="{{ route('admin.players.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-gradient-to-r from-blue-600 to-blue-700 text-white text-sm font-semibold rounded-xl shadow-lg shadow-blue-600/20 hover:from-blue-700 hover:to-blue-800 transition-all">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Add Player
        </a>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4">
        <form method="GET" class="flex flex-wrap gap-3">
            <div class="relative flex-1 min-w-[200px]">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
                <input type="text" name="search" value="{{ $filters['search'] ?? '' }}" placeholder="Search players..." class="w-full pl-10 pr-4 py-2 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:bg-white focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition-all">
            </div>
            <select name="status" class="px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:bg-white focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition-all">
                <option value="">All Status</option>
                <option value="published" {{ ($filters['status'] ?? '') == 'published' ? 'selected' : '' }}>Published</option>
                <option value="draft" {{ ($filters['status'] ?? '') == 'draft' ? 'selected' : '' }}>Draft</option>
            </select>
            <select name="featured" class="px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:bg-white focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition-all">
                <option value="">All</option>
                <option value="1" {{ ($filters['featured'] ?? '') == '1' ? 'selected' : '' }}>Featured</option>
            </select>
            <button type="submit" class="px-4 py-2 bg-gray-100 text-gray-700 text-sm font-semibold rounded-xl hover:bg-gray-200 transition-colors">Filter</button>
        </form>
    </div>

    <!-- Players Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="min-w-full divide-y divide-gray-100">
            <thead class="bg-gray-50/80">
                <tr>
                    <th class="px-6 py-3.5 text-left text-[11px] font-semibold text-gray-500 uppercase tracking-wider">Player</th>
                    <th class="px-6 py-3.5 text-left text-[11px] font-semibold text-gray-500 uppercase tracking-wider">Sport</th>
                    <th class="px-6 py-3.5 text-left text-[11px] font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3.5 text-left text-[11px] font-semibold text-gray-500 uppercase tracking-wider">Featured</th>
                    <th class="px-6 py-3.5 text-right text-[11px] font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-50">
                @forelse($players as $player)
                <tr class="hover:bg-blue-50/30 transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center overflow-hidden flex-shrink-0">
                                @if($player['photo'] ?? false)<img src="{{ $player['photo'] }}" class="w-full h-full object-cover">@else<span class="text-sm font-bold text-gray-400">{{ strtoupper(substr($player['first_name'] ?? '?', 0, 1)) }}</span>@endif
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">{{ $player['first_name'] }} {{ $player['last_name'] }}</p>
                                <p class="text-xs text-gray-500">{{ $player['city'] ?? '' }}@if($player['country'] ?? false), {{ $player['country'] }}@endif</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $player['sport'] ?? 'N/A' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <form method="POST" action="{{ route('admin.players.togglePublish', $player['id']) }}">@csrf
                            <button type="submit" class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium transition-colors {{ ($player['is_published'] ?? false) ? 'bg-emerald-50 text-emerald-700 hover:bg-emerald-100' : 'bg-gray-50 text-gray-600 hover:bg-gray-100' }}">
                                <span class="status-dot {{ ($player['is_published'] ?? false) ? 'bg-emerald-400' : 'bg-gray-300' }}"></span>
                                {{ ($player['is_published'] ?? false) ? 'Published' : 'Draft' }}
                            </button>
                        </form>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <form method="POST" action="{{ route('admin.players.toggleFeatured', $player['id']) }}">@csrf
                            <button type="submit" class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium transition-colors {{ ($player['is_featured'] ?? false) ? 'bg-amber-50 text-amber-700 hover:bg-amber-100' : 'bg-gray-50 text-gray-400 hover:bg-gray-100' }}">
                                @if($player['is_featured'] ?? false)
                                <svg class="w-3.5 h-3.5 text-amber-500" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                @endif
                                {{ ($player['is_featured'] ?? false) ? 'Featured' : 'Not featured' }}
                            </button>
                        </form>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-1">
                        <a href="{{ route('players.profile', $player['slug']) }}" class="inline-flex items-center px-2.5 py-1 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-lg transition-colors">View</a>
                        <a href="{{ route('admin.players.edit', $player['id']) }}" class="inline-flex items-center px-2.5 py-1 text-blue-600 hover:text-blue-700 hover:bg-blue-50 rounded-lg transition-colors">Edit</a>
                        <form method="POST" action="{{ route('admin.players.destroy', $player['id']) }}" class="inline" onsubmit="return confirm('Delete this player?')">@csrf @method('DELETE')
                            <button type="submit" class="inline-flex items-center px-2.5 py-1 text-red-600 hover:text-red-700 hover:bg-red-50 rounded-lg transition-colors">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="px-6 py-16 text-center">
                    <svg class="mx-auto w-10 h-10 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    <p class="mt-3 text-sm text-gray-400">No players found.</p>
                </td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
