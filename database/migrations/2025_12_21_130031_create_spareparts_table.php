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
    Schema::create('spareparts', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->string('kode_sparepart', 50)->unique();
        $table->string('nama_sparepart', 150);
        $table->string('kategori', 100)->nullable();
        $table->string('satuan', 50)->nullable();           // pcs, box, unit, dll
        $table->integer('stok')->default(0);
        $table->integer('stok_minimum')->default(0);        // batas low stock
        $table->string('lokasi_rak', 100)->nullable();      // rak / lemari / posisi
        $table->boolean('status_aktif')->default(true);
        $table->text('keterangan')->nullable();
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('spareparts');
}


};
