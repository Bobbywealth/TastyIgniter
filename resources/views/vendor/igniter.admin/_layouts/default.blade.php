<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
    {{Template::renderHook('startHead')}}

    {{html(get_metas())}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if ($site_logo !== 'no_photo.png')
        <link href="{{ media_thumb($site_logo, ['width' => 64, 'height' => 64]) }}" rel="shortcut icon"
            type="image/ico">
    @else
        {{html(get_favicon())}}
    @endif
    @empty($pageTitle = Template::getTitle())
        <title>{{$site_name}}</title>
    @else
        <title>{{ $pageTitle }}@lang('igniter::admin.site_title_separator'){{$site_name}}</title>
    @endempty

    {{Template::renderHook('startStyles')}}

    @themeStyles

    {{Template::renderHook('endStyles')}}

    {{Template::renderHook('endHead')}}
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Tailwind -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    <style>
        :root {
            --color-primary: #ff4d4d;
            --color-primary-hover: #e60000;
        }
        body.page {
            background-color: #0a0a0a !important;
            color: #e5e7eb !important;
        }
        .page-wrapper {
            background-color: #0a0a0a !important;
        }
        .sidebar {
            background-color: #161616 !important;
            border-right: 1px solid #262626 !important;
        }
        .navbar {
            background-color: #161616 !important;
            border-bottom: 1px solid #262626 !important;
        }
        .card {
            background-color: #161616 !important;
            border: 1px solid #262626 !important;
            border-radius: 1rem !important;
        }
        .table {
            color: #e5e7eb !important;
        }
        .btn-primary {
            background-color: var(--color-primary) !important;
            border-color: var(--color-primary) !important;
        }
        .btn-primary:hover {
            background-color: var(--color-primary-hover) !important;
            border-color: var(--color-primary-hover) !important;
        }
        .form-control, .form-select {
            background-color: #0a0a0a !important;
            border: 1px solid #262626 !important;
            color: #fff !important;
        }
        .form-control:focus {
            border-color: var(--color-primary) !important;
            box-shadow: 0 0 0 0.25rem rgba(255, 77, 77, 0.25) !important;
        }
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #0a0a0a;
        }
        ::-webkit-scrollbar-thumb {
            background: #262626;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #333;
        }
    </style>
</head>
<body class="page {{ $this->bodyClass }}">
{{Template::renderHook('startBody')}}
@if(AdminAuth::isLogged())
    <x-igniter.admin::header>
        {{html($this->widgets['mainmenu']->render())}}
    </x-igniter.admin::header>
@endif
<div class="container-fluid p-0 h-100 w-100">
    <div class="d-flex page-container h-100">
        @if(AdminAuth::isLogged())
            <div class="sidebar border-right overflow-y-auto">
                <div id="sidebarMenu" class="offcanvas-lg offcanvas-start px-2 py-3">
                    <div class="offcanvas-header">
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        {{Template::renderHook('startSidebar')}}

                        <x-igniter.admin::aside :navItems="AdminMenu::getVisibleNavItems()"/>

                        {{Template::renderHook('endSidebar')}}
                    </div>
                </div>
            </div>
        @endif
        <div class="page-wrapper w-100 pb-5 overflow-y-auto">
            {{Template::renderHook('startHeader')}}

            {{Template::renderHook('endHeader')}}

            <div class="page-content pb-5">
                {{Template::getBlock('body')}}
            </div>
            <div id="notification">
                {{Template::renderHook('startFlash')}}

                {{html($this->makePartial('igniter.admin::flash'))}}

                {{Template::renderHook('endFlash')}}
            </div>
        </div>
    </div>
</div>

{!! Assets::getJsVars() !!}

{{Template::renderHook('startScripts')}}

@themeScripts

{{Template::renderHook('endScripts')}}

{{Template::renderHook('endBody')}}
</body>
</html>
