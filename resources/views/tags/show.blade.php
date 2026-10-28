@extends('layouts.app')

@php
    // Panel content may be a whole HTML page or a few tags; this keeps only the article.
    $article = \App\Support\ArticleHtml::render($tag->description, $tag->title);
@endphp

@section('meta_title', $tag->meta_title ?? $tag->title . ' | IJSREAT')
@section('meta_description', $tag->meta_description ?? \Illuminate\Support\Str::limit(strip_tags((string) ($tag->description ?? '')), 150))

@include('archives.partials.theme')

@php
    $imageFor = function ($item) {
        if ($item->image && $item->image !== 'https://IJSREAT.com/blogImage/' && $item->image !== 'https://www.ijsreat.com/tagImage/') {
            return str_starts_with($item->image, 'http://') || str_starts_with($item->image, 'https://')
                ? $item->image
                : 'https://panel.ijsreat.com/storage/' . trim($item->image, '/');
        }
        return null;
    };
    $tagImg = $imageFor($tag);
    $searchQuery = trim((string) request('search'));
@endphp

@section('content')
<div class="hp">
    <x-archive.pageband :title="$tag->title" :crumbs="['Blog' => '/blogs', 'Tags' => '/tag', 'Article' => null]">
        @if ($tag->category)<span class="pbf"><x-homepage.icon name="tag" /><span>Category</span><b>{{ $tag->category }}</b></span>@endif
        <span class="pbf pbf--cyan"><x-homepage.icon name="calendar" /><span>Published</span><b>{{ date('d M Y', strtotime($tag->created_at)) }}</b></span>
    </x-archive.pageband>

    <div class="apage">
        <article class="post">
            @if ($tagImg)
                <img class="post__img" src="{{ $tagImg }}" alt="{{ $tag->title }}" onerror="this.remove()">
            @endif
            @if ($article['html'] !== '')
                <div class="post__body">
                    {!! $article['html'] !!}
                </div>
            @endif

            <section class="tag-blogs" aria-labelledby="tag-blogs-h">
                <div class="block-title"><h2 class="rule-title" id="tag-blogs-h">Blog articles with this tag</h2></div>
                <form class="blog-search" action="/tag/{{ $tag->url_title }}" method="GET" role="search">
                    <label for="tb-q" style="position:absolute;left:-9999px">Search blogs in this tag</label>
                    <input id="tb-q" type="text" name="search" placeholder="Search blogs in this tag..." value="{{ request()->query('search') }}">
                    <button type="submit"><x-homepage.icon name="search" /> Search</button>
                    @if ($searchQuery)<a href="/tag/{{ $tag->url_title }}">Clear</a>@endif
                </form>

                @if ($blogs->isEmpty())
                    <p class="pempty" style="padding:22px">No blogs found matching your search.</p>
                @else
                    <div class="bposts">
                        @foreach ($blogs as $blog)
                            <article class="bpost">
                                <a class="bpost__img" href="/blogs/{{ $blog->url_title }}" tabindex="-1" aria-hidden="true">
                                    <img src="{{ $imageFor($blog) ?? '/blog.webp' }}" alt="" loading="lazy" onerror="this.onerror=null;this.src='/blog.webp'">
                                </a>
                                <div class="bpost__b">
                                    <div class="bmeta">
                                        @if ($blog->category)<span class="bcat">{{ $blog->category }}</span>@endif
                                        <span><x-homepage.icon name="calendar" /> {{ date('d M Y', strtotime($blog->created_at)) }}</span>
                                    </div>
                                    <h3><a href="/blogs/{{ $blog->url_title }}">{{ $blog->title }}</a></h3>
                                    @if ($blog->meta_description)<p>{{ $blog->meta_description }}</p>@endif
                                    <a class="bpost__go" href="/blogs/{{ $blog->url_title }}">Read article <x-homepage.icon name="arrow" /></a>
                                </div>
                            </article>
                        @endforeach
                    </div>
                    {{ $blogs->links('vendor.pagination.react-custom') }}
                @endif
            </section>

            <a class="qlink" href="/tag" style="margin-top:18px"><x-homepage.icon name="tag" /> Back to all tags</a>
        </article>

        <aside class="aside" aria-label="More">
            <div class="sb sb--accent">
                <h2 class="sb__head"><span class="tic"><x-homepage.icon name="send" /></span>Ready to Submit?</h2>
                <p class="sb__text">Submit your Article through our editorial management system.</p>
                <a class="sb__btn" href="https://editorial.fdrpjournals.org/login?journal=2" target="_blank" rel="noopener noreferrer"><x-homepage.icon name="upload" /> Submit Article</a>
            </div>
            <div class="sb">
                <h2 class="sb__head"><span class="tic"><x-homepage.icon name="blocks" /></span>Explore</h2>
                <ul class="sb-links">
                    <li><a href="/tag">All tags</a></li>
                    <li><a href="/blogs">All blog articles</a></li>
                    <li><a href="/current-issue">Current Issue</a></li>
                    <li><a href="/archives">Archives</a></li>
                    <li><a href="/call-for-papers">Call for papers</a></li>
                </ul>
            </div>
        </aside>
    </div>
</div>
@endsection
