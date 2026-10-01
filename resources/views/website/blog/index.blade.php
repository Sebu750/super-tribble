@extends('layouts.app')
@section('title', 'Blog - Sportika')
@section('content')

<!-- Hero with Dark Banner -->
<section class="relative overflow-hidden bg-gradient-to-br from-slate-900 via-blue-950 to-slate-900">
    <div class="absolute inset-0 opacity-[0.04]">
        <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <pattern id="blogGrid" width="60" height="60" patternUnits="userSpaceOnUse">
                    <path d="M 60 0 L 0 0 0 60" fill="none" stroke="white" stroke-width="0.5"/>
                </pattern>
            </defs>
            <rect width="100%" height="100%" fill="url(#blogGrid)"/>
        </svg>
    </div>
    <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-blue-500/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/3"></div>
    <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-cyan-500/8 rounded-full blur-3xl translate-y-1/2 -translate-x-1/3"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-24 text-center">
        <span class="inline-flex items-center px-4 py-1.5 rounded-full bg-white/5 border border-white/10 backdrop-blur-sm text-xs font-semibold text-blue-200 tracking-wide uppercase mb-4">Our Blog</span>
        <h1 class="text-4xl sm:text-5xl font-extrabold text-white font-display">News, Insights & <span class="bg-gradient-to-r from-blue-400 to-cyan-300 bg-clip-text text-transparent">Stories</span></h1>
        <p class="mt-4 text-lg text-blue-100/60 max-w-2xl mx-auto">Stay updated with the latest from the world of sports and our platform</p>
    </div>
    <div class="absolute bottom-0 left-0 right-0 h-24 bg-gradient-to-t from-white to-transparent"></div>
</section>

<section class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Featured Post -->
        @if(isset($featuredPost))
        <a href="{{ route('blog.show', $featuredPost['slug']) }}" class="group card-hover block mb-14 bg-white rounded-3xl border border-gray-100 overflow-hidden">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-0">
                <div class="aspect-video lg:aspect-auto bg-gradient-to-br from-blue-50 to-cyan-50 flex items-center justify-center overflow-hidden">
                    @if($featuredPost['featured_image'] ?? false)
                        <img src="{{ $featuredPost['featured_image'] }}" alt="" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                        <svg class="w-20 h-20 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                    @endif
                </div>
                <div class="p-8 lg:p-12 flex flex-col justify-center">
                    <span class="badge-pill bg-gradient-to-r from-amber-400 to-amber-500 text-white mb-4 w-fit">
                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        Featured
                    </span>
                    <h2 class="text-2xl lg:text-3xl font-bold text-gray-900 group-hover:text-blue-600 transition-colors font-display">{{ $featuredPost['title'] }}</h2>
                    <p class="mt-4 text-gray-500 line-clamp-3 leading-relaxed">{{ $featuredPost['excerpt'] ?? Str::limit(strip_tags($featuredPost['content'] ?? ''), 200) }}</p>
                    <div class="mt-6 flex items-center gap-3 text-sm text-gray-400">
                        <span class="font-medium text-gray-600">{{ $featuredPost['author_name'] ?? 'Sportika Team' }}</span>
                        <span>&middot;</span>
                        <span>{{ \Carbon\Carbon::parse($featuredPost['published_at'] ?? $featuredPost['created_at'])->format('M d, Y') }}</span>
                    </div>
                </div>
            </div>
        </a>
        @endif

        <!-- Search & Categories -->
        <div class="flex flex-col sm:flex-row items-center gap-6 mb-12">
            <form method="GET" action="{{ route('blog.index') }}" class="flex-1 w-full sm:max-w-sm">
                <div class="relative">
                    <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    <input type="text" name="search" value="{{ $filters['search'] ?? '' }}" placeholder="Search articles..." class="w-full pl-11 pr-4 py-3 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-gray-50 focus:bg-white transition-colors">
                </div>
            </form>
            @if(count($categories) > 0)
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('blog.index') }}" class="px-4 py-2 rounded-xl text-sm font-medium transition-colors {{ !($filters['category'] ?? false) ? 'bg-blue-600 text-white shadow-md shadow-blue-600/20' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">All</a>
                @foreach($categories as $cat)
                <a href="{{ route('blog.index', ['category' => $cat['id']]) }}" class="px-4 py-2 rounded-xl text-sm font-medium transition-colors {{ ($filters['category'] ?? '') == $cat['id'] ? 'bg-blue-600 text-white shadow-md shadow-blue-600/20' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">{{ $cat['name'] }}</a>
                @endforeach
            </div>
            @endif
        </div>

        <!-- Blog Grid -->
        @if(count($posts) > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($posts as $post)
            <a href="{{ route('blog.show', $post['slug']) }}" class="group card-hover bg-white rounded-2xl border border-gray-100 overflow-hidden">
                <div class="aspect-video bg-gradient-to-br from-blue-50 to-cyan-50 flex items-center justify-center overflow-hidden">
                    @if($post['featured_image'] ?? false)
                        <img src="{{ $post['featured_image'] }}" alt="" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                        <svg class="w-12 h-12 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                    @endif
                </div>
                <div class="p-6">
                    @if($post['category_name'] ?? false)
                    <span class="badge-pill bg-blue-50 text-blue-700 text-xs mb-3">{{ $post['category_name'] }}</span>
                    @endif
                    <h3 class="text-lg font-bold text-gray-900 group-hover:text-blue-600 transition-colors line-clamp-2">{{ $post['title'] }}</h3>
                    <p class="mt-2 text-sm text-gray-500 line-clamp-2">{{ $post['excerpt'] ?? Str::limit(strip_tags($post['content'] ?? ''), 120) }}</p>
                    <div class="mt-5 flex items-center justify-between">
                        <div class="flex items-center gap-2 text-xs text-gray-400">
                            <span class="font-medium text-gray-500">{{ $post['author_name'] ?? 'Sportika Team' }}</span>
                            <span>&middot;</span>
                            <span>{{ \Carbon\Carbon::parse($post['published_at'] ?? $post['created_at'])->format('M d, Y') }}</span>
                        </div>
                        <span class="text-blue-600 text-sm font-medium group-hover:translate-x-1 transition-transform">&rarr;</span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
        @else
        <div class="text-center py-20 bg-gray-50/50 rounded-2xl border border-gray-100">
            <div class="w-20 h-20 rounded-2xl bg-gray-100 flex items-center justify-center mx-auto mb-4">
                <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
            </div>
            <p class="text-gray-500 font-medium">No articles found</p>
            <p class="text-sm text-gray-400 mt-1">Try adjusting your search or category filter</p>
        </div>
        @endif
    </div>
</section>
@endsection
