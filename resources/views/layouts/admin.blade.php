<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin') - {{ config('app.name') }}</title>

    <!-- Favicon & App Icons -->
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="manifest" href="/site.webmanifest">

    <!-- Tailwind CSS (Play CDN) -->
    <script src="https://cdn.tailwindcss.com/3.4.17"></script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Inter', system-ui, -apple-system, sans-serif; }

        /* Sidebar gradient */
        .sidebar-bg {
            background: linear-gradient(180deg, #0f172a 0%, #1e293b 100%);
        }

        /* Sidebar scrollbar */
        .sidebar-scroll::-webkit-scrollbar { width: 4px; }
        .sidebar-scroll::-webkit-scrollbar-track { background: transparent; }
        .sidebar-scroll::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 4px; }

        /* Mobile sidebar transitions */
        .sidebar-mobile {
            transform: translateX(-100%);
            transition: transform 0.3s ease-in-out;
        }
        .sidebar-mobile.open {
            transform: translateX(0);
        }
        .sidebar-overlay {
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease-in-out;
        }
        .sidebar-overlay.open {
            opacity: 1;
            pointer-events: auto;
        }

        /* Desktop sidebar collapse */
        .sidebar-desktop {
            transition: width 0.3s ease-in-out, transform 0.3s ease-in-out;
        }

        /* Active nav gradient */
        .nav-active {
            background: linear-gradient(135deg, #2563eb 0%, #3b82f6 100%);
        }

        /* Card hover lift */
        .card-lift {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .card-lift:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px -5px rgba(0,0,0,0.08);
        }

        /* Status dot */
        .status-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            display: inline-block;
        }
    </style>

    @stack('styles')
</head>
<body class="bg-gray-50 antialiased">

    <div class="flex h-screen overflow-hidden">

        <!-- Mobile sidebar overlay -->
        <div id="sidebar-overlay" class="sidebar-overlay fixed inset-0 z-40 bg-black/50 lg:hidden" onclick="toggleSidebar()"></div>

        <!-- Sidebar -->
        <aside id="sidebar" class="sidebar-mobile fixed z-50 lg:relative lg:translate-x-0 lg:z-0 flex flex-shrink-0 h-screen">
            <div class="sidebar-bg flex flex-col w-64 h-full">

                <!-- Sidebar Header -->
                <div class="flex items-center justify-between h-16 px-5 border-b border-white/10">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-2.5">
                        <img src="/logo.svg" alt="Sportika" class="w-8 h-8">
                        <span class="text-base font-bold text-white">Sport<span class="text-blue-400">ika</span></span>
                    </a>
                    <!-- Mobile close button -->
                    <button onclick="toggleSidebar()" class="lg:hidden text-gray-400 hover:text-white">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>

                <!-- Sidebar Navigation -->
                <nav class="flex-1 px-3 py-5 space-y-0.5 overflow-y-auto sidebar-scroll">

                    <!-- Main -->
                    <a href="{{ route('admin.dashboard') }}"
                       class="flex items-center px-3 py-2.5 text-sm font-medium rounded-xl transition-colors {{ request()->routeIs('admin.dashboard') ? 'nav-active text-white shadow-lg shadow-blue-600/20' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                        <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        Dashboard
                    </a>

                    <!-- Divider -->
                    <div class="pt-5 pb-2 px-3">
                        <div class="h-px bg-gradient-to-r from-transparent via-white/10 to-transparent"></div>
                    </div>
                    <p class="px-3 text-[10px] font-semibold uppercase tracking-widest text-gray-500 mb-2">Management</p>

                    <a href="{{ route('admin.players.index') }}"
                       class="flex items-center px-3 py-2.5 text-sm font-medium rounded-xl transition-colors {{ request()->routeIs('admin.players.*') ? 'nav-active text-white shadow-lg shadow-blue-600/20' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                        <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        Players
                    </a>

                    <a href="{{ route('admin.applications.index') }}"
                       class="flex items-center px-3 py-2.5 text-sm font-medium rounded-xl transition-colors {{ request()->routeIs('admin.applications.*') ? 'nav-active text-white shadow-lg shadow-blue-600/20' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                        <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Applications
                        @if(($pendingCount ?? 0) > 0)
                        <span class="ml-auto inline-flex items-center justify-center min-w-[20px] h-5 px-1.5 text-[10px] font-bold bg-red-500 text-white rounded-full">{{ $pendingCount }}</span>
                        @endif
                    </a>

                    <!-- Divider -->
                    <div class="pt-5 pb-2 px-3">
                        <div class="h-px bg-gradient-to-r from-transparent via-white/10 to-transparent"></div>
                    </div>
                    <p class="px-3 text-[10px] font-semibold uppercase tracking-widest text-gray-500 mb-2">Content</p>

                    <a href="{{ route('admin.blog.index') }}"
                       class="flex items-center px-3 py-2.5 text-sm font-medium rounded-xl transition-colors {{ request()->routeIs('admin.blog.*') ? 'nav-active text-white shadow-lg shadow-blue-600/20' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                        <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                        </svg>
                        Blog Posts
                    </a>

                    <!-- Divider -->
                    <div class="pt-5 pb-2 px-3">
                        <div class="h-px bg-gradient-to-r from-transparent via-white/10 to-transparent"></div>
                    </div>
                    <p class="px-3 text-[10px] font-semibold uppercase tracking-widest text-gray-500 mb-2">System</p>

                    <a href="{{ route('admin.settings.index') }}"
                       class="flex items-center px-3 py-2.5 text-sm font-medium rounded-xl transition-colors {{ request()->routeIs('admin.settings.*') ? 'nav-active text-white shadow-lg shadow-blue-600/20' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                        <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        Settings
                    </a>
                </nav>

                <!-- Sidebar Footer - User & Sign Out -->
                <div class="flex-shrink-0 p-4 border-t border-white/10">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center min-w-0 flex-1 mr-3">
                            <div class="flex-shrink-0">
                                <span class="inline-flex items-center justify-center w-9 h-9 rounded-xl bg-gradient-to-br from-blue-500 to-cyan-400 text-white text-sm font-semibold shadow-lg shadow-blue-600/20">
                                    {{ strtoupper(substr($user['email'] ?? 'A', 0, 1)) }}
                                </span>
                            </div>
                            <div class="ml-3 min-w-0">
                                <p class="text-sm font-medium text-white truncate">{{ $user['email'] ?? 'Admin' }}</p>
                                <p class="text-[11px] text-gray-500">Administrator</p>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('admin.logout') }}">
                            @csrf
                            <button type="submit" title="Sign out" class="flex items-center gap-2 px-3 py-2 text-sm font-medium text-gray-400 hover:text-white bg-white/[0.04] hover:bg-red-500/20 border border-white/[0.06] hover:border-red-500/30 rounded-xl transition-all duration-200">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                </svg>
                                <span class="hidden sm:inline">Sign Out</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="flex flex-col flex-1 overflow-hidden">
            <!-- Top Bar -->
            <header class="bg-white border-b border-gray-100">
                <div class="flex items-center justify-between h-16 px-4 sm:px-6">
                    <div class="flex items-center gap-3">
                        <!-- Mobile hamburger -->
                        <button onclick="toggleSidebar()" class="lg:hidden p-2 -ml-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-xl transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                        </button>
                        <div class="hidden sm:block h-8 w-px bg-gray-200"></div>
                        <h1 class="text-base font-semibold text-gray-900">
                            @yield('header', 'Dashboard')
                        </h1>
                    </div>
                    <div class="flex items-center">
                        <span class="text-xs text-gray-400">{{ now()->format('M d, Y') }}</span>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto p-4 sm:p-6">
                @if(session('success'))
                    <div class="mb-5 rounded-xl bg-emerald-50 border border-emerald-200 p-4 flex items-start gap-3">
                        <svg class="w-5 h-5 text-emerald-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <p class="text-sm text-emerald-700">{{ session('success') }}</p>
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-5 rounded-xl bg-red-50 border border-red-200 p-4 flex items-start gap-3">
                        <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <p class="text-sm text-red-700">{{ session('error') }}</p>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <!-- Sidebar toggle script -->
    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('open');
            document.getElementById('sidebar-overlay').classList.toggle('open');
        }
    </script>

    @stack('scripts')
</body>
</html>
