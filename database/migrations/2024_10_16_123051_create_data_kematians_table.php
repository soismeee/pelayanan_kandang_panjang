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
        Schema::create('data_kematians', function (Blueprint $table) {
            $table->id();
            $table->uuid('pengajuan_id')->index();
            $table->string('nama_alm', 50);
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->date('tanggal_kematian');
            $table->text('tempat_kematian', 100);
            $table->string('berkas_kk', 100);
            $table->string('berkas_ktp', 100);
            $table->string('berkas_akta', 100);
            $table->timestamps();

            $table->foreign('pengajuan_id')->references('pengajuan_id')->on('pengajuan_layanans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_kematians');
    }
};
