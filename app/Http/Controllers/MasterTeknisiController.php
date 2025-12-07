<?php

namespace App\Http\Controllers;

use App\Models\MasterTeknisi;
use Illuminate\Http\Request;

class MasterTeknisiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
    {
        // Bisa pakai pagination biar rapi
        $teknisi = MasterTeknisi::orderBy('nama_lengkap')->paginate(10);

        return view('master_teknisi.index', compact('teknisi'));
    }

    /**
     * Tampilkan form tambah teknisi.
     */
    public function create()
    {
        // Kita kirim objek kosong untuk form
        $masterTeknisi = new MasterTeknisi();

        return view('master_teknisi.create', compact('masterTeknisi'));
    }

    /**
     * Simpan teknisi baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_teknisi'   => 'required|string|max:20|unique:master_teknisi,kode_teknisi',
            'nama_lengkap'   => 'required|string|max:100',
            'nik'            => 'nullable|string|max:50',
            'jabatan'        => 'nullable|string|max:100',
            'no_hp'          => 'nullable|string|max:20',
            'email'          => 'nullable|email|max:100',
            'status_aktif'   => 'required|boolean',
            'keterangan'     => 'nullable|string',
        ]);

        MasterTeknisi::create($validated);

        return redirect()
            ->route('master-teknisi.index')
            ->with('success', 'Data teknisi berhasil ditambahkan.');
    }

    /**
     * Tampilkan form edit teknisi.
     */
    public function edit(MasterTeknisi $masterTeknisi)
    {
        return view('master_teknisi.edit', compact('masterTeknisi'));
    }

    /**
     * Update teknisi.
     */
    public function update(Request $request, MasterTeknisi $masterTeknisi)
    {
        $validated = $request->validate([
            'kode_teknisi'   => 'required|string|max:20|unique:master_teknisi,kode_teknisi,' . $masterTeknisi->id,
            'nama_lengkap'   => 'required|string|max:100',
            'nik'            => 'nullable|string|max:50',
            'jabatan'        => 'nullable|string|max:100',
            'no_hp'          => 'nullable|string|max:20',
            'email'          => 'nullable|email|max:100',
            'status_aktif'   => 'required|boolean',
            'keterangan'     => 'nullable|string',
        ]);

        $masterTeknisi->update($validated);

        return redirect()
            ->route('master-teknisi.index')
            ->with('success', 'Data teknisi berhasil diperbarui.');
    }

    /**
     * Hapus teknisi.
     */
    public function destroy(MasterTeknisi $masterTeknisi)
    {
        $masterTeknisi->delete();

        return redirect()
            ->route('master-teknisi.index')
            ->with('success', 'Data teknisi berhasil dihapus.');
    }
}
