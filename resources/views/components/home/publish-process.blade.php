@php
  $steps = [
    [
      "title" => "Online Submission",
      "description" => "Submit through our editorial system—one of the most responsive research paper publishing sites—anytime, anywhere.",
      "image" => "/submitPaper.webp",
      "button" => true,
    ],
    [
      "title" => "Initial Review",
      "description" => "Editorial quality check and reviewer assignment within 12 hours.",
      "image" => "/review.webp",
    ],
    [
      "title" => "Peer Review",
      "description" => "Expert evaluation of quality and originality within 2–7 days.",
      "image" => "/acceptance.webp",
    ],
    [
      "title" => "Decision Notification",
      "description" => "Acceptance, revision, or rejection provided within 3–7 days.",
      "image" => "/processing.webp",
    ],
    [
      "title" => "Publication & Certification",
      "description" => "Accepted papers are published immediately open-access, and authors receive digital certificates via our research paper publication website.",
      "image" => "/copyright.webp",
    ]
  ];
@endphp

<section class="my-8">
  <div class="mb-10 md:mb-16">
    <x-title2h2>Streamlined Publication Process</x-title2h2>
    <p class="mt-2 text-sm 2xl:text-base text-paragraph">Our efficient workflow ensures your research gets published quickly without sacrificing quality</p>
  </div>

  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-x-4 gap-y-4">
    @foreach($steps as $step)
      <div class="flex flex-col items-start space-y-4 max-w-96 xl:max-w-full mx-auto">
        <img loading="lazy" src="{{ $step['image'] }}" alt="{{ $step['title'] }}" class="w-full max-w-xs xl:max-w-full object-contain mx-auto" />
        <h4 class="text-lg 2xl:text-lg font-semibold text-gray-900">{{ $step['title'] }}</h4>
        <p class="text-sm 2xl:text-base text-paragraph">{{ $step['description'] }}</p>
        @if(isset($step['button']) && $step['button'])
          <a aria-label="link" href="https://editorial.fdrpjournals.org/login?journal=2" target="_blank" class="block w-full">
            <button class="mt-2 bg-teal-400 border border-teal-400 text-white text-base 2xl:text-lg font-medium px-4 py-2 rounded-lg hover:bg-teal-500 transition-all inline-flex items-center gap-2 animate-bounce cursor-pointer">
              Submit
              <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M12 5l7 7-7 7" />
              </svg>
            </button>
          </a>
        @endif
      </div>
    @endforeach
  </div>
</section>
