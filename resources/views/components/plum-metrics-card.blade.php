@props(['doi' => null])

@php
    // Only query PlumX / Dimensions with a real DOI ("10.xxxx/..."). Some records
    // store placeholders such as "." instead, which made both badges break.
    $doiSuffix = preg_match('~10\.\d{4,9}/[^\s"<>]+~', (string) $doi, $m) ? $m[0] : null;
@endphp

<div class="w-full rounded-2xl border border-gray-100 bg-white shadow-sm px-6 py-4 space-y-4">
    <div class="flex items-center justify-between gap-4">
        <h3 class="text-lg font-bold text-gray-800">PlumX Metrics</h3>
        <div class="flex items-center justify-center">
            @if($doiSuffix)
                <a aria-label="link" href="https://plu.mx/plum/a/?doi={{ $doiSuffix }}" data-size="medium" class="plumx-plum-print-popup"></a>
            @else
                <img src="/plummatrix/plum.webp" alt="PlumX" class="w-16 h-16 object-contain" />
            @endif
        </div>
    </div>
    
    <div class="h-[1px] bg-gray-100 w-full"></div>

    <div class="flex items-center justify-between gap-4">
        <h3 class="text-lg font-bold text-gray-800">Dimension</h3>
        <div class="flex items-center justify-center">
            @if($doiSuffix)
                <span class="__dimensions_badge_embed__" data-doi="{{ $doiSuffix }}" data-style="small_circle"></span>
            @else
                <img src="/plummatrix/dynamics.webp" alt="Dimension" class="w-16 h-16 object-contain" />
            @endif
        </div>
    </div>
</div>
