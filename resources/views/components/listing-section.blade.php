@props(['data', 'title', 'mode' => 'list'])

@if($mode === 'dropdown')
    <div class="max-w-md w-full mx-auto bg-white rounded-2xl shadow-[0_0_40px_0_rgba(0,0,0,0.1)] border border-primary p-6" x-data="{ open: false }">
        <h2 class="text-lg 2xl:text-xl capitalize font-semibold text-primary-text mb-4">
            {{ $title }}
        </h2>
        <div class="relative">
            <!-- Trigger -->
            <button 
                @click="open = !open"
                @click.away="open = false"
                class="w-full bg-white border border-[#f0f0f0] text-gray-800 py-2 px-4 rounded-md flex justify-between items-center text-sm font-medium hover:border-primary transition-all focus:outline-none"
            >
                <span x-text="'Select ' + '{{ strtolower($title) }}'"></span>
                <svg 
                    class="w-5 h-5 transition-transform duration-200" 
                    :class="open ? 'rotate-180' : ''"
                    xmlns="http://www.w3.org/2000/svg" 
                    viewBox="0 0 20 20" 
                    fill="currentColor"
                >
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>

            <!-- Dropdown Menu -->
            <div 
                x-show="open"
                x-transition:enter="transition ease-out duration-100"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-75"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                class="absolute z-50 top-full left-0 right-0 mt-1 bg-white border border-primary rounded-md shadow-lg max-h-60 overflow-y-auto no-scrollbar"
                style="display: none;"
            >
                <ul class="py-1">
                    @foreach($data as $item)
                        <li>
                            <a 
                                href="{{ $item['link'] }}"
                                class="block w-full text-left px-4 py-2 text-gray-800 hover:bg-gray-50 transition-colors text-sm"
                            >
                                {{ $item['title'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@else
    <div class="max-w-md w-full mx-auto bg-white rounded-2xl shadow-[0_0_40px_0_rgba(0,0,0,0.1)] border border-primary p-6">
        <h2 class="text-lg 2xl:text-xl capitalize font-semibold text-primary-text mb-4">
            {{ $title }}
        </h2>
        <ul class="space-y-3">
            @foreach($data as $item)
                <li>
                    <a 
                        href="{{ $item['link'] }}"
                        class="block w-full border border-[#f0f0f0] text-gray-800 font-medium rounded-md py-2 px-4 hover:bg-[#ff8b421A] transition-colors text-sm"
                    >
                        {{ $item['title'] }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
@endif
