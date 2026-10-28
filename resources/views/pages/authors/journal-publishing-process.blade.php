@extends('layouts.app')

@section('meta_title', 'IJSREAT | Journal Publishing Process – International Journal of Scientific Research in Engineering & Technology')
@section('meta_description', 'Learn about the IJSREAT journal publishing process, from manuscript submission and peer review to acceptance, publication, indexing, and global online access.')

@include('archives.partials.theme')

@php
    $steps = [
        ['Submit', 'send', 'Submit your research through Editorial Management System-EMS (online submission). You will need to register for an account to do this. Once your account is set up, you will be guided through a 7-step submission process.'],
        ['Editorial check', 'search', 'Your paper will then be read by the journal Editor to see if it fits with the aims and scope of the journal. They will enter it into a plagiarism Check, peer review process which considers the quality, originality, approach and clarity of your paper.'],
        ['Decision', 'check', null],
        ['Revisions', 'edit', 'You will receive an email from the Editor containing feedback and a final decision. If you are asked to make revisions, you will generally have 1-2 weeks to revise your paper for minor revisions, and 2-4 weeks for major revisions. The editor will confirm the deadline when they provide their feedback and decision. If not, you may be asked to perform multiple revisions or your paper may be rejected.'],
        ['Acceptance', 'award', 'Once accepted, your paper is immediately processed by our in-house team, who check it is complete and whether any necessary third-party permissions have been provided.'],
        ['Typesetting', 'file', 'Your paper will be returned to you for a final check along with any requests for missing information, before being sent to EMS Submit, our licensing and APC system. When the Copyright Transfer Agreement is signed (and any applicable APC paid) your paper is then sent to our typesetting team.'],
        ['Author proofs', 'eye', 'Your proof must be returned to the typesetters (Proofreading, Layout Editing, and Galley Correction). Supplier project managers will email corresponding authors and co-authors in the event of delay in returning proofs, followed by contact with the journal’s editor-in-chief.'],
        ['Publication', 'journal', 'When a journal issue is available for your article to be published in, the typeset files will be reworked by the typesetting team to add pagination, volume and issue details. The re-supplied files will be reloaded to our online platform.'],
    ];
@endphp

@section('content')
<div class="hp">
    <x-archive.pageband title="Journal Publishing Process" :crumbs="['For Authors' => '/instruction-for-author', 'Journal Publishing Process' => null]"
        lead="We know it’s important to you to have your research published as quickly as possible. Our journals offer Rapid Publication Process that allows an article to be published online.">
        <span class="pbf pbf--cyan"><x-homepage.icon name="list" /><span>Stages</span><b>{{ count($steps) }}</b></span>
    </x-archive.pageband>

    <div class="apage">
        <div class="amain">
            <nav class="toc" aria-label="Stages" style="margin-top:0">
                @foreach ($steps as $i => [$t])<a href="#stage-{{ $i + 1 }}">{{ $i + 1 }}. {{ $t }}</a>@endforeach
            </nav>

            <div class="panel" style="padding:22px">
                <ol class="pflow" style="margin:0">
                    @foreach ($steps as $i => [$t, $icon, $text])
                        <li class="pflow__s pflow__s--{{ ($i % 5) + 1 }} sec-anchor" id="stage-{{ $i + 1 }}" style="align-items:flex-start;padding:12px 0">
                            <span class="pflow__ic"><x-homepage.icon :name="$icon" /></span>
                            <div style="min-width:0">
                                <b style="font-size:1rem">{{ $i + 1 }}. {{ $t }}</b>
                                @if ($text)
                                    <small style="font-size:.9rem;line-height:1.7;margin-top:4px">{{ $text }}</small>
                                @else
                                    <small style="font-size:.9rem;line-height:1.7;margin-top:4px">Once the reviewers have read your paper, they will make one of the following recommendations:</small>
                                    <div class="chips" style="margin:8px 0">
                                        <span class="chip">Accept</span><span class="chip">Minor revisions, Major revisions</span><span class="chip">Reject</span>
                                    </div>
                                    <small style="font-size:.9rem;line-height:1.7">The final decision lies with the Editor. Reviewer feedback on the paper will be provided to the corresponding author. Note, if the paper is outside the journal’s scope, some Editor-in-chief may reject it.</small>
                                @endif
                            </div>
                        </li>
                    @endforeach
                </ol>
            </div>

            <x-archive.verify-strip />

            <div class="qlinks">
                <a class="qlink" href="https://editorial.fdrpjournals.org/login?journal=2" target="_blank" rel="noopener noreferrer"><x-homepage.icon name="upload" /> Submit via EMS</a>
                <a class="qlink" href="/guidance-for-ems"><x-homepage.icon name="journal" /> Guidance for EMS</a>
                <a class="qlink" href="/peer-review-policy"><x-homepage.icon name="shield" /> Peer Review Policy</a>
                <a class="qlink" href="/article-processing-charges"><x-homepage.icon name="coins" /> Article Processing Charges</a>
            </div>
        </div>

        <x-archive.sidebar />
    </div>
</div>
@endsection
