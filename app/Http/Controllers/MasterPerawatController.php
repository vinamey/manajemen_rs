<?php

namespace App\Http\Controllers;

use App\Models\MasterPerawat;
use Illuminate\Http\Request;

class MasterPerawatController extends Controller
{
    /**
     * Menampilkan semua data perawat.
     */
  public function index()
{
    $perawats = MasterPerawat::latest()->get();

    return view('master-perawat.index', compact('perawats'));
}

    /**
     * Menampilkan form tambah perawat.
     */
    public function create()
    {
        return view('master-perawat.create');
    }
public function store(Request $request)
{
    $request->merge([
        'jenis_kelamin' => strtolower($request->jenis_kelamin),
    ]);

    $request->validate([
        'nama' => 'required|string|max:255',
        'jenis_kelamin' => 'required|in:laki-laki,perempuan',
        'tanggal_lahir' => 'required|date',
        'alamat' => 'required|string',
    ], [
        'nama.required' => 'Nama perawat wajib diisi.',
        'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
        'jenis_kelamin.in' => 'Jenis kelamin harus Laki-laki atau Perempuan.',
        'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
        'tanggal_lahir.date' => 'Format tanggal lahir tidak valid.',
        'alamat.required' => 'Alamat wajib diisi.',
    ]);

    MasterPerawat::create([
        'nama' => $request->nama,
        'jenis_kelamin' => $request->jenis_kelamin,
        'tanggal_lahir' => $request->tanggal_lahir,
        'alamat' => $request->alamat,
    ]);

    return redirect()
        ->route('master-perawat.index')
        ->with('success', 'Data perawat berhasil ditambahkan.');
}
    /**
     * Menampilkan detail perawat.
     */
    public function show(MasterPerawat $master_perawat)
    {
        return view('master-perawat.show', [
            'perawat' => $master_perawat
        ]);
    }

    /**
     * Menampilkan form edit perawat.
     */
    public function edit(MasterPerawat $master_perawat)
    {
        return view('master-perawat.edit', [
            'perawat' => $master_perawat
        ]);
    }

    /**
     * Mengupdate data perawat.
     */
    public function update(Request $request, MasterPerawat $master_perawat)
    {
        // Ubah jenis kelamin menjadi huruf kecil
        $request->merge([
            'jenis_kelamin' => strtolower($request->jenis_kelamin),
        ]);

        // Validasi
        $request->validate([
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
        ], [
            'nama.required' => 'Nama perawat wajib diisi.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'jenis_kelamin.in' => 'Jenis kelamin harus Laki-laki atau Perempuan.',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
            'tanggal_lahir.date' => 'Format tanggal lahir tidak valid.',
            'alamat.required' => 'Alamat wajib diisi.',
        ]);

        // Update data
        $master_perawat->update([
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
        ]);

        // Jika request AJAX, kirim JSON
        if ($request->ajax()) {
            return response()->json([
                'message' => 'Data perawat berhasil diperbarui.',
                'data' => $master_perawat->fresh(),
            ]);
        }

        // Jika bukan AJAX, redirect
        return redirect()
            ->route('master-perawat.index')
            ->with('success', 'Data perawat berhasil diperbarui.');
    }

    /**
     * Menghapus data perawat.
     */
    public function destroy(Request $request, MasterPerawat $master_perawat)
    {
        $master_perawat->delete();

        // Jika request AJAX, kirim JSON
        if ($request->ajax()) {
            return response()->json([
                'message' => 'Data perawat berhasil dihapus.',
                'id' => $master_perawat->id,
            ]);
        }

        // Jika bukan AJAX, redirect
        return redirect()
            ->route('master-perawat.index')
            ->with('success', 'Data perawat berhasil dihapus.');
    }
}
