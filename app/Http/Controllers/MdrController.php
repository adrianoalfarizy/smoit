<?php

namespace App\Http\Controllers;

use App\Models\Mdr;
use App\Models\MasterTeknisi;
use App\Models\MasterLokasi;
use App\Models\KategoriPekerjaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MdrController extends Controller
{
    /**
     * List MDR + Filter + Pagination + Permission.
     */
    public function index(Request $request)
    {
        $query = Mdr::with(['teknisi', 'lokasi', 'kategoriPekerjaan']);

        // 🔐 Permission: contoh logika (sesuaikan dengan struktur users kamu)
        // Misal: kalau user role "teknisi", hanya boleh lihat MDR miliknya
        if (auth()->check() && auth()->user()->role === 'teknisi') {
            // asumsi tabel users punya kolom teknisi_id
            $query->where('teknisi_id', auth()->user()->teknisi_id);
        }

        // 🔎 Filter tanggal
        if ($request->filled('tanggal_dari')) {
            $query->whereDate('tanggal', '>=', $request->tanggal_dari);
        }
        if ($request->filled('tanggal_sampai')) {
            $query->whereDate('tanggal', '<=', $request->tanggal_sampai);
        }

        // 🔎 Filter teknisi / lokasi / kategori
        if ($request->filled('teknisi_id')) {
            $query->where('teknisi_id', $request->teknisi_id);
        }
        if ($request->filled('lokasi_id')) {
            $query->where('lokasi_id', $request->lokasi_id);
        }
        if ($request->filled('kategori_pekerjaan_id')) {
            $query->where('kategori_pekerjaan_id', $request->kategori_pekerjaan_id);
        }

        $mdr = $query
            ->orderByDesc('tanggal')
            ->paginate(20)
            ->withQueryString(); // biar filter tetap kepakai saat pindah halaman

        // Data untuk dropdown filter
        $teknisi = MasterTeknisi::orderBy('nama_lengkap')->get();
        $lokasi = MasterLokasi::orderBy('nama_lokasi')->get();
        $kategori = KategoriPekerjaan::orderBy('nama_kategori')->get();

        return view('mdr.index', compact('mdr', 'teknisi', 'lokasi', 'kategori', 'request'));
    }

    /**
     * Form input MDR.
     */
    public function create()
    {
        $mdr = new Mdr();

        $teknisi = MasterTeknisi::orderBy('nama_lengkap')->get();
        $lokasi = MasterLokasi::orderBy('nama_lokasi')->get();
        $kategori = KategoriPekerjaan::orderBy('nama_kategori')->get();

        return view('mdr.create', compact('mdr', 'teknisi', 'lokasi', 'kategori'));
    }

    /**
     * Simpan MDR baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal'                => 'required|date',
            'teknisi_id'             => 'required|exists:master_teknisi,id',
            'lokasi_id'              => 'required|exists:master_lokasi,id',
            'kategori_pekerjaan_id'  => 'required|exists:kategori_pekerjaan,id',
            'nomor_tiket'            => 'nullable|string|max:50',
            'deskripsi_pekerjaan'    => 'required|string',
            'jam_mulai'              => 'required|date_format:H:i',
            'jam_selesai'            => 'nullable|date_format:H:i|after_or_equal:jam_mulai',
            'status_pekerjaan'       => 'required|string|max:20',
            'catatan'                => 'nullable|string',
            'bukti_pekerjaan'        => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:4096', // max 4MB
        ]);

        // Upload bukti pekerjaan (kalau ada)
        if ($request->hasFile('bukti_pekerjaan')) {
            $path = $request->file('bukti_pekerjaan')->store('mdr_bukti', 'public');
            $validated['bukti_pekerjaan'] = $path;
        }

        Mdr::create($validated);

        return redirect()
            ->route('mdr.index')
            ->with('success', 'MDR berhasil ditambahkan.');
    }

    /**
     * Form edit MDR.
     */
    public function edit(Mdr $mdr)
    {
        $teknisi = MasterTeknisi::orderBy('nama_lengkap')->get();
        $lokasi = MasterLokasi::orderBy('nama_lokasi')->get();
        $kategori = KategoriPekerjaan::orderBy('nama_kategori')->get();

        return view('mdr.edit', compact('mdr', 'teknisi', 'lokasi', 'kategori'));
    }

    /**
     * Update MDR.
     */
    public function update(Request $request, Mdr $mdr)
    {
        $validated = $request->validate([
            'tanggal'                => 'required|date',
            'teknisi_id'             => 'required|exists:master_teknisi,id',
            'lokasi_id'              => 'required|exists:master_lokasi,id',
            'kategori_pekerjaan_id'  => 'required|exists:kategori_pekerjaan,id',
            'nomor_tiket'            => 'nullable|string|max:50',
            'deskripsi_pekerjaan'    => 'required|string',
            'jam_mulai'              => 'required|date_format:H:i',
            'jam_selesai'            => 'nullable|date_format:H:i|after_or_equal:jam_mulai',
            'status_pekerjaan'       => 'required|string|max:20',
            'catatan'                => 'nullable|string',
            'bukti_pekerjaan'        => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:4096',
        ]);

        if ($request->hasFile('bukti_pekerjaan')) {
            // Hapus file lama kalau ada
            if ($mdr->bukti_pekerjaan && Storage::disk('public')->exists($mdr->bukti_pekerjaan)) {
                Storage::disk('public')->delete($mdr->bukti_pekerjaan);
            }

            $path = $request->file('bukti_pekerjaan')->store('mdr_bukti', 'public');
            $validated['bukti_pekerjaan'] = $path;
        }

        $mdr->update($validated);

        return redirect()
            ->route('mdr.index')
            ->with('success', 'MDR berhasil diperbarui.');
    }

    /**
     * Hapus MDR.
     */
    public function destroy(Mdr $mdr)
    {
        if ($mdr->bukti_pekerjaan && Storage::disk('public')->exists($mdr->bukti_pekerjaan)) {
            Storage::disk('public')->delete($mdr->bukti_pekerjaan);
        }

        $mdr->delete();

        return redirect()
            ->route('mdr.index')
            ->with('success', 'MDR berhasil dihapus.');
    }

    /**
     * Export MDR ke PDF (kerangka, implementasi pakai library PDF).
     */
    public function exportPdf(Request $request)
    {
        // Ambil data yang sama dengan index + filter
        $mdr = $this->buildFilteredQuery($request)->get();

        // TODO: Implement pakai library PDF (mis. barryvdh/laravel-dompdf)
        // return PDF::loadView('mdr.export_pdf', compact('mdr'))->download('mdr.pdf');

        return back()->with('success', 'Export PDF: logika PDF masih perlu diimplementasikan.');
    }

    /**
     * Export MDR ke Excel/CSV (kerangka).
     */
    public function exportExcel(Request $request)
    {
        $mdr = $this->buildFilteredQuery($request)->get();

        // TODO: Implement pakai Laravel Excel (maatwebsite/excel)
        // atau buat manual CSV

        return back()->with('success', 'Export Excel: logika Excel masih perlu diimplementasikan.');
    }

    /**
     * Helper: Build query dengan filter & permission (dipakai index/export).
     */
    protected function buildFilteredQuery(Request $request)
    {
        $query = Mdr::with(['teknisi', 'lokasi', 'kategoriPekerjaan']);

        if (auth()->check() && auth()->user()->role === 'teknisi') {
            $query->where('teknisi_id', auth()->user()->teknisi_id);
        }

        if ($request->filled('tanggal_dari')) {
            $query->whereDate('tanggal', '>=', $request->tanggal_dari);
        }
        if ($request->filled('tanggal_sampai')) {
            $query->whereDate('tanggal', '<=', $request->tanggal_sampai);
        }
        if ($request->filled('teknisi_id')) {
            $query->where('teknisi_id', $request->teknisi_id);
        }
        if ($request->filled('lokasi_id')) {
            $query->where('lokasi_id', $request->lokasi_id);
        }
        if ($request->filled('kategori_pekerjaan_id')) {
            $query->where('kategori_pekerjaan_id', $request->kategori_pekerjaan_id);
        }

        return $query;
    }
}

