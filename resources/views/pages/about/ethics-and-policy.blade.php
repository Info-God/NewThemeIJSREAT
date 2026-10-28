@extends('layouts.app')

@section('meta_title', 'IJSREAT | Ethics & Policies – International Journal of Scientific Research in Engineering & Technology')
@section('meta_description', 'IJSREAT upholds strong ethics and policies in publishing, following double-blind peer review and COPE guidelines to ensure integrity, originality, and high-quality research.')

@include('archives.partials.theme')

@php
    $partners = DB::table('indexings')->get();
@endphp

@section('content')
<div class="hp">
    <x-archive.pageband title="Ethics & Policies" :crumbs="['Ethics & Policies' => null]"
        lead="Standards of expected ethical behaviour for authors, editors, reviewers and the publisher of IJSREAT.">
        <span class="pbf pbf--cyan"><x-homepage.icon name="shield" /><span>Policies</span><b>14</b></span>
    </x-archive.pageband>

    <div class="apage apage--doc"
         x-data="{
             openId: null,
             init() {
                 const target = new URLSearchParams(window.location.search).get('target') || window.location.hash.slice(1);
                 if (target && document.getElementById(target)) {
                     this.openId = target;
                     const jump = () => document.getElementById(target)?.scrollIntoView({ block: 'start' });
                     this.$nextTick(jump);
                     window.addEventListener('load', () => setTimeout(jump, 50), { once: true });
                 }
             },
             toggle(id) { this.openId = (this.openId === id) ? null : id; },
             go(id) {
                 this.openId = id;
                 history.replaceState(null, '', '?target=' + id);
                 setTimeout(() => document.getElementById(id)?.scrollIntoView({ block: 'start' }), 320);
             }
         }">
        <nav class="doc-toc" aria-label="Policies on this page">
            <p class="doc-toc__h">Policies</p>
            <a href="#ethics-topics">Ethics topics to consider</a>
                <a href="?target=publication-ethics" @click.prevent="go('publication-ethics')">Publication Ethics</a>
                <a href="?target=editorial-policies" @click.prevent="go('editorial-policies')">Editorial Policies</a>
                <a href="?target=author-responsibilities" @click.prevent="go('author-responsibilities')">Author Responsibilities</a>
                <a href="?target=instructions-for-authors" @click.prevent="go('instructions-for-authors')">Instructions for Authors</a>
                <a href="?target=ethics-malpractice" @click.prevent="go('ethics-malpractice')">Publication Ethics & Malpractice Statement</a>
                <a href="?target=article-withdrawal" @click.prevent="go('article-withdrawal')">Article withdraw policy</a>
                <a href="?target=plagiarism-policy" @click.prevent="go('plagiarism-policy')">Plagiarism Policy</a>
                <a href="?target=peer-review-policy" @click.prevent="go('peer-review-policy')">Peer Review Policy</a>
                <a href="?target=copyright-ownership" @click.prevent="go('copyright-ownership')">Copyright, Grants and Ownership Declaration</a>
                <a href="?target=open-access-policy" @click.prevent="go('open-access-policy')">Open Access Policy</a>
                <a href="?target=archiving-policy" @click.prevent="go('archiving-policy')">Archiving policy</a>
                <a href="?target=repository-policy" @click.prevent="go('repository-policy')">Repository policy</a>
                <a href="?target=journal-metrics" @click.prevent="go('journal-metrics')">Journal Metrics</a>
                <a href="?target=advertising-policy" @click.prevent="go('advertising-policy')">Advertising Policy</a>
        </nav>
        <div class="amain">
            <div class="doc">

                    <p>
                        International Journal of Scientific Research in Engineering & Technology (IJSREAT) is (Online), Bi-monthly international journal for publication of new ideas founded by academicians, educationist, engineers and corporate people. The research results and fund FDRP ental advancement are all aspects of Innovative Research in Advanced Engineering & Technology and various engineering disciplines, etc. IJSREAT is a scholarly open access, Peer Review Journal which helps to academic person as well as student community. IJSREAT provides the academic community and industry for the submission of original research and applications related to Various Engineering discipline and Advanced Technologies by Fifth Dimension Research Publications (FDRP) Tamil Nadu, India since year 2020.
                    </p>
                    <p>
                        The publication of an article in a peer-reviewed journal is an essential building block in the development of a coherent and respected network of knowledge. It is a direct reflection of the quality of work of the author and the institutions that support them. Double Blind Peer-reviewed articles support and embody the scientific method. It is therefore important to agree upon standards of expected ethical behaviour.
                    </p>
                
            </div>

            @if ($partners->isNotEmpty())
                <x-homepage.logo-marquee :partners="$partners" />
            @endif

            <div class="doc">
<h2 class="sec-anchor" id="ethics-topics">
                        Ethics topics to consider when publishing:
                    </h2>
                    <ul>
                        <li>
                            <span>Authorship of the paper:</span> Authorship should be limited to those who have made a significant contribution to the conception, design, execution, or interpretation of the reported study.
                        </li>
                        <li>
                            <span>Originality and plagiarism:</span> The authors should ensure that they have written entirely original works, and if the authors have used the work and/or words of others that this has been appropriately cited or quoted.
                        </li>
                        <li>
                            <span>Data access and retention:</span> Authors may be asked to provide the raw data in connection with a paper for editorial review, and should be prepared to provide public access to such data.
                        </li>
                        <li>
                            <span>Multiple, redundant or concurrent publication:</span> An author should not in general publish manuscripts describing essentially the research in more than one journal or primary publication. FDRP Journals do not view the following uses of a work as prior publication: publication in the form of an abstract; publication as an academic thesis; publication as an electronic preprint. Information on prior publication is included within each FDRP journal Guide for Authors.
                        </li>
                        <li>
                            <span>Acknowledgement of sources:</span> Proper acknowledgment.
                        </li>
                        <li>
                            <span>Disclosure and conflicts of interest:</span> All submissions must include disclosure of all relationships that could be viewed as presenting a potential conflict of interest.
                        </li>
                        <li>
                            <span>Fundamental errors in published works:</span> When an author discovers a significant error or inaccuracy in his/her own published work, it is the author’s obligation to promptly notify the journal editor or publisher and cooperate with the editor to retract or correct the paper.
                        </li>
                        <li>
                            <span>Reporting standards:</span> Authors of reports of original research should present an accurate account of the work performed as well as an objective discussion of its significance.
                        </li>
                        <li>
                            <span>Hazards and human or animal subjects:</span> Statements of compliance are required if the work involves chemicals, procedures or equipment that have any unusual hazards inherent in their use, or if it involves the use of animal or human subjects.
                        </li>
                        <li>
                            <span>Use of patient images or case details:</span> Studies on patients or volunteers require ethics committee approval and informed consent, which should be documented in the paper.
                        </li>
                    </ul>
                
            </div>

            <div class="pols">
                {{-- Accordion Item: Publication Ethics --}}
                <section id="publication-ethics" class="pol sec-anchor" :class="{ 'is-open': openId === 'publication-ethics' }">
                    <h2 class="pol__h"><button type="button" class="pol__btn" @click="toggle('publication-ethics')" :aria-expanded="(openId === 'publication-ethics').toString()" aria-controls="publication-ethics-body"><span>Publication Ethics</span><span class="pol__chev" aria-hidden="true"></span></button></h2>
                    <div id="publication-ethics-body" class="pol__body doc" x-show="openId === 'publication-ethics'" x-collapse>
                        <div>
                            <p>
                                <span>Originality & Plagiarism:</span> Submitted manuscripts must be original and not plagiarized. Proper citations must be given for any borrowed content.
                            </p>

                            <p>
                                <span>Authorship Criteria:</span> All listed authors must have significantly contributed to the research. Ghost, guest, or gift authorship is prohibited.
                            </p>

                            <p>
                                <span>Conflict of Interest:</span> Authors must disclose any financial or personal conflicts that could influence the research.
                            </p>

                            <p>
                                <span>Data Integrity:</span> Fabrication, falsification, or manipulation of data is unethical and will lead to rejection or retraction.
                            </p>

                            <p>
                                <span>Simultaneous Submission:</span> Submitting the same manuscript to multiple journals at once is not allowed.
                            </p>

                            <p>
                                <span>Peer Review:</span> The journal follows a peer-review process to ensure quality.
                            </p>
                        </div>
                    </div>
                </section>

                {{-- Accordion Item: Editorial Policies --}}
                <section id="editorial-policies" class="pol sec-anchor" :class="{ 'is-open': openId === 'editorial-policies' }">
                    <h2 class="pol__h"><button type="button" class="pol__btn" @click="toggle('editorial-policies')" :aria-expanded="(openId === 'editorial-policies').toString()" aria-controls="editorial-policies-body"><span>Editorial Policies</span><span class="pol__chev" aria-hidden="true"></span></button></h2>
                    <div id="editorial-policies-body" class="pol__body doc" x-show="openId === 'editorial-policies'" x-collapse>
                        <div>
                            <div>
                                <h3>1. Allegations of misconduct</h3>
                                <p>
                                    International Journal of Scientific Research in Engineering & Technology resolves all the allegations and research misconduct on publication ethics and publication malpractice. We follow the code of conduct and best publication practices in scientific publication and adhere to the guidelines of the <span>Committee on Publication Ethics (COPE), World Association of Medical Editors (WAME), and International Committee of Medical Journal Editors (ICMJE).</span>
                                </p>
                            </div>
                            <ul>
                                <li>Authors must certify that the manuscript is not currently being considered for publication elsewhere. Submitting the same paper to more than one journal constitutes unethical publishing practice.</li>
                                <li>Submitting or releasing someone else's hypothesis or idea, stealing content and research work is an abuse of the original creator’s work and is considered to be unethical.</li>
                                <li>Research misconduct is considered to be fabrication and plagiarism which does not include errors while writing by the author or differences in thoughts of the co-authors.</li>
                                <li>Authors are obliged to provide retractions or corrections of mistakes at any point in time if the author(s) discovers a significant error or inaccuracy in the submitted manuscript the corresponding authors will be asked to provide an explanation and evidence if required.</li>
                                <li>If the author of the reported article accepts the misconduct complaint, the editorial office will take action depending on the situation.</li>
                                <li>After the article publication article gets reported of any misconduct then an erratum or retraction may be necessary to remedy the situation.</li>
                                <li>If the misconduct is reported during the review process, the review process may continue, with the author(s) making the relevant changes.</li>
                                <li>Non-reporting of observed misconduct, and covering up suspected research misconduct by others is also considered to be unethical.</li>
                            </ul>
                            <h4>Our team will definitely take necessary action for any reported allegations and research misconduct.</h4>

                            <div>
                                <h3>Retraction Policy</h3>
                                <p>
                                    International Journal of Scientific Research in Engineering & Technology will do retraction of articles when there are significant errors, Ethical concerns and fraudulent data in the published work.
                                    <br /><br />
                                    Retractions are a way for journals to maintain the integrity of the scientific record. This can happen for many reasons like plagiarism, falsification of data, Ethical violations, multiple submissions of articles and authorship issues, etc.
                                    <br /><br />
                                    Every retraction issued will lead to publication for providing a valid reason for it or sometimes an author explanation is needed as well and we follow the <span>COPE Retraction guidelines</span>. Please contact <a href="mailto:editorinchief@ijsreat.com">editorinchief@ijsreat.com</a> for such cases.
                                </p>
                            </div>

                            <div>
                                <h3>Erratum</h3>
                                <p>
                                    It is a small error or mistake, typically one found in a printed work after it has been published. These errors are specific errors such as typos, formatting, graphical changes, or spelling mistakes, grammatical errors etc but do not alter the original findings of the research. Erratum occurs when the publishers make mistakes instead of the authors, thus there is no fee associated with them for the author. It is given by the editor production team and mistakes will be underlined and will be mentioned in a separate section at the end of the print copy if the errors will be notified under a specific time period.
                                </p>
                            </div>

                            <div>
                                <h3>Corrigendum</h3>
                                <p>
                                    These errors are found in printed work after the publishing of the manuscript. These errors are specific errors such as Spelling errors, changes in the author's affiliation, documentation or any legal changes, requests for more authors, content addition and omissions of information, etc. which are associated with authors. If these changes are minor then can be rectified and the article will be printed in another issue with correction. If major errors are there, it will lead to some costing and proper discussion or investigation if required and will be published in other print copies after correction.
                                </p>
                            </div>

                            <div>
                                <h3>2. Authorship and contributorship</h3>
                                <p>
                                    The concept of authorship is understood in such a way that each author of the authorship of the manuscript contributed to the research, in a certain part. In the event of doubts on the part of the editors, which may be based on the inconsistency of the content of the manuscript, the competences of one of the authors in the field of scientific interests, the editors can request from the author team in a separate document data with the distribution of the contribution to the research and preparation of the manuscript, with a separate emphasis on the author's contribution, about which doubts arose.
                                    <br /><br />
                                    An author-correspondent is selected from the composition of the author's team, who interacts with the editorial office. He is responsible for turning the manuscript into an article and its subsequent publication, as well as at the stage after the publication of the article, if such a need arises. If there is a reasoned necessity on the part of the authors to remove or add co-authors, or to change the order of authors, such changes after submission of the manuscript are possible with the approval of the corresponding author.
                                    <br /><br />
                                    The authorship identification process also involves preventing the appearance of ghost authors and guest authors as part of the author's team.
                                </p>
                            </div>

                            <div>
                                <h3>3. Complaints and appeals</h3>
                                <p>
                                    The following procedure is applicable to appeals of editorial judgements, grievances over procedural errors, such as protracted delays in handling papers, and grievances regarding publication ethics.
                                    <br /><br />
                                    The Editor-in-Chief(s) responsible for the journal and/or the Editor who handled the paper should handle the complaint in the first instance.
                                    <br /><br />
                                    Send a message to the publisher's contact at <a href="mailto:editorinchief@ijsreat.com">editorinchief@ijsreat.com</a> if they are the target of the complaint.
                                    <br /><br />
                                    Complaints within a year of the original publication date will be considered about any published items. Authors are requested to send any concerns to the editorial office by email at <a href="mailto:editorinchief@ijsreat.com">editorinchief@ijsreat.com</a> along with their justifications.
                                </p>
                            </div>

                            <div>
                                <h3>4. Conflicts of interest/competing interests</h3>
                                <p>
                                    IJSREAT’s Conflict of Interest policy is based on the COPE’s definition and guidelines: ‘Conflicts of interest comprise those which may not be fully apparent and which may influence the judgment of author, reviewers, and editors. They have been described as those which, when revealed later, would make a reasonable reader feel misled or deceived. They may be personal, commercial, political, academic or financial.
                                    <br /><br />
                                    “Financial” interests may include employment, research funding, stock or share ownership, payment for lectures or travel, consultancies and company support for staff.’ <a href="https://publicationethics.org/files/u7141/1999pdf13.pdf" target="_blank">https://publicationethics.org/files/u7141/1999pdf13.pdf</a>
                                </p>
                            </div>

                            <div>
                                <h4>Responsibilities of Participants</h4>
                                <h5>Authors</h5>
                                <p>
                                    Authors are responsible for reporting any financial Conflict of Interest related to their research. In additional to financial COI other types of competing interests like personal relationships, academic commitments, institutional obligations etc., which might affect the outcome of their work. All authors should fill the declaration form completely and submit it along with the article.
                                </p>
                                <h5>Journals / Publisher action:</h5>
                                <ul>
                                    <li>The statement of conflict of interest should be mentioned after the acknowledgement section in each article.</li>
                                    <li>If there are no conflicts, the Disclosures section should include the following statement: “The authors declare no conflicts of interest.”</li>
                                </ul>
                                <h5>Reviewers</h5>
                                <p>
                                    Reviewers should declare all potential competing or conflicting interests. It includes personal, financial, intellectual, professional, political or religious in nature. It will also include employed in the same institution as any of the authors or have been recent (e.g., within the past 3 years), close collaborators or joint grant holders.
                                </p>
                                <h5>Journals / Publisher action</h5>
                                <p>
                                    Reviewers should be asked if they have a COI with the content or authors of a manuscript. If they do, they should be removed from the review process.
                                </p>
                                <h5>Editors</h5>
                                <p>
                                    Editors should not make any editorial decisions if they have or a close family member has a financial COI. It will also include political/religious COI or personal COI with respect to the authors or their work. COI also includes if the article is submitted from their own institution. For articles submitted by editors to same journal, it should be handled by another member of Editorial Board.
                                </p>
                                <h5>Journals / Publisher action:</h5>
                                <p>
                                    Editors who make final decisions about manuscripts should recuse themselves from editorial decisions if they have conflicts of interest or relationships that pose potential conflicts related to articles under consideration.
                                </p>
                            </div>

                            <div>
                                <h3>5. Data and reproducibility</h3>
                                <p>
                                    It is normal to present the results of the author’s research in the conference proceedings regardless of whether the paper was presented, accepted or published. Indeed, this is common practice in many fields. In general, copyright law applies to the original expression of ideas, it may restrict an author from distributing a paper in a conference proceedings, it does not prohibit an author from creating a new presentation using ideas from this manuscript. The journal would do well to explain what the authors mean by the notion of “full text”.
                                    <br /><br />
                                    It would be prudent if authors did not share an unpublished manuscript with the conference committee to prevent erroneous duplicate publication. Authors should also consider what materials, figures, tables, etc. they would be happy to share before publication and in what format.
                                    <br /><br />
                                    It would also be good practice for authors to indicate in the paper that the results were presented in part (or in full) in conference proceedings.
                                </p>
                            </div>

                            <div>
                                <h3>6. Ethical oversight</h3>
                                <p>
                                    According to the Committee on Publication Ethics (COPE), ethical oversight should include, but is not limited to, policies fee on consent to publication, publication on vulnerable populations, ethical conduct of research using animals, ethical conduct of research using human subjects, handling confidential data and ethical business/marketing practices.
                                    <br /><br />
                                    For studies involving data relating to human or animal experimental investigations, appropriate institutional review board approval is required and should be described within the article. For investigations involving human subjects, authors should explain how informed consent was obtained from the participants involved. Patients have a right to privacy that should not be infringed without informed consent. Identifying information should not be included unless the information is essential for scientific purposes and the patient (or parent or legal guardian) gives written informed consent for publication. When informed consent has been obtained it should be indicated in the manuscript. In attempting to maintain patient anonymity, identifying details should be omitted where they are not essential. However, patient data should never be amended or falsified. Informed consent should be obtained whenever there is any doubt that anonymity can be assured.
                                    <br /><br />
                                    Ethics approval for all studies must be obtained before the research is conducted. Authors must be prepared to provide further information to the journal editorial office upon request.
                                </p>
                            </div>

                            <div>
                                <h3>7. Intellectual property</h3>
                                <p>
                                    The Article Processing Charge (APC) allows IJSREAT to provide open access to all the articles it publishes. The fee is set at a minimal possible level to ensure the inclusivity of submissions. It covers the publishing services provided by IJSREAT and allows for its continued operations.
                                    <br /><br />
                                    The fee covers the following services:
                                    Online tools for editors and authors;
                                    Articles' production, secure hosting, and dissemination;
                                    Abstracting and indexing;
                                    Customer support.
                                    <br /><br />
                                    The fee is payable upon the acceptance of a paper for publication. The INR1400/USD 60 fee (does not include VAT or local taxes) must be paid by the authors, their institution, or funder before the paper is made publicly available. Authors whose papers get accepted for publishing will be notified of the approval and the outstanding payment. Please note that papers will not be published until the APC is paid.
                                    <br /><br />
                                    APC can be paid via a credit card using IJSREAT’s via a bank transfer/Razorpay Payment Gateway, in which case the author must request the invoice and arrange for the payment within 30 days following the paper’s publication approval.
                                    <br /><br />
                                    The author who publishes in IJSREAT agrees to the following terms:
                                    The journal allows the authors to hold the copyright without restrictions and allows the authors to retain publishing rights without restrictions. Authors retain copyright and grant the journal right of first publication with the work simultaneously licensed under a Creative Commons Attribution 4.0 International License.
                                    <br /><br />
                                    Authors can enter into separate, additional contractual arrangements for the non-exclusive distribution of the journal’s published version of the work (e.g., post it to an institutional repository or publish it in a book), with an acknowledgement of its initial publication in this journal.
                                    <br /><br />
                                    Authors are permitted and encouraged to post their work online (e.g., in institutional repositories or on their website) before and during the submission process, as it can lead to productive exchanges, as well as earlier and greater citation of published work. International Journal of Scientific Research in Engineering & Technology (IJSREAT) is (Online) (IJSREAT). (E-ISSN: 2583-1240) is licensed under a Creative Commons Attribution 4.0 International License.
                                    <br /><br />
                                    The journal is licensed under an Attribution 4.0 International (CC BY 4.0).
                                    <br /><br />
                                    You are free to:<br />
                                    Share — copy and redistribute the material in any medium or format<br />
                                    Adapt — remix, transform, and build upon the material for any purpose, even commercially.
                                    <br /><br />
                                    The licensor cannot revoke these freedoms as long as you follow the license terms.
                                    Under the following terms:<br />
                                    Attribution — You must give appropriate credit, provide a link to the license, and indicate if changes were made. You may do so in any reasonable manner, but not in any way that suggests the licensor endorses you or your use.<br />
                                    No additional restrictions — You may not apply legal terms or technological measures that legally restrict others from doing anything the license permits.<br />
                                    All papers will be published with DOI Identifier.
                                </p>
                            </div>

                            <div>
                                <h3>Duplicate Submission</h3>
                                <p>
                                    Authors should not submit the same manuscript, in the same or different languages, simultaneously to more than one journal. The rationale for this standard is the potential for disagreement when two (or more) journals claim the right to publish a manuscript that has been submitted simultaneously to more than one journal, and the possibility that two or more journals will unknowingly and unnecessarily undertake the work of peer review, edit the same manuscript, and publish the same article.
                                </p>
                            </div>

                            <div>
                                <h3>Duplicate and Prior Publication</h3>
                                <p>
                                    Duplicate publication is publication of a paper that overlaps substantially with one already published, without clear, visible reference to the previous publication. Prior publication may include release of information in the public domain.
                                    <br /><br />
                                    Readers of journal deserve to be able to trust that what they are reading is original unless there is a clear statement that the author and editor are intentionally republishing an article (which might be considered for historic or landmark papers, for example). The bases of this position are international copyright laws, ethical conduct, and cost-effective use of resources. Duplicate publication of original research is particularly problematic because it can result in inadvertent double-counting of data or inappropriate weighting of the results of a single study, which distorts the available evidence.
                                    When authors submit a manuscript reporting work that has already been reported in large part in a published article or is contained in or closely related to another paper that has been submitted or accepted for publication elsewhere, the letter of submission should clearly say so and the authors should provide copies of the related material to help the editor decide how to handle the submission.
                                    Authors who choose to post their work on a preprint server should choose one that clearly identifies preprints as not peer-reviewed work and includes disclosures of authors’ relationships and activities. It is the author’s responsibility to inform a journal if the work has been previously posted on a preprint server.
                                </p>
                            </div>

                            <div>
                                <h3>8. Peer review processes</h3>
                                <p>
                                    International Journal of Scientific Research in Engineering & Technology (IJSREAT) is having ISSN NO: 2583-1240 (Online), Bi-monthly international journal for publication of new ideas founded by academicians, educationist, engineers and corporate people. The research results and FDRP advancement are all aspects of Innovative Research in Advanced Engineering & Technology and various engineering disciplines, etc. IJSREAT is a scholarly open access, Single Peer Review Journal which helps to academic person as well as student community. IJSREAT provides the academic community and industry for the submission of original research and applications related to Various Engineering discipline and Advanced Technologies by FDRP Publications, Tamil Nadu, India since year 2020.
                                    <br /><br />
                                    Reviewers play a central role in scholarly publishing. IJSREAT uses Single peer review process, which means that both the reviewer(s) and author(s) identities are concealed from the reviewer(s), and vice versa, throughout the review process. This means that the reviewer(s) of the paper won’t get to know the identity of the author(s), and the author(s) won’t get to know the identity of the reviewer(s). Peer review helps validate research, establish a method by which it can be evaluated, and increase networking possibilities within research communities. Despite criticisms, peer review is still the only widely accepted method for research validation.
                                    <br /><br />
                                    All submitted papers will be reviewed by Single peer review process which may take minimum 01 to 03 weeks from the date of submission. We are advising to all the author(s), do not submit same paper to the multiple journals. You should wait for review status of paper.
                                    <br /><br />
                                    IJSREAT is committed to prompt evaluation and publication of fully accepted papers. To maintain a high-quality publication, all submissions undergo a rigorous review process. Characteristics of the peer review process are as follows:
                                    <br /><br />
                                    Simultaneous submissions of the same manuscript to different journals will not be tolerated.
                                    Manuscripts with contents outside the scope will not be considered for review.
                                    <br /><br />
                                    Papers will be refereed by at least 3 or 4 experts (reviewers) as suggested by the editorial board in which 01 from India and rest 02 or 03 from overseas.
                                    <br /><br />
                                    In addition, Editors will have the option of seeking additional reviews when needed.
                                    <br /><br />
                                    Authors will be informed when Editors decide further review is required. All publication decisions are made by the journal’s Editors-in-Chief on the basis of the referees’ reports (reviewers report). Authors of papers that are not accepted are notified promptly.
                                    <br /><br />
                                    All submitted manuscripts are treated as confidential documents. All submitted papers will be reviewed by double blind review process.
                                    <br /><br />
                                    All manuscripts submitted for publication in IJSREAT cross-checked for plagiarism software. Manuscripts found to be plagiarized during initial stages of review are out-rightly rejected and not considered for publication in the journal.
                                    <br /><br />
                                    In case if a manuscript is found to be plagiarized after publication, the Editor-in-Chief will conduct preliminary investigation, may be with the help of a suitable committee constituted for the purpose. If the manuscript is found to be plagiarized beyond the acceptable limits, the journal will contact the author’s Institute / College / University and Funding Agency, if any.
                                </p>
                            </div>

                            <div>
                                <h3>9. Post-publication discussions and corrections</h3>
                                <p>
                                    IJSREAT allows post-publication discussion on the journal’s website, through emails to the editor-in-chief. IJSREAT has mechanisms for correcting, revising, or retracting articles after publication.
                                </p>
                            </div>

                            <div>
                                <h3>Correction Policy</h3>
                                <p>
                                    Erratum is an error that affects the accuracy of the published paper, and the reputation of the authors. Errata are published as distinct articles. IJSREAT publishes errata in the case of a serious mistake or a factual error or omission in the methods, results, or conclusions. To warrant an erratum, the scientific error must be serious enough to affect the scientific content of the article and interpretation of results.
                                </p>
                            </div>

                            <div>
                                <h3>Cases that raise an erratum:</h3>
                                <ul>
                                    <li>A figure or table was not explained and mentioned correctly;</li>
                                    <li>A figure or table was missed out;</li>
                                    <li>Incorrect results were included in a table;</li>
                                    <li>An author accidentally is missed out.</li>
                                </ul>
                                <p>
                                    A notice of correction will be issued by IJSREAT to the article and correct considerable errors that appear in online articles when these errors considerably affect the content or understanding of the work reported (e.g., error in data presentation) or when the error affects the publication’s metadata (e.g., misspelling of an author’s name). In these cases, IJSREAT will publish a correction that will be linked to the original article.
                                    Furthermore, IJSREAT assumes authors inform the editorial office of any errors they have observed (or have been informed of) in their article once published.
                                </p>
                            </div>

                            <div>
                                <h3>Removal of Published Content:</h3>
                                <ul>
                                    <li>In extraordinary situations, IJSREAT reserves the right to remove a paper from its website. This happens when:</li>
                                    <li>IJSREAT is advised that content is libelous that contains false information about a method or a researcher;</li>
                                    <li>Infringes a third party’s intellectual property right, right to privacy, or another legal right;</li>
                                    <li>It causes an immediate and serious risk to safety and integrity if acted upon.</li>
                                </ul>
                            </div>

                            <div>
                                <h3>Addenda</h3>
                                <p>
                                    An addendum is a notification to add information to a published paper. It should be noted that the supplements do not contradict the original publication and are not used to fix the error. For the errors, IJSREAT will publish a correction notice. Actually, if the author needs to update or add some key information then, they can publish an addendum. According to the IJSREAT policies, the addenda may be peer-reviewed and are normally subject to oversight by the editor of the research article.
                                </p>
                            </div>

                            <div>
                                <h3>10. Research ethics</h3>
                                <p>
                                    International Journal of Scientific Research in Engineering & Technology (IJSREAT) is having ISSN NO: 2583-1240 (Online), Bi-monthly international journal is committed to maintaining the highest standards of ethical conduct throughout the publication process. We adhere strictly to the guidelines and standards set by the Committee on Publication Ethics (COPE). These guidelines ensure best practices in areas such as duplicate publication, conflicts of interest, patient consent, and more. For detailed information on these policies, please refer to the author guidelines.
                                </p>
                            </div>

                            <div>
                                <h3>11. Diversity (DEIA)</h3>
                                <p>
                                    The IJSREAT of Fifth Dimension Research Publication invites submissions from historically marginalised scholars within the academic landscape, encompassing a broad spectrum of individuals whose viewpoints and experiences, shaped by their geographic backgrounds, institutional affiliations, gender identities, (dis)abilities, language proficiency, and various other distinctive characteristics, are of immense value to our academic community. The journal is deeply committed to fostering an inclusive environment that amplifies a rich tapestry of diverse voices and perspectives, providing a vital platform for those whose narratives may often go unheard in traditional academic circles. Through this commitment, the journal aims to enrich discourse and scholarship by highlighting the invaluable insights that these underrepresented scholars bring to the field.
                                    <br /><br />
                                    The IJSREAT of Fifth Dimension Research Publication (FDRP) is committed to fostering equitable opportunities that embrace and honour the diversity inherent in all individuals, regardless of gender, ethnicity, sexual orientation, age, religion, or socioeconomic status. The journal stands against any forms of bias, discrimination, and racism, striving to foster an environment where everyone feels valued and respected. The Editor-in-Chief is deeply committed to these principles, ensuring they are integrated into every aspect of editorial practices, including a thorough and transparent approach to article submissions and a rigorous peer-review process, all aimed at cultivating a fair and inclusive academic community. Through these efforts, the journal seeks to promote dialogue and understanding among diverse perspectives, inspiring scholars, including historically marginalised ones, to contribute and enrich the scholarly landscape.
                                </p>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- Accordion Item: Author Responsibilities --}}
                <section id="author-responsibilities" class="pol sec-anchor" :class="{ 'is-open': openId === 'author-responsibilities' }">
                    <h2 class="pol__h"><button type="button" class="pol__btn" @click="toggle('author-responsibilities')" :aria-expanded="(openId === 'author-responsibilities').toString()" aria-controls="author-responsibilities-body"><span>Author Responsibilities</span><span class="pol__chev" aria-hidden="true"></span></button></h2>
                    <div id="author-responsibilities-body" class="pol__body doc" x-show="openId === 'author-responsibilities'" x-collapse>
                        <div>
                            <h2>Author Responsibilities</h2>
                            <p>
                                <span>Accuracy:</span> Authors must ensure the accuracy of their work and promptly correct errors if found.
                            </p>
                            <p>
                                <span>Copyright & Licensing:</span> Authors may need to transfer copyright or publish under an open-access license (check the journal’s policy).
                            </p>
                            <p>
                                <span>Retractions & Corrections:</span> If errors are discovered post-publication, authors must cooperate in issuing corrections or retractions.
                            </p>
                        </div>
                    </div>
                </section>

                {{-- Accordion Item: Instructions for Authors --}}
                <section id="instructions-for-authors" class="pol sec-anchor" :class="{ 'is-open': openId === 'instructions-for-authors' }">
                    <h2 class="pol__h"><button type="button" class="pol__btn" @click="toggle('instructions-for-authors')" :aria-expanded="(openId === 'instructions-for-authors').toString()" aria-controls="instructions-for-authors-body"><span>Instructions for Authors</span><span class="pol__chev" aria-hidden="true"></span></button></h2>
                    <div id="instructions-for-authors-body" class="pol__body doc" x-show="openId === 'instructions-for-authors'" x-collapse>
                        <article>
                            <p>
                                International Journal of Scientific Research in Engineering & Technology (IJSREAT) is (Online), Bi-monthly international journal for publication of new ideas founded by academicians, educationist, engineers and corporate people. The research results and fundamental advancement are all aspects of Innovative Research in Advanced Engineering & Technology and various engineering disciplines, etc. IJSREAT is a scholarly open access, Single Peer Review Journal which helps to academic person as well as student community. IJSREAT provides the academic community and industry for the submission of original research and applications related to Various Engineering discipline and Advanced Technologies by Fifth Dimension Research Publications (FDRP), Tamil Nadu, and India since year 2020.
                                <br /><br />
                                Papers for the regular issues of the journal can be submitted, round the year, electronically at Editorial Management System / <a href="mailto:editorinchief@ijsreat.com">editorinchief@ijsreat.com</a>, after the final acceptance of the paper, based upon the detailed review process, the paper will immediately be published online. However, assignment of the paper to a specific Volume / Issue of the Journal will be taken up by the Editorial Board later; and the author will be intimated accordingly. For Theme Based Special Issues, time bound Special Call for Papers will be announced and the same will be applicable for that specific issue only.
                                <br /><br />
                                Submission of a paper implies that the work described has not been published previously and is not under consideration for publication elsewhere. The submission should be approved by all the authors of the paper. If a paper is finally accepted, the authorities, where the work had been carried out, shall be responsible for not publishing the work elsewhere in the same form. Paper, once submitted for consideration in IJSREAT, cannot be withdrawn unless the same is finally rejected.
                            </p>
                            <div>
                                <h3>Manuscript Submission:</h3>
                                <p>
                                    Submission of a manuscript implies: that the work described has not been published before; that it is not under consideration for publication anywhere else; that its publication has been approved by all co-authors, if any, as well as by the responsible authorities or explicitly at the institute where the work has been carried out. The publisher will not be held legally responsible should there be any claims for compensation.
                                </p>
                            </div>
                            <div>
                                <h3>Permissions</h3>
                                <p>
                                    Authors wishing to include figures, tables, or text passages that have already been published elsewhere are required to obtain permission from the copyright owner(s) for both the print and online format and to include evidence that such permission has been granted when submitting their papers. Any material received without such evidence will be assumed to originate from the authors.
                                </p>
                            </div>

                            <section>
                                <h3>Author(s) be sure that:</h3>
                                <p>
                                    <span>Plagiarism Check:</span> Good quality plagiarism software/ tool Crosscheck / Turnitin Plagiarism detection tools will be used to check similarity that would not be more than 20% including reference section. In the case of exclusion of references, it should be less than 5%.
                                </p>
                                <p>
                                    <span>Quality Check:</span> All submitted paper should be cutting edge, result oriented, original paper and under the scope of the journal that should belong to the engineering and technology area. In the paper title, there should not be word ‘Overview/brief/ Introduction, Review, Case study/ Study, Survey, Approach, Comparative, Analysis, Comparative Investigation, Investigation’.
                                </p>
                                <p>
                                    <span>Paper Submission Criteria:</span> Any one author cannot submit more than 05 papers for the same volume/issue.
                                </p>
                                <p>
                                    <span>Review Criteria:</span> This journal uses double-blind review process, which means that both the reviewer (s) and author (s) identities concealed from the reviewers, and vice versa, throughout the review process. All submitted manuscripts are reviewed by three reviewer one from India and rest two from overseas. There should be proper comments of the reviewers for the purpose of acceptance/ rejection. There should be minimum 02 to 03 week time window for it.
                                </p>
                                <p>
                                    <span>eCopyright:</span> All authors will submit e-copyright to the Journal/ FDRP, India.
                                </p>
                                <p>
                                    <span>Template:</span> All accepted papers should be formatted as per IJSREAT Journal Template. It is be sure that contents of the paper are fine and satisfactory. Author(s) can make rectification in the final paper but after the final submission to the journal, rectification is not possible. In the formatted paper, volume no/ issue no will be in the right top corner of the paper. In the case of failure, the papers will be declined from the database of journal and publishing house.
                                </p>
                                <p>
                                    <span>Updation in the Paper:</span> Final paper is prepared as per journal the template. Contents of the paper are fine and satisfactory. Author (s) can make rectification in the final paper but after the final submission to the journal, rectification is not possible.
                                </p>
                                <p>
                                    <span>Copyright Property:</span> After the publication, conference proceeding will be property of FDRP, India and journal.
                                </p>
                                <p>
                                    <span>Publication Fee:</span> Journal is free. Journal will not take any kind of fee/processing fee/handling fee/review fee.
                                </p>
                                <p>
                                    <span>APC:</span> Article Processing Charge (APC) is not a publication fee of the journal. APC is to be taken by publication house that is ‘FDRP, India’. It is not taken by journal. APC is applicable for per paper one time. It means, have to pay for every paper (article). Author is free to withdraw his/her paper at any time but before signing the copyright. There is no any force. After signing the copyright, paper cannot withdraw at any condition.
                                </p>
                                <p>
                                    <span>Required Time for Endorsement:</span> It will take minimum 02 to 03 weeks.
                                </p>
                            </section>

                            <section>
                                <h3>Online Paper Submission:</h3>
                                <p>
                                    Prospective authors are invited to submit full text papers including abstract, keywords, introduction, methodology, result description, tables, figures and references. Full text papers (.doc, .pdf) may submit to Editorial Management system (online) or send by e-mail at <a href="mailto:editorinchief@ijsreat.com">editorinchief@ijsreat.com</a>.
                                    <br /><br />
                                    Paper Template of IJSREAT is available at <a href="/downloads">Downloads</a>.
                                    <br /><br />
                                    <span>Title Page:</span> The title page should include the name(s) of the author(s), a concise and informative title, the affiliation(s) and address of the author(s), the e-mail address of the corresponding author.
                                    <br />
                                    <span>Abstract:</span> Please provide an abstract of 150 to 450 words. The abstract should not contain any undefined abbreviations or unspecified references.
                                    <br />
                                    <span>Keywords:</span> Author(s) should provide 4 to 6 keywords which can be used for indexing purposes.
                                    <br />
                                    <span>Text Formatting:</span> Paper Setup must be in A4 size with Margin: Top 1.78 cm, Bottom 1.78 cm, Left 1.78 cm, Right 1.65 cm. Paper must be in one Column after Authors Name with Width 8.59 cm, Spacing 0.51 cm. Whole paper must be with: Font Name Cambria, Font Size 10, Line Spacing 1.05 Except Abstract, Keywords (Index Term), Paper Title, References, Author Profile (in the last page of the paper, maximum 400 words), All Headings, and Manuscript Details (First Page, Bottom, left side). Paper Title must be in Font Size 24, Bold, with Single Line Spacing. Authors Name must be in Font Size 11, Bold, Before Spacing 0, After Spacing 16, with Single Line Spacing. Please do not write Author e-mail or author address in the place of Authors name. Authors e-mail, and their Address details must be in the Manuscript details. Abstract and Keywords (Index Term) must be in Font Size 9, Bold, Italic with Single Line Spacing. All Main Heading must be in Upper Case, Centre, and Roman Numbering (I, II, III…etc), Before Spacing 12, After Spacing 6, with single line spacing. All Sub Heading must be in Title Case, Left 0.25 cm, Italic, and Alphabet Numbering (A, B, C…etc), Before Spacing 6, After Spacing 4, with Single Line Spacing. Manuscript Details must be in Font Size 8, in the Bottom, First Page, and Left Side with Single Line Spacing. References must be in Font Size 8, Hanging 0.25 with single line spacing. Author Profile must be in Font Size 8, with single line spacing.
                                    <br />
                                    <span>Introduction:</span> State the objectives of the work and provide an adequate background, with a detailed literature survey or a summary of the results.
                                    <br />
                                    <span>Theory/Calculation/Methodology:</span> A Theory Section should extend, not repeat the information discussed in Introduction. In contrast, a Calculation Section represents a practical development from a theoretical basis.
                                    <br />
                                    <span>Result:</span> Results should be clear and concise.
                                    <br />
                                    <span>Discussion:</span> This section should explore the importance of the results of the work, not repeat them. A combined Results and Discussion section is often appropriate.
                                    <br />
                                    <span>Conclusion and Future Scope:</span> The main conclusions of the study may be presented in a short Conclusion Section. In this section, the author(s) should also briefly discuss the limitations of the research and Future Scope for improvement.
                                    <br />
                                    <span>Appendix:</span> If there are multiple appendices, they should be identified as A, B, etc. Formula and equations in appendices should be given separate numbering: Eq. (A.1), Eq. (A.2), etc.; in a subsequent appendix, Eq. (B.1) and so on. Similar nomenclature should be followed for tables and figures: Table A.1; Fig. A.1, etc.
                                    <br />
                                    <span>Acknowledgement:</span> If desired, authors may provide acknowledgements at the end of the article, before the references. The organizations / individuals who provided help during the research (e.g. providing language help, writing assistance, proof reading the article, sponsoring the research, etc.) may be acknowledged here.
                                    <br />
                                    <span>References:</span> Citation in text - Please ensure that every reference cited in the text is also present in the reference list (and vice versa). The references in the reference list should follow the IJSREAT reference style of the journal and citation of a reference. Web references - As a minimum, the full URL should be given and the date when the reference was last accessed. Any further information, if known (DOI, author names, dates, reference to a source publication, etc.), should also be given. Web references can be listed separately (e.g., after the reference list) under a different heading if desired, or can be included in the reference list, as well. Reference style: Text - Indicate references by number(s) in square brackets in line with the text. The actual authors can be referred to, but the reference number(s) must always be given.
                                    <br />
                                    <span>Example:</span> ‘….. as demonstrated [3,6]. Barnaby and Jones [8] obtained a different result ….’ List - Number the references (numbers in square brackets) in the list, according to the order in which they appear in the text. Example: [1] G. O. Young, “Synthetic structure of industrial plastics (Book style with paper title and editor),” in Plastics, 2nd ed. vol. 3, J. Peters, Ed. New York: McGraw-Hill, 1964, pp. 15–64.
                                </p>
                            </section>

                            <section>
                                <div>
                                    <h3>Mathematical Formula</h3>
                                    <p>
                                        Present formula using Equation editor in the line of normal text. Number consecutively any equations that have to be referred in the text.
                                    </p>
                                </div>
                                <div>
                                    <h3>Captions and Numbering for Figure and Tables</h3>
                                    <p>
                                        Ensure that each figure / table has been numbered and captioned. Supply captions separately, not attached to the figure. A caption should comprise a brief title and a description of the illustration. Figures and tables should be numbered separately, but consecutively in accordance with their appearance in the text.
                                    </p>
                                </div>
                                <div>
                                    <h3>Color illustrations</h3>
                                    <p>
                                        Online publication of color illustrations is free of charge. There are no extra charges.
                                    </p>
                                </div>
                                <div>
                                    <h3>Copyright</h3>
                                    <p>
                                        Copyright of all accepted papers will belong to IJSREAT and the author(s) must affirm that accepted papers for publication in IJSREAT must not be re-published elsewhere without the written consent of the editor in chief of AM Publications, India. To comply with this policy, authors will be required to submit a signed copy of Copyright Transfer Form, after acceptance of their paper, before the same is published. Copyright form is available at <a href="/downloads">Downloads</a>.
                                    </p>
                                </div>
                                <div>
                                    <h3>Copyright Policy:</h3>
                                    <p>
                                        Authors note that paper cannot be withdrawn at any condition once it is accepted. The Authors may not publish his/her contribution anywhere else without the prior written permission of the publisher unless it has been changed substantially. The Author warrants that his/her contribution is original, except for such excerpts from copyrighted works as may be included with the permission of the copyright holder and author thereof, that it contains no libellous statements, and does not infringe on any copyright, trademark, patent, statutory right, or propriety right of others. The Author signs for and accepts responsibility for releasing this material on behalf of any and all co-authors. In return for these rights:
                                    </p>
                                    <ul>
                                        <li>All proprietary rights other than copyrights, such as patent rights.</li>
                                        <li>The right to use all or part of this article, including tables and figures in future works of their own, provided that the proper acknowledgment is made to the Publisher as copyright holder.</li>
                                        <li>The right to make copies of this article for his/her own use, but not for sale.</li>
                                        <li>It is the responsibility of each author to ensure that papers submitted to the journal are written with ethical standards in mind, concerning plagiarism. Please note that all submissions are thoroughly checked for plagiarism. If an attempt at plagiarism is found in a published paper, the authors will be asked to issue a written apology to the authors of the original material. Any paper which shows obvious signs of plagiarism will be automatically rejected and its authors may be banned for duration of 02 years from publishing in Journal. The authors will receive proper notification if such a situation arises.</li>
                                        <li>This paper has not been published in the same form elsewhere.</li>
                                        <li>It will not be submitted anywhere else for publication prior to acceptance/rejection by this Journal.</li>
                                        <li>For any dispute or related violence, it will be discussed and considered only in front of ‘Judiciary of Ariyalur’ at Ariyalur, Tamil Nadu, India.</li>
                                    </ul>
                                </div>
                                <div>
                                    <h3>Final Proof of the Paper</h3>
                                    <p>
                                        One set of page proofs (as PDF files) will be sent by e-mail to the corresponding author or a link will be provided in the e-mail so that the authors can download the files themselves. These PDF proofs can be annotated; for this you need to download Adobe Reader version 7 (or higher) available free at <a href="https://get.adobe.com/reader" target="_blank">get.adobe.com/reader</a>. If authors do not wish to use the PDF annotations function, they may list the corrections and return them to IJSREAT in an e-mail to <a href="mailto:editorinchief@ijsreat.com">editorinchief@ijsreat.com</a>. Please list corrections quoting line number. If, for any reason, this is not possible, then mark the corrections and any other comments on a printout of the proof and then scan the pages having corrections and e-mail them back, within 05 days. Please use this proof only for checking the typesetting, editing, completeness and correctness of the text, tables and figures. Significant changes to the paper that has been accepted for publication will not be considered at this stage without prior permission. It is important to ensure that all corrections are sent back to us in one communication: please check carefully before replying, as inclusion of any subsequent corrections cannot be guaranteed. Proofreading is solely authors’ responsibility. Note that IJSREAT will proceed with the publication of paper, if no response is received within 05 days.
                                    </p>
                                </div>
                            </section>

                            <section>
                                <h3>Article Page Limit</h3>
                                <p>
                                    To maintain publication quality and standardization, the journal requires that all submitted research articles comply with the prescribed page limit.
                                </p>
                                <div>
                                    <p>Article Length Requirement</p>
                                    <ul>
                                        <li>Maximum Length: <b>15-20 Pages</b></li>
                                        <li>Page count includes:</li>
                                    </ul>
                                    <ul>
                                        <li>Title and Author Details</li>
                                        <li>Abstract and Keywords</li>
                                        <li>Main Content (Introduction to Conclusion)</li>
                                        <li>Figures, Tables, and Captions</li>
                                        <li>References</li>
                                        <li>Appendices (if applicable)</li>
                                    </ul>
                                </div>
                                <div>
                                    <h3>Important Guidelines</h3>
                                    <ol>
                                        <li>Manuscripts exceeding <b>20 pages</b> will be returned to authors for reduction.</li>
                                        <li>Authors must use the official journal template.</li>
                                        <li>All submissions must follow formatting and referencing guidelines.</li>
                                        <li>Plagiarism should be within acceptable limits as per journal policy.</li>
                                    </ol>
                                </div>
                                <p>
                                    Failure to comply with the page limit requirement may result in processing delay or rejection.
                                    <br /><br />
                                    We request authors to carefully review the Instructions for Authors before submission.
                                </p>
                            </section>
                        </article>
                    </div>
                </section>

                {{-- Accordion Item: Publication Ethics & Malpractice Statement --}}
                <section id="ethics-malpractice" class="pol sec-anchor" :class="{ 'is-open': openId === 'ethics-malpractice' }">
                    <h2 class="pol__h"><button type="button" class="pol__btn" @click="toggle('ethics-malpractice')" :aria-expanded="(openId === 'ethics-malpractice').toString()" aria-controls="ethics-malpractice-body"><span>Publication Ethics & Malpractice Statement</span><span class="pol__chev" aria-hidden="true"></span></button></h2>
                    <div id="ethics-malpractice-body" class="pol__body doc" x-show="openId === 'ethics-malpractice'" x-collapse>
                        <div>
                            <h2>Publication Ethics & Malpractice Statement</h2>
                            <h3>(The following statements are based on Elsevier recommendations and COPE’s Best Practice Guidelines for Journal Editors)</h3>
                            <p>To maintain fair practice we at FDRP Publications strongly believe in following these guidelines. We are committed to fair practice of publication. Success in this regard can be achieved if ethics are well practiced by following participants:</p>
                            
                            <div>
                                <h4>Ethical guidelines for journal publication</h4>
                                <span>International Journal of Scientific Research in Engineering & Technology</span> is committed to ensuring ethics in publication and quality of articles. Especially, International Journal of Innovative Research in Advanced Engineering is following the Code of Conduct as defined by the <span>Committee of Publication Ethics (COPE)</span>. Conformance to standards of ethical behaviour is therefore expected of all parties involved: Authors, Editors, Reviewers, and the Publisher.
                            </div>

                            <div>
                                <h4>Authors</h4>
                                <ul>
                                    <li>Authors should present an objective discussion of the significance of research work as well as sufficient details and references.</li>
                                    <li>Authors should maintain accurate records of data associated with their submitted manuscript and supply or provide access to these data, on reasonable request. Authors guarantee that all data used in the article are real and authentic. Where appropriate and where allowed by employer, funding body and others who might have an interest, authors should deposit data in a suitable repository or storage location, for sharing and further use by others.</li>
                                    <li>Fraudulent or knowingly inaccurate statements constitute unethical behaviour and are unacceptable.</li>
                                    <li>The authors should ensure that their work is entirely original, and if the work and/or words of others have been used, this fact has been appropriately acknowledged. Plagiarism in all its forms constitutes unethical publishing behaviour and is unacceptable. Submitting the same manuscript to more than one journal concurrently constitutes unethical publishing behaviour and is unacceptable. Authors should not submit articles describing essentially the same research to more than one journal.</li>
                                    <li>Authors should acknowledge the financial support and help/guidance of others if appropriate.</li>
                                    <li>Authors should provide the disclaimer if appropriate.</li>
                                    <li>All co-authors should significantly contribute to the research. The corresponding author should ensure that there is a full consensus of all co-authors in approving the final version of the paper and its submission for publication.</li>
                                    <li>Authors are obliged to participate in peer review process.</li>
                                    <li>Authors should notify promptly the editor if a significant error in their publication is identified, and cooperate with the editor to publish an erratum, addendum, corrigendum notice, or to retract the paper, where it is deemed necessary.</li>
                                </ul>
                            </div>

                            <div>
                                <h4>Editors</h4>
                                <ul>
                                    <li>Editors have complete responsibility and authority to accept/reject a manuscript.</li>
                                    <li>Editors should evaluate manuscripts exclusively on the basis of their academic merit. Editors act in a balanced, objective and fair way while carrying out their expected duties, without discrimination on grounds of gender, sexual orientation, religious or political beliefs, ethnic or geographical origin of the authors.</li>
                                    <li>Editors accept the paper when reasonably certain.</li>
                                    <li>Editors must not use unpublished information in the editor's own research without the express written consent of the author.</li>
                                    <li>Editors preserve anonymity of reviewers.</li>
                                    <li>When errors are found, editors promote publication of correction or retraction.</li>
                                    <li>Editors should take reasonable responsive measures when ethical complaints have been presented concerning a submitted manuscript or published article.</li>
                                </ul>
                            </div>

                            <div>
                                <h4>Reviewers</h4>
                                <ul>
                                    <li>Any manuscripts received for review must be treated as confidential documents. Privileged information or ideas obtained through peer review must be kept confidential and not used for personal advantage.</li>
                                    <li>Reports should be conducted objectively, and observations should be formulated clearly with supporting arguments, so that authors can use them for improving the paper. Any relevant published work which is not yet cited should be pointed out.</li>
                                    <li>Any selected referee who feels unqualified to review the research reported in a manuscript or knows that its prompt review will be impossible should notify the editor and excuse himself from the review process.</li>
                                    <li>Reviewers should not consider manuscripts in which they have conflicts of interest resulting from competitive, collaborative, or other relationships or connections with any of the authors, companies, or institutions connected to the papers.</li>
                                </ul>
                            </div>

                            <div>
                                <h4>Publisher</h4>
                                <ul>
                                    <li>Publisher monitors and safeguards publishing ethics.</li>
                                    <li>Publisher communicates journal policies.</li>
                                    <li>Publisher respects privacy of all parties involved.</li>
                                    <li>Publisher fosters editorial independence.</li>
                                    <li>Publisher maintains the integrity of the academic record.</li>
                                    <li>Publisher protects intellectual property and copyrights.</li>
                                    <li>Publisher publishes corrections, clarifications, and retractions.</li>
                                    <li>Publisher constantly improves the quality of the journal.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- Accordion Item: Article Withdrawal Policy --}}
                <section id="article-withdrawal" class="pol sec-anchor" :class="{ 'is-open': openId === 'article-withdrawal' }">
                    <h2 class="pol__h"><button type="button" class="pol__btn" @click="toggle('article-withdrawal')" :aria-expanded="(openId === 'article-withdrawal').toString()" aria-controls="article-withdrawal-body"><span>Article withdraw policy</span><span class="pol__chev" aria-hidden="true"></span></button></h2>
                    <div id="article-withdrawal-body" class="pol__body doc" x-show="openId === 'article-withdrawal'" x-collapse>
                        <div>
                            <h2>Article withdraw policy</h2>
                            <p>
                                It is a general principle of scholarly communication that the editor/guest editor of a learned journal/series is solely and independently responsible for deciding which articles submitted to the journal shall be published. In making this decision the editor/guest editor is guided by policies of the journal’s editorial board and constrained by such legal requirements in force regarding libel, copyright infringement and plagiarism. An outcome of this principle is the importance of the scholarly archive as a permanent, historic record of the transactions of scholarship. Articles that have been published shall remain extant, exact and unaltered as far as is possible. However, very occasionally circumstances may arise where an article is published that must later be retracted or even removed. Such actions must not be undertaken lightly and can only occur under exceptional circumstances, such as:
                            </p>
                            
                            <div>
                                <h3>Article Withdrawal:</h3>
                                <p>
                                    Only used for Articles in Press which represent early versions of articles and sometimes contain errors, or may have been accidentally submitted twice. Occasionally, but less frequently, the articles may represent infringements of professional ethical codes, such as multiple submission, bogus claims of authorship, plagiarism, fraudulent use of data or the like. Articles in Press (articles that have been accepted for publication but which have not been formally published and will not yet have the complete volume/issue/page information) that include errors, or are discovered to be accidental duplicates of other published article(s), or are determined to violate our journal publishing ethics guidelines in the view of the editors (such as multiple submission, bogus claims of authorship, plagiarism, fraudulent use of data or the like), may be “Withdrawn” from IJSREAT. Withdrawn means that the article content (HTML and PDF) is removed and replaced with a HTML page and PDF simply stating that the article has been withdrawn according to the IJSREAT Policy on Article in Press Withdrawal with a link to the current policy document.
                                </p>
                            </div>

                            <div>
                                <h3>Article Retraction:</h3>
                                <p>
                                    Infringements of professional ethical codes, such as multiple submission, bogus claims of authorship, plagiarism, fraudulent use of data or the like. Occasionally a retraction will be used to correct errors in submission or publication. The retraction of an article by its authors or the editor under the advice of members of the scholarly community has long been an occasional feature of the learned world. Standards for dealing with retractions have been developed by a number of library and scholarly bodies, and this best practice is adopted for article retraction by IJSREAT.
                                </p>
                                <ul>
                                    <li>A retraction note titled “Retraction: [article title]” signed by the authors and/or the editor is published in the paginated part of a subsequent issue of the journal and listed in the contents list.</li>
                                    <li>In the electronic version, a link is made to the original article.</li>
                                    <li>The online article is preceded by a screen containing the retraction note. It is to this screen that the link resolves; the reader can then proceed to the article itself.</li>
                                    <li>The original article is retained unchanged save for a watermark on the .pdf indicating on each page that it is “retracted.” The HTML version of the document is removed.</li>
                                </ul>
                            </div>

                            <div>
                                <h3>Article removal: legal limitations</h3>
                                <p>
                                    In an extremely limited number of cases, it may be necessary to remove an article from the online database. This will only occur where the article is clearly defamatory, or infringes others’ legal rights, or where the article is, or we have good reason to expect it will be, the subject of a court order, or where the article, if acted upon, might pose a serious health risk. In these circumstances, while the metadata (Title and Authors) will be retained, the text will be replaced with a screen indicating the article has been removed for legal reasons.
                                </p>
                            </div>

                            <div>
                                <h3>Article replacement</h3>
                                <p>
                                    In cases where the article, if acted upon, might pose a serious health risk, the authors of the original article may wish to retract the flawed original and replace it with a corrected version. In these circumstances the procedures for retraction will be followed with the difference that the database retraction notice will publish a link to the corrected re-published article and a history of the document.
                                </p>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- Accordion Item: Plagiarism Policy --}}
                <section id="plagiarism-policy" class="pol sec-anchor" :class="{ 'is-open': openId === 'plagiarism-policy' }">
                    <h2 class="pol__h"><button type="button" class="pol__btn" @click="toggle('plagiarism-policy')" :aria-expanded="(openId === 'plagiarism-policy').toString()" aria-controls="plagiarism-policy-body"><span>Plagiarism Policy</span><span class="pol__chev" aria-hidden="true"></span></button></h2>
                    <div id="plagiarism-policy-body" class="pol__body doc" x-show="openId === 'plagiarism-policy'" x-collapse>
                        <div>
                            <h2>Plagiarism Policy</h2>
                            <p>
                                Plagiarism is the unethical act of copying someone else’s prior ideas, processes, results or words without explicit acknowledgement of the original author and source. Self-plagiarism occurs when an author utilizes large part of his/her own previously published work without using appropriate references. This can range from getting the same manuscript published in multiple journals to modifying a previously published manuscript with some new data.
                                <br /><br />
                                International Journal of Scientific Research in Engineering & Technology (IJSREAT) is having ISSN NO: 2583-1240 (Online), Bi-monthly international journal for publication of new ideas founded by academicians, educationist, engineers and corporate people. The research results and fundamental advancement are all aspects of Innovative Research in Advanced Engineering & Technology and various engineering disciplines, etc. IJSREAT is a scholarly open access, Double Blind Peer Review Journal which helps to academic person as well as student community. IJSREAT provides the academic community and industry for the submission of original research and applications related to Various Engineering disciplines and Advanced Technologies by FDRP, Ariyalur, Tamil Nadu, and India since year 2020.
                                <br /><br />
                                The journal is strictly against any unethical act of copying or plagiarism in any form. Plagiarism is said to have occurred when large portions of a manuscript have been copied from existing previously published resources. All manuscripts submitted for publication to IJSREAT are cross-checked for plagiarism using Turnitin/ iThenticate software. Manuscripts found to be plagiarized during initial stages of review are out-rightly rejected and not considered for publication in the journal. In case a manuscript is found to be plagiarized after publication, the Editor-in-Chief will conduct preliminary investigation, may be with the help of a suitable committee constituted for the purpose. If the manuscript is found to be plagiarized beyond the acceptable limits, the journal will contact the author’s Institute / College / University and Funding Agency, if any. A determination of misconduct will lead IJSREAT to run a statement bi-directionally linked online to and from the original paper, to note the plagiarism and provide a reference to the plagiarized material. The paper containing the plagiarism will also be marked on each page of the PDF. Upon determination of the extent of plagiarism, the paper may also be formally retracted.
                            </p>
                            
                            <div>
                                <h3>Types of Plagiarism</h3>
                                <p><span>Full Plagiarism:</span> Previously published content without any changes to the text, idea and grammar is considered as full plagiarism. It involves presenting exact text from a source as one’s own.</p>
                                <p><span>Partial Plagiarism:</span> If content is a mixture from multiple different sources, where the author has extensively rephrased text, then it is known as partial plagiarism.</p>
                                <p><span>Self Plagiarism:</span> When an author reuses complete or portions of their pre-published research, then it is known as self-plagiarism. Complete self-plagiarism is a case when an author republishes their own previously published work in a new journal.</p>
                            </div>

                            <div>
                                <h3>Policy and Action for Plagiarism</h3>
                                <p>
                                    IJSREAT respects intellectual property and aims at protecting and promoting original work of its authors. Manuscripts containing plagiarized material are against the standards of quality, research and innovation. Hence, all authors submitting articles to IJSREAT are expected to abide ethical standards and abstain from plagiarism, in any form. In case, an author is found to be suspected of plagiarism in a submitted or published manuscript then, IJSREAT shall contact the author (s) to submit his / her (their) explanation within two weeks, which may be forwarded to the Fact Finding Committee (FFC) constituted for the purpose, for further course of action. If IJSREAT does not receive any response from the author within the stipulated time period, then the Director / Dean / Head of the concerned College, Institution or Organization or the Vice Chancellor of the University to which the author is affiliated shall be contacted to take strict action against the concerned author.
                                    <br /><br />
                                    IJSREAT shall take serious action against published manuscripts found to contain plagiarism and shall completely remove them from IJSREAT website and other third party websites where the paper is listed and indexed. The moment, any article published in IJSREAT database is reported to be plagiarized, IJSREAT will constitute a Fact Finding Committee (FFC) to investigate the same. Upon having established that the manuscript is plagiarized from some previously published work, IJSREAT shall support the original author and manuscript irrespective of the publisher and may take any or all of the following immediate actions or follow the additional course of actions as recommended by the committee:
                                </p>
                                <ul>
                                    <li>IJSREAT editorial office shall immediately contact the Director / Dean / Head of the concerned College, Institution or Organization or the Vice Chancellor of the University to which the author(s) is (are) affiliated to take strict action against the concerned author.</li>
                                    <li>IJSREAT shall remove the PDF copy of the published manuscript from the website and disable all links to full text article. The term Plagiarized Manuscript shall be appended to the published manuscript title.</li>
                                    <li>IJSREAT shall disable the author account with the journal and reject all future submissions from the author for a period of 03 / 05 / 10 years or even ban the authors permanently. IJSREAT may also display the list of such authors along with their full contact details on the IJSREAT website.</li>
                                    <li>Any other course of action, as recommended by the Committee or as deemed fit for the instant case or as decided by the Editorial Board, from time to time.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- Accordion Item: Peer Review Policy --}}
                <section id="peer-review-policy" class="pol sec-anchor" :class="{ 'is-open': openId === 'peer-review-policy' }">
                    <h2 class="pol__h"><button type="button" class="pol__btn" @click="toggle('peer-review-policy')" :aria-expanded="(openId === 'peer-review-policy').toString()" aria-controls="peer-review-policy-body"><span>Peer Review Policy</span><span class="pol__chev" aria-hidden="true"></span></button></h2>
                    <div id="peer-review-policy-body" class="pol__body doc" x-show="openId === 'peer-review-policy'" x-collapse>
                            <h2>Peer Review Policy</h2>
                            <p>
                                <span>International Journal of Scientific Research in Engineering & Technology (IJSREAT)</span> is having <strong>ISSN NO:</strong> 2583–1240 (Online), Bi-monthly international journal for publication of new ideas founded by academicians, educationist, engineers and corporate people. The research results and fundamental advancement are all aspects of Innovative Research in Advanced Engineering & Technology and various engineering disciplines, etc. IJSREAT is a scholarly open access, Single Peer Review Journal which helps to academic person as well as student community.
                            </p>
                            <p>
                                IJSREAT provides the academic community and industry for the submission of original research and applications related to Various Engineering discipline and Advanced Technologies by FDRP Publications, Tamil Nadu, India since year 2020.
                            </p>
                            <p>
                                Reviewers play a central role in scholarly publishing. IJSREAT uses Single peer review process, which means that both the reviewer(s) and author(s) identities are concealed from the reviewer(s), and vice versa, throughout the review process. This means that the reviewer(s) of the paper won’t get to know the identity of the author(s), and the author(s) won’t get to know the identity of the reviewer(s). Peer review helps validate research, establish a method by which it can be evaluated, and increase networking possibilities within research communities. Despite criticisms, peer review is still the only widely accepted method for research validation.
                            </p>
                            <p>
                                All submitted papers will be reviewed by Single peer review process which may take minimum 01 to 03 weeks from the date of submission. We are advising to all the author(s), do not submit same paper to the multiple journals. You should wait for review status of paper.
                            </p>
                            <p>
                                IJSREAT is committed to prompt evaluation and publication of fully accepted papers. To maintain a high-quality publication, all submissions undergo a rigorous review process. Characteristics of the peer review process are as follows:
                            </p>
                            <ul>
                                <li>Simultaneous submissions of the same manuscript to different journals will not be tolerated.</li>
                                <li>Manuscripts with contents outside the scope will not be considered for review.</li>
                                <li>Papers will be refereed by at least 3 or 4 experts (reviewers) as suggested by the editorial board in which 01 from India and rest 02 or 03 from overseas.</li>
                                <li>In addition, Editors will have the option of seeking additional reviews when needed.</li>
                                <li>Authors will be informed when Editors decide further review is required. All publication decisions are made by the journal’s Editors-in-Chief on the basis of the referees’ reports (reviewers report).</li>
                                <li>Authors of papers that are not accepted are notified promptly.</li>
                                <li>All submitted manuscripts are treated as confidential documents. All submitted papers will be reviewed by double blind review process.</li>
                                <li>All manuscripts submitted for publication in IJSREAT cross-checked for plagiarism software. Manuscripts found to be plagiarized during initial stages of review are out-rightly rejected and not considered for publication in the journal.</li>
                                <li>In case if a manuscript is found to be plagiarized after publication, the Editor-in-Chief will conduct preliminary investigation, may be with the help of a suitable committee constituted for the purpose. If the manuscript is found to be plagiarized beyond the acceptable limits, the journal will contact the author's Institute / College / University and Funding Agency, if any.</li>
                                <li>IJSREAT strictly uses following Single peer review process.</li>
                            </ul>
                    </div>
                </section>

                {{-- Accordion Item: Copyright, Grants and Ownership Declaration --}}
                <section id="copyright-ownership" class="pol sec-anchor" :class="{ 'is-open': openId === 'copyright-ownership' }">
                    <h2 class="pol__h"><button type="button" class="pol__btn" @click="toggle('copyright-ownership')" :aria-expanded="(openId === 'copyright-ownership').toString()" aria-controls="copyright-ownership-body"><span>Copyright, Grants and Ownership Declaration</span><span class="pol__chev" aria-hidden="true"></span></button></h2>
                    <div id="copyright-ownership-body" class="pol__body doc" x-show="openId === 'copyright-ownership'" x-collapse>
                        <div>
                            <h2>Copyright, Grants and Ownership Declaration</h2>
                            <p>
                                For all articles published in this journal, copyright is retained by the authors without restrictions and the authors grants the publisher the right of first publication, and other non-exclusive publishing rights. This Journal and its metadata are licensed under a Creative Commons Attribution 4.0 International License, meaning that anyone may download and read the paper for free. In addition, the article may be reused and quoted provided that the original published version is cited. These conditions allow for maximum use and exposure of the work, while ensuring that the authors receive proper credit.
                            </p>
                            <div>
                                <h3>Copyright Policy:</h3>
                                <p>
                                    Authors note that paper cannot be withdrawn at any condition once it is accepted. The Authors may not publish his/her contribution anywhere else without the prior written permission of the publisher unless it has been changed substantially. The Author warrants that his/her contribution is original, except for such excerpts from copyrighted works as may be included with the permission of the copyright holder and author thereof, that it contains no libellous statements, and does not infringe on any copyright, trademark, patent, statutory right, or propriety right of others. The Author signs for and accepts responsibility for releasing this material on behalf of any and all co-authors. In return for these rights:
                                </p>
                                <ul>
                                    <li>All proprietary rights other than copyrights, such as patent rights.</li>
                                    <li>The right to use all or part of this article, including tables and figures in future works of their own, provided that the proper acknowledgment is made to the Publisher as copyright holder.</li>
                                    <li>The right to make copies of this article for his/her own use, but not for sale.</li>
                                    <li>It is the responsibility of each author to ensure that papers submitted to the journal are written with ethical standards in mind, concerning plagiarism. Please note that all submissions are thoroughly checked for plagiarism. If an attempt at plagiarism is found in a published paper, the authors will be asked to issue a written apology to the authors of the original material. Any paper which shows obvious signs of plagiarism will be automatically rejected and its authors may be banned for duration of 01 years from publishing in Journal. The authors will receive proper notification if such a situation arises.</li>
                                    <li>This paper has not been published in the same form elsewhere.</li>
                                    <li>It will not be submitted anywhere else for publication prior to acceptance/rejection by this Journal.</li>
                                    <li>For any dispute or related violence, it will be discussed and considered only in front of ‘Judiciary of Ariyalur’ at FDRP, Tamil Nadu, India.</li>
                                </ul>
                            </div>
                            <section>
                                <div>
                                    <h3>Journal Author Rights:</h3>
                                    <p>
                                        In order for FDRP Publications and Its journal to publish and disseminate research articles, we need publishing rights. This is determined by a publishing agreement between the author and FDRP Publications and its Journal. This agreement deals with the transfer or license of the copyright to FDRP Publications and its journal and authors retain significant rights to use and share their own published articles. FDRP Publications and its journal support the need for authors to share, disseminate and maximize the impact of their research and these rights, in FDRP Publications proprietary journals* are defined below:
                                    </p>
                                </div>
                                <div>
                                    <h4>For subscription articles:</h4>
                                    <p>Authors transfer copyright to the publisher as part of a journal publishing agreement, but have the right to:</p>
                                    <ul>
                                        <li>Share their article for Personal Use, Internal Institutional Use and Scholarly Sharing purposes.</li>
                                        <li>Retain patent, trademark and other intellectual property rights (including research data).</li>
                                        <li>Proper attribution and credit for the published work.</li>
                                    </ul>
                                </div>
                                <div>
                                    <h4>For open access articles:</h4>
                                    <p>Authors sign an exclusive license agreement, where authors have copyright but license exclusive rights in their article to the publisher**. In this case authors have the right to:</p>
                                    <ul>
                                        <li>Share their article in the same ways permitted to third parties under the relevant user license (together with Personal Use rights)</li>
                                        <li>Retain patent, trademark and other intellectual property rights (including research data).</li>
                                        <li>Proper attribution and credit for the published work.</li>
                                    </ul>
                                </div>
                                <p><span>*</span> Please note that society or third party owned journals may have different publishing agreements. Please see the journal’s guide for authors for journal specific copyright information.</p>
                                <p><span>**</span> This includes the right for the publisher to make and authorize commercial use, please see “Rights granted to FDRP Publications and Its Journal” for more details.</p>
                            </section>
                            <section>
                                <h3>Rights granted to FDRP Publications and Its Journals:</h3>
                                <p>For both subscription and open access articles, published in proprietary titles, FDRP Publications and its journal is granted the following rights:</p>
                                <ul>
                                    <li>The exclusive right to publish and distribute an article, and to grant rights to others, including for commercial purposes.</li>
                                    <li>For open access articles, FDRP Publications and Its journal will apply the relevant third party user license where FDRP Publications and Its journal publish the article on its online platforms.</li>
                                    <li>The right to provide the article in all forms and media so the article can be used on the latest technology even after publication.</li>
                                    <li>The authority to enforce the rights in the article, on behalf of an author, against third parties, for example in the case of plagiarism or copyright infringement.</li>
                                </ul>
                            </section>
                            <div>
                                <h3>Protecting Author Rights:</h3>
                                <p>
                                    Copyright aims to protect the specific way the article has been written to describe an experiment and the results. FDRP Publications and its journals are committed to its authors to protect and defend their work and their reputation and takes allegations of infringement, plagiarism, ethic disputes and fraud very seriously.
                                    <br /><br />
                                    If an author becomes aware of a possible plagiarism, fraud or infringement we recommend contacting their FDRP Publications and its journals publishing contact who can then liaise with our in-house legal department. Note that certain open access user licenses may permit quite broad re-use that might otherwise be counted as copyright infringement. For details about how to seek permission to use an article see our permission page.
                                </p>
                            </div>
                            <div>
                                <h3>Disclaimer</h3>
                                <p>
                                    The opinions expressed and figures provided in this Journal; IJSREAT, are the sole responsibility of the authors. The publisher and the editors bear no responsibility in this regard. Any and all such liabilities are disclaimed. All disputes are subject to Ariyalur, Tamil Nadu, India jurisdiction only.
                                </p>
                            </div>
                            <div>
                                <h4>Address for Correspondence:</h4>
                                <p>Editor-In-Chief, IJSREAT</p>
                                <p>Fifth Dimension Research Publications, No: 38D5F, Rajajinagar, Ariyalur, Tamil Nadu 621713.</p>
                                <p>E-mail ID: <a href="mailto:support@fdrpjournals.org">support@fdrpjournals.org</a></p>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- Accordion Item: Open Access Policy --}}
                <section id="open-access-policy" class="pol sec-anchor" :class="{ 'is-open': openId === 'open-access-policy' }">
                    <h2 class="pol__h"><button type="button" class="pol__btn" @click="toggle('open-access-policy')" :aria-expanded="(openId === 'open-access-policy').toString()" aria-controls="open-access-policy-body"><span>Open Access Policy</span><span class="pol__chev" aria-hidden="true"></span></button></h2>
                    <div id="open-access-policy-body" class="pol__body doc" x-show="openId === 'open-access-policy'" x-collapse>
                        <div>
                            <h2>Open Access Policy</h2>
                            <p>
                                The aim of Fifth Dimension Research Publications (FDRP) and its journals are to provide the best choice of user license options which define how readers can reuse open access articles published on our platforms.
                            </p>
                            
                            <div>
                                <h3>FDRP Publications and its journal Policy:</h3>
                                <ul>
                                    <li>Offer a choice between a commercial and a non-commercial Creative Commons license for gold open access articles in our proprietary titles. The choice is dependent on the journal in which the author chooses to publish. Please refer to the journal’s homepage for specific details.</li>
                                    <li>Use the user license for our open archive content.</li>
                                    <li>FDRP Publications and it’s journals support green open access and accepted manuscripts can be self-archived following our sharing guidelines and are required to attach a CC-BY-NC-ND license.</li>
                                </ul>
                            </div>

                            <div>
                                <h3>Choosing a License</h3>
                                <p>
                                    Once selected, Creative Commons user licenses are Non Commercial-No Derivs. FDRP Publications and Its journals recommend author(s) check if their funding body requires a specific license. See the Creative Commons website for more details about what to consider before choosing a user license. Click here for a full list of user licenses used by FDRP Publications and its journal.
                                </p>
                            </div>

                            {{-- Creative Commons License Table --}}
                            <div>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>User license</th>
                                            <th>Read, print, download</th>
                                            <th>Redistribute / republish</th>
                                            <th>Translate</th>
                                            <th>Download for TDM</th>
                                            <th>Reuse extracts</th>
                                            <th>Commercial Reuse</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>CC BY 4.0</td>
                                            <td>Yes</td>
                                            <td>Yes</td>
                                            <td>Yes</td>
                                            <td>Yes</td>
                                            <td>Yes</td>
                                            <td>Yes</td>
                                        </tr>
                                        <tr>
                                            <td>CC BY-NC-ND 4.0</td>
                                            <td>Yes</td>
                                            <td>Yes</td>
                                            <td>Yes, For private use only</td>
                                            <td>Yes</td>
                                            <td>Yes</td>
                                            <td>No</td>
                                        </tr>
                                        <tr>
                                            <td>FDRP User license</td>
                                            <td>Yes</td>
                                            <td>Yes</td>
                                            <td>Yes</td>
                                            <td>Yes</td>
                                            <td>Yes</td>
                                            <td>No</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <p>
                                Please note: Under the CC BY-NC-ND license and for the FDRP Publications and its journal user license permitted 3rd party reuse is only applicable for non-commercial purposes. For further details on the rights granted to FDRP publications and Its Journal.
                            </p>

                            <div>
                                <h3>Creative Commons Attribution (CC BY)</h3>
                                <p>
                                    Allows users to: distribute and copy the article; create extracts, abstracts, and other revised versions, adaptations or derivative works of or from an article (such as a translation); include in a collective work (such as an anthology); and text or data mine the article. These uses are permitted even for commercial purposes, provided the user: gives appropriate credit to the author(s) (with a link to the formal publication through the relevant DOI); includes a link to the license; indicates if changes were made; and does not represent the author(s) as endorsing the adaptation of the article or modify the article in such a way as to damage the authors’ honor or reputation.
                                </p>
                            </div>

                            <div>
                                <h3>Creative Commons Attribution-Non Commercial-NoDerivs (CC BY-NC-ND)</h3>
                                <p>
                                    Allows users to: distribute and copy the article; and include in a collective work (such as an anthology). These uses are permitted only for non-commercial purposes, and provided the user: gives appropriate credit to the author(s) (with a link to the formal publication through the relevant DOI); provides a link to the license; and does not alter or modify the article. If you need to comply with your funding body policy you can apply for a CC BY license after your manuscript is accepted for publication.
                                </p>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- Accordion Item: Archiving Policy --}}
                <section id="archiving-policy" class="pol sec-anchor" :class="{ 'is-open': openId === 'archiving-policy' }">
                    <h2 class="pol__h"><button type="button" class="pol__btn" @click="toggle('archiving-policy')" :aria-expanded="(openId === 'archiving-policy').toString()" aria-controls="archiving-policy-body"><span>Archiving policy</span><span class="pol__chev" aria-hidden="true"></span></button></h2>
                    <div id="archiving-policy-body" class="pol__body doc" x-show="openId === 'archiving-policy'" x-collapse>
                        <div>
                            <h2>Archiving policy:</h2>
                            <p>
                                Digital archiving is essential in ensuring that scholarly content, such as journal articles, remains safe and accessible to readers for a long time. Several archiving platforms provide secure content storage, including Internet Archiving, LOCKSS, CLOCKSS, and Zenodo repository. These platforms use advanced technologies to preserve digital content, such as creating multiple copies and distributing them to various locations, ensuring that data is always available, even if one copy is lost. The journal can rest assured that archiving platforms will preserve the article’s content for future generations to access and reuse. The journal uses archiving platforms like Internet Archiving, LOCKSS, CLOCKSS, and the Zenodo repository.
                                <br /><br />
                                The journal recommends authors to promptly self-archive and publish their articles on institutional repositories or websites. These practices can enhance article citation and facilitate productive author exchanges.
                            </p>
                        </div>
                    </div>
                </section>

                {{-- Accordion Item: Repository Policy --}}
                <section id="repository-policy" class="pol sec-anchor" :class="{ 'is-open': openId === 'repository-policy' }">
                    <h2 class="pol__h"><button type="button" class="pol__btn" @click="toggle('repository-policy')" :aria-expanded="(openId === 'repository-policy').toString()" aria-controls="repository-policy-body"><span>Repository policy</span><span class="pol__chev" aria-hidden="true"></span></button></h2>
                    <div id="repository-policy-body" class="pol__body doc" x-show="openId === 'repository-policy'" x-collapse>
                        <div>
                            <h2>Repository policy</h2>
                            <p>
                                Authors are encouraged to deposit their research findings and associated data in publicly accessible repositories that adhere to established archiving, curation, and citation standards. By doing this, authors can ensure that their work is preserved for future use and can be easily searched and cited by their peers. The repositories store data in its original form, enabling optimal study, validation, and reuse. This approach ensures that the data is preserved in its purest form, allowing for accurate and reliable results. Such repositories are particularly useful in business and academic settings where data integrity and accuracy are paramount. By maintaining the data in its native form, researchers and analysts can work with the data more effectively, leading to better insights and outcomes.
                                <br /><br />
                                The journal highly recommends using repositories, including but not limited to Dryad Digital, Zenodo, and Figshare, to communicate research effectively. These repositories offer a secure, reliable, and easily accessible platform for sharing valuable research data with peers and the wider academic community. The utilization of repositories is an essential step towards promoting transparency, accessibility, and reproducibility of research results, which are fundamental principles in the scientific community.
                                <br /><br />
                                Authors must utilize a repository that meets specific criteria to ensure a successful peer-review process. Firstly, the repository must be anonymous to maintain confidentiality. Secondly, data should be publicly accessible, and resources should be stable and suitable for all researchers working with the pertinent data types. These factors are essential in ensuring a professional and efficient review process that meets the highest standards of business or academic settings.
                                <br /><br />
                                Authors must deposit the corresponding data into the repository as part of the article submission process to the journal. If the associated data still needs to be deposited in the repository, it can be uploaded to Figshare or Dryad Digital during the article submission.
                            </p>
                        </div>
                    </div>
                </section>

                {{-- Accordion Item: Journal Metrics --}}
                <section id="journal-metrics" class="pol sec-anchor" :class="{ 'is-open': openId === 'journal-metrics' }">
                    <h2 class="pol__h"><button type="button" class="pol__btn" @click="toggle('journal-metrics')" :aria-expanded="(openId === 'journal-metrics').toString()" aria-controls="journal-metrics-body"><span>Journal Metrics</span><span class="pol__chev" aria-hidden="true"></span></button></h2>
                    <div id="journal-metrics-body" class="pol__body doc" x-show="openId === 'journal-metrics'" x-collapse>
                        <div>
                            <h2>Journal Metrics:</h2>
                            <p>
                                Scholars and researchers count journal metrics to compare, gauge, and research impact and rank the quality and scholarly publications. These metrics, also known as journal rankings, journal impact, or journal importance, enable them to make informed decisions and comparisons regarding literary periodicals. Such metrics are indicators of educational productivity, influence, and relevance in the academic community. Given the significance of journal metrics in academic circles, ensuring they are accurate, reliable, and transparent is paramount. As such, the use and interpretation of journal metrics require careful consideration and scrutiny to avoid potential biases and misrepresentations.
                                <br /><br />
                                The original citation impact metric is the Journal Impact Factor, created in the 1950s and available through Thomson Reuters’ Journal Citation Reports. Various accessible journal metrics have recently been created, including SCILit, CiteScore, Google Scholar Metrics, SCImago Journal & Country Rank (SJR), and Source Normalized Impact per Paper (SNIP).
                            </p>
                        </div>
                    </div>
                </section>

                {{-- Accordion Item: Advertising Policy --}}
                <section id="advertising-policy" class="pol sec-anchor" :class="{ 'is-open': openId === 'advertising-policy' }">
                    <h2 class="pol__h"><button type="button" class="pol__btn" @click="toggle('advertising-policy')" :aria-expanded="(openId === 'advertising-policy').toString()" aria-controls="advertising-policy-body"><span>Advertising Policy</span><span class="pol__chev" aria-hidden="true"></span></button></h2>
                    <div id="advertising-policy-body" class="pol__body doc" x-show="openId === 'advertising-policy'" x-collapse>
                        <div>
                            <h2>Advertising Policy:</h2>
                            <p>
                                The journal retains the authority to reject any advertisement it deems unsuitable for its mission or inconsistent with the principles of its members, publication/website, or organisation. Additionally, the journal reserves the right to discontinue accepting any previously received advertisement. All advertisements are subject to thorough scrutiny by the chief editor. No separate agreements with the journal and its subsidiaries shall override this policy under any circumstances [<span>Ref 1</span>].
                                <br /><br />
                                Advertising products or services related to alcohol, tobacco, weapons, firearms, ammunition, fireworks, gambling and lottery, and pornography or related themes is strictly prohibited. Moreover, advertisements that promote products using the term miracle or make health claims without proper evidence are not permitted. Promotions targeting children are strictly forbidden (<span>Ref2, Ref3</span>).
                                <br /><br />
                                Advertisers are required to provide evidence to support the claims they make. In cases where products fall outside the jurisdiction of the FDA or other government bodies, it may be necessary to submit technical and scientific documentation. The documents should be comprehensive, accurate, and credible and should be able to substantiate any claims made about the product. Products advertised with health claims that the FDA has rejected must include a disclaimer stating that the Food and Drug Administration has not evaluated (<span>Ref2, Ref3</span>). This product does not intend to diagnose, treat, cure, or prevent any medical condition or ailment. Its use is not a substitute for professional medical advice, diagnosis, or treatment.
                                <br /><br />
                                To ensure transparency, advertisers must prioritise information-rich advertising and ensure that advertising icons and logos are distinguishable from editorial content [<span>Ref2</span>]. It may be necessary to use specific labelling to provide clarity between them.
                                <br /><br />
                                It is not allowed to intentionally place advertisements next to articles discussing the company or product advertised in professional publications [Ref 4].
                                <br /><br />
                                In the realm of online advertising, certain types of ads are strictly prohibited. These include Pop-ups and floating ads, which are intrusive and often disrupt the user experience. Additionally, any ad that collects personally identifiable information without explicit permission is prohibited. Ads that extend across or down the page without the user having clicked or rolled over the ad, as well as ads that redirect users to another site without their consent, are also off-limits.
                                <br /><br />
                                The advertising policies are dynamic and may change without prior notification, as they are not exhaustive in their scope.
                            </p>
                        </div>
                    </div>
                </section>
            </div>

            <x-archive.verify-strip />
        </div>
    </div>
</div>
@endsection
