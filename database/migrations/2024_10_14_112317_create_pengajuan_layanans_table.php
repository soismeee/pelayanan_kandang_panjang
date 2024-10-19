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
        Schema::create('pengajuan_layanans', function (Blueprint $table) {
            $table->uuid('pengajuan_id')->primary();
            $table->uuid('pelanggan_id')->index();
            $table->enum('jenis_pengajuan', ['kelahiran', 'kematian']);
            $table->string('nama_pelapor', 100);
            $table->string('nik_pelapor', 16);
            $table->date('tanggal_pengajuan');
            $table->text('alamat_pelapor');
            $table->enum('status', ['pengajuan', 'selesai']);
            $table->timestamps();

            $table->foreign('pelanggan_id')->references('pelanggan_id')->on('pelanggans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_layanans');
    }
};
