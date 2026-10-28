@php
    $archiveList = \App\Models\Archive::query()
        ->select(['year', 'volume', 'issue'])
        ->groupBy(['year', 'volume', 'issue'])
        ->orderByDesc('year')
        ->orderByDesc('volume')
        ->orderByDesc('issue')
        ->limit(6)
        ->get();
@endphp

<div class="max-w-md w-full mx-auto bg-white rounded-2xl shadow-[0px_0px_40px_5px_rgba(0,0,0,0.08)] border border-primary/10 p-6">
    <h3 class="text-center text-lg 2xl:text-xl capitalize font-semibold text-black mb-4">
        Archive
    </h3>
    
    @if($archiveList->isEmpty())
        <p class="text-gray-500 text-center py-4">No archives available at the moment.</p>
    @else
        <ul class="list-disc list-inside space-y-2 text-gray-800 text-sm 2xl:text-base">
            @foreach($archiveList as $entry)
                <li class="hover:text-primary transition-colors">
                    <a href="/archives/{{ $entry->year }}/volume-{{ $entry->volume }}/issue-{{ $entry->issue }}" class="hover:underline">
                        {{ $entry->year }} Volume {{ $entry->volume }} Issue {{ $entry->issue }}
                    </a>
                </li>
            @endforeach
        </ul>
    @endif

    @php
        $currentIssueUrl = '/current-issue';
    @endphp

    <div class="mt-6">
        <a href="{{ $currentIssueUrl }}">
            <button class="w-full primaryBtn flex items-center justify-center gap-2">
                View More
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-right"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
            </button>
        </a>
    </div>
</div>
