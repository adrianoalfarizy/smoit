<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriPekerjaan extends Model
{
    protected $table = 'kategori_pekerjaan';

    protected $fillable = [
        'kode_kategori',
        'nama_kategori',
        'deskripsi',
        'sla_jam_response',
        'sla_jam_selesai',
        'status_aktif',
        'keterangan',
    ];

    public function mdr()
    {
        return $this->hasMany(Mdr::class, 'kategori_pekerjaan_id');
    }
}
