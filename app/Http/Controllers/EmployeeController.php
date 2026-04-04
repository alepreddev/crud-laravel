<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class EmployeeController extends Controller
{
    // Carga la vista principal del módulo
    public function index()
    {
        Gate::authorize('employees.index');
        $employees = Employee::all();
        return view('modules.employees.index', compact('employees'));
    }

    // Retorna un JSON con los datos para el JS
    public function list()
    {
        Gate::authorize('employees.index');
        return response()->json(Employee::with('user')->get());
    }

    public function store(Request $request)
    {
        Gate::authorize('employees.create');

        $validated = $request->validate([
            'id_number'  => 'required|unique:employees,id_number',
            'first_name' => 'required|string|max:100',
            'last_name'  => 'required|string|max:100',
            'email'      => 'required|email|unique:employees,email',
            'hire_date'  => 'required|date',
            'user_id'    => 'nullable|exists:users,id'
        ]);

        $employee = Employee::create($validated);

        // El Trait Auditable registrará esto automáticamente
        return response()->json([
            'success' => true, 
            'message' => 'Empleado creado correctamente',
            'data'    => $employee
        ]);
    }

    public function update(Request $request, Employee $employee)
    {
        Gate::authorize('employees.edit');

        $validated = $request->validate([
            'id_number'  => 'required|unique:employees,id_number,' . $employee->id,
            'first_name' => 'required|string',
            'last_name'  => 'required|string',
            'email'      => 'required|email|unique:employees,email,' . $employee->id,
        ]);

        $employee->update($validated);

        return response()->json(['success' => true, 'message' => 'Actualizado con éxito']);
    }

    public function destroy(Employee $employee)
    {
        Gate::authorize('employees.delete');

        $employee->delete();

        return response()->json(['success' => true, 'message' => 'Eliminado permanentemente']);
    }
}