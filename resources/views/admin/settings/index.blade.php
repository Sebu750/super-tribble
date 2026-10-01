@extends('layouts.admin')
@section('title', 'Settings')
@section('header', 'Site Settings')
@section('content')
<div class="max-w-4xl">
    <form method="POST" action="{{ route('admin.settings.update') }}">
        @csrf
        @method('PUT')

        @php $colors = ['blue', 'emerald', 'violet', 'amber', 'rose', 'cyan']; $colorIndex = 0; @endphp
        @foreach($settings as $group => $items)
        @php $color = $colors[$colorIndex % count($colors)]; $colorIndex++; @endphp
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 border-l-4 border-l-{{ $color }}-500 p-6 mb-6">
            <div class="flex items-center gap-3 mb-5">
                <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-gradient-to-br from-{{ $color }}-50 to-{{ $color }}-100">
                    <svg class="w-4 h-4 text-{{ $color }}-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </span>
                <h3 class="text-sm font-semibold text-gray-900">{{ ucfirst($group) }}</h3>
            </div>
            <div class="space-y-4">
                @foreach($items as $item)
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wide">{{ ucfirst(str_replace('_', ' ', $item['key'])) }}</label>
                    @if(strlen($item['value'] ?? '') > 80 || in_array($item['key'], ['about_text', 'hero_subtitle', 'contact_address']))
                        <textarea name="{{ $item['key'] }}" rows="3" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:bg-white focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition-all">{{ $item['value'] ?? '' }}</textarea>
                    @else
                        <input type="text" name="{{ $item['key'] }}" value="{{ $item['value'] ?? '' }}" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:bg-white focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition-all">
                    @endif
                    @if($item['description'] ?? false)
                    <p class="mt-1 text-xs text-gray-400">{{ $item['description'] }}</p>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
        @endforeach

        @if(count($settings) == 0)
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-16 text-center">
            <svg class="mx-auto w-12 h-12 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            <p class="mt-3 text-sm text-gray-400">No settings configured yet. Settings will appear here once they are added to the database.</p>
        </div>
        @endif

        @if(count($settings) > 0)
        <div class="flex items-center gap-3">
            <button type="submit" class="inline-flex items-center gap-2 px-6 py-2.5 bg-gradient-to-r from-blue-600 to-blue-700 text-white text-sm font-semibold rounded-xl shadow-lg shadow-blue-600/20 hover:from-blue-700 hover:to-blue-800 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                Save All Settings
            </button>
        </div>
        @endif
    </form>
</div>
@endsection
