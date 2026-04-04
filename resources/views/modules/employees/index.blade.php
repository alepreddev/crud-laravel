@extends('layouts.app')

@section('content')
<div class="container">
    <div class="header-section">
        <h2><i class="fi fi-rr-users-alt"></i> Gestión de Empleados</h2>
        @can('employees.create')
            <button class="btn-primary" onclick="openModal('modalCreate')">
                <i class="fi fi-rr-plus"></i> Nuevo Empleado
            </button>
        @endcan
    </div>

    <table class="custom-table" id="employeesTable">
        <thead>
            <tr>
                <th>DNI/ID</th>
                <th>Nombre Completo</th>
                <th>Email</th>
                <th>Acceso Sistema</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employees as $employee)
            <tr id="row-{{ $employee->id }}">
                <td>{{ $employee->id_number }}</td>
                <td>{{ $employee->full_name }}</td>
                <td>{{ $employee->email }}</td>
                <td>
                    <span class="badge {{ $employee->user_id ? 'bg-success' : 'bg-secondary' }}">
                        {{ $employee->user_id ? 'Con Usuario' : 'Sin Acceso' }}
                    </span>
                </td>
                <td>
                    @can('employees.edit')
                        <button class="btn-icon edit" onclick="editEmployee({{ $employee->id }})">
                            <i class="fi fi-rr-edit"></i>
                        </button>
                    @endcan
                    
                    @can('employees.delete')
                        <button class="btn-icon delete" onclick="confirmDelete({{ $employee->id }})">
                            <i class="fi fi-rr-trash"></i>
                        </button>
                    @endcan
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div id="modalCreate" class="modal-overlay" style="display:none;">
    <div class="modal-content">
        <h3>Registrar Empleado</h3>
        <form id="employeeForm">
            <div class="form-group">
                <label>DNI/Cédula:</label>
                <input type="text" name="id_number" required>
            </div>
            <div class="form-row">
                <input type="text" name="first_name" placeholder="Nombre" required>
                <input type="text" name="last_name" placeholder="Apellido" required>
            </div>
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" required>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="closeModal('modalCreate')">Cancelar</button>
                <button type="submit" class="btn-save">Guardar</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ asset('js/modules/employees.js') }}"></script>
@endpush