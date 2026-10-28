<button
    x-data="{ isVisible: false }"
    @scroll.window="isVisible = (window.pageYOffset > 200)"
    x-show="isVisible"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 translate-y-10 scale-95"
    x-transition:enter-end="opacity-100 translate-y-0 scale-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 translate-y-0 scale-100"
    x-transition:leave-end="opacity-0 translate-y-10 scale-95"
    @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
    class="fixed left-6 bottom-6 bg-gray-800 hover:bg-gray-700 text-white p-4 sm:p-5 rounded-full shadow-lg transition-all duration-300 z-50 flex items-center justify-center cursor-pointer group"
    aria-label="Scroll to top"
>
    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 animate-bounce group-hover:scale-110 transition-transform"><path d="m18 15-6-6-6 6"/></svg>
</button>
