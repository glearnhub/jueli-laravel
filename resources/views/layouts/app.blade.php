<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Jueli Engineering Ltd')</title>

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/logo_2.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/logo_2.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/logo_2.png') }}">
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
