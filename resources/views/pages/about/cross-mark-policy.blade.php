@extends('layouts.app')

@section('meta_title', 'IJSREAT | Crossmark Policy – Ensuring Research Integrity & Updates')
@section('meta_description', 'IJSREAT follows the CrossMark policy to maintain content integrity. Readers can access the latest article versions, corrections, and updates for reliable academic research.')

@include('archives.partials.theme')

@section('content')
<div class="hp">
    <x-archive.pageband title="Crossmark Policy" :crumbs="['Ethics & Policies' => '/ethics', 'Crossmark Policy' => null]"
        lead="Our journal participates in CrossMark, a multi-publisher initiative that has developed a standard way for readers to locate the current version of an article." />

    <div class="apage apage--doc">
        <nav class="doc-toc" aria-label="On this page">
            <p class="doc-toc__h">On this page</p>
            <a href="#policy">Policy</a>
            <a href="#corrections">Corrections and retractions</a>
            <a href="#look">What does it look like?</a>
            <a href="#how">How it works?</a>
        </nav>
        <div class="amain">
            <p class="doi-line">
                <b>Crossmark Policy DOI :</b>
                <a target="_blank" rel="noopener" href="http://dx.doi.org/10.59256/ijsreat/CrossMark-Policy-Page">http://dx.doi.org/10.59256/ijsreat/CrossMark-Policy-Page</a>
            </p>

            <div class="doc">
                <p id="policy" class="sec-anchor">
                    Our journal participates in CrossMark, a multi-publisher initiative that has developed a standard way for readers to locate
                    the current version of an article. By enforcing CrossMark policies, <strong>Our journal</strong> is committed to maintaining
                    the content it publishes and alerting readers to changes as and when they occur.
                </p>
                <p>
                    Clicking on the CrossMark logo (at the top of each article) provides the current status of an article and directs you to the
                    latest published version and may also provide additional information.
                </p>
                <p id="corrections" class="sec-anchor">
                    To maintain the integrity and integrity of the academic record, the following policies will apply when published content needs
                    to be corrected; These policies take into account current best practices in the academic publishing and library communities:
                </p>
                <ol>
                    <li>
                        Correction of an article is peer-reviewed prior to publication, corrections (or Erratum) are published to alert readers to
                        errors in the article that became apparent after the publication of the final article.
                    </li>
                    <li>
                        Retraction Articles may be removed for a variety of reasons, including research misconduct (data fabrication), duplicate or
                        overlapping publication, fraudulent use of data, clear plagiarism, and unethical research.
                    </li>
                </ol>
                <p>
                    For any article withdrawn, the reason for the withdrawal and who is instigating the withdrawal will be clearly stated in the
                    Withdrawal notice. The withdrawal notice will be linked to the withdrawn article (which usually remains on the site) and the
                    article will be clearly marked as withdrawn (including the PDF). Generally, an article is withdrawn at the request of the
                    authors or the editor in response to an institutional investigation.
                </p>
                <p>
                    The content of a withdrawn article will only be removed when legal limitations are imposed on the publisher, copyright holder,
                    or author(s), for example, if the article is clearly defamatory or violates the legal rights of others or if the article is
                    the same, subject to a court order. In such cases, the bibliographic information of the article will be kept on the site, along
                    with information about the circumstances that led to the removal of the content.
                </p>
                <p>
                    In rare circumstances, for example, if false or inaccurate data has been published and, if adopted, presents a serious health
                    risk, the original incorrect versions may be removed and a corrected version published. The reason for this partial removal
                    would be clearly stated in the most recent version.
                </p>
            </div>

            <x-archive.verify-strip />

            <div class="doc">
                <h2 id="look" class="sec-anchor">What does it look like?</h2>
                <p>The CrossMark logo will appear on the title page of every published document.</p>

                <h2 id="how" class="sec-anchor">How it works?</h2>
                <p>
                    We have added the <span>Crossmark</span> logo to the version of record for all published documents. Clicking on the CrossMark icon will inform the reader of the current status of a document and additional publication record information, such as funding information and author ORCIDs (if available). As an author, this gives your work an extra level of authenticity.
                </p>
                <p>
                    Clicking on the Crossmark logo will tell you the current status of a document and may also give you additional publication record information about the document (e.g. information on content type, peer review, publication history, availability of supplementary materials, and copyright and licensing).
                </p>
            </div>

            <div class="qlinks">
                <a class="qlink" href="/ethics?target=article-withdrawal"><x-homepage.icon name="file" /> Article withdraw policy</a>
                <a class="qlink" href="/ethics?target=editorial-policies"><x-homepage.icon name="edit" /> Editorial Policies</a>
                <a class="qlink" href="/publication-ethics-policy"><x-homepage.icon name="scale" /> Publication Ethics Policy</a>
                <a class="qlink" href="/archives"><x-homepage.icon name="book" /> Archives</a>
            </div>
        </div>
    </div>
</div>
@endsection
