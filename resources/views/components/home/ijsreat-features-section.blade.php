@php
  $features = [
    "Peer-reviewed, Refereed Journal",
    "Rapid and transparent research paper submission sites",
    "High indexing and reputation among best journal to publish research paper",
    "COPE-compliant publication ethics",
    "Publisher license under Creative Commons",
    "Strict plagiarism checks and high visibility"
  ];
@endphp

<section class="bg-white pt-4 px-4 -ml-2 md:-ml-4 lg:-ml-6 my-8">
  <!-- Features + Illustration -->
  <div class="grid md:grid-cols-2 items-start gap-10">
    <!-- Features List -->
    <div>
      <x-title2h2 class="mb-4">IJSREAT Features</x-title2h2>
      <ul class="space-y-4">
        @foreach($features as $item)
          <li class="flex items-start gap-3 text-gray-700 text-base 2xl:text-base">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-primary w-5 h-5 mt-1 shrink-0"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
            <span>{{ $item }}</span>
          </li>
        @endforeach
      </ul>
    </div>

    <!-- Illustration -->
    <div class="flex justify-center">
      <img src="/feature/features2.webp" alt="Team Illustration" class="w-full max-w-md xl:max-w-xl object-contain" />
    </div>
  </div>
</section>
