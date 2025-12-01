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
    Schema::create('master_teknisi', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->string('kode_teknisi', 20)->unique();
        $table->string('nama_lengkap', 100);
        $table->string('nik', 50)->nullable();
        $table->string('jabatan', 100)->nullable();
        $table->string('no_hp', 20)->nullable();
        $table->string('email', 100)->nullable();
        $table->boolean('status_aktif')->default(true);
        $table->text('keterangan')->nullable();
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('master_teknisi');
}


};
