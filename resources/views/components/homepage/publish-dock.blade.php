{{-- "Publish with IJSREAT" dock, fixed to the bottom of the screen on every
     redesigned page. It floats between the scroll-to-top and chat buttons so it never
     covers them. Minimising it leaves a small tab that reopens it; the choice is
     remembered for the browser session. All figures come from the Article
     Processing Charges and Journal Particulars pages. --}}
@php
    $submitUrl = 'https://editorial.fdrpjournals.org/login?journal=2';
    $chips = [
        ['link', 'CrossRef DOI'],
        ['hash', 'ISSN 2583-1240'],
        ['lock', 'Open Access'],
        ['users', 'Peer Reviewed'],
        ['search', 'Plagiarism Checked'],
        ['globe', 'Google Scholar'],
    ];
@endphp

<div class="pdock" x-data="{
        min: false,
        init() {
            try { this.min = sessionStorage.getItem('ijsreatDockMin') === '1'; } catch (e) {}
        },
        toggle(v) {
            this.min = v;
            try { sessionStorage.setItem('ijsreatDockMin', v ? '1' : '0'); } catch (e) {}
        }
    }" :class="{ 'is-min': min }">
    <section class="pdock__bar" role="region" aria-label="Publish with IJSREAT" x-show="!min" x-transition.opacity>
        <div class="pdock__price">
            <small>APC from</small>
            <b>₹1200</b>
            <small>+ 18% GST</small>
        </div>

        <div class="pdock__info">
            <p class="pdock__line">
                <span class="pdock__long"><strong>Peer-reviewed open access</strong><i aria-hidden="true">·</i>₹1200 Indian (₹1400 with DOI)<i aria-hidden="true">·</i><strong>$80 USD</strong> international<i aria-hidden="true">·</i>paid after acceptance</span>
                <span class="pdock__mid"><strong>Peer-reviewed open access</strong><i aria-hidden="true">·</i>₹1200 Indian<i aria-hidden="true">·</i>$80 USD international</span>
                <span class="pdock__short"><strong>₹1200</strong> Indian · <strong>$80</strong> intl</span>
            </p>
            <ul class="pdock__chips" aria-label="Journal facts">
                @foreach ($chips as [$icon, $label])
                    <li><x-homepage.icon :name="$icon" /> {{ $label }}</li>
                @endforeach
            </ul>
        </div>

        <nav class="pdock__links" aria-label="Quick links">
            <a href="/article-processing-charges">Charges</a>
            <a href="/current-issue">Current Issue</a>
        </nav>

        <a class="pdock__cta" href="{{ $submitUrl }}" target="_blank" rel="noopener noreferrer">
            <span>Submit Paper</span> <x-homepage.icon name="arrow" />
        </a>

        <button type="button" class="pdock__min" @click="toggle(true)" aria-label="Minimise this bar">
            <x-homepage.icon name="chevron" />
        </button>
    </section>

    <button type="button" class="pdock__tab" x-show="min" x-cloak x-transition.opacity @click="toggle(false)" aria-label="Show publishing details">
        <x-homepage.icon name="send" /> Publish with IJSREAT
    </button>
</div>
