{{-- Breadcrumb band with the page title (IJCRT inner-page header). --}}
@props(['title', 'crumbs' => [], 'lead' => null])

<section class="pageband">
    <div class="pageband__in">
        <ol class="crumbs" aria-label="Breadcrumb">
            <li><a href="/">Home</a></li>
            @foreach ($crumbs as $label => $href)
                @if ($href)
                    <li><a href="{{ $href }}">{{ $label }}</a></li>
                @else
                    <li><span aria-current="page">{{ $label }}</span></li>
                @endif
            @endforeach
        </ol>
        <h1>{{ $title }}</h1>
        @if ($lead)
            <p class="pageband__lead">{{ $lead }}</p>
        @endif
        @if (trim($slot) !== '')
            <div class="pageband__facts">{{ $slot }}</div>
        @endif
    </div>
</section>
