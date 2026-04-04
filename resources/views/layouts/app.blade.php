<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sistema CRUD</title>
    
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.1.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>

    @stack('styles')
</head>
<body>
    @yield('content')

    <script src="{{ asset('js/main.js') }}"></script>

    @stack('scripts')
</body>
</html>