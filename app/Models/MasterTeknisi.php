<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterTeknisi extends Model
{
    protected $table = 'master_teknisi';

    protected $fillable = [
        'kode_teknisi',
        'nama_lengkap',
        'nik',
        'jabatan',
        'no_hp',
        'email',
        'status_aktif',
        'keterangan',
    ];

    public function mdr()
    {
        return $this->hasMany(Mdr::class, 'teknisi_id');
    }
}
