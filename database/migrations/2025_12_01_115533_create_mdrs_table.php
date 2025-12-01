<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mdr', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('tanggal');
            $table->foreignId('teknisi_id')->constrained('master_teknisi');
            $table->foreignId('lokasi_id')->constrained('master_lokasi');
            $table->foreignId('kategori_pekerjaan_id')->constrained('kategori_pekerjaan');
            $table->string('nomor_tiket', 50)->nullable();
            $table->text('deskripsi_pekerjaan');
            $table->time('jam_mulai');
            $table->time('jam_selesai')->nullable();
            $table->string('status_pekerjaan', 20);
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mdr');
    }


};
