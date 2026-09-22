<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {

            $request->session()->regenerate();

            if (Auth::user()->hasRole('Super Admin')) {
                return redirect()->route('superadmin.dashboard');
            }

           if (Auth::user()->hasRole('Admin Rumah Sakit')) {
    return redirect()->route('dashboard');
}

            if (Auth::user()->hasRole('Dokter')) {
                return redirect()->route('dokter.dashboard');
            }

            if (Auth::user()->hasRole('Perawat')) {
                return redirect()->route('perawat.dashboard');
            }

            if (Auth::user()->hasRole('Apoteker')) {
                return redirect()->route('apoteker.dashboard');
            }

            if (Auth::user()->hasRole('Kasir')) {
                return redirect()->route('kasir.dashboard');
            }

            if (Auth::user()->hasRole('Direktur')) {
                return redirect()->route('direktur.dashboard');
            }

            return redirect('/');
        }

        return back()->with('error', 'Email atau Password Salah');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
