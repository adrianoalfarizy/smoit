<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mdr extends Model
{
    protected $table = 'mdr';

    protected $fillable = [
        'tanggal',
        'teknisi_id',
        'lokasi_id',
        'kategori_pekerjaan_id',
        'nomor_tiket',
        'deskripsi_pekerjaan',
        'jam_mulai',
        'jam_selesai',
        'status_pekerjaan',
        'catatan',
        'bukti_pekerjaan', // 🆕
    ];

    public function teknisi()
    {
        return $this->belongsTo(MasterTeknisi::class, 'teknisi_id');
    }

    public function lokasi()
    {
        return $this->belongsTo(MasterLokasi::class, 'lokasi_id');
    }

    public function kategoriPekerjaan()
    {
        return $this->belongsTo(KategoriPekerjaan::class, 'kategori_pekerjaan_id');
    }
}