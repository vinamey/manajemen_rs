<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PengeluaranController extends Controller
{
    public function index()
    {
        $bulan = now()->month;
        $tahun = now()->year;

        $pengeluarans = Pengeluaran::whereMonth('tanggal_pengeluaran', $bulan)
            ->whereYear('tanggal_pengeluaran', $tahun)
            ->orderBy('tanggal_pengeluaran', 'desc')
            ->get();

        $totalPengeluaran = $pengeluarans->sum('nominal');

        return view('direktur.pengeluaran.index', compact(
            'pengeluarans',
            'totalPengeluaran'
        ));
    }

    public function create()
    {
        abort(404);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'tanggal_pengeluaran' => 'required|date',
            'nominal' => 'required|numeric|min:1',
            'keterangan' => 'nullable|string',
        ]);

        Pengeluaran::create($validated);

        return response()->json([
            'message' => 'Data pengeluaran berhasil ditambahkan.'
        ]);
    }

    public function edit(string $id)
    {
        $pengeluaran = Pengeluaran::findOrFail($id);

        return response()->json([
            'id' => $pengeluaran->id,
            'nama' => $pengeluaran->nama,
            'kategori' => $pengeluaran->kategori,
            'tanggal_pengeluaran' => Carbon::parse(
                $pengeluaran->tanggal_pengeluaran
            )->format('Y-m-d'),
            'nominal' => $pengeluaran->nominal,
            'keterangan' => $pengeluaran->keterangan,
        ]);
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'tanggal_pengeluaran' => 'required|date',
            'nominal' => 'required|numeric|min:1',
            'keterangan' => 'nullable|string',
        ]);

        $pengeluaran = Pengeluaran::findOrFail($id);
        $pengeluaran->update($validated);

        return response()->json([
            'message' => 'Data pengeluaran berhasil diperbarui.'
        ]);
    }

    public function destroy(string $id)
    {
        $pengeluaran = Pengeluaran::findOrFail($id);
        $pengeluaran->delete();

        return response()->json([
            'message' => 'Data pengeluaran berhasil dihapus.'
        ]);
    }

    public function data(Request $request)
    {
        $bulan = $request->input('bulan', now()->month);
        $tahun = $request->input('tahun', now()->year);

        $query = Pengeluaran::query();

        if ($bulan !== 'all') {
            $query->whereMonth('tanggal_pengeluaran', (int) $bulan);
        }

        $query->whereYear('tanggal_pengeluaran', (int) $tahun);

        $pengeluarans = $query
            ->orderBy('tanggal_pengeluaran', 'desc')
            ->get();

        $total = $pengeluarans->sum('nominal');
        $jumlah = $pengeluarans->count();

        $html = '';

        foreach ($pengeluarans as $index => $item) {
            $id = $item->id;
            $nama = e($item->nama);
            $kategori = e($item->kategori);
            $tanggal = Carbon::parse(
                $item->tanggal_pengeluaran
            )->format('d-m-Y');

            $nominal = number_format($item->nominal, 0, ',', '.');
            $keterangan = e($item->keterangan ?? '-');

            $html .= "
                <tr>
                    <td>" . ($index + 1) . "</td>
                    <td class='fw-semibold'>{$nama}</td>
                    <td>
                        <span class='badge-kategori'>{$kategori}</span>
                    </td>
                    <td>{$tanggal}</td>
                    <td>
                        <span class='nominal-text'>Rp {$nominal}</span>
                    </td>
                    <td>{$keterangan}</td>
                    <td class='text-center'>
                        <button type='button'
                            class='btn-aksi btn-edit'
                            onclick='editPengeluaran({$id})'
                            title='Edit'>
                            <i class='fas fa-edit'></i>
                        </button>

                        <button type='button'
                            class='btn-aksi btn-hapus'
                            onclick='hapusPengeluaran({$id})'
                            title='Hapus'>
                            <i class='fas fa-trash'></i>
                        </button>
                    </td>
                </tr>
            ";
        }

        if ($pengeluarans->isEmpty()) {
            $html = '
                <tr>
                    <td colspan="7" class="text-center text-muted py-4">
                        <i class="fas fa-folder-open d-block mb-2"
                           style="font-size:25px;color:#b6c6da;"></i>
                        Belum ada data pengeluaran pada periode ini.
                    </td>
                </tr>
            ';
        }

        $namaBulan = $bulan === 'all'
            ? 'Semua Bulan'
            : Carbon::create()->month((int) $bulan)
                ->locale('id')
                ->translatedFormat('F');

        return response()->json([
            'html' => $html,
            'total' => $total,
            'jumlah' => $jumlah,
            'periode' => $namaBulan . ' ' . $tahun
        ]);
    }
}
