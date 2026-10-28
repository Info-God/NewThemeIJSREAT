@extends('layouts.app')

@section('meta_title', 'Conference Archives | IJSREAT – Published Conference Papers')
@section('meta_description', 'Explore IJSREAT’s conference archives. Access published proceedings, special issues, and papers from national and international academic conferences.')

@include('archives.partials.theme')

@php
    $paperCounts = DB::table('conferences')
        ->select('category_id', DB::raw('COUNT(*) as papers'))
        ->groupBy('category_id')
        ->pluck('papers', 'category_id');
@endphp

@section('content')
<div class="hp">
    <x-archive.pageband title="Published Conferences" :crumbs="['Conference' => null]"
        lead="Conference proceedings published in the International Journal of Scientific Research in Engineering & Technology.">
        <span class="pbf pbf--cyan"><x-homepage.icon name="users" /><span>Conferences</span><b>{{ $categories->count() }}</b></span>
        <span class="pbf pbf--orange"><x-homepage.icon name="file" /><span>Papers</span><b>{{ $paperCounts->sum() }}</b></span>
    </x-archive.pageband>

    <div class="apage">
        <div class="amain">
            @forelse ($categories as $category)
                @php $issueUrl = route('conference.issue', ['year' => $category->year, 'volume' => $category->volume, 'issue' => $category->issue, 'slug' => getConferenceCategorySlug($category)]); @endphp
                <article class="chero" style="grid-template-columns:150px minmax(0,1fr)">
                    <div class="issue-cover" aria-hidden="true">
                        <b>{{ $category->name }}</b>
                        <small>IJSREAT Conference Proceedings</small>
                        <div class="issue-cover__rule"></div>
                        <i>Volume {{ $category->volume }}<br>Issue {{ $category->issue }}<br>{{ $category->year }}</i>
                    </div>
                    <div class="chero__b">
                        <span class="chero__live" style="background:var(--brand-soft);color:var(--brand);border-color:#ecd6d2">Proceedings</span>
                        <h2><a href="{{ $issueUrl }}" style="color:inherit;text-decoration:none">{{ $category->title }}</a></h2>
                        <div class="chero__meta">
                            <div><span>Conference</span><b>{{ $category->name }}</b></div>
                            @if ($category->conference_date)<div><span>Conference date</span><b>{{ $category->conference_date }}</b></div>@endif
                            <div><span>Papers</span><b>{{ $paperCounts[$category->id] ?? 0 }}</b></div>
                        </div>
                        @if ($category->organised_by)
                            <p class="muted"><strong style="color:var(--brand-deep)">Organized By:</strong> {{ $category->organised_by }}</p>
                        @endif
                        <div class="chero__acts">
                            <a class="button button--solid" href="{{ $issueUrl }}"><x-homepage.icon name="journal" /> View Articles</a>
                        </div>
                    </div>
                </article>
            @empty
                <div class="pempty"><x-homepage.icon name="users" /><h2>No conferences found.</h2></div>
            @endforelse

            <section class="cta-band" aria-label="Collaborate">
                <div class="cta-band__b">
                    <h2>Planning a conference?</h2>
                    <p>See how to apply for a conference collaboration with IJSREAT.</p>
                </div>
                <div class="cta-band__acts">
                    <a class="button button--accent" href="/conference-procedings">Apply for Collaboration</a>
                </div>
            </section>
        </div>

        <x-archive.sidebar />
    </div>
</div>
@endsection
