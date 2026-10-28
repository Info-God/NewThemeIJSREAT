<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Tag;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TagController extends Controller
{
    public function index(Request $request)
    {
        $query = Tag::query()
            ->select(['id', 'title', 'url_title', 'meta_title', 'meta_description', 'image', 'description', 'category', 'created_at']);

        if ($request->has('search')) {
            $search = $request->query('search');
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%");
            });
        }

        $tags = $query->orderBy('title')->paginate(15)->withQueryString();

        return view('tags.index', compact('tags'));
    }

    public function show(Request $request, string $urlTitle)
    {
        $tag = Tag::query()
            ->where('url_title', $urlTitle)
            ->firstOrFail();

        $query = DB::table('blogs')
            ->where('tags', 'like', "%{$tag->title}%");

        if ($request->has('search')) {
            $search = $request->query('search');
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('tags', 'like', "%{$search}%");
            });
        }

        $blogs = $query->orderBy('created_at', 'desc')->paginate(15)->withQueryString();

        return view('tags.show', compact('tag', 'blogs'));
    }
}