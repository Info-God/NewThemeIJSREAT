@extends('layouts.app')

@include('archives.partials.theme')

@php
        $authors = collect([$paper->thesis_author_1, $paper->thesis_author_2, $paper->thesis_author_3, $paper->thesis_author_4, $paper->thesis_author_5, $paper->thesis_author_6])->filter();
        $title = $paper->thesis_title;
        $abstract = $paper->thesis_abstract;
        $doi = $paper->thesis_doi_no;
        $pdfUrl = $paper->thesis_paper_url;
        $paper_references = $paper->thesis_reference;
        $canonicalUrl = url(getThesisPaperUrl($paper));
        $journalTitle = "International Journal of Scientific Research in Engineering & Technology";
        $publisher = "Fifth Dimension Research Publication";
        
        // Parse references into array for separate meta tags
        $referencesArray = [];
        if ($paper_references) {
            $referencesArray = array_filter(array_map('trim', explode("\n", $paper_references)));
        }
        
        // Parse pages
        $pages = $paper->thesis_pages;
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
        // YYYY, YYYY/MM, or YYYY/MM/DD value). thesis_month stores the real
        // publication quarter (e.g. "May-August") — its first month is real
        // data, so it's used for YYYY/MM precision; no day is fabricated
        // since the exact day isn't known.
        $pubMonth = paperQuarterStartMonth($paper->thesis_month);
        $pubDate = $pubMonth ? sprintf('%s/%02d', $paper->thesis_year, $pubMonth) : (string) $paper->thesis_year;
        $isoPubDate = $pubMonth ? sprintf('%s-%02d', $paper->thesis_year, $pubMonth) : (string) $paper->thesis_year;

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
                'volumeNumber' => (string)$paper->thesis_volume,
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
 // Smarter Description
        $firstSentence = explode('.', $abstract)[0] . '.';
        $metaDesc = strlen($firstSentence) > 10 ? $firstSentence : Str::limit($abstract, 160);
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
    <meta name="DC.Rights" content="Copyright © {{ $paper->thesis_year }} IJSREAT">
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
    <meta name="citation_volume" content="{{ $paper->thesis_volume }}">
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

@section('content')
    @php
        $section = request()->query('section', 'FullArticle');
        $relatedArticles = DB::table('thesis')
            ->where('thesis_volume', $paper->thesis_volume)
            ->where('id', '!=', $paper->id)
            ->limit(3)
            ->get();

        // Map the paper to the properties the shared sidebar expects.
        $activeArticle = (object) [
            'paper_pdf_url' => $paper->thesis_paper_url,
            'paper_doi' => $paper->thesis_doi_no,
        ];
        $issuePath = getThesisIssuePath((string) $paper->thesis_year, (string) $paper->thesis_volume);
        $published = trim($paper->thesis_month . ' ' . $paper->thesis_year);
        $meta = array_values(array_filter([
            ['icon' => 'journal', 'text' => "Volume {$paper->thesis_volume}, Year {$paper->thesis_year}", 'href' => $issuePath],
            $paper->thesis_pages ? ['icon' => 'pages', 'text' => 'Pages ' . $paper->thesis_pages] : null,
            ['icon' => 'calendar', 'text' => 'Published Online: ' . $published],
        ]));
        $related = $relatedArticles->map(fn ($a) => [
            'url' => getThesisPaperUrl($a),
            'small' => 'Thesis · Volume ' . $a->thesis_volume . ' · ' . $a->thesis_year,
            'title' => $a->thesis_title,
        ])->all();
    @endphp

    <x-archive.paper-view
        :title="$paper->thesis_title"
        article-type="Thesis Publication"
        :authors="$authors->values()->all()"
        :designation="$paper->thesis_designation"
        :crumbs="['Thesis' => '/thesis', 'Volume ' . $paper->thesis_volume . ' (' . $paper->thesis_year . ')' => $issuePath, 'Article' => null]"
        :meta="$meta"
        badge-issue="Thesis Publications"
        :badge-date="'Volume ' . $paper->thesis_volume . ' · ' . $published"
        :info="[
            ['icon' => 'journal', 'label' => 'Volume', 'value' => 'Volume ' . $paper->thesis_volume . ', Year ' . $paper->thesis_year, 'href' => $issuePath],
            ['icon' => 'calendar', 'label' => 'Published Online', 'value' => $published],
            ['icon' => 'pages', 'label' => 'Pages', 'value' => $paper->thesis_pages],
            ['icon' => 'tag', 'label' => 'Article Type', 'value' => 'Thesis Publication'],
        ]"
        :pdf-url="$pdfUrl"
        :doi="$doi"
        :canonical-url="$canonicalUrl"
        :section="$section"
        :tab-url="url()->current() . '?id=' . $paper->id"
        :abstract="$abstract"
        :references="$paper->thesis_reference"
        :citation="$paper->thesis_citation"
        :related="$related"
        :sidebar-article="$activeArticle"
    />
@endsection
