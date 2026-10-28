@extends('layouts.app')

@section('meta_title', 'IJSREAT & UGC CARE Guidelines – UGC Suggested Parameters | IJSREAT')
@section('meta_description', 'How the International Journal of Scientific Research in Engineering & Technology (IJSREAT, e-ISSN 2583-1240) answers UGC’s 35 suggested parameters for peer-reviewed journals after the discontinuation of the UGC-CARE list.')

@include('archives.partials.theme')

@php
    $ems = 'https://editorial.fdrpjournals.org/login?journal=2';

    // Journal record: every value is taken from Journal Particulars and Article Processing Charges.
    $record = [
        ['journal', 'Journal name', 'International Journal of Scientific Research in Engineering & Technology', null],
        ['tag', 'Short name', 'IJSREAT', null],
        ['hash', 'e-ISSN', '2583-1240 (Online)', null],
        ['clock', 'Starting year', '2021', null],
        ['building', 'Publisher', 'Fifth Dimension Research Publication (P) Ltd.', null],
        ['user', 'Editor-in-Chief', 'Dr. S. Sivaganesan (Professor & Head)', '/editorial-board'],
        ['calendar', 'Frequency', 'Bi-monthly (6 issues per year), every past issue archived', '/archives'],
        ['lock', 'Access model', 'Open access, free to read and download', '/ethics?target=open-access-policy'],
        ['users', 'Peer review', 'Peer-reviewed, refereed', '/peer-review-policy'],
        ['link', 'DOI', 'Crossref DOI, prefix 10.59256/ijsreat', null],
        ['search', 'Plagiarism screening', 'Every manuscript checked before review', '/ethics?target=plagiarism-policy'],
        ['chart', 'Impact factor', 'Impact Factor 7.812 · Google Scholar h-index 20', '/impact-Factor'],
        ['globe', 'Language', 'English', null],
        ['monitor', 'Publication format', 'Online', null],
    ];

    // UGC’s final suggestive parameters (Annexure-I, public notice of 16 July 2025), answered for IJSREAT.
    // Status: met | partial | none (no published figure) | na (not applicable) | no (not offered).
    $groups = [
        ['Journal Preliminary Criteria', [
            ['1.1', 'Journal Title', 'met', 'International Journal of Scientific Research in Engineering & Technology (IJSREAT), used consistently across the site, the DOI metadata and every issue.', '/journal-particulars'],
            ['1.2', 'ISSN Number', 'met', 'e-ISSN 2583-1240, verifiable on the ISSN Portal.', 'https://portal.issn.org/resource/ISSN/2583-1240'],
            ['1.3', 'Periodicity and Continuity', 'met', 'Bi-monthly, 6 issues per year (Journal Particulars), with every past issue archived and reachable.', '/archives'],
            ['1.4', 'Contact and Publication Details', 'met', 'Published by Fifth Dimension Research Publication (P) Ltd., Ariyalur, Tamil Nadu, with editorinchief@ijsreat.com and +91 9840521421.', '/contact-us'],
            ['1.5', 'Transparent Review Policy', 'met', 'A published peer review policy that explains the process, referees and timelines.', '/peer-review-policy'],
            ['1.6', 'Website on a Certified Domain', 'met', 'An official domain, www.ijsreat.com, served over HTTPS.', null],
            ['1.7', 'Open Access or Subscription-Based Policy', 'met', 'Fully open access, with the article processing charge disclosed before submission.', '/ethics?target=open-access-policy'],
            ['1.8', 'Integration with National/International Repositories', 'partial', 'Articles carry Crossref DOI metadata and are listed by Google Scholar and the services on the Indexing page; a repository policy is published.', '/ethics?target=repository-policy'],
            ['1.9', 'Archival Policy', 'met', 'A published archiving policy, with every issue kept online.', '/ethics?target=archiving-policy'],
        ]],
        ['Editorial Board Criteria', [
            ['2.1', 'Editorial Board Details', 'met', 'Editors are listed with names, designations and affiliations.', '/editorial-board'],
            ['2.2', 'Editorial Board Composition', 'met', 'Board members are drawn from academic institutions across engineering, technology and related fields.', '/editorial-board'],
            ['2.3', 'Efficient Editorial/Review Process', 'met', 'An eight-stage publishing process, from submission and editorial check to decision, revision and publication.', '/journal-publishing-process'],
        ]],
        ['Journal Editorial Policy', [
            ['3.1', 'Aims, Objectives and Scope', 'met', 'Published in full on the Aim & Scope page.', '/aim-and-scope'],
            ['3.2', 'Subject Areas', 'met', 'Subject areas and research topics are listed and searchable.', '/topics'],
            ['3.3', 'Article Processing Charges (APC)', 'met', '₹1200 + 18% GST without DOI or ₹1400 + 18% GST with DOI for Indian authors, $80 USD for international authors, charged after acceptance.', '/article-processing-charges'],
            ['3.4', 'Publishing Timeline', 'met', 'The publishing process is published stage by stage, from submission to publication.', '/journal-publishing-process'],
            ['3.5', 'Acceptance Rate', 'none', 'No acceptance-rate figure is published. It is stated here rather than estimated.', null],
        ]],
        ['Journal Quality Criteria — Content', [
            ['4.1', 'Academic Contribution', 'met', 'Papers are assessed for quality, originality, approach and clarity during review.', '/journal-publishing-process'],
            ['4.2', 'Conformity to Journal Scope', 'met', 'The Editor checks every paper against the aims and scope before review.', '/aim-and-scope'],
        ]],
        ['Journal Standards', [
            ['5.1', 'Bibliographic Data & Literature Citation', 'met', 'A reference style is set out in the Instructions for Authors.', '/instruction-for-author'],
            ['5.2', 'Font & Design', 'met', 'Manuscripts follow the IJSREAT paper template.', '/downloads'],
            ['5.3', 'Infographics & Exhibits', 'met', 'Rules for captions and numbering of figures and tables are published.', '/instruction-for-author'],
            ['5.4', 'Citation Record', 'met', 'Journal-level citation figures are published from Google Scholar: 1,953 citations, h-index 20 and i10-index 40.', '/impact-Factor'],
            ['5.5', 'Print Continuum', 'na', 'Not applicable: IJSREAT is published online only.', null],
            ['5.6', 'Quality of Website', 'met', 'Served over HTTPS, with the current issue and every archive link live.', '/current-issue'],
            ['5.7', 'Multilingual Availability', 'no', 'Not offered: IJSREAT publishes in English.', null],
        ]],
        ['Research Ethics', [
            ['6.1', 'Ethical Guidelines for Authors', 'met', 'Publication ethics aligned with COPE, with duties for authors, editors, reviewers and the publisher.', '/publication-ethics-policy'],
            ['6.2', 'Plagiarism Prevention', 'met', 'Every manuscript is checked for plagiarism; plagiarised papers are rejected.', '/ethics?target=plagiarism-policy'],
            ['6.3', 'Conflict of Interest Disclosure', 'met', 'Submissions must disclose all relationships that could be a conflict of interest.', '/ethics'],
            ['6.4', 'AI Generated Content Policy', 'met', 'A published AI policy requires authors to disclose AI-generated content.', '/ai-policies'],
        ]],
        ['Journal Visibility', [
            ['7.1', 'Impact Factor or Similar Factor (if applicable)', 'met', 'Impact Factor 7.812, with Google Scholar h-index 20 and i10-index 40.', '/impact-Factor'],
            ['7.2', 'Indexation in Reputed Databases', 'partial', 'Listed in Google Scholar and the services on the Indexing page, with Crossref DOIs. Scopus or Web of Science indexing is not claimed.', '/indexing-and-abstracting'],
        ]],
        ['Journal Impact Criteria', [
            ['8.1', 'Self-Citation Score', 'none', 'No self-citation score is published for this journal.', null],
            ['8.2', 'Total Citation Rate', 'met', '1,953 total citations on Google Scholar, 1,420 of them since 2021.', '/impact-Factor'],
            ['8.3', 'Cite Score', 'na', 'Not applicable: CiteScore is a Scopus metric, and Scopus indexing is not claimed.', null],
        ]],
    ];

    $labels = ['met' => 'Met', 'partial' => 'Partial', 'none' => 'Not published', 'na' => 'Not applicable', 'no' => 'Not offered'];
    $all = collect($groups)->flatMap(fn ($g) => $g[1]);
    $count = fn ($s) => $all->where(2, $s)->count();
    $total = $all->count();
    $met = $count('met');
    $pct = round($met / $total * 100);
    $gaps = fn ($s) => $all->where(2, $s)->map(fn ($p) => strtolower($p[1]) . ' (' . $p[0] . ')')->implode(', ');

    $timeline = [
        ['2017 – Apr 2018', 'The UGC-Approved List', 'UGC publishes an approved list of journals for academic credit.'],
        ['May 2018', 'Standing Committee re-evaluation', 'UGC re-evaluates the approved list after complaints about questionable journals and removes thousands of titles.'],
        ['Nov 2018 – Jan 2019', 'UGC-CARE replaces the approved list', 'UGC sets up the Consortium for Academic and Research Ethics (CARE), which maintains the UGC-CARE list.'],
        ['3 Oct 2024', '584th Commission meeting', 'UGC decides to discontinue UGC-CARE listing and to develop suggestive parameters for choosing peer-reviewed journals.'],
        ['10 – 11 Feb 2025', 'Final CARE list and public notice', 'The final UGC-CARE list is published for reference and the discontinuation is announced, with draft parameters open for feedback.'],
        ['24 Jun 2025', '591st Commission meeting', 'UGC approves the final Suggestive Parameters for Peer-Reviewed Journals: 35 parameters in 8 groups.'],
        ['16 Jul 2025', 'Discontinuation confirmed', 'The archived list is kept as a reference resource only; inclusion or exclusion does not imply validation by the Commission.'],
        ['Today', 'Parameters, not lists', 'No UGC journal list exists. Institutions apply the suggestive parameters themselves, which is why this page answers each one.'],
    ];

    $docs = [
        ['Public Notice — CARE Journals', 'https://www.ugc.gov.in/pdfnews/6124898_Public-Notice-CARE-Journals.pdf'],
        ['Final list of UGC-CARE journals', 'https://www.ugc.gov.in/e-book/Final_list_of_UGC-CARE_journals.pdf'],
        ['Public Notice — CARE, 14 January 2019', 'https://www.ugc.gov.in/pdfnews/8378640_Public-Notice-CARE-14-01-2019.pdf'],
        ['Public Notice — CARE', 'https://www.ugc.gov.in/pdfnews/9678711_PUBLIC-NOTICE-CARE.pdf'],
    ];

    $verify = [
        ['hash', 'Verify the ISSN', 'Look up 2583-1240 on the ISSN Portal and confirm it matches the exact journal title.', 'https://portal.issn.org/resource/ISSN/2583-1240', 'ISSN Portal'],
        ['eye', 'Read the review policy', 'A credible journal publishes how review works, who reviews and how long it takes.', '/peer-review-policy', 'Peer Review Policy'],
        ['building', 'Check the publisher', 'A real postal address, a journal email domain and a phone number that answers.', '/journal-particulars', 'Journal Particulars'],
        ['link', 'Resolve a DOI', 'Open any IJSREAT DOI (prefix 10.59256) at doi.org; it should lead to the article on this site.', '/current-issue', 'Current Issue'],
        ['book', 'Open the archive', 'Past issues should exist, open and match the stated frequency.', '/archives', 'Archives'],
        ['coins', 'Find the fee before you submit', 'The charge should be published upfront and never demanded before review.', '/article-processing-charges', 'Charges'],
    ];

    $steps = [
        ['file', 'Prepare', 'Format your manuscript with the Instructions for Authors and the paper template.'],
        ['upload', 'Submit online', 'Register on the Editorial Management System and follow the guided submission.'],
        ['search', 'Screening & review', 'An editorial check for scope and plagiarism, then peer review by subject experts.'],
        ['check', 'Acceptance', 'The article processing charge is paid only after acceptance.'],
        ['journal', 'Publication', 'Your paper is published open access in the next issue, with a Crossref DOI if chosen.'],
    ];

    $faqs = [
        ['Is IJSREAT UGC CARE approved?', 'No journal is on a UGC-CARE list today, because UGC discontinued CARE listing (decided on 3 October 2024 and confirmed on 16 July 2025). IJSREAT follows UGC’s Suggested Parameters for Peer-Reviewed Journals, and this page answers each of the 35 parameters.'],
        ['Which parameters does IJSREAT not fully meet?', 'Partly met: ' . $gaps('partial') . '. No published figure: ' . $gaps('none') . '. Not applicable or not offered: ' . trim($gaps('na') . ', ' . $gaps('no'), ', ') . '.'],
        ['Can I use an IJSREAT paper for promotion, API score or a PhD requirement?', 'That is your institution’s decision. UGC asks higher education institutions to apply the suggestive parameters themselves, and this page is laid out so a committee can check IJSREAT against each one.'],
        ['How much does it cost to publish in IJSREAT?', 'For Indian authors ₹1200 + 18% GST without DOI or ₹1400 + 18% GST with DOI; for international authors $80 USD with DOI. The charge is paid after acceptance.'],
        ['Is IJSREAT indexed in Scopus or Web of Science?', 'Scopus or Web of Science indexing is not claimed. The services that list IJSREAT are on the Indexing & Abstracting page, where each record can be checked.'],
        ['How do I submit my paper?', 'Submit online through the Editorial Management System, or write to editorinchief@ijsreat.com for help.'],
    ];
@endphp

@section('content')
<div class="hp">
    <x-archive.pageband title="IJSREAT and UGC CARE Guidelines" :crumbs="['UGC CARE Guidelines' => null]"
        lead="The full IJSREAT journal record, what happened to the UGC-CARE list, and how IJSREAT answers each of UGC’s 35 suggested parameters for peer-reviewed journals.">
        <span class="pbf pbf--cyan"><x-homepage.icon name="hash" /><span>e-ISSN</span><b>2583-1240</b></span>
        <span class="pbf pbf--leaf"><x-homepage.icon name="check" /><span>Parameters met</span><b>{{ $met }} / {{ $total }}</b></span>
    </x-archive.pageband>

    <div class="apage" style="grid-template-columns:1fr">
        <div class="amain">
            {{-- Identity card --}}
            <section class="ugc-hero" aria-label="Journal summary">
                <div class="ugc-hero__b">
                    <p class="ugc-kicker">IJSREAT · UGC Suggested Parameters</p>
                    <h2>International Journal of Scientific Research in Engineering & Technology</h2>
                    <p>A peer-reviewed, refereed, open access journal in scientific research in engineering and technology, published by Fifth Dimension Research Publication since 2021.</p>
                    <ul class="ugc-hero__facts">
                        <li><b>e-ISSN</b> 2583-1240</li>
                        <li><b>DOI prefix</b> 10.59256/ijsreat</li>
                        <li><b>Indian authors</b> ₹1200 + GST</li>
                        <li><b>International authors</b> $80 USD</li>
                    </ul>
                    <div class="ugc-hero__cta">
                        <a class="button button--accent" href="{{ $ems }}" target="_blank" rel="noopener noreferrer"><x-homepage.icon name="upload" /> Submit Your Paper</a>
                        <a class="button button--out-orange" href="#parameters"><x-homepage.icon name="list" /> See the 35 Parameters</a>
                    </div>
                </div>
                <div class="ugc-ring" style="--pct: {{ $pct }}" role="img" aria-label="{{ $met }} of {{ $total }} parameters met in full">
                    <div class="ugc-ring__in"><b>{{ $met }}<small>/{{ $total }}</small></b><span>met in full</span></div>
                </div>
            </section>

            <nav class="ugc-jump" aria-label="On this page">
                <a href="#details">Journal details</a>
                <a href="#timeline">UGC CARE timeline</a>
                <a href="#parameters">35 parameters</a>
                <a href="#verify">Verify a journal</a>
                <a href="#publish">Publish</a>
                <a href="#faq">FAQ</a>
            </nav>

            {{-- Step 1 --}}
            <section id="details" class="ugc-sec sec-anchor" aria-labelledby="ugc-h1">
                <p class="ugc-step">Step 1 · The journal</p>
                <h2 id="ugc-h1">IJSREAT Journal Details</h2>
                <p class="ugc-lead">The record institutions ask for first: identity, ownership, metrics, charges and contact. Following the discontinuation of UGC-CARE journal listing, IJSREAT follows UGC’s Suggested Parameters for Choosing Peer-Reviewed Journals.</p>
                <div class="ugc-split">
                    <dl class="dl ugc-record">
                        @foreach ($record as [$icon, $label, $value, $href])
                            <div>
                                <dt><x-homepage.icon :name="$icon" /> {{ $label }}</dt>
                                <dd>@if ($href)<a href="{{ $href }}">{{ $value }}</a>@else{{ $value }}@endif</dd>
                            </div>
                        @endforeach
                    </dl>
                    <div class="ugc-side">
                        <div class="ugc-card ugc-card--fee">
                            <h3><x-homepage.icon name="coins" /> Publication charge</h3>
                            <p class="ugc-fee"><b>₹1200</b> <span>Indian authors, without DOI + 18% GST</span></p>
                            <p class="ugc-fee"><b>₹1400</b> <span>Indian authors, with DOI + 18% GST</span></p>
                            <p class="ugc-fee"><b>$80</b> <span>International authors, with DOI</span></p>
                            <p class="ugc-note">Charged after acceptance. <a href="/article-processing-charges">Full charge details</a></p>
                        </div>
                        <div class="ugc-card">
                            <h3><x-homepage.icon name="mail" /> Editorial contact</h3>
                            <p><b>Email</b> <a href="mailto:editorinchief@ijsreat.com">editorinchief@ijsreat.com</a></p>
                            <p><b>Mobile</b> <a href="tel:+919840521421">+91 9840521421</a></p>
                            <p><b>Address</b> No: 38D5F, Rajaji Nagar, Ariyalur–621713, Tamil Nadu, India</p>
                        </div>
                    </div>
                </div>
            </section>

            {{-- Step 2 --}}
            <section id="timeline" class="ugc-sec sec-anchor" aria-labelledby="ugc-h2">
                <p class="ugc-step">Step 2 · UGC</p>
                <h2 id="ugc-h2">What Happened to the UGC CARE List</h2>
                <p class="ugc-lead">From the UGC-Approved List to UGC-CARE to suggestive parameters: the dates and what each step means for authors.</p>
                <div class="ugc-stats">
                    <div><b>3 Oct 2024</b><span>CARE listing discontinued (584th meeting)</span></div>
                    <div><b>35</b><span>Suggestive parameters in 8 groups</span></div>
                    <div><b>16 Jul 2025</b><span>Discontinuation confirmed</span></div>
                </div>
                <ol class="ugc-tl">
                    @foreach ($timeline as [$date, $title, $text])
                        <li @class(['is-now' => $loop->last])>
                            <span class="ugc-tl__date">{{ $date }}</span>
                            <div><h3>{{ $title }}</h3><p>{{ $text }}</p></div>
                        </li>
                    @endforeach
                </ol>
                <div class="two-col">
                    <div class="panel2 ugc-before">
                        <h3><x-homepage.icon name="list" /> Before: the CARE list</h3>
                        <ul class="ugc-x">
                            <li>A fixed list decided whether a journal “counted”</li>
                            <li>Journals were added and removed without public reasoning</li>
                            <li>Authors checked a name against a spreadsheet</li>
                            <li>Quality was inferred from membership, not examined</li>
                        </ul>
                    </div>
                    <div class="panel2">
                        <h3><x-homepage.icon name="check" /> Now: suggestive parameters</h3>
                        <ul class="checks">
                            <li>Each journal is assessed against published criteria</li>
                            <li>Transparency and research integrity carry the weight</li>
                            <li>Authors can verify a journal themselves, point by point</li>
                            <li>Evidence is checkable rather than delegated to a list</li>
                        </ul>
                    </div>
                </div>
                <div class="ugc-docs">
                    <h3><x-homepage.icon name="file" /> Official UGC documents</h3>
                    <div class="qlinks">
                        @foreach ($docs as [$label, $url])
                            <a class="qlink" href="{{ $url }}" target="_blank" rel="noopener"><x-homepage.icon name="external" /> {{ $label }}</a>
                        @endforeach
                    </div>
                </div>
            </section>

            {{-- Step 3 --}}
            <section id="parameters" class="ugc-sec sec-anchor" aria-labelledby="ugc-h3" x-data="{ filter: 'all' }">
                <p class="ugc-step">Step 3 · The parameters</p>
                <h2 id="ugc-h3">How IJSREAT Meets UGC’s 35 Suggested Parameters</h2>
                <p class="ugc-lead">The final Annexure-I to the UGC public notice of 16 July 2025, answered one parameter at a time. Where IJSREAT publishes no figure, this page says so instead of inventing one.</p>

                <div class="ugc-filter" role="group" aria-label="Filter parameters">
                    <button type="button" :class="{ 'is-on': filter === 'all' }" @click="filter = 'all'">All <b>{{ $total }}</b></button>
                    @foreach ($labels as $key => $label)
                        @if ($count($key))
                            <button type="button" class="ugc-st--{{ $key }}" :class="{ 'is-on': filter === '{{ $key }}' }" @click="filter = '{{ $key }}'">{{ $label }} <b>{{ $count($key) }}</b></button>
                        @endif
                    @endforeach
                </div>

                <div class="ugc-groups">
                    @foreach ($groups as $gi => [$gname, $items])
                        @php $gmet = collect($items)->where(2, 'met')->count(); @endphp
                        <div class="ugc-group" x-show="filter === 'all' || {{ \Illuminate\Support\Js::from(collect($items)->pluck(2)->unique()->values()) }}.includes(filter)">
                            <div class="ugc-group__head">
                                <span class="ugc-group__n">Group {{ $gi + 1 }}</span>
                                <h3>{{ $gname }}</h3>
                                <span class="ugc-group__score">{{ $gmet }}/{{ count($items) }} met</span>
                            </div>
                            <ul class="ugc-params">
                                @foreach ($items as [$no, $name, $status, $text, $href])
                                    <li class="ugc-param" x-show="filter === 'all' || filter === '{{ $status }}'">
                                        <span class="ugc-param__no">{{ $no }}</span>
                                        <div class="ugc-param__b">
                                            <div class="ugc-param__t"><b>{{ $name }}</b><span class="ugc-badge ugc-st--{{ $status }}">{{ $labels[$status] }}</span></div>
                                            <p>{{ $text }}@if ($href) <a href="{{ $href }}" @if (str_starts_with($href, 'http')) target="_blank" rel="noopener" @endif>Evidence <x-homepage.icon name="arrow" /></a>@endif</p>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            </section>

            {{-- Step 4 --}}
            <section id="verify" class="ugc-sec sec-anchor" aria-labelledby="ugc-h4">
                <p class="ugc-step">For every author</p>
                <h2 id="ugc-h4">No List? Check Any Journal Yourself in Six Steps</h2>
                <p class="ugc-lead">With no UGC list, verification is yours to do. Each step links to where you can check IJSREAT.</p>
                <div class="bgrid">
                    @foreach ($verify as $i => [$icon, $title, $text, $href, $cta])
                        <a class="bcard2 ugc-vcard" href="{{ $href }}" @if (str_starts_with($href, 'http')) target="_blank" rel="noopener" @endif>
                            <span class="ugc-vcard__n">{{ $i + 1 }}</span>
                            <span class="ico"><x-homepage.icon :name="$icon" /></span>
                            <h3>{{ $title }}</h3>
                            <p>{{ $text }}</p>
                            <span class="ugc-vcard__go">{{ $cta }} <x-homepage.icon name="arrow" /></span>
                        </a>
                    @endforeach
                </div>
            </section>

            {{-- Step 5 --}}
            <section id="publish" class="ugc-sec sec-anchor" aria-labelledby="ugc-h5">
                <p class="ugc-step">Publish</p>
                <h2 id="ugc-h5">You Can Publish Your Paper in IJSREAT</h2>
                <p class="ugc-lead">A peer-reviewed, refereed, open access journal with Crossref DOI and a fee you know before you submit.</p>
                <ol class="ugc-steps">
                    @foreach ($steps as $i => [$icon, $title, $text])
                        <li><span class="ugc-steps__ic"><x-homepage.icon :name="$icon" /></span><small>Step {{ $i + 1 }}</small><b>{{ $title }}</b><p>{{ $text }}</p></li>
                    @endforeach
                </ol>
                <div class="ugc-cta">
                    <div><b>₹1200 + GST</b> Indian authors <i aria-hidden="true">·</i> <b>$80 USD</b> International authors</div>
                    <div class="ugc-cta__btns">
                        <a class="button button--accent" href="{{ $ems }}" target="_blank" rel="noopener noreferrer"><x-homepage.icon name="upload" /> Submit Paper Online</a>
                        <a class="button button--out-orange" href="/call-for-papers"><x-homepage.icon name="megaphone" /> Call for Papers</a>
                    </div>
                </div>
            </section>

            {{-- FAQ --}}
            <section id="faq" class="ugc-sec sec-anchor" aria-labelledby="ugc-h6">
                <p class="ugc-step">Questions</p>
                <h2 id="ugc-h6">IJSREAT and UGC CARE: FAQ</h2>
                <div class="faq-list">
                    @foreach ($faqs as $i => [$q, $a])
                        <details class="faq-item" @if ($i === 0) open @endif>
                            <summary class="faq-q"><span>{{ $q }}</span></summary>
                            <p class="faq-a">{{ $a }}</p>
                        </details>
                    @endforeach
                </div>
            </section>

            <div class="qlinks">
                <a class="qlink" href="/journal-particulars"><x-homepage.icon name="doc" /> Journal Particulars</a>
                <a class="qlink" href="/indexing-and-abstracting"><x-homepage.icon name="database" /> Indexing &amp; Abstracting</a>
                <a class="qlink" href="/peer-review-policy"><x-homepage.icon name="eye" /> Peer Review Policy</a>
                <a class="qlink" href="/ethics"><x-homepage.icon name="shield" /> Ethics &amp; Policies</a>
                <a class="qlink" href="/article-processing-charges"><x-homepage.icon name="coins" /> Article Processing Charges</a>
            </div>
        </div>
    </div>
</div>
@endsection
