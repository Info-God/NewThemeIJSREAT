@extends('layouts.app')

@section('meta_title', 'Blog Tags | IJSREAT')
@section('meta_description', 'Explore research and computer science articles by tags and topics at the International Journal of Scientific Research in Engineering & Technology (IJSREAT).')

@section('content')
    <x-archive-layout title="Tags">
        <div class="space-y-6 xl:text-base 2xl:text-lg text-gray-700">
            <p class="text-gray-500 mb-8 leading-relaxed">
                Browse our collection of academic blogs and articles categorized by tags. Click on any tag below to see all articles related to that topic.
            </p>

            @if(empty($allTags))
                <div class="text-center py-12 text-gray-400">
                    No tags available at this time.
                </div>
            @else
                <div class="flex flex-wrap gap-4 pt-2">
                    @foreach($allTags as $tagName => $count)
                        @php
                            $tagSlug = \Illuminate\Support\Str::slug($tagName, '-');
                        @endphp
                        <a href="/tag/{{ $tagSlug }}" class="flex items-center gap-2 bg-gray-50 hover:bg-primary/5 border border-gray-100 hover:border-primary/20 px-4 py-2 rounded-xl transition duration-300 group shadow-sm">
                            <span class="font-medium text-dark group-hover:text-primary transition duration-300">
                                #{{ $tagName }}
                            </span>
                            <span class="text-xs font-semibold bg-gray-200/60 group-hover:bg-primary group-hover:text-white px-2 py-0.5 rounded-full text-gray-600 transition duration-300">
                                {{ $count }}
                            </span>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </x-archive-layout>
@endsection
