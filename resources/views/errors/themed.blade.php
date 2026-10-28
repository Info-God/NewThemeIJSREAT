{{-- Shared error page in the site theme. Each errors/{code}.blade.php sets
     $code, $heading and $text and includes this view. --}}
@extends('layouts.app')

@section('meta_title', $code . ' | ' . $heading . ' | IJSREAT')
@section('meta_description', $text)

@include('archives.partials.theme')

@section('content')
<div class="hp">
    <x-archive.pageband :title="$heading" :crumbs="[$code . ' ' . $heading => null]" />

    <div class="apage" style="grid-template-columns:1fr">
        <div class="amain">
            <section class="errbox">
                <p class="errbox__code" aria-hidden="true">{{ $code }}</p>
                <h2>{{ $heading }}</h2>
                <p>{{ $text }}</p>
                <div class="errbox__actions">
                    <a class="button button--solid" href="/"><x-homepage.icon name="arrow" /> Go to the home page</a>
                    <a class="button button--out-orange" href="/current-issue"><x-homepage.icon name="book" /> Current Issue</a>
                    <a class="button button--out-orange" href="/contact-us"><x-homepage.icon name="mail" /> Contact Us</a>
                </div>
            </section>

            <div class="qlinks">
                <a class="qlink" href="/archives"><x-homepage.icon name="book" /> Archives</a>
                <a class="qlink" href="/aim-and-scope"><x-homepage.icon name="cpu" /> Aim &amp; Scope</a>
                <a class="qlink" href="/instruction-for-author"><x-homepage.icon name="file" /> Instruction for Authors</a>
                <a class="qlink" href="/editorial-board"><x-homepage.icon name="users" /> Editorial Board</a>
                <a class="qlink" href="/blogs"><x-homepage.icon name="edit" /> Blog</a>
            </div>
        </div>
    </div>
</div>
@endsection
