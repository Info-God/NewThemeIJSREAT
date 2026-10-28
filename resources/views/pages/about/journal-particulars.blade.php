@extends('layouts.app')

@section('meta_title', 'IJSREAT | Journal Particulars – International Journal of Scientific Research in Engineering & Technology')
@section('meta_description', 'View IJSREAT journal particulars including ISSN: 2583-1240, bi-monthly frequency, publisher details, editorial board, DOI, contact information, and publication format.')

@include('archives.partials.theme')

@php
    $facts = [
        ['Title', 'journal', 'International Journal of Scientific Research in Engineering & Technology', null],
        ['Frequency', 'calendar', 'Bi-Monthly', null],
        ['ISSN', 'hash', '2583-1240', null],
        ['Publisher', 'building', 'Fifth Dimension Research Publication (P) Ltd.', null],
        ['Chief', 'user', 'Dr. S. Sivaganesan (Professor & Head)', '/editorial-board'],
        ['Copyright', 'lock', 'Fifth Dimension Research Publication (P) Ltd.', null],
        ['Starting Year', 'clock', '2021', null],
        ['Subject', 'cpu', 'Engineering', '/aim-and-scope'],
        ['DOI', 'link', '10.59256/ijsreat', null],
        ['Language', 'globe', 'English', null],
        ['Publication Format', 'monitor', 'Online', null],
        ['Mobile No', 'phone', '+91 9840521421', 'tel:+919840521421'],
        ['Email-ID', 'mail', 'editorinchief@ijsreat.com', 'mailto:editorinchief@ijsreat.com'],
        ['Website', 'external', 'www.ijsreat.com', 'https://www.ijsreat.com'],
    ];
@endphp

@section('content')
<div class="hp">
    <x-archive.pageband title="Journal Particulars" :crumbs="['Journal Particulars' => null]"
        lead="International Journal of Scientific Research in Engineering & Technology">
        <span class="pbf pbf--cyan"><x-homepage.icon name="hash" /><span>ISSN</span><b>2583-1240</b></span>
        <span class="pbf pbf--leaf"><x-homepage.icon name="link" /><span>DOI prefix</span><b>10.59256/ijsreat</b></span>
    </x-archive.pageband>

    <div class="apage">
        <div class="amain">
            <div class="dcard">
                <div class="dcard__head"><h2><span class="tic"><x-homepage.icon name="doc" /></span> Journal Particulars</h2></div>
                <dl class="dl dcard__body">
                    @foreach ($facts as [$label, $icon, $value, $href])
                        <div>
                            <dt><x-homepage.icon :name="$icon" /> {{ $label }}</dt>
                            <dd>@if ($href)<a href="{{ $href }}">{{ $value }}</a>@else{{ $value }}@endif</dd>
                        </div>
                    @endforeach
                    <div class="dl--wide">
                        <dt><x-homepage.icon name="pin" /> Address</dt>
                        <dd>Fifth Dimension Research Publication (P) Ltd. No: 38D5F, Rajaji Nagar, Ariyalur–621713. Tamilnadu, India.</dd>
                    </div>
                </dl>
            </div>

            <x-archive.verify-strip />
        </div>

        <x-archive.sidebar />
    </div>
</div>
@endsection
