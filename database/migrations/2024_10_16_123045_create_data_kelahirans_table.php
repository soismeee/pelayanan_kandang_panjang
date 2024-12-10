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
        Schema::create('data_kelahirans', function (Blueprint $table) {
            $table->id();
            $table->uuid('pengajuan_id')->index();
            $table->string('nama_bayi', 50);
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->date('tanggal_lahir');
            $table->text('tempat_lahir', 100);
            $table->string('nama_ayah', 50)->nullable();
            $table->string('nik_ayah', 50)->nullable();
            $table->string('ktp_ayah', 50)->nullable();
            $table->string('nama_ibu', 50);
            $table->string('nik_ibu', 50);
            $table->string('ktp_ibu', 50);
            $table->string('berkas_kk', 100);
            $table->timestamps();

            $table->foreign('pengajuan_id')->references('pengajuan_id')->on('pengajuan_layanans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_kelahirans');
    }
};
