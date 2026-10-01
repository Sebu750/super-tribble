@extends('layouts.app')
@section('title', ($post['title'] ?? 'Article') . ' - Sportika Blog')
@section('content')

<!-- Hero Header with Dark Banner -->
<section class="relative overflow-hidden bg-gradient-to-br from-slate-900 via-blue-950 to-slate-900">
    <div class="absolute inset-0 opacity-[0.04]">
        <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <pattern id="blogShowGrid" width="60" height="60" patternUnits="userSpaceOnUse">
                    <path d="M 60 0 L 0 0 0 60" fill="none" stroke="white" stroke-width="0.5"/>
                </pattern>
            </defs>
            <rect width="100%" height="100%" fill="url(#blogShowGrid)"/>
        </svg>
    </div>
    <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-blue-500/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/3"></div>
    <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-cyan-500/8 rounded-full blur-3xl translate-y-1/2 -translate-x-1/3"></div>
    <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-24">
        <!-- Breadcrumb -->
        <nav class="flex items-center gap-2 text-sm text-blue-200/40 mb-8">
            <a href="{{ route('blog.index') }}" class="hover:text-blue-300 transition-colors">Blog</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            @if($post['category_name'] ?? false)
            <a href="{{ route('blog.index', ['category' => $post['category_id'] ?? '']) }}" class="hover:text-blue-300 transition-colors">{{ $post['category_name'] }}</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            @endif
            <span class="text-blue-100/60 font-medium">{{ Str::limit($post['title'], 40) }}</span>
        </nav>

        <!-- Header -->
        <header>
            @if($post['category_name'] ?? false)
            <span class="inline-flex items-center px-3 py-1 rounded-full bg-white/5 border border-white/10 text-xs font-semibold text-blue-200 mb-4">{{ $post['category_name'] }}</span>
            @endif
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white font-display leading-tight">{{ $post['title'] }}</h1>
            <div class="mt-6 flex flex-wrap items-center gap-4 text-sm">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-blue-400 to-cyan-300 flex items-center justify-center text-slate-900 text-xs font-bold">
                        {{ strtoupper(substr($post['author_name'] ?? 'S', 0, 1)) }}
                    </div>
                    <span class="font-medium text-blue-100/80">{{ $post['author_name'] ?? 'Sportika Team' }}</span>
                </div>
                <span class="text-blue-200/20">&middot;</span>
                <span class="text-blue-100/50">{{ \Carbon\Carbon::parse($post['published_at'] ?? $post['created_at'])->format('F d, Y') }}</span>
                <span class="text-blue-200/20">&middot;</span>
                <span class="text-blue-100/50 flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ ceil(str_word_count(strip_tags($post['content'] ?? '')) / 200) }} min read
                </span>
            </div>
        </header>
    </div>
    <div class="absolute bottom-0 left-0 right-0 h-24 bg-gradient-to-t from-white to-transparent"></div>
</section>

<!-- Featured Image -->
@if($post['featured_image'] ?? false)
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8">
    <div class="rounded-2xl overflow-hidden shadow-2xl shadow-gray-900/10 bg-gray-100">
        <img src="{{ $post['featured_image'] }}" alt="{{ $post['title'] }}" class="w-full max-h-[500px] object-cover">
    </div>
</div>
@endif

<!-- Article Content -->
<article class="py-12">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Content -->
        <div class="prose prose-lg max-w-none text-gray-600 leading-relaxed">
            {!! nl2br(e($post['content'] ?? '')) !!}
        </div>

        <!-- Tags -->
        @if(isset($post['tags']) && is_array($post['tags']))
        <div class="mt-10 flex flex-wrap gap-2">
            @foreach($post['tags'] as $tag)
            <span class="px-4 py-1.5 bg-gray-100 text-gray-600 text-sm rounded-xl font-medium">{{ $tag }}</span>
            @endforeach
        </div>
        @endif

        <!-- Share -->
        <div class="mt-10 pt-8 border-t border-gray-200">
            <div class="flex items-center justify-between">
                <h3 class="text-sm font-semibold text-gray-900">Share this article</h3>
                <div class="flex gap-2">
                    <a href="https://twitter.com/intent/tweet?text={{ urlencode($post['title']) }}&url={{ urlencode(request()->url()) }}" target="_blank" class="w-10 h-10 rounded-xl bg-gray-100 hover:bg-blue-50 flex items-center justify-center text-gray-500 hover:text-blue-500 transition-colors">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                    </a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" class="w-10 h-10 rounded-xl bg-gray-100 hover:bg-blue-50 flex items-center justify-center text-gray-500 hover:text-blue-600 transition-colors">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z"/></svg>
                    </a>
                    <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(request()->url()) }}&title={{ urlencode($post['title']) }}" target="_blank" class="w-10 h-10 rounded-xl bg-gray-100 hover:bg-blue-50 flex items-center justify-center text-gray-500 hover:text-blue-700 transition-colors">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</article>

<!-- Related Articles -->
@if(count($relatedPosts) > 0)
<section class="py-16 bg-gray-50/50 border-t border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-bold text-gray-900 font-display mb-8">Related Articles</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($relatedPosts as $related)
            <a href="{{ route('blog.show', $related['slug']) }}" class="group card-hover bg-white rounded-2xl border border-gray-100 overflow-hidden">
                <div class="aspect-video bg-gradient-to-br from-blue-50 to-cyan-50 flex items-center justify-center overflow-hidden">
                    @if($related['featured_image'] ?? false)
                        <img src="{{ $related['featured_image'] }}" alt="" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                        <svg class="w-12 h-12 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                    @endif
                </div>
                <div class="p-5">
                    <h3 class="font-bold text-gray-900 group-hover:text-blue-600 transition-colors line-clamp-2">{{ $related['title'] }}</h3>
                    <p class="mt-2 text-sm text-gray-500 line-clamp-2">{{ $related['excerpt'] ?? Str::limit(strip_tags($related['content'] ?? ''), 100) }}</p>
                    <div class="mt-3 text-xs text-gray-400">{{ \Carbon\Carbon::parse($related['published_at'] ?? $related['created_at'])->format('M d, Y') }}</div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- CTA with Dark Banner -->
<section class="py-24 relative overflow-hidden bg-gradient-to-br from-slate-900 via-blue-950 to-slate-900">
    <div class="absolute inset-0 opacity-[0.04]">
        <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <pattern id="blogShowCtaGrid" width="60" height="60" patternUnits="userSpaceOnUse">
                    <path d="M 60 0 L 0 0 0 60" fill="none" stroke="white" stroke-width="0.5"/>
                </pattern>
            </defs>
            <rect width="100%" height="100%" fill="url(#blogShowCtaGrid)"/>
        </svg>
    </div>
    <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-blue-500/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/3"></div>
    <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-cyan-500/8 rounded-full blur-3xl translate-y-1/2 -translate-x-1/3"></div>
    <div class="relative max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-2xl sm:text-3xl font-bold text-white font-display">Are you a player looking to showcase your talent?</h2>
        <p class="mt-4 text-lg text-blue-100/70">Join Sportika and create your professional sports portfolio today.</p>
        <a href="{{ route('join.index') }}" class="mt-8 inline-flex items-center px-8 py-4 rounded-xl text-sm font-semibold text-slate-900 bg-gradient-to-r from-blue-400 to-cyan-300 hover:from-blue-300 hover:to-cyan-200 shadow-xl shadow-blue-500/20 transition-all">
            Join Sportika
            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
        </a>
    </div>
</section>
@endsection
