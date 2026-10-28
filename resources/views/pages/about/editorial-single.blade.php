@extends('layouts.app')

@section('meta_title', "{$member->member_name} | Editorial Board | IJSREAT")
@section('meta_description', "View the academic profile, research area, and publications of {$member->member_name}, member of the Editorial Board of IJSREAT.")

@include('archives.partials.theme')

@php
    $img = $member->member_image_url
        ? ((str_starts_with($member->member_image_url, 'http://') || str_starts_with($member->member_image_url, 'https://')) ? $member->member_image_url : 'https://panel.ijsreat.com/storage/' . trim($member->member_image_url, '/'))
        : null;
    $areas = collect(explode(',', (string) $member->member_researcharea))->map(fn ($a) => trim($a))->filter();
    $pubs = collect(explode('[', (string) $member->member_publication_list))->map(fn ($p) => rtrim(trim($p), ' ]'))->filter();
    $ids = [
        ['member_orcid_id', 'ORCID ID', '/editorial/board/orcid.png', false],
        ['member_scopus_id', 'Scopus ID', '/editorial/board/scopus.png', false],
        ['member_thomson_reuters', 'Researcher ID', '/editorial/board/researcher.png', false],
        ['member_google_scholar_id', 'Scholar ID', '/editorial/board/scholar.png', false],
        ['member_linkedin', 'LinkedIn', '/editorial/board/linkedin.webp', true],
    ];
@endphp

@section('content')
<div class="hp">
    <x-archive.pageband :title="$member->member_name" :crumbs="['Editorial Board' => '/editorial-board', $member->member_name => null]"
        :lead="trim(($member->member_role ?? '') . ($member->member_designation ? ' · ' . $member->member_designation : ''), ' ·')" />

    <div class="apage apage--wide">
        <div class="profile">
            <aside class="profile__card" aria-label="Profile summary">
                @if ($img)
                    <img class="profile__img" src="{{ $img }}" alt="{{ $member->member_name }}" loading="lazy">
                @endif
                <span class="role-pill">{{ $member->member_role }}</span>
                <h2 style="margin:10px 0 4px;font-size:1.15rem">{{ $member->member_name }}</h2>
                @if ($member->member_designation)<p class="muted">{{ $member->member_designation }}</p>@endif
                <div class="profile__ids">
                    @foreach ($ids as [$field, $label, $icon, $wide])
                        @if ($member->{$field})
                            <a href="{{ $member->{$field} }}" target="_blank" rel="noopener" @class(['wide' => $wide]) aria-label="{{ $label }}"><img src="{{ $icon }}" alt=""> {{ $label }}</a>
                        @else
                            <span @class(['wide' => $wide]) title="Not provided"><img src="{{ $icon }}" alt=""> {{ $label }}</span>
                        @endif
                    @endforeach
                </div>
            </aside>

            <div class="amain">
                <div class="dcard">
                    <div class="dcard__head"><h2><span class="tic"><x-homepage.icon name="user" /></span>Contact &amp; Affiliation</h2></div>
                    <div class="dcard__body">
                        <dl class="dl">
                            @if ($member->member_address)
                                <div class="dl--wide"><dt><x-homepage.icon name="building" /> Address</dt><dd>{{ $member->member_address }}</dd></div>
                            @endif
                            @if ($member->member_email)
                                <div><dt><x-homepage.icon name="mail" /> E-Mail</dt><dd><a href="mailto:{{ $member->member_email }}">{{ $member->member_email }}</a></dd></div>
                            @endif
                            @if ($member->member_country)
                                <div><dt><x-homepage.icon name="globe" /> Country</dt><dd>{{ $member->member_country }}</dd></div>
                            @endif
                            @if ($member->member_website)
                                <div class="dl--wide"><dt><x-homepage.icon name="external" /> Profile Link</dt><dd><a href="{{ $member->member_website }}" target="_blank" rel="noopener">{{ $member->member_website }}</a></dd></div>
                            @endif
                        </dl>
                    </div>
                </div>

                @if ($areas->isNotEmpty())
                    <div class="dcard">
                        <div class="dcard__head"><h2><span class="tic"><x-homepage.icon name="cpu" /></span>Research Area</h2></div>
                        <div class="dcard__body"><div class="mtags">@foreach ($areas as $area)<span class="mtag">{{ $area }}</span>@endforeach</div></div>
                    </div>
                @endif

                <div class="dcard">
                    <div class="dcard__head"><h2><span class="tic"><x-homepage.icon name="list" /></span>Publications</h2></div>
                    <div class="dcard__body">
                        @if ($pubs->isNotEmpty())
                            <ol class="pubs">@foreach ($pubs as $pub)<li>{{ $pub }}</li>@endforeach</ol>
                        @else
                            <p class="muted" style="font-style:italic">No Publication Yet</p>
                        @endif
                    </div>
                </div>

                <a class="qlink" href="/editorial-board" style="align-self:flex-start"><x-homepage.icon name="users" /> Back to Editorial Board</a>
            </div>
        </div>
    </div>
</div>
@endsection
