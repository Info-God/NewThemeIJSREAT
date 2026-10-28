@extends('layouts.app')

@section('meta_title', "Articles tagged with #{$tagName} | IJSREAT")
@section('meta_description', "View all computer science articles and research blogs tagged with #{$tagName} on IJSREAT.")

@section('content')
    <x-archive-layout title="Articles Tagged: #{{ $tagName }}">
        <div class="space-y-8">
            {{-- Back to Tags Link --}}
            <div class="mb-4">
                <a href="/tag" class="inline-flex items-center gap-2 text-primary font-medium hover:underline transition duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-left"><path d="m12 19-7-7 7-7"/><path d="M19 12H5"/></svg>
                    Back to all tags
                </a>
            </div>

            @if($blogs->isEmpty())
                <div class="text-center py-12 text-gray-500 text-base xl:text-lg">
                    No articles found tagged with "#{{ $tagName }}".
                </div>
            @else
                {{-- Blog Grid --}}
                <div class="grid sm:grid-cols-2 lg:grid-cols-2 2xl:grid-cols-3 gap-8 justify-center sm:justify-between mb-12">
                    @foreach($blogs as $blog)
                        @php
                            $blogImg = '/blog.webp';
                            if ($blog->image && $blog->image !== 'https://IJSREAT.com/blogImage/' && $blog->image !== 'https://www.ijsreat.com/tagImage/') {
                                $blogImg = str_starts_with($blog->image, 'http://') || str_starts_with($blog->image, 'https://')
                                    ? $blog->image
                                    : 'https://panel.ijsreat.com/storage/' . trim($blog->image, '/');
                            }
                        @endphp
                        <div class="rounded-2xl overflow-hidden border border-gray-200 bg-white shadow-sm flex flex-col justify-between hover:shadow-md transition duration-300 max-w-[400px] mx-auto w-full">
                            <img loading="lazy" 
                                 src="{{ $blogImg }}" 
                                 alt="{{ $blog->title }}" 
                                 class="w-full h-56 object-cover border-b border-gray-100" />
                            
                            <div class="p-6 flex flex-col justify-between flex-grow">
                                <div>
                                    <h3 class="text-xl xl:text-2xl font-serif font-semibold text-dark mb-4 leading-snug hover:text-primary transition duration-300">
                                        <a href="/blogs/{{ $blog->url_title }}">
                                            {{ $blog->title }}
                                        </a>
                                    </h3>
                                    <p class="text-gray-500 line-clamp-3 text-sm xl:text-base leading-relaxed mb-4">
                                        {{ $blog->meta_description }}
                                    </p>
                                </div>

                                <div class="flex items-end justify-between pt-4 border-t border-gray-50">
                                    <div class="space-y-1.5 text-xs xl:text-sm text-gray-500">
                                        <p><span class="font-semibold text-gray-700">Category By:</span> {{ $blog->category }}</p>
                                        <p><span class="font-semibold text-gray-700">Date:</span> {{ date('Y-m-d', strtotime($blog->created_at)) }}</p>
                                    </div>
                                    <a href="/blogs/{{ $blog->url_title }}" class="inline-block text-white font-medium rounded-full bg-gradient-to-b from-primary to-primary-hover hover:from-primary-hover hover:to-primary transition p-2.5 shadow-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 -rotate-45" fill="none"
                                             viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </x-archive-layout>
@endsection
