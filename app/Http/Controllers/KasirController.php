<?php

namespace App\Http\Controllers;

use App\Models\Kasir;
use Illuminate\Http\Request;

class KasirController extends Controller
{
   public function index()
{
    return redirect()->route('kasir.dashboard');
}

    public function create()
    {
        return view('kasir.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'no_hp' => 'required',
        ]);

        Kasir::create([
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_hp' => $request->no_hp,
        ]);

        return redirect()->route('kasir.index')
            ->with('success', 'Data kasir berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kasir = Kasir::findOrFail($id);

        return view('kasir.edit', compact('kasir'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'no_hp' => 'required',
        ]);

        $kasir = Kasir::findOrFail($id);

        $kasir->update([
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_hp' => $request->no_hp,
        ]);

        return redirect()->route('kasir.index')
            ->with('success', 'Data kasir berhasil diubah.');
    }

    public function destroy($id)
    {
        $kasir = Kasir::findOrFail($id);

        $kasir->delete();

        return redirect()->route('kasir.index')
            ->with('success', 'Data kasir berhasil dihapus.');
    }
}
