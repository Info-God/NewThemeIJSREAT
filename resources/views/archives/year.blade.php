@extends('layouts.app')

@section('meta_title', "{$year} Archives | IJSREAT")
@section('meta_description', $metaDescription)

@section('head')
    <link rel="canonical" href="{{ rtrim(config('app.url'), '/') . '/' . ltrim(request()->path(), '/') }}">
@endsection

@include('archives.partials.theme')

@php
    $years = $allVolumes->pluck('year')->unique()->values();
    $yearIndex = $years->search(fn ($y) => $y == $year);
    $newerYear = $yearIndex !== false && $yearIndex > 0 ? $years[$yearIndex - 1] : null;
    $olderYear = $yearIndex !== false && $yearIndex < $years->count() - 1 ? $years[$yearIndex + 1] : null;

    // Article count and the months most papers in each issue carry.
    $issueStats = \App\Models\Archive::query()
        ->selectRaw('volume, issue, paper_month, COUNT(*) as papers')
        ->where('year', $year)
        ->groupBy(['volume', 'issue', 'paper_month'])
        ->get()
        ->groupBy(fn ($row) => "{$row->volume}-{$row->issue}")
        ->map(fn ($rows) => (object) [
            'papers' => $rows->sum('papers'),
            'months' => $rows->sortByDesc('papers')->first()->paper_month,
        ]);
    $yearPapers = $issueStats->sum('papers');
    $volumes = $issues->groupBy('volume');
@endphp

@section('content')
<div class="hp">
    <x-archive.pageband :title="'Archives for ' . $year" :crumbs="['Archives' => '/archives', (string) $year => null]">
        <span class="pbf pbf--cyan"><x-homepage.icon name="layers" /><span>{{ \Illuminate\Support\Str::plural('Volume', $volumes->count()) }}</span><b>{{ $volumes->keys()->implode(', ') }}</b></span>
        <span class="pbf pbf--orange"><x-homepage.icon name="journal" /><span>Issues</span><b>{{ $issues->count() }}</b></span>
        <span class="pbf"><x-homepage.icon name="file" /><span>Articles</span><b>{{ $yearPapers }}</b></span>
    </x-archive.pageband>

    <div class="apage">
        <div class="amain">
            <nav class="yswitch" aria-label="Archive years">
                <a class="yswitch__nav yswitch__nav--prev" href="{{ $newerYear ? route('archives.year', ['year' => $newerYear]) : '#' }}" @if (!$newerYear) aria-disabled="true" tabindex="-1" @endif aria-label="Newer year"><x-homepage.icon name="chevron" /></a>
                <div class="yswitch__list">
                    @foreach ($allVolumes as $vol)
                        <a href="{{ route('archives.year', ['year' => $vol->year]) }}" @if ($vol->year == $year) aria-current="page" @endif>
                            {{ $vol->year }}<small>Volume {{ $vol->volume }}</small>
                        </a>
                    @endforeach
                </div>
                <a class="yswitch__nav" href="{{ $olderYear ? route('archives.year', ['year' => $olderYear]) : '#' }}" @if (!$olderYear) aria-disabled="true" tabindex="-1" @endif aria-label="Older year"><x-homepage.icon name="chevron" /></a>
            </nav>

            @foreach ($volumes as $volume => $volumeIssues)
                <section class="vpanel" aria-labelledby="vol-{{ $volume }}">
                    <div class="vpanel__head">
                        <h2 id="vol-{{ $volume }}"><span class="tic tic--sm"><x-homepage.icon name="layers" /></span>Volume {{ $volume }} ({{ $year }})</h2>
                        <span class="muted">{{ $volumeIssues->count() }} {{ \Illuminate\Support\Str::plural('issue', $volumeIssues->count()) }}</span>
                    </div>
                    <ul class="vpanel__list">
                        @foreach ($volumeIssues as $item)
                            @php $stat = $issueStats->get("{$item->volume}-{$item->issue}"); @endphp
                            <li>
                                <a class="vrow" href="{{ route('archives.issue', ['year' => $year, 'volume' => $item->volume, 'issue' => $item->issue]) }}">
                                    <span class="vrow__n"><small>Issue</small><b>{{ $item->issue }}</b></span>
                                    <span class="vrow__b">
                                        <strong>Volume {{ $item->volume }} Issue {{ $item->issue }}</strong>
                                        @if ($stat)
                                            <span class="vrow__meta">
                                                @if ($stat->months)<span><x-homepage.icon name="calendar" /> {{ $stat->months }} {{ $year }}</span>@endif
                                                <span><x-homepage.icon name="file" /> {{ $stat->papers }} {{ \Illuminate\Support\Str::plural('article', $stat->papers) }}</span>
                                            </span>
                                        @endif
                                    </span>
                                    <span class="vrow__go">Browse papers <x-homepage.icon name="arrow" /></span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </section>
            @endforeach

            <div class="qlinks">
                <a class="qlink" href="/archives"><x-homepage.icon name="layers" /> All archives</a>
                <a class="qlink" href="/current-issue"><x-homepage.icon name="journal" /> Current issue</a>
                <a class="qlink" href="/editorial-board"><x-homepage.icon name="users" /> Editorial board</a>
            </div>
        </div>

        <x-archive.sidebar />
    </div>
</div>
@endsection
