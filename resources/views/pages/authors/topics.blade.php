@extends('layouts.app')

@section('meta_title', 'IJSREAT | Research Topics – International Journal of Scientific Research in Engineering & Technology')
@section('meta_description', 'IJSREAT publishes research across diverse topics in science, engineering, technology, management, medicine, pharmacy, social sciences, arts, and emerging interdisciplinary fields')

@include('archives.partials.theme')

@php
    $groupedTopics = $topics->groupBy('category');
    $slug = fn ($t) => \Illuminate\Support\Str::slug($t, '-');
@endphp

@section('content')
<div class="hp" x-data="{ q: '', match(t) { return !this.q || t.includes(this.q.toLowerCase()) } }">
    <x-archive.pageband title="Topics" :crumbs="['Aim & Scope' => '/aim-and-scope', 'Topics' => null]"
        lead="Research topics IJSREAT invites submissions on, grouped by subject area. Open a topic for details.">
        <span class="pbf pbf--cyan"><x-homepage.icon name="list" /><span>Topics</span><b>{{ $topics->count() }}</b></span>
        <span class="pbf pbf--orange"><x-homepage.icon name="layers" /><span>Subject areas</span><b>{{ $groupedTopics->count() }}</b></span>
    </x-archive.pageband>

    <div class="apage">
        <div class="amain">
            @if ($topics->isEmpty())
                <div class="pempty"><x-homepage.icon name="list" /><h2>Topics will be listed here soon.</h2><p><a href="/aim-and-scope" style="color:var(--brand);font-weight:700">See the aim and scope</a></p></div>
            @else
                <div class="filter">
                    <label class="filter__box">
                        <x-homepage.icon name="search" />
                        <input type="search" x-model="q" placeholder="Search topics" aria-label="Search topics">
                    </label>
                    <span class="muted" x-show="!q">{{ $topics->count() }} topics in {{ $groupedTopics->count() }} subject areas</span>
                </div>

                <nav class="toc" aria-label="Subject areas" x-show="!q" style="margin-top:0">
                    @foreach ($groupedTopics as $category => $items)
                        <a href="#area-{{ $slug($category) }}">{{ $category }}</a>
                    @endforeach
                </nav>

                <div class="tgroups">
                    @foreach ($groupedTopics as $category => $items)
                        @php $titles = $items->map(fn ($t) => strtolower($t->title . ' ' . $category))->values(); @endphp
                        <section class="tgroup" id="area-{{ $slug($category) }}" x-show="@js($titles).some(t => match(t))">
                            <h3>{{ $category }} <small>{{ $items->count() }}</small></h3>
                            <ul class="tlist">
                                @foreach ($items as $topicItem)
                                    <li x-show="match(@js(strtolower($topicItem->title . ' ' . $category)))">
                                        <a href="/topics/{{ $slug($topicItem->title) }}">{{ $topicItem->title }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </section>
                    @endforeach
                </div>
                <p class="empty" x-show="q && !@js($topics->map(fn ($t) => strtolower($t->title . ' ' . $t->category))->values()).some(t => match(t))" x-cloak>No topic matches “<span x-text="q"></span>”. See the full <a href="/aim-and-scope" style="color:var(--brand);font-weight:700">aim and scope</a>.</p>
            @endif
        </div>

        <x-archive.sidebar />
    </div>
</div>
@endsection
