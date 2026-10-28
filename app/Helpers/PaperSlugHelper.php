<?php

use Illuminate\Support\Str;

if (! function_exists('getPaperSlug')) {
    /**
     * Return the clean archive slug for a paper.
     *
     * Canonical archive URLs should always be title-based slugs.
     */
    function getPaperSlug($paper): string
    {
        $title = trim((string) ($paper->paper_title ?? ''));

        return $title !== '' ? Str::slug($title, '-') : (string) ($paper->paper_id ?? 'paper');
    }
}

if (! function_exists('paperHasValidDoi')) {
    function paperHasValidDoi($doi): bool
    {
        $doi = trim((string) $doi);
        return $doi !== '' && $doi !== '.';
    }
}

if (! function_exists('getPaperDoiUrl')) {
    function getPaperDoiUrl($doi): ?string
    {
        if (! paperHasValidDoi($doi)) {
            return null;
        }

        $doi = trim((string) $doi);
        $doi = preg_replace('#^https?://(?:www\.)?doi\.org/#i', '', $doi);
        $doi = trim($doi, " /\t\n\r\0\x0B");

        if ($doi === '' || $doi === '.') {
            return null;
        }

        return 'https://www.doi.org/' . ltrim($doi, '/');
    }
}

if (! function_exists('getPaperCanonicalUrl')) {
    function getPaperCanonicalUrl($doi, string $fallbackUrl): string
    {
        return $fallbackUrl;
    }
}

if (! function_exists('normalizePaperDoi')) {
    function normalizePaperDoi(?string $doi): string
    {
        $doi = trim((string) ($doi ?? ''));

        if ($doi === '' || $doi === '.') {
            return '';
        }

        $doi = preg_replace('#^https?://(?:www\.)?doi\.org/#i', '', $doi);
        $doi = trim($doi);
        $doi = rtrim($doi, '/');

        return $doi !== '' && $doi !== '.' ? $doi : '';
    }
}

if (! function_exists('paperQuarterStartMonth')) {
    /**
     * Journal issues publish in fixed quarters/bimonthly ranges (e.g. "May-August"),
     * never a specific day. This derives the real first month of that range so
     * date fields can show genuine YYYY/MM precision instead of a fabricated
     * day (e.g. always "-01-01") that misrepresents when the issue came out.
     */
    function paperQuarterStartMonth(?string $monthRange): ?int
    {
        $monthRange = trim((string) ($monthRange ?? ''));
        if ($monthRange === '') {
            return null;
        }

        $firstMonth = trim(explode('-', $monthRange)[0]);
        $timestamp = strtotime($firstMonth . ' 1');

        return $timestamp !== false ? (int) date('n', $timestamp) : null;
    }
}

if (! function_exists('getConferenceCategorySlug')) {
    function getConferenceCategorySlug($category): string
    {
        $name = trim((string) ($category->name ?? ''));

        return $name !== '' ? Str::slug($name, '-') : (string) ($category->id ?? 'conference');
    }
}

if (! function_exists('getConferenceIssuePath')) {
    function getConferenceIssuePath($category): string
    {
        return '/conference/' . $category->year . '/volume-' . $category->volume . '/issue-' . $category->issue . '/' . getConferenceCategorySlug($category);
    }
}

if (! function_exists('getConferencePaperSlug')) {
    function getConferencePaperSlug($paper): string
    {
        $doi = normalizePaperDoi($paper->doi ?? null);

        if ($doi !== '') {
            return $doi;
        }

        $title = trim((string) ($paper->title ?? ''));

        return $title !== '' ? Str::slug($title, '-') : (string) ($paper->id ?? 'paper');
    }
}

if (! function_exists('getConferencePaperUrl')) {
    function getConferencePaperUrl($paper): string
    {
        return '/conference/' . getConferencePaperSlug($paper);
    }
}

if (! function_exists('getThesisPaperSlug')) {
    function getThesisPaperSlug($paper): string
    {
        $doi = normalizePaperDoi($paper->thesis_doi_no ?? null);

        if ($doi !== '') {
            return $doi;
        }

        $title = trim((string) ($paper->thesis_title ?? ''));

        return $title !== '' ? Str::slug($title, '-') : (string) ($paper->id ?? 'paper');
    }
}

if (! function_exists('getThesisPaperUrl')) {
    function getThesisPaperUrl($paper): string
    {
        return '/thesis/' . getThesisPaperSlug($paper);
    }
}

if (! function_exists('getThesisIssuePath')) {
    function getThesisIssuePath(string $year, string $volume): string
    {
        return "/thesis/{$year}/volume-{$volume}";
    }
}
