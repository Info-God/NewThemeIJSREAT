@php
  $faqData = [
    [
      "question" => "When it was started? | when first issue of the journal was published?",
      "answer" => "It was started in year 2021. IJSREAT is being published by 5th Dimension Research Publication. First Issue: January-February 2021.",
    ],
    [
      "question" => "What is the plagiarism policy",
      "answer" => "We do not accept papers that are having plagiarized contents. Good quality plagiarism software/tool will be used to check similarity that would not be more than 30% including reference section. In the case of exclusion of references, it should be less than 5%.",
    ],
    [
      "question" => "How to submit my Article?",
      "answer" => "By Editorial Management System (EMS) Online submission System. For more details see Guidance for Editorial management System.",
    ],
    [
      "question" => "My paper has been published. Can make any changes now in the paper?",
      "answer" => "Author(s) can make rectification in the final paper but after the final submission to the journal, rectification is not possible.",
    ],
    [
      "question" => "What are the Terms & Conditions of the journal?",
      "answer" => "Please visit journal website. It is available in the “Ethics & Policy” page.",
    ],
  ];
@endphp

<section class="max-w-6xl 2xl:max-w-[80%] mx-auto px-4 py-12 bg-white my-8" x-data="{ active: null }">
  <x-title2h2 class="text-center">
    Frequently Asked Questions
  </x-title2h2>
  
  <div class="mt-8 space-y-4">
    @foreach($faqData as $idx => $item)
      <div 
        class="py-4 px-5 cursor-pointer border rounded-xl text-base sm:text-lg transition-all duration-300 bg-[#f9f9f9]/30 hover:bg-[#ff8b420A]/10"
        :class="active === {{ $idx }} ? 'border-primary bg-secondary-bg/20 shadow-sm' : 'border-gray-200'"
        @click="active = (active === {{ $idx }} ? null : {{ $idx }})"
      >
        <div class="flex justify-between items-center">
          <h2 class="text-primary-text font-semibold w-[90%] text-base sm:text-lg 2xl:text-xl transition-colors duration-200" :class="active === {{ $idx }} ? 'text-primary' : 'text-primary-text'">
            {{ $item['question'] }}
          </h2>
          <!-- Icon toggled based on state with rotation animation -->
          <svg 
            xmlns="http://www.w3.org/2000/svg" 
            width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" 
            class="w-5 h-5 text-gray-500 transition-transform duration-300 shrink-0"
            :class="active === {{ $idx }} ? 'rotate-180 text-primary' : ''"
          >
            <polyline points="6 9 12 15 18 9"/>
          </svg>
        </div>
        <div 
          x-show="active === {{ $idx }}" 
          x-collapse
          class="mt-3 text-paragraph text-sm sm:text-base leading-relaxed pl-1"
        >
          {{ $item['answer'] }}
        </div>
      </div>
    @endforeach
  </div>
</section>
