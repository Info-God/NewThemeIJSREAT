@extends('layouts.app')

@section('meta_title', 'IJSREAT | Peer Review Policy – International Journal of Scientific Research in Engineering & Technology')
@section('meta_description', 'IJSREAT follows a single peer review process to ensure quality, originality, and integrity of research. We publish innovative work in engineering, technology, and related disciplines.')

@include('archives.partials.theme')

@section('content')
<div class="hp">
    <x-archive.pageband title="Peer Review Policy" :crumbs="['Ethics & Policies' => '/ethics', 'Peer Review Policy' => null]"
        lead="Reviewers play a central role in scholarly publishing.">
        <span class="pbf pbf--cyan"><x-homepage.icon name="clock" /><span>Review time</span><b>01 to 03 weeks</b></span>
        <span class="pbf pbf--leaf"><x-homepage.icon name="users" /><span>Referees</span><b>at least 3 or 4</b></span>
    </x-archive.pageband>

    <div class="apage apage--doc">
        <nav class="doc-toc" aria-label="On this page">
            <p class="doc-toc__h">On this page</p>
            <a href="#about">About the journal</a>
            <a href="#process">Review process</a>
            <a href="#characteristics">Characteristics of the peer review process</a>
        </nav>
        <div class="amain">
            <div class="doc">
                <h2 id="about" class="sec-anchor">International Journal of Scientific Research in Engineering & Technology (IJSREAT) is having</h2>
                <p>
                    <strong>ISSN NO:</strong> 2583-1240 (Online), Bi-monthly international journal for publication of new ideas founded by academicians,
                    educationist, engineers and corporate people. The research results and fundamental advancement are all aspects of Innovative Research in
                    Advanced Engineering &amp; Technology and various engineering disciplines, etc. IJSREAT is a scholarly open access, Single Peer Review Journal
                    which helps to academic person as well as student community.
                </p>
                <p>
                    IJSREAT provides the academic community and industry for the submission of original research and applications related to Various Engineering
                    discipline and Advanced Technologies by FDRP Publications, Tamilnadu, India since year 2020.
                </p>

                <h2 id="process" class="sec-anchor">Review process</h2>
                <p>
                    Reviewers play a central role in scholarly publishing. IJSREAT uses Single peer review process, which means that both the reviewer(s) and
                    author(s) identities are concealed from the reviewer(s), and vice versa, throughout the review process. This means that the reviewer(s) of
                    the paper won’t get to know the identity of the author(s), and the author(s) won’t get to know the identity of the reviewer(s). Peer review
                    helps validate research, establish a method by which it can be evaluated, and increase networking possibilities within research communities.
                    Despite criticisms, peer review is still the only widely accepted method for research validation.
                </p>
                <p>
                    All submitted papers will be reviewed by Single peer review process which may take minimum 01 to 03 weeks from the date of submission. We are
                    advising to all the author(s), do not submit same manuscript to multiple journals. You should wait for review status of paper.
                </p>
                <p>
                    IJSREAT is committed to prompt evaluation and publication of fully accepted papers. To maintain a high-quality publication, all submissions
                    undergo a rigorous review process. Characteristics of the peer review process are as follows:
                </p>

                <h2 id="characteristics" class="sec-anchor">Characteristics of the peer review process</h2>
                <ul>
                    <li>Simultaneous submissions of the same manuscript to different journals will not be tolerated.</li>
                    <li>Manuscripts with contents outside the scope will not be considered for review.</li>
                    <li>
                        Papers will be refereed by at least 3 or 4 experts (reviewers) as suggested by the editorial board in which 01 from India and rest 02 or
                        03 from overseas.
                    </li>
                    <li>In addition, Editors will have the option of seeking additional reviews when needed.</li>
                    <li>
                        Authors will be informed when Editors decide further review is required. All publication decisions are made by the journal’s
                        Editors-in-Chief on the basis of the referees’ reports (reviewers report).
                    </li>
                    <li>Authors of papers that are not accepted are notified promptly.</li>
                    <li>
                        All submitted manuscripts are treated as confidential documents. All submitted papers will be reviewed by double blind review process.
                    </li>
                    <li>
                        All manuscripts submitted for publication in IJSREAT cross-checked for plagiarism software. Manuscripts found to be plagiarized during
                        initial stages of review are out-rightly rejected and not considered for publication in the journal.
                    </li>
                    <li>
                        In case if a manuscript is found to be plagiarized after publication, the Editor-in-Chief will conduct preliminary investigation, may be
                        with the help of a suitable committee constituted for the purpose. If the manuscript is found to be plagiarized beyond the acceptable
                        limits, the journal will contact the author's Institute / College / University and Funding Agency, if any.
                    </li>
                    <li>IJSREAT strictly uses following Single peer review process</li>
                </ul>
            </div>

            <x-archive.verify-strip />

            <div class="qlinks">
                <a class="qlink" href="/journal-publishing-process"><x-homepage.icon name="list" /> Journal Publishing Process</a>
                <a class="qlink" href="/publication-ethics-policy"><x-homepage.icon name="scale" /> Publication Ethics Policy</a>
                <a class="qlink" href="/ethics?target=plagiarism-policy"><x-homepage.icon name="search" /> Plagiarism Policy</a>
            </div>
        </div>
    </div>
</div>
@endsection
