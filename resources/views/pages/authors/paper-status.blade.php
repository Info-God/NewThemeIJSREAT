@extends('layouts.app')

@section('meta_title', 'IJSREAT | Check Article Status – International Journal of Scientific Research in Engineering & Technology')
@section('meta_description', 'Authors can check the status of their submitted articles using login credentials in the IJSREAT editorial system for real-time updates on review and publication.')

@include('archives.partials.theme')

@section('content')
<div class="hp">
    <x-archive.pageband title="Paper Status" :crumbs="['For Authors' => '/instruction-for-author', 'Paper Status' => null]" />

    <div class="apage">
        <div class="amain">
            <section class="ps-hero">
                <div>
                    <h2>Author can check the article status by using Author login Credential</h2>
                    <p>Sign in to the Editorial Management System (EMS) with the account you used to submit your paper.</p>
                </div>
                <a class="button button--solid" href="https://editorial.fdrpjournals.org/login?journal=2" target="_blank" rel="noopener noreferrer">
                    <x-homepage.icon name="external" /> Click Here to Check Status
                </a>
            </section>

            <figure class="ps-fig">
                <img loading="lazy" src="/artical-processing/artical.png" alt="Article processing workflow">
            </figure>

            <div class="qlinks">
                <a class="qlink" href="/journal-publishing-process"><x-homepage.icon name="list" /> Journal Publishing Process</a>
                <a class="qlink" href="/guidance-for-ems"><x-homepage.icon name="journal" /> Guidance for EMS</a>
                <a class="qlink" href="/peer-review-policy"><x-homepage.icon name="eye" /> Peer Review Policy</a>
                <a class="qlink" href="/contact-us"><x-homepage.icon name="mail" /> Contact Us</a>
            </div>
        </div>

        <x-archive.sidebar />
    </div>
</div>
@endsection
