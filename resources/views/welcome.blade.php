@extends('layouts.app')

@section('meta_title', $title)
@section('meta_description', $metaDescription)

@section('head')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700&family=Poppins:wght@600;700;800&family=Source+Sans+3:wght@400;600;700;800;900&display=swap">
    @vite('resources/css/home.css')
@endsection

@section('site_header')
    <x-homepage.header />
@endsection

@section('site_footer')
    <x-homepage.footer />
@endsection

@use('App\Models\Archive')
@use('Illuminate\Support\Facades\DB')

@php
    $emsUrl = 'https://editorial.fdrpjournals.org/login?journal=2';

    // Same "latest issue" rule as ArchiveController::currentIssue().
    $latestIssue = Archive::query()
        ->select(['year', 'volume', 'issue'])
        ->orderByDesc('year')
        ->orderByDesc('volume')
        ->orderByDesc('issue')
        ->first();

    $issuePapers = collect();
    $issueCount = 0;
    $issueMonth = null;
    $issueUrl = '/current-issue';
    if ($latestIssue) {
        // Raw column values, so the match does not depend on the model's integer casts.
        $issueQuery = Archive::query()->where([
            'year' => $latestIssue->getRawOriginal('year'),
            'volume' => $latestIssue->getRawOriginal('volume'),
            'issue' => $latestIssue->getRawOriginal('issue'),
        ]);
        $issueCount = (clone $issueQuery)->count();
        $issuePapers = (clone $issueQuery)->orderByDesc('paper_id')->limit(5)->get();
        $issueMonth = optional($issuePapers->first())->paper_month;
        $issueUrl = "/current-issue/{$latestIssue->year}/volume-{$latestIssue->volume}/issue-{$latestIssue->issue}";
    }

    // Same query as the former sidebar archive card.
    $recentIssues = Archive::query()
        ->select(['year', 'volume', 'issue'])
        ->groupBy(['year', 'volume', 'issue'])
        ->orderByDesc('year')
        ->orderByDesc('volume')
        ->orderByDesc('issue')
        ->limit(6)
        ->get();

    $latestUpdate = DB::table('latest_update')->first();
    $indexings = DB::table('indexings')->get();
    $blogs = DB::table('blogs')->orderBy('created_at', 'desc')->limit(6)->get(['title', 'url_title', 'category']);


    // Research areas: titles from the IJSREAT topics table (/topics), each linking to its topic page.
    $scopeAreas = [
        ['Artificial Intelligence, Machine Learning, and Deep Learning', 'cpu'],
        ['Data Science, Big Data Analytics, and Cloud Computing', 'database'],
        ['Cybersecurity, Blockchain, and Digital Forensics', 'lock'],
        ['Internet of Things (IoT) and Smart Applications', 'wifi'],
        ['Software Engineering, Agile Development, and Testing', 'code'],
        ['Power Systems and Smart Grids', 'chart'],
        ['Renewable Energy Systems and Microgrids', 'globe'],
        ['Robotics, Control Systems, and Automation', 'robot'],
        ['Embedded Systems and VLSI Design', 'gear'],
        ['Wireless Communication, 5G/6G Networks', 'network'],
        ['Signal, Image, and Speech Processing', 'image'],
        ['Advanced Manufacturing and Industry 4.0', 'blocks'],
        ['Automotive Engineering, Hybrid & Electric Vehicles', 'layers'],
        ['Smart Cities and Sustainable Development', 'building'],
        ['Earthquake Engineering and Structural Dynamics', 'shield'],
        ['Nanotechnology and Nano-Engineered Materials', 'monitor'],
        ['Biomedical Engineering and Healthcare Innovations', 'heart'],
    ];

    $faqs = [
        ['When it was started? | when first issue of the journal was published?', 'It was started in year 2021. IJSREAT is being published by 5th Dimension Research Publication. First Issue: January-February 2021.'],
        ['What is the plagiarism policy', 'We do not accept papers that are having plagiarized contents. Good quality plagiarism software/tool will be used to check similarity that would not be more than 30% including reference section. In the case of exclusion of references, it should be less than 5%.'],
        ['How to submit my Article?', 'By Editorial Management System (EMS) Online submission System. For more details see Guidance for Editorial management System.'],
        ['My paper has been published. Can make any changes now in the paper?', 'Author(s) can make rectification in the final paper but after the final submission to the journal, rectification is not possible.'],
        ['What are the Terms & Conditions of the journal?', 'Please visit journal website. It is available in the “Ethics & Policy” page.'],
    ];

    $journals = [
        ['IJRTMR', 'International Journal of Recent Trends in Multidisciplinary Research', '2583-0368', 'Bimonthly (Feb, Apr, Jun, Aug, Oct, Dec)', 'https://www.ijrtmr.com/'],
        ['INDJEEE', 'Indian Journal of Electrical and Electronics Engineering', '3139-8138', '3 Issues Per Year (Apr, Aug, Dec)', 'https://fdrpjournals.org/indjeee'],
        ['INDJECE', 'Indian Journal of Electronics and Communication Engineering', '3048-6408', '3 Issues Per Year (Apr, Aug, Dec)', 'https://fdrpjournals.org/indjece'],
        ['IJIRE', 'International Journal of Innovative Research in Engineering', '2582-8746', 'Bimonthly (Feb, Apr, Jun, Aug, Oct, Dec)', 'https://www.theijire.com/'],
        ['INDJCST', 'Indian Journal of Computer Science and Technology', '2583-5300', 'Bimonthly(Feb, Apr, Jun, Aug, Oct, Dec)', 'https://www.indjcst.com/'],
        ['INDJCMR', 'Indian Journal of Clinical and Medical Research', 'Applied', 'triannual', 'https://www.fdrpjournals.org/indjcmr'],
        ['INDJCPR', 'Indian Journal of Clinical Pharmacy and Research', 'Applied', 'triannual', 'https://www.fdrpjournals.org/indjcpr'],
    ];
@endphp

@section('content')
<div class="hp">

{{-- ══ HERO ═══════════════════════════════════════════════════════════ --}}
<section class="hero" aria-labelledby="hp-title">
    {{-- Decorative animated background: drifting glows, a slowly panning grid,
         a circuit/network motif with flowing data lines, and rising sparks. --}}
    <div class="hero__bg" aria-hidden="true">
        <span class="hero__glow hero__glow--1"></span>
        <span class="hero__glow hero__glow--2"></span>
        <span class="hero__glow hero__glow--3"></span>
        <span class="hero__grid"></span>
        <svg class="hero__net" viewBox="0 0 1200 600" preserveAspectRatio="xMidYMid slice" focusable="false">
            <g class="hero__net-links">
                <path d="M610 90 L760 150 L905 80 L1060 165 L1180 110"/>
                <path d="M760 150 L820 290 L980 260 L1060 165"/>
                <path d="M820 290 L700 400 L860 470 L980 260 L1130 360"/>
                <path d="M860 470 L1030 520 L1130 360 L1180 230"/>
                <path d="M40 470 L170 520 L300 455 L250 580"/>
                <path d="M170 520 L120 600"/>
            </g>
            <g class="hero__net-flow">
                <path d="M610 90 L760 150 L905 80 L1060 165 L1180 110"/>
                <path style="--d:-3s" d="M820 290 L700 400 L860 470 L980 260 L1130 360"/>
                <path style="--d:-6s" d="M860 470 L1030 520 L1130 360 L1180 230"/>
                <path style="--d:-1.5s" d="M40 470 L170 520 L300 455 L250 580"/>
            </g>
            <g class="hero__net-nodes">
                <circle cx="610" cy="90" r="4"/><circle cx="760" cy="150" r="6" style="--d:-1s"/>
                <circle cx="905" cy="80" r="4" style="--d:-2s"/><circle cx="1060" cy="165" r="7" style="--d:-.5s"/>
                <circle cx="1180" cy="110" r="4" style="--d:-3s"/><circle cx="820" cy="290" r="5" style="--d:-1.6s"/>
                <circle cx="980" cy="260" r="6" style="--d:-2.4s"/><circle cx="700" cy="400" r="4" style="--d:-.8s"/>
                <circle cx="860" cy="470" r="6" style="--d:-3.2s"/><circle cx="1130" cy="360" r="5" style="--d:-1.2s"/>
                <circle cx="1030" cy="520" r="4" style="--d:-2.8s"/><circle cx="1180" cy="230" r="4" style="--d:-.3s"/>
                <circle cx="40" cy="470" r="4" style="--d:-1.9s"/><circle cx="170" cy="520" r="6" style="--d:-.7s"/>
                <circle cx="300" cy="455" r="4" style="--d:-2.6s"/><circle cx="250" cy="580" r="4" style="--d:-1.1s"/>
            </g>
        </svg>
        @foreach ([[6,0,14],[14,-5,18],[23,-9,16],[34,-3,20],[47,-12,17],[58,-7,15],[66,-2,19],[74,-10,16],[83,-4,21],[92,-8,17]] as [$x, $d, $t])
            <span class="hero__spark" style="--x:{{ $x }}%;--d:{{ $d }}s;--t:{{ $t }}s"></span>
        @endforeach
    </div>
    <div class="hero__top">
        <p class="hero__eyebrow">Peer-Reviewed <i><x-homepage.icon name="dot" /></i> Open Access <i><x-homepage.icon name="dot" /></i> <em>Science, Engineering &amp; Technology</em></p>
        <div class="hero__pills">
            <a class="hero__pill" href="/journal-particulars">
                <x-homepage.icon name="book" />
                <span class="hero__pill-b"><small>e-ISSN</small><strong>2583-1240</strong></span>
            </a>
            <a class="hero__pill" href="/journal-particulars">
                <x-homepage.icon name="link" />
                <span class="hero__pill-b"><small>Crossref DOI prefix</small><strong>10.59256/ijsreat</strong></span>
            </a>
            <a class="hero__pill hero__pill--accent" href="/ethics?target=open-access-policy">
                <x-homepage.icon name="lock" />
                <span class="hero__pill-b"><small>Open Access</small><strong>Journal</strong></span>
            </a>
            <a class="hero__pill hero__pill--green" href="/journal-particulars">
                <x-homepage.icon name="calendar" />
                <span class="hero__pill-b"><small>Starting Year</small><strong>2021</strong></span>
            </a>
        </div>
    </div>

    <div class="hero__content">
        <h1 id="hp-title">
            <span class="l1">International Journal</span>
            <span class="l2"><span class="hw-accent">of</span> <span class="hw-brand">Scientific Research</span> <span class="hw-accent">in</span> <span class="hw-green">Engineering &amp; Technology</span></span>
        </h1>
        <p class="hero__tagline">e-ISSN:2583-1240, Follows UGC-CARE Guidelines</p>
        <p class="hero__lead">An International Scholarly Open Access Journal, Peer-reviewed, Refereed Journal. High Impact factor, Bi-Monthly, Multidisciplinary Journal.</p>

        <div class="hero__facts">
            <span class="pbf pbf--cyan"><x-homepage.icon name="building" /><span>Starting Year</span><b>2021</b></span>
            <span class="pbf pbf--orange"><x-homepage.icon name="calendar" /><span>Frequency</span><b>Bi-Monthly</b></span>
            <span class="pbf pbf--leaf"><x-homepage.icon name="lock" /><span>Access</span><b>Open Access</b></span>
            <span class="pbf"><x-homepage.icon name="doc" /><span>e-ISSN</span><b>2583-1240</b></span>
            <span class="pbf pbf--red"><x-homepage.icon name="award" /><span>Publisher</span><b>Fifth Dimension Research Publication</b></span>
        </div>

        <div class="hero__actions">
            <a class="button button--solid" href="{{ $emsUrl }}" target="_blank" rel="noopener noreferrer"><x-homepage.icon name="send" /> Submit Article</a>
            <a class="button button--out-green" href="/current-issue"><x-homepage.icon name="journal" /> View Current Issue</a>
            <a class="button button--out-orange" href="/call-for-papers">Call for Papers</a>
        </div>
    </div>

    <div class="hero__art">
        <img src="/HomeBanner.webp" alt="International Journal of Scientific Research in Engineering & Technology banner image" width="330" height="225" loading="eager">
        <p class="hero__caption">Empowering researchers. Advancing technology. Publishing excellence.</p>
    </div>

    <div class="hero__aside">
        <aside class="glance" aria-label="Journal at a glance">
            <h2 class="glance__title">Journal at a Glance</h2>
            <p class="glance__sub">Key information about IJSREAT</p>
            <div class="glance__rows">
                <div class="glance__row"><x-homepage.icon name="doc" /><span>e-ISSN</span><strong>2583-1240</strong></div>
                <div class="glance__row"><x-homepage.icon name="calendar" /><span>Frequency</span><strong>Bi-Monthly</strong></div>
                <div class="glance__row"><x-homepage.icon name="lock" /><span>Access</span><strong>Open Access</strong></div>
                <div class="glance__row"><x-homepage.icon name="users" /><span>Peer Review</span><strong>Peer-reviewed, Refereed</strong></div>
                <div class="glance__row"><x-homepage.icon name="building" /><span>Starting Year</span><strong>2021</strong></div>
                <div class="glance__row"><x-homepage.icon name="link" /><span>DOI Prefix</span><strong>10.59256/ijsreat</strong></div>
                <div class="glance__row"><x-homepage.icon name="globe" /><span>Language</span><strong>English</strong></div>
                @if ($latestIssue)
                    <div class="glance__row"><x-homepage.icon name="journal" /><span>Current Issue</span><a href="{{ $issueUrl }}">Vol {{ $latestIssue->volume }}, Issue {{ $latestIssue->issue }} ({{ $latestIssue->year }}) <x-homepage.icon name="arrow" /></a></div>
                @endif
            </div>
            <a class="glance__cta" href="{{ $emsUrl }}" target="_blank" rel="noopener noreferrer">Submit Your Manuscript <x-homepage.icon name="arrow" /></a>
            <div class="glance__floats" aria-hidden="true">
                <span class="gfloat gfloat--accent"><x-homepage.icon name="lock" /> Open Access</span>
                <span class="gfloat"><x-homepage.icon name="layers" /> Crossref DOI</span>
            </div>
        </aside>
    </div>

    <div class="hero__assure" aria-label="Why authors publish with IJSREAT">
        <div class="assure assure--cyan">
            <span class="assure__ico"><x-homepage.icon name="shield" /></span>
            <div><strong>Peer-reviewed</strong><span class="assure__tx">Rigorous review before publication</span></div>
        </div>
        <div class="assure assure--orange">
            <span class="assure__ico"><x-homepage.icon name="link" /></span>
            <div><strong>Crossref DOI</strong><span class="assure__tx">Prefix 10.59256/ijsreat</span></div>
        </div>
        <div class="assure assure--leaf">
            <span class="assure__ico"><x-homepage.icon name="lock" /></span>
            <div><strong>Open Access</strong><span class="assure__tx">CC BY 4.0, full PDF download</span></div>
        </div>
        <div class="assure assure--accent">
            <span class="assure__ico"><x-homepage.icon name="search" /></span>
            <div><strong>Plagiarism Checked</strong><span class="assure__tx">By the leading plagiarism checker</span></div>
        </div>
    </div>
</section>

{{-- ══ LATEST UPDATES (latest_update table) ═══════════════════════════ --}}
@if ($latestUpdate)
    <section class="ribbon" aria-label="Latest updates">
        <div class="ribbon__in">
            <span class="ribbon__label"><x-homepage.icon name="megaphone" /> Latest Updates</span>
            <div class="ribbon__links">
                @foreach ([1, 2, 3] as $n)
                    @if (!empty($latestUpdate->{"input{$n}_data"}))
                        <a href="{{ $latestUpdate->{"input{$n}_link"} ?? '#' }}">{{ $latestUpdate->{"input{$n}_data"} }}</a>
                    @endif
                @endforeach
            </div>
        </div>
    </section>
@endif

{{-- ══ FACT STRIP ═════════════════════════════════════════════════════ --}}
<section class="strip" aria-label="Journal facts">
    <div class="strip__item">
        <span class="ico"><x-homepage.icon name="building" /></span>
        <div><strong>2021</strong><span>Starting Year</span></div>
    </div>
    <div class="strip__item">
        <span class="ico ico--cyan"><x-homepage.icon name="calendar" /></span>
        <div><strong>Bi-Monthly</strong><span>6 Issues Per Year</span></div>
    </div>
    <div class="strip__item">
        <span class="ico ico--leaf"><x-homepage.icon name="lock" /></span>
        <div><strong>CC BY 4.0</strong><span>Open Access Licence</span></div>
    </div>
    <div class="strip__item">
        <span class="ico ico--orange"><x-homepage.icon name="link" /></span>
        <div><strong>Crossref</strong><span>DOI for published articles</span></div>
    </div>
</section>

{{-- ══ FIVE QUESTIONS ═════════════════════════════════════════════════ --}}
<section class="section">
    <div class="section__head">
        <h2 class="rule-title">Five Questions, Answered</h2>
        <p>What a researcher needs to know before submitting, each answer links to the page with the details</p>
    </div>
    <div class="q5-grid">
        <a class="q5" href="/aim-and-scope">
            <span class="q5__n">1</span>
            <div class="q5__b">
                <h3>What does IJSREAT publish?</h3>
                <p>Research that advances knowledge across diverse fields of Science, Engineering, and Technology, with a focus on the latest advancements in engineering and technology.</p>
                <span class="q5__go">Aim &amp; scope <x-homepage.icon name="arrow" /></span>
            </div>
        </a>
        <a class="q5" href="/peer-review-policy">
            <span class="q5__n">2</span>
            <div class="q5__b">
                <h3>How are papers reviewed?</h3>
                <p>Papers are refereed by expert reviewers suggested by the editorial board, and all publication decisions are made by the Editor-in-Chief on the basis of the reviewers' reports.</p>
                <span class="q5__go">Peer review policy <x-homepage.icon name="arrow" /></span>
            </div>
        </a>
        <a class="q5" href="/article-processing-charges">
            <span class="q5__n">3</span>
            <div class="q5__b">
                <h3>What does publication cost?</h3>
                <p><b>1200 INR + 18% GST</b> without DOI or <b>1400 INR + 18% GST</b> with DOI for Indian authors, <b>$80 USD</b> for other authors, charged only after acceptance.</p>
                <span class="q5__go">Article processing charges <x-homepage.icon name="arrow" /></span>
            </div>
        </a>
        <a class="q5" href="/guidance-for-ems">
            <span class="q5__n">4</span>
            <div class="q5__b">
                <h3>How do I submit my article?</h3>
                <p>Through the Editorial Management System (EMS) online submission system: register for an account, then follow the guided submission steps.</p>
                <span class="q5__go">Guidance for EMS <x-homepage.icon name="arrow" /></span>
            </div>
        </a>
        <a class="q5" href="/archives">
            <span class="q5__n">5</span>
            <div class="q5__b">
                <h3>Where is published research available?</h3>
                <p>All accepted papers are open and accessible with a full PDF download, and a <b>CrossRef DOI</b> is assigned to research articles.</p>
                <span class="q5__go">Browse the archives <x-homepage.icon name="arrow" /></span>
            </div>
        </a>
    </div>
</section>

{{-- ══ CURRENT ISSUE + LATEST ARTICLES ════════════════════════════════ --}}
<section class="section section--flush">
    <div class="issue-row">
        <div class="issue-col">
            <div class="panel">
                <div class="panel__head">
                    <h2 class="rule-title">Current Issue</h2>
                    <a class="panel__more" href="/archives">View All Issues <x-homepage.icon name="arrow" /></a>
                </div>
                <div class="issue-body">
                    <div class="issue-cover" aria-hidden="true">
                        <b>IJSREAT</b>
                        <small>International Journal of Scientific Research in Engineering & Technology</small>
                        <div class="issue-cover__rule"></div>
                        <i>e-ISSN 2583-1240<br>Bi-Monthly<br>Open Access</i>
                        <span class="issue-cover__tag">Since 2021</span>
                    </div>
                    <div class="issue-info">
                        @if ($latestIssue)
                            <h3>Volume {{ $latestIssue->volume }}, Issue {{ $latestIssue->issue }} ({{ $latestIssue->year }})</h3>
                            @if ($issueMonth)
                                <p class="issue-date">{{ $issueMonth }} {{ $latestIssue->year }}</p>
                            @endif
                            <p>{{ $issueCount }} {{ \Illuminate\Support\Str::plural('article', $issueCount) }} published in this issue. Every article is open access with a full PDF download.</p>
                        @else
                            <h3>Current Volume &amp; Issue</h3>
                            <p>Browse the latest research published in IJSREAT.</p>
                        @endif
                        <div class="issue-actions">
                            <a class="button button--solid" href="/current-issue">Read Current Issue</a>
                            <a class="button button--ghost" href="/archives">All Issues</a>
                        </div>
                    </div>
                </div>
                @if ($recentIssues->isNotEmpty())
                    <div class="issue-past">
                        <p class="issue-past__h">Recent issues</p>
                        <div class="chips">
                            @foreach ($recentIssues as $entry)
                                <a class="chip" href="/archives/{{ $entry->year }}/volume-{{ $entry->volume }}/issue-{{ $entry->issue }}">{{ $entry->year }} · Vol {{ $entry->volume }} · Issue {{ $entry->issue }}</a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <div class="panel panel--fill">
                <div class="panel__head">
                    <h2 class="rule-title">How Publishing Works</h2>
                    <a class="panel__more" href="/journal-publishing-process">Publishing Process <x-homepage.icon name="arrow" /></a>
                </div>
                <ol class="pflow">
                    <li class="pflow__s pflow__s--1"><span class="pflow__ic"><x-homepage.icon name="send" /></span><div><b>Submission</b><small>Submit anytime with our <a href="{{ $emsUrl }}" target="_blank" rel="noopener noreferrer">editorial management system</a></small></div></li>
                    <li class="pflow__s pflow__s--2"><span class="pflow__ic"><x-homepage.icon name="search" /></span><div><b>Initial Review</b><small>Quick quality check completed within 12 hours of submission</small></div></li>
                    <li class="pflow__s pflow__s--3"><span class="pflow__ic"><x-homepage.icon name="eye" /></span><div><b>Peer Review</b><small>Expert reviewers evaluate originality and significance in 2–7 days</small></div></li>
                    <li class="pflow__s pflow__s--4"><span class="pflow__ic"><x-homepage.icon name="check" /></span><div><b>Decision Notification</b><small>Acceptance, revision, or rejection notification within 3–7 days</small></div></li>
                    <li class="pflow__s pflow__s--5"><span class="pflow__ic"><x-homepage.icon name="award" /></span><div><b>Publication &amp; Certification</b><small>Published with open access; authors receive digital certificates</small></div></li>
                </ol>
                <div class="pfacts">
                    <div><b>2583-1240</b><span>e-ISSN</span></div>
                    <div><b>10.59256</b><span>DOI prefix</span></div>
                    <div><b>2021</b><span>Since</span></div>
                    <div><b>CC BY 4.0</b><span>Licence</span></div>
                </div>
            </div>
        </div>

        <div class="issue-col">
            <div class="panel">
                <div class="panel__head">
                    <h2 class="rule-title">Latest Articles</h2>
                    <a class="panel__more" href="/current-issue">Full Issue <x-homepage.icon name="arrow" /></a>
                </div>
                @if ($issuePapers->isEmpty())
                    <p class="empty">No publications available</p>
                @else
                    <div class="art-list">
                        @foreach ($issuePapers as $paper)
                            <a class="art" href="{{ $paper->archive_url }}">
                                <span>
                                    <span class="art__t">{{ $paper->paper_title }}</span>
                                    <span class="art__m">
                                        @if ($paper->paper_articletype)<span class="art__tag">{{ $paper->paper_articletype }}</span>@endif
                                        {{ \Illuminate\Support\Str::limit(implode(', ', $paper->authors), 90) }}
                                    </span>
                                </span>
                                <span class="art__go" aria-hidden="true"><x-homepage.icon name="chevron" /></span>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="panel panel--fill">
                <div class="panel__head">
                    <h2 class="rule-title">Policies &amp; Resources</h2>
                    <a class="panel__more" href="/ethics">Ethics &amp; Policies <x-homepage.icon name="arrow" /></a>
                </div>
                <div class="art-list">
                    @foreach ([
                        ['Publication Ethics & Malpractice Statement', 'Publication ethics policy of the journal', '/publication-ethics-policy'],
                        ['Peer Review Policy', 'How submitted manuscripts are reviewed', '/peer-review-policy'],
                        ['Plagiarism Policy', 'Similarity limits and how plagiarism is handled', '/ethics?target=plagiarism-policy'],
                        ['Open Access Policy', 'Free access to all published articles', '/ethics?target=open-access-policy'],
                        ['Copyright, Grants and Ownership Declaration', 'Copyright and ownership of published work', '/ethics?target=copyright-ownership'],
                        ['Article Withdraw Policy', 'Withdrawal of submitted articles', '/ethics?target=article-withdrawal'],
                        ['Editorial Policies', 'Editorial policies of the journal', '/ethics?target=editorial-policies'],
                        ['Cross Mark Policy', 'Crossmark and post-publication updates', '/cross-mark-policy'],
                        ['AI Policies', 'Use of AI tools in submitted work', '/ai-policies'],
                    ] as [$t, $m, $href])
                        <a class="art" href="{{ $href }}">
                            <span><span class="art__t">{{ $t }}</span><span class="art__m">{{ $m }}</span></span>
                            <span class="art__go" aria-hidden="true"><x-homepage.icon name="chevron" /></span>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ══ ABOUT ══════════════════════════════════════════════════════════ --}}
<section class="section section--soft">
    <div class="about-row">
        <div>
            <h2 class="rule-title">Best Sites to Publish Research Papers</h2>
            <p class="about__sub">Empowering researchers. Advancing technology. Publishing excellence.</p>
            <p>Welcome To IJSREAT – your destination for top research paper publication sites, premier journal publication sites, and the best research paper publishing sites trusted by academicians worldwide. The International Journal of Scientific Research in Engineering & Technology (e-ISSN: 2583-1240) is a bi-monthly, international peer-reviewed, open-access, and multidisciplinary online journal designed for the enhancement of research across various disciplines of Science, Engineering & Technologies.</p>
            <p>As a leading research paper publication website and one of the most reputable sites to publish research papers globally, IJSREAT welcomes new ideas from academicians, educationists, engineers, and corporate leaders. We provide a scholarly, open-access and peer-reviewed platform for the global academic and student community to submit original research and applications related to engineering and innovative technologies.</p>
            <a class="button button--ghost" href="/aim-and-scope">Read More About IJSREAT <x-homepage.icon name="arrow" /></a>
        </div>
        <div class="grid grid--2">
            @foreach ([
                ['Access', 'Immediate global reach for your research, maximizing discoverability among the top research paper publication sites.', 'lock', ''],
                ['Impact', 'Demonstrate the real-world application of your work, reaching new audiences, policy makers, and leaders in your field.', 'eye', 'ico--orange'],
                ['Quality', 'All journals listed are peer-reviewed and adhere to COPE’s Best Practice Guidelines for publication ethics.', 'award', 'ico--cyan'],
                ['Flexibility', 'Your work is published under Creative Commons Attribution 4.0 (CC BY 4.0.), allowing reuse and broad dissemination.', 'download', 'ico--leaf'],
                ['Security', 'All published content is digitally and permanently preserved, ensuring lasting academic value.', 'shield', 'ico--accent'],
                ['Visibility', 'Your work’s enhanced metadata ensures indexing across the best sites to publish research papers.', 'search', 'ico--orange'],
                ['Support', 'Editorial experts guide you at every step of the publishing process.', 'help', 'ico--red'],
            ] as [$t, $d, $icon, $tone])
                <div class="feat">
                    <span class="ico {{ $tone }}"><x-homepage.icon :name="$icon" /></span>
                    <div><h3>{{ $t }}</h3><p>{{ $d }}</p></div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ══ RESEARCH AREAS (aim & scope) ═══════════════════════════════════ --}}
<section class="section bg-grid" aria-labelledby="hp-areas">
    <div class="section__head section__head--row">
        <div>
            <h2 class="rule-title" id="hp-areas">Research Areas We Publish</h2>
            <p>IJSREAT publishes research across diverse fields of Science, Engineering, and Technology, including but not limited to:</p>
        </div>
        <a class="hlink" href="/topics">All topics <x-homepage.icon name="arrow" /></a>
    </div>
    <ul class="tiles">
        <li><a class="tile tile--more" href="/aim-and-scope"><span class="tic"><x-homepage.icon name="globe" /></span><span class="tile__b"><strong>Aim &amp; Scope</strong><small>A platform for scientists and academicians to share new issues and developments in different areas of engineering and technologies</small></span></a></li>
        @foreach ($scopeAreas as $i => [$area, $icon])
            <li><a class="tile c{{ ($i % 5) + 1 }}" href="/topics/{{ \Illuminate\Support\Str::slug($area, '-') }}"><span class="tic"><x-homepage.icon :name="$icon" /></span><span class="tile__b"><strong>{{ $area }}</strong></span></a></li>
        @endforeach
    </ul>
</section>

{{-- ══ PUBLICATION PROCESS ════════════════════════════════════════════ --}}
<section class="section">
    <div class="section__head">
        <h2 class="rule-title">Journal Publishing Process</h2>
        <p>Our journals offer a Rapid Publication Process that allows an article to be published online</p>
    </div>
    <div class="steps">
        @foreach ([
            ['Submit', 'Through the Editorial Management System (EMS), with a guided 7-step submission'],
            ['Editorial check', 'Fit with aims and scope, plagiarism check and peer review'],
            ['Decision', 'Accept, minor or major revisions, or reject; the final decision lies with the Editor'],
            ['Revisions', '1–2 weeks for minor revisions, 2–4 weeks for major revisions'],
            ['Acceptance', 'Processed by our in-house team for completeness and permissions'],
            ['Typesetting', 'Copyright Transfer Agreement signed and applicable APC paid'],
            ['Author proofs', 'Proofreading, layout editing and galley correction'],
            ['Publication', 'Pagination, volume and issue details added on our online platform'],
        ] as $i => [$t, $d])
            <div class="step"><span class="step__n">{{ $i + 1 }}</span><div><h3>{{ $t }}</h3><p>{{ $d }}</p></div></div>
        @endforeach
    </div>
</section>

<section class="section section--flush">
    <div class="accept">
        <x-homepage.icon name="clock" />
        <div>
            <h2>Acceptance and Publication Time</h2>
            <ul>
                <li>The response will be given within 12 hours.</li>
                <li>The paper will be reviewed within Two days.</li>
                <li>The author will get their Acceptance/Rejection Notification within three days of submitting the paper.</li>
                <li>All Authors will get a Soft copy of the certificate, acceptance letter, and reviewer evaluation grading.</li>
            </ul>
        </div>
    </div>
</section>

{{-- ══ WHY PUBLISH ════════════════════════════════════════════════════ --}}
<section class="band">
    <div class="band__in">
        <div class="band__head">
            <h2 class="rule-title">Why Choose IJSREAT Among Best Research Paper Publishing Sites India</h2>
            <p>We combine academic excellence with efficient processes to maximize your research impact beyond academia</p>
        </div>
        <div class="band__grid">
            @foreach ([
                ['Research Paper Submission Sites', 'Easy, fast, and transparent online paper submission through our advanced editorial management system.', 'users'],
                ['Journal Publication Sites with Impact:', 'Manuscripts are rigorously peer-reviewed and indexed in major directories like DOAJ, boosting visibility and credibility.', 'clock'],
                ['Best Journal to Publish Research Paper', 'Recognized for strict plagiarism policies, a reputed editorial board, and rapid or fast-track publication.', 'globe'],
                ['Research Paper Publishing Sites India', 'Join authors from across India and the world in sharing impactful research through IJSREAT’s streamlined processes.', 'layers'],
                ['High Indexing and Visibility', 'High indexing and reputation among best journal to publish research paper', 'search'],
                ['COPE Guidelines', 'COPE-compliant publication ethics', 'shield'],
                ['Online Submission', 'Rapid and transparent research paper submission sites', 'upload'],
            ] as [$t, $d, $icon])
                <div class="bcard">
                    <span class="ico"><x-homepage.icon :name="$icon" /></span>
                    <h3>{{ $t }}</h3>
                    <p>{{ $d }}</p>
                </div>
            @endforeach
            <div class="bcard bcard--cta">
                <span class="ico"><x-homepage.icon name="send" /></span>
                <h3>Ready to Publish your Research?</h3>
                <p>Article processing charges are payable only after the acceptance of the manuscript.</p>
                <a class="bcard__cta" href="{{ $emsUrl }}" target="_blank" rel="noopener noreferrer">Submit Paper <x-homepage.icon name="arrow" /></a>
            </div>
        </div>
        <div class="band__stats">
            <div class="bstat"><strong>2021</strong><span>Starting Year</span></div>
            <div class="bstat"><strong>6 / Year</strong><span>Issues</span></div>
            <div class="bstat"><strong>Peer</strong><span>Reviewed</span></div>
            <div class="bstat"><strong>2583-1240</strong><span>e-ISSN</span></div>
        </div>
    </div>
</section>

{{-- ══ ARTICLE PROCESSING CHARGES ═════════════════════════════════════ --}}
<section class="section" aria-labelledby="hp-apc">
    <div class="section__head">
        <h2 class="rule-title" id="hp-apc">Article Processing Charges</h2>
        <p>A minimal fee for Case Report, Original Article and Review Article, charged after the acceptance of the manuscript</p>
    </div>
    <div class="price">
        <div class="pcard pcard--in">
            <span class="pcard__who">For Indian authors</span>
            <div class="pcard__rows">
                <div class="pcard__row"><span>Without DOI</span><p class="pcard__amt">₹1200 <small>+ 18% GST</small></p></div>
                <div class="pcard__row"><span>With DOI</span><p class="pcard__amt">₹1400 <small>+ 18% GST</small></p></div>
            </div>
            <a class="button button--accent" href="{{ $emsUrl }}" target="_blank" rel="noopener noreferrer">Submit Article <x-homepage.icon name="arrow" /></a>
        </div>
        <div class="pcard pcard--fn">
            <span class="pcard__who">For other than Indian authors</span>
            <div class="pcard__rows">
                <div class="pcard__row"><span>With DOI</span><p class="pcard__amt">$80 <small>USD</small></p></div>
            </div>
            <p class="pcard__note">A 50% waiver is available for eligible authors, as set out in the Waivers Policy.</p>
            <a class="button button--solid" href="/article-processing-charges">Full charge details <x-homepage.icon name="arrow" /></a>
        </div>
        <div class="pcard pcard--incl">
            <span class="pcard__who">Included in the charge</span>
            <ul class="incl">
                <li><span class="tic tic--sm"><x-homepage.icon name="monitor" /></span>Journal Hosting System</li>
                <li><span class="tic tic--sm"><x-homepage.icon name="gear" /></span>Editorial management System</li>
                <li><span class="tic tic--sm"><x-homepage.icon name="edit" /></span>In-house copyediting and linguistic support</li>
                <li><span class="tic tic--sm"><x-homepage.icon name="file" /></span>Pagination &amp; typesetting</li>
                <li><span class="tic tic--sm"><x-homepage.icon name="database" /></span>Archiving in internationally recognized open access repositories</li>
            </ul>
        </div>
    </div>
</section>

{{-- ══ INDEXING, DOI & POLICIES ═══════════════════════════════════════ --}}
<section class="section section--soft">
    <div class="section__head section__head--row">
        <div>
            <h2 class="rule-title">Indexing, DOI &amp; Transparency</h2>
            <p>Where IJSREAT is indexed, and the policies behind every published article</p>
        </div>
        <a class="hlink" href="/indexing-and-abstracting">Indexing &amp; Abstracting <x-homepage.icon name="arrow" /></a>
    </div>
    <div class="grid grid--6">
        <a class="icard" href="/journal-particulars"><span class="ico"><x-homepage.icon name="link" /></span><span class="icard__b"><strong>CrossRef DOI</strong><span>Prefix 10.59256/ijsreat</span></span></a>
        <a class="icard" href="/indexing-and-abstracting"><span class="ico ico--cyan"><x-homepage.icon name="search" /></span><span class="icard__b"><strong>Indexing &amp; Abstracting</strong><span>Discovery and visibility</span></span></a>
        <a class="icard" href="/impact-Factor"><span class="ico ico--accent"><x-homepage.icon name="chart" /></span><span class="icard__b"><strong>Impact Factor</strong><span>Impact factor details</span></span></a>
        <a class="icard" href="/publication-ethics-policy"><span class="ico ico--leaf"><x-homepage.icon name="shield" /></span><span class="icard__b"><strong>Publication Ethics</strong><span>Ethics &amp; malpractice statement</span></span></a>
        <a class="icard" href="/peer-review-policy"><span class="ico ico--orange"><x-homepage.icon name="users" /></span><span class="icard__b"><strong>Peer Review Policy</strong><span>Review process</span></span></a>
        <a class="icard" href="/editorial-board"><span class="ico ico--red"><x-homepage.icon name="award" /></span><span class="icard__b"><strong>Editorial Board</strong><span>Editors and reviewers</span></span></a>
    </div>
    @if ($indexings->isNotEmpty())
        <x-homepage.logo-marquee :partners="$indexings" />
    @endif
</section>

{{-- ══ EDITORIAL MANAGEMENT ═══════════════════════════════════════════ --}}
<section class="section">
    <div class="section__head">
        <h2 class="rule-title">Advanced Editorial Management</h2>
        <p>Our state-of-the-art platform provides complete transparency and control throughout the publication process</p>
    </div>
    <div class="ecards">
        @foreach ([
            ['Real-time Tracking', "Monitor your submission's progress through every stage of the review process.", ['Article status updates', 'Review progress tracking', 'Task completion alerts'], 'eye', ''],
            ['Automated Documents', 'Instant generation of all necessary publication documents.', ['Automated acceptance letters', 'Simplified copyright forms', 'Instant publication certificates'], 'file', 'ecard--b'],
            ['Easy Access', 'All your publication materials available in one place.', ['Published PDF downloads', 'Certificate access', 'Reviewer reports'], 'lock', 'ecard--c'],
        ] as [$t, $d, $points, $icon, $tone])
            <div class="ecard {{ $tone }}">
                <span class="ecard__ic"><x-homepage.icon :name="$icon" /></span>
                <h3>{{ $t }}</h3>
                <p>{{ $d }}</p>
                <ul class="ticks">
                    @foreach ($points as $pt)<li>{{ $pt }}</li>@endforeach
                </ul>
            </div>
        @endforeach
    </div>
</section>

{{-- ══ FOR AUTHORS ════════════════════════════════════════════════════ --}}
<section class="section section--flush">
    <div class="section__head">
        <h2 class="rule-title">For Authors</h2>
        <p>Guidelines, charges and tools for a smooth publication experience</p>
    </div>
    <div class="grid grid--4">
        @foreach ([
            ['Instruction for Authors', 'Manuscript preparation guidelines', '/instruction-for-author', 'doc', ''],
            ['Article Processing Charges', 'Charged after acceptance', '/article-processing-charges', 'coins', 'ico--accent'],
            ['Guidance for EMS', 'Editorial Management System', '/guidance-for-ems', 'journal', 'ico--cyan'],
            ['Article Status', 'Check the status of your paper', '/paper-status', 'check', 'ico--leaf'],
            ['Online Article Submission', 'Submit through the EMS', $emsUrl, 'upload', 'ico--orange'],
            ['Topics', 'Subjects covered by the journal', '/topics', 'list', ''],
            ['Downloads', 'Templates and forms', '/downloads', 'download', 'ico--accent'],
            ['Archives', 'All published issues', '/archives', 'layers', 'ico--red'],
        ] as [$t, $d, $href, $icon, $tone])
            <a class="acard" href="{{ $href }}" @if (str_starts_with($href, 'http')) target="_blank" rel="noopener noreferrer" @endif>
                <span class="ico {{ $tone }}"><x-homepage.icon :name="$icon" /></span>
                <span class="acard__b"><strong>{{ $t }}</strong><span>{{ $d }}</span></span>
                <span class="acard__go" aria-hidden="true"><x-homepage.icon name="chevron" /></span>
            </a>
        @endforeach
    </div>
</section>

{{-- ══ CALL FOR PAPERS ════════════════════════════════════════════════ --}}
<section class="section section--flush">
    <div class="cfp-row">
        <div class="cfp">
            <x-homepage.icon name="megaphone" />
            <div class="cfp__b">
                <h2>Call for Papers</h2>
                <p>Papers for the regular issues of the Journal can be submitted around the year. After the final acceptance of the paper, it will immediately be published online.</p>
            </div>
            <a class="button button--accent" href="/call-for-papers">Call for Paper <x-homepage.icon name="arrow" /></a>
        </div>
        <div class="dates">
            <span class="ico"><x-homepage.icon name="calendar" /></span>
            <div class="dates__b"><strong>Important Dates</strong><span>Manuscript submission deadlines</span></div>
            <a class="button button--ghost" href="/call-for-papers">View Details</a>
        </div>
    </div>
</section>

{{-- ══ BLOG / GUIDES ══════════════════════════════════════════════════ --}}
@if ($blogs->isNotEmpty())
    <section class="section section--soft" aria-labelledby="hp-blog">
        <div class="section__head section__head--row">
            <div>
                <h2 class="rule-title" id="hp-blog">From the IJSREAT Blog</h2>
                <p>Latest articles for authors and researchers</p>
            </div>
            <a class="hlink" href="/blogs">All blog articles <x-homepage.icon name="arrow" /></a>
        </div>
        <ul class="tiles">
            @foreach ($blogs as $i => $blog)
                <li><a class="tile c{{ ($i % 5) + 1 }}" href="/blogs/{{ $blog->url_title }}"><span class="tic"><x-homepage.icon name="edit" /></span><span class="tile__b"><strong>{{ $blog->title }}</strong>@if ($blog->category)<small>{{ $blog->category }}</small>@endif</span></a></li>
            @endforeach
        </ul>
    </section>
@endif

{{-- ══ OTHER JOURNALS ═════════════════════════════════════════════════ --}}
<section class="section" aria-labelledby="hp-net">
    <div class="section__head">
        <h2 class="rule-title" id="hp-net">Our Compendium of Other Journals</h2>
        <p>Fifth Dimension Research Publication</p>
    </div>
    <ul class="net">
        <li><a class="jn jn--self" href="/journal-particulars"><span class="jn__badge">IJSREAT</span><span class="jn__b"><strong>International Journal of Scientific Research in Engineering & Technology</strong><small>This journal · e-ISSN 2583-1240 · Bi-Monthly</small></span></a></li>
        @foreach ($journals as [$code, $name, $issn, $months, $url])
            <li><a class="jn" href="{{ $url }}" target="_blank" rel="noopener"><span class="jn__badge">{{ $code }}</span><span class="jn__b"><strong>{{ $name }}</strong><small>e-ISSN: {{ $issn }} · {{ $months }}</small></span></a></li>
        @endforeach
    </ul>
</section>

{{-- ══ FAQ ════════════════════════════════════════════════════════════ --}}
<section class="section section--soft">
    <div class="section__head section__head--row">
        <div>
            <h2 class="rule-title">Frequently Asked Questions</h2>
            <p>Quick answers to the questions authors ask most</p>
        </div>
        <a class="panel__more" href="/FAQs">View All FAQs <x-homepage.icon name="arrow" /></a>
    </div>
    <div class="faq-cols">
        @foreach (array_chunk($faqs, 3) as $column)
            <div>
                @foreach ($column as [$q, $a])
                    <details class="faq-item">
                        <summary class="faq-q">{{ $q }}</summary>
                        <p class="faq-a">{{ $a }}</p>
                    </details>
                @endforeach
            </div>
        @endforeach
    </div>
</section>

{{-- ══ HELP ═══════════════════════════════════════════════════════════ --}}
<section class="section bg-grid" aria-labelledby="hp-help">
    <div class="section__head">
        <h2 class="rule-title" id="hp-help">Need Help? Contact the Editorial Office</h2>
        <p>Questions about scope, charges, review or your paper's status</p>
    </div>
    <ul class="help">
        <li><a class="tile c1" href="mailto:editorinchief@ijsreat.com"><span class="tic"><x-homepage.icon name="mail" /></span><span class="tile__b"><strong>Email the editor</strong><small>editorinchief@ijsreat.com</small></span></a></li>
        <li><a class="tile c3" href="mailto:Support@fdrpjournals.org"><span class="tic"><x-homepage.icon name="help" /></span><span class="tile__b"><strong>Email support</strong><small>Support@fdrpjournals.org</small></span></a></li>
        <li><a class="tile c2" href="tel:+919840521421"><span class="tic"><x-homepage.icon name="phone" /></span><span class="tile__b"><strong>Mobile</strong><small>+91 9840521421</small></span></a></li>
        <li><a class="tile c5" href="/paper-status"><span class="tic"><x-homepage.icon name="search" /></span><span class="tile__b"><strong>Track your paper</strong><small>Article status</small></span></a></li>
        <li><a class="tile c4" href="/contact-us"><span class="tic"><x-homepage.icon name="chat" /></span><span class="tile__b"><strong>Send a message</strong><small>Contact form</small></span></a></li>
    </ul>
</section>

</div>
@endsection
