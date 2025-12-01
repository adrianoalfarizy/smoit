<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterLokasi extends Model
{
    protected $table = 'master_lokasi';

    protected $fillable = [
        'kode_lokasi',
        'nama_lokasi',
        'jenis_lokasi',
        'alamat',
        'kota',
        'pic_nama',
        'pic_kontak',
        'status_aktif',
        'keterangan',
    ];

    public function mdr()
    {
        return $this->hasMany(Mdr::class, 'lokasi_id');
    }
}
