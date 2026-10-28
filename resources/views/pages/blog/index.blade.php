@extends('layouts.app')

@php
    $searchQuery = trim((string) request('search'));
    $pageTitle = $searchQuery
        ? "Search results for \"{$searchQuery}\" | Research Blogs | IJSREAT"
        : 'Research Blogs | IJSREAT – Insights on Science & Engineering';
    $pageDescription = $searchQuery
        ? "Explore the latest IJSREAT blog posts and research insights matching \"{$searchQuery}\"."
        : 'Read blogs from IJSREAT on research trends, publishing tips, engineering breakthroughs, and academic writing to stay updated and improve your research impact.';

    // Same image rules as before; blogs without a usable image get /blog.webp.
    $blogImage = function ($blog) {
        if ($blog->image && $blog->image !== 'https://IJSREAT.com/blogImage/' && $blog->image !== 'https://www.ijsreat.com/tagImage/') {
            return str_starts_with($blog->image, 'http://') || str_starts_with($blog->image, 'https://')
                ? $blog->image
                : 'https://panel.ijsreat.com/storage/' . trim($blog->image, '/');
        }
        return '/blog.webp';
    };
    $readMinutes = fn ($blog) => max(1, (int) ceil(str_word_count(\App\Support\ArticleHtml::text($blog->description)) / 200));
    $showFeature = !$searchQuery && $blogs->onFirstPage() && $blogs->count() > 2;
@endphp

@section('meta_title', $pageTitle)
@section('meta_description', $pageDescription)

@include('archives.partials.theme')

@section('content')
<div class="hp">
    <x-archive.pageband title="Research & Publishing Blog" :crumbs="['Blog' => null]"
        lead="Articles from IJSREAT on research publishing and academic writing.">
        <span class="pbf pbf--cyan"><x-homepage.icon name="edit" /><span>{{ $searchQuery ? 'Matching articles' : 'Articles' }}</span><b>{{ $blogs->total() }}</b></span>
    </x-archive.pageband>

    <div class="apage">
        <div class="amain">
            <div class="blog-tools">
                <form class="blog-search" action="/blogs" method="GET" role="search">
                    <label for="blog-q" class="sr-only" style="position:absolute;left:-9999px">Search blogs</label>
                    <input id="blog-q" type="text" name="search" placeholder="Search blogs..." value="{{ request()->query('search') }}">
                    <button type="submit"><x-homepage.icon name="search" /> Search</button>
                    @if ($searchQuery)<a href="/blogs">Clear</a>@endif
                </form>
                @if ($blogs->total() > 0)
                    <span class="muted">Showing {{ $blogs->firstItem() }}–{{ $blogs->lastItem() }} of {{ $blogs->total() }}</span>
                @endif
            </div>

            @if ($blogs->isEmpty())
                <div class="pempty">
                    <x-homepage.icon name="search" />
                    <h2>No blogs found matching your search.</h2>
                    <p><a href="/blogs" style="color:var(--brand);font-weight:700">View all articles</a></p>
                </div>
            @else
                <div class="bposts">
                    @foreach ($blogs as $blog)
                        @php $feature = $showFeature && $loop->first; @endphp
                        <article @class(['bpost', 'bpost--feature' => $feature])>
                            <a class="bpost__img" href="/blogs/{{ $blog->url_title }}" tabindex="-1" aria-hidden="true">
                                <img src="{{ $blogImage($blog) }}" alt="" loading="{{ $feature ? 'eager' : 'lazy' }}" onerror="this.onerror=null;this.src='/blog.webp'">
                            </a>
                            <div class="bpost__b">
                                <div class="bmeta">
                                    @if ($blog->category)<span class="bcat">{{ $blog->category }}</span>@endif
                                    <span><x-homepage.icon name="calendar" /> {{ date('d M Y', strtotime($blog->created_at)) }}</span>
                                    <span><x-homepage.icon name="clock" /> {{ $readMinutes($blog) }} min read</span>
                                </div>
                                @if ($feature)
                                    <h2><a href="/blogs/{{ $blog->url_title }}">{{ $blog->title }}</a></h2>
                                @else
                                    <h3><a href="/blogs/{{ $blog->url_title }}">{{ $blog->title }}</a></h3>
                                @endif
                                @if ($blog->meta_description)<p>{{ $blog->meta_description }}</p>@endif
                                <a class="bpost__go" href="/blogs/{{ $blog->url_title }}">Read article <x-homepage.icon name="arrow" /></a>
                            </div>
                        </article>
                    @endforeach
                </div>

                {{ $blogs->links('vendor.pagination.react-custom') }}
            @endif
        </div>

        <x-archive.sidebar />
    </div>
</div>
@endsection
