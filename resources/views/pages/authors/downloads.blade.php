@extends('layouts.app')

@section('meta_title', 'IJSREAT | Downloads – Copyright Form & Manuscript Template')
@section('meta_description', 'Download IJSREAT resources including copyright form and manuscript template. Authors can access required documents for article submission and publication in our journal.')

@include('archives.partials.theme')

@section('content')
<div class="hp">
    <x-archive.pageband title="Downloads" :crumbs="['For Authors' => '/instruction-for-author', 'Downloads' => null]"
        lead="Documents authors need when preparing and publishing an article in IJSREAT." />

    <div class="apage">
        <div class="amain">
            <div class="two-col">
                <div class="panel2">
                    <h3><x-homepage.icon name="file" /> Manuscript Template</h3>
                    <p class="muted" style="margin-bottom:14px">Word document (.docx). Prepare your article in this format before submission.</p>
                    <a class="button button--solid" href="https://ijsreat.com/downloads/manuscript.docx?id=123" target="_blank"><x-homepage.icon name="download" /> Download Document</a>
                </div>
                <div class="panel2">
                    <h3><x-homepage.icon name="doc" /> CopyRight Form</h3>
                    <p class="muted" style="margin-bottom:14px">PDF. Required for publication after your article is accepted.</p>
                    <a class="button button--solid" href="https://ijsreat.com/downloads/copyrights.pdf" target="_blank"><x-homepage.icon name="download" /> Download PDF</a>
                </div>
            </div>

            <div class="qlinks">
                <a class="qlink" href="/instruction-for-author"><x-homepage.icon name="doc" /> Instruction for Authors</a>
                <a class="qlink" href="/guidance-for-ems"><x-homepage.icon name="journal" /> Guidance for EMS</a>
                <a class="qlink" href="/article-processing-charges"><x-homepage.icon name="coins" /> Article Processing Charges</a>
            </div>
        </div>

        <x-archive.sidebar />
    </div>
</div>
@endsection
