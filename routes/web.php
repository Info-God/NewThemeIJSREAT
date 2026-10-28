<?php

use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\ConferenceController;
use App\Http\Controllers\Frontend\TagController;
use App\Http\Controllers\ThesisController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

Route::get('/', function () {
    $title = 'IJSREAT | International Journal of Scientific Research in Engineering & Technology';
    $metaDescription = 'IJSREAT (e-ISSN: 2583-1240) is a bi-monthly, peer-reviewed, open-access journal publishing innovative research in Science, Engineering & Technology.';
    $keywords = 'IJSREAT, computer science, research journal, peer-reviewed, archives';
    return view('welcome', compact('title', 'metaDescription', 'keywords'));
});

// Archives
Route::get('/archives', [ArchiveController::class, 'index'])->name('archives.index');
Route::get('/archives/paperlist', [ArchiveController::class, 'legacyIssueRedirect'])->name('archives.legacy.issue');
Route::get('/archives/paper-details', [ArchiveController::class, 'legacyPaperRedirect'])->name('archives.legacy.paper');
Route::get('/archives/{year}/volume-{volume}/issue-{issue}', [ArchiveController::class, 'issue'])
    ->where(['year' => '[0-9]{4}', 'volume' => '[0-9]+', 'issue' => '[0-9]+'])
    ->name('archives.issue');
Route::get('/archives/{year}', [ArchiveController::class, 'year'])
    ->where('year', '[0-9]{4}')
    ->name('archives.year');
Route::get('/archives/{identifier}', [ArchiveController::class, 'paper'])
    ->where('identifier', '.*')
    ->name('archives.paper');
Route::get('/sitemap.xml', [ArchiveController::class, 'sitemap'])->name('archives.sitemap');
Route::redirect('/scholar-sitemap.xml', '/sitemap.xml', 301);

// Current Issue
Route::get('/current-issue', [ArchiveController::class, 'currentIssue'])->name('current-issue');
Route::get('/current-issue/paperlist', [ArchiveController::class, 'currentIssuePaperlist'])->name('current-issue.paperlist');
Route::get('/current-issue/paper-details', [ArchiveController::class, 'legacyPaperRedirect'])->name('current-issue.legacy.paper');
Route::get('/current-issue/{year}/volume-{volume}/issue-{issue}', [ArchiveController::class, 'issue'])
    ->where(['year' => '[0-9]{4}', 'volume' => '[0-9]+', 'issue' => '[0-9]+'])
    ->name('current-issue.issue');
Route::get('/current-issue/{identifier}', [ArchiveController::class, 'paper'])
    ->where('identifier', '.*')
    ->name('current-issue.paper');

// Support spelling /curent-issue
Route::get('/curent-issue', [ArchiveController::class, 'currentIssue'])->name('curent-issue');
Route::get('/curent-issue/paperlist', [ArchiveController::class, 'currentIssuePaperlist'])->name('curent-issue.paperlist');
Route::get('/curent-issue/paper-details', [ArchiveController::class, 'legacyPaperRedirect'])->name('curent-issue.legacy.paper');
Route::get('/curent-issue/{year}/volume-{volume}/issue-{issue}', [ArchiveController::class, 'issue'])
    ->where(['year' => '[0-9]{4}', 'volume' => '[0-9]+', 'issue' => '[0-9]+'])
    ->name('curent-issue.issue');
Route::get('/curent-issue/{identifier}', [ArchiveController::class, 'paper'])
    ->where('identifier', '.*')
    ->name('curent-issue.paper');


// About Section
Route::get('/aim-and-scope', function () {
    return view('pages.about.aim-and-scope');
});
Route::get('/editorial-board', function () {
    $members = DB::table('editorial_boards')
        ->where('is_active', 1)
        ->where('is_deleted', 0)
        ->orderBy('member_id')
        ->get();
    return view('pages.about.editorial-board', compact('members'));
});
Route::get('/editorial-board/{slug}', function ($slug) {
    // Slugs are generated from member name. Let's find the member by checking slug of member_name
    $members = DB::table('editorial_boards')
        ->where('is_active', 1)
        ->where('is_deleted', 0)
        ->get();
    $member = $members->first(function ($m) use ($slug) {
        return Str::slug($m->member_name, '-') === $slug;
    });
    if (!$member) {
        abort(404);
    }
    return view('pages.about.editorial-single', compact('member'));
});
Route::get('/indexing-and-abstracting', function () {
    return view('pages.about.indexing-and-abstracting');
});
Route::get('/publication-ethics-policy', function () {
    return view('pages.about.publication-ethics-policy');
});
Route::get('/peer-review-policy', function () {
    return view('pages.about.peer-review-policy');
});
Route::get('/ethics', function () {
    return view('pages.about.ethics-and-policy');
});
Route::get('/cross-mark-policy', function () {
    return view('pages.about.cross-mark-policy');
});
Route::get('/ai-policies', function () {
    return view('pages.about.ai-policies');
});
Route::get('/impact-Factor', function () {
    return view('pages.about.impact-factor');
});
Route::get('/FAQs', function () {
    return view('pages.about.faq');
});
Route::get('/journal-particulars', function () {
    return view('pages.about.journal-particulars');
});

// For Authors
Route::get('/journal-publishing-process', function () {
    return view('pages.authors.journal-publishing-process');
});
Route::get('/topics', function () {
    $topics = DB::table('topics')->whereNull('deleted_at')->get();
    return view('pages.authors.topics', compact('topics'));
});
Route::get('/topics/{slug}', function ($slug) {
    $topics = DB::table('topics')->whereNull('deleted_at')->get();
    $topic = $topics->first(function ($t) use ($slug) {
        return Str::slug($t->title, '-') === $slug;
    });
    if (!$topic) {
        abort(404);
    }
    return view('pages.authors.topic-details', compact('topic'));
});
Route::get('/call-for-papers', function () {
    return view('pages.authors.call-for-papers');
});
Route::get('/instruction-for-author', function () {
    return view('pages.authors.instruction-for-author');
});
Route::get('/guidance-for-ems', function () {
    return view('pages.authors.guidance-for-ems');
});
Route::get('/article-processing-charges', function () {
    return view('pages.authors.article-processing-charges');
});
Route::get('/paper-status', function () {
    return view('pages.authors.paper-status');
});
Route::get('/downloads', function () {
    return view('pages.authors.downloads');
});

// Blogs
Route::get('/blogs', function (Request $request) {
    $query = DB::table('blogs');
    if ($request->has('search')) {
        $search = $request->query('search');
        $query->where('title', 'like', "%{$search}%")
              ->orWhere('description', 'like', "%{$search}%")
              ->orWhere('tags', 'like', "%{$search}%");
    }
    $blogs = $query->orderBy('created_at', 'desc')->paginate(6)->withQueryString();
    return view('pages.blog.index', compact('blogs'));
});
Route::get('/blogs/{slug}', function ($slug) {
    $blog = DB::table('blogs')->where('url_title', $slug)->first();
    if (!$blog) {
        abort(404);
    }
    $recentBlogs = DB::table('blogs')->where('id', '!=', $blog->id)->orderBy('created_at', 'desc')->limit(5)->get();
    return view('pages.blog.show', compact('blog', 'recentBlogs'));
});

// Frontend tags
Route::get('/tag', [TagController::class, 'index'])->name('tags.index');
Route::get('/tag/{url_title}', [TagController::class, 'show'])->name('tags.show');

// Contact Us
Route::get('/contact-us', function () {
    return view('pages.contact-us');
});
Route::post('/contact', function (Request $request) {
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'mobileNumber' => 'required|string|max:20',
        'message' => 'required|string',
    ]);

    DB::table('contact_messages')->insert([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'mobileNumber' => $validated['mobileNumber'],
        'message' => $validated['message'],
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return response()->json(['success' => true, 'message' => 'Your message has been sent successfully!']);
})->name('contact.submit');

// Conference
Route::get('/conference-procedings', function () {
    return view('pages.conference.proceedings');
});
Route::get('/conference', [ConferenceController::class, 'index'])->name('conference.index');
Route::get('/conference/paperlist', [ConferenceController::class, 'legacyIssueRedirect'])->name('conference.legacy.issue');
Route::get('/conference/paper-details', [ConferenceController::class, 'legacyPaperRedirect'])->name('conference.legacy.paper');
Route::get('/conference/{year}/volume-{volume}/issue-{issue}/{slug}', [ConferenceController::class, 'issue'])
    ->where(['year' => '[0-9]{4}', 'volume' => '[0-9]+', 'issue' => '[0-9]+', 'slug' => '[a-z0-9\-]+'])
    ->name('conference.issue');
Route::get('/conference/{identifier}', [ConferenceController::class, 'paper'])
    ->where('identifier', '.*')
    ->name('conference.paper');

// Thesis
Route::get('/publications', function () {
    $publications = DB::table('thesis')
        ->select(['thesis_year', 'thesis_volume'])
        ->groupBy(['thesis_year', 'thesis_volume'])
        ->orderByDesc('thesis_year')
        ->get();
    return view('pages.thesis.publications', compact('publications'));
});
Route::get('/thesis', [ThesisController::class, 'index'])->name('thesis.index');
Route::get('/thesis/paperlist', [ThesisController::class, 'legacyIssueRedirect'])->name('thesis.legacy.issue');
Route::get('/thesis/paper-details', [ThesisController::class, 'legacyPaperRedirect'])->name('thesis.legacy.paper');
Route::get('/thesis/{year}/volume-{volume}', [ThesisController::class, 'issue'])
    ->where(['year' => '[0-9]{4}', 'volume' => '[0-9]+'])
    ->name('thesis.issue');
Route::get('/thesis/{identifier}', [ThesisController::class, 'paper'])
    ->where('identifier', '.*')
    ->name('thesis.paper');

// Footer Policies
Route::get('/privacy-policy', function () {
    return view('pages.policy');
});
Route::get('/terms-and-conditions', function () {
    return view('pages.terms');
});
Route::get('/refund-policy', function () {
    return view('pages.refund');
});

// External SEO Pages
Route::get('/top-10-journals-in-computer-science', function () {
    return view('pages.external.top-10-journals-in-computer-science');
});
Route::get('/best-computer-science-journals', function () {
    return view('pages.external.best-computer-science-journals');
});
Route::get('/fast-publication-computer-science-journals-list', function () {
    return view('pages.external.fast-publication-computer-science-journals-list');
});
Route::get('/fast-publishing-computer-science-journals', function () {
    return view('pages.external.fast-publishing-computer-science-journals');
});
Route::get('/top-computer-science-journals-list', function () {
    return view('pages.external.top-computer-science-journals-list');
});
Route::get('/top-computer-science-journals', function () {
    return view('pages.external.top-computer-science-journals');
});
Route::get('/top-computer-science-journals-in-india', function () {
    return view('pages.external.top-computer-science-journals-in-india');
});
Route::get('/low-cost-computer-science-journals-in-india', function () {
    return view('pages.external.low-cost-computer-science-journals-in-india');
});
Route::get('/google-scholar-computer-science-journals-list', function () {
    return view('pages.external.google-scholar-computer-science-journals-list');
});
Route::get('/journal-for-computer-science-research', function () {
    return view('pages.external.for-computer-science-research');
});

