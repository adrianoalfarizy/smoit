<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sparepart extends Model
{
    protected $table = 'spareparts';

    protected $fillable = [
        'kode_sparepart',
        'nama_sparepart',
        'kategori',
        'satuan',
        'stok',
        'stok_minimum',
        'lokasi_rak',
        'status_aktif',
        'keterangan',
    ];

    public function transaksis()
    {
        return $this->hasMany(SparepartTransaksi::class, 'sparepart_id');
    }
}

