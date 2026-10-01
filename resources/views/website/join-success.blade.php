@extends('layouts.app')
@section('title', 'Application Submitted - Sportika')
@section('content')

<section class="relative overflow-hidden bg-gradient-to-br from-slate-900 via-blue-950 to-slate-900 py-20 lg:py-28">
    <div class="absolute inset-0 opacity-[0.04]">
        <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <pattern id="successGrid" width="60" height="60" patternUnits="userSpaceOnUse">
                    <path d="M 60 0 L 0 0 0 60" fill="none" stroke="white" stroke-width="0.5"/>
                </pattern>
            </defs>
            <rect width="100%" height="100%" fill="url(#successGrid)"/>
        </svg>
    </div>
    <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-blue-500/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/3"></div>
    <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-cyan-500/8 rounded-full blur-3xl translate-y-1/2 -translate-x-1/3"></div>
    <div class="relative max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="bg-white rounded-3xl border border-gray-100 p-10 sm:p-14 shadow-xl shadow-gray-900/5">
            <!-- Success Icon -->
            <div class="w-20 h-20 bg-gradient-to-br from-green-400 to-emerald-500 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg shadow-green-500/20 rotate-3">
                <svg class="w-10 h-10 text-white -rotate-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
            </div>
            <h1 class="text-3xl font-extrabold text-gray-900 font-display">Application Submitted!</h1>
            <p class="mt-4 text-lg text-gray-500">Thank you for applying to join Sportika. Your application has been received and is now under review.</p>

            <!-- What Happens Next -->
            <div class="mt-10 bg-gradient-to-br from-blue-50 to-cyan-50 rounded-2xl p-6 text-left border border-blue-100/50">
                <h3 class="font-bold text-gray-900 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    What happens next?
                </h3>
                <ol class="space-y-4 text-sm text-gray-600">
                    <li class="flex items-start gap-3">
                        <span class="w-7 h-7 rounded-lg bg-gradient-to-br from-blue-500 to-blue-600 text-white text-xs font-bold flex items-center justify-center flex-shrink-0 shadow-sm shadow-blue-500/20">1</span>
                        <span>Our team reviews your application and verifies the information provided.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="w-7 h-7 rounded-lg bg-gradient-to-br from-cyan-500 to-cyan-600 text-white text-xs font-bold flex items-center justify-center flex-shrink-0 shadow-sm shadow-cyan-500/20">2</span>
                        <span>If any changes are needed, we'll reach out to you via email.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="w-7 h-7 rounded-lg bg-gradient-to-br from-blue-600 to-blue-700 text-white text-xs font-bold flex items-center justify-center flex-shrink-0 shadow-sm shadow-blue-600/20">3</span>
                        <span>Once approved, your player portfolio will be published and visible in the directory.</span>
                    </li>
                </ol>
            </div>

            <!-- Actions -->
            <div class="mt-10 flex flex-col sm:flex-row gap-3 justify-center">
                <a href="{{ route('home') }}" class="px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-xl hover:from-blue-700 hover:to-blue-800 shadow-md shadow-blue-600/20 transition-all">Back to Home</a>
                <a href="{{ route('players.directory') }}" class="px-6 py-3 bg-gray-100 text-gray-700 font-semibold rounded-xl hover:bg-gray-200 transition-colors">Browse Players</a>
            </div>
        </div>
    </div>
</section>
@endsection
