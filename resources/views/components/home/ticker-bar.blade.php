@php
    $item = DB::table('latest_update')->first();
@endphp

@if($item)
<div class="relative w-full overflow-hidden bg-[#0E4B82] text-white">
  <div class="flex items-center overflow-hidden">
    <!-- Label Section -->
    <div class="relative z-20 bg-primary px-2 sm:px-6 py-4 text-white font-semibold whitespace-nowrap">
      <span class="relative z-10">
        Latest Updates
      </span>
      <!-- Wedge arrow -->
      <div class="absolute -right-2 rotate-45 w-20 h-20 bg-primary z-[9] -top-3.5 2xl:-top-2.5"></div>
      <div class="absolute -right-3 rotate-45 w-20 h-20 bg-white z-[8] -top-3.5 2xl:-top-2.5"></div>
    </div>
     
    <!-- Marquee Text -->
    <div class="relative z-10 overflow-hidden whitespace-nowrap py-2 w-full">
      <div 
        x-data="{ hold: false }"
        @mouseenter="hold = true" 
        @mouseleave="hold = false" 
        class="inline-block min-w-full cursor-pointer animate-[marquee_30s_linear_infinite]"
        :style="{ animationPlayState: hold ? 'paused' : 'running' }"
      >                       
        <a href="{{ $item->input1_link ?? '#' }}" class="px-6 hover:underline font-medium transition-colors hover:text-white/90">{{ $item->input1_data }}</a>
        <a href="{{ $item->input2_link ?? '#' }}" class="px-6 hover:underline font-medium transition-colors hover:text-white/90">{{ $item->input2_data }}</a>
        <a href="{{ $item->input3_link ?? '#' }}" class="px-6 hover:underline font-medium transition-colors hover:text-white/90">{{ $item->input3_data }}</a>
      </div>
    </div>
  </div>
</div>

<style>
  @keyframes marquee {
    0% { transform: translateX(0%); }
    100% { transform: translateX(-100%); }
  }
</style>
@endif
