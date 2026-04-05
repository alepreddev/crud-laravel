<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        Gate::authorize('users.index');
        
        $users = User::with('role')->get();
        $roles = Role::all();
        // Solo empleados que NO tengan usuario aún, para vincularlos
        $employees = Employee::whereNull('user_id')->get();

        return view('modules.users.index', compact('users', 'roles', 'employees'));
    }

    public function store(Request $request)
    {
        Gate::authorize('users.create');

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'role_id' => 'required|exists:roles,id',
            'employee_id' => 'nullable|exists:employees,id'
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role_id' => $validated['role_id'],
        ]);

        // Si se seleccionó un empleado, creamos el vínculo bidireccional
        if ($request->employee_id) {
            $employee = Employee::find($request->employee_id);
            $employee->update(['user_id' => $user->id]);
        }

        return response()->json(['success' => true, 'message' => 'Usuario creado y vinculado con éxito']);
    }
}