@php
  $features = [
    [
      "title" => "Research Paper Submission Sites",
      "img" => "/review.webp",
      "points" => [
        "Strict peer review standards",
        "Multi-disciplinary expert reviewers",
        "Constructive feedback",
      ],
      "desc" => "Easy, fast, and transparent online paper submission through our advanced editorial management system.",
    ],
    [
      "title" => "Journal Publication Sites with Impact:",
      "img" => "/publication.webp",
      "points" => [
        "Initial response within 12 hours",
        "Review completed in 2–7 days",
        "Final decision within 3–7 days",
      ],
      "desc" => "Manuscripts are rigorously peer-reviewed and indexed in major directories like DOAJ, boosting visibility and credibility.",
    ],
    [
      "title" => "Best Journal to Publish Research Paper",
      "img" => "/global.webp",
      "points" => [
        "Open Access policy",
        "Broad international readership",
        "Policy-maker engagement",
      ],
      "desc" => "Recognized for strict plagiarism policies, a reputed editorial board, and rapid or fast-track publication.",
    ],
    [
      "title" => "Research Paper Publishing Sites India",
      "img" => "/process.webp",
      "desc" => "Join authors from across India and the world in sharing impactful research through IJSREAT’s streamlined processes.",
    ]
  ];
@endphp

<section class="py-8">
  <div>
    <div class="text-left mb-8 sm:mb-12">
      <x-title2h2 class="mb-2">Why Choose IJSREAT Among Best Research Paper Publishing Sites India</x-title2h2>
      <p class="text-gray-500 text-sm sm:text-base leading-relaxed mt-4">
        We combine academic excellence with efficient processes to maximize your research impact beyond academia
      </p>
    </div>

    <!-- Desktop Features Grid -->
    <div class="hidden sm:grid grid-cols-1 md:grid-cols-2 gap-6">
      @foreach($features as $item)
        <div class="flex md:flex-col lg:flex-row gap-4 bg-white rounded-xl border border-gray-200 p-5 shadow-sm">
          <div class="w-28 md:w-auto lg:w-28 min-w-28 relative">
            <img src="{{ $item['img'] }}" alt="{{ $item['title'] }}" class="object-center" />
          </div>
          <div class="flex flex-col justify-start">
            <h3 class="text-lg 2xl:text-lg font-semibold text-black">{{ $item['title'] }}</h3>
            <p class="text-sm 2xl:text-base text-gray-700 mb-2">{{ $item['desc'] }}</p>
            @if(isset($item['points']))
              <ul class="list-disc pl-5 text-sm 2xl:text-base text-gray-600">
                @foreach($item['points'] as $pt)
                  <li>{{ $pt }}</li>
                @endforeach
              </ul>
            @endif
          </div>
        </div>
      @endforeach
    </div>

    <!-- Mobile Features List -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 sm:hidden">
      @foreach($features as $item)
        <div class="flex flex-col bg-white rounded-xl border border-gray-200 p-5 shadow-sm">
          <div class="flex gap-4">
            <div class="w-28 min-w-28 relative">
              <img src="{{ $item['img'] }}" alt="{{ $item['title'] }}" class="object-center" />
            </div>
            <div class="flex flex-col justify-start">
              <h3 class="text-lg font-semibold text-black">{{ $item['title'] }}</h3>
              <p class="text-sm xl:text-base 2xl:text-lg text-gray-700 mb-2">{{ $item['desc'] }}</p>
            </div>
          </div>
          @if(isset($item['points']))
            <ul class="list-disc pl-5 text-sm 2xl:text-base text-gray-600 mt-2">
              @foreach($item['points'] as $pt)
                <li>{{ $pt }}</li>
              @endforeach
            </ul>
          @endif
        </div>
      @endforeach
    </div>
  </div>
</section>
