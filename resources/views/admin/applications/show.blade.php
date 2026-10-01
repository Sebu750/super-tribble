@extends('layouts.admin')
@section('title', 'Application Review')
@section('header', 'Application Review')
@section('content')
<div class="max-w-4xl space-y-6">

    <!-- Profile Header Banner -->
    <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-blue-600 via-blue-700 to-indigo-800 shadow-xl shadow-blue-600/10">
        <div class="absolute inset-0 pointer-events-none">
            <svg class="absolute top-0 right-0 w-64 h-64 opacity-10 -translate-y-1/4 translate-x-1/4" viewBox="0 0 200 200" fill="none">
                <circle cx="100" cy="100" r="80" stroke="white" stroke-width="0.5"/>
                <circle cx="100" cy="100" r="60" stroke="white" stroke-width="0.5"/>
            </svg>
        </div>
        <div class="relative px-6 py-6 sm:px-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-5">
                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 rounded-2xl bg-white/15 backdrop-blur-sm border border-white/20 flex items-center justify-center overflow-hidden">
                        @if($application['photo'] ?? false)<img src="{{ $application['photo'] }}" class="w-full h-full object-cover">@else<span class="text-xl font-bold text-white">{{ strtoupper(substr($application['first_name'] ?? '?', 0, 1)) }}</span>@endif
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-white">{{ $application['first_name'] ?? '' }} {{ $application['last_name'] ?? '' }}</h2>
                        <p class="text-sm text-blue-100/80 mt-0.5">{{ $application['sport'] ?? 'N/A' }}@if($application['position'] ?? false) &middot; {{ $application['position'] }}@endif</p>
                        <div class="flex items-center gap-2 mt-1.5">
                            @php $status = $application['status'] ?? 'pending'; @endphp
                            <span class="w-2 h-2 rounded-full {{ $status == 'pending' ? 'bg-amber-300' : ($status == 'approved' ? 'bg-emerald-300' : 'bg-red-300') }}"></span>
                            <span class="text-xs font-medium text-white/80">{{ ucfirst($status) }}</span>
                        </div>
                    </div>
                </div>
                @if($status == 'pending')
                <div class="flex gap-3">
                    <form method="POST" action="{{ route('admin.applications.reject', $application['id']) }}" onsubmit="return confirm('Reject this application?')">@csrf
                        <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 bg-white/10 hover:bg-red-500/30 text-white text-sm font-semibold rounded-xl border border-white/10 hover:border-red-400/30 transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            Reject
                        </button>
                    </form>
                    <form method="POST" action="{{ route('admin.applications.approve', $application['id']) }}" onsubmit="return confirm('Approve and create player profile?')">@csrf
                        <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-500/80 hover:bg-emerald-500 text-white text-sm font-semibold rounded-xl border border-emerald-400/30 transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Approve
                        </button>
                    </form>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Personal Info -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 border-l-4 border-l-blue-500 p-6">
        <div class="flex items-center gap-3 mb-4">
            <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-gradient-to-br from-blue-50 to-blue-100">
                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
            </span>
            <h3 class="text-sm font-semibold text-gray-900">Personal Information</h3>
        </div>
        <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="bg-gray-50 rounded-lg p-3"><dt class="text-[11px] font-semibold text-gray-500 uppercase tracking-wide">Email</dt><dd class="text-sm font-medium text-gray-900 mt-0.5">{{ $application['email'] ?? 'N/A' }}</dd></div>
            <div class="bg-gray-50 rounded-lg p-3"><dt class="text-[11px] font-semibold text-gray-500 uppercase tracking-wide">Phone</dt><dd class="text-sm font-medium text-gray-900 mt-0.5">{{ $application['phone'] ?? 'N/A' }}</dd></div>
            <div class="bg-gray-50 rounded-lg p-3"><dt class="text-[11px] font-semibold text-gray-500 uppercase tracking-wide">Date of Birth</dt><dd class="text-sm font-medium text-gray-900 mt-0.5">{{ $application['date_of_birth'] ?? 'N/A' }}</dd></div>
            <div class="bg-gray-50 rounded-lg p-3"><dt class="text-[11px] font-semibold text-gray-500 uppercase tracking-wide">Nationality</dt><dd class="text-sm font-medium text-gray-900 mt-0.5">{{ $application['nationality'] ?? 'N/A' }}</dd></div>
            <div class="bg-gray-50 rounded-lg p-3"><dt class="text-[11px] font-semibold text-gray-500 uppercase tracking-wide">City</dt><dd class="text-sm font-medium text-gray-900 mt-0.5">{{ $application['city'] ?? 'N/A' }}</dd></div>
            <div class="bg-gray-50 rounded-lg p-3"><dt class="text-[11px] font-semibold text-gray-500 uppercase tracking-wide">Country</dt><dd class="text-sm font-medium text-gray-900 mt-0.5">{{ $application['country'] ?? 'N/A' }}</dd></div>
        </dl>
        @if($application['bio'] ?? false)
        <div class="mt-4 bg-gray-50 rounded-lg p-3"><dt class="text-[11px] font-semibold text-gray-500 uppercase tracking-wide mb-1">Bio</dt><dd class="text-sm text-gray-900">{{ $application['bio'] }}</dd></div>
        @endif
    </div>

    <!-- Sport Details -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 border-l-4 border-l-emerald-500 p-6">
        <div class="flex items-center gap-3 mb-4">
            <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-gradient-to-br from-emerald-50 to-emerald-100">
                <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
            </span>
            <h3 class="text-sm font-semibold text-gray-900">Sport Details</h3>
        </div>
        <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="bg-gray-50 rounded-lg p-3"><dt class="text-[11px] font-semibold text-gray-500 uppercase tracking-wide">Sport</dt><dd class="text-sm font-medium text-gray-900 mt-0.5">{{ $application['sport'] ?? 'N/A' }}</dd></div>
            <div class="bg-gray-50 rounded-lg p-3"><dt class="text-[11px] font-semibold text-gray-500 uppercase tracking-wide">Position</dt><dd class="text-sm font-medium text-gray-900 mt-0.5">{{ $application['position'] ?? 'N/A' }}</dd></div>
            <div class="bg-gray-50 rounded-lg p-3"><dt class="text-[11px] font-semibold text-gray-500 uppercase tracking-wide">Current Team</dt><dd class="text-sm font-medium text-gray-900 mt-0.5">{{ $application['current_team'] ?? 'N/A' }}</dd></div>
            <div class="bg-gray-50 rounded-lg p-3"><dt class="text-[11px] font-semibold text-gray-500 uppercase tracking-wide">Experience</dt><dd class="text-sm font-medium text-gray-900 mt-0.5">{{ $application['experience_years'] ?? 'N/A' }} years</dd></div>
        </dl>
    </div>

    <!-- Playing History -->
    @if(count($careerHistory) > 0)
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 border-l-4 border-l-violet-500 p-6">
        <div class="flex items-center gap-3 mb-4">
            <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-gradient-to-br from-violet-50 to-violet-100">
                <svg class="w-4 h-4 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </span>
            <h3 class="text-sm font-semibold text-gray-900">Playing History</h3>
        </div>
        <div class="space-y-2">
            @foreach($careerHistory as $ch)
            <div class="flex gap-4 p-3 bg-gray-50 rounded-lg">
                <div class="text-xs text-gray-400 w-24 flex-shrink-0 font-medium">{{ $ch['start_year'] ?? '' }}@if($ch['end_year'] ?? false) - {{ $ch['end_year'] }}@endif</div>
                <div><p class="text-sm font-medium text-gray-900">{{ $ch['team_name'] ?? '' }}</p><p class="text-xs text-gray-500">{{ $ch['league'] ?? '' }}@if($ch['position'] ?? false) &middot; {{ $ch['position'] }}@endif</p></div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Achievements -->
    @if(count($achievements) > 0)
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 border-l-4 border-l-amber-500 p-6">
        <div class="flex items-center gap-3 mb-4">
            <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-gradient-to-br from-amber-50 to-amber-100">
                <svg class="w-4 h-4 text-amber-600" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
            </span>
            <h3 class="text-sm font-semibold text-gray-900">Achievements</h3>
        </div>
        <div class="space-y-2">
            @foreach($achievements as $a)
            <div class="text-sm bg-gray-50 rounded-lg p-3"><span class="font-medium text-gray-900">{{ $a['title'] ?? '' }}</span>@if($a['year'] ?? false) <span class="text-gray-400">({{ $a['year'] }})</span>@endif @if($a['description'] ?? false)<span class="text-gray-500"> - {{ $a['description'] }}</span>@endif</div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Statistics -->
    @if(count($statistics) > 0)
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 border-l-4 border-l-cyan-500 p-6">
        <div class="flex items-center gap-3 mb-4">
            <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-gradient-to-br from-cyan-50 to-cyan-100">
                <svg class="w-4 h-4 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
            </span>
            <h3 class="text-sm font-semibold text-gray-900">Statistics</h3>
        </div>
        <dl class="grid grid-cols-2 sm:grid-cols-3 gap-3">
            @foreach($statistics as $stat)
            <div class="bg-gray-50 rounded-lg p-3"><dt class="text-[11px] font-semibold text-gray-500 uppercase tracking-wide">{{ $stat['stat_key'] ?? '' }}</dt><dd class="text-lg font-bold text-gray-900 mt-0.5">{{ $stat['stat_value'] ?? '' }}</dd></div>
            @endforeach
        </dl>
    </div>
    @endif

    <!-- Education & Skills -->
    @if(($application['education'] ?? false) || ($application['skills'] ?? false) || ($application['certifications'] ?? false))
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 border-l-4 border-l-rose-500 p-6">
        <div class="flex items-center gap-3 mb-4">
            <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-gradient-to-br from-rose-50 to-rose-100">
                <svg class="w-4 h-4 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
            </span>
            <h3 class="text-sm font-semibold text-gray-900">Education & Skills</h3>
        </div>
        <dl class="space-y-3">
            @if($application['education'] ?? false)<div class="bg-gray-50 rounded-lg p-3"><dt class="text-[11px] font-semibold text-gray-500 uppercase tracking-wide">Education</dt><dd class="text-sm text-gray-900 mt-0.5">{{ $application['education'] }}</dd></div>@endif
            @if($application['skills'] ?? false)<div class="bg-gray-50 rounded-lg p-3"><dt class="text-[11px] font-semibold text-gray-500 uppercase tracking-wide">Skills</dt><dd class="text-sm text-gray-900 mt-0.5">{{ $application['skills'] }}</dd></div>@endif
            @if($application['certifications'] ?? false)<div class="bg-gray-50 rounded-lg p-3"><dt class="text-[11px] font-semibold text-gray-500 uppercase tracking-wide">Certifications</dt><dd class="text-sm text-gray-900 mt-0.5">{{ $application['certifications'] }}</dd></div>@endif
        </dl>
    </div>
    @endif

    <!-- Links -->
    @if(($application['cv_url'] ?? false) || ($application['website'] ?? false))
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 border-l-4 border-l-gray-400 p-6">
        <div class="flex items-center gap-3 mb-4">
            <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-gradient-to-br from-gray-50 to-gray-100">
                <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
            </span>
            <h3 class="text-sm font-semibold text-gray-900">Links & Documents</h3>
        </div>
        <div class="flex flex-wrap gap-3">
            @if($application['cv_url'] ?? false)<a href="{{ $application['cv_url'] }}" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-50 text-blue-700 text-sm font-medium rounded-xl hover:bg-blue-100 transition-colors"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>View CV</a>@endif
            @if($application['website'] ?? false)<a href="{{ $application['website'] }}" class="inline-flex items-center gap-2 px-4 py-2 bg-gray-50 text-gray-700 text-sm font-medium rounded-xl hover:bg-gray-100 transition-colors"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9"/></svg>Website</a>@endif
        </div>
    </div>
    @endif

    @if($application['created_at'] ?? false)
    <p class="text-xs text-gray-400">Submitted {{ \Carbon\Carbon::parse($application['created_at'])->format('F d, Y \a\t H:i') }}</p>
    @endif
</div>
@endsection
