<?php

namespace App\Http\Controllers;

use App\Models\Audit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AuditController extends Controller
{
    public function index()
    {
        // Seguridad: Solo perfiles autorizados
        Gate::authorize('auditoria.index');

        // Obtenemos los registros ordenados por el más reciente
        // Cargamos la relación 'user' para saber quién hizo la acción
        $audits = Audit::with('user')->orderBy('created_at', 'desc')->paginate(20);

        return view('modules.audit.index', compact('audits'));
    }

    // Método opcional para ver detalles específicos de un cambio (vía JSON)
    public function show(Audit $audit)
    {
        Gate::authorize('auditoria.index');
        return response()->json($audit);
    }
}