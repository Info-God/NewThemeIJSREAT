@props(['paper'])

@php
    $paperRoute = request()->is('current-issue*') || request()->is('curent-issue*')
        ? (request()->is('curent-issue*') ? 'curent-issue.paper' : 'current-issue.paper')
        : 'archives.paper';
@endphp

<div class="bg-white shadow rounded-xl p-4 space-y-2 border">
    <div class="flex flex-col sm:flex-row justify-between items-start gap-4">
        <a href="{{ route($paperRoute, ['identifier' => getPaperSlug($paper)]) }}" 
           class="text-xl 2xl:text-2xl font-thin font-serif text-primary hover:underline sm:max-w-[85%] relative break-words">
            {{ $paper->paper_title }}
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="inline-block ml-1 min-w-[16px]"><path d="M7 7h10v10"/><path d="M7 17 17 7"/></svg>
        </a>
        <a href="https://www.google.com/search?q={{ urlencode($paper->paper_title) }}" target="_blank" 
           class="hidden sm:inline-flex items-center justify-center gap-2 text-primary border border-primary px-3 py-1 rounded-full text-sm whitespace-nowrap">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4.5"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
            Google
        </a>
    </div>

    <div class="text-primary-text text-sm sm:text-base leading-relaxed sm:leading-8">
        <span class="font-bold">Author : </span>
        <span class="break-words">{{ implode(', ', $paper->authors) }}</span>
        <br />
        <span class="font-bold">Article Type : </span> {{ $paper->paper_articletype }}
        <br />
        <span class="font-bold">Published Online : </span> {{ $paper->paper_month }} {{ $paper->year }}
        <br />
        <span class="font-bold">Pages : </span> {{ $paper->paper_pages }}
    </div>

    {{-- Metrics --}}
    <div class="flex flex-wrap items-center gap-4 sm:gap-6 gap-y-3 text-gray-500 mt-2 text-sm">
        <div class="flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/><circle cx="12" cy="12" r="3"/></svg>
            {{ $paper->views ?? 0 }} <span class="hidden sm:inline">Views</span>
        </div>
        <div class="flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-quote"><path d="M3 21c3 0 7-1 7-8V5c0-1.25-.756-2.017-2-2H4c-1.25 0-2 .75-2 1.972V11c0 1.25.75 2 2 2 1 0 1 0 1 1v1c0 1-1 2-2 2s-1 .008-1 1.031V20c0 1 0 1 1 1z"/><path d="M15 21c3 0 7-1 7-8V5c0-1.25-.757-2.017-2-2h-4c-1.25 0-2 .75-2 1.972V11c0 1.25.75 2 2 2 1 0 1 0 1 1v1c0 1-1 2-2 2s-1 .008-1 1.031V20c0 1 0 1 1 1z"/></svg>
            0 <span class="hidden sm:inline">CrossRef Citations</span><span class="sm:hidden">Citations</span>
        </div>
        <div class="flex items-center gap-2">
            <img src="/plummatrix/plum.webp" alt="plumx" class="w-5 h-5 object-contain" />
            PlumX
        </div>
    </div>

    {{-- Actions --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mt-4 gap-4 sm:gap-2">
        <div class="flex items-center gap-3 text-sm xl:text-base 2xl:text-lg text-primary font-medium">
            <a href="{{ route($paperRoute, ['identifier' => getPaperSlug($paper)]) }}?section=FullArticle" class="hover:underline">Abstract</a>
            <span class="text-primary/30">|</span>
            <a href="{{ route($paperRoute, ['identifier' => getPaperSlug($paper)]) }}?section=FullArticle" class="hover:underline">Full Text</a>
            <span class="text-primary/30">|</span>
            <a href="{{ route($paperRoute, ['identifier' => getPaperSlug($paper)]) }}?section=References" class="hover:underline">References</a>
        </div>
        <a href="{{ $paper->paper_pdf_url }}" download class="w-full sm:w-auto bg-[#FF8C42] hover:bg-[#995428] text-white px-5 py-2 rounded-lg text-sm xl:text-base 2xl:text-lg font-semibold transition flex items-center justify-center gap-2 shadow-sm cursor-pointer">
            Download PDF 
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-download"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v4"/><polyline points="7 10 12 15 17 10"/><line x1="12" x2="12" y1="15" y2="3"/></svg>
        </a>
    </div>
</div>
