@extends('layouts.app')

@section('meta_title', $title)
@section('meta_description', $metaDescription)

@include('archives.partials.theme')

@php
    // Article count and publication months per issue, for the issue tiles.
    // The months shown are the ones most papers in the issue carry.
    $issueStats = \App\Models\Archive::query()
        ->selectRaw('year, volume, issue, paper_month, COUNT(*) as papers')
        ->groupBy(['year', 'volume', 'issue', 'paper_month'])
        ->get()
        ->groupBy(fn ($row) => "{$row->year}-{$row->volume}-{$row->issue}")
        ->map(fn ($rows) => (object) [
            'papers' => $rows->sum('papers'),
            'months' => $rows->sortByDesc('papers')->first()->paper_month,
        ]);

    $latestYear = $archives->keys()->first();
    $totalIssues = $archives->flatten(1)->count();
    $partners = DB::table('indexings')->get();
@endphp

@section('content')
<div class="hp">
    <x-archive.pageband title="Archives" :crumbs="['Archives' => null]"
        lead="Every published issue of the International Journal of Scientific Research in Engineering & Technology, by year. Choose a year or open an issue to read its papers.">
        <span class="pbf pbf--cyan"><x-homepage.icon name="calendar" /><span>Years</span><b>{{ $archives->count() }}</b></span>
        <span class="pbf pbf--orange"><x-homepage.icon name="journal" /><span>Issues</span><b>{{ $totalIssues }}</b></span>
        <span class="pbf"><x-homepage.icon name="doc" /><span>e-ISSN</span><b>2583-1240</b></span>
        <span class="pbf pbf--leaf"><x-homepage.icon name="lock" /><span>Access</span><b>Open Access</b></span>
    </x-archive.pageband>

    <div class="apage">
        <div class="amain">
            <section aria-labelledby="hp-years">
                <div class="block-title">
                    <h2 class="rule-title" id="hp-years">Browse by Year</h2>
                    <a class="hlink" href="/current-issue">Current issue <x-homepage.icon name="arrow" /></a>
                </div>
                <nav class="yjump" aria-label="Jump to year">
                    @foreach ($archives as $year => $items)
                        <a href="#year-{{ $year }}" @class(['is-latest' => $year == $latestYear])>{{ $year }}</a>
                    @endforeach
                </nav>
            </section>

            <div class="years">
                @foreach ($archives as $year => $items)
                    <article class="ycard" id="year-{{ $year }}">
                        <a class="ycard__year" href="{{ route('archives.year', ['year' => $year]) }}">
                            <small>Year</small>
                            <b>{{ $year }}</b>
                            <span>View year <x-homepage.icon name="arrow" /></span>
                        </a>
                        <div class="ycard__body">
                            @foreach ($items->groupBy('volume') as $volume => $issues)
                                <p class="ycard__vol">
                                    <span>Volume {{ $volume }}</span>
                                    @if ($year == $latestYear && $loop->last)
                                        <span class="ycard__badge">Latest</span>
                                    @endif
                                </p>
                                <div class="issue-tiles">
                                    @foreach ($issues as $item)
                                        @php $stat = $issueStats->get("{$year}-{$volume}-{$item->issue}"); @endphp
                                        <a class="itile" href="{{ route('archives.issue', ['year' => $year, 'volume' => $volume, 'issue' => $item->issue]) }}">
                                            <span class="itile__n">{{ $item->issue }}</span>
                                            <span class="itile__b">
                                                <strong>Volume {{ $volume }} Issue {{ $item->issue }}</strong>
                                                @if ($stat)
                                                    <small>{{ $stat->months ? $stat->months . ' · ' : '' }}{{ $stat->papers }} {{ \Illuminate\Support\Str::plural('article', $stat->papers) }}</small>
                                                @endif
                                            </span>
                                        </a>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </article>
                @endforeach
            </div>

            @if ($partners->isNotEmpty())
                <section aria-labelledby="hp-indexing">
                    <div class="block-title">
                        <h2 class="rule-title" id="hp-indexing">Indexing &amp; Abstracting</h2>
                        <a class="hlink" href="/indexing-and-abstracting">View details <x-homepage.icon name="arrow" /></a>
                    </div>
                    <x-homepage.logo-marquee :partners="$partners" />
                </section>
            @endif
        </div>

        <x-archive.sidebar />
    </div>
</div>
@endsection
