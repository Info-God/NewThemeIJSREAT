<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('meta_title', 'International Journal of Scientific Research in Engineering & Technology (IJSREAT)')</title>
    <meta name="description" content="@yield('meta_description', 'IJSREAT publishes peer-reviewed research in computer science and technology. Browse articles, archives, and submission guidelines.')">

    <link rel="icon" href="{{ asset('vite.svg') }}" type="image/svg+xml">
    <link rel="alternate icon" href="{{ asset('favicon.ico') }}">
    @if(!empty($keywords))
      <meta name="keywords" content="{{ $keywords }}">
    @endif

    @php
        $pageCanonical = trim($__env->yieldContent('canonical'));
        if ($pageCanonical === '') {
            $pageCanonical = url()->current();
        }
    @endphp

    @if(!empty($pageCanonical))
        <link rel="canonical" href="{{ $pageCanonical }}">
    @endif

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script type="text/javascript" src="//cdn.plu.mx/widget-popup.js"></script>
    <script async src="https://badge.dimensions.ai/badge.js" charset="utf-8"></script>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

        <!--Start of Tawk.to Script-->
        <script type="text/javascript">
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/66a8707a1601a2195b9e0f90/1i40vens9';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
        })();
        </script>
        <!--End of Tawk.to Script-->

    @yield('head')
    @stack('page_styles')
    <style>
      @keyframes marquee {
        0% { transform: translateX(0%); }
        100% { transform: translateX(-100%); }
      }
    </style>
</head>
<body class="bg-[#fafafa]">
    <div id="container-main" class="main_body {{ request()->is('/') ? 'bg-gradient-to-b from-[#E9EFFE] to-white to-[13%]' : '' }}">
        @hasSection('site_header')
            @yield('site_header')
        @else
            <x-navbar />
        @endif
        
        <main class="{{ request()->is('/') || $__env->hasSection('site_header') ? '' : 'py-10' }}">
            @yield('content')
        </main>

        @hasSection('site_footer')
            @yield('site_footer')
        @else
            <x-footer />
        @endif
        
        <x-scroll-to-top-btn />
    </div>
    
    <!-- WhatsApp button: opens a WhatsApp chat with the office number directly.
         Sits right above the Tawk.to chat bubble (bottom-right). -->
    <a class="wa-float" href="https://wa.me/919840521421" target="_blank" rel="noopener noreferrer" aria-label="Chat with us on WhatsApp" title="Chat with us on WhatsApp">
        <svg viewBox="0 0 32 32" width="30" height="30" aria-hidden="true" focusable="false"><path fill="#fff" d="M16.04 3C8.86 3 3.03 8.82 3.03 16c0 2.29.6 4.53 1.74 6.5L3 29l6.66-1.74A12.95 12.95 0 0 0 16.04 29C23.2 29 29 23.18 29 16S23.2 3 16.04 3Zm0 23.78c-1.95 0-3.86-.52-5.53-1.51l-.4-.24-3.95 1.03 1.05-3.85-.26-.4A10.74 10.74 0 0 1 5.24 16c0-5.95 4.85-10.79 10.8-10.79 5.94 0 10.77 4.84 10.77 10.79 0 5.95-4.83 10.78-10.77 10.78Zm5.92-8.08c-.32-.16-1.92-.95-2.22-1.06-.3-.11-.51-.16-.73.16-.22.32-.84 1.06-1.03 1.27-.19.22-.38.24-.7.08-.32-.16-1.37-.5-2.6-1.6-.96-.86-1.61-1.92-1.8-2.24-.19-.32-.02-.5.14-.66.15-.14.32-.38.48-.57.16-.19.21-.32.32-.54.11-.22.05-.4-.03-.57-.08-.16-.73-1.75-1-2.4-.26-.63-.53-.54-.73-.55h-.62c-.22 0-.57.08-.86.4-.3.32-1.13 1.1-1.13 2.69 0 1.58 1.16 3.12 1.32 3.33.16.22 2.28 3.48 5.53 4.88.77.33 1.37.53 1.84.68.77.25 1.48.21 2.03.13.62-.09 1.92-.78 2.19-1.54.27-.76.27-1.41.19-1.54-.08-.14-.3-.22-.62-.38Z"/></svg>
    </a>
    <style>
        .wa-float{position:fixed;right:24px;bottom:92px;z-index:1000002;display:grid;place-items:center;width:56px;height:56px;border-radius:50%;background:#25d366;box-shadow:0 8px 22px rgba(0,0,0,.25);transition:transform .2s,box-shadow .2s}
        .wa-float:hover{transform:scale(1.08);box-shadow:0 12px 28px rgba(0,0,0,.3)}
        .wa-float:focus-visible{outline:3px solid #128c7e;outline-offset:3px}
        @media print{.wa-float{display:none}}
    </style>
</body>
</html>
