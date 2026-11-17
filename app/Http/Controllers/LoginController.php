<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\MasterDokter;

class LoginController extends Controller
{
    // Menampilkan halaman login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Proses login berdasarkan role pengguna
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

        // Hapus pilihan dokter dari sesi login sebelumnya
        $request->session()->forget('dokter_aktif_id');

        $user = Auth::user();

        // SUPER ADMIN
        if ($user->hasRole('super admin')) {
            return redirect()
                ->route('superadmin.dashboard')
                ->with('success', 'Selamat datang Super Admin!');
        }

        // ADMIN RUMAH SAKIT
        if ($user->hasAnyRole([
            'admin rumah sakit',
            'Admin Rumah Sakit',
        ])) {
            return redirect()
                ->route('admin.dashboard')
                ->with('success', 'Selamat datang Admin Rumah Sakit!');
        }

        // DOKTER
        if ($user->hasRole('dokter')) {
            return redirect()
                ->route('dokter.pilih')
                ->with('success', 'Silakan pilih nama dokter.');
        }

        // PERAWAT
        if ($user->hasRole('perawat')) {
            return redirect()
                ->route('perawat.dashboard')
                ->with('success', 'Selamat datang Perawat!');
        }

        // APOTEKER
        if ($user->hasAnyRole(['apoteker', 'Apoteker'])) {
            return redirect()
                ->route('apoteker.dashboard')
                ->with('success', 'Selamat datang Apoteker!');
        }

        // KASIR
        if ($user->hasRole('kasir')) {
            return redirect()
                ->route('kasir.dashboard')
                ->with('success', 'Selamat datang Kasir!');
        }

        // DIREKTUR
        if (
            strtolower($user->getRoleNames()->first() ?? '')
            === 'direktur'
        ) {
            return redirect()
                ->route('dashboard')
                ->with('success', 'Selamat datang Direktur!');
        }

        // ROLE TIDAK DIKENALI
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->withErrors([
                'email' => 'Role pengguna tidak dikenali.',
            ]);
    }

    // Menampilkan halaman pilihan dokter
    public function pilihDokter()
    {
        $dokters = MasterDokter::orderBy('nama')->get();

        return view('dokter.pilih-dokter', compact('dokters'));
    }

    // Menyimpan dokter yang dipilih ke session
    public function simpanDokter(Request $request)
    {
        $request->validate([
            'dokter_id' => 'required|exists:master_dokters,id',
        ]);

        $dokter = MasterDokter::findOrFail($request->dokter_id);

        session([
            'dokter_aktif_id' => $dokter->id,
        ]);

        return redirect()
            ->route('dokter.dashboard')
            ->with('success', 'Selamat datang, ' . $dokter->nama . '!');
    }

    // Logout pengguna
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('landing')
            ->with('success', 'Berhasil logout.');
    }
}
