<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, $permission)
    {
        if (!auth()->user() || !auth()->user()->can($permission)) {
            if ($request->ajax()) {
                return response()->json(['error' => 'No tienes permisos para esta acción.'], 403);
            }
            abort(403, 'Acceso no autorizado.');
        }

        return $next($request);
    }
}
