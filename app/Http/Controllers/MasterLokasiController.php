<?php

namespace App\Http\Controllers;

use App\Models\MasterLokasi;
use Illuminate\Http\Request;

class MasterLokasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lokasi = MasterLokasi::orderBy('nama_lokasi')->paginate(10);

        return view('master_lokasi.index', compact('lokasi'));
    }

    public function create()
    {
        $masterLokasi = new MasterLokasi();

        return view('master_lokasi.create', compact('masterLokasi'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_lokasi'  => 'required|string|max:20|unique:master_lokasi,kode_lokasi',
            'nama_lokasi'  => 'required|string|max:100',
            'jenis_lokasi' => 'nullable|string|max:50',
            'alamat'       => 'nullable|string',
            'kota'         => 'nullable|string|max:100',
            'pic_nama'     => 'nullable|string|max:100',
            'pic_kontak'   => 'nullable|string|max:50',
            'status_aktif' => 'required|boolean',
            'keterangan'   => 'nullable|string',
        ]);

        MasterLokasi::create($validated);

        return redirect()
            ->route('master-lokasi.index')
            ->with('success', 'Data lokasi berhasil ditambahkan.');
    }

    public function edit(MasterLokasi $masterLokasi)
    {
        return view('master_lokasi.edit', compact('masterLokasi'));
    }

    public function update(Request $request, MasterLokasi $masterLokasi)
    {
        $validated = $request->validate([
            'kode_lokasi'  => 'required|string|max:20|unique:master_lokasi,kode_lokasi,' . $masterLokasi->id,
            'nama_lokasi'  => 'required|string|max:100',
            'jenis_lokasi' => 'nullable|string|max:50',
            'alamat'       => 'nullable|string',
            'kota'         => 'nullable|string|max:100',
            'pic_nama'     => 'nullable|string|max:100',
            'pic_kontak'   => 'nullable|string|max:50',
            'status_aktif' => 'required|boolean',
            'keterangan'   => 'nullable|string',
        ]);

        $masterLokasi->update($validated);

        return redirect()
            ->route('master-lokasi.index')
            ->with('success', 'Data lokasi berhasil diperbarui.');
    }

    public function destroy(MasterLokasi $masterLokasi)
    {
        $masterLokasi->delete();

        return redirect()
            ->route('master-lokasi.index')
            ->with('success', 'Data lokasi berhasil dihapus.');
    }
}
