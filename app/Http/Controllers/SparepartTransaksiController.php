<?php

namespace App\Http\Controllers;

use App\Models\SparepartTransaksi;

class SparepartTransaksiController extends Controller
{
    public function index()
    {
        $transaksi = SparepartTransaksi::with('sparepart')
            ->orderByDesc('tanggal')
            ->paginate(20);

        return view('sparepart_transaksi.index', compact('transaksi'));
    }
}

