@php
    $about_menu = [
        ["title" => "Aim & Scope", "link" => "/aim-and-scope"],
        ["title" => "Editorial Board", "link" => "/editorial-board"],
        ["title" => "Indexing & Abstracting", "link" => "/indexing-and-abstracting"],
        ["title" => "Publication Ethics Policy", "link" => "/publication-ethics-policy"],
        ["title" => "Peer Review Policy", "link" => "/peer-review-policy"],
        ["title" => "Ethics & Policy", "link" => "/ethics"],
        ["title" => "Cross Mark Policy", "link" => "/cross-mark-policy"],
        ["title" => "Impact Factor", "link" => "/impact-Factor"],
        ["title" => "Journal Particulars", "link" => "/journal-particulars"],
        ["title" => "FAQ'S", "link" => "/FAQs"]
    ];
    $auther_menu = [
        ["title" => "Journal Publishing Process", "link" => "/journal-publishing-process"],
        ["title" => "Topics", "link" => "/topics"],
        ["title" => "Call for Paper", "link" => "/call-for-papers"],
        ["title" => "Instruction for Authors", "link" => "/instruction-for-author"],
        ["title" => "Editorial Management System", "link" => "/guidance-for-ems"],
        ["title" => "Article Processing Charge", "link" => "/article-processing-charges"],
        ["title" => "Article Status", "link" => "/paper-status"],
        ["title" => "Downloads", "link" => "/downloads"]
    ];
    $conference_menu = [
        ["title" => "Apply for Collaboration", "link" => "/conference-procedings"],
        ["title" => "Published Conferences", "link" => "/conference"]
    ];
    $thesis_menu = [
        ["title" => "Publications", "link" => "/publications"],
        ["title" => "Archives", "link" => "/thesis"]
    ];

    // Current Issue logic dynamically determines the latest issue
    $currentIssueUrl = '/current-issue';


    $isLinkActive = function ($link) {
        $currentPath = strtolower(trim(request()->getPathInfo(), '/'));
        $targetLink = strtolower(trim($link, '/'));
        if ($currentPath === $targetLink) {
            return true;
        }
        if ($targetLink !== '' && str_starts_with($currentPath, $targetLink . '/')) {
            return true;
        }
        return false;
    };

    $isAboutActive = false;
    foreach ($about_menu as $item) {
        if ($isLinkActive($item['link'])) {
            $isAboutActive = true;
            break;
        }
    }

    $isAuthorActive = false;
    foreach ($auther_menu as $item) {
        if ($isLinkActive($item['link'])) {
            $isAuthorActive = true;
            break;
        }
    }

    $isConferenceActive = false;
    foreach ($conference_menu as $item) {
        if ($isLinkActive($item['link'])) {
            $isConferenceActive = true;
            break;
        }
    }

    $isThesisActive = false;
    foreach ($thesis_menu as $item) {
        if ($isLinkActive($item['link'])) {
            $isThesisActive = true;
            break;
        }
    }
@endphp

<div x-data="{ mobileMenuOpen: false, activeDropdown: null }">
    <!-- Desktop Nav -->
    <nav class="hidden lg:flex justify-between items-center py-6 gap-4 mx-auto ml-16 mr-4 xl:mr-16 text-sm xl:text-base 2xl:text-base">
        <!-- Logo -->
        <div class="flex items-center space-x-3">
            <a href="/">
                <img loading="eager" src="/logo.webp" alt="Fifth Dimension Logo" class="h-10 lg:h-12" />
            </a>
        </div>

        <!-- Nav Links -->
        <ul class="flex items-center space-x-2 lg:space-x-4 xl:space-x-6 font-medium">
            <li class="hover:text-primary">
                <a href="/" class="{{ request()->is('/') ? 'text-primary' : '' }}">Home</a>
            </li>

            <!-- About Us Dropdown -->
            <li class="relative group" @mouseenter="activeDropdown = 'about'" @mouseleave="activeDropdown = null">
                <button class="hover:text-primary py-2 {{ $isAboutActive ? 'text-primary' : '' }}">
                    About Us
                </button>
                <div x-show="activeDropdown === 'about'" x-transition class="absolute flex flex-col w-64 bg-white shadow-xl z-50 top-10 left-0 rounded-lg py-2 overflow-hidden">
                    @foreach($about_menu as $item)
                        <a href="{{ $item['link'] }}" class="px-5 py-3 hover:bg-gray-50 hover:text-primary transition-colors text-sm xl:text-base {{ $isLinkActive($item['link']) ? 'text-primary font-semibold' : 'text-gray-800' }}">{{ $item['title'] }}</a>
                    @endforeach
                </div>
            </li>

            <!-- For Authors Dropdown -->
            <li class="relative group" @mouseenter="activeDropdown = 'authors'" @mouseleave="activeDropdown = null">
                <button class="hover:text-primary py-2 {{ $isAuthorActive ? 'text-primary' : '' }}">
                    For Authors
                </button>
                <div x-show="activeDropdown === 'authors'" x-transition class="absolute flex flex-col w-64 bg-white shadow-xl z-50 top-10 left-0 rounded-lg py-2 overflow-hidden">
                    @foreach($auther_menu as $item)
                        <a href="{{ $item['link'] }}" class="px-5 py-3 hover:bg-gray-50 hover:text-primary transition-colors text-sm xl:text-base {{ $isLinkActive($item['link']) ? 'text-primary font-semibold' : 'text-gray-800' }}">{{ $item['title'] }}</a>
                    @endforeach
                </div>
            </li>

            <li class="hover:text-primary">
                <a href="{{ $currentIssueUrl }}" class="{{ request()->is('current-issue*') || request()->is('curent-issue*') ? 'text-primary' : '' }}">Current Issue</a>
            </li>

            <li class="hover:text-primary">
                <a href="/archives" class="{{ request()->is('archives*') ? 'text-primary' : '' }}">Archives</a>
            </li>

            <!-- Conference Dropdown -->
            <li class="relative group" @mouseenter="activeDropdown = 'conference'" @mouseleave="activeDropdown = null">
                <button class="hover:text-primary py-2 {{ $isConferenceActive ? 'text-primary' : '' }}">
                    Conference
                </button>
                <div x-show="activeDropdown === 'conference'" x-transition class="absolute flex flex-col w-64 bg-white shadow-xl z-50 top-10 left-0 rounded-lg py-2 overflow-hidden">
                    @foreach($conference_menu as $item)
                        <a href="{{ $item['link'] }}" class="px-5 py-3 hover:bg-gray-50 hover:text-primary transition-colors text-sm xl:text-base {{ $isLinkActive($item['link']) ? 'text-primary font-semibold' : 'text-gray-800' }}">{{ $item['title'] }}</a>
                    @endforeach
                </div>
            </li>

            <!-- Thesis Dropdown -->
            <li class="relative group" @mouseenter="activeDropdown = 'thesis'" @mouseleave="activeDropdown = null">
                <button class="hover:text-primary py-2 {{ $isThesisActive ? 'text-primary' : '' }}">
                    Thesis
                </button>
                <div x-show="activeDropdown === 'thesis'" x-transition class="absolute flex flex-col w-64 bg-white shadow-xl z-50 top-10 left-0 rounded-lg py-2 overflow-hidden">
                    @foreach($thesis_menu as $item)
                        <a href="{{ $item['link'] }}" class="px-5 py-3 hover:bg-gray-50 hover:text-primary transition-colors text-sm xl:text-base {{ $isLinkActive($item['link']) ? 'text-primary font-semibold' : 'text-gray-800' }}">{{ $item['title'] }}</a>
                    @endforeach
                </div>
            </li>

            <li class="hover:text-primary">
                <a href="/blogs" class="{{ request()->is('blogs*') ? 'text-primary' : '' }}">Blog</a>
            </li>

            <li class="hover:text-primary">
                <a href="/contact-us" class="{{ request()->is('contact-us*') ? 'text-primary' : '' }}">Contact Us</a>
            </li>
        </ul>

        <!-- CTA -->
        <div class="flex space-x-4">
            <a href="https://editorial.fdrpjournals.org/login?journal=2" target="_blank" rel="noopener noreferrer">
                <button class="bg-primary hover:bg-primary-hover text-white px-4 py-3 rounded-md font-medium">
                    Author Login
                </button>
            </a>
        </div>
    </nav>

    <!-- Mobile Nav -->
    <nav class="flex items-center justify-between py-4 px-6 lg:hidden relative">
        <!-- Logo -->
        <div class="flex items-center space-x-2">
            <a href="/">
                <img loading="lazy" src="/logo.webp" alt="Fifth Dimension Logo" class="h-10 w-auto" />
            </a>
        </div>

        <!-- CTA + Hamburger -->
        <div class="flex items-center space-x-4">
            <a href="https://editorial.fdrpjournals.org/login?journal=2" target="_blank" rel="noopener noreferrer">
                <button class="bg-primary hover:bg-primary-hover text-white px-4 py-3 rounded-md font-medium text-sm">
                    Login
                </button>
            </a>
            <button @click="mobileMenuOpen = true" class="p-2 rounded-md hover:bg-gray-100 transition lg:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-menu-alt-right"><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
            </button>
        </div>

        <!-- Mobile Menu Card -->
        <div x-show="mobileMenuOpen" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform translate-x-full"
             x-transition:enter-end="opacity-100 transform translate-x-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 transform translate-x-0"
             x-transition:leave-end="opacity-0 transform translate-x-full"
             class="fixed inset-0 bg-white z-[9999] p-6 overflow-y-auto"
             @click.away="mobileMenuOpen = false">
            
            <!-- Close Button -->
            <div class="flex justify-end">
                <button @click="mobileMenuOpen = false" class="p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </button>
            </div>

            <!-- Navigation Links -->
            <nav class="space-y-6">
                <a href="/" class="block font-medium {{ request()->is('/') ? 'text-primary' : 'text-black' }}" @click="mobileMenuOpen = false">
                    Home
                </a>

                <!-- About Us -->
                <div x-data="{ open: false }">
                    <button @click="open = !open" class="flex justify-between items-center w-full font-semibold {{ $isAboutActive ? 'text-primary' : 'text-black' }}">
                        About Us
                        <svg class="w-4 h-4 transition-transform duration-200" :class="open ? 'rotate-180' : ''" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    <ul x-show="open" class="pl-4 space-y-4 mt-3 text-gray-600 text-sm">
                        @foreach($about_menu as $item)
                            <li><a href="{{ $item['link'] }}" class="block hover:text-primary {{ $isLinkActive($item['link']) ? 'text-primary font-semibold' : '' }}" @click="mobileMenuOpen = false">{{ $item['title'] }}</a></li>
                        @endforeach
                    </ul>
                </div>

                <!-- For Authors -->
                <div x-data="{ open: false }">
                    <button @click="open = !open" class="flex justify-between items-center w-full font-semibold {{ $isAuthorActive ? 'text-primary' : 'text-black' }}">
                        For Authors
                        <svg class="w-4 h-4 transition-transform duration-200" :class="open ? 'rotate-180' : ''" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    <ul x-show="open" class="pl-4 space-y-4 mt-3 text-gray-600 text-sm">
                        @foreach($auther_menu as $item)
                            <li><a href="{{ $item['link'] }}" class="block hover:text-primary {{ $isLinkActive($item['link']) ? 'text-primary font-semibold' : '' }}" @click="mobileMenuOpen = false">{{ $item['title'] }}</a></li>
                        @endforeach
                    </ul>
                </div>

                <a href="{{ $currentIssueUrl }}" class="block font-semibold {{ request()->is('current-issue*') || request()->is('curent-issue*') ? 'text-primary' : 'text-black' }}" @click="mobileMenuOpen = false">
                    Current Issue
                </a>
                <a href="/archives" class="block font-semibold {{ request()->is('archives*') ? 'text-primary' : '' }}" @click="mobileMenuOpen = false">
                    Archives
                </a>

                <!-- Conference -->
                <div x-data="{ open: false }">
                    <button @click="open = !open" class="flex justify-between items-center w-full font-semibold {{ $isConferenceActive ? 'text-primary' : 'text-black' }}">
                        Conference
                        <svg class="w-4 h-4 transition-transform duration-200" :class="open ? 'rotate-180' : ''" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    <ul x-show="open" class="pl-4 space-y-4 mt-3 text-gray-600 text-sm">
                        @foreach($conference_menu as $item)
                            <li><a href="{{ $item['link'] }}" class="block hover:text-primary {{ $isLinkActive($item['link']) ? 'text-primary font-semibold' : '' }}" @click="mobileMenuOpen = false">{{ $item['title'] }}</a></li>
                        @endforeach
                    </ul>
                </div>

                <!-- Thesis -->
                <div x-data="{ open: false }">
                    <button @click="open = !open" class="flex justify-between items-center w-full font-semibold {{ $isThesisActive ? 'text-primary' : 'text-black' }}">
                        Thesis
                        <svg class="w-4 h-4 transition-transform duration-200" :class="open ? 'rotate-180' : ''" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    <ul x-show="open" class="pl-4 space-y-4 mt-3 text-gray-600 text-sm">
                        @foreach($thesis_menu as $item)
                            <li><a href="{{ $item['link'] }}" class="block hover:text-primary {{ $isLinkActive($item['link']) ? 'text-primary font-semibold' : '' }}" @click="mobileMenuOpen = false">{{ $item['title'] }}</a></li>
                        @endforeach
                    </ul>
                </div>

                <a href="/blogs" class="block font-semibold {{ request()->is('blogs*') ? 'text-primary' : '' }}" @click="mobileMenuOpen = false">
                    Blogs
                </a>
                <a href="/contact-us" class="block font-semibold {{ request()->is('contact-us*') ? 'text-primary' : '' }}" @click="mobileMenuOpen = false">
                    Contact Us
                </a>
            </nav>
        </div>
    </nav>
</div>
