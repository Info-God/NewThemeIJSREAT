{{-- Shared research-paper detail layout (journal archive and conference papers).
     The calling view keeps its own SEO <head> data and passes display-ready values. --}}
@props([
    'title',
    'articleType' => 'Original Article',
    'authors' => [],
    'designation' => null,
    'crumbs' => [],
    'meta' => [],          // [['icon' => .., 'text' => .., 'href' => null], ...]
    'badgeIssue' => null,
    'badgeDate' => null,
    'info' => [],          // [['icon' => .., 'label' => .., 'value' => .., 'href' => null, 'wide' => false], ...]
    'pdfUrl' => '',
    'doi' => null,
    'canonicalUrl',
    'section' => 'FullArticle',
    'tabUrl',              // URL the ?section= / &section= value is appended to
    'abstract' => null,
    'references' => null,
    'citation' => null,
    'related' => [],       // [['url' => .., 'small' => .., 'title' => ..], ...]
    'sidebarArticle' => null,
])

@php
    $hasDoi = $doi && $doi != '.';
    $extractedDoi = function_exists('extractDoiFromUrl') ? extractDoiFromUrl($doi) : null;
    $tabs = [
        'FullArticle' => ['Full Article', 'doc'],
        'References' => ['References', 'list'],
        'Citations' => ['Citations', 'quote'],
        'Metrics' => ['Metrics', 'chart'],
        'Licensing' => ['Licensing', 'shield'],
    ];
    $tabJoin = str_contains($tabUrl, '?') ? '&' : '?';
    // Avatar initials from the author's name (titles such as "Dr." skipped).
    $initials = fn ($name) => collect(preg_split('/[\s.]+/', trim(preg_replace('/^(dr|mr|mrs|ms|prof)\.?\s*/i', '', $name))))
        ->filter()->take(2)->map(fn ($p) => mb_strtoupper(mb_substr($p, 0, 1)))->implode('');
    $designationHtml = preg_replace('/(\d+)/', '<sup>$1</sup>', e(str_replace(["\r", "\n"], ' ', (string) $designation)));
@endphp

<div class="hp" x-data="{ shareModal: false, copied: false, shareUrl: @js($canonicalUrl), showTip: false }" @keydown.escape.window="shareModal = false">
    <section class="pageband">
        <div class="pageband__in vphero">
            <div>
                <ol class="crumbs" aria-label="Breadcrumb">
                    <li><a href="/">Home</a></li>
                    @foreach ($crumbs as $label => $href)
                        <li>@if ($href)<a href="{{ $href }}">{{ $label }}</a>@else<span aria-current="page">{{ $label }}</span>@endif</li>
                    @endforeach
                </ol>
                <span class="vphero__eyebrow"><x-homepage.icon name="file" /> {{ $articleType }}</span>
                <h1>{{ $title }}</h1>
                <ul class="vpmeta">
                    @foreach ($meta as $m)
                        <li><x-homepage.icon :name="$m['icon']" /> @if (!empty($m['href']))<a href="{{ $m['href'] }}">{{ $m['text'] }}</a>@else{{ $m['text'] }}@endif</li>
                    @endforeach
                </ul>
                <div class="tags">
                    <span class="tag tag--oa"><x-homepage.icon name="lock" /> Open Access</span>
                    <span class="tag tag--type"><x-homepage.icon name="shield" /> Peer Reviewed</span>
                    @if ($hasDoi)<span class="tag tag--doi"><x-homepage.icon name="link" /> Crossref DOI</span>@endif
                </div>

                <div class="glance2">
                    <div>
                        <p class="glance2__cap"><x-homepage.icon name="users" /> Authors</p>
                        <ul class="authors">
                            @foreach (array_values($authors) as $index => $author)
                                <li>
                                    <span class="av av--{{ $index % 6 }}" aria-hidden="true">{{ $initials($author) ?: '?' }}</span>
                                    <b>{{ $author }}<sup>{{ $index + 1 }}</sup></b>
                                </li>
                            @endforeach
                        </ul>
                        @if (trim(strip_tags($designationHtml)) !== '')
                            <p class="affil">{!! $designationHtml !!}</p>
                        @endif
                    </div>
                    <div class="glance2__acts">
                        @if ($pdfUrl)
                            <a class="gact gact--p" href="{{ $pdfUrl }}" target="_blank" rel="noopener noreferrer"><x-homepage.icon name="external" /> View PDF</a>
                            <a class="gact" href="{{ $pdfUrl }}" download><x-homepage.icon name="download" /> Download PDF</a>
                        @endif
                        <a class="gact" href="{{ $tabUrl . $tabJoin }}section=Citations"><x-homepage.icon name="quote" /> Cite this article</a>
                        <button type="button" class="gact" @click="shareModal = true"><x-homepage.icon name="share" /> Share</button>
                    </div>
                </div>
            </div>

            <aside class="vpbadge" aria-label="Issue information">
                <b>IJSREAT</b>
                <small>e-ISSN 2583-1240</small>
                <div class="vpbadge__rule" aria-hidden="true"></div>
                @if ($badgeIssue)<div class="vpbadge__issue">{{ $badgeIssue }}</div>@endif
                @if ($badgeDate)<div class="vpbadge__date">{{ $badgeDate }}</div>@endif
                <span class="vpbadge__tag"><x-homepage.icon name="lock" /> Open Access</span>
            </aside>
        </div>
    </section>

    <div class="apage">
        <div class="amain">
            <div class="dcard">
                <div class="dcard__head"><h2><span class="tic"><x-homepage.icon name="doc" /></span>Article Information</h2></div>
                <div class="dcard__body">
                    <dl class="dl">
                        <div class="dl--wide">
                            <dt><x-homepage.icon name="link" /> DOI</dt>
                            <dd>@if ($hasDoi)<a href="{{ $doi }}" target="_blank" rel="noopener">{{ $doi }}</a>@else No DOI @endif</dd>
                        </div>
                        @foreach ($info as $row)
                            <div @class(['dl--wide' => !empty($row['wide'])])>
                                <dt><x-homepage.icon :name="$row['icon']" /> {{ $row['label'] }}</dt>
                                <dd>@if (!empty($row['href']))<a href="{{ $row['href'] }}">{{ $row['value'] }}</a>@else{{ $row['value'] !== null && $row['value'] !== '' ? $row['value'] : '—' }}@endif</dd>
                            </div>
                        @endforeach
                        <div class="dl--wide">
                            <dt><x-homepage.icon name="check" /> Check for updates</dt>
                            <dd>
                                @if (empty($extractedDoi))
                                    <span class="crossmark">
                                        <button type="button" @click="showTip = true; setTimeout(() => showTip = false, 3000)" style="background:none;border:0;padding:0;cursor:pointer">
                                            <img loading="lazy" src="/checkupdate.webp" alt="check update">
                                        </button>
                                        <span class="crossmark__tip" x-show="showTip" x-cloak>No DOI available for cross-reference</span>
                                    </span>
                                @else
                                    <a class="crossmark" href="https://crossmark.crossref.org/dialog/?doi={{ $extractedDoi }}&domain=pdf" target="_blank" rel="noreferrer">
                                        <img loading="lazy" src="/checkupdate.webp" alt="check update">
                                    </a>
                                @endif
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>

            <nav class="tabs" aria-label="Article sections">
                @foreach ($tabs as $key => [$label, $icon])
                    <a href="{{ $tabUrl . $tabJoin }}section={{ $key }}" @if ($key === $section) aria-current="page" @endif><x-homepage.icon :name="$icon" /> {{ $label }}</a>
                @endforeach
            </nav>

            <div class="dcard">
                @if ($section === 'FullArticle')
                    <div class="dcard__head">
                        <h2><span class="tic"><x-homepage.icon name="doc" /></span>Abstract</h2>
                        @if ($pdfUrl)<a class="pbtn" href="{{ $pdfUrl }}" target="_blank" rel="noopener noreferrer"><x-homepage.icon name="external" /> View PDF</a>@endif
                    </div>
                    <div class="dcard__body"><p class="abstract">{{ $abstract }}</p></div>
                @elseif ($section === 'References')
                    <div class="dcard__head"><h2><span class="tic"><x-homepage.icon name="list" /></span>References</h2></div>
                    <div class="dcard__body"><div class="refs">{!! nl2br(e($references)) !!}</div></div>
                @elseif ($section === 'Citations')
                    <div class="dcard__head"><h2><span class="tic"><x-homepage.icon name="quote" /></span>Citations</h2></div>
                    <div class="dcard__body"><p class="refs">{{ $citation ?? 'No citations available.' }}</p></div>
                @elseif ($section === 'Metrics')
                    <div class="dcard__head"><h2><span class="tic"><x-homepage.icon name="chart" /></span>Metrics</h2></div>
                    <div class="dcard__body"><x-plum-metrics-card :doi="$doi" /></div>
                @elseif ($section === 'Licensing')
                    <div class="dcard__head"><h2><span class="tic"><x-homepage.icon name="shield" /></span>Licensing</h2></div>
                    <div class="dcard__body"><p class="refs">This work is licensed under a Creative Commons Attribution-NonCommercial-NoDerivatives 4.0 International License.</p></div>
                @endif
            </div>

            @if (count($related))
                <section aria-labelledby="hp-related">
                    <div class="block-title"><h2 class="rule-title" id="hp-related">Related Articles</h2></div>
                    <div class="related">
                        @foreach ($related as $r)
                            <a class="rcard" href="{{ $r['url'] }}">
                                <small>{{ $r['small'] }}</small>
                                <strong>{{ $r['title'] }}</strong>
                                <span>View Article <x-homepage.icon name="arrow" /></span>
                            </a>
                        @endforeach
                    </div>
                </section>
            @endif
        </div>

        <x-archive.sidebar :article="$sidebarArticle" />
    </div>

    <div class="hp-modal" x-show="shareModal" x-cloak role="dialog" aria-modal="true" aria-labelledby="share-title">
        <div class="hp-modal__bg" @click="shareModal = false"></div>
        <div class="hp-modal__card">
            <button type="button" class="hp-modal__x" @click="shareModal = false" aria-label="Close">&times;</button>
            <h2 id="share-title">Share Article</h2>
            <div class="share">
                <a href="https://twitter.com/intent/tweet?url={{ urlencode($canonicalUrl) }}&text={{ urlencode($title) }}" target="_blank" rel="noopener"><b style="background:#000">X</b>X</a>
                <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode($canonicalUrl) }}" target="_blank" rel="noopener"><b style="background:#0077b5">in</b>LinkedIn</a>
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($canonicalUrl) }}" target="_blank" rel="noopener"><b style="background:#1877f2">f</b>Facebook</a>
                <a href="https://api.whatsapp.com/send?text={{ urlencode($title) }}%20{{ urlencode($canonicalUrl) }}" target="_blank" rel="noopener"><b style="background:#25d366"><x-homepage.icon name="phone" /></b>WhatsApp</a>
            </div>
            <div class="copy">
                <input type="text" readonly value="{{ $canonicalUrl }}" aria-label="Article link" onfocus="this.select()">
                <button type="button" :class="{ 'is-done': copied }" @click="navigator.clipboard.writeText(shareUrl); copied = true; setTimeout(() => copied = false, 2000)" x-text="copied ? 'Copied' : 'Copy'">Copy</button>
            </div>
            <p class="hp-modal__note">*Instagram doesn't support direct link sharing from web. Copy the link and share it in your Instagram story or post.</p>
        </div>
    </div>
</div>
