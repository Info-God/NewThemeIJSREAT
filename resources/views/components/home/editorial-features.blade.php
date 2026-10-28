@php
  $features = [
    ['icon' => '/editorial/1.webp', 'title' => 'Exclusive Author Account for Each Journal'],
    ['icon' => '/editorial/2.webp', 'title' => 'Streamlined Article Status Updates'],
    ['icon' => '/editorial/3.webp', 'title' => 'Efficient Review Status and Peer Review Reports'],
    ['icon' => '/editorial/4.webp', 'title' => 'Comprehensive FAQs and Knowledgebase'],
    ['icon' => '/editorial/5.webp', 'title' => 'Task Status Monitoring'],
    ['icon' => '/editorial/6.webp', 'title' => 'Automated Acceptance Letters'],
    ['icon' => '/editorial/7.webp', 'title' => 'Simplified Copyright Forms'],
    ['icon' => '/editorial/8.webp', 'title' => 'Convenient Certificate and Published Article Downloads']
  ];
@endphp

<section class="mx-6 lg:ml-16 lg:mr-4 xl:mr-16 my-10">
  <div class="bg-gradient-to-br from-gray-50 to-[#fafafa] rounded-2xl border border-gray-200/60 p-8 sm:p-10 md:p-12 shadow-sm">
    <div class="text-left mb-8 md:mb-12">
      <x-title2h2 class="mb-2">
        Enhanced Features of an Editorial Management System
      </x-title2h2>
      <p class="text-primary font-semibold text-base sm:text-lg leading-relaxed">
        (Online Submission & Peer Review Management)
      </p>
      <p class="text-paragraph text-sm sm:text-base leading-relaxed mt-2 max-w-3xl">
        Experience a fully automated, transparent, and user-friendly editorial pipeline designed for modern research workflows.
      </p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
      @foreach($features as $idx => $feature)
        <div class="bg-white p-6 rounded-xl border border-gray-200/80 shadow-sm flex flex-col items-start gap-4 transition-all duration-300 hover:-translate-y-1 hover:shadow-md cursor-pointer group">
          <div class="p-3 bg-gray-50 rounded-lg group-hover:bg-primary/10 transition-colors duration-300">
            <img 
              loading="lazy" 
              src="{{ $feature['icon'] }}" 
              width="50" 
              height="50" 
              alt="editorial-icon-{{ $idx + 1 }}" 
              class="w-12 h-12 object-contain group-hover:scale-105 duration-300 transition-transform" 
            />
          </div>
          <p class="font-semibold text-primary-text text-sm sm:text-base leading-relaxed group-hover:text-primary transition-colors duration-200">
            {{ $feature['title'] }}
          </p>
        </div>
      @endforeach
    </div>
  </div>
</section>
