@php
  $features = [
    [
      "title" => "Why Choose Us",
      "items" => [
        "High Visibility & Indexing",
        "Strict Plagiarism policy",
        "Open Access Journal",
      ],
    ],
    [
      "title" => "Author Notification",
      "items" => [
        "Status Notification: within 24Hrs",
        "Every Process: Email & SMS",
        "24*7 authors query",
      ],
    ],
    [
      "title" => "Editorial Management",
      "items" => [
        "Unique Account for Author",
        "Review Status (Peer review report)",
        "FAQ's & Knowledgebase for Article process",
      ],
    ],
  ];
@endphp

<section class="mx-6 lg:ml-16 lg:mr-4 xl:mr-16 my-8">
  <div class="bg-dark text-white rounded-2xl shadow-xl border border-gray-800 p-8 sm:p-10 md:p-12 transition-all duration-300 hover:shadow-2xl">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-12 md:divide-x md:divide-gray-800">
      @foreach($features as $idx => $feature)
        <div class="space-y-4 {{ $idx > 0 ? 'md:pl-8 lg:pl-12' : '' }}">
          <h3 class="text-xl sm:text-2xl font-semibold text-white tracking-wide relative pb-2 after:content-[''] after:absolute after:bottom-0 after:left-0 after:w-12 after:h-0.5 after:bg-primary">
            {{ $feature['title'] }}
          </h3>
          <ul class="space-y-3 pt-2 text-gray-300 text-sm sm:text-base">
            @foreach($feature['items'] as $item)
              <li class="flex items-start gap-3">
                <span class="text-primary mt-1.5 shrink-0">
                  <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="currentColor" class="w-3 h-3"><circle cx="12" cy="12" r="10"/></svg>
                </span>
                <span class="leading-relaxed">{{ $item }}</span>
              </li>
            @endforeach
          </ul>
        </div>
      @endforeach
    </div>
  </div>
</section>
