@extends('layouts.app')

@section('meta_title', "Volume {$category->volume} Issue {$category->issue} ({$category->year}) | Conference Papers | IJSREAT")
@section('meta_description', "Browse and search conference papers for Volume {$category->volume}, Issue {$category->issue} of {$category->name}.")

@include('archives.partials.theme')

@php
    // Null-safe: some IJSREAT database copies have no month / author_N columns (only `author`).
    $published = ($category->month ?? null) ? $category->month . ' ' . $category->year : $category->year;
    $authorsOf = fn ($p) => collect([$p->author_1 ?? null, $p->author_2 ?? null, $p->author_3 ?? null, $p->author_4 ?? null, $p->author_5 ?? null, $p->author_6 ?? null])->filter()->implode(', ') ?: ($p->author ?? '');
    $searchIndex = $papers->map(fn ($p) => strtolower($p->title . ' ' . $authorsOf($p)))->values();
@endphp

@section('content')
<div class="hp" x-data="{ search: '', index: @js($searchIndex), match(i) { const q = this.search.toLowerCase().trim(); return !q || this.index[i].includes(q) }, get count() { return this.index.filter((_, i) => this.match(i)).length } }">
    <x-archive.pageband :title="$category->name" :crumbs="['Conference' => '/conference', $category->name => null]" :lead="$category->title" />

    <div class="apage">
        <div class="amain">
            <section class="ihero" aria-label="Conference details">
                <span class="ihero__ic"><x-homepage.icon name="users" /></span>
                <div class="ihero__b">
                    <h2>{{ $category->title }}</h2>
                    <p>Volume {{ $category->volume }} &nbsp;&bull;&nbsp; Issue {{ $category->issue }} &nbsp;&bull;&nbsp; {{ $category->year }}@if ($category->conference_date) &nbsp;&bull;&nbsp; {{ $category->conference_date }}@endif</p>
                    @if ($category->organised_by)<p>Organized By: {{ $category->organised_by }}</p>@endif
                </div>
                <span class="ihero__badge"><x-homepage.icon name="file" /> {{ $papers->count() }} {{ \Illuminate\Support\Str::plural('paper', $papers->count()) }}</span>
            </section>

            <div class="search">
                <label class="search__lbl" for="conf-search"><x-homepage.icon name="search" /> Search these papers</label>
                <div class="search__row">
                    <span class="search__ic" aria-hidden="true"><x-homepage.icon name="search" /></span>
                    <input id="conf-search" type="text" x-model="search" placeholder="Search by Title, Author name">
                    <button class="search__btn" type="button" x-show="search" x-cloak @click="search = ''">Clear</button>
                </div>
                <p class="search__note" x-show="search" x-cloak><strong x-text="count"></strong> matching <span x-text="count === 1 ? 'paper' : 'papers'"></span></p>
            </div>

            <div class="plist">
                @foreach ($papers as $i => $paper)
                    @php
                        $detailUrl = getConferencePaperUrl($paper);
                        $pdfUrl = $paper->pdf_url ? url('/conferencePDF/' . ltrim($paper->pdf_url, '/')) : '';
                        $doiUrl = getPaperDoiUrl($paper->doi);
                    @endphp
                    <article class="pcard2" x-show="match({{ $loop->index }})">
                        <div class="pcard2__head">
                            <div class="pcard2__main">
                                <div class="tags">
                                    <span class="tag tag--type"><x-homepage.icon name="tag" /> {{ $paper->article_type ?? 'Research Article' }}</span>
                                    <span class="tag tag--oa"><x-homepage.icon name="lock" /> Open Access</span>
                                    @if ($doiUrl)<span class="tag tag--doi"><x-homepage.icon name="link" /> DOI</span>@endif
                                </div>
                                <a class="pcard2__title" href="{{ $detailUrl }}">{{ $paper->title }}</a>
                                @if ($authorsOf($paper))
                                    <p class="pcard2__authors"><x-homepage.icon name="users" /> <span>{{ $authorsOf($paper) }}</span></p>
                                @endif
                            </div>
                        </div>
                        <div class="pcard2__meta">
                            <span><x-homepage.icon name="calendar" /> <strong>Published Online:</strong> {{ $published }}</span>
                            <span><x-homepage.icon name="pages" /> <strong>Pages:</strong> {{ $paper->pages ?? 'N/A' }}</span>
                        </div>
                        @if ($doiUrl)
                            <div class="pcard2__doi"><strong>DOI:</strong> <a href="{{ $doiUrl }}" target="_blank" rel="noopener">{{ $doiUrl }}</a></div>
                        @endif
                        <div class="pcard2__foot">
                            <a class="pbtn" href="{{ $detailUrl }}?section=FullArticle"><x-homepage.icon name="doc" /> Abstract</a>
                            <a class="pbtn" href="{{ $detailUrl }}?section=FullArticle"><x-homepage.icon name="eye" /> Full Text</a>
                            <a class="pbtn" href="{{ $detailUrl }}?section=References"><x-homepage.icon name="list" /> References</a>
                            <a class="pbtn" href="https://www.google.com/search?q={{ urlencode($paper->title) }}" target="_blank" rel="noopener"><x-homepage.icon name="search" /> Google</a>
                            @if ($pdfUrl)<a class="pbtn pbtn--solid" href="{{ $pdfUrl }}" target="_blank" rel="noopener"><x-homepage.icon name="download" /> Download PDF</a>@endif
                        </div>
                    </article>
                @endforeach
                <div class="pempty" x-show="count === 0" x-cloak>
                    <x-homepage.icon name="search" />
                    <h2>No papers match your search criteria.</h2>
                    <p>Try adjusting keywords or clearing the filter.</p>
                </div>
            </div>
        </div>

        <x-archive.sidebar />
    </div>
</div>
@endsection
