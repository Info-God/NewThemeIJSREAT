@extends('layouts.app')

@section('meta_title', 'IJSREAT | Article Processing Charges – International Journal of Scientific Research in Engineering & Technology')
@section('meta_description', 'IJSREAT charges minimal article processing fees to support open-access publishing. Affordable APCs for Indian and international authors ensure global research accessibility.')

@include('archives.partials.theme')

@section('content')
<div class="hp">
    <x-archive.pageband title="Article Processing Charges" :crumbs="['For Authors' => '/instruction-for-author', 'Article Processing Charges' => null]"
        lead="Open-access publication, so it is freely available online. The cost on publishing online editions, and to ensure the continuous appearance of the journal, the core committee has decided to charge a minimal fee from the authors after the acceptance of manuscript as follows:" />

    <div class="apage">
        <div class="amain">
            <section aria-labelledby="apc-fees">
                <div class="block-title"><h2 class="rule-title" id="apc-fees">Case Report / Original Article / Review Article Fee</h2></div>
                <div class="price">
                    <div class="pcard pcard--in">
                        <span class="pcard__who">For Indian authors</span>
                        <div class="pcard__rows">
                            <div class="pcard__row"><span>Without DOI</span><p class="pcard__amt">₹1200 <small>INR + 18% GST</small></p></div>
                            <div class="pcard__row"><span>With DOI</span><p class="pcard__amt">₹1400 <small>INR + 18% GST</small></p></div>
                        </div>
                    </div>
                    <div class="pcard pcard--fn">
                        <span class="pcard__who">For International Author</span>
                        <div class="pcard__rows">
                            <div class="pcard__row"><span>With DOI</span><p class="pcard__amt">$80 <small>USD</small></p></div>
                        </div>
                        <p class="pcard__note">Authors of any country can convert USD to their respective currency using the Google currency calculator.</p>
                    </div>
                    <div class="pcard pcard--incl">
                        <span class="pcard__who">Journal Hosting System</span>
                        <ul class="incl">
                            <li><span class="tic tic--sm"><x-homepage.icon name="gear" /></span>Editorial management System</li>
                            <li><span class="tic tic--sm"><x-homepage.icon name="edit" /></span>In-house copyediting and linguistic support</li>
                            <li><span class="tic tic--sm"><x-homepage.icon name="file" /></span>Pagination &amp; typesetting</li>
                            <li><span class="tic tic--sm"><x-homepage.icon name="database" /></span>Archiving, where appropriate, in an internationally recognized, open access repositories.</li>
                        </ul>
                    </div>
                </div>
            </section>

            <div class="panel2">
                <h3><x-homepage.icon name="help" /> Note</h3>
                <ul class="checks">
                    <li>After making payment the proof of payment should be produced.</li>
                    <li>The manuscript fee is non-refundable, and if the author wishes to withdraw the manuscript after paying the charges, the fees, in that case, would not be refunded.</li>
                    <li>Detailed information about how to transfer the manuscript fee will be sent on request.</li>
                </ul>
                <p class="muted" style="margin-top:10px">If you face any problems or difficulties please <a href="/contact-us" style="color:var(--brand);font-weight:700">contact us</a> for further guidance. Send us a copy of the receipt as proof of the transfer of the money. Once the required transaction is confirmed by our bank, we will intimate you promptly.</p>
            </div>

            <div class="two-col">
                <div class="panel2">
                    <h3><x-homepage.icon name="shield" /> Waivers Policy</h3>
                    <p class="muted">Publication of an article in the journal is not contingent upon the author's ability to pay the charges. Neither is acceptance to pay the handling fee a guarantee that the paper will be accepted for publication. Authors that may not be able to pay can request the editorial office to reduce the fee to an amount as per editorial office norms. We only accept payment of handling fee/processing charges after the manuscript has been accepted for publication.</p>
                </div>
                <div class="panel2">
                    <h3><x-homepage.icon name="check" /> Qualifying for a Waiver</h3>
                    <p class="muted">To help support researchers in low-income economies according to World Bank, the Journal provides an automatic 50% waiver of any Article Processing Charges for manuscripts where all authors listed affiliation is in one of these countries.</p>
                    <p class="muted" style="margin-top:10px">Additionally, the Journal will provide a 50% reduction in any APCs when the author(s) of an article does not have the funding required to cover these charges and can provide one of the following to demonstrate this:</p>
                    <ul class="checks" style="margin-top:10px">
                        <li>Signed letter from author(s) suitable institutional representative, such as institutional Head of Department, with verifiable institutional email address confirming payment will be made from author’s personal funds (all authors must provide a letter to this effect)</li>
                        <li>Signed letter from retired or independent author(s) indicating their lack of institutional association and confirming payment will be made from personal funds (all authors on paper must be retired or independent and confirm this)</li>
                        <li>Signed letter from the author(s) institution(s) confirming budget constraints, indicating their funding body does not cover publication charges or indicating the institutional budgets are severely impacted. This must be signed by the Institutional Head of Department with verifiable institutional email address clearly stating the budget constraints (all authors must provide a letter to this effect)</li>
                    </ul>
                </div>
            </div>

            <x-archive.verify-strip />
        </div>

        <x-archive.sidebar />
    </div>
</div>
@endsection
