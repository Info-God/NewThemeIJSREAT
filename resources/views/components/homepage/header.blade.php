{{-- Homepage-only header (IJCRT-style top bar + branded nav).
     Menu entries and destinations mirror components/navbar.blade.php,
     which every other page keeps using. --}}
@php
    $emsUrl = 'https://editorial.fdrpjournals.org/login?journal=2';

    $menus = [
        'about' => ['label' => 'About Us', 'items' => [
            ['title' => 'Aim & Scope', 'link' => '/aim-and-scope'],
            ['title' => 'Editorial Board', 'link' => '/editorial-board'],
            ['title' => 'Indexing & Abstracting', 'link' => '/indexing-and-abstracting'],
            ['title' => 'Publication Ethics Policy', 'link' => '/publication-ethics-policy'],
            ['title' => 'Peer Review Policy', 'link' => '/peer-review-policy'],
            ['title' => 'Ethics & Policy', 'link' => '/ethics'],
            ['title' => 'Cross Mark Policy', 'link' => '/cross-mark-policy'],
            ['title' => 'Impact Factor', 'link' => '/impact-Factor'],
            ['title' => 'UGC CARE Guidelines', 'link' => '/ugc-care-guidelines'],
            ['title' => 'Journal Particulars', 'link' => '/journal-particulars'],
            ['title' => "FAQ'S", 'link' => '/FAQs'],
        ]],
        'authors' => ['label' => 'For Authors', 'items' => [
            ['title' => 'Journal Publishing Process', 'link' => '/journal-publishing-process'],
            ['title' => 'Topics', 'link' => '/topics'],
            ['title' => 'Call for Paper', 'link' => '/call-for-papers'],
            ['title' => 'Instruction for Authors', 'link' => '/instruction-for-author'],
            ['title' => 'Editorial Management System', 'link' => '/guidance-for-ems'],
            ['title' => 'Article Processing Charge', 'link' => '/article-processing-charges'],
            ['title' => 'Article Status', 'link' => '/paper-status'],
            ['title' => 'Downloads', 'link' => '/downloads'],
        ]],
        'conference' => ['label' => 'Conference', 'items' => [
            ['title' => 'Apply for Collaboration', 'link' => '/conference-procedings'],
            ['title' => 'Published Conferences', 'link' => '/conference'],
        ]],
        'thesis' => ['label' => 'Thesis', 'items' => [
            ['title' => 'Publications', 'link' => '/publications'],
            ['title' => 'Archives', 'link' => '/thesis'],
        ]],
    ];

    // Marks the nav entry for the page being viewed (this header is shared by
    // the homepage and the archive pages).
    $current = fn (...$patterns) => request()->is(...$patterns) ? 'aria-current="page"' : '';

    $chevron = '<svg class="nav__chevron" viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M2 4l4 4 4-4"/></svg>';
@endphp

<div class="hp hp-header" x-data="{ navOpen: false, dd: null }" @keydown.escape.window="dd = null; navOpen = false">
    <div class="topbar">
        <div class="topbar__info">
            <span class="topbar__item">
                <svg class="i" viewBox="0 0 24 24" aria-hidden="true"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="M3.5 6.5 12 13l8.5-6.5"/></svg>
                <a href="mailto:editorinchief@ijsreat.com">editorinchief@ijsreat.com</a>
            </span>
            <span class="topbar__sep" aria-hidden="true"></span>
            <span class="topbar__item topbar__item--mobile">
                <svg class="i" viewBox="0 0 24 24" aria-hidden="true"><path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1 1 .4 1.9.7 2.8a2 2 0 0 1-.5 2.1L8 9.9a16 16 0 0 0 6 6l1.3-1.3a2 2 0 0 1 2.1-.4c.9.3 1.8.6 2.8.7a2 2 0 0 1 1.7 2z"/></svg>
                <a href="tel:+919840521421">+91 9840521421</a>
            </span>
            <span class="topbar__sep" aria-hidden="true"></span>
            <span class="topbar__item topbar__item--tagline">
                <svg class="i i--dot" viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="6"/></svg>
                Scholarly <strong>Open Access, Peer-reviewed, Refereed</strong> Journal
            </span>
            <span class="topbar__sep" aria-hidden="true"></span>
            <span class="topbar__badge topbar__badge--gold">e-ISSN 2583-1240</span>
            <span class="topbar__badge topbar__badge--light">Since 2021</span>
        </div>
        <div class="topbar__actions">
            <a class="topbar__btn topbar__btn--outline" href="/current-issue">Current Issue</a>
            <a class="topbar__btn topbar__btn--solid" href="{{ $emsUrl }}" target="_blank" rel="noopener noreferrer">Submit Article</a>
        </div>
    </div>

    <div class="nav-shell">
        <a class="brand" href="/" aria-label="IJSREAT home">
            <img src="/logo.webp" alt="Fifth Dimension Research Publication" width="170" height="42" loading="eager" fetchpriority="high">
            <span class="brand__text">
                <strong class="brand__name" title="International Journal of Scientific Research in Engineering & Technology">IJSREAT</strong>
                {{-- Rotating facts under the short name; CSS-only, pauses for reduced motion. --}}
                <span class="brand__ticker" aria-label="e-ISSN 2583-1240, Peer Reviewed, Open Access, Crossref DOI">
                    <span class="brand__ticker-track" aria-hidden="true">
                        <span><i class="brand__dot"></i>e-ISSN 2583-1240</span>
                        <span><i class="brand__dot"></i>Peer Reviewed</span>
                        <span><i class="brand__dot"></i>Open Access</span>
                        <span><i class="brand__dot"></i>Crossref DOI</span>
                        <span><i class="brand__dot"></i>e-ISSN 2583-1240</span>
                    </span>
                </span>
            </span>
        </a>

        <button class="nav-toggle" type="button" aria-label="Open menu" aria-controls="hp-main-nav" :aria-expanded="navOpen.toString()" @click="navOpen = !navOpen">
            <span></span><span></span><span></span>
        </button>

        <nav class="nav" id="hp-main-nav" aria-label="Primary navigation" :class="{ 'nav--open': navOpen }">
            <a class="nav__link" href="/" {!! $current('/') !!}>Home</a>

            @foreach (['about', 'authors'] as $key)
                <div class="nav__dropdown" :class="{ 'is-open': dd === '{{ $key }}' }"
                     @mouseenter="if (window.innerWidth > 1180) dd = '{{ $key }}'"
                     @mouseleave="if (window.innerWidth > 1180) dd = null"
                     @click.outside="if (dd === '{{ $key }}') dd = null">
                    <button class="nav__dropbtn" type="button" aria-haspopup="true" :aria-expanded="(dd === '{{ $key }}').toString()" @click="dd = dd === '{{ $key }}' ? null : '{{ $key }}'">
                        {{ $menus[$key]['label'] }} {!! $chevron !!}
                    </button>
                    <ul class="nav__submenu" x-show="dd === '{{ $key }}'" x-cloak style="display:none">
                        @foreach ($menus[$key]['items'] as $item)
                            <li><a class="nav__sublink" href="{{ $item['link'] }}">{{ $item['title'] }}</a></li>
                        @endforeach
                    </ul>
                </div>
            @endforeach

            <a class="nav__link" href="/current-issue" {!! $current('current-issue*', 'curent-issue*') !!}>Current Issue</a>
            <a class="nav__link" href="/archives" {!! $current('archives*') !!}>Archives</a>

            @foreach (['conference', 'thesis'] as $key)
                <div class="nav__dropdown" :class="{ 'is-open': dd === '{{ $key }}' }"
                     @mouseenter="if (window.innerWidth > 1180) dd = '{{ $key }}'"
                     @mouseleave="if (window.innerWidth > 1180) dd = null"
                     @click.outside="if (dd === '{{ $key }}') dd = null">
                    <button class="nav__dropbtn" type="button" aria-haspopup="true" :aria-expanded="(dd === '{{ $key }}').toString()" @click="dd = dd === '{{ $key }}' ? null : '{{ $key }}'">
                        {{ $menus[$key]['label'] }} {!! $chevron !!}
                    </button>
                    <ul class="nav__submenu" x-show="dd === '{{ $key }}'" x-cloak style="display:none">
                        @foreach ($menus[$key]['items'] as $item)
                            <li><a class="nav__sublink" href="{{ $item['link'] }}">{{ $item['title'] }}</a></li>
                        @endforeach
                    </ul>
                </div>
            @endforeach

            <a class="nav__link" href="/blogs" {!! $current('blogs*') !!}>Blog</a>
            <a class="nav__link" href="/contact-us">Contact Us</a>
            <a class="nav__link nav__link--btn" href="{{ $emsUrl }}" target="_blank" rel="noopener noreferrer">Author Login</a>
        </nav>
    </div>
</div>
