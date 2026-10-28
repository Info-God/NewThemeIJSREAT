@extends('layouts.app')

@section('meta_title', 'IJSREAT | Editorial Management System – Article Submission Guidelines')
@section('meta_description', 'Submit your article to IJSREAT through our Editorial Management System. Create an account, choose research area, process mode, and article type for seamless submission.')

@include('archives.partials.theme')

@section('content')
<div class="hp">
    <x-archive.pageband title="Guidance for EMS" :crumbs="['For Authors' => '/instruction-for-author', 'Guidance for EMS' => null]"
        lead="How to use the Editorial Management System (EMS) to submit an article and follow it through review, acceptance, copyright and payment." />

    <div class="apage apage--doc">
        <nav class="doc-toc" aria-label="On this page">
            <p class="doc-toc__h">On this page</p>
                    <a href="#top-dashboard-sections-quick-access-cards">Top Dashboard Sections (Quick Access Cards)</a>
                    <a href="#article-list-section">Article List Section</a>
                    <a href="#new-submission-submit-your-article">New Submission Submit Your Article</a>
                    <a href="#1-details-tab">1 Details Tab</a>
                    <a href="#2-task-tab-workflow-overview">2 Task Tab Workflow Overview</a>
                    <a href="#3-files-tab">3 Files Tab</a>
                    <a href="#4-review-tab">4 Review Tab</a>
                    <a href="#5-acceptance-tab-auto-enable-tabs-based-on-article-acceptance-status">5 Acceptance Tab</a>
                    <a href="#6-copyright-tab-auto-enable-tabs-based-on-article-acceptance-status">6 Copyright Tab</a>
                    <a href="#7-payment-tab-auto-enable-tabs-based-on-article-acceptance-status">7 Payment Tab</a>
                    <a href="#8-final-submission-tab">8 Final Submission Tab</a>
        </nav>
        <div class="amain">
            <div class="doc">

        <div>
            <h2>🧭 EMS Dashboard – Author Interface Structure</h2>
            <h3 id="top-dashboard-sections-quick-access-cards" class="sec-anchor">🔷 Top Dashboard Sections (Quick Access Cards)</h3>
            <div>
                <div>
                    <h4>1. New Submission</h4>
                    <ul>
                        <li>Submit a new manuscript</li>
                    </ul>
                </div>
                <div>
                    <h4>2. Submission Guidelines</h4>
                    <ul>
                        <li>Step-by-step guide to Authors</li>
                    </ul>
                </div>
                <div>
                    <h4>3. View Article Process Timeline</h4>
                    <ul>
                        <li>Visual progress of the article <b>(Submission → Publication)</b></li>
                    </ul>
                </div>
                <div>
                    <h4>4. Review Process</h4>
                    <ul>
                        <li>Review stages and current status</li>
                    </ul>
                </div>
                <div>
                    <h4>5. Action Required</h4>
                    <ul>
                        <li>Pending actions related to the article</li>
                    </ul>
                    <p>(Revisions, profile update, copyright, payment, final submission)</p>
                </div>
            </div>
            <div>
                <h3 id="article-list-section" class="sec-anchor">📄 Article List Section</h3>
                <h4>In Article List View:</h4>
                <ul>
                    <li>Article ID / Paper ID, Article Title, Journal Name, Current Status</li>
                </ul>
                <h4>➡️ Clicking the Paper ID opens the Detailed Article View, including:</h4>
                <ul>
                    <li>Article details, Workflow status, Review reports</li>
                    <li>Acceptance / Payment / Final submission tabs</li>
                </ul>
            </div>
            <div>
                <img src="/EMS_NEW/emsijsreat1.webp" alt="EMS Dashboard interface" />
            </div>
            <div>
                <h3 id="new-submission-submit-your-article" class="sec-anchor">🆕 New Submission – Submit Your Article</h3>
                <p>To submit a new manuscript, please follow the steps below:</p>
                <h4>🔹 Step 1: Start Submission</h4>
                <ul>
                    <li>Click on New Submission from the dashboard.</li>
                </ul>
                <h4>🔹 Step 2: Enter Article Details</h4>
                <p>Fill in all required fields carefully:</p>
                <ul>
                    <li>Research Area</li>
                    <li>Mode of Process (Normal / Fast / Express Track, if applicable)</li>
                    <li>Type of Article (Research Article, Review Article, Case Study, etc.)</li>
                    <li>Type of Issue (Regular Issue / Special Issue)</li>
                    <li>Reviewer Referral ID (Optional)</li>
                </ul>
                <h4>🔹 Step 3: Upload Manuscript</h4>
                <ul>
                    <li>Upload your article file in PDF or Word format only</li>
                    <li>Maximum file size: 10 MB</li>
                    <li>Ensure the manuscript follows the journal guidelines</li>
                </ul>
                <h4>🔹 Step 4: Submit</h4>
                <ul>
                    <li>Verify all entered details and uploaded file.</li>
                    <li>Click Submit to complete the submission process.</li>
                </ul>
            </div>
            <div>
                <img src="/EMS_NEW/emsijsreat2.webp" alt="EMS New Submission Form" />
            </div>
            <div>
                <h3 id="1-details-tab" class="sec-anchor">1️⃣ Details Tab</h3>
                <p><b>Purpose:</b> Provides complete manuscript and journal information</p>
                <p>Includes:</p>
                <ul>
                    <li>Journal Details</li>
                    <li>Article Information</li>
                    <li>Processing Information</li>
                    <li>Type of Article</li>
                    <li>Mode of Processing (Normal / Fast / Express Track, etc.)</li>
                </ul>
            </div>
            <div>
                <img src="/EMS_NEW/emsijsreat3.webp" alt="EMS Details Tab" />
            </div>
            <div>
                <h3 id="2-task-tab-workflow-overview" class="sec-anchor">2️⃣ Task Tab – Workflow Overview</h3>
                <p><b>Purpose:</b> Displays the real-time editorial progress</p>
                <p>Workflow Stages:</p>
                <ol>
                    <li>Editorial Check</li>
                    <li>Plagiarism Check</li>
                    <li>Peer Review</li>
                    <li>Acceptance</li>
                    <li>Proofreading</li>
                    <li>Layout Editing</li>
                    <li>Galley Correction</li>
                    <li>Publishing</li>
                </ol>
            </div>
            <div>
                <img src="/EMS_NEW/emsijsreat4.webp" alt="EMS Task Tab Workflow" />
            </div>
            <div>
                <h3 id="3-files-tab" class="sec-anchor">3️⃣ Files Tab</h3>
                <p><b>Purpose:</b> Central repository for all article-related documents</p>
                <p>Includes:</p>
                <ul>
                    <li>Initially Submitted Manuscript</li>
                    <li>Plagiarism Report</li>
                    <li>Certificates downloads (All authors)</li>
                    <li>Published Article (Final PDF)</li>
                </ul>
            </div>
            <div>
                <img src="/EMS_NEW/emsijsreat5.webp" alt="EMS Files Tab" />
            </div>
            <div>
                <h3 id="4-review-tab" class="sec-anchor">4️⃣ Review Tab</h3>
                <p><b>Purpose:</b> Review monitoring and transparency</p>
                <p>Includes:</p>
                <ul>
                    <li>Review Status</li>
                    <li>Reviewer Comments / Review Reports</li>
                </ul>
            </div>
            <div>
                <img src="/EMS_NEW/emsijsreat6.webp" alt="EMS Review Tab" />
            </div>
            <div>
                <h3 id="5-acceptance-tab-auto-enable-tabs-based-on-article-acceptance-status" class="sec-anchor"><span>5️⃣ Acceptance Tab</span> (🔓 Auto-enable tabs based on article Acceptance status)</h3>
                <p><b>Purpose:</b> Official acceptance communication</p>
                <p>Includes:</p>
                <ul>
                    <li>Acceptance Status</li>
                    <li>Tentative Publication Date</li>
                    <li>Acceptance Letter (Generated after author updates profile details)</li>
                </ul>
            </div>
            <div>
                <img src="/EMS_NEW/emsijsreat7.webp" alt="EMS Acceptance Tab" />
            </div>
            <div>
                <h3 id="6-copyright-tab-auto-enable-tabs-based-on-article-acceptance-status" class="sec-anchor"><span>6️⃣ Copyright Tab</span> (🔓 Auto-enable tabs based on article Acceptance status)</h3>
                <p><b>Purpose:</b> Copyright compliance</p>
                <ul>
                    <li>Enabled <b>after acceptance</b></li>
                    <li>Download copyright form</li>
                    <li>Author must <b>update profile details</b> to generate the form</li>
                    <li>Upload <b>manually signed</b> copyright form</li>
                </ul>
            </div>
            <div>
                <img src="/EMS_NEW/emsijsreat8.webp" alt="EMS Copyright Tab" />
            </div>
            <div>
                <h3 id="7-payment-tab-auto-enable-tabs-based-on-article-acceptance-status" class="sec-anchor"><span>7️⃣ Payment Tab</span> (🔓 Auto-enable tabs based on article Acceptance status)</h3>
                <p><b>Purpose:</b> Article Processing Charge (APC) handling</p>
                <ul>
                    <li>Enabled <b>after acceptance</b></li>
                    <li>APC payment options:</li>
                    <li>o Indian Authors</li>
                    <li>o Non-Indian Authors</li>
                </ul>
            </div>
            <div>
                <img src="/EMS_NEW/emsijsreat9.webp" alt="EMS Payment Tab" />
            </div>
            <div>
                <h3 id="8-final-submission-tab" class="sec-anchor">8️⃣ Final Submission Tab</h3>
                <p><b>Purpose:</b> Final step before publication</p>
                <p>⏱ <b>Timeline:</b> Must be completed <b>within one week of acceptance</b></p>
                <p>Author must upload:</p>
                <ol>
                    <li><b>Final Manuscript</b> (as per journal format)</li>
                    <li><b>Signed Copyright Form</b></li>
                    <li><b>Article Processing Fee Receipt</b></li>
                    <li>o With DOI / Without DOI (as applicable)</li>
                </ol>
                <p>➡️ After successful verification, the article proceeds to <b>publication.</b></p>
            </div>
            <div>
                <img src="/EMS_NEW/emsijsreat10.webp" alt="EMS Final Submission Tab" />
            </div>
        </div>
    
            </div>
            <x-archive.verify-strip />
        </div>
    </div>
</div>
@endsection
