@php
  $editorialData = [
    [
      "title" => "Real-time Tracking",
      "icon" => '<svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-primary"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>',
      "desc" => "Monitor your submission's progress through every stage of the review process.",
      "bullets" => [
        "Article status updates",
        "Review progress tracking",
        "Task completion alerts",
      ],
    ],
    [
      "title" => "Automated Documents",
      "icon" => '<svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-primary"><path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/><path d="M10 9H8"/><path d="M16 13H8"/><path d="M16 17H8"/></svg>',
      "desc" => "Instant generation of all necessary publication documents.",
      "bullets" => [
        "Automated acceptance letters",
        "Simplified copyright forms",
        "Instant publication certificates",
      ],
    ],
    [
      "title" => "Easy Access",
      "icon" => '<svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-primary"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>',
      "desc" => "All your publication materials available in one place.",
      "bullets" => [
        "Published PDF downloads",
        "Certificate access",
        "Reviewer reports",
      ],
    ],
  ];
@endphp

<section class="px-6 lg:px-16 my-8">
  <div class="mb-10">
    <x-title2h2>Advanced Editorial Management</x-title2h2>
    <p class="text-gray-600 mt-2">
      Our state-of-the-art platform provides complete transparency and control throughout the publication process
    </p>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    @foreach($editorialData as $item)
      <div class="bg-white rounded-xl border border-gray-200 shadow-md p-6 flex flex-col text-left hover:bg-[#ff8b421A] transition-all duration-300">
        <div class="mb-4">{!! $item['icon'] !!}</div>
        <h3 class="font-semibold text-lg 2xl:text-lg text-gray-900 mb-2">{{ $item['title'] }}</h3>
        <p class="text-gray-700 text-sm 2xl:text-base mb-3">{{ $item['desc'] }}</p>
        <ul class="list-disc pl-5 text-gray-600 text-sm 2xl:text-base space-y-1">
          @foreach($item['bullets'] as $bullet)
            <li class="leading-snug">
              {{ $bullet }}
            </li>
          @endforeach
        </ul>
      </div>
    @endforeach
  </div>
</section>
