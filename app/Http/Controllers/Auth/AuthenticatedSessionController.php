<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
    
    // ************************************************************
    // * FIX UTAMA: TAMBAH CHECK IS_ACTIVE SELEPAS AUTH BERJAYA *
    // ************************************************************
    $user = Auth::user(); 

    if (!$user->is_active) {
        // Jika user diban (is_active = 0), kita log out dia balik
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        // Bagi error message
        return redirect('/login')->withErrors([
            'email' => 'Akses ditolak. Akaun anda telah dibatalkan (Banned) oleh pihak pengurusan.'
        ]);
    }

        $request->session()->regenerate();

        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
