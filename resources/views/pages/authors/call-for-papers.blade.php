@extends('layouts.app')

@section('meta_title', 'IJSREAT | Call for Papers – International Journal of Scientific Research in Engineering & Technology')
@section('meta_description', 'Submit your research to IJSREAT (ISSN: 2583-1240), a peer-reviewed, open-access journal publishing original work in engineering, technology, and interdisciplinary fields.')

@include('archives.partials.theme')

@php
    $emsUrl = 'https://editorial.fdrpjournals.org/login?journal=2';
    $latestUpdate = DB::table('latest_update')->first();
@endphp

@section('content')
<div class="hp">
    <x-archive.pageband title="Call for Papers" :crumbs="['For Authors' => '/instruction-for-author', 'Call for Papers' => null]">
        <span class="pbf pbf--cyan"><x-homepage.icon name="doc" /><span>e-ISSN</span><b>2583-1240</b></span>
        <span class="pbf pbf--orange"><x-homepage.icon name="lock" /><span>Access</span><b>Open Access</b></span>
    </x-archive.pageband>

    <div class="apage">
        <div class="amain">
            <section class="cta-band" aria-label="Submit your article">
                <div class="cta-band__b">
                    @if ($latestUpdate && $latestUpdate->input1_data)
                        <h2>{{ $latestUpdate->input1_data }}</h2>
                    @else
                        <h2>Submit your article</h2>
                    @endif
                    <p>Submit your article: Editorial Management system–Online submission.</p>
                </div>
                <div class="cta-band__acts">
                    <a class="button button--accent" href="{{ $emsUrl }}" target="_blank" rel="noopener noreferrer"><x-homepage.icon name="upload" /> Submit Article</a>
                </div>
            </section>

            <div class="dcard">
                <div class="dcard__head"><h2><span class="tic"><x-homepage.icon name="megaphone" /></span>About this Call</h2></div>
                <div class="dcard__body" style="display:grid;gap:12px">
                    <p class="abstract" style="text-align:left">The International Journal of Scientific Research in Engineering & Technology (IJSREAT) has ISSN: 2583-1240 (online), Bi Monthly international journal by Fifth Dimension Research Publication. It is an academic, online, open access, Peer reviewed international journal. It aims to publish original, theoretical, and practical advances in Computer Science Engineering, Internet of things, Data Science, Machine learning, Information Technology, Electrical and Electronics Engineering, Electronics and Telecommunication, Mechanical Engineering, Civil Engineering, Textile Engineering, and all interdisciplinary streams of Engineering Sciences. The board of committee of IJSREAT will review all submitted papers.</p>
                    <p class="abstract" style="text-align:left">International Journal Papers for the regular issues of the Journal can be submitted, around the year, electronically at <a href="mailto:editorinchief@ijsreat.com" style="color:var(--brand);font-weight:700">editorinchief@ijsreat.com</a>. After the final acceptance of the paper, based upon the detailed review process, it will immediately be published online. However, the assignment of the report to a specific Volume / Issue (see <a href="/archives" style="color:var(--brand);font-weight:700">archive</a>) of the journal will be taken up by the Editorial Board later; and the author will be intimated accordingly. For Theme Based Special Issues, time-bound Special Calls for Papers will be informed, and the same will only apply to that specific issue.</p>
                </div>
            </div>

            <div class="dates" style="box-shadow:none">
                <span class="ico"><x-homepage.icon name="calendar" /></span>
                <div class="dates__b">
                    <strong>Last Date for Manuscript Submission</strong>
                    <span>25th of every Bimonthly (February, April, June, August, October, December)</span>
                </div>
            </div>

            <section aria-labelledby="cfp-steps">
                <div class="block-title"><h2 class="rule-title" id="cfp-steps">For the Author’s Convenience</h2></div>
                <p class="muted" style="margin-bottom:12px">For the author’s convenience, we strongly follow the following steps.</p>
                <ol class="rsteps">
                    <li class="rstep"><div><b>Response</b><span>The response will be given within 12 hours.</span></div></li>
                    <li class="rstep"><div><b>Review</b><span>The paper will be reviewed within Two days.</span></div></li>
                    <li class="rstep"><div><b>Notification</b><span>The author will get their Acceptance/Rejection Notification within three days of submitting the paper.</span></div></li>
                    <li class="rstep"><div><b>Open access</b><span>All the accepted papers will be open and accessible with a full PDF download.</span></div></li>
                    <li class="rstep"><div><b>Documents</b><span>All Authors will get a Soft copy of the certificate, acceptance letter, and reviewer evaluation grading.</span></div></li>
                </ol>
            </section>

            <x-archive.verify-strip />

            <div class="qlinks">
                <a class="qlink" href="/aim-and-scope"><x-homepage.icon name="globe" /> Aim &amp; Scope</a>
                <a class="qlink" href="/instruction-for-author"><x-homepage.icon name="doc" /> Instruction for Authors</a>
                <a class="qlink" href="/article-processing-charges"><x-homepage.icon name="coins" /> Article Processing Charges</a>
                <a class="qlink" href="/downloads"><x-homepage.icon name="download" /> Downloads</a>
            </div>
        </div>

        <x-archive.sidebar />
    </div>
</div>
@endsection
