@extends('layouts.app')

@section('meta_title', 'Journal for Computer Science Research | Publish CS Papers')
@section('meta_description', 'Submit your papers to a journal for computer science research. Indexed, peer-reviewed, and widely recognized in the academic community.')

@include('archives.partials.theme')

@section('content')
<div class="hp">
    <x-archive.pageband title="Journal for Computer Science Research" :crumbs="['Journal for Computer Science Research' => null]" />

    <div class="apage apage--doc">
        <nav class="doc-toc" aria-label="On this page">
            <p class="doc-toc__h">On this page</p>
            <a href="#trusted-journal-for-computer-science-research">Trusted Journal for Computer Science Research</a>
            <a href="#scope-of-the-journal">🔹 Scope of the Journal</a>
            <a href="#why-choose-ijsreat">Why Choose IJSREAT?</a>
            <a href="#indexing-abstracting">Indexing &amp; Abstracting</a>
            <a href="#streamlined-publication-process">Streamlined Publication Process</a>
            <a href="#article-processing-charges-affordable-cse-journal">Article Processing Charges – Affordable CSE Journal</a>
            <a href="#advanced-editorial-management-system">Advanced Editorial Management System</a>
        </nav>
        <div class="amain">
            <div class="doc doc--landing">

        <div>
            <div>
                <h2 id="trusted-journal-for-computer-science-research" class="sec-anchor">Trusted Journal for Computer Science Research</h2>
                <p>
                    International Journal of Scientific Research in Engineering & Technology (IJSREAT) is a leading CSE journal and a renowned journal for computer science research. Published three times a year, IJSREAT provides an open-access, peer-reviewed platform for academicians, educators, researchers, engineers, and industry professionals to share innovative research across all domains of Computer Science and emerging technologies.
                </p>
                <p>
                    Adhering strictly to UGC-CARE guidelines, IJSREAT ensures every manuscript undergoes a thorough peer-review process, maintaining credibility, integrity, and scholarly excellence. This makes it a preferred journal for computer science scholars and professionals globally.
                </p>
            </div>
            <div>
                <h2 id="scope-of-the-journal" class="sec-anchor"><span>🔹</span> Scope of the Journal</h2>
                <ul>
                    <li>Artificial Intelligence &amp; Machine Learning</li>
                    <li>Data Science &amp; Big Data Analytics</li>
                    <li>Internet of Things (IoT)</li>
                    <li>Cloud &amp; Edge Computing</li>
                    <li>Cybersecurity &amp; Cryptography</li>
                    <li>Software Engineering &amp; Programming Languages</li>
                    <li>Computer Networks &amp; Network Security</li>
                    <li>Image Processing &amp; Computer Vision</li>
                    <li>Natural Language Processing</li>
                    <li>Human-Computer Interaction</li>
                    <li>Web Technologies &amp; Mobile Computing</li>
                    <li>Blockchain Technology</li>
                    <li>Robotics &amp; Automation</li>
                    <li>Embedded Systems</li>
                    <li>Computational Intelligence</li>
                    <li>Bioinformatics &amp; Health Informatics</li>
                    <li>Information Systems &amp; Database Management</li>
                </ul>
                <p>
                    We encourage interdisciplinary research and submissions demonstrating practical applications, making IJSREAT an essential journal for computer science academics.
                </p>
            </div>
            <div>
                <h2 id="why-choose-ijsreat" class="sec-anchor">Why Choose IJSREAT?</h2>
                <ul>
                    <li><span>⚡ Rapid Peer Review:</span> Decisions within 3 days.</li>
                    <li><span>🌐 Open Access:</span> Research reaches global readers, policymakers, and industry leaders instantly.</li>
                    <li><span>✅ Efficient Process:</span> Streamlined workflow saves time from submission to publication.</li>
                    <li><span>🔒 Plagiarism Protection:</span> Ensures academic integrity via advanced screening systems.</li>
                    <li><span>📜 COPE Compliance:</span> Adheres to ethical standards in academic publishing.</li>
                    <li><span>🌟 Global Impact:</span> Research that influences technology, innovation, and policy-making.</li>
                </ul>
            </div>
            <div>
                <h2 id="indexing-abstracting" class="sec-anchor">Indexing &amp; Abstracting</h2>
                <p>
                    IJSREAT is indexed in leading platforms, ensuring maximum visibility:
                </p>
                <p>
                    Google Scholar &bull; Scribd &bull; ISSUU &bull; Elsevier Mendeley &bull; EuroPub &bull; DRJI &bull; Academic Keys &bull; Edocr &bull; I2OR &bull; PDFSR &bull; ResearchBIB &bull; SSRN &bull; WorldCAT &bull; Exlibris (Clarivate) &bull; Thomson Reuters Research ID &bull; Semantic Scholar &bull; Dimensions &bull; PlumX
                </p>
                <p>
                    Being part of the Google Scholar computer science journals list, IJSREAT is recognized as a top journal for computer science research.
                </p>
            </div>
            <div>
                <h2 id="streamlined-publication-process" class="sec-anchor">Streamlined Publication Process</h2>
                <ul>
                    <li><span>📩 Submit Online:</span> 24/7 access via our editorial system</li>
                    <li><span>⏳ Initial Response:</span> Within 12 hours</li>
                    <li><span>👨‍🏫 Expert Peer Review:</span> Completed in 2 days</li>
                    <li><span>📢 Decision Notification:</span> Acceptance/rejection within 3 days</li>
                    <li><span>📜 Publication &amp; Certificate:</span> Instant PDF access and digital certificate</li>
                </ul>
            </div>
            <div>
                <h2 id="article-processing-charges-affordable-cse-journal" class="sec-anchor">Article Processing Charges – Affordable CSE Journal</h2>
                <p>
                    Open-access publishing with minimal fees:
                </p>
                <ul>
                    <li><span>Indian Authors (Without DOI):</span> ₹1200 + 18% GST</li>
                    <li><span>Indian Authors (With DOI):</span> ₹1400 + 18% GST</li>
                    <li><span>International Authors (With DOI):</span> $80 USD</li>
                </ul>
            </div>
            <div>
                <h2 id="advanced-editorial-management-system" class="sec-anchor">Advanced Editorial Management System</h2>
                <ul>
                    <li><span>Author Dashboard:</span> Personalized submission history and status updates</li>
                    <li><span>Real-time Tracking:</span> Monitor every stage of your paper</li>
                    <li><span>Automated Documents:</span> Instant acceptance letters &amp; copyright forms</li>
                    <li><span>Easy Downloads:</span> One-click access to certificates and published papers</li>
                </ul>
            </div>
        </div>
    
            </div>

            <div class="qlinks">
                <a class="qlink" href="https://editorial.fdrpjournals.org/login?journal=2" target="_blank" rel="noopener noreferrer"><x-homepage.icon name="upload" /> Submit via EMS</a>
                <a class="qlink" href="/aim-and-scope"><x-homepage.icon name="cpu" /> Aim &amp; Scope</a>
                <a class="qlink" href="/indexing-and-abstracting"><x-homepage.icon name="database" /> Indexing &amp; Abstracting</a>
                <a class="qlink" href="/article-processing-charges"><x-homepage.icon name="coins" /> Article Processing Charges</a>
            </div>
        </div>
    </div>
</div>
@endsection
