<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AuditController;
use App\Http\Controllers\UserController;

// Rutas públicas
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Rutas protegidas
Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth'])->name('dashboard');

    // Aquí irán los módulos de empleados y usuarios
});

Route::middleware(['auth'])->group(function () {

    // Módulo Empleados - Protegido por permiso de acceso
    // Route::middleware(['can:employees.index'])->group(function () {
    //     Route::get('/empleados', [EmployeeController::class, 'index']);
    //     Route::post('/empleados/store', [EmployeeController::class, 'store'])->middleware('can:employees.create');
    // });

    // Módulo Empleados
    Route::prefix('employees')->group(function () {
        Route::get('/', [EmployeeController::class, 'index'])->name('employees.index');
        Route::get('/list', [EmployeeController::class, 'list']); // Para cargar la tabla vía JS
        Route::post('/store', [EmployeeController::class, 'store']);
        Route::put('/{employee}', [EmployeeController::class, 'update']);
        Route::delete('/{employee}', [EmployeeController::class, 'destroy']);
    });

    Route::get('/users', [UserController::class, 'index']);
    // Modulo de auditoria
    Route::get('/auditoria', [AuditController::class, 'index'])->name('auditoria.index');
    Route::get('/auditoria/{audit}', [AuditController::class, 'show']);
});
