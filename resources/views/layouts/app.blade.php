<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name'))</title>
    <meta name="description" content="@yield('meta_description', 'Sportika - The premier platform for athletes to showcase their talent, build their portfolio, and connect with opportunities worldwide.')">
    <meta name="theme-color" content="#2563eb">

    <!-- Favicon & App Icons -->
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="manifest" href="/site.webmanifest">

    <!-- Tailwind CSS (Play CDN) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        display: ['Plus Jakarta Sans', 'Inter', 'sans-serif'],
                    },
                }
            }
        }
    </script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --brand-blue: #2563eb;
            --brand-blue-dark: #1d4ed8;
            --brand-blue-light: #3b82f6;
            --brand-navy: #0f172a;
            --brand-accent: #06b6d4;
        }
        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
        }
        .font-display {
            font-family: 'Plus Jakarta Sans', 'Inter', sans-serif;
        }

        /* Navigation scroll effect */
        .nav-scrolled {
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.08), 0 1px 2px -1px rgba(0, 0, 0, 0.08);
            backdrop-filter: blur(12px);
            background-color: rgba(255, 255, 255, 0.95) !important;
        }

        /* Gradient text */
        .gradient-text {
            background: linear-gradient(135deg, #2563eb 0%, #06b6d4 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Hero gradient background */
        .hero-gradient {
            background: linear-gradient(135deg, #f8fafc 0%, #eff6ff 50%, #f0f9ff 100%);
        }

        /* Decorative blob */
        .blob {
            border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
            animation: blob-float 8s ease-in-out infinite;
        }
        @keyframes blob-float {
            0%, 100% { border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%; transform: translateY(0) rotate(0deg); }
            50% { border-radius: 70% 30% 30% 70% / 70% 70% 30% 30%; transform: translateY(-20px) rotate(5deg); }
        }

        /* Card hover lift */
        .card-hover {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.08), 0 8px 10px -6px rgba(0, 0, 0, 0.04);
        }

        /* Section divider gradient */
        .section-divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, #e2e8f0, transparent);
        }

        /* Badge pill */
        .badge-pill {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.025em;
        }

        /* CTA gradient */
        .cta-gradient {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 50%, #1e40af 100%);
        }

        /* Smooth scroll */
        html { scroll-behavior: smooth; }

        /* Logo mark animation */
        .logo-mark {
            transition: transform 0.3s ease;
        }
        .logo-mark:hover {
            transform: scale(1.05);
        }

        /* Stats counter */
        .stat-number {
            font-variant-numeric: tabular-nums;
        }

        /* Footer gradient */
        .footer-gradient {
            background: linear-gradient(180deg, #0f172a 0%, #020617 100%);
        }

        /* Mobile menu transition */
        #mobile-menu {
            transition: opacity 0.2s ease, transform 0.2s ease;
        }
    </style>
    @stack('styles')
</head>
<body class="bg-white text-gray-900 antialiased">

    <!-- Navigation -->
    <nav id="main-nav" class="bg-white/80 border-b border-gray-100/60 sticky top-0 z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-18 py-1">
                <div class="flex items-center">
                    <!-- Logo -->
                    <a href="{{ route('home') }}" class="flex items-center space-x-2 logo-mark">
                        <img src="/logo.svg" alt="Sportika" class="w-9 h-9">
                        <span class="text-xl font-extrabold tracking-tight font-display">
                            <span class="text-gray-900">Sport</span><span class="gradient-text">ika</span>
                        </span>
                    </a>
                    <!-- Desktop Nav -->
                    <div class="hidden md:ml-10 md:flex md:space-x-1">
                        <a href="{{ route('home') }}" class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('home') ? 'text-blue-600 bg-blue-50' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">Home</a>
                        <a href="{{ route('about') }}" class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('about') ? 'text-blue-600 bg-blue-50' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">About</a>
                        <a href="{{ route('players.directory') }}" class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('players.*') ? 'text-blue-600 bg-blue-50' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">Players</a>
                        <a href="{{ route('blog.index') }}" class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('blog.*') ? 'text-blue-600 bg-blue-50' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">Blog</a>
                        <a href="{{ route('contact') }}" class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('contact') ? 'text-blue-600 bg-blue-50' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">Contact</a>
                    </div>
                </div>
                <div class="flex items-center space-x-3">
                    <a href="{{ route('join.index') }}" class="hidden sm:inline-flex items-center px-5 py-2.5 text-sm font-semibold rounded-xl text-white bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 shadow-md shadow-blue-600/20 transition-all duration-200 hover:shadow-lg hover:shadow-blue-600/30">
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                        Join Sportika
                    </a>
                    
                    <!-- Mobile menu button -->
                    <button type="button" onclick="document.getElementById('mobile-menu').classList.toggle('hidden')" class="md:hidden inline-flex items-center justify-center p-2 rounded-xl text-gray-500 hover:text-gray-700 hover:bg-gray-100 transition-colors">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                </div>
            </div>
        </div>
        <!-- Mobile menu -->
        <div id="mobile-menu" class="hidden md:hidden border-t border-gray-100 bg-white">
            <div class="px-4 py-4 space-y-1">
                <a href="{{ route('home') }}" class="block px-4 py-3 text-sm font-medium rounded-xl {{ request()->routeIs('home') ? 'text-blue-600 bg-blue-50' : 'text-gray-600 hover:bg-gray-50' }}">Home</a>
                <a href="{{ route('about') }}" class="block px-4 py-3 text-sm font-medium rounded-xl {{ request()->routeIs('about') ? 'text-blue-600 bg-blue-50' : 'text-gray-600 hover:bg-gray-50' }}">About</a>
                <a href="{{ route('players.directory') }}" class="block px-4 py-3 text-sm font-medium rounded-xl {{ request()->routeIs('players.*') ? 'text-blue-600 bg-blue-50' : 'text-gray-600 hover:bg-gray-50' }}">Players</a>
                <a href="{{ route('blog.index') }}" class="block px-4 py-3 text-sm font-medium rounded-xl {{ request()->routeIs('blog.*') ? 'text-blue-600 bg-blue-50' : 'text-gray-600 hover:bg-gray-50' }}">Blog</a>
                <a href="{{ route('contact') }}" class="block px-4 py-3 text-sm font-medium rounded-xl {{ request()->routeIs('contact') ? 'text-blue-600 bg-blue-50' : 'text-gray-600 hover:bg-gray-50' }}">Contact</a>
                <div class="pt-2">
                    <a href="{{ route('join.index') }}" class="block px-4 py-3 text-sm font-semibold text-white bg-gradient-to-r from-blue-600 to-blue-700 rounded-xl text-center">Join Sportika</a>
                </div>
            </div>
        </div>
    </nav>

    <main>@yield('content')</main>

    <!-- Footer -->
    <footer class="footer-gradient text-white">
        <!-- CTA Bar -->
        <div class="border-b border-white/10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                    <div>
                        <h3 class="text-2xl font-bold font-display">Ready to showcase your talent?</h3>
                        <p class="mt-1 text-gray-400">Join hundreds of athletes building their professional portfolio.</p>
                    </div>
                    <a href="{{ route('join.index') }}" class="inline-flex items-center px-8 py-3.5 rounded-xl text-sm font-semibold text-blue-600 bg-white hover:bg-blue-50 transition-colors shadow-lg flex-shrink-0">
                        Get Started Free
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                    </a>
                </div>
            </div>
        </div>

        <!-- Footer Links -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-2 md:grid-cols-5 gap-8">
                <!-- Brand -->
                <div class="col-span-2">
                    <div class="flex items-center space-x-2 mb-4">
                        <img src="/logo.svg" alt="Sportika" class="w-8 h-8">
                        <span class="text-lg font-extrabold font-display">Sport<span class="text-blue-400">ika</span></span>
                    </div>
                    <p class="text-sm text-gray-400 leading-relaxed max-w-xs">The premier platform for athletes to showcase their talent, build their portfolio, and connect with opportunities worldwide.</p>
                    <!-- Social Icons -->
                    <div class="flex space-x-3 mt-6">
                        <a href="#" class="w-9 h-9 rounded-lg bg-white/5 hover:bg-white/10 flex items-center justify-center text-gray-400 hover:text-white transition-colors">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                        </a>
                        <a href="#" class="w-9 h-9 rounded-lg bg-white/5 hover:bg-white/10 flex items-center justify-center text-gray-400 hover:text-white transition-colors">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                        <a href="#" class="w-9 h-9 rounded-lg bg-white/5 hover:bg-white/10 flex items-center justify-center text-gray-400 hover:text-white transition-colors">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                        </a>
                        <a href="#" class="w-9 h-9 rounded-lg bg-white/5 hover:bg-white/10 flex items-center justify-center text-gray-400 hover:text-white transition-colors">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814z"/><path fill="#0f172a" d="M9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                        </a>
                    </div>
                </div>

                <!-- Links -->
                <div>
                    <h4 class="text-xs font-semibold uppercase tracking-wider text-gray-500 mb-4">Platform</h4>
                    <ul class="space-y-3">
                        <li><a href="{{ route('home') }}" class="text-sm text-gray-400 hover:text-white transition-colors">Home</a></li>
                        <li><a href="{{ route('about') }}" class="text-sm text-gray-400 hover:text-white transition-colors">About</a></li>
                        <li><a href="{{ route('players.directory') }}" class="text-sm text-gray-400 hover:text-white transition-colors">Players</a></li>
                        <li><a href="{{ route('blog.index') }}" class="text-sm text-gray-400 hover:text-white transition-colors">Blog</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-xs font-semibold uppercase tracking-wider text-gray-500 mb-4">Get Involved</h4>
                    <ul class="space-y-3">
                        <li><a href="{{ route('join.index') }}" class="text-sm text-gray-400 hover:text-white transition-colors">Join Sportika</a></li>
                        <li><a href="{{ route('contact') }}" class="text-sm text-gray-400 hover:text-white transition-colors">Contact Us</a></li>
                        <li><a href="{{ route('contact') }}" class="text-sm text-gray-400 hover:text-white transition-colors">Partnerships</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-xs font-semibold uppercase tracking-wider text-gray-500 mb-4">Contact</h4>
                    <ul class="space-y-3">
                        <li class="text-sm text-gray-400">hello@sportika.com</li>
                        <li class="text-sm text-gray-400">Mon - Fri, 9am - 6pm</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Bottom bar -->
        <div class="border-t border-white/5">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                    <p class="text-xs text-gray-500">&copy; {{ date('Y') }} Sportika. All rights reserved.</p>
                    <div class="flex space-x-6">
                        <a href="#" class="text-xs text-gray-500 hover:text-gray-300 transition-colors">Privacy Policy</a>
                        <a href="#" class="text-xs text-gray-500 hover:text-gray-300 transition-colors">Terms of Service</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scroll-aware nav -->
    <script>
        window.addEventListener('scroll', function() {
            const nav = document.getElementById('main-nav');
            if (window.scrollY > 10) {
                nav.classList.add('nav-scrolled');
            } else {
                nav.classList.remove('nav-scrolled');
            }
        });
    </script>
    @stack('scripts')
</body>
</html>
