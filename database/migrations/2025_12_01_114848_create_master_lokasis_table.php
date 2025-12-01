<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('master_lokasi', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->string('kode_lokasi', 20)->unique();
        $table->string('nama_lokasi', 100);
        $table->string('jenis_lokasi', 50)->nullable(); // kantor/client/gudang
        $table->text('alamat')->nullable();
        $table->string('kota', 100)->nullable();
        $table->string('pic_nama', 100)->nullable();
        $table->string('pic_kontak', 50)->nullable();
        $table->boolean('status_aktif')->default(true);
        $table->text('keterangan')->nullable();
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('master_lokasi');
}


};
