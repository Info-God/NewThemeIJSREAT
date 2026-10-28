@extends('layouts.app')

@section('meta_title', 'Thesis Publication | IJSREAT')
@section('meta_description', 'Application procedure and publication terms & conditions for submitting your thesis or dissertation to International Journal of Scientific Research in Engineering & Technology (IJSREAT).')

@include('archives.partials.theme')

@php
    $emsUrl = 'https://editorial.fdrpjournals.org/login?journal=2';
    $procedure = [
        ['Prepare Your Thesis/dissertation', [
            'Ensure your thesis/dissertation follows IJSREAT’s formatting guidelines (font, structure, citations, etc.).',
            'The Thesis should be original, unpublished, and free from plagiarism.',
            'Typical sections: Abstract, Keywords, Introduction, Methodology, Results, Discussion, Conclusion, References.',
        ]],
        ['Submit Your Thesis/dissertation', [
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
        ['Indexing & Archiving', ['IJSREAT is indexed in Google Scholar, ResearchBib, Elsevier Mendeley, SSRN, Thomson Reuters Research ID etc. (check latest status).']],
    ];
    $faqs = [
        ['IJSREAT Submission Process Timeline:', 'The total time from submission to publication in International Journal of Scientific Research in Engineering & Technology (IJSREAT) typically takes 1-2 weeks, depending on the review process and revisions.'],
        ['Submissions Time line (No Fixed Deadline):', 'No fixed deadline. Issues published monthly/quarterly.'],
        ['Can I publish my entire thesis in IJSREAT?', 'Yes. Extract key findings as a research paper. Adapt content to fit IJSREAT scope (Science/engineering/technology). Avoid self-plagiarism (cite your thesis if reusing text/data).'],
        ['What’s the submission process?', "• Prepare Manuscript: Follow IJSREAT template (check website).
• Submit Online: Via Editorial Management System (EMS) (register as author).
• Peer Review: Takes 2-4 weeks; may require revisions.
• Payment: If accepted, pay the Thesis Processing Charge.
• Publication: Thesis/dissertation appears in the next available issue."],
        ['Is IJSREAT peer-reviewed?', "Claimed to be, but:
• Verify recent publications for quality.
• Check if reviewers’ comments are provided.
• Be cautious of predatory signs (e.g., rapid acceptance without review)."],
        ['What’s the Thesis publication fee?', 'Not explicitly stated on their website (contact editor for details). Estimated: INR 5000/USD 150 (common for open-access journals). Fee waivers: Rare; inquire if from a low-income country.'],
        ['How long does publication take?', "• Review: 1–2 weeks.
• Post-acceptance: 1–2 weeks (depending on issue schedule)."],
        ['Does IJSREAT provide a certificate?', 'Yes, upon payment and final approval. Digital certificates are typically emailed.'],
        ['Copyright Policy:', 'Authors retain copyright but grant IJSREAT publishing rights. Uses Creative Commons License (CC BY-NC) for open access.'],
        ['Can I withdraw my paper?', 'Yes, but:
• May incur a withdrawal fee (if peer review has started).
• Must email the editor with justification.'],
        ['Tips to Avoid Rejection:', '• Ensure <15% plagiarism (use Turnitin/iThenticate).
• Follow IJSREAT’s formatting guidelines strictly.
• Focus on applied engineering/technology topics.'],
    ];
    $partners = DB::table('indexings')->get();
@endphp

@section('content')
<div class="hp">
    <x-archive.pageband title="Thesis Publication" :crumbs="['Thesis Publication' => null]"
        lead="International Journal of Scientific Research in Engineering & Technology (IJSREAT) is an open-access journal that publishes research papers in engineering and technology. Below are the application procedure and publication terms & conditions for submitting your thesis/dissertation work." />

    <div class="apage">
        <div class="amain">
            <section class="cta-band" aria-label="Submit a thesis">
                <div class="cta-band__b">
                    <h2>Publish your thesis or dissertation</h2>
                    <p>Submit through the Editorial Management System (EMS).</p>
                </div>
                <div class="cta-band__acts">
                    <a class="button button--accent" href="{{ $emsUrl }}" target="_blank" rel="noopener noreferrer"><x-homepage.icon name="upload" /> Submit via EMS</a>
                    <a class="button button--ghost" href="/publications">Publications</a>
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

            <section aria-labelledby="th-faq">
                <div class="block-title"><h2 class="rule-title" id="th-faq">Thesis/Dissertation Publication FAQs</h2></div>
                @foreach ($faqs as $i => [$q, $a])
                    <details class="faq-item" @if ($i === 0) open @endif>
                        <summary class="faq-q">{{ $q }}</summary>
                        <p class="faq-a">{!! nl2br(e($a)) !!}</p>
                    </details>
                @endforeach
            </section>

            @if ($partners->isNotEmpty())
                <section aria-labelledby="th-ix">
                    <div class="block-title">
                        <h2 class="rule-title" id="th-ix">Indexing &amp; Abstracting</h2>
                        <a class="hlink" href="/indexing-and-abstracting">View details <x-homepage.icon name="arrow" /></a>
                    </div>
                    <x-homepage.logo-marquee :partners="$partners" />
                </section>
            @endif
        </div>

        <x-archive.sidebar />
    </div>
</div>
@endsection
