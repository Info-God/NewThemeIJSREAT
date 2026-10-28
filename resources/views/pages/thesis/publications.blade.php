@extends('layouts.app')

@section('meta_title', 'IJSREAT | Thesis Publication – International Journal of Scientific Research in Engineering & Technology')
@section('meta_description', 'Publish your thesis or dissertation with IJSREAT, an open-access peer-reviewed journal in engineering and technology. Submit original, plagiarism-free work for global visibility.')

@include('archives.partials.theme')

@php
    $emsUrl = 'https://editorial.fdrpjournals.org/login?journal=2';
    $procedure = [
        ['Prepare Your Thesis/Dissertation', [
            'Ensure your thesis/dissertation follows IJSREAT’s formatting guidelines (font, structure, citations, etc.).',
            'The Thesis should be original, unpublished, and free from plagiarism.',
            'Typical sections: Abstract, Keywords, Introduction, Methodology, Results, Discussion, Conclusion, References.',
        ]],
        ['Submit Your Thesis/Dissertation', [
            'Submit via Editorial management system (EMS).',
            'Upload your manuscript in Word (.doc/.docx) or PDF format.',
            'Fill in author details (name, affiliation, email, etc.).',
        ]],
        ['Pay the Publication Fee (if applicable)', [
            'IJSREAT may charge a processing/publication fee INR 5000/USD 150 (varies based on paper length, type, and urgency).',
        ]],
        ['Peer Review Process', [
            'The paper undergoes a review process (may take 1–3 weeks).',
            'You may receive revision requests.',
        ]],
        ['Acceptance & Publication', [
            'If accepted, you’ll receive an acceptance letter via EMS.',
            'Upon acceptance via EMS, and payment (if applicable), the thesis is published in the next available issue.',
            'You’ll receive a digital certificate and a soft copy of the journal.',
        ]],
    ];
    $terms = [
        ['Originality & Plagiarism', ['The Thesis/dissertation work must be original (not published elsewhere).', 'Plagiarism should be below 15–20% (checked via Turnitin/iThenticate).']],
        ['Copyright Policy', ['Authors retain copyright but grant IJSREAT the right to publish.', 'Some rights may be reserved under Creative Commons licenses.']],
        ['Publication Fees', ['Open-access journals charge INR 5000/USD 150 (TPC - Thesis Processing Charge).', 'Confirm the current fee before submission.']],
        ['Ethical Guidelines', ['Follow COPE (Committee on Publication Ethics) standards.', 'Fabricated data, duplicate submissions, or unethical practices lead to rejection.']],
        ['Withdrawal Policy', ['Once submitted, withdrawal may incur a fee or require justification.']],
        ['Indexing & Archiving', ['IJSREAT is indexed in Google Scholar, ResearchBib, Elsevier Mendeley, SSRN, Thomson Reuters Research ID etc.']],
    ];
    $faqs = [
        ['IJSREAT Submission Process Timeline:', 'The total time from submission to publication typically takes 1-2 weeks, depending on the review process and revisions.'],
        ['Submissions Timeline (No Fixed Deadline):', 'No fixed deadline. Issues published monthly/quarterly.'],
        ['Can I publish my entire thesis in IJSREAT?', 'Yes. Extract key findings as a research paper. Adapt content to fit IJSREAT scope (Science/engineering/technology). Avoid self-plagiarism (cite your thesis if reusing text/data).'],
        ['What’s the submission process?', 'Prepare Manuscript: Follow IJSREAT template. Submit Online: Via Editorial Management System (EMS) (register as author). Peer Review: Takes 2-4 weeks; may require revisions. Payment: If accepted, pay the Thesis Processing Charge. Publication: Thesis/dissertation appears in the next available issue.'],
        ['Is IJSREAT peer-reviewed?', 'Yes, all publications are peer-reviewed. Verify recent publications for quality, and be cautious of predatory signs.'],
        ['What’s the Thesis publication fee?', 'Estimated: INR 5000 / USD 150. Inquire with the editor about the current fee structure and eligibility for waivers.'],
        ['Does IJSREAT provide a certificate?', 'Yes, upon payment and final approval, digital certificates are typically emailed to the corresponding author.'],
        ['Copyright Policy:', 'Authors retain copyright but grant IJSREAT publishing rights under Creative Commons Attribution-NonCommercial (CC BY-NC).'],
        ['Can I withdraw my paper?', 'Yes, but it may incur a withdrawal fee if peer review has already commenced. You must write to the editor with a valid justification.'],
    ];
@endphp

@section('content')
<div class="hp">
    <x-archive.pageband title="Thesis Publication" :crumbs="['Thesis' => '/thesis', 'Thesis Publication' => null]"
        lead="The International Journal of Scientific Research in Engineering & Technology (IJSREAT) is an open-access journal that publishes research papers in engineering and technology. Below are the application procedure and publication terms & conditions for submitting your thesis/dissertation work." />

    <div class="apage">
        <div class="amain">
            <section class="cta-band" aria-label="Submit a thesis">
                <div class="cta-band__b">
                    <h2>Publish your thesis or dissertation</h2>
                    <p>Submit through the Editorial Management System (EMS). Published theses appear in the IJSREAT thesis archive.</p>
                </div>
                <div class="cta-band__acts">
                    <a class="button button--accent" href="{{ $emsUrl }}" target="_blank" rel="noopener noreferrer"><x-homepage.icon name="upload" /> Submit via EMS</a>
                    <a class="button button--ghost" href="/thesis">Thesis Archive</a>
                </div>
            </section>

            <section aria-labelledby="th-proc">
                <div class="block-title"><h2 class="rule-title" id="th-proc">Procedure to Apply for Publication in IJSREAT</h2></div>
                <ol class="rsteps">
                    @foreach ($procedure as [$title, $points])
                        <li class="rstep"><div><b>{{ $title }}</b>@foreach ($points as $pt)<span>{{ $pt }}</span>@endforeach</div></li>
                    @endforeach
                </ol>
            </section>

            <section aria-labelledby="th-terms">
                <div class="block-title"><h2 class="rule-title" id="th-terms">Publication Terms &amp; Conditions</h2></div>
                <div class="terms">
                    @foreach ($terms as [$title, $points])
                        <div class="term"><h3>{{ $title }}</h3><ul>@foreach ($points as $pt)<li>{{ $pt }}</li>@endforeach</ul></div>
                    @endforeach
                </div>
            </section>

            <section aria-labelledby="th-pub">
                <div class="block-title">
                    <h2 class="rule-title" id="th-pub">Published Theses</h2>
                    <a class="hlink" href="/thesis">Thesis archive <x-homepage.icon name="arrow" /></a>
                </div>
                @if ($publications->isNotEmpty())
                    <div class="chips">
                        @foreach ($publications as $pub)
                            <a class="chip" href="{{ route('thesis.issue', ['year' => $pub->thesis_year, 'volume' => $pub->thesis_volume]) }}">{{ $pub->thesis_year }} · Volume {{ $pub->thesis_volume }}</a>
                        @endforeach
                    </div>
                @else
                    <p class="empty">No theses have been published yet.</p>
                @endif
            </section>

            <section aria-labelledby="th-faq">
                <div class="block-title"><h2 class="rule-title" id="th-faq">Thesis/Dissertation Publication FAQs</h2></div>
                @foreach ($faqs as $i => [$q, $a])
                    <details class="faq-item" @if ($i === 0) open @endif>
                        <summary class="faq-q">{{ $q }}</summary>
                        <p class="faq-a">{{ $a }}</p>
                    </details>
                @endforeach
            </section>
        </div>

        <x-archive.sidebar />
    </div>
</div>
@endsection
