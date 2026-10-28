@extends('layouts.app')

@php
        $authors = collect([$paper->author_1, $paper->author_2, $paper->author_3, $paper->author_4, $paper->author_5, $paper->author_6])->filter();
        $title = $paper->title;
        $abstract = $paper->abstract;
        $doi = $paper->doi;
        $pdfUrl = $paper->pdf_url ? url('/conferencePDF/' . ltrim($paper->pdf_url, '/')) : '';
        $paper_references = $paper->references;
        $canonicalUrl = url(getConferencePaperUrl($paper));
        $journalTitle = "International Journal of Scientific Research in Engineering & Technology";
        $publisher = "Fifth Dimension Research Publication";
        
        // Parse references into array for separate meta tags
        $referencesArray = [];
        if ($paper_references) {
            $referencesArray = array_filter(array_map('trim', explode("\n", $paper_references)));
        }
        
        // Parse pages
        $pages = $paper->pages;
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
        // YYYY, YYYY/MM, or YYYY/MM/DD value). month stores the real
        // publication quarter (e.g. "May-August") — its first month is real
        // data, so it's used for YYYY/MM precision; no day is fabricated
        // since the exact day isn't known.
        $pubMonth = paperQuarterStartMonth($category->month);
        $pubDate = $pubMonth ? sprintf('%s/%02d', $category->year, $pubMonth) : (string) $category->year;
        $isoPubDate = $pubMonth ? sprintf('%s-%02d', $category->year, $pubMonth) : (string) $category->year;

        // Record-level date (created/updated timestamp) for citation_date,
        // separate from the publication year above.
        $recordTimestamp = $paper->updated_at ?: $paper->created_at;
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
                'issueNumber' => (string)$category->issue,
                'volumeNumber' => (string)$category->volume,
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
            $scholarlyArticle['citation'] = array_values($referencesArray);
        }
        
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
    
        @endphp

@section('meta_title', $title . ' | IJSREAT')
@section('meta_description', $metaDesc)
@section('canonical', $canonicalUrl)

@section('head')
    <meta name="keywords" content="{{ $keywordsList }}">
    <meta name="robots" content="index, follow">

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
    <meta name="DC.Rights" content="Copyright © {{ $category->year }} IJSREAT">
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
    <meta name="citation_volume" content="{{ $category->volume }}">
    <meta name="citation_issue" content="{{ $category->issue }}">
    @if($firstPage)<meta name="citation_firstpage" content="{{ $firstPage }}">@endif
    @if($lastPage)<meta name="citation_lastpage" content="{{ $lastPage }}">@endif
    @if($bareDoi !== '')
        <meta name="citation_doi" content="{{ $bareDoi }}">
    @endif
    <meta name="citation_pdf_url" content="{{ $pdfUrl }}">
    <meta name="citation_publisher" content="{{ $publisher }}">

    {{-- JSON-LD --}}
    <script type="application/ld+json">{!! json_encode($scholarlyArticle, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
@endsection

@include('archives.partials.theme')

@section('content')
    @php
        $section = request()->query('section', 'FullArticle');
        $relatedArticles = DB::table('conferences')
            ->where('category_id', $paper->category_id)
            ->where('id', '!=', $paper->id)
            ->limit(3)
            ->get();

        // Map the paper to the properties the shared sidebar expects.
        $activeArticle = (object) [
            'paper_pdf_url' => $pdfUrl,
            'paper_doi' => $paper->doi,
        ];
        $issuePath = getConferenceIssuePath($category);
        $published = trim($category->month . ' ' . $category->year);
        $meta = array_values(array_filter([
            ['icon' => 'users', 'text' => $category->name, 'href' => $issuePath],
            ['icon' => 'journal', 'text' => "Volume {$category->volume}, Issue {$category->issue}"],
            $paper->pages ? ['icon' => 'pages', 'text' => 'Pages ' . $paper->pages] : null,
            ['icon' => 'calendar', 'text' => 'Published Online: ' . $published],
        ]));
        $related = $relatedArticles->map(fn ($a) => [
            'url' => getConferencePaperUrl($a),
            'small' => $category->name . ' · ' . $category->year,
            'title' => $a->title,
        ])->all();
    @endphp

    <x-archive.paper-view
        :title="$paper->title"
        :article-type="$paper->article_type ?? 'Research Article'"
        :authors="$authors->values()->all()"
        :designation="$paper->designation"
        :crumbs="['Conference' => '/conference', $category->name => $issuePath, 'Article' => null]"
        :meta="$meta"
        :badge-issue="$category->name"
        :badge-date="'Volume ' . $category->volume . ' · Issue ' . $category->issue . ' · ' . $category->year"
        :info="[
            ['icon' => 'users', 'label' => 'Conference', 'value' => $category->title, 'href' => $issuePath, 'wide' => true],
            ['icon' => 'building', 'label' => 'Organised By', 'value' => $category->organised_by],
            ['icon' => 'calendar', 'label' => 'Conference Date', 'value' => $category->conference_date],
            ['icon' => 'pages', 'label' => 'Pages', 'value' => $paper->pages],
            ['icon' => 'tag', 'label' => 'Article Type', 'value' => $paper->article_type ?? 'Research Article'],
        ]"
        :pdf-url="$pdfUrl"
        :doi="$doi"
        :canonical-url="$canonicalUrl"
        :section="$section"
        :tab-url="url()->current() . '?id=' . $paper->id"
        :abstract="$abstract"
        :references="$paper->references"
        :citation="$paper->citation"
        :related="$related"
        :sidebar-article="$activeArticle"
    />
@endsection
