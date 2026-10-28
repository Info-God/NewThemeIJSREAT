@extends('layouts.app')

@section('meta_title', 'IJSREAT | Conference Proceedings – International Journal of Scientific Research in Engineering & Technology')
@section('meta_description', 'IJSREAT collaborates with institutions and universities to publish conference proceedings. We offer peer-reviewed, open-access publication for selected high-quality research papers.')

@include('archives.partials.theme')

@php
    $steps = [
        ['Send Conference Proposal (Initial Contact)', 'The organizing committee must draft a formal email proposal and send it to IJSREAT\'s editorial office. This proposal should include:', [
            'Details Required' => ['Full Conference Title', 'Conference Theme/Topic (Ex: Emerging Trends in Engineering & Technology)', 'Date(s) of the Conference', 'Venue (Online / Offline / Hybrid)', 'Name of Organizing Institution / University / Department', 'Total number of expected research papers to be submitted', 'A brief about review/selection process (if any)', 'Conference website or brochure (if available)', 'Convenor/Chairperson contact details (Name, Email, WhatsApp/Phone)'],
        ], 'email'],
        ['Proposal Evaluation & Editorial Approval', 'Once your email is received, the Editorial Board at IJSREAT will carefully review the proposal for:', [
            'Reviewed for' => ['Academic value', 'Scope alignment with the journal', 'Ethical standards', 'Expected paper count and quality'],
            'If accepted, you will receive' => ['Confirmation email', 'Editable MOU (Memorandum of Understanding) for mutual agreement', 'A dedicated editorial point of contact'],
        ], 'Turnaround Time: Within 1 to 3 working days'],
        ['MOU (Memorandum of Understanding) Signing', 'The MOU (agreement) defines the responsibilities of both parties. It includes:', [
            'Contents of MOU' => ['Number of papers to be considered', 'Discounted publication charges per paper (based on quantity)', 'Review responsibility (Conference or Journal or Shared)', 'Plagiarism and originality check guidelines', 'Deadlines for article submission', 'Mode of communication and support', 'Certificate or acknowledgment requirements'],
        ], 'Once both parties sign the MOU, the collaboration is officially confirmed.'],
        ['Paper Submission & Review Process', 'The Conference Committee must ensure authors follow IJSREAT\'s submission format.', [
            'Submission Guidelines' => ['Title, Abstract, Keywords, and References', 'IEEE or APA style referencing', 'Originality Report (Plagiarism below 20%)', 'PDF or Word format only'],
            'Review Options' => ['Option A: Conference Committee reviews and sends only accepted papers.', 'Option B: IJSREAT arranges peer-review through its panel.'],
            'Each paper undergoes' => ['Plagiarism Check', 'Peer-Review or Quick Editorial Review', 'Revisions (if needed)'],
        ], null],
        ['Publication & Indexing', 'Once papers are accepted, final formatted papers are published in a special conference issue or regular issue.', [
            'Each article receives' => ['e-Certificate of Publication', 'DOI (Digital Object Identifier)', 'Open-access indexing (Google Scholar, CrossRef, ResearchGate, etc.)', 'Journal issue with e-ISSN: 2583-1240'],
        ], 'Timeline: Publication within 5–10 days after final approval.'],
        ['Post-Publication Support', 'After publication:', [
            '' => ['IJSREAT provides a final report with a list of articles, authors, and DOIs.', 'The journal acknowledges the conference and institution name on the website (optional).', 'If required, journal staff can support paper presentations or Q&A sessions during the conference.'],
        ], null],
    ];
    $benefits = [
        ['UGC-CARE Guidelines', 'Credible and recognized by academic institutions', 'shield'],
        ['Fast Publication', 'Get papers published within days after the event', 'clock'],
        ['Low Cost per Paper', 'Special discount pricing for conference bulk papers', 'coins'],
        ['DOI & Indexing', 'Professional academic identity for each article', 'link'],
        ['Certificates for Authors', 'Publication Certificate provided with journal info', 'award'],
        ['Author Dashboard', 'All authors get login access to track their paper', 'monitor'],
        ['Multidisciplinary Scope', 'Accepts papers from all Engineering, CS, Science', 'layers'],
        ['Open Access', 'Global visibility – No paywall to access research', 'lock'],
    ];
    $faqs = [
        ['1. What is the benefit of collaborating with IJSREAT for our conference?', 'IJSREAT offers fast, peer-reviewed publication of selected conference papers with DOI, indexing, and open-access features. It enhances your event\'s academic value and provides global visibility to researchers through an international journal that follows UGC-CARE guidelines.'],
        ['2. Is there a formal agreement or MOU required?', 'Yes. After the proposal is accepted, a Memorandum of Understanding (MOU) will be shared that clearly defines roles, responsibilities, timelines, and the publication process. Both parties must sign it to begin the collaboration officially.'],
        ['3. Can our conference participants publish in IJSREAT at a discounted rate?', 'Yes. IJSREAT offers special discounted publication fees for conference participants when submitted through the conference committee. The exact fee depends on the number of papers and scope of collaboration.'],
        ['4. Do authors receive certificates and DOI for their published papers?', 'Absolutely. Every published paper receives: E-Certificate of Publication, DOI (Digital Object Identifier), indexing on Google Scholar, CrossRef, and other platforms.'],
        ['5. How long does it take to publish selected papers?', 'Publication is usually completed within 5–10 working days after receiving the final versions of accepted papers from the organizing team.'],
        ['6. Who handles the peer-review of submitted papers?', 'There are two options: The conference committee can review and send only selected papers. OR, IJSREAT can perform independent peer review through its editorial board. You may choose either or both options as per the MOU.'],
        ['7. What is the plagiarism policy?', 'IJSREAT strictly follows an anti-plagiarism policy. All papers must have less than 20% similarity as per tools like Turnitin, iThenticate, or equivalent. Plagiarized or duplicate content will be rejected.'],
        ['8. In which format should the papers be submitted?', 'Authors must submit their papers in MS Word (.doc or .docx) format following IJSREAT guidelines, including: Title, Abstract, Keywords, Structured content (Introduction, Methodology, Results, Conclusion), Proper citations and references (IEEE or APA). The template is provided upon approval.'],
        ['9. Can we publish papers from all engineering branches and science streams?', 'Yes. IJSREAT is a multidisciplinary journal, accepting papers from: Engineering (All branches), Technology (All branches), Applied Sciences, Mathematics, Physics, AI, etc.'],
        ['10. How can we track the status of our collaboration or published papers?', 'A dedicated editorial coordinator will be assigned to your event. You can contact them anytime for updates. Additionally, authors can use their author dashboard to track the status of their papers.'],
        ['11. Is there a minimum number of papers required for collaboration?', 'While there is no strict minimum, collaborations are usually preferred for conferences submitting 10 or more papers. However, IJSREAT can support even smaller events based on quality and relevance.'],
        ['12. What kind of support does IJSREAT provide during the conference?', 'IJSREAT can provide: Publication Support, Plagiarism Checks, Speaker Support (if requested), Digital Certificates, Live Session Participation or Q&A support (subject to availability).'],
        ['13. Can we add IJSREAT as a publication partner on our brochure/website?', 'Yes. Once your proposal is approved, you can officially use the IJSREAT logo and name on your conference promotional materials, brochures, and website as a publication partner.'],
        ['14. Whom should we contact for further communication or emergency support?', "You can reach IJSREAT via:\nEmail: editorinchief@ijsreat.com, support@fdrpjournals.org\nWhatsApp / Call: +91-9840521421\nWebsite: www.ijsreat.com"],
    ];
@endphp

@section('content')
<div class="hp">
    <x-archive.pageband title="Conference Proceedings" :crumbs="['Conference' => '/conference', 'Conference Proceedings' => null]"
        lead="Here is a detailed explanation of the full conference collaboration procedure with IJSREAT (The International Journal of Scientific Research in Engineering & Technology - e-ISSN: 2583-1240), along with the purpose, roles, process flow, and post-conference services, FAQ's." />

    <div class="apage">
        <div class="amain">
            <section class="rv-hero" aria-labelledby="cp-about">
                <div>
                    <h2 id="cp-about">About IJSREAT</h2>
                    <p>IJSREAT is a reputed bi-monthly, peer-reviewed, open-access, international multidisciplinary journal that follows UGC-CARE guidelines. It is ideal for engineering researchers, academicians, and Ph.D. scholars to publish high-quality papers. As part of its mission to promote global research, IJSREAT welcomes conference collaborations to support institutions, colleges, and universities in publishing selected conference papers through a structured, ethical, and fast-track process.</p>
                </div>
                <span class="rv-hero__ic" aria-hidden="true"><x-homepage.icon name="users" /></span>
            </section>

            <section aria-labelledby="cp-proc">
                <div class="block-title"><h2 class="rule-title" id="cp-proc">Full Procedure to Apply for Conference Collaboration</h2></div>
                <ol class="rsteps">
                    @foreach ($steps as $i => [$title, $intro, $lists, $note])
                        <li class="rstep">
                            <div style="min-width:0">
                                <b>Step {{ $i + 1 }}: {{ $title }}</b>
                                <span>{{ $intro }}</span>
                                @foreach ($lists as $heading => $items)
                                    @if ($heading)<span style="margin-top:8px;font-weight:700;color:var(--brand-deep)">{{ $heading }}</span>@endif
                                    <ul class="checks" style="margin-top:6px">@foreach ($items as $it)<li>{{ $it }}</li>@endforeach</ul>
                                @endforeach
                                @if ($note === 'email')
                                    <span style="margin-top:10px"><strong style="color:var(--brand-deep)">Email Address:</strong> <a href="mailto:editorinchief@ijsreat.com">editorinchief@ijsreat.com</a>, <a href="mailto:support@fdrpjournals.org">support@fdrpjournals.org</a></span>
                                    <span><strong style="color:var(--brand-deep)">Note:</strong> You may also WhatsApp or call the editor after sending the proposal for confirmation or queries.</span>
                                @elseif ($note)
                                    <span style="margin-top:8px"><strong style="color:var(--brand-deep)">{{ $note }}</strong></span>
                                @endif
                            </div>
                        </li>
                    @endforeach
                </ol>
            </section>

            <section aria-labelledby="cp-why">
                <div class="block-title"><h2 class="rule-title" id="cp-why">Why Collaborate with IJSREAT?</h2></div>
                <div class="bgrid">
                    @foreach ($benefits as [$t, $d, $icon])
                        <div class="bcard2"><span class="ico"><x-homepage.icon :name="$icon" /></span><h3>{{ $t }}</h3><p>{{ $d }}</p></div>
                    @endforeach
                </div>
            </section>

            <section class="cta-band" aria-label="Send a proposal">
                <div class="cta-band__b">
                    <h2>Send your conference proposal</h2>
                    <p>Email the editorial office with your conference details to start a collaboration.</p>
                </div>
                <div class="cta-band__acts">
                    <a class="button button--accent" href="mailto:editorinchief@ijsreat.com"><x-homepage.icon name="mail" /> Email the Editor</a>
                    <a class="button button--ghost" href="/conference">Published Conferences</a>
                </div>
            </section>

            <section aria-labelledby="cp-faq">
                <div class="block-title"><h2 class="rule-title" id="cp-faq">IJSREAT Conference Collaboration – FAQ's</h2></div>
                @foreach ($faqs as $i => [$q, $a])
                    <details class="faq-item" @if ($i === 0) open @endif>
                        <summary class="faq-q">{{ $q }}</summary>
                        <p class="faq-a">{!! nl2br(e($a)) !!}</p>
                    </details>
                @endforeach
            </section>
        </div>

        <x-archive.sidebar />
    </div>
</div>
@endsection
