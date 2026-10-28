@extends('layouts.app')

@section('meta_title', 'IJSREAT | Instructions for Authors – International Journal of Scientific Research in Engineering & Technology')
@section('meta_description', 'Read IJSREAT author instructions for manuscript preparation, formatting, submission, and publication guidelines in engineering, technology, and multidisciplinary research.')

@include('archives.partials.theme')

@section('content')
<div class="hp">
    <x-archive.pageband title="Instruction for Authors" :crumbs="['For Authors' => '/instruction-for-author', 'Instruction for Authors' => null]"
        lead="How to prepare, format and submit a manuscript to IJSREAT, and the conditions that apply after acceptance." />

    <div class="apage apage--doc">
        <nav class="doc-toc" aria-label="On this page">
            <p class="doc-toc__h">On this page</p>
                    <a href="#manuscript-submission">Manuscript Submission</a>
                    <a href="#permissions">Permissions</a>
                    <a href="#author-s-be-sure-that">Author(s) be sure that</a>
                    <a href="#online-paper-submission">Online Paper Submission</a>
                    <a href="#mathematical-formula">Mathematical Formula</a>
                    <a href="#captions-and-numbering-for-figure-and-tables">Captions and Numbering for Figure and Tables</a>
                    <a href="#color-illustrations">Color illustrations</a>
                    <a href="#copyright">Copyright</a>
                    <a href="#copyright-policy">Copyright Policy</a>
                    <a href="#final-proof-of-the-paper">Final Proof of the Paper</a>
                    <a href="#article-page-limit">Article Page Limit</a>
                    <a href="#important-guidelines">Important Guidelines</a>
        </nav>
        <div class="amain">
            <div class="doc">

        <div>
            <p>
                The International Journal of Scientific Research in Engineering & Technology (IJSREAT) is
                (Online), Bi-monthly international journal for publication of new ideas founded by
                academicians, educationist, engineers and corporate people. The research results and
                fundamental advancement are all aspects of Innovative Research in Advanced Engineering
                & Technology and various engineering disciplines, etc. IJSREAT is a scholarly open access,
                Single Peer Review Journal which helps to academic person as well as student community.
                IJSREAT provides the academic community and industry for the submission of original
                research and applications related to Various Engineering discipline and Advanced
                Technologies by Fifth Dimension Research Publications (FDRP), Tamil Nadu, and India
                since year 2020.
                <br /><br />
                Papers for the regular issues of the journal can be submitted, round the year, electronically
                at Editorial Management System / <span>editorinchief@ijsreat.com</span>, after the final acceptance of
                the paper, based upon the detailed review process, the paper will immediately be published
                online. However, assignment of the paper to a specific Volume / Issue of the Journal will be
                taken up by the Editorial Board later; and the author will be intimated accordingly. For Theme
                Based Special Issues, time bound Special Call for Papers will be announced and the same
                will be applicable for that specific issue only.
                <br /><br />
                Submission of a paper implies that the work described has not been published previously
                and is not under consideration for publication elsewhere. The submission should be
                approved by all the authors of the paper. If a paper is finally accepted, the authorities, where
                the work had been carried out, shall be responsible for not publishing the work elsewhere in
                the same form. Paper, once submitted for consideration in IJSREAT, cannot be withdrawn
                unless the same is finally rejected.
            </p>
            <div>
                <h2 id="manuscript-submission" class="sec-anchor">
                    Manuscript Submission:
                </h2>
                <p>
                    Submission of a manuscript implies: that the work described has not been published before;
                    that it is not under consideration for publication anywhere else; that its publication has been
                    approved by all co-authors, if any, as well as by the responsible authorities or explicitly at the
                    institute where the work has been carried out. The publisher will not be held legally
                    responsible should there be any claims for compensation.
                </p>
            </div>
            <div>
                <h2 id="permissions" class="sec-anchor">
                    Permissions
                </h2>
                <p>
                    Authors wishing to include figures, tables, or text passages that have already been published
                    elsewhere are required to obtain permission from the copyright owner(s) for both the print
                    and online format and to include evidence that such permission has been granted when
                    submitting their papers. Any material received without such evidence will be assumed to
                    originate from the authors.
                </p>
            </div>
            <div>
                <h2 id="author-s-be-sure-that" class="sec-anchor">
                    Author(s) be sure that:
                </h2>
                <p>
                    <span>Plagiarism Check:</span> Good quality plagiarism software/ tool Crosscheck / Turnitin
                    Plagiarism detection tools will be used to check similarity that would not be more than
                    20% including reference section. In the case of exclusion of references, it should be
                    less than 5%.
                </p>
                <p>
                    <span>Quality Check:</span> All submitted paper should be cutting edge, result oriented, original
                    paper and under the scope of the journal that should belong to the engineering and
                    technology area. In the paper title, there should not be word ‘Overview/brief/
                    Introduction, Review, Case study/ Study, Survey, Approach, Comparative, Analysis,
                    Comparative Investigation, Investigation’.
                </p>
                <p>
                    <span>Paper Submission Criteria:</span> Any one author cannot submit more than 05 papers for the same volume/issue.
                </p>
                <p>
                    <span>Review Criteria:</span> This journal uses double-blind review process, which means that both the reviewer (s) and author (s) identities concealed from the reviewers, and vice
                    versa, throughout the review process. All submitted manuscripts are reviewed by
                    three reviewer one from India and rest two from overseas. There should be proper
                    comments of the reviewers for the purpose of acceptance/ rejection. There should be
                    minimum 02 to 03 week time window for it.
                </p>
                <p>
                    <span>eCopyright:</span> All authors will submit e-copyright to the Journal/ FDRP, India
                </p>
                <p>
                    <span>Template:</span> All accepted papers should be formatted as per IJSREAT Journal
                    Template. It is be sure that contents of the paper are fine and satisfactory. Author(s)
                    can make rectification in the final paper but after the final submission to the journal,
                    rectification is not possible. In the formatted paper, volume no/ issue no will be in the
                    right top corner of the paper. In the case of failure, the papers will be declined from
                    the database of journal and publishing house.
                </p>
                <p>
                    <span>Updation in the Paper:</span> Final paper is prepared as per journal the template.
                    Contents of the paper are fine and satisfactory. Author (s) can make rectification in
                    the final paper but after the final submission to the journal, rectification is not
                    possible.
                </p>
                <p>
                    <span>Copyright Property:</span> After the publication, conference proceeding will be property of FDRP, India and journal.
                </p>
                <p>
                    <span>Publication Fee:</span> Journal is free. Journal will not take any kind of fee/processing fee/handling fee/review fee.
                </p>
                <p>
                    <span>APC:</span> Article Processing Charge (APC) is not a publication fee of the journal. APC is to be taken by publication house that is ‘FDRP, India’. It is not taken by journal. APC
                    is applicable for per paper one time. It means, have to pay for every paper (article).
                    Author is free to withdraw his/her paper at any time but before signing the copyright.
                    There is no any force. After signing the copyright, paper cannot withdraw at any
                    condition.
                </p>
                <p>
                    <span>Required Time for Endorsement:</span> It will take minimum 02 to 03 weeks.
                </p>
            </div>
            <div>
                <h2 id="online-paper-submission" class="sec-anchor">
                    Online Paper Submission:
                </h2>
                <p>
                    Prospective authors are invited to submit full text papers including abstract, keywords,
                    introduction, methodology, result description, tables, figures and references. Full text papers
                    (.doc, .pdf) may submit to Editorial Management system (online) or send by e-mail
                    at <a href="mailto:editorinchief@ijsreat.com" target="_blank">editorinchief@ijsreat.com.</a>
                    <br /><br />
                    Paper Template of IJSREAT available at <a href="/downloads">Downloads</a>
                    <br /><br />
                    <span>Title Page:</span> The title page should include the name(s) of the author(s), a concise and informative title, the affiliation(s) and address of the author(s), the e-mail address of the corresponding author.
                    <br />
                    <span>Abstract:</span> Please provide an abstract of 150 to 450 words. The abstract should not contain any undefined abbreviations or unspecified references.
                    <br />
                    <span>Keywords:</span> Author(s) should provide 4 to 6 keywords which can be used for indexing purposes.
                    <br />
                    <span>Text Formatting:</span> Paper Setup must be in A4 size with Margin: Top 1.78 cm, Bottom 1.78 cm, Left 1.78 cm, Right 1.65 cm. Paper must be in one Column after Authors
                    Name with Width 8.59 cm, Spacing 0.51 cm. Whole paper must be with: Font Name
                    Cambria, Font Size 10, Line Spacing 1.05 Except Abstract, Keywords (Index Term),
                    Paper Title, References, Author Profile (in the last page of the paper, maximum 400
                    words), All Headings, and Manuscript Details (First Page, Bottom, left side).Paper
                    Title must be in Font Size 24, Bold, with Single Line Spacing. Authors Name must be
                    in Font Size 11, Bold, Before Spacing 0, After Spacing 16, with Single Line Spacing.
                    Please do not write Author e-mail or author address in the place of Authors name.
                    Authors e-mail, and their Address details must be in the Manuscript details. Abstract
                    and Keywords (Index Term) must be in Font Size 9, Bold, Italic with Single Line
                    Spacing. All Main Heading must be in Upper Case, Centre, and Roman Numbering
                    (I, II, III…etc), Before Spacing 12, After Spacing 6, with single line spacing. All Sub
                    Heading must be in Title Case, Left 0.25 cm, Italic, and Alphabet Numbering (A, B,
                    C…etc), Before Spacing 6, After Spacing 4, with Single Line Spacing. Manuscript
                    Details must be in Font Size 8, in the Bottom, First Page, and Left Side with Single
                    Line Spacing. References must be in Font Size 8, Hanging 0.25 with single line
                    spacing. Author Profile must be in Font Size 8, with single line spacing.
                    <br />
                    <span>Introduction:</span> State the objectives of the work and provide an adequate background, with a detailed literature survey or a summary of the results.
                    <br />
                    <span>Theory/Calculation/Methodology:</span> A Theory Section should extend, not repeat the
                    information discussed in Introduction. In contrast, a Calculation Section represents a
                    practical development from a theoretical basis.
                    <br />
                    <span>Result:</span> Results should be clear and concise.
                    <br />
                    <span>Discussion:</span> This section should explore the importance of the results of the work, not repeat them. A combined Results and Discussion section is often appropriate.
                    <br />
                    <span>Conclusion and Future Scope:</span> The main conclusions of the study may be
                    presented in a short Conclusion Section. In this section, the author(s) should also
                    briefly discuss the limitations of the research and Future Scope for improvement.
                    <br />
                    <span>Appendix:</span> If there are multiple appendices, they should be identified as A, B, etc.
                    Formula and equations in appendices should be given separate numbering: Eq.
                    (A.1), Eq. (A.2), etc.; in a subsequent appendix, Eq. (B.1) and so on. Similar
                    nomenclature should be followed for tables and figures: Table A.1; Fig. A.1, etc.
                    <br />
                    <span>Acknowledgement:</span> If desired, authors may provide acknowledgements at the end
                    of the article, before the references. The organizations / individuals who provided
                    help during the research (e.g. providing language help, writing assistance, proof
                    reading the article, sponsoring the research, etc.) may be acknowledged here.
                    <br />
                    <span>References:</span> Citation in text- Please ensure that every reference cited in the text is also present in the reference list (and vice versa). The references in the reference list
                    should follow the IJSREAT reference style of the journal and citation of a reference.
                    Web references- As a minimum, the full URL should be given and the date when the
                    reference was last accessed. Any further information, if known (DOI, author names,
                    dates, reference to a source publication, etc.), should also be given. Web references
                    can be listed separately (e.g., after the reference list) under a different heading if
                    desired, or can be included in the reference list, as well. Reference style: Text-
                    Indicate references by number(s) in square brackets in line with the text. The actual
                    authors can be referred to, but the reference number(s) must always be given.
                    <br />
                    <span>Example:</span> ‘….. as demonstrated [3,6]. Barnaby and Jones [8] obtained a different
                    result ….’ List- Number the references (numbers in square brackets) in the list,
                    according to the order in which they appear in the text. example: [1] G. O. Young,
                    “Synthetic structure of industrial plastics (Book style with paper title and editor),” in
                    Plastics, 2nd ed. vol. 3, J. Peters, Ed. New York: McGraw-Hill, 1964, pp. 15–64.
                </p>
            </div>
            <div>
                <div>
                    <h2 id="mathematical-formula" class="sec-anchor">
                        Mathematical Formula
                    </h2>
                    <p>
                        Present formula using Equation editor in the line of normal text. Number consecutively any
                        equations that have to be referred in the text.
                    </p>
                </div>
                <div>
                    <h2 id="captions-and-numbering-for-figure-and-tables" class="sec-anchor">
                        Captions and Numbering for Figure and Tables
                    </h2>
                    <p>
                        Ensure that each figure / table has been numbered and captioned. Supply captions
                        separately, not attached to the figure. A caption should comprise a brief title and a
                        description of the illustration. Figures and tables should be numbered separately, but
                        consecutively in accordance with their appearance in the text.
                    </p>
                </div>
                <div>
                    <h2 id="color-illustrations" class="sec-anchor">
                        Color illustrations
                    </h2>
                    <p>
                        Online publication of color illustrations is free of charge. There is no any extra charges.
                    </p>
                </div>
                <div>
                    <h2 id="copyright" class="sec-anchor">
                        Copyright
                    </h2>
                    <p>
                        Copyright of all accepted papers will belong to IJSREAT and the author(s) must affirm that
                        accepted papers for publication in IJSREAT must not be re-published elsewhere without the
                        written consent of the editor in chief of AM Publications, India. To comply with this policy,
                        authors will be required to submit a signed copy of Copyright Transfer Form, after
                        acceptance of their paper, before the same is published. Copyright form available
                        at Downloads.
                    </p>
                </div>
                <div>
                    <h2 id="copyright-policy" class="sec-anchor">
                        Copyright Policy:
                    </h2>
                    <p>
                        Authors note that paper cannot be withdrawn at any condition once it is accepted. The
                        Authors may not publish his/her contribution anywhere else without the prior written permission of the publisher unless it has been changed
                        substantially. The Author warrants that his/her contribution is original, except for such
                        excerpts from copyrighted works as may be included with the permission of the copyright
                        holder and author thereof, that it contains no libellous statements, and does not infringe on
                        any copyright, trademark, patent, statutory right, or propriety right of others. The Author
                        signs for and accepts responsibility for releasing this material on behalf of any and all co-
                        authors. In return for these rights:
                    </p>
                    <ul>
                        <li>All proprietary rights other than copyrights, such as patent rights.</li>
                        <li>The right to use all or part of this article, including tables and figures in future works
                            of their own, provided that the proper acknowledgment is made to the Publisher as
                            copyright holder.</li>
                        <li>The right to make copies of this article for his/her own use, but not for sale.</li>
                        <li>It is the responsibility of each author to ensure that papers submitted to the journal
                            are written with ethical standards in mind, concerning plagiarism. Please note that all
                            submissions are thoroughly checked for plagiarism. If an attempt at plagiarism is
                            found in a published paper, the authors will be asked to issue a written apology to the
                            authors of the original material. Any paper which shows obvious signs of plagiarism
                            will be automatically rejected and its authors may be banned for duration of 02 years
                            from publishing in Journal. The authors will receive proper notification if such a
                            situation arises.</li>
                        <li>This paper has not been published in the same form elsewhere.</li>
                        <li>It will not be submitted anywhere else for publication prior to acceptance/rejection by
                            this Journal.</li>
                        <li>For any dispute or related violence, it will be discussed and considered only in front
                            of ‘Judiciary of Ariyalur’ at Ariyalur, Tamil Nadu, India.</li>
                    </ul>
                </div>
                <div>
                    <h2 id="final-proof-of-the-paper" class="sec-anchor">
                        Final Proof of the Paper
                    </h2>
                    <p>
                        One set of page proofs (as PDF files) will be sent by e-mail to the corresponding author or a
                        link will be provided in the e-mail so that the authors can download the files themselves.
                        These PDF proofs can be annotated; for this you need to download Adobe Reader version 7
                        (or higher) available free at <a href="https://get.adobe.com/reader" target="_blank">get.adobe.com/reader</a>. If authors do not wish to use the PDF
                        annotations function, they may list the corrections and return them to IJSREAT in an e-
                        mail <a href="mailto:editorinchief@ijsreat.com">editorinchief@ijsreat.com</a>. Please list corrections quoting line number. If, for any reason,
                        this is not possible, then mark the corrections and any other comments on a printout of the
                        proof and then scan the pages having corrections and e-mail them back, within 05 days.
                        Please use this proof only for checking the typesetting, editing, completeness and
                        correctness of the text, tables and figures. Significant changes to the paper that has been
                        accepted for publication will not be considered at this stage without prior permission. It is
                        important to ensure that all corrections are sent back to us in one communication: please
                        check carefully before replying, as inclusion of any subsequent corrections cannot be
                        guaranteed. Proofreading is solely authors’ responsibility. Note that IJSREAT will proceed
                        with the publication of paper, if no response is received within 05 days.
                    </p>
                </div>
            </div>
            <div>
                <h2 id="article-page-limit" class="sec-anchor">Article Page Limit</h2>
                <p>
                    To maintain publication quality and standardization, the journal requires that all submitted research articles comply with the prescribed page limit.
                </p>
                <div>
                    <p><b>Article Length Requirement</b></p>
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
                    <h2 id="important-guidelines" class="sec-anchor">Important Guidelines</h2>
                    <ol>
                        <li>Manuscripts exceeding <b>20 pages</b> will be returned to authors for reduction.</li>
                        <li>Authors must use the official journal template.</li>
                        <li>All submissions must follow formatting and referencing guidelines.</li>
                        <li>Plagiarism should be within acceptable limits as per journal policy.</li>
                    </ol>
                </div>
                <p>Failure to comply with the page limit requirement may result in processing delay or rejection.</p>
                <p>We request authors to carefully review the Instructions for Authors before submission.</p>
            </div>
        </div>
    
            </div>
            <x-archive.verify-strip />
        </div>
    </div>
</div>
@endsection
