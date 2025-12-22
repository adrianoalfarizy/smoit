<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SparepartTransaksi extends Model
{
    protected $table = 'sparepart_transaksis';

    protected $fillable = [
        'sparepart_id',
        'tanggal',
        'tipe',
        'qty',
        'sumber_tujuan',
        'teknisi_id',
        'catatan',
    ];

    public function sparepart()
    {
        return $this->belongsTo(Sparepart::class, 'sparepart_id');
    }
}


