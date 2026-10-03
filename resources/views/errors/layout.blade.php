<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('code') - Jueli Engineering Ltd</title>
    <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}">
    {{-- Self-contained on purpose: error pages must still render when the database or Vite build is the thing that failed. --}}
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            font-family: 'Poppins', system-ui, -apple-system, 'Segoe UI', Roboto, sans-serif;
            background: #f4f6fa;
            color: #1f2937;
            text-align: center;
        }
        .error-card {
            max-width: 480px;
            width: 100%;
            background: #fff;
            border-radius: 12px;
            padding: 40px 28px;
            box-shadow: 0 8px 30px rgba(16, 42, 84, 0.1);
        }
        .error-card img { max-width: 160px; height: auto; margin-bottom: 20px; }
        .error-code { font-size: 4rem; font-weight: 700; color: #102A54; line-height: 1; margin: 0 0 8px; }
        h1 { font-size: 1.25rem; margin: 0 0 10px; color: #102A54; }
        p { margin: 0 0 24px; color: #6b7280; line-height: 1.5; }
        a.btn {
            display: inline-block;
            padding: 10px 22px;
            border-radius: 6px;
            background: #102A54;
            color: #fff;
            text-decoration: none;
            font-weight: 500;
        }
        a.btn:hover { background: #0b1d3b; }
    </style>
</head>

<body>
    <main class="error-card">
        <img src="{{ asset('img/logo.png') }}" alt="Jueli Engineering Ltd">
        <p class="error-code">@yield('code')</p>
        <h1>@yield('title')</h1>
        <p>@yield('message')</p>
        <a class="btn" href="{{ url('/') }}">Back to home</a>
    </main>
</body>

</html>
