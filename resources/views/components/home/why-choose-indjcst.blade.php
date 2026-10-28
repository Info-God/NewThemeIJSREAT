@php
  $reasons = [
    "Strict Plagiarism Policy",
    "Good Impact Factor",
    "Peer Reviewed Journal",
    "Open Access Journal",
    "Reputed Editorial Board",
    "Rapid/Fast Track Publication",
    "Fully Archived Journal",
    "High Visibility & Indexing",
    "High Impact Factor Journal",
    "Response Will Be Given Within 12 Hours.",
  ];
@endphp

<section class="mx-6 lg:ml-16 lg:mr-4 xl:mr-16 my-10">
  <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8 sm:p-10 md:p-12 hover:shadow-md transition-all duration-300">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-10 lg:gap-16 items-center">
      <!-- Illustration -->
      <div class="flex justify-center items-center">
        <img
          loading="lazy"
          src="/feature/features3.webp"
          alt="Why choose IJSREAT"
          class="w-full max-w-sm sm:max-w-md object-contain hover:scale-[1.02] duration-300 transition-transform"
        />
      </div>

      <!-- Textual content -->
      <div class="space-y-6">
        <div>
          <x-title2h2 class="mb-2">Why choose the IJSREAT journal?</x-title2h2>
          <p class="text-paragraph text-sm sm:text-base leading-relaxed">
            Publishing with us guarantees rapid dissemination, scholarly rigor, and maximum impact for your computational research.
          </p>
        </div>

        <ul class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
          @foreach($reasons as $reason)
            <li class="flex items-start gap-3 text-gray-700 text-sm sm:text-base hover:text-primary transition-colors duration-200">
              <span class="text-primary mt-1 shrink-0">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                  <polyline points="22 4 12 14.01 9 11.01" />
                </svg>
              </span>
              <span class="leading-relaxed font-medium">{{ $reason }}</span>
            </li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>
</section>
