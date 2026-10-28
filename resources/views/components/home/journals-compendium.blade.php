@php
  $journals = [
    ["code" => 'IJRTMR', "title" => 'International Journal of Recent Trends in Multidisciplinary Research', "eIssn" => '2583-0368', "publicationMonths" => 'Bimonthly (Feb, Apr, Jun, Aug, Oct, Dec)', "url" => 'https://www.ijrtmr.com/', "className" => 'bg-purple-50'],
    ["code" => 'INDJEEE', "title" => 'Indian Journal of Electrical and Electronics Engineering', "eIssn" => '3139-8138', "publicationMonths" => '3 Issues Per Year (Apr, Aug, Dec)', "url" => 'https://fdrpjournals.org/indjeee', "className" => 'bg-green-50'],
    ["code" => 'INDJECE', "title" => 'Indian Journal of Electronics and Communication Engineering', "eIssn" => '3048-6408', "publicationMonths" => '3 Issues Per Year (Apr, Aug, Dec)', "url" => 'https://fdrpjournals.org/indjece', "className" => 'bg-amber-50'],
    ["code" => 'IJIRE', "title" => 'International Journal of Innovative Research in Engineering', "eIssn" => '2582-8746', "publicationMonths" => 'Bimonthly (Feb, Apr, Jun, Aug, Oct, Dec)', "url" => 'https://www.theijire.com/', "className" => 'bg-cyan-50'],
    ["code" => 'INDJCST', "title" => 'Indian Journal of Computer Science and Technology', "eIssn" => '2583-5300', "publicationMonths" => 'Bimonthly(Feb, Apr, Jun, Aug, Oct, Dec)', "url" => 'https://www.indjcst.com/', "className" => 'bg-orange-50'],
    ["code" => 'INDJCMR', "title" => 'Indian Journal of Clinical and Medical Research', "eIssn" => 'Applied', "publicationMonths" => 'triannual', "url" => 'https://www.fdrpjournals.org/indjcmr', "className" => 'bg-blue-50'],
    ["code" => 'INDJCPR', "title" => 'Indian Journal of Clinical Pharmacy and Research', "eIssn" => 'Applied', "publicationMonths" => 'triannual', "url" => 'https://www.fdrpjournals.org/indjcpr', "className" => 'bg-pink-50']
  ];
@endphp

<section class="px-6 lg:px-24 bg-white text-center my-8">
  <x-title2h2 class="-mb-2 sm:mb-0">
    Our Compendium of Other Journals
  </x-title2h2>
  <p class="text-secondary-text mb-10 mt-6 text-lg 2xl:text-xl">
    Fifth Dimension Research Publication
  </p>

  <div 
    x-data="{ 
      currentIndex: 0, 
      journals: {{ json_encode($journals) }},
      get visibleCount() {
        if (window.innerWidth < 628) return 1;
        if (window.innerWidth < 768) return 2;
        return 3;
      },
      next() {
        this.currentIndex = (this.currentIndex + 1) % this.journals.length;
      },
      prev() {
        this.currentIndex = (this.currentIndex - 1 + this.journals.length) % this.journals.length;
      },
      getVisibleJournals() {
        let result = [];
        let count = this.visibleCount;
        for (let i = 0; i < count; i++) {
          let idx = (this.currentIndex + i) % this.journals.length;
          result.push(this.journals[idx]);
        }
        return result;
      }
    }"
    x-init="setInterval(() => next(), 5000)"
    class="relative mx-auto"
  >
    <!-- Left Navigation Arrow -->
    <button
      @click="prev()"
      aria-label="move-left"
      class="absolute -left-3.5 sm:-left-5 lg:-left-10 top-1/2 transform -translate-y-1/2 z-10 bg-gray-800 text-white p-2 rounded-full cursor-pointer hover:bg-gray-700 transition"
    >
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5"><polyline points="15 18 9 12 15 6"/></svg>
    </button>

    <!-- Carousel Grid -->
    <div class="grid px-10 lg:px-0 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 justify-center items-stretch transition-all duration-700 ease-in-out">
      <template x-for="(journal, idx) in getVisibleJournals()" :key="journal.code + '-' + idx">
        <div 
          :class="{
            'md:scale-110 transition-all z-20': idx % 2 === 1,
            'md:scale-95 transition-all': idx % 2 !== 1
          }"
          class="flex"
        >
          <div :class="'border text-start border-orange-300 rounded-md p-4 shadow-md flex flex-col justify-between h-full min-w-full max-w-70 mx-auto sm:w-auto ' + journal.className">
            <div class="grid">
              <h3 class="text-2xl font-semibold text-[#111827]" x-text="journal.code"></h3>
              <p class="text-[#374151] mt-2 mb-4 border-b border-gray-300 pb-2 font-medium sm:min-h-18" x-text="journal.title"></p>
              
              <div class="space-y-3 text-[#374151] text-start grid">
                <!-- e-ISSN -->
                <div class="flex items-start gap-2">
                  <span class="mt-1 text-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                  </span>
                  <p>
                    <span class="font-medium">e-ISSN:</span> <span x-text="journal.eIssn"></span>
                  </p>
                </div>
                <!-- Month -->
                <div class="flex items-start gap-2">
                  <span class="mt-1 text-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                  </span>
                  <p>
                    <span class="font-medium">Publication Month:</span> <span x-text="journal.publicationMonths"></span>
                  </p>
                </div>
              </div>
            </div>

            <div class="mt-6">
              <a :href="journal.url" target="_blank" class="block w-full">
                <button class="flex justify-between items-center w-full px-5 py-3 text-white font-medium rounded-md bg-gradient-to-b from-[#FF8C42] to-[#995428] hover:from-[#fae0d0] hover:to-[#fae0d0] hover:text-primary-text transition text-center cursor-pointer">
                  <span class="w-full text-center">Visit Journal</span>
                </button>
              </a>
            </div>
          </div>
        </div>
      </template>
    </div>

    <!-- Right Navigation Arrow -->
    <button
      @click="next()"
      aria-label="move-right"
      class="absolute -right-3.5 sm:-right-5 lg:-right-10 top-1/2 transform -translate-y-1/2 z-10 bg-gray-800 text-white p-2 rounded-full cursor-pointer hover:bg-gray-700 transition"
    >
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5"><polyline points="9 18 15 12 9 6"/></svg>
    </button>
  </div>
</section>
