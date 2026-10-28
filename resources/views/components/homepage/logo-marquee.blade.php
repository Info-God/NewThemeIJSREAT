{{-- Indexing partner logos in two rows that scroll in opposite directions.
     Each row is rendered twice so the loop is seamless; the copy is hidden
     from assistive technology and keyboard focus. Hover or focus pauses it,
     and reduced-motion users get a static, wrapped grid instead. --}}
@props(['partners'])

@php
    $logo = fn ($u) => (str_starts_with((string) $u, 'http://') || str_starts_with((string) $u, 'https://'))
        ? $u
        : 'https://panel.ijsreat.com/storage/' . trim((string) $u, '/');
    $list = collect($partners)->values();
    $rows = $list->count() > 8
        ? [$list->filter(fn ($p, $i) => $i % 2 === 0)->values(), $list->filter(fn ($p, $i) => $i % 2 === 1)->values()]
        : [$list];
@endphp

@if ($list->isNotEmpty())
    <div {{ $attributes->merge(['class' => 'lmq']) }} aria-label="Indexing and abstracting partners">
        @foreach ($rows as $r => $row)
            @php $secs = max(28, $row->count() * 3.2); @endphp
            <div @class(['lmq__row', 'lmq__row--rev' => $r === 1]) style="--lmq-time: {{ $secs }}s">
                <div class="lmq__track">
                    @foreach ([false, true] as $copy)
                        <ul class="lmq__set" @if ($copy) aria-hidden="true" @endif>
                            @foreach ($row as $partner)
                                <li>
                                    <a class="lmq__item" href="{{ $partner->indexing_url }}" target="_blank" rel="noopener"
                                       title="{{ $partner->indexing_name }}" @if ($copy) tabindex="-1" @endif>
                                        <img src="{{ $logo($partner->indexing_image_url) }}" alt="{{ $copy ? '' : $partner->indexing_name }}" loading="{{ $copy ? 'lazy' : 'eager' }}" decoding="async">
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
@endif
