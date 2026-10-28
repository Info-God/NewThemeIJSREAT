@php
  $partners = DB::table('indexings')->get();
@endphp

@if($partners->isNotEmpty())
<section class="py-12 pt-8 px-6 lg:px-16 bg-white text-center my-8">
  <x-title2h2 class="mb-16">Indexing And Abstracting</x-title2h2>
  <div class="overflow-hidden whitespace-nowrap relative w-full">
    <!-- Marquee Row -->
    <div class="inline-block animate-[marquee_30s_linear_infinite]">
      @foreach($partners as $partner)
        <a href="{{ $partner->indexing_url }}" target="_blank" class="inline-block mx-10">
          <img
            src="{{ (str_starts_with($partner->indexing_image_url, 'http://') || str_starts_with($partner->indexing_image_url, 'https://')) ? $partner->indexing_image_url : 'https://panel.ijsreat.com/storage/' . trim($partner->indexing_image_url, '/') }}"
            alt="{{ $partner->indexing_name }}"
            class="h-16 w-auto object-contain hover:scale-110 transition ease-in-out"
          />
        </a>
      @endforeach
      <!-- Clone for infinite marquee effect -->
      @foreach($partners as $partner)
        <a href="{{ $partner->indexing_url }}" target="_blank" class="inline-block mx-10">
          <img
            src="{{ (str_starts_with($partner->indexing_image_url, 'http://') || str_starts_with($partner->indexing_image_url, 'https://')) ? $partner->indexing_image_url : 'https://panel.ijsreat.com/storage/' . trim($partner->indexing_image_url, '/') }}"
            alt="{{ $partner->indexing_name }}"
            class="h-16 w-auto object-contain hover:scale-110 transition ease-in-out"
          />
        </a>
      @endforeach
    </div>
  </div>
</section>
@endif
