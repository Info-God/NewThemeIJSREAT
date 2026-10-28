@extends('layouts.app')

@section('meta_title', $topic->meta_title ?? ($topic->title . ' | IJSREAT'))
@section('meta_description', $topic->meta_description ?? ('Detailed research topics and information on ' . $topic->title . ' in the International Journal of Scientific Research in Engineering & Technology (IJSREAT).'))

@include('archives.partials.theme')

@php
    // Some topics store a full HTML document with its own <style> block; show
    // only the cleaned article so those styles cannot leak into the rest of the page.
    $content = \App\Support\ArticleHtml::render($topic->content, $topic->title)['html'];

    $related = DB::table('topics')
        ->whereNull('deleted_at')
        ->where('category', $topic->category)
        ->where('id', '!=', $topic->id)
        ->orderBy('title')
        ->get(['title']);
@endphp

@section('content')
<div class="hp">
    <x-archive.pageband :title="$topic->title" :crumbs="['Topics' => '/topics', $topic->title => null]">
        @if ($topic->category)<span class="pbf"><x-homepage.icon name="layers" /><span>Subject area</span><b>{{ $topic->category }}</b></span>@endif
    </x-archive.pageband>

    <div class="apage">
        <article class="post">
            <div class="post__body">{!! $content !!}</div>
            <div class="qlinks" style="margin-top:24px">
                <a class="qlink" href="/topics"><x-homepage.icon name="list" /> All topics</a>
                <a class="qlink" href="/aim-and-scope"><x-homepage.icon name="globe" /> Aim &amp; Scope</a>
                <a class="qlink" href="https://editorial.fdrpjournals.org/login?journal=2" target="_blank" rel="noopener noreferrer"><x-homepage.icon name="upload" /> Submit Article</a>
            </div>
        </article>

        <aside class="aside" aria-label="Related topics">
            @if ($related->isNotEmpty())
                <div class="sb">
                    <h2 class="sb__head"><span class="tic"><x-homepage.icon name="layers" /></span>More in {{ $topic->category }}</h2>
                    <ul class="sb-links">
                        @foreach ($related as $r)
                            <li><a href="/topics/{{ \Illuminate\Support\Str::slug($r->title, '-') }}">{{ $r->title }}</a></li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="sb sb--accent">
                <h2 class="sb__head"><span class="tic"><x-homepage.icon name="send" /></span>Ready to Submit?</h2>
                <p class="sb__text">Submit your Article through our editorial management system.</p>
                <a class="sb__btn" href="https://editorial.fdrpjournals.org/login?journal=2" target="_blank" rel="noopener noreferrer"><x-homepage.icon name="upload" /> Submit Article</a>
            </div>
        </aside>
    </div>
</div>
@endsection
