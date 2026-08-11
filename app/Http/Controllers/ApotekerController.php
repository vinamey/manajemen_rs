<?php

namespace App\Http\Controllers;

use App\Models\Apoteker;
use Illuminate\Http\Request;

class ApotekerController extends Controller
{
    public function index()
    {
        $apotekers = Apoteker::latest()->paginate(10);

        return view('master_apoteker.index', compact('apotekers'));
    }

    public function create()
    {
        return view('master_apoteker.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'no_hp' => 'required',
        ]);

        Apoteker::create([
            'nama' => $request->nama,
            'no_hp' => $request->no_hp,
        ]);

        return redirect()->route('master-apoteker.index')
            ->with('success', 'Data apoteker berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $apoteker = Apoteker::findOrFail($id);

        return view('master_apoteker.edit', compact('apoteker'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'no_hp' => 'required',
        ]);

        $apoteker = Apoteker::findOrFail($id);

        $apoteker->update([
            'nama' => $request->nama,
            'no_hp' => $request->no_hp,
        ]);

        return redirect()->route('master-apoteker.index')
            ->with('success', 'Data apoteker berhasil diubah.');
    }

    public function destroy($id)
    {
        $apoteker = Apoteker::findOrFail($id);

        $apoteker->delete();

        return redirect()->route('master-apoteker.index')
            ->with('success', 'Data apoteker berhasil dihapus.');
    }
}
