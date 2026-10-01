@extends('layouts.app')
@section('title', 'About - Sportika')
@section('content')

<!-- Hero with Dark Banner -->
<section class="relative overflow-hidden bg-gradient-to-br from-slate-900 via-blue-950 to-slate-900">
    <div class="absolute inset-0 opacity-[0.04]">
        <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <pattern id="aboutGrid" width="60" height="60" patternUnits="userSpaceOnUse">
                    <path d="M 60 0 L 0 0 0 60" fill="none" stroke="white" stroke-width="0.5"/>
                </pattern>
            </defs>
            <rect width="100%" height="100%" fill="url(#aboutGrid)"/>
        </svg>
    </div>
    <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-blue-500/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/3"></div>
    <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-cyan-500/8 rounded-full blur-3xl translate-y-1/2 -translate-x-1/3"></div>
    <div class="absolute top-0 left-1/3 w-px h-full bg-gradient-to-b from-transparent via-blue-400/10 to-transparent"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 lg:py-32">
        <div class="max-w-3xl mx-auto text-center">
            <span class="inline-flex items-center px-4 py-1.5 rounded-full bg-white/5 border border-white/10 backdrop-blur-sm text-xs font-semibold text-blue-200 tracking-wide uppercase mb-6">About Sportika</span>
            <h1 class="text-4xl sm:text-5xl font-extrabold text-white font-display leading-tight">Empowering Athletes to <span class="bg-gradient-to-r from-blue-400 to-cyan-300 bg-clip-text text-transparent">Build Their Legacy</span></h1>
            <p class="mt-6 text-lg text-blue-100/60 leading-relaxed">We believe every athlete deserves a platform to showcase their talent, build their brand, and connect with the sports world.</p>
        </div>
    </div>
    <div class="absolute bottom-0 left-0 right-0 h-24 bg-gradient-to-t from-white to-transparent"></div>
</section>

<!-- Mission -->
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div>
                <span class="badge-pill bg-blue-50 text-blue-700 mb-4">Our Mission</span>
                <h2 class="text-3xl font-bold text-gray-900 font-display mb-6">Building the Home for Athletes Everywhere</h2>
                <p class="text-gray-600 leading-relaxed mb-5">Sportika is dedicated to giving athletes the platform they deserve. We believe every athlete, from amateur to professional, should have the tools to showcase their talent, build their brand, and connect with opportunities.</p>
                <p class="text-gray-600 leading-relaxed mb-5">Our platform provides verified player profiles, career statistics, and a comprehensive directory that makes it easy for scouts, coaches, and teams to discover talent.</p>
                <p class="text-gray-600 leading-relaxed">Whether you're a footballer, basketball player, swimmer, or compete in any other sport, Sportika is your home.</p>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-gradient-to-br from-blue-50 to-blue-100/50 rounded-2xl p-8 text-center border border-blue-100/50 card-hover">
                    <p class="text-4xl font-extrabold gradient-text font-display">20+</p>
                    <p class="text-sm text-gray-600 mt-2 font-medium">Sports Categories</p>
                </div>
                <div class="bg-gradient-to-br from-green-50 to-green-100/50 rounded-2xl p-8 text-center border border-green-100/50 card-hover">
                    <p class="text-4xl font-extrabold text-green-600 font-display">100%</p>
                    <p class="text-sm text-gray-600 mt-2 font-medium">Verified Profiles</p>
                </div>
                <div class="bg-gradient-to-br from-purple-50 to-purple-100/50 rounded-2xl p-8 text-center border border-purple-100/50 card-hover">
                    <p class="text-4xl font-extrabold text-purple-600 font-display">Global</p>
                    <p class="text-sm text-gray-600 mt-2 font-medium">Worldwide Reach</p>
                </div>
                <div class="bg-gradient-to-br from-amber-50 to-amber-100/50 rounded-2xl p-8 text-center border border-amber-100/50 card-hover">
                    <p class="text-4xl font-extrabold text-amber-600 font-display">Free</p>
                    <p class="text-sm text-gray-600 mt-2 font-medium">To Join</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- How It Works -->
<section class="py-24 bg-gray-50/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <span class="badge-pill bg-cyan-50 text-cyan-700 mb-4">Simple Process</span>
            <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 font-display">How It Works</h2>
            <p class="mt-4 text-lg text-gray-500">Get started in four simple steps</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 relative">
            <div class="hidden md:block absolute top-12 left-[12.5%] right-[12.5%] h-0.5 bg-gradient-to-r from-blue-200 via-cyan-200 to-blue-200"></div>

            <div class="relative text-center group">
                <div class="relative z-10 w-14 h-14 rounded-2xl bg-gradient-to-br from-blue-500 to-blue-600 text-white flex items-center justify-center mx-auto mb-6 shadow-lg shadow-blue-500/20 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">1. Sign Up</h3>
                <p class="text-sm text-gray-500 leading-relaxed">Fill out the player registration form with your details and achievements.</p>
            </div>
            <div class="relative text-center group">
                <div class="relative z-10 w-14 h-14 rounded-2xl bg-gradient-to-br from-cyan-500 to-cyan-600 text-white flex items-center justify-center mx-auto mb-6 shadow-lg shadow-cyan-500/20 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">2. Review</h3>
                <p class="text-sm text-gray-500 leading-relaxed">Our team reviews and verifies your application for quality.</p>
            </div>
            <div class="relative text-center group">
                <div class="relative z-10 w-14 h-14 rounded-2xl bg-gradient-to-br from-blue-600 to-blue-700 text-white flex items-center justify-center mx-auto mb-6 shadow-lg shadow-blue-600/20 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2"/></svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">3. Profile Live</h3>
                <p class="text-sm text-gray-500 leading-relaxed">Your professional player portfolio goes live on our platform.</p>
            </div>
            <div class="relative text-center group">
                <div class="relative z-10 w-14 h-14 rounded-2xl bg-gradient-to-br from-cyan-600 to-cyan-700 text-white flex items-center justify-center mx-auto mb-6 shadow-lg shadow-cyan-600/20 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">4. Get Discovered</h3>
                <p class="text-sm text-gray-500 leading-relaxed">Connect with scouts, coaches, and opportunities in your sport.</p>
            </div>
        </div>
    </div>
</section>

<!-- What We Offer -->
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <span class="badge-pill bg-purple-50 text-purple-700 mb-4">For Athletes</span>
            <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 font-display">What Sportika Does For Players</h2>
            <p class="mt-4 text-lg text-gray-500">Everything you need to build your professional presence</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="flex items-start p-6 rounded-2xl bg-gradient-to-br from-blue-50/50 to-white border border-blue-100/50 hover:shadow-lg hover:shadow-blue-600/5 transition-all duration-300">
                <div class="w-10 h-10 rounded-xl bg-blue-100 flex items-center justify-center flex-shrink-0 mr-4">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                </div>
                <div>
                    <h3 class="font-bold text-gray-900 mb-1">Professional Portfolio</h3>
                    <p class="text-sm text-gray-500">Showcase your photo, bio, career details, and achievements in a polished profile.</p>
                </div>
            </div>
            <div class="flex items-start p-6 rounded-2xl bg-gradient-to-br from-green-50/50 to-white border border-green-100/50 hover:shadow-lg hover:shadow-green-600/5 transition-all duration-300">
                <div class="w-10 h-10 rounded-xl bg-green-100 flex items-center justify-center flex-shrink-0 mr-4">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                </div>
                <div>
                    <h3 class="font-bold text-gray-900 mb-1">Stats & History</h3>
                    <p class="text-sm text-gray-500">Display your career statistics, team history, and performance metrics.</p>
                </div>
            </div>
            <div class="flex items-start p-6 rounded-2xl bg-gradient-to-br from-purple-50/50 to-white border border-purple-100/50 hover:shadow-lg hover:shadow-purple-600/5 transition-all duration-300">
                <div class="w-10 h-10 rounded-xl bg-purple-100 flex items-center justify-center flex-shrink-0 mr-4">
                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
                <div>
                    <h3 class="font-bold text-gray-900 mb-1">Gallery & Videos</h3>
                    <p class="text-sm text-gray-500">Upload highlight reels, action shots, and video content to your profile.</p>
                </div>
            </div>
            <div class="flex items-start p-6 rounded-2xl bg-gradient-to-br from-amber-50/50 to-white border border-amber-100/50 hover:shadow-lg hover:shadow-amber-600/5 transition-all duration-300">
                <div class="w-10 h-10 rounded-xl bg-amber-100 flex items-center justify-center flex-shrink-0 mr-4">
                    <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>
                <div>
                    <h3 class="font-bold text-gray-900 mb-1">Downloadable CV</h3>
                    <p class="text-sm text-gray-500">Generate a professional player profile document you can share anywhere.</p>
                </div>
            </div>
            <div class="flex items-start p-6 rounded-2xl bg-gradient-to-br from-cyan-50/50 to-white border border-cyan-100/50 hover:shadow-lg hover:shadow-cyan-600/5 transition-all duration-300">
                <div class="w-10 h-10 rounded-xl bg-cyan-100 flex items-center justify-center flex-shrink-0 mr-4">
                    <svg class="w-5 h-5 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                </div>
                <div>
                    <h3 class="font-bold text-gray-900 mb-1">Skills & Education</h3>
                    <p class="text-sm text-gray-500">Highlight your skills, certifications, and educational background.</p>
                </div>
            </div>
            <div class="flex items-start p-6 rounded-2xl bg-gradient-to-br from-rose-50/50 to-white border border-rose-100/50 hover:shadow-lg hover:shadow-rose-600/5 transition-all duration-300">
                <div class="w-10 h-10 rounded-xl bg-rose-100 flex items-center justify-center flex-shrink-0 mr-4">
                    <svg class="w-5 h-5 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                </div>
                <div>
                    <h3 class="font-bold text-gray-900 mb-1">Social & Contact</h3>
                    <p class="text-sm text-gray-500">Link your social media profiles and make it easy for teams to reach you.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA with Dark Banner -->
<section class="py-24 relative overflow-hidden bg-gradient-to-br from-slate-900 via-blue-950 to-slate-900">
    <div class="absolute inset-0 opacity-[0.04]">
        <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <pattern id="aboutCtaGrid" width="60" height="60" patternUnits="userSpaceOnUse">
                    <path d="M 60 0 L 0 0 0 60" fill="none" stroke="white" stroke-width="0.5"/>
                </pattern>
            </defs>
            <rect width="100%" height="100%" fill="url(#aboutCtaGrid)"/>
        </svg>
    </div>
    <div class="absolute top-0 right-0 w-[400px] h-[400px] bg-blue-500/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/3"></div>
    <div class="absolute bottom-0 left-0 w-[300px] h-[300px] bg-cyan-500/8 rounded-full blur-3xl translate-y-1/2 -translate-x-1/3"></div>
    <div class="relative max-w-4xl mx-auto px-4 text-center">
        <h2 class="text-3xl sm:text-4xl font-bold text-white font-display">Ready to start your journey?</h2>
        <p class="mt-5 text-lg text-blue-100/70">Join Sportika today and take the first step toward building your professional athlete portfolio.</p>
        <div class="mt-10 flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('join.index') }}" class="inline-flex items-center justify-center px-8 py-4 rounded-xl text-sm font-semibold text-slate-900 bg-gradient-to-r from-blue-400 to-cyan-300 hover:from-blue-300 hover:to-cyan-200 shadow-xl shadow-blue-500/20 transition-all duration-200">
                Get Started Free
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
            </a>
            <a href="{{ route('contact') }}" class="inline-flex items-center justify-center px-8 py-4 rounded-xl text-sm font-semibold text-white border-2 border-white/20 hover:border-white/40 hover:bg-white/5 transition-all duration-200">Contact Us</a>
        </div>
    </div>
</section>
@endsection
