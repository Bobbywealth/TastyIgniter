{!! get_metas() !!}
<meta name="csrf-token" content="{{ csrf_token() }}">
@if ($favicon = $theme->favicon)
    <link href="{{ media_url($favicon) }}" rel="shortcut icon" type="image/ico">
@elseif ($site_logo !== 'no_photo.png')
    <link href="{{ media_thumb($site_logo, ['width' => 64, 'height' => 64]) }}" rel="shortcut icon" type="image/ico">
@else
    {!! get_favicon() !!}
@endif
<title>{{ lang(get_title()) }} | Sashey's Kitchen</title>
@if ($page->description)
    <meta name="description" content="{{ $page->description }}">
@endif

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet" media="print" onload="this.media='all'">
<noscript><link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet"></noscript>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" media="print" onload="this.media='all'">
<noscript><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"></noscript>
@themeStyles

<style>
    /* Global Overrides for Sashey's Kitchen */
    :root {
        --bs-primary: #ff4d4d;
        --bs-primary-rgb: 255, 77, 77;
    }
    
    .nav-link {
        color: #9ca3af !important;
        font-weight: 500 !important;
        transition: color 0.3s !important;
    }
    
    .nav-link:hover, .nav-link.active {
        color: #fff !important;
    }
    
    .dropdown-menu {
        background-color: #161616 !important;
        border: 1px solid #262626 !important;
        border-radius: 1rem !important;
        box-shadow: 0 10px 30px rgba(0,0,0,0.5) !important;
    }
    
    .dropdown-item {
        color: #9ca3af !important;
        padding: 0.75rem 1.5rem !important;
    }
    
    .dropdown-item:hover {
        background-color: #262626 !important;
        color: #fff !important;
    }
    
    /* Order button in header */
    .header .nav-item:last-child .nav-link {
        background: #ff4d4d;
        color: white !important;
        border-radius: 0.75rem;
        padding: 0.5rem 1.25rem !important;
        margin-left: 1rem;
    }

    /* Fix for TastyIgniter components */
    .local-search .form-control {
        height: 60px !important;
        font-size: 1.1rem !important;
    }
</style>

@if (!empty($theme->custom_css))
    <style>{{$theme->custom_css}}</style>
@endif
