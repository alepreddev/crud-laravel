@extends('layouts.app')

@section('content')
<div class="dashboard-grid">
    <div class="card stat-card">
        <i class="fi fi-rr-users-alt"></i>
        <div>
            <h4>Total Empleados</h4>
            <p>15</p> </div>
    </div>
    
    <div class="card stat-card">
        <i class="fi fi-rr-lock"></i>
        <div>
            <h4>Usuarios Activos</h4>
            <p>5</p>
        </div>
    </div>

    <div class="card stat-card">
        <i class="fi fi-rr-time-past"></i>
        <div>
            <h4>Últimos Movimientos</h4>
            <p>Auditoría activa</p>
        </div>
    </div>
</div>

<div class="welcome-banner">
    <h2>Sistema de Gestión Integral</h2>
    <p>Utiliza el menú lateral para gestionar los módulos del sistema de forma segura.</p>
</div>
@endsection