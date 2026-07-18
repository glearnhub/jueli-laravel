<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Jueli Engineering Ltd</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo_2.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(rgba(0, 51, 102, 0.85), rgba(0, 51, 102, 0.85)), url('{{ asset('img/bg_2.jpg') }}');
            background-position: center;
            background-size: cover;
        }

        .login-card {
            width: 400px;
            max-width: 90vw;
            background: #fff;
            border-radius: 8px;
            padding: 40px 30px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
        }

        .login-card h1 {
            font-size: 1.5rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 1.5rem;
            color: #003366;
        }

        .btn-primary {
            background-color: #003366;
            border-color: #003366;
        }

        .btn-primary:hover {
            background-color: #002244;
            border-color: #002244;
        }
    </style>
</head>

<body>
    <div class="login-card">
        <h1>JUELI ENGINEERING LTD</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login.store') }}">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required autofocus>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-check mb-3">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label" for="remember">Remember me</label>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
    </div>
</body>

</html>
