@extends('layouts.app')

@section('meta_title', 'IJSREAT | Publication Ethics Policy – Upholding Research Integrity')
@section('meta_description', 'IJSREAT follows COPE and Elsevier guidelines to ensure ethical publishing. Our Publication Ethics Policy defines responsibilities for authors, editors, reviewers, and publishers.')

@include('archives.partials.theme')

@section('content')
<div class="hp">
    <x-archive.pageband title="Publication Ethics" :crumbs="['Ethics & Policies' => '/ethics', 'Publication Ethics' => null]" />

    <div class="apage">
        <div class="amain">
            <div class="doc">
                <p><strong>Originality &amp; Plagiarism:</strong> Submitted manuscripts must be original and not plagiarized. Proper citations must be given for any borrowed content.</p>
                <p><strong>Authorship Criteria:</strong> All listed authors must have significantly contributed to the research. Ghost, guest, or gift authorship is prohibited.</p>
                <p><strong>Conflict of Interest:</strong> Authors must disclose any financial or personal conflicts that could influence the research.</p>
                <p><strong>Data Integrity:</strong> Fabrication, falsification, or manipulation of data is unethical and will lead to rejection or retraction.</p>
                <p><strong>Simultaneous Submission:</strong> Submitting the same manuscript to multiple journals at once is not allowed.</p>
                <p><strong>Peer Review:</strong> The journal follows a peer-review process to ensure quality.</p>
            </div>

            <x-archive.verify-strip />

            <div class="qlinks">
                <a class="qlink" href="/ethics"><x-homepage.icon name="shield" /> All Ethics &amp; Policies</a>
                <a class="qlink" href="/peer-review-policy"><x-homepage.icon name="eye" /> Peer Review Policy</a>
                <a class="qlink" href="/cross-mark-policy"><x-homepage.icon name="check" /> Crossmark Policy</a>
                <a class="qlink" href="/ai-policies"><x-homepage.icon name="cpu" /> AI Policies</a>
            </div>
        </div>

        <x-archive.sidebar />
    </div>
</div>
@endsection
