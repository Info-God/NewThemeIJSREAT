@extends('layouts.app')

@section('meta_title', 'Aim & Scope | IJSREAT - Multidisciplinary Journal in Engineering & Technology')
@section('meta_description', 'IJSREAT is a peer-reviewed, open-access journal publishing global research in engineering and technology, offering a platform for academicians and researchers.')

@include('archives.partials.theme')

@php
    // Research areas: titles from the IJSREAT topics table (/topics).
    $scope = [
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
    $topicCount = DB::table('topics')->whereNull('deleted_at')->count();
@endphp

@section('content')
<div class="hp" x-data="{ q: '', areas: @js(collect($scope)->map(fn ($s) => strtolower($s[0]))->values()), get none() { return this.q && !this.areas.some(a => a.includes(this.q.toLowerCase())) } }">
    <x-archive.pageband title="Aim & Scope" :crumbs="['Aim & Scope' => null]"
        lead="What the International Journal of Scientific Research in Engineering & Technology publishes and the research areas it covers.">
        <span class="pbf pbf--cyan"><x-homepage.icon name="layers" /><span>Research areas</span><b>{{ count($scope) }}</b></span>
        @if ($topicCount)<span class="pbf pbf--orange"><x-homepage.icon name="list" /><span>Detailed topics</span><b>{{ $topicCount }}</b></span>@endif
        <span class="pbf"><x-homepage.icon name="doc" /><span>e-ISSN</span><b>2583-1240</b></span>
    </x-archive.pageband>

    <div class="apage">
        <div class="amain">
            <section class="rv-hero" aria-labelledby="aim-h">
                <div>
                    <h2 id="aim-h">Aim</h2>
                    <p>The International Journal Of Scientific Research in Engineering & Technology (IJSREAT) is an international journal dedicated to the latest advancements in engineering and technology. This journal aims to provide a platform for scientists and academicians worldwide to promote, share, and discuss various new issues and developments in different areas of engineering and technologies.</p>
                </div>
                <span class="rv-hero__ic" aria-hidden="true"><x-homepage.icon name="globe" /></span>
            </section>

            <section aria-labelledby="scope-h">
                <div class="block-title">
                    <h2 class="rule-title" id="scope-h">Scope</h2>
                    <a class="hlink" href="/topics">Browse detailed topics <x-homepage.icon name="arrow" /></a>
                </div>
                <p class="muted" style="margin-bottom:10px">The journal's scope is to provide an academic medium and an essential reference for advancing and disseminating research results that support high-level learning, teaching, and research in engineering &amp; technology. We bring together scientists, academicians, engineers, scholars, and students of related fields.</p>
                <p class="muted" style="margin-bottom:14px">The International Journal of Scientific Research in Engineering and Technology (IJSREAT) is an open-access, peer-reviewed multidisciplinary publication that offers authors a worldwide platform to share their research articles online. IJSREAT adheres to an open-access paradigm that allows for the unrestricted sharing of research papers to the global community via the internet. All articles released under open access can be viewed freely.</p>
                <div class="filter" style="margin-bottom:14px">
                    <label class="filter__box">
                        <x-homepage.icon name="search" />
                        <input type="search" x-model="q" placeholder="Filter research areas" aria-label="Filter research areas">
                    </label>
                </div>
                <ul class="tiles">
                    @foreach ($scope as $i => [$area, $icon])
                        <li x-show="!q || @js(strtolower($area)).includes(q.toLowerCase())">
                            <div class="tile c{{ ($i % 5) + 1 }}"><span class="tic"><x-homepage.icon :name="$icon" /></span><span class="tile__b"><strong>{{ $area }}</strong></span></div>
                        </li>
                    @endforeach
                </ul>
                <p class="empty" x-show="none" x-cloak style="margin-top:12px">No research area matches “<span x-text="q"></span>”. The journal also welcomes interdisciplinary work; see the <a href="/topics" style="color:var(--brand);font-weight:700">detailed topics</a> or contact the editor.</p>
                <div class="lead-note" style="margin-top:16px">
                    <x-homepage.icon name="check" />
                    <span>Research areas shown are drawn from the journal's detailed topics; see the full list on the Topics page.</span>
                </div>
            </section>

            <div class="two-col">
                <div class="panel2">
                    <h3><x-homepage.icon name="link" /> Crossref DOI</h3>
                    <p class="muted">CrossRef DOI is assigned to research Article published in our journal. IJSREAT DOI prefix is <strong style="color:var(--brand-deep)">10.59256/ijsreat</strong>.</p>
                </div>
                <div class="panel2">
                    <h3><x-homepage.icon name="search" /> Plagiarism screening</h3>
                    <p class="muted">Plagiarism is checked by the leading plagiarism checker.</p>
                </div>
            </div>

            <div class="qlinks">
                <a class="qlink" href="/topics"><x-homepage.icon name="list" /> Topics</a>
                <a class="qlink" href="/call-for-papers"><x-homepage.icon name="megaphone" /> Call for Papers</a>
                <a class="qlink" href="/instruction-for-author"><x-homepage.icon name="doc" /> Instruction for Authors</a>
                <a class="qlink" href="/indexing-and-abstracting"><x-homepage.icon name="globe" /> Indexing &amp; Abstracting</a>
            </div>
        </div>

        <x-archive.sidebar />
    </div>
</div>
@endsection
