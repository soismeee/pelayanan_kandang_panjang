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
            $table->string('nama_kepala_keluarga', 50);
            $table->string('nomor_kk', 50);
            $table->string('nama_bayi', 50);
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->text('tempat_dilahirkan');
            $table->text('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->time('waktu_lahir');
            $table->string('jenis_kelahiran', 50);
            $table->string('kelahiran_ke', 50);

            $table->string('penolong_kelahiran', 50);
            $table->string('berat_bayi', 50);
            $table->string('panjang_bayi', 50);
            
            $table->string('nik_ibu', 50);
            $table->string('nama_ibu', 50);
            $table->date('tgl_lahir_ibu');
            $table->string('pekerjaan_ibu', 50);
            $table->text('alamat_ibu');
            $table->string('kewarnegaraan_ibu', 50);
            
            $table->date('tgl_pencatatan_pernikahan');
            
            $table->string('nik_ayah', 50)->nullable();
            $table->string('nama_ayah', 50)->nullable();
            $table->date('tgl_lahir_ayah')->nullable();
            $table->string('pekerjaan_ayah', 50)->nullable();
            $table->text('alamat_ayah')->nullable();
            $table->string('kewarnegaraan_ayah', 50)->nullable();
            
            $table->string('berkas_kk', 100);
            $table->string('ktp_ibu', 100);
            $table->string('ktp_ayah', 100)->nullable();
            $table->string('akta_nikah', 100);
            $table->string('surat_ket_rs', 100);
            $table->string('surat_pengantar_rt', 100);
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
