@extends('layouts.app')

@section('meta_title', 'IJSREAT | Frequently Asked Questions – International Journal of Scientific Research in Engineering & Technology')
@section('meta_description', 'Find answers to common questions about IJSREAT, including paper submission, peer review, publication process, indexing, ethics policies, and open-access guidelines.')

@include('archives.partials.theme')

@php
    $faqs = [
        ['What is the ISSN of the journal?', 'ISSN: ISSN-2583-1240'],
        ['When it was started? | When first issue of the journal was published?', 'It was started in year 2021. IJSREAT is being published by 5th Dimension Research Publication. First Issue: January–February 2021'],
        ['Is it open access journal?', 'Yes, it is an open access journal.'],
        ['Is it peer reviewed journal?', 'Yes, it is peer reviewed journal.'],
        ['How much time you will take to resolve a query?', 'It will be resolved within 24 hours.'],
        ['What is the plagiarism policy?', 'We do not accept papers that are having plagiarized contents. Good quality plagiarism software/tool will be used to check similarity that would not be more than 30% including reference section. In the case of exclusion of references, it should be less than 5%.'],
        ['Which software is referred for plagiarism/similarity check?', 'Turnitin software/ Ithenticate/ Plagiarism checker X'],
        ['Can I send only abstract for review?', 'No, you have to send full length paper for review process.'],
        ['Is it compulsory to come for reading/presenting the paper in PPT?', 'No, there is no need to come here for reading/presenting your paper. Your paper is sufficient for all purposes. Send your paper for review process. Once your paper is accepted by the editorial board of committee of the journal, we will send you notification of your paper over the email along with further guidelines for the publication of your paper.'],
        ['How much time will you take for review process?', 'It depends on reviewer response. It will take min 01 to 07 days.'],
        ['My paper has been published. Can make any changes now in the paper?', 'Author(s) can make rectification in the final paper but after the final submission to the journal, rectification is not possible.'],
        ['What are the terms and conditions to withdraw my paper?', 'Terms and conditions are available in the ‘Ethics & Policy’ page. Please check the journal website. If once the paper is published It is not possible to withdraw the paper.'],
        ['Is any Instructions/Guidelines for authors?', 'Yes, it is available in the ‘Ethics & Policy’ page. Please visit journal website.'],
        ['What are the Terms & Conditions of the journal?', 'Please visit journal website. It is available in the “Ethics & Policy” page'],
        ['Is any payment guideline available?', 'Journal does not take any kind of publication fee/acceptance fee/review fee/handling fee/processing fee. It is free journal'],
        ['Is any paper publication fee/handling fee?', 'No, it’s free. Journal does not take any kind of publication fee/acceptance fee/review fee/handling fee/processing fee. It is free journal.'],
        ['My article has been published but there is some correction. What did I do? | My article has been published but I want some changes. Is it possible?', 'Author(s) can make rectification in the final paper but after the final submission to the journal, rectification is not possible.'],
        ['Is the scam, fake, predatory, standalone?', 'No, this journal is not a fake journal. It is 100% legal, registered and recognized journal. If you have proof of it then please write me. We will give verification and validation.'],
    ];
@endphp

@section('content')
<div class="hp">
    <x-archive.pageband title="Frequently Asked Questions" :crumbs="['FAQs' => null]"
        lead="Answers to common questions about IJSREAT, submission, review and publication.">
        <span class="pbf pbf--cyan"><x-homepage.icon name="help" /><span>Questions</span><b>{{ count($faqs) }}</b></span>
    </x-archive.pageband>

    <div class="apage">
        <div class="amain" x-data="{ q: '', open: false }">
            <div class="faq-tools">
                <input type="search" x-model="q" placeholder="Search the questions" aria-label="Search the questions">
                <button type="button" class="button button--out-orange" @click="open = !open; $root.querySelectorAll('.faq-item').forEach(d => d.open = open)">
                    <span x-text="open ? 'Collapse all' : 'Expand all'">Expand all</span>
                </button>
            </div>

            <div class="faq-list">
                @foreach ($faqs as $i => [$question, $answer])
                    <details class="faq-item" id="q{{ $i + 1 }}" data-text="{{ mb_strtolower($question . ' ' . $answer) }}"
                        x-show="!q.trim() || $el.dataset.text.includes(q.trim().toLowerCase())" @if ($i === 0) open @endif>
                        <summary class="faq-q"><b>Q–{{ $i + 1 }}</b><span>{{ $question }}</span></summary>
                        <p class="faq-a">Ans: {{ $answer }}</p>
                    </details>
                @endforeach
                <p class="pempty" x-show="q.trim() && ![...$root.querySelectorAll('.faq-item')].some(d => d.dataset.text.includes(q.trim().toLowerCase()))" x-cloak>
                    No question matches “<span x-text="q"></span>”. Please <a href="/contact-us">contact us</a>.
                </p>
            </div>

            <x-archive.verify-strip />
        </div>

        <x-archive.sidebar />
    </div>
</div>
@endsection
