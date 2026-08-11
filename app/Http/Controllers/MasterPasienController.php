<?php

namespace App\Http\Controllers;

use App\Models\MasterPasien;
use Illuminate\Http\Request;

class MasterPasienController extends Controller
{
    public function index()
    {
        $pasiens = MasterPasien::latest()->paginate(10);

        return view('master_pasien.index', compact('pasiens'));
    }

    public function create()
    {
        return view('master_pasien.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
            'status_asuransi' => 'required',
            'golongan_darah' => 'required',
        ]);

        MasterPasien::create($request->all());

        return redirect()->route('master-pasien.index')
            ->with('success', 'Data pasien berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $pasien = MasterPasien::findOrFail($id);

        return view('master_pasien.edit', compact('pasien'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
            'status_asuransi' => 'required',
            'golongan_darah' => 'required',
        ]);

        $pasien = MasterPasien::findOrFail($id);
        $pasien->update($request->all());

        return redirect()->route('master-pasien.index')
            ->with('success', 'Data pasien berhasil diubah.');
    }

    public function destroy($id)
    {
        $pasien = MasterPasien::findOrFail($id);
        $pasien->delete();

        return redirect()->route('master-pasien.index')
            ->with('success', 'Data pasien berhasil dihapus.');
    }
}
