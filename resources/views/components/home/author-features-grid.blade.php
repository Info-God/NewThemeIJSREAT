@php
  $features = [
    [
      "title" => "Instruction for Authors",
      "endpoint" => "/instruction-for-author",
      "logo" => '<svg xmlns="http://www.w3.org/2000/svg" width="52" height="52" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-primary h-13 w-13 pl-3 pt-3"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>'
    ],
    [
      "title" => "Article Processing Charges",
      "endpoint" => "/article-processing-charges",
      "logo" => '<svg xmlns="http://www.w3.org/2000/svg" width="52" height="52" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-primary h-13 w-13 pl-3 pt-3"><rect width="20" height="14" x="2" y="5" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg>'
    ],
    [
      "title" => "Guidance for Editorial Management System",
      "endpoint" => "/guidance-for-ems",
      "logo" => '<svg xmlns="http://www.w3.org/2000/svg" width="52" height="52" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-primary h-13 w-13 pl-3 pt-3"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1-2.5-2.5Z"/><path d="M6 6h10M6 10h10"/></svg>'
    ],
    [
      "title" => "Article Status",
      "endpoint" => "/paper-status",
      "logo" => '<svg xmlns="http://www.w3.org/2000/svg" width="52" height="52" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-primary h-13 w-13 pl-3 pt-3"><circle cx="12" cy="12" r="10"/><path d="m9 12 2 2 4-4"/></svg>'
    ],
    [
      "title" => "Online Article Submission",
      "endpoint" => "https://editorial.fdrpjournals.org/login?journal=2",
      "logo" => '<svg xmlns="http://www.w3.org/2000/svg" width="52" height="52" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-primary h-13 w-13 pl-3 pt-3"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>'
    ],
    [
      "title" => "Archives",
      "endpoint" => "/archives",
      "logo" => '<svg xmlns="http://www.w3.org/2000/svg" width="52" height="52" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-primary h-13 w-13 pl-3 pt-3"><path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/><polyline points="3.27 6.96 12 12.01 20.73 6.96"/><line x1="12" y1="22.08" x2="12" y2="12"/></svg>'
    ]
  ];
@endphp

<div class="mt-8">
  <x-title2h2 class="mb-6">For Authors</x-title2h2>
  <div class="grid grid-cols-2 md:grid-cols-3 gap-5 md:gap-10">
    @foreach($features as $feature)
      <a href="{{ $feature['endpoint'] }}" class="h-full block" @if(str_starts_with($feature['endpoint'], 'http')) target="_blank" @endif>
        <div class="bg-white border border-gray-200 rounded-2xl p-4 shadow-sm hover:shadow-md transition max-w-[300px] xl:max-w-90 2xl:max-w-[600px] justify-around h-full hover:bg-[#ff8b421A]">
          <div class="mb-3 xl:h-1/2">
            {!! $feature['logo'] !!}
          </div>
          <h3 class="font-semibold text-xl 2xl:text-lg text-dark mb-4">{{ $feature['title'] }}</h3>
        </div>
      </a>
    @endforeach
  </div>
</div>
