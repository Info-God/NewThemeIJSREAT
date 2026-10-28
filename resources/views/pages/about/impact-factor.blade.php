@extends('layouts.app')

@section('meta_title', 'IMPACT-FACTOR | International Journal of Scientific Research in Engineering & Technology')
@section('meta_description', 'IJSREAT (e-ISSN: 2583-1240) is a bi-monthly, peer-reviewed, open-access journal publishing innovative research in Science, Engineering & Technology.')

@include('archives.partials.theme')

@php
    // Values as printed on IJSREAT's I2OR certificates shown below (public/Impact1-4.webp).
    $certificates = [
        ['year' => 2024, 'pif' => '8.530', 'image' => '/Impact4.webp'],
        ['year' => 2023, 'pif' => '4.547', 'image' => '/Impact3.webp'],
        ['year' => 2022, 'pif' => '3.587', 'image' => '/Impact2.webp'],
        ['year' => 2021, 'pif' => '2.168', 'image' => '/Impact1.webp'],
    ];
@endphp

@section('content')
<div class="hp">
    <x-archive.pageband title="Impact Factor" :crumbs="['Indexing & Abstracting' => '/indexing-and-abstracting', 'Impact Factor' => null]"
        lead="Publication Impact Factor (PIF) certificates issued to IJSREAT by the International Institute of Organized Research (I2OR).">
        @foreach ($certificates as $i => $c)
            <span @class(['pbf', 'pbf--cyan' => $i === 0, 'pbf--orange' => $i === 1])><x-homepage.icon name="chart" /><span>PIF {{ $c['year'] }}</span><b>{{ $c['pif'] }}</b></span>
        @endforeach
    </x-archive.pageband>

    <div class="apage">
        <div class="amain">
            <div class="lead-note">
                <x-homepage.icon name="help" />
                <span>The Publication Impact Factor is calculated and certified by <a href="http://www.i2or.com/pif.html" target="_blank" rel="noopener">I2OR</a>. It is a different metric from the Journal Impact Factor published by Clarivate.</span>
            </div>

            @foreach ($certificates as $c)
                <section aria-labelledby="pif-{{ $c['year'] }}">
                    <div class="block-title">
                        <h2 class="rule-title" id="pif-{{ $c['year'] }}">PIF {{ $c['pif'] }} for {{ $c['year'] }}</h2>
                    </div>
                    <figure class="imgcard">
                        <img src="{{ $c['image'] }}" alt="I2OR certificate: Publication Impact Factor {{ $c['pif'] }} for the year {{ $c['year'] }}" loading="lazy">
                    </figure>
                </section>
            @endforeach

            <div class="qlinks">
                <a class="qlink" href="/indexing-and-abstracting"><x-homepage.icon name="globe" /> Indexing &amp; Abstracting</a>
                <a class="qlink" href="/journal-particulars"><x-homepage.icon name="doc" /> Journal Particulars</a>
                <a class="qlink" href="/current-issue"><x-homepage.icon name="journal" /> Current Issue</a>
            </div>
        </div>

        <x-archive.sidebar />
    </div>
</div>
@endsection
