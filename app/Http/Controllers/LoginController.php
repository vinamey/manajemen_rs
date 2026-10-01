<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Menampilkan halaman login
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Proses login
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($credentials)) {
            return back()
                ->withErrors([
                    'email' => 'Email atau password salah.',
                ])
                ->withInput($request->only('email'));
        }

        $request->session()->regenerate();

        $user = Auth::user();

        // ==========================
        // SUPER ADMIN
        // ==========================
       if ($user->hasRole('super admin')) {
            return redirect()
                ->route('superadmin.dashboard')
                ->with('success', 'Selamat datang Super Admin!');
        }

        // ==========================
        // ADMIN RUMAH SAKIT
        // ==========================
        if ($user->hasRole('Admin Rumah Sakit')) {
    return redirect()
        ->route('superadmin.dashboard')
        ->with('success', 'Selamat datang Admin Rumah Sakit!');
}
        // ==========================
// DOKTER
// ==========================
if ($user->hasRole('dokter')) {
    return redirect()
        ->route('master-dokter.index')
        ->with('success', 'Selamat datang Dokter!');
}

        // ==========================
        // PERAWAT
        // ==========================
        if ($user->hasRole('perawat')) {
    return redirect()
        ->route('master-perawat.index')
        ->with('success', 'Selamat datang Perawat!');
}

        // ==========================
        // APOTEKER
        // ==========================
        if ($user->hasRole('Apoteker')) {
            return redirect()
                ->route('apoteker.dashboard')
                ->with('success', 'Selamat datang Apoteker!');
        }

        // ==========================
        // KASIR
        // ==========================
        if ($user->hasRole('Kasir')) {
            return redirect()
                ->route('kasir.dashboard')
                ->with('success', 'Selamat datang Kasir!');
        }

        // ==========================
        // DIREKTUR
        // ==========================
        if (strtolower($user->getRoleNames()->first() ?? '') === 'direktur') {
         return redirect()
        ->route('dashboard')
        ->with('success', 'Selamat datang Direktur!');
}

        // ==========================
        // ROLE TIDAK DIKENALI
        // ==========================
        Auth::logout();

        return redirect()
            ->route('login')
            ->withErrors([
                'email' => 'Role pengguna tidak dikenali.',
            ]);
    }

    /**
     * Logout
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')
            ->with('success', 'Berhasil logout.');
    }
}
