<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\MasterDokter;
use App\Models\MasterPerawat;

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

        // Hapus session dokter sebelumnya
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

            // Cari data dokter berdasarkan akun yang sedang login
            $dokter = MasterDokter::where('users_id', $user->id)
                ->first();

            // Jika akun belum terhubung dengan data dokter
            if (!$dokter) {
                Auth::logout();

                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect()
                    ->route('login')
                    ->withErrors([
                        'email' => 'Akun dokter belum terhubung dengan data Master Dokter. Hubungi Admin Rumah Sakit.',
                    ]);
            }

            // Simpan ID dokter secara otomatis ke session
            $request->session()->put('dokter_aktif_id', $dokter->id);

            return redirect()
                ->route('dokter.dashboard')
                ->with('success', 'Selamat datang, ' . $dokter->nama . '!');
        }

        // PERAWAT
        if ($user->hasRole('perawat')) {

            // Cari data perawat berdasarkan akun yang sedang login
            $perawat = MasterPerawat::where('users_id', $user->id)
                ->first();

            // Jika akun belum terhubung dengan data perawat
            if (!$perawat) {
                Auth::logout();

                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect()
                    ->route('login')
                    ->withErrors([
                        'email' => 'Akun perawat belum terhubung dengan data Master Perawat. Hubungi Admin Rumah Sakit.',
                    ]);
            }

            // Simpan ID perawat ke session
            $request->session()->put('perawat_aktif_id', $perawat->id);

            return redirect()
                ->route('perawat.dashboard')
                ->with('success', 'Selamat datang, ' . $perawat->nama . '!');
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
        if (strtolower($user->getRoleNames()->first() ?? '') === 'direktur') {
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
