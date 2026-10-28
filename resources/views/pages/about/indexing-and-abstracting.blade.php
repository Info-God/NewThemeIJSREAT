@extends('layouts.app')

@section('meta_title', 'IJSREAT | Indexing & Abstracting – International Journal of Scientific Research in Engineering & Technology')
@section('meta_description', 'Discover IJSREAT’s indexing and abstracting details. The journal is listed in leading databases, enhancing visibility, accessibility, and global recognition of published research.')

@include('archives.partials.theme')

@php
    $partners = DB::table('indexings')->get();
    $image = fn ($path) => (str_starts_with($path, 'http://') || str_starts_with($path, 'https://'))
        ? $path
        : 'https://panel.ijsreat.com/storage/' . trim($path, '/');
    $label = fn ($name) => ucwords(trim(preg_replace('/_+/', ' ', $name)));

    // A link counts as a journal record when it points at IJSREAT specifically
    // (its ISSN, name, DOI prefix or a record ID), not at a service's home page.
    $recordPattern = '/2583-1240|ijsreat|innovative(%20|\+|\s)research(%20|\+|\s)in(%20|\+|\s)engineering|10\.59256\/ijsreat/i';
    $kind = function ($p) use ($recordPattern) {
        $url = trim((string) $p->indexing_url);
        if ($url === '' || $url === '.' || !preg_match('#^https?://#i', $url)) {
            return 'none';
        }
        return preg_match($recordPattern, $url) ? 'record' : 'home';
    };
    $isLibrary = fn ($p) => (bool) preg_match('/librar|universit|hesburgh|primo/i', $p->indexing_name);

    $records = $partners->filter(fn ($p) => $kind($p) === 'record')->values();
    $libraries = $partners->filter(fn ($p) => $kind($p) !== 'record' && $isLibrary($p))->values();
    $others = $partners->filter(fn ($p) => $kind($p) !== 'record' && !$isLibrary($p))->values();
    $host = fn ($url) => preg_replace('/^www\./', '', (string) parse_url($url, PHP_URL_HOST));
@endphp

@section('content')
<div class="hp">
    <x-archive.pageband title="Indexing & Abstracting" :crumbs="['Indexing & Abstracting' => null]"
        lead="Where the International Journal of Scientific Research in Engineering & Technology is registered, indexed and listed, with a link to each service so you can check it yourself.">
        <span class="pbf pbf--cyan"><x-homepage.icon name="check" /><span>Journal records</span><b>{{ $records->count() }}</b></span>
        <span class="pbf pbf--orange"><x-homepage.icon name="globe" /><span>Listings</span><b>{{ $partners->count() }}</b></span>
        <span class="pbf"><x-homepage.icon name="link" /><span>DOI prefix</span><b>10.59256/ijsreat</b></span>
    </x-archive.pageband>

    <div class="apage">
        <div class="amain">
            <nav class="toc" aria-label="On this page" style="margin-top:0">
                <a href="#records">Journal records</a>
                @if ($others->isNotEmpty())<a href="#listings">Other listings</a>@endif
                @if ($libraries->isNotEmpty())<a href="#libraries">Library catalogues</a>@endif
                <a href="#doi">DOI &amp; originality</a>
                <a href="#verify">How to verify</a>
            </nav>

            <section id="records" class="sec-anchor" aria-labelledby="ix-records">
                <div class="block-title">
                    <h2 class="rule-title" id="ix-records">Journal Records You Can Check</h2>
                    <span class="muted">Links open IJSREAT's own record or a search for it</span>
                </div>
                @if ($records->isNotEmpty())
                    <div class="recs">
                        @foreach ($records as $p)
                            <a class="rec" href="{{ $p->indexing_url }}" target="_blank" rel="noopener">
                                <span class="rec__logo"><img src="{{ $image($p->indexing_image_url) }}" alt="" loading="lazy"></span>
                                <span class="rec__b">
                                    <strong>{{ $label($p->indexing_name) }}</strong>
                                    <small>{{ $host($p->indexing_url) }}</small>
                                    <span class="rtag rtag--ok"><x-homepage.icon name="check" /> Journal record</span>
                                </span>
                            </a>
                        @endforeach
                    </div>
                @else
                    <p class="empty">No indexing records have been added yet.</p>
                @endif
            </section>

            @if ($others->isNotEmpty())
                <section id="listings" class="sec-anchor" aria-labelledby="ix-listings">
                    <div class="block-title">
                        <h2 class="rule-title" id="ix-listings">Other Listings</h2>
                        <span class="muted">Links open the service's home page</span>
                    </div>
                    <div class="recs">
                        @foreach ($others as $p)
                            @php $k = $kind($p); @endphp
                            @if ($k === 'home')
                                <a class="rec" href="{{ $p->indexing_url }}" target="_blank" rel="noopener">
                            @else
                                <div class="rec">
                            @endif
                                <span class="rec__logo"><img src="{{ $image($p->indexing_image_url) }}" alt="" loading="lazy"></span>
                                <span class="rec__b">
                                    <strong>{{ $label($p->indexing_name) }}</strong>
                                    @if ($k === 'home')
                                        <small>{{ $host($p->indexing_url) }}</small>
                                        <span class="rtag rtag--home">Service home page</span>
                                    @else
                                        <span class="rtag rtag--none">No link provided</span>
                                    @endif
                                </span>
                            @if ($k === 'home')</a>@else</div>@endif
                        @endforeach
                    </div>
                </section>
            @endif

            @if ($libraries->isNotEmpty())
                <section id="libraries" class="sec-anchor" aria-labelledby="ix-libraries">
                    <div class="block-title">
                        <h2 class="rule-title" id="ix-libraries">Library Catalogues</h2>
                        <span class="muted">Links open the library's home page</span>
                    </div>
                    <div class="recs">
                        @foreach ($libraries as $p)
                            <a class="rec" href="{{ $p->indexing_url }}" target="_blank" rel="noopener">
                                <span class="rec__logo"><img src="{{ $image($p->indexing_image_url) }}" alt="" loading="lazy"></span>
                                <span class="rec__b"><strong>{{ $label($p->indexing_name) }}</strong><small>{{ $host($p->indexing_url) }}</small></span>
                            </a>
                        @endforeach
                    </div>
                </section>
            @endif

            <section id="doi" class="sec-anchor two-col" aria-label="DOI and originality">
                <div class="panel2">
                    <h3><x-homepage.icon name="link" /> Crossref DOI</h3>
                    <img src="/verifySection/image2.webp" alt="DOI CrossRef" style="width:170px;height:auto;margin:0 0 12px">
                    <p class="muted">CrossRef DOI is assigned to research Article published in our journal. IJSREAT DOI prefix is <strong style="color:var(--brand-deep)">10.59256/ijsreat</strong>.</p>
                </div>
                <div class="panel2">
                    <h3><x-homepage.icon name="search" /> Plagiarism screening</h3>
                    <img src="/verifySection/image1.webp" alt="Turnitin" style="width:170px;height:auto;margin:0 0 12px">
                    <p class="muted">Plagiarism is checked by the leading plagiarism checker. See the <a href="/ethics?target=plagiarism-policy" style="color:var(--brand);font-weight:700">plagiarism policy</a>.</p>
                </div>
            </section>

            <section id="verify" class="sec-anchor" aria-labelledby="ix-verify">
                <div class="block-title"><h2 class="rule-title" id="ix-verify">How to Verify IJSREAT</h2></div>
                <ol class="steps6">
                    <li><b>Check the ISSN</b>Look up <a href="https://portal.issn.org/resource/ISSN/2583-1240" target="_blank" rel="noopener">2583-1240 on the ISSN Portal</a> and confirm the title.</li>
                    <li><b>Search Crossref</b>Search <a href="https://search.crossref.org/?from_ui=&q=2583-1240" target="_blank" rel="noopener">Crossref for the ISSN</a> to see registered articles.</li>
                    <li><b>Resolve a DOI</b>Open any article DOI at doi.org; it should lead to the article on this site.</li>
                    <li><b>Open Google Scholar</b>Search <a href="https://scholar.google.com/scholar?q=ijsreat" target="_blank" rel="noopener">Google Scholar for IJSREAT</a> to find indexed papers.</li>
                    <li><b>Read the policies</b>Review the <a href="/peer-review-policy">peer review</a> and <a href="/publication-ethics-policy">publication ethics</a> policies.</li>
                    <li><b>Check the charges</b>The <a href="/article-processing-charges">article processing charges</a> are published and charged after acceptance.</li>
                </ol>
            </section>

            <div class="qlinks">
                <a class="qlink" href="/impact-Factor"><x-homepage.icon name="chart" /> Impact Factor</a>
                <a class="qlink" href="/journal-particulars"><x-homepage.icon name="doc" /> Journal Particulars</a>
                <a class="qlink" href="/aim-and-scope"><x-homepage.icon name="globe" /> Aim &amp; Scope</a>
                <a class="qlink" href="/current-issue"><x-homepage.icon name="journal" /> Current Issue</a>
            </div>
        </div>

        <x-archive.sidebar />
    </div>
</div>
@endsection
