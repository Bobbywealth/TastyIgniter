---
description: Default layout
---
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="{{ App::getLocale() }}" class="h-100 scroll-smooth">
<head>
    @include('igniter-orange::includes.head')
    @livewireStyles
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest" defer></script>
    
    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Tailwind -->
    <link href="{{ asset('css/app.css') }}" rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link href="{{ asset('css/app.css') }}" rel="stylesheet"></noscript>
    
    <style>
        :root {
            --color-primary: #ff4d4d;
            --color-primary-hover: #e60000;
        }
        body {
            background-color: #0a0a0a !important;
            color: #e5e7eb !important;
            font-family: 'Inter', sans-serif !important;
        }
        .header {
            background-color: rgba(22, 22, 22, 0.8) !important;
            backdrop-filter: blur(12px) !important;
            -webkit-backdrop-filter: blur(12px) !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1) !important;
            position: sticky;
            top: 0;
            z-index: 50;
        }
        .footer {
            background-color: #0a0a0a !important;
            border-top: 1px solid #262626 !important;
        }
        .card {
            background-color: #161616 !important;
            border: 1px solid #262626 !important;
            border-radius: 1.5rem !important;
        }
        .btn-primary {
            background-color: var(--color-primary) !important;
            border-color: var(--color-primary) !important;
            border-radius: 0.75rem !important;
            font-weight: 600 !important;
            padding: 0.75rem 1.5rem !important;
        }
        .btn-primary:hover {
            background-color: var(--color-primary-hover) !important;
        }
        .form-control, .form-select {
            background-color: #161616 !important;
            border: 1px solid #262626 !important;
            color: #fff !important;
            border-radius: 0.75rem !important;
        }
        .mesh-gradient {
            background-color: #0a0a0a;
            background-image: 
                radial-gradient(at 0% 0%, hsla(0,100%,70%,0.05) 0, transparent 50%), 
                radial-gradient(at 100% 100%, hsla(0,100%,70%,0.05) 0, transparent 50%);
        }
    </style>
</head>
<body class="d-flex flex-column h-100 mesh-gradient {{ $this->page->bodyClass }}">

<header class="header">
    @include('igniter-orange::includes.header')
</header>

<main role="main">
    <div id="page-wrapper">
        @themePage
    </div>
</main>

@unless($this->page->hideFooter)
<footer class="footer mt-auto py-12">
    @include('igniter-orange::includes.footer')
</footer>
@endunless

<livewire:igniter-orange::utils.modal/>
<livewire:igniter-orange::utils.flash-message/>
@include('igniter-orange::includes.eucookiebanner')
@livewireScripts
@include('igniter-orange::includes.scripts')

<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    });
</script>
</body>
</html>
