{{-- Homepage-only footer (IJCRT-style). Content and links come from
     components/footer.blade.php, which every other page keeps using. --}}
@php
    $emsUrl = 'https://editorial.fdrpjournals.org/login?journal=2';
    $guidelines = [
        ['Instructions for Authors', '/instruction-for-author'],
        ['Editor guidelines', '/ethics?target=instructions-for-authors'],
        ['Journal Publishing Process', '/journal-publishing-process'],
        ['Call for Papers', '/call-for-papers'],
        ['Editorial Management System', '/guidance-for-ems'],
        ['Archives', '/archives'],
        ['Tags', '/tag'],
    ];
    $policies = [
        ['Peer Review Policy', '/peer-review-policy'],
        ['Publication Policy', '/publication-ethics-policy'],
        ['Ethics And Policies', '/ethics'],
        ['Crossmark Policy', '/cross-mark-policy'],
        ['Open Access Policy', '/ethics?target=open-access-policy'],
        ['Plagiarism Policy', '/ethics?target=plagiarism-policy'],
    ];
@endphp

<footer class="hp hp-footer">
    <span class="ft-blob ft-blob--1" aria-hidden="true"></span>
    <span class="ft-blob ft-blob--2" aria-hidden="true"></span>

    <div class="ft-inner">
        <div class="ft-brand">
            <span class="ft-brand__logo"><img src="/logo.webp" alt="Fifth Dimension Research Publication" width="146" height="36" loading="lazy"></span>
            <strong class="ft-brand__name">IJSREAT</strong>
            <span class="ft-brand__full">International Journal of Scientific Research in Engineering & Technology</span>
            <p class="ft-brand__desc">An International Scholarly Open Access Journal, Peer-reviewed, Refereed Journal. Bi-Monthly, Multidisciplinary Journal.</p>
            <div class="ft-badges">
                <span class="ft-badge">e-ISSN 2583-1240</span>
                <span class="ft-badge">Since 2021</span>
                <span class="ft-badge">Open Access</span>
            </div>
            <ul class="ft-mini" aria-label="IJSREAT at a glance">
                <li><strong>6</strong><span>Issues / Year</span></li>
                <li><strong>2021</strong><span>Started</span></li>
                <li><strong>CC BY</strong><span>4.0 Licence</span></li>
            </ul>
        </div>

        <div class="ft-col">
            <h3 class="ft-heading">Guidelines &amp; Policies</h3>
            <div class="ft-links-grid">
                <nav aria-label="Guidelines">
                    @foreach ($guidelines as [$label, $href])
                        <a class="ft-link" href="{{ $href }}"><x-homepage.icon name="arrow" /> {{ $label }}</a>
                    @endforeach
                </nav>
                <nav aria-label="Policies">
                    @foreach ($policies as [$label, $href])
                        <a class="ft-link" href="{{ $href }}"><x-homepage.icon name="arrow" /> {{ $label }}</a>
                    @endforeach
                </nav>
            </div>
        </div>

        <div class="ft-col">
            <h3 class="ft-heading">Contact Us</h3>
            <ul class="ft-contact">
                <li>
                    <span class="ft-contact__icon"><x-homepage.icon name="mail" /></span>
                    <div><small>Email</small><a href="mailto:editorinchief@ijsreat.com">editorinchief@ijsreat.com</a><a href="mailto:Support@fdrpjournals.org">Support@fdrpjournals.org</a></div>
                </li>
                <li>
                    <span class="ft-contact__icon"><x-homepage.icon name="phone" /></span>
                    <div><small>Mobile</small><a href="tel:+919840521421">+91 9840521421</a></div>
                </li>
                <li>
                    <span class="ft-contact__icon"><x-homepage.icon name="pin" /></span>
                    <div><small>Address</small><span>No: 38D5F, Rajaji nagar, Ariyalur-621713, Tamilnadu, India.</span></div>
                </li>
            </ul>
            <a class="ft-submit-cta" href="{{ $emsUrl }}" target="_blank" rel="noopener noreferrer">Submit Your Research <x-homepage.icon name="arrow" /></a>
        </div>

        <div class="ft-col">
            <h3 class="ft-heading">Our Publisher</h3>
            <div class="ft-publisher">
                <p class="ft-publisher-name">Fifth Dimension Research Publication (P) Ltd.</p>
                <ul class="ft-facts">
                    <li><strong>e-ISSN</strong> 2583-1240 · <strong>Starting Year</strong> 2021</li>
                    <li><strong>Frequency</strong> Bi-Monthly</li>
                    <li><strong>DOI prefix</strong> 10.59256/ijsreat</li>
                    <li><strong>Editor-in-Chief</strong> Dr. S. Sivaganesan (Professor &amp; Head)</li>
                    <li><strong>Language</strong> English · <strong>Format</strong> Online</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="ft-bottom">
        <div>
            <p>Copyright © 2025 <strong>IJSREAT</strong> Published by Fifth Dimension research Publication (P) Ltd. All Rights Reserved.</p>
            <p>Work is licensed under a Creative Commons Attribution 4.0 International License.</p>
        </div>
        <nav class="ft-policy-links" aria-label="Policy links">
            <a href="/privacy-policy" target="_blank">Privacy Policy</a>
            <a href="/terms-and-conditions" target="_blank">Terms And Conditions</a>
            <a href="/refund-policy" target="_blank">Refund Policy</a>
        </nav>
    </div>
</footer>

<div class="hp">
    <x-homepage.publish-dock />
</div>
