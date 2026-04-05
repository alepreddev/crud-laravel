@extends('layouts.app')

@section('content')
<div class="container">
    <div class="header-section">
        <h2><i class="fi fi-rr-shield-check"></i> Gestión de Usuarios</h2>
        <button class="btn-primary" onclick="openModal('modalUser')">
            <i class="fi fi-rr-user-add"></i> Nuevo Usuario
        </button>
    </div>

    <table class="custom-table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Rol</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td><span class="badge-role">{{ $user->role->name }}</span></td>
                <td>{{ $user->is_active ? 'Activo' : 'Inactivo' }}</td>
                <td>
                    <button class="btn-icon edit"><i class="fi fi-rr-pencil"></i></button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div id="modalUser" class="modal-overlay" style="display:none;">
    <div class="modal-content">
        <h3>Datos de Acceso</h3>
        <form id="userForm">
            <input type="text" name="name" placeholder="Nombre completo" required>
            <input type="email" name="email" placeholder="Correo electrónico" required>
            <input type="password" name="password" placeholder="Contraseña temporal" required>
            
            <label>Asignar Rol:</label>
            <select name="role_id" required>
                @foreach($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </select>

            <label>Vincular a Empleado (Opcional):</label>
            <select name="employee_id">
                <option value="">Ninguno</option>
                @foreach($employees as $emp)
                    <option value="{{ $emp->id }}">{{ $emp->full_name }}</option>
                @endforeach
            </select>

            <div class="modal-footer">
                <button type="button" onclick="closeModal('modalUser')">Cerrar</button>
                <button type="submit" class="btn-save">Crear Acceso</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
    <script type="module" src="{{ asset('js/modules/users.js') }}"></script>
@endpush