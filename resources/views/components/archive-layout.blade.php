@props([
    'title' => 'ARCHIVES',
    'subtitle' => null,
    'isArticleDetails' => false,
    'activeArticle' => null,
    'sidebarMode' => 'list',
    'showSidebar' => true,
    'hideLinks' => false
])

@php
    $quickLinks = [
        ['title' => "Aim & Scope", 'link' => "/aim-and-scope"],
        ['title' => "Instruction for Authors", 'link' => "/instruction-for-author"],
        ['title' => "Journal Publishing Process", 'link' => "/journal-publishing-process"],
        ['title' => "Editorial Management System", 'link' => "/guidance-for-ems"],
        ['title' => "Paper Status", 'link' => "/paper-status"],
        ['title' => "Topics", 'link' => "/topics"],
        ['title' => "Call for papers", 'link' => "/call-for-papers"],
        ['title' => "Indexing & Abstracting", 'link' => "/indexing-and-abstracting"],
        ['title' => "Impact Factor", 'link' => "/impact-Factor"],
        ['title' => "Article Processing Charges", 'link' => "/article-processing-charges"]
    ];

    $policies = [
        ['title' => "Ethics & Policies", 'link' => "/ethics"],
        ['title' => "Publication Ethics & Malpractice Statement", 'link' => "/publication-ethics-policy"],
        ['title' => "Peer Review Policy", 'link' => "/peer-review-policy"],
        ['title' => "Plagiarism Policy", 'link' => "/ethics?target=plagiarism-policy"],
        ['title' => "Editorial policies", 'link' => "/ethics?target=editorial-policies"],
        ['title' => "Article withdraw policy", 'link' => "/ethics?target=article-withdrawal"],
        ['title' => "Copyright, Grants and Ownership Declaration", 'link' => "/ethics?target=copyright-ownership"],
        ['title' => "Open Access Policy", 'link' => "/ethics?target=open-access-policy"],
        ['title' => "Cross mark Policy", 'link' => "/cross-mark-policy"],
        ['title' => "Ai policies", 'link' => "/ai-policies"],
        ['title' => "Contact Us", 'link' => "/contact-us"]
    ];
@endphp

<section class="_archiveLayout lg:ml-16 grid grid-cols-3 md:grid-cols-4 2xl:grid-cols-5 justify-between gap-y-5 md:gap-5 px-6 lg:px-0 lg:mr-4 xl:mr-16">
    <h1 class="text-2xl sm:text-3xl 2xl:text-[2.35rem] font-bold mt-4 mb-1 col-span-full text-dark">
        {{ $title }}
    </h1>
    @if($subtitle)
        <p class="-mt-2 mb-3 col-span-full text-sm sm:text-base text-gray-500 font-medium">{!! $subtitle !!}</p>
    @endif

    <div class="lhs {{ $showSidebar ? 'col-span-3 2xl:col-span-4' : 'col-span-3 md:col-span-4 2xl:col-span-5' }} px-0 md:mr-2 text-base text-[#333333] bg-white px-3 md:px-6">
        {{ $slot }}
    </div>

    {{-- Sidebar - Visible on Desktop/Tablet (md+), Stacks or Hides based on React behavior --}}
    @if($showSidebar)
    <div class="rhs space-y-2 hidden md:flex flex-col items-end">
        @if(!$isArticleDetails)
            <x-submit-paper-card />
        @else
            @if($activeArticle)
                <a href="{{ $activeArticle->paper_pdf_url }}" download class="flex justify-between items-center w-full px-5 py-3 text-white font-medium rounded-lg bg-[#FF8C42] hover:bg-[#995428] transition shadow-sm cursor-pointer">
                    Download PDF 
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-download"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v4"/><polyline points="7 10 12 15 17 10"/><line x1="12" x2="12" y1="15" y2="3"/></svg>
                </a>
                <x-plum-metrics-card :doi="$activeArticle->paper_doi" />
            @endif
        @endif

        @if(!$hideLinks)
            <x-listing-section :data="$quickLinks" title="Quick Links" :mode="$sidebarMode" />
            <x-download-card />
            <x-listing-section :data="$policies" title="Policies" :mode="$sidebarMode" />
        @endif
    </div>
    @endif
</section>
