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
    Schema::table('mdr', function (Blueprint $table) {
        $table->string('bukti_pekerjaan', 255)->nullable()->after('catatan');
    });
}

public function down(): void
{
    Schema::table('mdr', function (Blueprint $table) {
        $table->dropColumn('bukti_pekerjaan');
    });
}
};
