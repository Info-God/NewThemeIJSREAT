@extends('layouts.app')

@php
    $searchQuery = trim((string) request('search'));
    $pageTitle = $searchQuery
        ? "Search results for \"{$searchQuery}\" | Tags | IJSREAT"
        : 'Tags | IJSREAT';
    $pageDescription = $searchQuery
        ? "Browse tag results related to {$searchQuery} and discover research themes across IJSREAT."
        : 'Browse curated IJSREAT tags and discover topics, publishing categories, and research themes across the journal.';

    // Same image rules as before; tags without a usable image get a letter tile.
    $tagImage = function ($tag) {
        if ($tag->image && $tag->image !== 'https://IJSREAT.com/tagImage/' && $tag->image !== 'https://www.ijsreat.com/tagImage/') {
            return str_starts_with($tag->image, 'http://') || str_starts_with($tag->image, 'https://')
                ? $tag->image
                : 'https://panel.ijsreat.com/storage/' . trim($tag->image, '/');
        }
        return null;
    };
@endphp

@section('meta_title', $pageTitle)
@section('meta_description', $pageDescription)

@include('archives.partials.theme')

@section('content')
<div class="hp">
    <x-archive.pageband title="Tags" :crumbs="['Blog' => '/blogs', 'Tags' => null]"
        lead="Topics, publishing categories and research themes across IJSREAT.">
        <span class="pbf pbf--cyan"><x-homepage.icon name="tag" /><span>{{ $searchQuery ? 'Matching tags' : 'Tags' }}</span><b>{{ $tags->total() }}</b></span>
    </x-archive.pageband>

    <div class="apage">
        <div class="amain">
            <div class="blog-tools">
                <form class="blog-search" action="/tag" method="GET" role="search">
                    <label for="tag-q" style="position:absolute;left:-9999px">Search tags</label>
                    <input id="tag-q" type="text" name="search" placeholder="Search tags..." value="{{ request()->query('search') }}">
                    <button type="submit"><x-homepage.icon name="search" /> Search</button>
                    @if ($searchQuery)<a href="/tag">Clear</a>@endif
                </form>
                @if ($tags->total() > 0)
                    <span class="muted">Showing {{ $tags->firstItem() }}–{{ $tags->lastItem() }} of {{ $tags->total() }}</span>
                @endif
            </div>

            @if ($tags->isEmpty())
                <div class="pempty">
                    <x-homepage.icon name="search" />
                    <h2>No tags found matching your search.</h2>
                    <p><a href="/tag" style="color:var(--brand);font-weight:700">View all tags</a></p>
                </div>
            @else
                <div class="bposts">
                    @foreach ($tags as $tag)
                        @php $img = $tagImage($tag); @endphp
                        <article class="bpost">
                            <a class="bpost__img" href="/tag/{{ $tag->url_title }}" tabindex="-1" aria-hidden="true">
                                @if ($img)
                                    <img src="{{ $img }}" alt="" loading="lazy" onerror="this.onerror=null;this.src='/blog.webp'">
                                @else
                                    <span class="tag-letter">{{ strtoupper(substr(preg_replace('/[^A-Za-z0-9]/', '', $tag->title), 0, 1) ?: 'T') }}</span>
                                @endif
                            </a>
                            <div class="bpost__b">
                                <div class="bmeta">
                                    <span class="bcat">{{ $tag->category ?? 'General' }}</span>
                                    <span><x-homepage.icon name="calendar" /> {{ date('d M Y', strtotime($tag->created_at)) }}</span>
                                </div>
                                <h3><a href="/tag/{{ $tag->url_title }}">{{ $tag->title }}</a></h3>
                                <p>{{ $tag->meta_description ?? \Illuminate\Support\Str::limit(\App\Support\ArticleHtml::text($tag->description), 140) }}</p>
                                <a class="bpost__go" href="/tag/{{ $tag->url_title }}">Read more <x-homepage.icon name="arrow" /></a>
                            </div>
                        </article>
                    @endforeach
                </div>

                {{ $tags->links('vendor.pagination.react-custom') }}
            @endif
        </div>

        <x-archive.sidebar />
    </div>
</div>
@endsection
