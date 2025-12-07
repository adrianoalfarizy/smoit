<?php

namespace App\Http\Controllers;

use App\Models\KategoriPekerjaan;
use Illuminate\Http\Request;

class KategoriPekerjaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategoriPekerjaan = KategoriPekerjaan::orderBy('nama_kategori')->paginate(10);

        return view('kategori_pekerjaan.index', compact('kategoriPekerjaan'));
    }

    public function create()
    {
        $kategoriPekerjaan = new KategoriPekerjaan();

        return view('kategori_pekerjaan.create', compact('kategoriPekerjaan'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_kategori'     => 'required|string|max:20|unique:kategori_pekerjaan,kode_kategori',
            'nama_kategori'     => 'required|string|max:100',
            'deskripsi'         => 'nullable|string',
            'sla_jam_response'  => 'nullable|integer|min:0',
            'sla_jam_selesai'   => 'nullable|integer|min:0',
            'status_aktif'      => 'required|boolean',
            'keterangan'        => 'nullable|string',
        ]);

        KategoriPekerjaan::create($validated);

        return redirect()
            ->route('kategori-pekerjaan.index')
            ->with('success', 'Kategori pekerjaan berhasil ditambahkan.');
    }

    public function edit(KategoriPekerjaan $kategoriPekerjaan)
    {
        return view('kategori_pekerjaan.edit', compact('kategoriPekerjaan'));
    }

    public function update(Request $request, KategoriPekerjaan $kategoriPekerjaan)
    {
        $validated = $request->validate([
            'kode_kategori'     => 'required|string|max:20|unique:kategori_pekerjaan,kode_kategori,' . $kategoriPekerjaan->id,
            'nama_kategori'     => 'required|string|max:100',
            'deskripsi'         => 'nullable|string',
            'sla_jam_response'  => 'nullable|integer|min:0',
            'sla_jam_selesai'   => 'nullable|integer|min:0',
            'status_aktif'      => 'required|boolean',
            'keterangan'        => 'nullable|string',
        ]);

        $kategoriPekerjaan->update($validated);

        return redirect()
            ->route('kategori-pekerjaan.index')
            ->with('success', 'Kategori pekerjaan berhasil diperbarui.');
    }

    public function destroy(KategoriPekerjaan $kategoriPekerjaan)
    {
        $kategoriPekerjaan->delete();

        return redirect()
            ->route('kategori-pekerjaan.index')
            ->with('success', 'Kategori pekerjaan berhasil dihapus.');
    }
}
