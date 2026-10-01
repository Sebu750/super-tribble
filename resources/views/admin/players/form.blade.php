@extends('layouts.admin')
@section('title', isset($player) ? 'Edit Player' : 'Add Player')
@section('header', isset($player) ? 'Edit Player' : 'Add Player')
@section('content')
<div class="max-w-4xl">
    <form method="POST" action="{{ isset($player) ? route('admin.players.update', $player['id']) : route('admin.players.store') }}">
        @csrf
        @if(isset($player)) @method('PUT') @endif

        @if($errors->any())
        <div class="mb-6 bg-red-50 border border-red-200 rounded-xl p-4 flex items-start gap-3">
            <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <ul class="list-disc list-inside text-sm text-red-600">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
        @endif

        <!-- Basic Info -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 border-l-4 border-l-blue-500 p-6 mb-6">
            <div class="flex items-center gap-3 mb-5">
                <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-gradient-to-br from-blue-50 to-blue-100">
                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                </span>
                <h3 class="text-sm font-semibold text-gray-900">Basic Information</h3>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div><label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wide">First Name *</label><input type="text" name="first_name" value="{{ old('first_name', $player['first_name'] ?? '') }}" required class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:bg-white focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition-all"></div>
                <div><label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wide">Last Name *</label><input type="text" name="last_name" value="{{ old('last_name', $player['last_name'] ?? '') }}" required class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:bg-white focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition-all"></div>
                <div><label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wide">Email</label><input type="email" name="email" value="{{ old('email', $player['email'] ?? '') }}" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:bg-white focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition-all"></div>
                <div><label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wide">Phone</label><input type="text" name="phone" value="{{ old('phone', $player['phone'] ?? '') }}" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:bg-white focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition-all"></div>
                <div><label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wide">Photo URL</label><input type="url" name="photo" value="{{ old('photo', $player['photo'] ?? '') }}" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:bg-white focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition-all"></div>
                <div><label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wide">Date of Birth</label><input type="date" name="date_of_birth" value="{{ old('date_of_birth', $player['date_of_birth'] ?? '') }}" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:bg-white focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition-all"></div>
                <div class="sm:col-span-2"><label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wide">Bio</label><textarea name="bio" rows="3" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:bg-white focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition-all">{{ old('bio', $player['bio'] ?? '') }}</textarea></div>
            </div>
        </div>

        <!-- Sport Details -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 border-l-4 border-l-emerald-500 p-6 mb-6">
            <div class="flex items-center gap-3 mb-5">
                <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-gradient-to-br from-emerald-50 to-emerald-100">
                    <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </span>
                <h3 class="text-sm font-semibold text-gray-900">Sport Details</h3>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wide">Sport Category *</label>
                    <select name="category_id" required class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:bg-white focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition-all">
                        <option value="">Select sport</option>
                        @foreach($categories as $cat)<option value="{{ $cat['id'] }}" {{ old('category_id', $player['category_id'] ?? '') == $cat['id'] ? 'selected' : '' }}>{{ $cat['name'] }}</option>@endforeach
                    </select>
                </div>
                <div><label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wide">Position</label><input type="text" name="position" value="{{ old('position', $player['position'] ?? '') }}" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:bg-white focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition-all"></div>
                <div><label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wide">Current Team</label><input type="text" name="current_team" value="{{ old('current_team', $player['current_team'] ?? '') }}" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:bg-white focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition-all"></div>
                <div><label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wide">Experience (years)</label><input type="number" name="experience_years" value="{{ old('experience_years', $player['experience_years'] ?? '') }}" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:bg-white focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition-all"></div>
            </div>
        </div>

        <!-- Location -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 border-l-4 border-l-violet-500 p-6 mb-6">
            <div class="flex items-center gap-3 mb-5">
                <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-gradient-to-br from-violet-50 to-violet-100">
                    <svg class="w-4 h-4 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </span>
                <h3 class="text-sm font-semibold text-gray-900">Location</h3>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div><label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wide">City</label><input type="text" name="city" value="{{ old('city', $player['city'] ?? '') }}" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:bg-white focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition-all"></div>
                <div><label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wide">Country</label><input type="text" name="country" value="{{ old('country', $player['country'] ?? '') }}" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:bg-white focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition-all"></div>
                <div><label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wide">Nationality</label><input type="text" name="nationality" value="{{ old('nationality', $player['nationality'] ?? '') }}" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:bg-white focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition-all"></div>
                <div><label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wide">Website</label><input type="url" name="website" value="{{ old('website', $player['website'] ?? '') }}" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:bg-white focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition-all"></div>
            </div>
        </div>

        <!-- CV -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 border-l-4 border-l-amber-500 p-6 mb-6">
            <div class="flex items-center gap-3 mb-5">
                <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-gradient-to-br from-amber-50 to-amber-100">
                    <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </span>
                <h3 class="text-sm font-semibold text-gray-900">Documents</h3>
            </div>
            <div><label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wide">CV URL</label><input type="url" name="cv_url" value="{{ old('cv_url', $player['cv_url'] ?? '') }}" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:bg-white focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition-all"></div>
        </div>

        <!-- Status -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 border-l-4 border-l-rose-500 p-6 mb-6">
            <div class="flex items-center gap-3 mb-5">
                <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-gradient-to-br from-rose-50 to-rose-100">
                    <svg class="w-4 h-4 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </span>
                <h3 class="text-sm font-semibold text-gray-900">Status</h3>
            </div>
            <div class="flex gap-6">
                <label class="flex items-center gap-2 cursor-pointer"><input type="checkbox" name="is_published" value="1" {{ old('is_published', $player['is_published'] ?? false) ? 'checked' : '' }} class="w-4 h-4 text-blue-600 border-gray-300 rounded"><span class="text-sm text-gray-700">Published</span></label>
                <label class="flex items-center gap-2 cursor-pointer"><input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $player['is_featured'] ?? false) ? 'checked' : '' }} class="w-4 h-4 text-blue-600 border-gray-300 rounded"><span class="text-sm text-gray-700">Featured</span></label>
            </div>
        </div>

        <!-- Submit -->
        <div class="flex items-center gap-3">
            <button type="submit" class="inline-flex items-center gap-2 px-6 py-2.5 bg-gradient-to-r from-blue-600 to-blue-700 text-white text-sm font-semibold rounded-xl shadow-lg shadow-blue-600/20 hover:from-blue-700 hover:to-blue-800 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                {{ isset($player) ? 'Update Player' : 'Create Player' }}
            </button>
            <a href="{{ route('admin.players.index') }}" class="px-6 py-2.5 bg-gray-100 text-gray-700 text-sm font-semibold rounded-xl hover:bg-gray-200 transition-colors">Cancel</a>
        </div>
    </form>
</div>
@endsection
