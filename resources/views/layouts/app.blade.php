<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Jueli Engineering Ltd')</title>
    @php
        $metaDescription = trim($__env->yieldContent('meta_description')) ?: 'Jueli Engineering Ltd - mechanical engineering, steel fabrication, HVAC, plumbing and industrial supplies in Nairobi, Kenya.';
        $metaImage = trim($__env->yieldContent('meta_image')) ?: asset('img/logo.png');
        $canonical = trim($__env->yieldContent('canonical')) ?: url()->current();
    @endphp
    <meta name="description" content="{{ $metaDescription }}">
    <link rel="canonical" href="{{ $canonical }}">
    <meta property="og:site_name" content="{{ $site->name() }}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ trim($__env->yieldContent('title')) ?: $site->name() }}">
    <meta property="og:description" content="{{ $metaDescription }}">
    <meta property="og:url" content="{{ $canonical }}">
    <meta property="og:image" content="{{ $metaImage }}">
    <meta name="twitter:card" content="summary_large_image">

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/favicon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}">
    <meta name="theme-color" content="#003366">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>

<body>
    @include('partials.nav')

    @yield('content')

    @include('partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>

</html>
