<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ThesisController extends BaseController
{
    public function index()
    {
        return view('pages.thesis.index');
    }

    public function issue(string $year, string $volume)
    {
        $papers = DB::table('thesis')
            ->where('thesis_year', $year)
            ->where('thesis_volume', $volume)
            ->orderBy('id')
            ->get();

        if ($papers->isEmpty()) {
            abort(404);
        }

        return view('pages.thesis.paperlist', compact('year', 'volume', 'papers'));
    }

    public function paper(Request $request, string $identifier)
    {
        $identifier = trim($identifier);
        $normalizedIdentifier = preg_replace('#^https?://(?:www\.)?doi\.org/#i', '', $identifier);
        $normalizedIdentifier = trim($normalizedIdentifier, " \t\n\r\0\x0B/");

        $paper = null;

        if (ctype_digit($identifier)) {
            $paper = DB::table('thesis')->where('id', (int) $identifier)->first();
        }

        if (!$paper) {
            $paper = DB::table('thesis')
                ->whereIn('thesis_doi_no', [$identifier, $normalizedIdentifier])
                ->first();
        }

        if (!$paper && $identifier !== '') {
            $paper = DB::table('thesis')
                ->get()
                ->first(function ($record) use ($normalizedIdentifier, $identifier) {
                    return getThesisPaperSlug($record) === $normalizedIdentifier
                        || getThesisPaperSlug($record) === $identifier;
                });
        }

        if (!$paper) {
            abort(404);
        }

        $canonicalSlug = getThesisPaperSlug($paper);
        $expectedPath = '/thesis/' . $canonicalSlug;
        $currentPath = '/' . ltrim(rawurldecode($request->getPathInfo()), '/');

        if ($currentPath !== $expectedPath) {
            $queryParams = $request->getQueryString();
            $redirectUrl = $expectedPath . ($queryParams ? '?' . $queryParams : '');

            return redirect($redirectUrl, 301);
        }

        return view('pages.thesis.paper-details', compact('paper'));
    }

    public function legacyIssueRedirect(Request $request)
    {
        $year = $request->query('year');
        $volume = $request->query('volume');

        if (!ctype_digit((string) $year) || !ctype_digit((string) $volume)) {
            abort(404);
        }

        return redirect(getThesisIssuePath($year, $volume), 301);
    }

    public function legacyPaperRedirect(Request $request)
    {
        $paperId = $request->query('id') ?? $request->query('paperid');
        $paperTitle = $request->query('papertitle') ?? $request->query('paper_title');
        $paper = null;

        if ($paperId && ctype_digit((string) $paperId)) {
            $paper = DB::table('thesis')->where('id', $paperId)->first();
        }

        if (!$paper && $paperTitle) {
            $slug = Str::slug($paperTitle, '-');
            $paper = DB::table('thesis')
                ->get()
                ->first(function ($record) use ($slug) {
                    return getThesisPaperSlug($record) === $slug;
                });
        }

        if (!$paper) {
            abort(404);
        }

        return redirect(getThesisPaperUrl($paper), 301);
    }
}
