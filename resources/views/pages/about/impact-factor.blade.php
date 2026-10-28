@extends('layouts.app')

@section('meta_title', 'IJSREAT Impact Factor 2026: 7.812 – Google Scholar Citation Metrics | IJSREAT')
@section('meta_description', 'IJSREAT (e-ISSN 2583-1240) impact factor 7.812 and Google Scholar citation metrics: 1,953 total citations, h-index 20 and i10-index 40, with the 2026 calculation method and how to verify it.')

@include('archives.partials.theme')

@php
    $ems = 'https://editorial.fdrpjournals.org/login?journal=2';
    $impact = '7.812';
    $window = 2021;

    $crossref = 'https://search.crossref.org/?from_ui=&q=2583-1240';

    $kpis = [
        ['Impact Factor', $impact, 'Reporting year 2026'],
        ['Total citations', '1,953', '1,420 since ' . $window],
        ['h-index', '20', '17 since ' . $window],
        ['i10-index', '40', '35 since ' . $window],
    ];

    // [metric, all years, since 2021]
    $pairs = [
        ['Total citations', 1953, 1420],
        ['h-index', 20, 17],
        ['i10-index', 40, 35],
    ];
    $share = round(1420 / 1953 * 100, 2);

    $meaning = [
        ['quote', 'Total citations', 'The number of citations recorded by the underlying Google Scholar profile over the stated period.'],
        ['award', 'h-index', 'An h-index of 20 means that at least 20 publications in the profile have each received at least 20 citations.'],
        ['chart', 'i10-index', 'An i10-index of 40 means that 40 publications in the profile have received at least 10 citations each.'],
    ];

    // Indicator for 250 eligible 2024–2025 articles at different 2026 citation counts.
    $articles = 250;
    $scenarios = [250, 500, 750, 1000, 1250, 1500];

    $others = [
        ['search', 'Google Scholar citation indicators', 'Broad citation coverage across scholarly literature, including journal articles, conference papers, theses, and other documents.'],
        ['award', 'Clarivate Journal Impact Factor', 'A metric published in Journal Citation Reports for eligible journals covered by the relevant Web of Science collection.'],
        ['chart', 'Scopus CiteScore', 'A separate citation metric based on Scopus data and its defined calculation methodology.'],
        ['link', 'Crossref citation information', 'Citation links and metadata derived from records deposited by participating publishers and other sources.'],
    ];

    $steps = [
        'Verify the journal’s Google Scholar profile and confirm that it corresponds to IJSREAT.',
        'Confirm the number of eligible research articles and review articles published in 2024 and 2025.',
        'Identify citations received during 2026 by those eligible publications.',
        'Divide the verified citation count by the verified publication count.',
        'Publish the source, calculation year, publication window, document types, and underlying counts.',
    ];

    $summary = [
        ['Data source', 'Google Scholar figures supplied for IJSREAT.'],
        ['Reported citation indicators', '1,953 total citations, h-index 20, and i10-index 40 across all years.'],
        ['Publication count for the worked example', '250 eligible articles published in 2024–2025 combined.'],
        ['2026 citation impact status', 'Not yet calculated from verified year-specific citation data.'],
    ];

    $faqs = [
        ['What is the impact factor of IJSREAT?', 'IJSREAT’s impact factor is ' . $impact . '. Its Google Scholar profile reports 1,953 total citations, an h-index of 20 and an i10-index of 40 across all years.'],
        ['How is 7.812 worked out?', 'It is the historical citation-to-publication ratio: the all-time citation count of 1,953 divided by the publication count of 250 gives 7.812, approximately 7.81 citations per article.'],
        ['Is 7.812 the 2026 two-year impact indicator?', 'No. The numerator includes citations accumulated across multiple years rather than citations received during 2026 by the 2024–2025 publication cohort.'],
        ['Is this a Clarivate Journal Impact Factor or Scopus CiteScore?', 'No. A Google Scholar-based calculation should not be presented as an official Clarivate Journal Impact Factor or Scopus CiteScore.'],
        ['What do the h-index and i10-index mean?', 'An h-index of 20 means at least 20 publications have each received at least 20 citations. An i10-index of 40 means 40 publications have received at least 10 citations each.'],
    ];
@endphp

@section('content')
<div class="hp">
    <x-archive.pageband title="IJSREAT Impact Factor" :crumbs="['Indexing & Abstracting' => '/indexing-and-abstracting', 'Impact Factor' => null]"
        lead="IJSREAT Impact Factor 2026 and Google Scholar citation metrics: total citations, h-index and i10-index, the 2026 calculation method and how to verify it.">
        <span class="pbf pbf--cyan"><x-homepage.icon name="chart" /><span>Impact Factor</span><b>{{ $impact }}</b></span>
        <span class="pbf pbf--orange"><x-homepage.icon name="award" /><span>h-index</span><b>20</b></span>
        <span class="pbf"><x-homepage.icon name="quote" /><span>Citations</span><b>1,953</b></span>
    </x-archive.pageband>

    <div class="apage" style="grid-template-columns:1fr">
        <div class="amain">
            {{-- Summary card --}}
            <section class="ugc-hero" aria-label="Impact factor summary">
                <div class="ugc-hero__b">
                    <p class="ugc-kicker">IJSREAT · Google Scholar Citation Metrics</p>
                    <h2>IJSREAT Impact Factor 2026: {{ $impact }}</h2>
                    <p>The International Journal of Scientific Research in Engineering &amp; Technology (IJSREAT), e-ISSN 2583-1240, presents citation indicators to help readers understand the scholarly visibility and citation activity associated with its publications.</p>
                    <p>Google Scholar metrics, including total citations, h-index, and i10-index, provide complementary information about citation activity. Any journal-level citation impact indicator should also specify its calculation method, reporting year, publication window, and data source.</p>
                    <ul class="ugc-hero__facts">
                        <li><b>e-ISSN</b> 2583-1240</li>
                        <li><b>h-index</b> 20</li>
                        <li><b>i10-index</b> 40</li>
                        <li><b>Source</b> Google Scholar</li>
                    </ul>
                    <div class="ugc-hero__cta">
                        <a class="button button--accent" href="{{ $ems }}" target="_blank" rel="noopener noreferrer"><x-homepage.icon name="upload" /> Submit Your Paper</a>
                        <a class="button button--out-orange" href="#calc"><x-homepage.icon name="chart" /> See the Calculation</a>
                    </div>
                </div>
                <div class="if-medal" role="img" aria-label="Impact Factor {{ $impact }}">
                    <div class="if-medal__in"><span>Impact Factor</span><b>{{ $impact }}</b><small>IJSREAT</small></div>
                </div>
            </section>

            <nav class="ugc-jump" aria-label="On this page">
                <a href="#current">Citation profile</a>
                <a href="#meaning">What it means</a>
                <a href="#calc">2026 indicator</a>
                <a href="#ratio">Historical ratio</a>
                <a href="#metrics">Other metrics</a>
                <a href="#verify">How to verify</a>
                <a href="#cite">Responsible reporting</a>
                <a href="#faq">FAQ</a>
            </nav>

            {{-- Profile --}}
            <section id="current" class="ugc-sec sec-anchor" aria-labelledby="if-h1">
                <p class="ugc-step">The figures</p>
                <h2 id="if-h1">IJSREAT Google Scholar Citation Profile</h2>
                <p class="ugc-lead">The following figures were supplied for the IJSREAT citation profile and should be checked against the journal’s official Google Scholar profile before publication.</p>
                <div class="if-kpis">
                    @foreach ($kpis as [$label, $value, $note])
                        <div class="if-kpi"><small>{{ $label }}</small><b>{{ $value }}</b><span>{{ $note }}</span></div>
                    @endforeach
                </div>
                <div class="ugc-split">
                    <figure class="if-pairs" aria-label="Total citations, h-index and i10-index: all years compared with since {{ $window }}">
                        @foreach ($pairs as [$name, $all, $recent])
                            <div class="if-pair">
                                <div class="if-pair__h"><b>{{ $name }}</b></div>
                                <div class="if-pair__row"><span>All years</span><span class="if-pair__track"><span class="if-pair__fill" style="--w:100%"></span></span><b>{{ number_format($all) }}</b></div>
                                <div class="if-pair__row if-pair__row--since"><span>Since {{ $window }}</span><span class="if-pair__track"><span class="if-pair__fill" style="--w:{{ round($recent / $all * 100, 1) }}%"></span></span><b>{{ number_format($recent) }}</b></div>
                            </div>
                        @endforeach
                        <figcaption>Source: Google Scholar figures supplied for IJSREAT.</figcaption>
                    </figure>
                    <div class="tbl-scroll">
                        <table class="if-table if-table--kv">
                            <thead><tr><th>Google Scholar Metric</th><th>All Years</th><th>Since {{ $window }}</th></tr></thead>
                            <tbody>
                                @foreach ($pairs as [$name, $all, $recent])
                                    <tr><td>{{ $name }}</td><td><b>{{ number_format($all) }}</b></td><td><b>{{ number_format($recent) }}</b></td></tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="if-share">
                    <div class="if-share__ring" style="--p: {{ $share }}" role="img" aria-label="{{ $share }} percent of citations since {{ $window }}"><b>{{ $share }}%</b></div>
                    <p><b>{{ $share }}% of IJSREAT’s citations</b> were received since {{ $window }}: 1,420 of 1,953.</p>
                </div>
            </section>

            {{-- Meaning --}}
            <section id="meaning" class="ugc-sec sec-anchor" aria-labelledby="if-h2">
                <p class="ugc-step">Definitions</p>
                <h2 id="if-h2">What These Metrics Mean</h2>
                <div class="bgrid">
                    @foreach ($meaning as [$icon, $title, $text])
                        <div class="bcard2">
                            <span class="ico"><x-homepage.icon :name="$icon" /></span>
                            <h3>{{ $title }}</h3>
                            <p>{{ $text }}</p>
                        </div>
                    @endforeach
                </div>
                <div class="lead-note">
                    <x-homepage.icon name="help" />
                    <span>These metrics describe citation activity and do not independently establish a journal’s two-year impact factor.</span>
                </div>
            </section>

            {{-- 2026 indicator --}}
            <section id="calc" class="ugc-sec sec-anchor" aria-labelledby="if-h3">
                <p class="ugc-step">The method</p>
                <h2 id="if-h3">IJSREAT 2026 Citation Impact Indicator</h2>
                <p class="ugc-lead">A two-year citation impact indicator for 2026 can be calculated using citations received during 2026 by eligible articles published in 2024 and 2025. For this illustration, the publication count is 250 eligible articles across 2024 and 2025 combined.</p>
                <div class="if-quote">
                    <small>Calculation formula</small>
                    <p>2026 citation impact indicator = Citations received during 2026 by eligible 2024–2025 articles ÷ Eligible articles published in 2024–2025.</p>
                </div>
                <div class="two-col">
                    <div class="panel2">
                        <h3><x-homepage.icon name="chart" /> Illustrative calculation</h3>
                        <p>250 eligible articles received 1,000 citations during 2026:</p>
                        <p><b>1,000 ÷ 250 = 4.00</b></p>
                        <p>The resulting citation impact indicator would be 4.00.</p>
                    </div>
                    <div class="panel2">
                        <h3><x-homepage.icon name="help" /> Not a measured value</h3>
                        <p>This is an illustrative scenario, not a measured IJSREAT impact factor. The actual number of citations received during 2026 by eligible 2024–2025 articles has not been supplied.</p>
                    </div>
                </div>
                <h3 class="if-sub">Citation Impact Scenarios</h3>
                <p class="ugc-lead">250 eligible articles were published in 2024–2025, the following table demonstrates how the indicator changes with different citation counts received during 2026.</p>
                <div class="tbl-scroll">
                    <table class="if-table if-table--kv">
                        <thead><tr><th>Citations received in 2026</th><th>Eligible articles 2024–2025</th><th>Indicator</th></tr></thead>
                        <tbody>
                            @foreach ($scenarios as $c)
                                <tr><td>{{ number_format($c) }}</td><td>{{ $articles }}</td><td><b>{{ number_format($c / $articles, 2) }}</b></td></tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>

            {{-- Historical ratio --}}
            <section id="ratio" class="ugc-sec sec-anchor" aria-labelledby="if-h4">
                <p class="ugc-step">Where {{ $impact }} comes from</p>
                <h2 id="if-h4">Historical Citation-to-Publication Ratio</h2>
                <p class="ugc-lead">Using the supplied all-time citation count of 1,953 and the assumed publication count of 250:</p>
                <div class="if-quote">
                    <small>Historical ratio</small>
                    <p>1,953 ÷ 250 = {{ $impact }}</p>
                </div>
                <p class="ugc-lead">This produces a historical citation-to-publication ratio of approximately 7.81 citations per article.</p>
                <div class="lead-note">
                    <x-homepage.icon name="help" />
                    <span>This ratio is not the 2026 two-year impact indicator because the numerator includes citations accumulated across multiple years rather than citations received during 2026 by the specified 2024–2025 publication cohort.</span>
                </div>
            </section>

            {{-- Other metrics --}}
            <section id="metrics" class="ugc-sec sec-anchor" aria-labelledby="if-h5">
                <p class="ugc-step">Context</p>
                <h2 id="if-h5">Understanding Different Journal Metrics</h2>
                <p class="ugc-lead">Journal-level metrics may differ because they use different databases, publication windows, document types, and counting methods.</p>
                <div class="bgrid">
                    @foreach ($others as [$icon, $title, $text])
                        <div class="bcard2">
                            <span class="ico"><x-homepage.icon :name="$icon" /></span>
                            <h3>{{ $title }}</h3>
                            <p>{{ $text }}</p>
                        </div>
                    @endforeach
                </div>
                <div class="lead-note">
                    <x-homepage.icon name="shield" />
                    <span>These metrics are not interchangeable. A Google Scholar-based calculation should not be presented as an official Clarivate Journal Impact Factor or Scopus CiteScore.</span>
                </div>
            </section>

            {{-- Verify --}}
            <section id="verify" class="ugc-sec sec-anchor" aria-labelledby="if-h6">
                <p class="ugc-step">For every author</p>
                <h2 id="if-h6">How to Verify IJSREAT’s 2026 Citation Impact</h2>
                <ol class="if-steps">
                    @foreach ($steps as $i => $step)
                        <li><span>{{ $i + 1 }}</span><p>{{ $step }}</p></li>
                    @endforeach
                </ol>
                <div class="lead-note">
                    <x-homepage.icon name="link" />
                    <span>Check IJSREAT’s DOI records on <a href="{{ $crossref }}" target="_blank" rel="noopener">Crossref</a>. Found a mismatch? Write to <a href="mailto:editorinchief@ijsreat.com">editorinchief@ijsreat.com</a> with a screenshot and we will check it.</span>
                </div>
            </section>

            {{-- Reporting --}}
            <section id="cite" class="ugc-sec sec-anchor" aria-labelledby="if-h7">
                <p class="ugc-step">Using the figures</p>
                <h2 id="if-h7">Responsible Reporting of Citation Metrics</h2>
                <p class="ugc-lead">Citation metrics are descriptive indicators and should be considered alongside peer-review procedures, editorial standards, research integrity, indexing status, and article-level evidence.</p>
                <div class="tbl-scroll">
                    <table class="if-table if-table--kv">
                        <tbody>
                            @foreach ($summary as [$label, $value])
                                <tr><td><b>{{ $label }}</b></td><td>{{ $value }}</td></tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="lead-note">
                    <x-homepage.icon name="shield" />
                    <span><b>Important disclaimer:</b> The historical citation-to-publication ratio of 7.81 is not the verified 2026 Journal Impact Factor. A numerical 2026 citation impact indicator should be published only after the relevant citations and eligible publication counts have been verified.</span>
                </div>
            </section>

            {{-- FAQ --}}
            <section id="faq" class="ugc-sec sec-anchor" aria-labelledby="if-h8">
                <p class="ugc-step">Questions</p>
                <h2 id="if-h8">IJSREAT Impact Factor: FAQ</h2>
                <div class="faq-list">
                    @foreach ($faqs as $i => [$q, $a])
                        <details class="faq-item" @if ($i === 0) open @endif>
                            <summary class="faq-q"><span>{{ $q }}</span></summary>
                            <p class="faq-a">{{ $a }}</p>
                        </details>
                    @endforeach
                </div>
            </section>

            <div class="ugc-cta">
                <div><b>e-ISSN 2583-1240</b> <i aria-hidden="true">·</i> Peer-reviewed, open access</div>
                <div class="ugc-cta__btns">
                    <a class="button button--accent" href="{{ $ems }}" target="_blank" rel="noopener noreferrer"><x-homepage.icon name="upload" /> Submit Paper Online</a>
                    <a class="button button--out-orange" href="/call-for-papers"><x-homepage.icon name="megaphone" /> Call for Papers</a>
                </div>
            </div>

            <div class="qlinks">
                <a class="qlink" href="/indexing-and-abstracting"><x-homepage.icon name="globe" /> Indexing &amp; Abstracting</a>
                <a class="qlink" href="/journal-particulars"><x-homepage.icon name="doc" /> Journal Particulars</a>
                <a class="qlink" href="/peer-review-policy"><x-homepage.icon name="eye" /> Peer Review Policy</a>
                <a class="qlink" href="/current-issue"><x-homepage.icon name="journal" /> Current Issue</a>
            </div>
        </div>
    </div>
</div>
@endsection
