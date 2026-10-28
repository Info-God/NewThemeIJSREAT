@extends('layouts.app')

@section('meta_title', 'Top Computer Science Journals | High Impact Indexed')
@section('meta_description', 'Publish your work in top computer science journals with high impact factor, peer review, and global academic recognition.')

@include('archives.partials.theme')

@section('content')
<div class="hp">
    <x-archive.pageband title="Top Computer Science Journals" :crumbs="['Top Computer Science Journals' => null]" />

    <div class="apage apage--doc">
        <nav class="doc-toc" aria-label="On this page">
            <p class="doc-toc__h">On this page</p>
            <a href="#indian-journal-of-computer-science-and-technology-ijsreat">International Journal of Scientific Research in Engineering & Technology (IJSREAT)</a>
            <a href="#about-ijsreat">📖 About IJSREAT</a>
            <a href="#scope-of-the-journal">🔹 Scope of the Journal</a>
            <a href="#why-choose-ijsreat">Why Choose IJSREAT?</a>
            <a href="#indexing-abstracting">Indexing &amp; Abstracting</a>
            <a href="#streamlined-publication-process">Streamlined Publication Process</a>
            <a href="#article-processing-charges">Article Processing Charges</a>
            <a href="#advanced-editorial-management-system">Advanced Editorial Management System</a>
        </nav>
        <div class="amain">
            <div class="doc doc--landing">

        <!-- Hero Section -->
        <div>
            <h2 id="indian-journal-of-computer-science-and-technology-ijsreat" class="sec-anchor">International Journal of Scientific Research in Engineering & Technology (IJSREAT)</h2>
            <p>
                Recognized among the top computer science journals for publishing high-quality research across Artificial Intelligence, IoT, Data Science, Cybersecurity, and emerging technologies.
            </p>
        </div>
        <div>
            <!-- About Section -->
            <div>
                <h2 id="about-ijsreat" class="sec-anchor"><span>📖</span> About IJSREAT</h2>
                <p>
                    Published three times a year, IJSREAT provides an open-access, peer-reviewed platform for academicians, educators, researchers, engineers, and industry professionals to showcase innovative work. Adhering strictly to UGC-CARE guidelines, IJSREAT follows a rigorous peer-review process to maintain the highest standards of academic excellence and credibility.
                </p>
            </div>
            <!-- Scope Section -->
            <div>
                <h2 id="scope-of-the-journal" class="sec-anchor"><span>🔹</span> Scope of the Journal</h2>
                <div>
                    @foreach([
                        "Artificial Intelligence & Machine Learning",
                        "Data Science & Big Data Analytics",
                        "Internet of Things (IoT)",
                        "Cloud & Edge Computing",
                        "Cybersecurity & Cryptography",
                        "Software Engineering & Programming Languages",
                        "Computer Networks & Network Security",
                        "Image Processing & Computer Vision",
                        "Natural Language Processing",
                        "Human-Computer Interaction",
                        "Web Technologies & Mobile Computing",
                        "Blockchain Technology",
                        "Robotics & Automation",
                        "Embedded Systems",
                        "Computational Intelligence",
                        "Bioinformatics & Health Informatics",
                        "Information Systems & Database Management"
                    ] as $item)
                        <div>
                            {{ $item }}
                        </div>
                    @endforeach
                </div>
            </div>
            <!-- Why Choose Section -->
            <div>
                <h2 id="why-choose-ijsreat" class="sec-anchor">Why Choose IJSREAT?</h2>
                <div>
                    <div>
                        <div>
                            <span>⚡</span>
                            <div>
                                <h4>Rapid Peer Review</h4>
                                <p>Decisions within 3 days.</p>
                            </div>
                        </div>
                        <div>
                            <span>🌐</span>
                            <div>
                                <h4>Open Access Policy</h4>
                                <p>Immediate visibility worldwide.</p>
                            </div>
                        </div>
                        <div>
                            <span>✅</span>
                            <div>
                                <h4>Efficient Process</h4>
                                <p>Streamlined workflow ensures timely responses.</p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div>
                            <span>🔒</span>
                            <div>
                                <h4>Plagiarism Protection</h4>
                                <p>Advanced academic integrity checks.</p>
                            </div>
                        </div>
                        <div>
                            <span>📜</span>
                            <div>
                                <h4>COPE Compliance</h4>
                                <p>Following global publication ethics.</p>
                            </div>
                        </div>
                        <div>
                            <span>🌟</span>
                            <div>
                                <h4>Research Impact</h4>
                                <p>Contributing to global innovation.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Indexing Section -->
            <div>
                <h2 id="indexing-abstracting" class="sec-anchor">Indexing &amp; Abstracting</h2>
                <p>
                    IJSREAT is indexed in leading scholarly databases, enhancing reach and credibility.
                </p>
                <div>
                    @foreach([
                        "Google Scholar",
                        "Elsevier Mendeley",
                        "EuroPub",
                        "DRJI",
                        "Academic Keys",
                        "ResearchBIB",
                        "SSRN",
                        "WorldCAT",
                        "Semantic Scholar",
                        "Dimensions",
                        "PlumX",
                        "Thomson Reuters Research ID"
                    ] as $db)
                        <div>
                            {{ $db }}
                        </div>
                    @endforeach
                </div>
            </div>
            <!-- Publication Process -->
            <div>
                <h2 id="streamlined-publication-process" class="sec-anchor">Streamlined Publication Process</h2>
                <div>
                    <ol>
                        <li>
                            <span>
                                <span>1</span>
                            </span>
                            <h3>📩 Submit Online</h3>
                            <p>24/7 via editorial system.</p>
                        </li>
                        <li>
                            <span>
                                <span>2</span>
                            </span>
                            <h3>⏳ Initial Response</h3>
                            <p>Within 12 hours.</p>
                        </li>
                        <li>
                            <span>
                                <span>3</span>
                            </span>
                            <h3>👨‍🏫 Peer Review</h3>
                            <p>Completed in 2 days.</p>
                        </li>
                        <li>
                            <span>
                                <span>4</span>
                            </span>
                            <h3>📢 Decision Notification</h3>
                            <p>Within 3 days.</p>
                        </li>
                        <li>
                            <span>
                                <span>5</span>
                            </span>
                            <h3>📜 Publication &amp; Certificate</h3>
                            <p>Instant PDF &amp; certificate.</p>
                        </li>
                    </ol>
                </div>
            </div>
            <!-- Fees Section -->
            <div>
                <h2 id="article-processing-charges" class="sec-anchor">Article Processing Charges</h2>
                <div>
                    <div>
                        <h3>Indian Authors</h3>
                        <p>Without DOI: ₹1200 + 18% GST</p>
                        <p>With DOI: ₹1400 + 18% GST</p>
                    </div>
                    <div>
                        <h3>International Authors</h3>
                        <p>With DOI: $80 USD</p>
                    </div>
                </div>
            </div>
            <!-- Editorial System Section -->
            <div>
                <h2 id="advanced-editorial-management-system" class="sec-anchor">Advanced Editorial Management System</h2>
                <div>
                    <div>
                        <span>📊</span>
                        <div>
                            <h4>Author Dashboard</h4>
                            <p>Personalized submission tracking.</p>
                        </div>
                    </div>
                    <div>
                        <span>⏱️</span>
                        <div>
                            <h4>Real-time Tracking</h4>
                            <p>Monitor paper progress.</p>
                        </div>
                    </div>
                    <div>
                        <span>📑</span>
                        <div>
                            <h4>Automated Documents</h4>
                            <p>Instant acceptance letters.</p>
                        </div>
                    </div>
                    <div>
                        <span>⬇️</span>
                        <div>
                            <h4>Easy Downloads</h4>
                            <p>One-click certificates &amp; papers.</p>
                        </div>
                    </div>
                </div>
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
