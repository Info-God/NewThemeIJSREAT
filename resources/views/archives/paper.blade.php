@extends('layouts.app')

@php
        $paperRoute = request()->is('current-issue*') || request()->is('curent-issue*')
            ? (request()->is('curent-issue*') ? 'curent-issue.paper' : 'current-issue.paper')
            : 'archives.paper';
       
        $authors = $archive->authors;
        $title = $archive->paper_title;
        $abstract = $archive->paper_abstract;
        $doi = $archive->paper_doi;
        $pdfUrl = $archive->paper_pdf_url;
        $paper_references = $archive->paper_references;
        $canonicalUrl = $archive->canonical_url;
        $journalTitle = "International Journal of Scientific Research in Engineering & Technology";
        $publisher = "Fifth Dimension Research Publication";
        
        // Parse references into array for separate meta tags
        $referencesArray = [];
        if ($paper_references) {
            $referencesArray = array_filter(array_map('trim', explode("\n", $paper_references)));
        }
        
        // Parse pages
        $pages = $archive->paper_pages;
        $firstPage = "";
        $lastPage = "";
        if ($pages && str_contains($pages, '-')) {
            $parts = explode('-', $pages);
            $firstPage = trim($parts[0]);
            $lastPage = trim($parts[1]);
        } elseif ($pages) {
            $firstPage = trim($pages);
            $lastPage = trim($pages);
        }

        // Format date (citation_publication_date/DC.Date require a parseable
        // YYYY, YYYY/MM, or YYYY/MM/DD value). paper_month stores the real
        // publication quarter (e.g. "May-August") — its first month is real
        // data, so it's used for YYYY/MM precision; no day is fabricated
        // since the exact day isn't known.
        $pubMonth = paperQuarterStartMonth($archive->paper_month);
        $pubDate = $pubMonth ? sprintf('%s/%02d', $archive->year, $pubMonth) : (string) $archive->year;
        $isoPubDate = $pubMonth ? sprintf('%s-%02d', $archive->year, $pubMonth) : (string) $archive->year;
        $ogPubDate = sprintf('%s-%02d-01', $archive->year, $pubMonth ?? 1);

        // Record-level date (created/updated timestamp) for citation_date,
        // separate from the publication year above.
        $recordTimestamp = $archive->updated_at ?: $archive->created_at;
        $citationDate = $recordTimestamp ? \Carbon\Carbon::parse($recordTimestamp)->format('d/m/Y') : null;
        $dateModifiedIso = $recordTimestamp ? \Carbon\Carbon::parse($recordTimestamp)->toDateString() : null;

        $bareDoi = normalizePaperDoi($doi);

        // Prepare JSON-LD for ScholarlyArticle
        $authorData = [];
        foreach($authors as $author) {
            $authorData[] = [
                '@type' => 'Person',
                'name' => $author
            ];
        }

        $scholarlyArticle = [
            '@context' => 'https://schema.org',
            '@type' => 'ScholarlyArticle',
            'headline' => $title,
            'description' => Str::limit($abstract, 160),
            'abstract' => $abstract,
            'author' => $authorData,
            'datePublished' => $isoPubDate,
            'dateModified' => $dateModifiedIso,
            'image' => url('/logo.png'),
            'publisher' => [
                '@type' => 'Organization',
                'name' => $publisher,
                'logo' => [
                    '@type' => 'ImageObject',
                    'url' => url('/logo.png')
                ]
            ],
            'isPartOf' => [
                '@type' => ['PublicationIssue', 'Periodical'],
                'name' => $journalTitle,
                'issueNumber' => (string)$archive->issue,
                'volumeNumber' => (string)$archive->volume,
                'publisher' => $publisher
            ],
            'pageStart' => $firstPage,
            'pageEnd' => $lastPage,
            'url' => $canonicalUrl,
            'mainEntityOfPage' => [
                '@type' => 'WebPage',
                '@id' => $canonicalUrl
            ]
        ];

        if ($bareDoi !== '') {
            $scholarlyArticle['identifier'] = [
                '@type' => 'PropertyValue',
                'propertyID' => 'DOI',
                'value' => $bareDoi
            ];
            $scholarlyArticle['sameAs'] = 'https://doi.org/' . $bareDoi;
        }

        if (!empty($referencesArray)) {
            // schema.org has no "backmatter" property; "citation" is the
            // real CreativeWork property for referenced works and accepts
            // plain Text values directly.
            $scholarlyArticle['citation'] = array_values($referencesArray);
        }

        // Breadcrumb JSON-LD
        $breadcrumb = [
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => url('/')],
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'Archives', 'item' => url('/archives')],
                ['@type' => 'ListItem', 'position' => 3, 'name' => "Volume {$archive->volume} Issue {$archive->issue}", 'item' => url('/archives/'.$archive->year.'/volume-'.$archive->volume.'/issue-'.$archive->issue)],
                ['@type' => 'ListItem', 'position' => 4, 'name' => 'Article', 'item' => $canonicalUrl]
            ]
        ];
       
        $content = strtolower($abstract . ' ' . $title);
        $extractedKeywords = [];
        $keywordMap = [
            'deep learning' => ['Deep Learning', 'Neural Networks', 'CNN', 'LSTM', 'RNN'],
            'machine learning' => ['Machine Learning', 'Classification', 'Regression', 'SVM', 'Random Forest'],
            'counterfeit' => ['Counterfeit Detection', 'Fake Currency', 'Banknote Authentication', 'Forgery Detection'],
            'currency' => ['Currency Recognition', 'Banknote Classification', 'Money Authentication'],
            'lstm' => ['LSTM', 'Time Series', 'Stock Prediction'],
            'streamlit' => ['Streamlit', 'Web Application', 'Interactive Dashboard'],
        ];
        foreach ($keywordMap as $key => $values) {
            if (str_contains($content, $key)) {
                $extractedKeywords = array_merge($extractedKeywords, $values);
            }
        }
        if (empty($extractedKeywords)) $extractedKeywords = ['Research Article', 'Scientific Study', 'Academic Research'];
        $keywordsList = implode(', ', array_slice(array_unique($extractedKeywords), 0, 10));

        // Smarter Description
        $firstSentence = explode('.', $abstract)[0] . '.';
        $metaDesc = strlen($firstSentence) > 10 ? $firstSentence : Str::limit($abstract, 160);


        
        if (!function_exists('extractDoiFromUrl')) {
    function extractDoiFromUrl($doiLink)
    {
        if (empty($doiLink) || $doiLink === '.' || $doiLink === '') {
            return null;
        }
        
        // Remove any whitespace
        $doiLink = trim($doiLink);
        
        // Check for doi.org in the URL
        if (str_contains($doiLink, 'doi.org/')) {
            $parts = explode('doi.org/', $doiLink);
            return end($parts);
        }
        
        // If it's already a valid DOI format (starts with 10.)
        if (preg_match('/^10\.\d{4,9}\/[-._;()\/:A-Z0-9]+$/i', $doiLink)) {
            return $doiLink;
        }
        
        // Try to extract from any URL
        if (filter_var($doiLink, FILTER_VALIDATE_URL)) {
            $path = parse_url($doiLink, PHP_URL_PATH);
            if ($path) {
                return ltrim($path, '/');
            }
        }
        
        return null;
    }
}


if (!function_exists('extractDoiFromUrl')) {
    function extractDoiFromUrl($doiLink)
    {
        if (empty($doiLink) || $doiLink === '.' || $doiLink === '') {
            return null;
        }
        
        // Remove any whitespace
        $doiLink = trim($doiLink);
        
        // Check for doi.org in the URL
        if (str_contains($doiLink, 'doi.org/')) {
            $parts = explode('doi.org/', $doiLink);
            return end($parts);
        }
        
        // If it's already a valid DOI format (starts with 10.)
        if (preg_match('/^10\.\d{4,9}\/[-._;()\/:A-Z0-9]+$/i', $doiLink)) {
            return $doiLink;
        }
        
        // Try to extract from any URL
        if (filter_var($doiLink, FILTER_VALIDATE_URL)) {
            $path = parse_url($doiLink, PHP_URL_PATH);
            if ($path) {
                return ltrim($path, '/');
            }
        }
        
        return null;
    }
}

    @endphp

@section('meta_title', $title . ' | IJSREAT')
@section('meta_description', $metaDesc)
@section('canonical', $canonicalUrl)

@section('head')
    <meta name="keywords" content="{{ $keywordsList }}">
    <meta name="robots" content="index, follow, max-image-preview:large">

    {{-- Twitter Cards --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $title }}">
    <meta name="twitter:description" content="{{ $metaDesc }}">

    {{-- Dublin Core --}}
    <meta name="DC.Title" content="{{ $title }}">
    <meta name="DC.Description" content="{{ $metaDesc }}">
    <meta name="DC.Publisher" content="International Journal of Scientific Research in Engineering & Technology(IJSREAT)">
    <meta name="DC.Type" content="Text.JournalArticle">
    <meta name="DC.Format" content="application/pdf">
    <meta name="DC.Language" content="en">
    <meta name="DC.Date" content="{{ $isoPubDate }}">
    <meta name="DC.Rights" content="Copyright © {{ $archive->year }} IJSREAT">
    @foreach($authors as $author)
        <meta name="DC.Creator" content="{{ $author }}">
    @endforeach

    {{-- Google Scholar / Citation Metadata --}}
    <meta name="citation_title" content="{{ $title }}">
    @foreach($authors as $author)
        <meta name="citation_author" content="{{ $author }}">
    @endforeach
    <meta name="citation_publication_date" content="{{ $pubDate }}">
    @if($citationDate)<meta name="citation_date" content="{{ $citationDate }}">@endif
    <meta name="citation_journal_title" content="{{ $journalTitle }}">
    <meta name="citation_issn" content="2583-1240">
    <meta name="citation_volume" content="{{ $archive->volume }}">
    <meta name="citation_issue" content="{{ $archive->issue }}">
    @if($firstPage)<meta name="citation_firstpage" content="{{ $firstPage }}">@endif
    @if($lastPage)<meta name="citation_lastpage" content="{{ $lastPage }}">@endif
    @if($bareDoi !== '')
        <meta name="citation_doi" content="{{ $bareDoi }}">
    @endif
    <meta name="citation_pdf_url" content="{{ $pdfUrl }}">
    <meta name="citation_abstract_html_url" content="{{ $canonicalUrl }}">
    <meta name="citation_publisher" content="{{ $publisher }}">
    <meta name="citation_language" content="en">
    
    {{-- Citation References - One meta tag per reference (Google Scholar requirement) --}}
    @foreach($referencesArray as $reference)
        <meta name="citation_references" content="{{ $reference }}">
    @endforeach

    {{-- Open Graph / Facebook --}}
    <meta property="og:type" content="article">
    <meta property="og:url" content="{{ $canonicalUrl }}">
    <meta property="og:title" content="{{ $title }}">
    <meta property="og:description" content="{{ Str::limit($abstract, 200) }}">
    <meta property="og:site_name" content="IJSREAT">
    <meta property="og:image" content="{{ url('/logo.png') }}">
    <meta property="article:published_time" content="{{ $ogPubDate }}">
    <meta property="article:section" content="{{ $archive->paper_articletype }}">
    @foreach($authors as $author)
        <meta property="article:author" content="{{ $author }}">
    @endforeach

    {{-- JSON-LD Scripts --}}
    <script type="application/ld+json">{!! json_encode($scholarlyArticle, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
    <script type="application/ld+json">{!! json_encode($breadcrumb, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
@endsection

@include('archives.partials.theme')

@section('content')
    @php
        $isCurrentIssueFlow = request()->is('current-issue*') || request()->is('curent-issue*');
        $issueUrl = url('/archives/'.$archive->year.'/volume-'.$archive->volume.'/issue-'.$archive->issue);
        $crumbs = $isCurrentIssueFlow
            ? ['Current Issue' => '/current-issue', 'Article' => null]
            : ['Archives' => '/archives', (string) $archive->year => route('archives.year', ['year' => $archive->year]), "Vol. {$archive->volume} Issue {$archive->issue}" => $issueUrl, 'Article' => null];
        $published = trim($archive->paper_month . ' ' . $archive->year);
        $meta = array_values(array_filter([
            ['icon' => 'hash', 'text' => 'Paper ID ' . $archive->paper_id],
            ['icon' => 'journal', 'text' => "Volume {$archive->volume}, Issue {$archive->issue}", 'href' => $issueUrl],
            $archive->paper_pages ? ['icon' => 'pages', 'text' => 'Pages ' . $archive->paper_pages] : null,
            ['icon' => 'calendar', 'text' => 'Published Online: ' . $published],
            $archive->view_count ? ['icon' => 'eye', 'text' => $archive->view_count . ' Views'] : null,
        ]));
        $related = $relatedArticles->map(fn ($a) => [
            'url' => route($paperRoute, ['identifier' => getPaperSlug($a)]),
            'small' => "{$a->year} · Vol {$a->volume} · Issue {$a->issue}",
            'title' => $a->paper_title,
        ])->all();
    @endphp

    <x-archive.paper-view
        :title="$archive->paper_title"
        :article-type="$archive->paper_articletype ?? 'Original Article'"
        :authors="$authors"
        :designation="$archive->paper_designation"
        :crumbs="$crumbs"
        :meta="$meta"
        :badge-issue="'Volume ' . $archive->volume . ' · Issue ' . $archive->issue"
        :badge-date="$published"
        :info="[
            ['icon' => 'journal', 'label' => 'Published In', 'value' => 'Volume ' . $archive->volume . ', Issue ' . $archive->issue . ' (' . $archive->year . ')', 'href' => $issueUrl],
            ['icon' => 'calendar', 'label' => 'Published Online', 'value' => $published],
            ['icon' => 'pages', 'label' => 'Pages', 'value' => $archive->paper_pages],
            ['icon' => 'tag', 'label' => 'Article Type', 'value' => $archive->paper_articletype ?? 'Original Article'],
        ]"
        :pdf-url="$pdfUrl"
        :doi="$doi"
        :canonical-url="$canonicalUrl"
        :section="$section"
        :tab-url="url()->current()"
        :abstract="$abstract"
        :references="$archive->paper_references"
        :citation="$archive->paper_citation"
        :related="$related"
        :sidebar-article="$archive"
    />
@endsection
