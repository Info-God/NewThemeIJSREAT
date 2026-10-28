@extends('layouts.app')

@section('meta_title', "Volume {$volume} Year {$year} | Thesis Publications | IJSREAT")
@section('meta_description', "Browse published thesis and dissertation papers for Volume {$volume}, Year {$year} at IJSREAT.")

@include('archives.partials.theme')

@php
    $authorsOf = fn ($p) => collect([$p->thesis_author_1 ?? null, $p->thesis_author_2 ?? null, $p->thesis_author_3 ?? null, $p->thesis_author_4 ?? null, $p->thesis_author_5 ?? null, $p->thesis_author_6 ?? null])->filter()->implode(', ');
    $searchIndex = $papers->map(fn ($p) => mb_strtolower($p->thesis_title . ' ' . $authorsOf($p)))->values();
@endphp

@section('content')
<div class="hp" x-data="{ search: '', index: @js($searchIndex), match(i) { const q = this.search.toLowerCase().trim(); return !q || this.index[i].includes(q) }, get count() { return this.index.filter((_, i) => this.match(i)).length } }">
    <x-archive.pageband title="Thesis Publications" :crumbs="['Thesis' => '/thesis', 'Volume ' . $volume . ' (' . $year . ')' => null]"
        :lead="'Volume ' . $volume . ', Year ' . $year" />

    <div class="apage">
        <div class="amain">
            <section class="ihero" aria-label="Volume details">
                <span class="ihero__ic"><x-homepage.icon name="book" /></span>
                <div class="ihero__b">
                    <h2>Volume {{ $volume }}, Year {{ $year }}</h2>
                    <p>Thesis and dissertation publications</p>
                </div>
                <span class="ihero__badge"><x-homepage.icon name="file" /> {{ $papers->count() }} {{ \Illuminate\Support\Str::plural('paper', $papers->count()) }}</span>
            </section>

            <div class="search">
                <label class="search__lbl" for="thesis-search"><x-homepage.icon name="search" /> Search these papers</label>
                <div class="search__row">
                    <span class="search__ic" aria-hidden="true"><x-homepage.icon name="search" /></span>
                    <input id="thesis-search" type="text" x-model="search" placeholder="Search by Title, Author name">
                    <button class="search__btn" type="button" x-show="search" x-cloak @click="search = ''">Clear</button>
                </div>
                <p class="search__note" x-show="search" x-cloak><strong x-text="count"></strong> matching <span x-text="count === 1 ? 'paper' : 'papers'"></span></p>
            </div>

            <div class="plist">
                @foreach ($papers as $paper)
                    @php
                        $detailUrl = getThesisPaperUrl($paper);
                        $published = ($paper->thesis_month ? $paper->thesis_month . ' ' : '') . $paper->thesis_year;
                    @endphp
                    <article class="pcard2" x-show="match({{ $loop->index }})">
                        <div class="pcard2__head">
                            <span class="pcard2__num" aria-hidden="true">{{ $loop->iteration }}</span>
                            <div class="pcard2__main">
                                <div class="tags">
                                    <span class="tag tag--type"><x-homepage.icon name="tag" /> Thesis Publication</span>
                                    <span class="tag tag--oa"><x-homepage.icon name="lock" /> Open Access</span>
                                </div>
                                <a class="pcard2__title" href="{{ $detailUrl }}">{{ $paper->thesis_title }}</a>
                                @if ($authorsOf($paper))
                                    <p class="pcard2__authors"><x-homepage.icon name="users" /> <span>{{ $authorsOf($paper) }}</span></p>
                                @endif
                            </div>
                        </div>
                        <div class="pcard2__meta">
                            <span><x-homepage.icon name="calendar" /> <strong>Published Online:</strong> {{ $published }}</span>
                            <span><x-homepage.icon name="pages" /> <strong>Pages:</strong> {{ $paper->thesis_pages ?? 'N/A' }}</span>
                        </div>
                        <div class="pcard2__foot">
                            <a class="pbtn" href="{{ $detailUrl }}?section=FullArticle"><x-homepage.icon name="doc" /> Abstract</a>
                            <a class="pbtn" href="{{ $detailUrl }}?section=FullArticle"><x-homepage.icon name="eye" /> Full Text</a>
                            <a class="pbtn" href="{{ $detailUrl }}?section=References"><x-homepage.icon name="list" /> References</a>
                            <a class="pbtn" href="https://www.google.com/search?q={{ urlencode($paper->thesis_title) }}" target="_blank" rel="noopener"><x-homepage.icon name="search" /> Google</a>
                            @if ($paper->thesis_paper_url)<a class="pbtn pbtn--solid" href="{{ $paper->thesis_paper_url }}" target="_blank" rel="noopener"><x-homepage.icon name="download" /> Download PDF</a>@endif
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
