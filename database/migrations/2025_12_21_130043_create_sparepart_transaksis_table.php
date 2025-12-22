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
    Schema::create('sparepart_transaksis', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->foreignId('sparepart_id')->constrained('spareparts');
        $table->date('tanggal');
        $table->enum('tipe', ['IN', 'OUT']); // IN = masuk, OUT = keluar
        $table->integer('qty');
        $table->string('sumber_tujuan', 150)->nullable(); // dari supplier / ke lokasi mana
        $table->unsignedBigInteger('teknisi_id')->nullable(); // optional, nanti untuk permintaan teknisi
        $table->text('catatan')->nullable();
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('sparepart_transaksis');
}


};
