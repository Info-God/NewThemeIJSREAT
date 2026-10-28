@extends('layouts.app')

@section('meta_title', 'IJSREAT | Editorial Board – International Journal of Scientific Research in Engineering & Technology')
@section('meta_description', 'Meet the distinguished editorial board of IJSREAT, comprising renowned academicians, researchers, and experts in engineering and technology who guide and review innovative research.')

@include('archives.partials.theme')

@php
    $memberImage = fn ($path) => $path
        ? ((str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) ? $path : 'https://panel.ijsreat.com/storage/' . trim($path, '/'))
        : null;
    $initials = fn ($name) => collect(preg_split('/[\s.]+/', trim(preg_replace('/^(dr|mr|mrs|ms|prof)\.?\s*/i', '', $name))))
        ->filter()->take(2)->map(fn ($p) => mb_strtoupper(mb_substr($p, 0, 1)))->implode('');
    $groups = $members->groupBy(fn ($m) => $m->member_role ?: 'Editorial Board');
    $profileLinks = [
        'member_orcid_id' => ['ORCID', '/editorial/board/orcid.png'],
        'member_google_scholar_id' => ['Google Scholar', '/editorial/board/scholar.png'],
        'member_scopus_id' => ['Scopus', '/editorial/board/scopus.png'],
        'member_thomson_reuters' => ['Researcher ID', '/editorial/board/researcher.png'],
        'member_linkedin' => ['LinkedIn', '/editorial/board/linkedin.webp'],
    ];
@endphp

@section('content')
<div class="hp">
    <x-archive.pageband title="Editorial Board" :crumbs="['Editorial Board' => null]"
        lead="The editors and advisory board members who guide the International Journal of Scientific Research in Engineering & Technology and its peer-review process.">
        <span class="pbf pbf--cyan"><x-homepage.icon name="users" /><span>Board members</span><b>{{ $members->count() + 2 }}</b></span>
        <span class="pbf pbf--orange"><x-homepage.icon name="globe" /><span>Countries</span><b>{{ $members->pluck('member_country')->filter()->unique()->count() ?: '—' }}</b></span>
        <span class="pbf"><x-homepage.icon name="doc" /><span>e-ISSN</span><b>2583-1240</b></span>
    </x-archive.pageband>

    <div class="apage apage--wide">
        <div class="amain">
            <section aria-labelledby="eb-lead">
                <div class="block-title"><h2 class="rule-title" id="eb-lead">Editorial Leadership</h2></div>
                <div class="lead-grid">
                    <article class="leader">
                        <span class="leader__av" aria-hidden="true">SS</span>
                        <div class="leader__b">
                            <span class="role-pill">Patron / Editor-in-Chief</span>
                            <h3>Dr. S. Sivaganesan</h3>
                            <p>Professor, Department of Electrical &amp; Electronics Engineering</p>
                            <div class="leader__meta">
                                <span><x-homepage.icon name="building" /> Holymary Institute of Technology &amp; Science. Hyderabad-501301, India</span>
                                <a href="mailto:editorinchief@ijsreat.com"><x-homepage.icon name="mail" /> editorinchief@ijsreat.com</a>
                            </div>
                        </div>
                    </article>
                    <article class="leader">
                        <span class="leader__av" aria-hidden="true">TR</span>
                        <div class="leader__b">
                            <span class="role-pill">Managing Editor</span>
                            <h3>Dr. S. Thanga Revathi</h3>
                            <p>Assistant Professor, Department of Computer Science and Engineering</p>
                            <div class="leader__meta">
                                <span><x-homepage.icon name="building" /> SRM Institute of Science and Technology, Chennai–603203. India.</span>
                                <a href="mailto:thangars@srmist.edu.in"><x-homepage.icon name="mail" /> thangars@srmist.edu.in</a>
                            </div>
                        </div>
                    </article>
                </div>
            </section>

            @forelse ($groups as $role => $groupMembers)
                <section aria-labelledby="eb-{{ \Illuminate\Support\Str::slug($role) }}">
                    <div class="block-title">
                        <h2 class="rule-title" id="eb-{{ \Illuminate\Support\Str::slug($role) }}">{{ $role }}</h2>
                        <span class="muted">{{ $groupMembers->count() }} {{ \Illuminate\Support\Str::plural('member', $groupMembers->count()) }}</span>
                    </div>
                    <div class="members">
                        @foreach ($groupMembers as $member)
                            @php
                                $profileUrl = '/editorial-board/' . \Illuminate\Support\Str::slug($member->member_name, '-');
                                $img = $memberImage($member->member_image_url);
                                $areas = collect(explode(',', (string) $member->member_researcharea))->map(fn ($a) => trim($a))->filter();
                            @endphp
                            <article class="mcard">
                                <div class="mcard__top">
                                    @if ($img)
                                        <img class="mcard__img" src="{{ $img }}" alt="{{ $member->member_name }}" loading="lazy">
                                    @else
                                        <span class="leader__av mcard__img" aria-hidden="true">{{ $initials($member->member_name) }}</span>
                                    @endif
                                    <div class="mcard__id">
                                        <span class="role-pill">{{ $role }}</span>
                                        <h3><a href="{{ $profileUrl }}" style="color:inherit;text-decoration:none">{{ $member->member_name }}</a></h3>
                                        @if ($member->member_designation)<p>{{ $member->member_designation }}</p>@endif
                                    </div>
                                </div>
                                <div class="mcard__body">
                                    @if ($member->member_address)
                                        <div class="mcard__row"><x-homepage.icon name="building" /> <span>{{ $member->member_address }}</span></div>
                                    @endif
                                    @if ($member->member_country)
                                        <div class="mcard__row"><x-homepage.icon name="globe" /> <span>{{ $member->member_country }}</span></div>
                                    @endif
                                    @if ($member->member_email)
                                        <div class="mcard__row"><x-homepage.icon name="mail" /> <a href="mailto:{{ $member->member_email }}">{{ $member->member_email }}</a></div>
                                    @endif
                                    @if ($areas->isNotEmpty())
                                        <div class="mtags">
                                            @foreach ($areas->take(4) as $area)<span class="mtag">{{ $area }}</span>@endforeach
                                            @if ($areas->count() > 4)<span class="mtag">+{{ $areas->count() - 4 }} more</span>@endif
                                        </div>
                                    @endif
                                </div>
                                <div class="mcard__foot">
                                    <div class="mcard__links">
                                        @foreach ($profileLinks as $field => [$label, $icon])
                                            @if ($member->{$field})
                                                <a href="{{ $member->{$field} }}" target="_blank" rel="noopener" title="{{ $label }}" aria-label="{{ $label }} profile"><img src="{{ $icon }}" alt=""></a>
                                            @endif
                                        @endforeach
                                    </div>
                                    <a class="pbtn" href="{{ $profileUrl }}">View Profile <x-homepage.icon name="arrow" /></a>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </section>
            @empty
                <div class="pempty"><x-homepage.icon name="users" /><h2>Board members will be listed here soon.</h2></div>
            @endforelse

        </div>
    </div>
</div>
@endsection
