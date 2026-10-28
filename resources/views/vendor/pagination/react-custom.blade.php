@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex gap-2 justify-center items-center mt-16">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-lg bg-white border border-gray-200 text-gray-400 cursor-not-allowed">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" /></svg>
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="inline-flex items-center justify-center w-10 h-10 rounded-lg bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 transition duration-300 shadow-sm">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" /></svg>
            </a>
        @endif

        {{-- Pagination Elements --}}
        <div class="flex gap-2">
            @php
                $window = 5;
                $lastPage = $paginator->lastPage();
                $currentPage = $paginator->currentPage();
                
                // Calculate start and end for the sliding window of 5
                $start = max(1, $currentPage - floor($window / 2));
                $end = min($lastPage, $start + $window - 1);
                
                // Re-adjust start if we're near the end
                if ($end - $start + 1 < $window) {
                    $start = max(1, $end - $window + 1);
                }
            @endphp

            @for ($i = $start; $i <= $end; $i++)
                @if ($i == $currentPage)
                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-lg bg-primary text-white font-bold shadow-sm">
                        {{ $i }}
                    </span>
                @else
                    <a href="{{ $paginator->url($i) }}" class="inline-flex items-center justify-center w-10 h-10 rounded-lg bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 transition duration-300 shadow-sm">
                        {{ $i }}
                    </a>
                @endif
            @endfor
        </div>

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="inline-flex items-center justify-center w-10 h-10 rounded-lg bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 transition duration-300 shadow-sm">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" /></svg>
            </a>
        @else
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-lg bg-white border border-gray-200 text-gray-400 cursor-not-allowed">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" /></svg>
            </span>
        @endif
    </nav>
@endif
