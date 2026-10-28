@extends('layouts.app')

@section('meta_title', $title)
@section('meta_description', $metaDescription)

@include('archives.partials.theme')

@php
    $isCurrentIssueFlow = request()->is('current-issue*') || request()->is('curent-issue*');
    $routePrefix = $isCurrentIssueFlow
        ? (request()->is('curent-issue*') ? 'curent-issue.issue' : 'current-issue.issue')
        : 'archives.issue';
    $paperRoute = $isCurrentIssueFlow
        ? (request()->is('curent-issue*') ? 'curent-issue.paper' : 'current-issue.paper')
        : 'archives.paper';

    // Months most papers on this page carry (paper_month, e.g. "May-August").
    $issueMonths = $papers->getCollection()->pluck('paper_month')->filter()->countBy()->sortDesc()->keys()->first();
    $searchTerm = request('search');

    // Volume / issue navigation (same rules as the previous volume header).
    $volumeIndex = $allVolumes->search(fn ($v) => $v->year == $year && $v->volume == $volume);
    $prevVol = $volumeIndex !== false && $volumeIndex > 0 ? $allVolumes[$volumeIndex - 1] : null;
    $nextVol = $volumeIndex !== false && $volumeIndex < $allVolumes->count() - 1 ? $allVolumes[$volumeIndex + 1] : null;
    $issueIndex = $allIssues->search(fn ($i) => $i->issue == $issue);
    $prevIssue = $issueIndex !== false && $issueIndex > 0 ? $allIssues[$issueIndex - 1] : null;
    $nextIssue = $issueIndex !== false && $issueIndex < $allIssues->count() - 1 ? $allIssues[$issueIndex + 1] : null;

    $clearUrl = url()->current();
    if (request('year') || request('volume') || request('issue')) {
        $clearUrl .= '?' . http_build_query(request()->only(['year', 'volume', 'issue']));
    }

    $crumbs = $isCurrentIssueFlow
        ? ['Current Issue' => null]
        : ['Archives' => '/archives', (string) $year => route('archives.year', ['year' => $year]), "Vol. {$volume} Issue {$issue}" => null];
@endphp

@section('content')
<div class="hp" x-data="{ copied: false, copyLink() { navigator.clipboard.writeText(window.location.href).then(() => { this.copied = true; setTimeout(() => this.copied = false, 2000) }) } }">
    <x-archive.pageband
        :title="$isCurrentIssueFlow ? 'Current Issue' : 'Published Papers — Volume ' . $volume . ', Issue ' . $issue"
        :crumbs="$crumbs"
        :lead="$isCurrentIssueFlow ? 'The latest published issue of the International Journal of Scientific Research in Engineering & Technology. Every article is open access with a full PDF download.' : null" />

    <div class="apage">
        <div class="amain">
            @if ($isCurrentIssueFlow)
                <section class="chero" aria-label="Current issue details">
                    <div class="issue-cover" aria-hidden="true">
                        <b>IJSREAT</b>
                        <small>International Journal of Scientific Research in Engineering & Technology</small>
                        <div class="issue-cover__rule"></div>
                        <i>Volume {{ $volume }}<br>Issue {{ $issue }}<br>{{ $year }}</i>
                        <span class="issue-cover__tag">Open Access</span>
                    </div>
                    <div class="chero__b">
                        <span class="chero__live">Current Issue</span>
                        <h2>Volume {{ $volume }}, Issue {{ $issue }} ({{ $year }})</h2>
                        <div class="chero__meta">
                            <div><span>Volume</span><b>{{ $volume }}</b></div>
                            <div><span>Issue</span><b>{{ $issue }}</b></div>
                            <div><span>Year</span><b>{{ $year }}</b></div>
                            @if ($issueMonths)<div><span>Published</span><b>{{ $issueMonths }}</b></div>@endif
                            <div><span>Articles</span><b>{{ $papers->total() }}</b></div>
                            <div><span>e-ISSN</span><b>2583-1240</b></div>
                        </div>
                        <div class="chero__acts">
                            <a class="button button--solid" href="https://editorial.fdrpjournals.org/login?journal=2" target="_blank" rel="noopener noreferrer"><x-homepage.icon name="send" /> Submit Article</a>
                            <a class="button button--ghost" href="{{ route('archives.issue', ['year' => $year, 'volume' => $volume, 'issue' => $issue]) }}"><x-homepage.icon name="layers" /> View in Archives</a>
                            <button type="button" class="button button--ghost" @click="copyLink()"><x-homepage.icon name="share" /> <span x-text="copied ? 'Link copied' : 'Share'">Share</span></button>
                        </div>
                    </div>
                </section>
            @else
                <section class="ihero" aria-label="Issue details">
                    <span class="ihero__ic"><x-homepage.icon name="journal" /></span>
                    <div class="ihero__b">
                        <h2>IJSREAT — Published Issue</h2>
                        <p>Volume {{ $volume }} &nbsp;&bull;&nbsp; Issue {{ $issue }} &nbsp;&bull;&nbsp; {{ $issueMonths ? $issueMonths . ' ' : '' }}{{ $year }} &nbsp;&bull;&nbsp; e-ISSN: 2583-1240</p>
                    </div>
                    <span class="ihero__badge"><x-homepage.icon name="file" /> {{ $papers->total() }} {{ \Illuminate\Support\Str::plural('article', $papers->total()) }}</span>
                </section>

                <nav class="inav" aria-label="Volumes and issues">
                    <div class="inav__row">
                        <span class="inav__lbl">Volume</span>
                        <a class="inav__step inav__step--prev" href="{{ $prevVol ? route($routePrefix, ['year' => $prevVol->year, 'volume' => $prevVol->volume, 'issue' => 1]) : '#' }}" @if (!$prevVol) aria-disabled="true" tabindex="-1" @endif aria-label="Newer volume"><x-homepage.icon name="chevron" /></a>
                        <div class="inav__scroll">
                            @foreach ($allVolumes as $vol)
                                <a class="inav__pill" href="{{ route($routePrefix, ['year' => $vol->year, 'volume' => $vol->volume, 'issue' => 1]) }}" @if ($vol->year == $year && $vol->volume == $volume) aria-current="page" @endif>Volume {{ $vol->volume }} ({{ $vol->year }})</a>
                            @endforeach
                        </div>
                        <a class="inav__step" href="{{ $nextVol ? route($routePrefix, ['year' => $nextVol->year, 'volume' => $nextVol->volume, 'issue' => 1]) : '#' }}" @if (!$nextVol) aria-disabled="true" tabindex="-1" @endif aria-label="Older volume"><x-homepage.icon name="chevron" /></a>
                    </div>
                    @if ($allIssues->count() > 0)
                        <div class="inav__row">
                            <span class="inav__lbl">Issue</span>
                            <a class="inav__step inav__step--prev" href="{{ $prevIssue ? route($routePrefix, ['year' => $year, 'volume' => $volume, 'issue' => $prevIssue->issue]) : '#' }}" @if (!$prevIssue) aria-disabled="true" tabindex="-1" @endif aria-label="Previous issue"><x-homepage.icon name="chevron" /></a>
                            <div class="inav__scroll">
                                @foreach ($allIssues as $iss)
                                    <a class="inav__pill" href="{{ route($routePrefix, ['year' => $year, 'volume' => $volume, 'issue' => $iss->issue]) }}" @if ($iss->issue == $issue) aria-current="page" @endif>Issue {{ $iss->issue }}</a>
                                @endforeach
                            </div>
                            <a class="inav__step" href="{{ $nextIssue ? route($routePrefix, ['year' => $year, 'volume' => $volume, 'issue' => $nextIssue->issue]) : '#' }}" @if (!$nextIssue) aria-disabled="true" tabindex="-1" @endif aria-label="Next issue"><x-homepage.icon name="chevron" /></a>
                        </div>
                    @endif
                </nav>

                <div class="qlinks">
                    <a class="qlink" href="/archives"><x-homepage.icon name="layers" /> See all volumes</a>
                    <a class="qlink" href="{{ route('archives.year', ['year' => $year]) }}"><x-homepage.icon name="calendar" /> {{ $year }} issues</a>
                    <a class="qlink" href="/editorial-board"><x-homepage.icon name="users" /> Editorial Board</a>
                    <a class="qlink" href="/current-issue"><x-homepage.icon name="journal" /> Current Issue</a>
                    <button type="button" class="qlink" @click="copyLink()"><x-homepage.icon name="share" /> <span x-text="copied ? 'Link copied' : 'Share'">Share</span></button>
                </div>
            @endif

            {{-- Search (same GET form and parameters as before) --}}
            <form class="search" action="{{ url()->current() }}" method="GET" role="search">
                <label class="search__lbl" for="paper-search"><x-homepage.icon name="search" /> Search this issue</label>
                @foreach (['year', 'volume', 'issue'] as $param)
                    @if (request($param))
                        <input type="hidden" name="{{ $param }}" value="{{ request($param) }}">
                    @endif
                @endforeach
                <div class="search__row">
                    <span class="search__ic" aria-hidden="true"><x-homepage.icon name="search" /></span>
                    <input id="paper-search" type="text" name="search" value="{{ $searchTerm }}" placeholder="Search by Title, Author name">
                    @if ($searchTerm)
                        <a class="search__btn" href="{{ $clearUrl }}">Clear</a>
                    @else
                        <button class="search__btn" type="submit">Search</button>
                    @endif
                </div>
                @if ($searchTerm)
                    <p class="search__note"><strong>{{ $papers->total() }}</strong> {{ \Illuminate\Support\Str::plural('result', $papers->total()) }} for “{{ $searchTerm }}”</p>
                @endif
            </form>

            <section aria-labelledby="hp-papers">
                <div class="block-title">
                    <h2 class="rule-title" id="hp-papers">{{ $isCurrentIssueFlow ? 'Articles in this Issue' : 'Published Papers' }}</h2>
                    @if ($papers->total() > $papers->count())
                        <span class="muted">Showing {{ $papers->firstItem() }}–{{ $papers->lastItem() }} of {{ $papers->total() }}</span>
                    @endif
                </div>
                <div @class(['plist', 'plist--current' => $isCurrentIssueFlow])>
                    @forelse ($papers as $paper)
                        @php
                            $paperUrl = route($paperRoute, ['identifier' => getPaperSlug($paper)]);
                            $doiUrl = getPaperDoiUrl($paper->paper_doi);
                        @endphp
                        <article class="pcard2">
                            <div class="pcard2__head">
                                <div class="pcard2__main">
                                    <div class="tags">
                                        @if ($paper->paper_articletype)<span class="tag tag--type"><x-homepage.icon name="tag" /> {{ $paper->paper_articletype }}</span>@endif
                                        <span class="tag tag--oa"><x-homepage.icon name="lock" /> Open Access</span>
                                        @if ($doiUrl)<span class="tag tag--doi"><x-homepage.icon name="link" /> DOI</span>@endif
                                    </div>
                                    <a class="pcard2__title" href="{{ $paperUrl }}">{{ $paper->paper_title }}</a>
                                    @if (count($paper->authors))
                                        <p class="pcard2__authors"><x-homepage.icon name="users" /> <span>{{ implode(', ', $paper->authors) }}</span></p>
                                    @endif
                                </div>
                            </div>
                            <div class="pcard2__meta">
                                <span><x-homepage.icon name="calendar" /> <strong>Published Online:</strong> {{ $paper->paper_month }} {{ $paper->year }}</span>
                                @if ($paper->paper_pages)<span><x-homepage.icon name="pages" /> <strong>Pages:</strong> {{ $paper->paper_pages }}</span>@endif
                                @if ($paper->view_count)<span><x-homepage.icon name="eye" /> {{ $paper->view_count }} Views</span>@endif
                            </div>
                            @if ($doiUrl)
                                <div class="pcard2__doi"><strong>DOI:</strong> <a href="{{ $doiUrl }}" target="_blank" rel="noopener">{{ $doiUrl }}</a></div>
                            @endif
                            <div class="pcard2__foot">
                                <a class="pbtn" href="{{ $paperUrl }}?section=FullArticle"><x-homepage.icon name="doc" /> Abstract</a>
                                <a class="pbtn" href="{{ $paperUrl }}?section=FullArticle"><x-homepage.icon name="eye" /> Full Text</a>
                                <a class="pbtn" href="{{ $paperUrl }}?section=References"><x-homepage.icon name="list" /> References</a>
                                <a class="pbtn" href="https://www.google.com/search?q={{ urlencode($paper->paper_title) }}" target="_blank" rel="noopener"><x-homepage.icon name="search" /> Google</a>
                                <a class="pbtn pbtn--solid" href="{{ $paper->paper_pdf_url }}" download><x-homepage.icon name="download" /> Download PDF</a>
                            </div>
                        </article>
                    @empty
                        <div class="pempty">
                            <x-homepage.icon name="search" />
                            <h2>No Paper Found</h2>
                            <p>Try another title or author name.</p>
                        </div>
                    @endforelse
                </div>
                {{ $papers->links('vendor.pagination.react-custom') }}
            </section>
        </div>

        <x-archive.sidebar />
    </div>
</div>
@endsection
