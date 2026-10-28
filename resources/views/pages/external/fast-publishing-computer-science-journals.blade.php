@extends('layouts.app')

@section('meta_title', 'Fast Publishing Computer Science Journals | Quick Indexing')
@section('meta_description', 'Publish in fast publishing computer science journals with rapid peer review, quick indexing, and international recognition.')

@include('archives.partials.theme')

@section('content')
<div class="hp">
    <x-archive.pageband title="Fast Publishing Computer Science Journals – IJSREAT" :crumbs="['Fast Publishing Computer Science Journals – IJSREAT' => null]" />

    <div class="apage apage--doc">
        <nav class="doc-toc" aria-label="On this page">
            <p class="doc-toc__h">On this page</p>
            <a href="#about-fast-publishing-cse-journals">About Fast Publishing CSE Journals</a>
            <a href="#why-choose-ijsreat-fast-publishing-cse-journal">Why Choose IJSREAT – Fast Publishing CSE Journal?</a>
            <a href="#indexing-abstracting">Indexing &amp; Abstracting</a>
            <a href="#streamlined-publication-process">Streamlined Publication Process</a>
            <a href="#article-processing-charges">Article Processing Charges</a>
            <a href="#advanced-editorial-management-system">Advanced Editorial Management System</a>
        </nav>
        <div class="amain">
            <div class="doc doc--landing">

        <div>
            <div>
                <h2 id="about-fast-publishing-cse-journals" class="sec-anchor">About Fast Publishing CSE Journals</h2>
                <p>
                    International Journal of Scientific Research in Engineering & Technology (IJSREAT) is a leading CSE journal recognized in the category of fast publishing computer science journals. Published three times a year, IJSREAT provides an open-access, peer-reviewed platform for academicians, researchers, engineers, and industry professionals to share innovative research across all domains of Computer Science and emerging technologies.
                </p>
                <p>
                    Our journal adheres to UGC-CARE guidelines and follows a rigorous peer-review process, ensuring credibility, scholarly excellence, and global visibility.
                </p>
                <h3>🔹 Topics Covered</h3>
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
                    We encourage interdisciplinary submissions and research demonstrating practical applications of computing technologies.
                </p>
            </div>
            <div>
                <h2 id="why-choose-ijsreat-fast-publishing-cse-journal" class="sec-anchor">Why Choose IJSREAT – Fast Publishing CSE Journal?</h2>
                <ul>
                    <li><span>⚡ Rapid Peer Review:</span> Decisions within 3 days, placing us in the top fast publishing computer science journals.</li>
                    <li><span>🌍 Open Access:</span> Immediate global reach for your research.</li>
                    <li><span>✅ Efficient Publication Process:</span> Quick responses from submission to publication.</li>
                    <li><span>🔒 Plagiarism Protection:</span> Ensuring academic integrity with advanced detection tools.</li>
                    <li><span>📜 COPE Compliance:</span> Maintaining the highest publication ethics.</li>
                    <li><span>🌐 Global Impact:</span> Research that shapes thinking, policy, and technological innovation.</li>
                </ul>
            </div>
            <div>
                <h2 id="indexing-abstracting" class="sec-anchor">Indexing &amp; Abstracting</h2>
                <p>IJSREAT is indexed in leading scholarly databases:</p>
                <p>
                    Google Scholar &bull; Scribd &bull; ISSUU &bull; Elsevier Mendeley &bull; EuroPub &bull; DRJI &bull; Academic Keys &bull; Edocr &bull; I2OR &bull; PDFSR &bull; ResearchBIB &bull; SSRN &bull; WorldCAT &bull; Exlibris (Clarivate) &bull; Thomson Reuters Research ID &bull; Semantic Scholar &bull; Dimensions &bull; PlumX
                </p>
            </div>
            <div>
                <h2 id="streamlined-publication-process" class="sec-anchor">Streamlined Publication Process</h2>
                <ul>
                    <li><span>📩 Submit Online:</span> 24/7 via our editorial system</li>
                    <li><span>⏳ Initial Response:</span> Within 12 hours</li>
                    <li><span>👨‍🏫 Expert Review:</span> Completed in 2 days</li>
                    <li><span>📢 Decision Notification:</span> Acceptance/rejection within 3 days</li>
                    <li><span>📜 Publication &amp; Certificate:</span> Instant PDF access and digital certificate</li>
                </ul>
            </div>
            <div>
                <h2 id="article-processing-charges" class="sec-anchor">Article Processing Charges</h2>
                <p>Open-access journal with minimal fees post-acceptance:</p>
                <ul>
                    <li><span>Indian Authors (Without DOI):</span> ₹1200 + 18% GST</li>
                    <li><span>Indian Authors (With DOI):</span> ₹1400 + 18% GST</li>
                    <li><span>International Authors (With DOI):</span> $80 USD</li>
                </ul>
            </div>
            <div>
                <h2 id="advanced-editorial-management-system" class="sec-anchor">Advanced Editorial Management System</h2>
                <ul>
                    <li><span>Author Dashboard:</span> Submission history &amp; status tracking</li>
                    <li><span>Real-time Tracking:</span> Monitor every stage of your paper</li>
                    <li><span>Automated Documents:</span> Instant acceptance letters &amp; copyright forms</li>
                    <li><span>Easy Downloads:</span> Certificates and published papers with one click</li>
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
