<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/modules/login.css') }}">
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.1.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>

</head>

<body>
    <div class="login-container">
        <div class="login-card">
            <h2>
                {{-- <i class="fi fi-rr-lock"></i> --}}
                Sistema de empleados
            </h2>
            <form id="loginForm">
                <input type="email" name="email" placeholder="Usuario (Email)" required>
                <input type="password" name="password" placeholder="Contraseña" required>
                <button type="submit" class="btn-login">Entrar</button>
            </form>
        </div>
    </div>

    {{-- @push('scripts') --}}
    <script type="module" src="{{ asset('js/modules/login.js') }}"></script>
    {{-- @endpush --}}

</body>

</html>