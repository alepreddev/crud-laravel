<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sistema CRUD - Dashboard</title>
    
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.1.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    
    @stack('styles')
</head>
<body>

    <div class="wrapper">
        <nav class="sidebar">
            <div class="sidebar-header">
                <h3><i class="fi fi-rr-settings"></i> Panel Admin</h3>
            </div>
            <ul class="nav-links">
                <li>
                    <a href="/dashboard" class="{{ Request::is('dashboard') ? 'active' : '' }}">
                        <i class="fi fi-rr-apps"></i> Dashboard
                    </a>
                </li>
                @can('employees.index')
                <li>
                    <a href="/employees" class="{{ Request::is('employees*') ? 'active' : '' }}">
                        <i class="fi fi-rr-users"></i> Empleados
                    </a>
                </li>
                @endcan
                @can('users.index')
                <li>
                    <a href="/users" class="{{ Request::is('users*') ? 'active' : '' }}">
                        <i class="fi fi-rr-shield-check"></i> Usuarios
                    </a>
                </li>
                @endcan
                @can('auditoria.index')
                <li>
                    <a href="/auditoria" class="{{ Request::is('auditoria*') ? 'active' : '' }}">
                        <i class="fi fi-rr-search-alt"></i> Auditoría
                    </a>
                </li>
                @endcan
            </ul>
            <div class="sidebar-footer">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-logout">
                        <i class="fi fi-rr-exit"></i> Cerrar Sesión
                    </button>
                </form>
            </div>
        </nav>

        <main class="main-content">
            <header class="top-bar">
                <span>Bienvenido, <strong>{{ auth()->user()->name }}</strong></span>
            </header>
            <section class="content-area">
                @yield('content')
            </section>
        </main>
    </div>

    <script type="module" src="{{ asset('js/main.js') }}"></script>
    @stack('scripts')
</body>
</html>