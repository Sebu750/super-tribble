@extends('layouts.admin')
@section('title', 'Blog Posts')
@section('header', 'Blog Posts')
@section('content')
<div class="space-y-6">

    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-xl font-bold text-gray-900">All Blog Posts</h2>
            <p class="text-sm text-gray-500 mt-1">Create, edit, and manage blog articles</p>
        </div>
        <a href="{{ route('admin.blog.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-gradient-to-r from-blue-600 to-blue-700 text-white text-sm font-semibold rounded-xl shadow-lg shadow-blue-600/20 hover:from-blue-700 hover:to-blue-800 transition-all">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            New Post
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="min-w-full divide-y divide-gray-100">
            <thead class="bg-gray-50/80">
                <tr>
                    <th class="px-6 py-3.5 text-left text-[11px] font-semibold text-gray-500 uppercase tracking-wider">Title</th>
                    <th class="px-6 py-3.5 text-left text-[11px] font-semibold text-gray-500 uppercase tracking-wider">Category</th>
                    <th class="px-6 py-3.5 text-left text-[11px] font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3.5 text-left text-[11px] font-semibold text-gray-500 uppercase tracking-wider">Date</th>
                    <th class="px-6 py-3.5 text-right text-[11px] font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-50">
                @forelse($posts as $post)
                <tr class="hover:bg-blue-50/30 transition-colors">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-2">
                            <p class="text-sm font-medium text-gray-900 line-clamp-1">{{ $post['title'] }}</p>
                            @if($post['is_featured'] ?? false)
                            <svg class="w-3.5 h-3.5 text-amber-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $post['category_name'] ?? 'Uncategorized' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @php $status = $post['status'] ?? 'draft'; @endphp
                        <div class="flex items-center gap-2">
                            <span class="status-dot {{ $status == 'published' ? 'bg-emerald-400' : 'bg-gray-300' }}"></span>
                            <span class="text-xs font-medium {{ $status == 'published' ? 'text-emerald-600' : 'text-gray-500' }}">{{ ucfirst($status) }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ isset($post['published_at']) ? \Carbon\Carbon::parse($post['published_at'])->format('M d, Y') : (isset($post['created_at']) ? \Carbon\Carbon::parse($post['created_at'])->format('M d, Y') : '') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-1">
                        @if(($post['slug'] ?? false) && ($post['status'] ?? '') == 'published')
                        <a href="{{ route('blog.show', $post['slug']) }}" class="inline-flex items-center px-2.5 py-1 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-lg transition-colors">View</a>
                        @endif
                        <a href="{{ route('admin.blog.edit', $post['id']) }}" class="inline-flex items-center px-2.5 py-1 text-blue-600 hover:text-blue-700 hover:bg-blue-50 rounded-lg transition-colors">Edit</a>
                        <form method="POST" action="{{ route('admin.blog.destroy', $post['id']) }}" class="inline" onsubmit="return confirm('Delete this post?')">@csrf @method('DELETE')
                            <button type="submit" class="inline-flex items-center px-2.5 py-1 text-red-600 hover:text-red-700 hover:bg-red-50 rounded-lg transition-colors">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="px-6 py-16 text-center">
                    <svg class="mx-auto w-10 h-10 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                    <p class="mt-3 text-sm text-gray-400">No blog posts yet.</p>
                </td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
