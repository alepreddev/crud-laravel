<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Audit;

class AuthController extends Controller
{
    public function showLogin() {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Auditoría manual de inicio de sesión
            $this->logEvent('login');

            return response()->json(['success' => true, 'redirect' => '/dashboard']);
        }

        return response()->json(['success' => false, 'message' => 'Credenciales incorrectas.'], 401);
    }

    public function logout(Request $request)
    {
        $this->logEvent('logout');

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    private function logEvent($event)
    {
        Audit::create([
            'user_id' => Auth::id(),
            'event' => $event,
            'url' => request()->fullUrl(),
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
    }
}