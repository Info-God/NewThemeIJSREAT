@props(['allVolumes', 'allIssues' => [], 'currentYear', 'currentVolume', 'currentIssue' => null])

@php
    // Volume Navigation Logic
    $volumeIndex = $allVolumes->search(fn($v) => $v->year == $currentYear && $v->volume == $currentVolume);
    $prevVol = $volumeIndex > 0 ? $allVolumes[$volumeIndex - 1] : null;
    $nextVol = $volumeIndex < $allVolumes->count() - 1 ? $allVolumes[$volumeIndex + 1] : null;

    // Issue Navigation Logic
    $issueIndex = collect($allIssues)->search(fn($i) => $i->issue == $currentIssue);
    $prevIssue = ($issueIndex !== false && $issueIndex > 0) ? $allIssues[$issueIndex - 1] : null;
    $nextIssue = ($issueIndex !== false && $issueIndex < count($allIssues) - 1) ? $allIssues[$issueIndex + 1] : null;

    // Dynamic Route Prefix
    $routePrefix = request()->is('current-issue*') || request()->is('curent-issue*')
        ? (request()->is('curent-issue*') ? 'curent-issue.issue' : 'current-issue.issue')
        : 'archives.issue';
@endphp

<div class="space-y-4">
    {{-- Volume Navigation --}}
    <div class="flex justify-start items-center gap-4 text-base font-medium">
        <div class="flex items-center gap-4 w-full">
            @if($prevVol)
                <a href="{{ route($routePrefix, ['year' => $prevVol->year, 'volume' => $prevVol->volume, 'issue' => 1]) }}" class="text-primary-text text-2xl flex items-center justify-center hover:text-primary transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-left"><path d="m15 18-6-6 6-6"/></svg>
                </a>
            @else
                <button class="text-gray-300 text-2xl flex items-center justify-center cursor-not-allowed" disabled>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-left"><path d="m15 18-6-6 6-6"/></svg>
                </button>
            @endif

            <div class="flex justify-start gap-x-8 gap-y-2 overflow-auto no-scrollbar" style="scrollbar-width: none;">
                @foreach($allVolumes as $vol)
                    @php
                        $isActive = ($vol->year == $currentYear && $vol->volume == $currentVolume);
                    @endphp
                    <a href="{{ route($routePrefix, ['year' => $vol->year, 'volume' => $vol->volume, 'issue' => 1]) }}" 
                       class="cursor-pointer whitespace-nowrap w-fit transition-all duration-300 {{ $isActive ? 'text-primary font-bold text-2xl scale-90' : 'text-gray-600 text-m hover:text-primary' }}">
                        Volume {{ $vol->volume }}, ({{ $vol->year }})
                    </a>
                @endforeach
            </div>

            @if($nextVol)
                <a href="{{ route($routePrefix, ['year' => $nextVol->year, 'volume' => $nextVol->volume, 'issue' => 1]) }}" class="text-primary-text text-2xl flex items-center justify-center hover:text-primary transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right"><path d="m9 18 6-6-6-6"/></svg>
                </a>
            @else
                <button class="text-gray-300 text-2xl flex items-center justify-center cursor-not-allowed" disabled>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right"><path d="m9 18 6-6-6-6"/></svg>
                </button>
            @endif

            <a href="/archives" class="cursor-pointer text-primary font-medium whitespace-nowrap ml-2">See all volumes</a>
        </div>
    </div>

    {{-- Issue Navigation --}}
    @if(count($allIssues) > 0)
        <div class="flex flex-wrap sm:flex-nowrap gap-4 items-center justify-start">
            <div class="w-full sm:max-w-3/4 lg:max-w-5/6 xl:w-fit flex items-center gap-2">
                @if($prevIssue)
                    <a href="{{ route($routePrefix, ['year' => $currentYear, 'volume' => $currentVolume, 'issue' => $prevIssue->issue]) }}" class="text-primary-text text-2xl flex items-center justify-center hover:text-primary transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-left"><path d="m15 18-6-6 6-6"/></svg>
                    </a>
                @else
                    <button class="text-gray-300 text-2xl flex items-center justify-center cursor-not-allowed" disabled>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-left"><path d="m15 18-6-6 6-6"/></svg>
                    </button>
                @endif

                <div class="flex justify-start w-full gap-2 overflow-auto" style="scrollbar-width: thin;">
                    @foreach($allIssues as $iss)
                        @php
                            $isActive = ($iss->issue == $currentIssue);
                        @endphp
                        <a href="{{ route($routePrefix, ['year' => $currentYear, 'volume' => $currentVolume, 'issue' => $iss->issue]) }}" 
                           class="flex whitespace-nowrap justify-between items-center w-fit px-8 py-3 font-medium rounded-lg transition-all duration-300 
                            {{ $isActive 
                                ? 'text-white bg-gradient-to-b from-[#FF8C42] to-[#995428] shadow-sm' 
                                : 'bg-[#FF8C42]/10 text-gray-800 hover:text-white hover:bg-gradient-to-b hover:from-[#FF8C42] hover:to-[#995428]' }}">
                            Issue {{ $iss->issue }}
                        </a>
                    @endforeach
                </div>

                @if($nextIssue)
                    <a href="{{ route($routePrefix, ['year' => $currentYear, 'volume' => $currentVolume, 'issue' => $nextIssue->issue]) }}" class="text-primary-text text-2xl flex items-center justify-center hover:text-primary transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right"><path d="m9 18 6-6-6-6"/></svg>
                    </a>
                @else
                    <button class="text-gray-300 text-2xl flex items-center justify-center cursor-not-allowed" disabled>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right"><path d="m9 18 6-6-6-6"/></svg>
                    </button>
                @endif
            </div>

            <button class="bg-[#FF8C42]/15 text-gray-800 rounded-full px-6 py-3 flex items-center gap-2 text-base font-medium hover:bg-[#FF8C42]/25 transition duration-300 shadow-sm cursor-pointer" onclick="copyCurrentUrl()">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-share-2"><circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/><line x1="8.59" x2="15.42" y1="13.51" y2="17.49"/><line x1="15.41" x2="8.59" y1="6.51" y2="10.49"/></svg>
                Share
            </button>
        </div>
    @endif
</div>

<script>
    function copyCurrentUrl() {
        navigator.clipboard.writeText(window.location.href);
        alert('URL copied to clipboard!');
    }
</script>
