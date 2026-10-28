{{-- Archive sidebar (IJCRT .sb-card style). Content and links are the
     ones the old archive-layout sidebar showed. --}}
@props(['article' => null])

@php
    $quickLinks = [
        ['Aim & Scope', '/aim-and-scope'],
        ['Instruction for Authors', '/instruction-for-author'],
        ['Journal Publishing Process', '/journal-publishing-process'],
        ['Editorial Management System', '/guidance-for-ems'],
        ['Paper Status', '/paper-status'],
        ['Topics', '/topics'],
        ['Call for papers', '/call-for-papers'],
        ['Indexing & Abstracting', '/indexing-and-abstracting'],
        ['Impact Factor', '/impact-Factor'],
        ['Article Processing Charges', '/article-processing-charges'],
    ];
    $policies = [
        ['Ethics & Policies', '/ethics'],
        ['Publication Ethics & Malpractice Statement', '/publication-ethics-policy'],
        ['Peer Review Policy', '/peer-review-policy'],
        ['Plagiarism Policy', '/ethics?target=plagiarism-policy'],
        ['Editorial policies', '/ethics?target=editorial-policies'],
        ['Article withdraw policy', '/ethics?target=article-withdrawal'],
        ['Copyright, Grants and Ownership Declaration', '/ethics?target=copyright-ownership'],
        ['Open Access Policy', '/ethics?target=open-access-policy'],
        ['Cross mark Policy', '/cross-mark-policy'],
        ['Ai policies', '/ai-policies'],
        ['Contact Us', '/contact-us'],
    ];
@endphp

<aside class="aside" aria-label="Sidebar">
    @if ($article)
        <div class="sb sb--accent">
            <h2 class="sb__head"><span class="tic"><x-homepage.icon name="file" /></span>Full Paper</h2>
            <div class="sb__btns">
                <a class="sb__btn" href="{{ $article->paper_pdf_url }}" download><x-homepage.icon name="download" /> Download PDF</a>
                <a class="sb__btn sb__btn--ghost" href="{{ $article->paper_pdf_url }}" target="_blank" rel="noopener noreferrer"><x-homepage.icon name="external" /> View PDF</a>
            </div>
        </div>
        <x-plum-metrics-card :doi="$article->paper_doi" />
    @else
        <div class="sb sb--accent">
            <h2 class="sb__head"><span class="tic"><x-homepage.icon name="send" /></span>Ready to Submit?</h2>
            <p class="sb__text">Submit your Article through our editorial management system.</p>
            <a class="sb__btn" href="https://editorial.fdrpjournals.org/login?journal=2" target="_blank" rel="noopener noreferrer"><x-homepage.icon name="upload" /> Submit Article</a>
        </div>
    @endif

    <div class="sb">
        <h2 class="sb__head"><span class="tic"><x-homepage.icon name="blocks" /></span>Quick Links</h2>
        <ul class="sb-links">
            @foreach ($quickLinks as [$label, $href])
                <li><a href="{{ $href }}">{{ $label }}</a></li>
            @endforeach
        </ul>
    </div>

    <div class="sb">
        <h2 class="sb__head"><span class="tic"><x-homepage.icon name="download" /></span>Download</h2>
        <div class="sb__btns">
            <a class="sb__btn sb__btn--ghost" href="https://ijsreat.com/downloads/manuscript.docx?id=123" target="_blank" download><x-homepage.icon name="file" /> Manuscript Template</a>
            <a class="sb__btn sb__btn--ghost" href="https://ijsreat.com/downloads/copyrights.pdf" target="_blank" download><x-homepage.icon name="doc" /> Copyright Form</a>
        </div>
    </div>

    <div class="sb">
        <h2 class="sb__head"><span class="tic"><x-homepage.icon name="shield" /></span>Policies</h2>
        <ul class="sb-links">
            @foreach ($policies as [$label, $href])
                <li><a href="{{ $href }}">{{ $label }}</a></li>
            @endforeach
        </ul>
    </div>

    <div class="sb">
        <h2 class="sb__head"><span class="tic"><x-homepage.icon name="journal" /></span>About Journal</h2>
        <div class="sb-tags">
            <span class="sb-tag">e-ISSN 2583-1240</span>
            <span class="sb-tag">Since 2021</span>
            <span class="sb-tag">Bi-Monthly</span>
            <span class="sb-tag">Open Access</span>
            <span class="sb-tag">Peer Reviewed</span>
            <span class="sb-tag">DOI 10.59256/ijsreat</span>
        </div>
    </div>
</aside>
