@extends('layouts.app')

@php
    // Panel content may be a whole HTML page or a few tags; this keeps only the article.
    $article = \App\Support\ArticleHtml::render($blog->description, $blog->title);
@endphp

@section('meta_title', $blog->meta_title ?? ($blog->title . ' | IJSREAT Blog'))
@section('meta_description', $blog->meta_description ?? (\Illuminate\Support\Str::limit(strip_tags($blog->description), 150)))

@include('archives.partials.theme')

@php
    $imageFor = function ($item, $fallback) {
        if ($item->image && $item->image !== 'https://IJSREAT.com/blogImage/' && $item->image !== 'https://www.ijsreat.com/tagImage/') {
            return str_starts_with($item->image, 'http://') || str_starts_with($item->image, 'https://')
                ? $item->image
                : 'https://panel.ijsreat.com/storage/' . trim($item->image, '/');
        }
        return $fallback;
    };
    $blogImg = $imageFor($blog, null);
    $readMinutes = max(1, (int) ceil(str_word_count($article['text']) / 200));
    $showToc = count($article['toc']) >= 3;
    $shareUrl = url('/blogs/' . $blog->url_title);
@endphp

@section('content')
<div class="hp" x-data="{ copied: false }">
    <x-archive.pageband :title="$blog->title" :crumbs="['Blog' => '/blogs', 'Article' => null]">
        @if ($blog->category)<span class="pbf"><x-homepage.icon name="tag" /><span>Category</span><b>{{ $blog->category }}</b></span>@endif
        <span class="pbf pbf--cyan"><x-homepage.icon name="calendar" /><span>Published</span><b>{{ date('d M Y', strtotime($blog->created_at)) }}</b></span>
        <span class="pbf pbf--orange"><x-homepage.icon name="clock" /><span>Reading time</span><b>{{ $readMinutes }} min</b></span>
    </x-archive.pageband>

    <div class="apage">
        <article class="post">
            @if ($blogImg)
                <img class="post__img" src="{{ $blogImg }}" alt="{{ $blog->title }}" onerror="this.remove()">
            @endif
            @if ($showToc)
                <details class="post__toc">
                    <summary>On this page</summary>
                    @include('pages.blog.partials.toc', ['toc' => $article['toc']])
                </details>
            @endif
            <div class="post__body">
                {!! $article['html'] !!}
            </div>
            <div class="post__share">
                <b>Share</b>
                <a class="qlink" href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode($shareUrl) }}" target="_blank" rel="noopener">LinkedIn</a>
                <a class="qlink" href="https://twitter.com/intent/tweet?url={{ urlencode($shareUrl) }}&text={{ urlencode($blog->title) }}" target="_blank" rel="noopener">X</a>
                <a class="qlink" href="https://api.whatsapp.com/send?text={{ urlencode($blog->title . ' ' . $shareUrl) }}" target="_blank" rel="noopener">WhatsApp</a>
                <button type="button" class="qlink" @click="navigator.clipboard.writeText(@js($shareUrl)).then(() => { copied = true; setTimeout(() => copied = false, 2000) })"><x-homepage.icon name="link" /> <span x-text="copied ? 'Link copied' : 'Copy link'">Copy link</span></button>
            </div>
            <a class="qlink" href="/blogs" style="margin-top:18px"><x-homepage.icon name="edit" /> Back to all articles</a>
        </article>

        <aside class="aside" aria-label="More articles">
            @if ($showToc)
                <nav class="sb sb--toc" aria-label="On this page">
                    <h2 class="sb__head"><span class="tic"><x-homepage.icon name="blocks" /></span>On this page</h2>
                    @include('pages.blog.partials.toc', ['toc' => $article['toc']])
                </nav>
            @endif
            @if ($recentBlogs->isNotEmpty())
                <div class="sb">
                    <h2 class="sb__head"><span class="tic"><x-homepage.icon name="edit" /></span>Recent Articles</h2>
                    <ul class="recent">
                        @foreach ($recentBlogs as $recent)
                            <li>
                                <a href="/blogs/{{ $recent->url_title }}">
                                    <img src="{{ $imageFor($recent, '/blog.webp') }}" alt="" loading="lazy" onerror="this.onerror=null;this.src='/blog.webp'">
                                    <span><b>{{ $recent->title }}</b><small>{{ date('d M Y', strtotime($recent->created_at)) }}</small></span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="sb sb--accent">
                <h2 class="sb__head"><span class="tic"><x-homepage.icon name="send" /></span>Ready to Submit?</h2>
                <p class="sb__text">Submit your Article through our editorial management system.</p>
                <a class="sb__btn" href="https://editorial.fdrpjournals.org/login?journal=2" target="_blank" rel="noopener noreferrer"><x-homepage.icon name="upload" /> Submit Article</a>
            </div>
            <div class="sb">
                <h2 class="sb__head"><span class="tic"><x-homepage.icon name="blocks" /></span>Explore</h2>
                <ul class="sb-links">
                    <li><a href="/blogs">All blog articles</a></li>
                    <li><a href="/current-issue">Current Issue</a></li>
                    <li><a href="/archives">Archives</a></li>
                    <li><a href="/call-for-papers">Call for papers</a></li>
                    <li><a href="/editorial-board">Editorial Board</a></li>
                </ul>
            </div>
        </aside>
    </div>
</div>
@endsection
