<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ConferenceController extends BaseController
{
    public function index()
    {
        $categories = DB::table('conference__categories')->orderBy('year', 'desc')->get();

        return view('pages.conference.index', compact('categories'));
    }

    public function issue(string $year, string $volume, string $issue, string $slug)
    {
        $categories = DB::table('conference__categories')
            ->where('year', $year)
            ->where('volume', $volume)
            ->where('issue', $issue)
            ->get();

        $category = $categories->first(function ($record) use ($slug) {
            return getConferenceCategorySlug($record) === $slug;
        });

        if (!$category) {
            abort(404);
        }

        $canonicalSlug = getConferenceCategorySlug($category);
        $expectedPath = "/conference/{$year}/volume-{$volume}/issue-{$issue}/{$canonicalSlug}";
        $currentPath = '/' . ltrim(rawurldecode(request()->getPathInfo()), '/');

        if ($currentPath !== $expectedPath) {
            return redirect($expectedPath, 301);
        }

        $papers = DB::table('conferences')
            ->where('category_id', $category->id)
            ->orderBy('id')
            ->get();

        return view('pages.conference.paperlist', compact('category', 'papers'));
    }

    public function paper(Request $request, string $identifier)
    {
        $identifier = trim($identifier);
        $normalizedIdentifier = preg_replace('#^https?://(?:www\.)?doi\.org/#i', '', $identifier);
        $normalizedIdentifier = trim($normalizedIdentifier, " \t\n\r\0\x0B/");

        $paper = null;

        if (ctype_digit($identifier)) {
            $paper = DB::table('conferences')->where('id', (int) $identifier)->first();
        }

        if (!$paper) {
            $paper = DB::table('conferences')
                ->whereIn('doi', [$identifier, $normalizedIdentifier])
                ->first();
        }

        if (!$paper && $identifier !== '') {
            $paper = DB::table('conferences')
                ->get()
                ->first(function ($record) use ($normalizedIdentifier, $identifier) {
                    return getConferencePaperSlug($record) === $normalizedIdentifier
                        || getConferencePaperSlug($record) === $identifier;
                });
        }

        if (!$paper) {
            abort(404);
        }

        $canonicalSlug = getConferencePaperSlug($paper);
        $expectedPath = '/conference/' . $canonicalSlug;
        $currentPath = '/' . ltrim(rawurldecode($request->getPathInfo()), '/');

        if ($currentPath !== $expectedPath) {
            $queryParams = $request->getQueryString();
            $redirectUrl = $expectedPath . ($queryParams ? '?' . $queryParams : '');

            return redirect($redirectUrl, 301);
        }

        $category = DB::table('conference__categories')->where('id', $paper->category_id)->first();

        if (!$category) {
            abort(404);
        }

        return view('pages.conference.paper-details', compact('paper', 'category'));
    }

    public function legacyIssueRedirect(Request $request)
    {
        $catId = $request->query('id');

        if ($catId && ctype_digit((string) $catId)) {
            $category = DB::table('conference__categories')->where('id', $catId)->first();

            if ($category) {
                return redirect(getConferenceIssuePath($category), 301);
            }
        }

        $year = $request->query('year');
        $volume = $request->query('volume');
        $issue = $request->query('issue');
        $name = $request->query('name');

        if (!ctype_digit((string) $year) || !ctype_digit((string) $volume) || !ctype_digit((string) $issue)) {
            abort(404);
        }

        $categories = DB::table('conference__categories')
            ->where('year', $year)
            ->where('volume', $volume)
            ->where('issue', $issue)
            ->get();

        if ($categories->isEmpty()) {
            abort(404);
        }

        if ($name) {
            $nameSlug = Str::slug($name, '-');
            $category = $categories->first(function ($record) use ($nameSlug) {
                return getConferenceCategorySlug($record) === $nameSlug;
            }) ?? $categories->first();
        } else {
            $category = $categories->first();
        }

        return redirect(getConferenceIssuePath($category), 301);
    }

    public function legacyPaperRedirect(Request $request)
    {
        $paperId = $request->query('id') ?? $request->query('paperid');
        $paperTitle = $request->query('papertitle') ?? $request->query('paper_title');
        $paper = null;

        if ($paperId && ctype_digit((string) $paperId)) {
            $paper = DB::table('conferences')->where('id', $paperId)->first();
        }

        if (!$paper && $paperTitle) {
            $slug = Str::slug($paperTitle, '-');
            $paper = DB::table('conferences')
                ->get()
                ->first(function ($record) use ($slug) {
                    return getConferencePaperSlug($record) === $slug;
                });
        }

        if (!$paper) {
            abort(404);
        }

        return redirect(getConferencePaperUrl($paper), 301);
    }
}
