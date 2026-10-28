<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ArchiveController extends BaseController
{
    public function index()
    {
        $archives = Archive::query()
            ->select(['year', 'volume', 'issue'])
            ->groupBy(['year', 'volume', 'issue'])
            ->orderByDesc('year')
            ->orderBy('volume')
            ->orderBy('issue')
            ->get()
            ->groupBy('year');

        $title = 'Archives | IJSREAT – Browse Previous Journal Issues';
        $metaDescription = 'Explore IJSREAT’s archives. Access previously published issues by year, volume, and issue. Download peer-reviewed research papers in multidisciplinary fields.';

        $keywords = 'IJSREAT, archives, research papers, journals, computer science';

        return view('archives.index', compact('archives', 'title', 'metaDescription', 'keywords'));
    }

    public function currentIssue(Request $request)
    {
        $latestIssue = Archive::query()
            ->select(['year', 'volume', 'issue'])
            ->orderByDesc('year')
            ->orderByDesc('volume')
            ->orderByDesc('issue')
            ->first();

        if (!$latestIssue) {
            abort(404);
        }

        $prefix = $request->is('curent-issue*') ? 'curent-issue' : 'current-issue';
        return redirect("/{$prefix}/{$latestIssue->year}/volume-{$latestIssue->volume}/issue-{$latestIssue->issue}", 302);
    }

    public function currentIssuePaperlist(Request $request)
    {
        $year = $request->query('year');
        $volume = $request->query('volume');
        $issue = $request->query('issue');
        $prefix = $request->is('curent-issue*') ? 'curent-issue' : 'current-issue';

        if (!$year || !$volume || !$issue) {
            $latestIssue = Archive::query()
                ->select(['year', 'volume', 'issue'])
                ->orderByDesc('year')
                ->orderByDesc('volume')
                ->orderByDesc('issue')
                ->first();

            if (!$latestIssue) {
                abort(404);
            }

            return redirect("/{$prefix}/{$latestIssue->year}/volume-{$latestIssue->volume}/issue-{$latestIssue->issue}", 302);
        }

        return redirect("/{$prefix}/{$year}/volume-{$volume}/issue-{$issue}", 301);
    }

    public function year(string $year)
    {
        $issues = Archive::query()
            ->select(['volume', 'issue'])
            ->where('year', $year)
            ->groupBy(['volume', 'issue'])
            ->orderBy('volume')
            ->orderBy('issue')
            ->get();

        if ($issues->isEmpty()) {
            abort(404);
        }

        // Fetch all volumes for navigation
        $allVolumes = Archive::query()
            ->select(['year', 'volume'])
            ->groupBy(['year', 'volume'])
            ->orderByDesc('year')
            ->get();

        $title = "IJIRE Archives — {$year}";
        $metaDescription = "View IJIRE archive issues published in {$year}. Browse volumes and issues with SEO-friendly year-based archive pages.";

        $keywords = "IJSREAT archives {$year}, research, journal articles";
        return view('archives.year', compact('year', 'issues', 'allVolumes', 'title', 'metaDescription', 'keywords'));
    }

    public function issue(Request $request, string $year, string $volume, string $issue)
    {
        $query = Archive::query()
            ->where('year', $year)
            ->where('volume', $volume)
            ->where('issue', $issue);

        if ($request->has('search')) {
            $search = $request->query('search');
            $query->where(function($q) use ($search) {
                $q->where('paper_title', 'LIKE', "%{$search}%")
                  ->orWhere('author_1', 'LIKE', "%{$search}%")
                  ->orWhere('author_2', 'LIKE', "%{$search}%")
                  ->orWhere('author_3', 'LIKE', "%{$search}%")
                  ->orWhere('author_4', 'LIKE', "%{$search}%")
                  ->orWhere('author_5', 'LIKE', "%{$search}%")
                  ->orWhere('author_6', 'LIKE', "%{$search}%");
            });
        }

        $papers = $query->orderByRaw('CAST(SUBSTRING_INDEX(paper_pages, "-", 1) AS UNSIGNED) ASC')
            ->orderBy('paper_id', 'asc')
            ->paginate(25)
            ->withQueryString();

        if ($papers->isEmpty()) {
            abort(404);
        }

        // Fetch all volumes for navigation
        $allVolumes = Archive::query()
            ->select(['year', 'volume'])
            ->groupBy(['year', 'volume'])
            ->orderByDesc('year')
            ->get();

        // Fetch all issues for the current year/volume
        $allIssues = Archive::query()
            ->select('issue')
            ->where('year', $year)
            ->where('volume', $volume)
            ->groupBy('issue')
            ->orderBy('issue')
            ->get();

        if ($request->is('current-issue*') || $request->is('curent-issue*')) {
            $title = "CURRENT-ISSUE | International Journal of Scientific Research in Engineering & Technology";
            $metaDescription = "IJSREAT (e-ISSN: 2583-1240) is a bi-monthly, peer-reviewed, open-access journal publishing innovative research in Science, Engineering & Technology.";
        } else {
            $title = "{$year} Volume {$volume} Issue {$issue} | International Journal | IJSREAT";
            $metaDescription = "Explore the IJSREAT archives for top research papers in engineering and technology. Access past volumes and stay updated with the latest innovations";
        }

        $keywords = "IJSREAT archives {$year}, Volume {$volume}, Issue {$issue}, research articles";
        return view('archives.issue', compact('year', 'volume', 'issue', 'papers', 'allVolumes', 'allIssues', 'title', 'metaDescription', 'keywords'));
    }

    public function paper(Request $request, string $identifier)
    {
        $identifier = trim($identifier);
        $normalizedIdentifier = preg_replace('#^https?://(?:www\.)?doi\.org/#i', '', $identifier);
        $normalizedIdentifier = trim($normalizedIdentifier, " \t\n\r\0\x0B/");

        $archive = null;
        if (ctype_digit($identifier)) {
            $archive = Archive::find((int) $identifier);
        }

        if (!$archive) {
            $archive = Archive::query()
                ->whereIn('paper_doi', [$identifier, $normalizedIdentifier])
                ->first();
        }

        if (!$archive && $identifier !== '') {
            $archive = Archive::query()->get()->first(function (Archive $record) use ($normalizedIdentifier, $identifier) {
                return normalizePaperDoi($record->paper_doi ?? null) === $normalizedIdentifier
                    || normalizePaperDoi($record->paper_doi ?? null) === $identifier
                    || getPaperSlug($record) === $normalizedIdentifier
                    || getPaperSlug($record) === $identifier;
            });
        }

        if (!$archive) {
            abort(404);
        }

        $prefix = $request->is('current-issue*') || $request->is('curent-issue*')
            ? ($request->is('curent-issue*') ? 'curent-issue' : 'current-issue')
            : 'archives';

        $canonicalSlug = getPaperSlug($archive);
        $expectedPath = "/{$prefix}/{$canonicalSlug}";
        $currentPath = '/' . ltrim(rawurldecode($request->getPathInfo()), '/');

        if ($currentPath !== $expectedPath) {
            $queryParams = $request->getQueryString();
            $redirectUrl = $expectedPath . ($queryParams ? '?' . $queryParams : '');
            return redirect($redirectUrl, 301);
        }

        $section = $request->query('section', 'FullArticle');
        $title = $archive->paper_title;
        $metaDescription = Str::limit($archive->paper_abstract ?? 'Read this IJIRE paper with full author, DOI, and publication details.', 155);

        // Fetch related articles (same year/volume)
        $relatedArticles = Archive::query()
            ->where('year', $archive->year)
            ->where('volume', $archive->volume)
            ->where('paper_id', '!=', $archive->paper_id)
            ->limit(6)
            ->get();

        // Generate keywords: title + authors + doi + article type
        $keywordsArr = [];
        $keywordsArr[] = $archive->paper_title;
        foreach ($archive->authors as $a) {
            $keywordsArr[] = $a;
        }
        if (!empty($archive->paper_doi) && $archive->paper_doi !== '.') {
            $keywordsArr[] = $archive->paper_doi;
        }
        if (!empty($archive->paper_articletype)) {
            $keywordsArr[] = $archive->paper_articletype;
        }

        $keywords = implode(', ', array_unique(array_filter($keywordsArr)));

        return view('archives.paper', compact('archive', 'title', 'metaDescription', 'section', 'relatedArticles', 'keywords'));
    }

    public function legacyPaperRedirect(Request $request)
    {
        $paperId = $request->query('paperid') ?? $request->query('paper_id');
        $paperTitle = $request->query('papertitle') ?? $request->query('paper_title');
        $archive = null;

        if ($paperId && ctype_digit((string) $paperId)) {
            $archive = Archive::find($paperId);
        }

        if (!$archive && $paperTitle) {
            $slug = Str::slug($paperTitle, '-');
            $archive = Archive::query()->get()->first(function (Archive $record) use ($slug) {
                return getPaperSlug($record) === $slug;
            });
        }

        if (!$archive) {
            abort(404);
        }

        return redirect($archive->archive_url, 301);
    }

    public function legacyIssueRedirect(Request $request)
    {
        $year = $request->query('year');
        $volume = $request->query('volume');
        $issue = $request->query('issue');

        if (!ctype_digit((string) $year) || !ctype_digit((string) $volume) || !ctype_digit((string) $issue)) {
            abort(404);
        }

        return redirect("/archives/{$year}/volume-{$volume}/issue-{$issue}", 301);
    }

    public function sitemap()
    {
        $today = now()->toDateString();

        // Static pages to include (priority tuned for SEO)
        $staticPaths = [
            ['loc' => url('/'), 'changefreq' => 'daily', 'priority' => '1.0'],
            ['loc' => url('/contact-us'), 'changefreq' => 'monthly', 'priority' => '0.9'],
            ['loc' => url('/ethics'), 'changefreq' => 'monthly', 'priority' => '0.8'],
            ['loc' => url('/blogs'), 'changefreq' => 'weekly', 'priority' => '0.85'],
            ['loc' => url('/tag'), 'changefreq' => 'weekly', 'priority' => '0.85'],
            ['loc' => url('/aim-and-scope'), 'changefreq' => 'monthly', 'priority' => '0.85'],
            ['loc' => url('/editorial-board'), 'changefreq' => 'monthly', 'priority' => '0.8'],
            ['loc' => url('/peer-review-policy'), 'changefreq' => 'monthly', 'priority' => '0.8'],
            ['loc' => url('/publication-ethics-policy'), 'changefreq' => 'monthly', 'priority' => '0.8'],
            ['loc' => url('/indexing-and-abstracting'), 'changefreq' => 'monthly', 'priority' => '0.8'],
            ['loc' => url('/FAQs'), 'changefreq' => 'monthly', 'priority' => '0.75'],
            ['loc' => url('/topics'), 'changefreq' => 'monthly', 'priority' => '0.8'],
            ['loc' => url('/call-for-papers'), 'changefreq' => 'monthly', 'priority' => '0.9'],
            ['loc' => url('/instruction-for-author'), 'changefreq' => 'monthly', 'priority' => '0.85'],
            ['loc' => url('/journal-publishing-process'), 'changefreq' => 'monthly', 'priority' => '0.8'],
            ['loc' => url('/guidance-for-ems'), 'changefreq' => 'monthly', 'priority' => '0.75'],
            ['loc' => url('/article-processing-charges'), 'changefreq' => 'monthly', 'priority' => '0.75'],
            ['loc' => url('/downloads'), 'changefreq' => 'monthly', 'priority' => '0.7'],
            ['loc' => url('/impact-Factor'), 'changefreq' => 'monthly', 'priority' => '0.85'],
            ['loc' => url('/paper-status'), 'changefreq' => 'monthly', 'priority' => '0.8'],
            ['loc' => url('/cross-mark-policy'), 'changefreq' => 'monthly', 'priority' => '0.75'],
            ['loc' => url('/archives'), 'changefreq' => 'weekly', 'priority' => '0.9'],
            ['loc' => url('/publications'), 'changefreq' => 'weekly', 'priority' => '0.9'],
            ['loc' => url('/thesis'), 'changefreq' => 'weekly', 'priority' => '0.85'],
            ['loc' => url('/conference'), 'changefreq' => 'monthly', 'priority' => '0.85'],
        ];

        $urls = collect();

        foreach ($staticPaths as $p) {
            $urls->push(array_merge($p, ['lastmod' => $today]));
        }

        // Year pages
        $yearUrls = Archive::query()
            ->select('year')
            ->groupBy('year')
            ->orderByDesc('year')
            ->get()
            ->map(function ($record) use ($today) {
                return [
                    'loc' => url("/archives/{$record->year}"),
                    'lastmod' => $today,
                    'changefreq' => 'monthly',
                    'priority' => '0.8',
                ];
            });

        // Issue pages
        $issueUrls = Archive::query()
            ->select(['year', 'volume', 'issue'])
            ->groupBy(['year', 'volume', 'issue'])
            ->orderByDesc('year')
            ->orderBy('volume')
            ->orderBy('issue')
            ->get()
            ->map(function ($record) use ($today) {
                return [
                    'loc' => url("/archives/{$record->year}/volume-{$record->volume}/issue-{$record->issue}"),
                    'lastmod' => $today,
                    'changefreq' => 'monthly',
                    'priority' => '0.7',
                ];
            });

        // Paper pages (canonical: slug-only)
        $paperEntries = Archive::query()
            ->orderByDesc('year')
            ->get();

        foreach ($paperEntries as $archive) {
            $primaryLoc = url($archive->archive_url);
            $lastmod = $archive->updated_at?->toDateString() ?? $today;

            // Primary canonical entry
            $urls->push([
                'loc' => $primaryLoc,
                'lastmod' => $lastmod,
                'changefreq' => 'yearly',
                'priority' => '0.6',
            ]);

        }

        // Add year and issue urls
        $urls = $urls->concat($yearUrls)->concat($issueUrls);

        // Conference issue and paper pages
        $conferenceCategories = DB::table('conference__categories')->orderByDesc('year')->get();
        foreach ($conferenceCategories as $category) {
            $urls->push([
                'loc' => url(getConferenceIssuePath($category)),
                'lastmod' => $today,
                'changefreq' => 'monthly',
                'priority' => '0.7',
            ]);
        }

        $conferencePapers = DB::table('conferences')->orderByDesc('id')->get();
        foreach ($conferencePapers as $paper) {
            $lastmod = $paper->updated_at ?? $today;
            $urls->push([
                'loc' => url(getConferencePaperUrl($paper)),
                'lastmod' => $lastmod,
                'changefreq' => 'yearly',
                'priority' => '0.6',
            ]);
        }

        // Thesis issue and paper pages
        $thesisIssues = DB::table('thesis')
            ->select(['thesis_year', 'thesis_volume'])
            ->groupBy(['thesis_year', 'thesis_volume'])
            ->orderByDesc('thesis_year')
            ->get();

        foreach ($thesisIssues as $issue) {
            $urls->push([
                'loc' => url(getThesisIssuePath($issue->thesis_year, $issue->thesis_volume)),
                'lastmod' => $today,
                'changefreq' => 'monthly',
                'priority' => '0.7',
            ]);
        }

        $thesisPapers = DB::table('thesis')->orderByDesc('id')->get();
        foreach ($thesisPapers as $paper) {
            $lastmod = $paper->updated_at ?? $today;
            $urls->push([
                'loc' => url(getThesisPaperUrl($paper)),
                'lastmod' => $lastmod,
                'changefreq' => 'yearly',
                'priority' => '0.6',
            ]);
        }

        // Build XML
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        foreach ($urls as $urlEntry) {
            $xml .= "  <url>\n";
            $xml .= "    <loc>" . e($urlEntry['loc']) . "</loc>\n";
            $xml .= "    <lastmod>" . e($urlEntry['lastmod']) . "</lastmod>\n";
            $xml .= "    <changefreq>" . e($urlEntry['changefreq']) . "</changefreq>\n";
            $xml .= "    <priority>" . e($urlEntry['priority']) . "</priority>\n";
            $xml .= "  </url>\n";
        }

        $xml .= '</urlset>';

        return response($xml, 200)->header('Content-Type', 'application/xml');
    }
}
