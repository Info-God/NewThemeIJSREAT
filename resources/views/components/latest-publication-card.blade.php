@php
    $latestPapers = \App\Models\Archive::query()
        ->orderByDesc('paper_id')
        ->limit(3)
        ->get();
@endphp

<div class="max-w-md w-full mx-auto bg-white rounded-2xl shadow-[0px_0px_40px_5px_rgba(0,0,0,0.08)] border border-primary/10 p-6 space-y-6">
    <h2 class="text-center text-lg xl:text-xl capitalize font-semibold text-dark">
        Latest Publication
    </h2>

    @if($latestPapers->isEmpty())
        <div class="text-center text-gray-500 py-4">
            No publications available
        </div>
    @else
        <div class="space-y-4">
            @foreach($latestPapers as $pub)
                <div class="space-y-2">
                    <a aria-label="link" href="{{ $pub->archive_url }}" class="group block">
                        <h3 class="text-sm 2xl:text-base text-gray-800 line-clamp-2 group-hover:text-primary transition-colors leading-relaxed">
                            {{ $pub->paper_title }}
                        </h3>
                        <h4 class="text-sm 2xl:text-base font-semibold text-primary mt-1">
                            Paper ID : {{ $pub->paper_id }}
                        </h4>
                    </a>
                    @if(!$loop->last)
                        <hr class="border-gray-200 mt-2" />
                    @endif
                </div>
            @endforeach
        </div>
    @endif
</div>
