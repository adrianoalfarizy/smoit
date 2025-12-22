<?php

namespace App\Http\Controllers;

use App\Models\Sparepart;
use Illuminate\Http\Request;

class SparepartController extends Controller
{
    public function index()
    {
        $sparepart = Sparepart::orderBy('nama_sparepart')->paginate(15);

        // Untuk notifikasi stok menipis
        $lowStock = Sparepart::whereColumn('stok', '<=', 'stok_minimum')
            ->where('stok_minimum', '>', 0)
            ->get();

        return view('sparepart.index', compact('sparepart', 'lowStock'));
    }

    public function create()
    {
        $sparepart = new Sparepart();

        return view('sparepart.create', compact('sparepart'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_sparepart' => 'required|string|max:50|unique:spareparts,kode_sparepart',
            'nama_sparepart' => 'required|string|max:150',
            'kategori'       => 'nullable|string|max:100',
            'satuan'         => 'nullable|string|max:50',
            'stok'           => 'required|integer|min:0',
            'stok_minimum'   => 'required|integer|min:0',
            'lokasi_rak'     => 'nullable|string|max:100',
            'status_aktif'   => 'required|boolean',
            'keterangan'     => 'nullable|string',
        ]);

        Sparepart::create($validated);

        return redirect()
            ->route('sparepart.index')
            ->with('success', 'Sparepart berhasil ditambahkan.');
    }

    public function edit(Sparepart $sparepart)
    {
        return view('sparepart.edit', compact('sparepart'));
    }

    public function update(Request $request, Sparepart $sparepart)
    {
        $validated = $request->validate([
            'kode_sparepart' => 'required|string|max:50|unique:spareparts,kode_sparepart,' . $sparepart->id,
            'nama_sparepart' => 'required|string|max:150',
            'kategori'       => 'nullable|string|max:100',
            'satuan'         => 'nullable|string|max:50',
            'stok'           => 'required|integer|min:0',
            'stok_minimum'   => 'required|integer|min:0',
            'lokasi_rak'     => 'nullable|string|max:100',
            'status_aktif'   => 'required|boolean',
            'keterangan'     => 'nullable|string',
        ]);

        Sparepart::where('id', $sparepart->id)->update($validated);

        return redirect()
            ->route('sparepart.index')
            ->with('success', 'Sparepart berhasil diperbarui.');
    }

    public function destroy(Sparepart $sparepart)
    {
        $sparepart->delete();

        return redirect()
            ->route('sparepart.index')
            ->with('success', 'Sparepart berhasil dihapus.');
    }
}

