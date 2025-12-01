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
    Schema::create('kategori_pekerjaan', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->string('kode_kategori', 20)->unique();
        $table->string('nama_kategori', 100);
        $table->text('deskripsi')->nullable();
        $table->integer('sla_jam_response')->nullable();
        $table->integer('sla_jam_selesai')->nullable();
        $table->boolean('status_aktif')->default(true);
        $table->text('keterangan')->nullable();
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('kategori_pekerjaan');
}


};
