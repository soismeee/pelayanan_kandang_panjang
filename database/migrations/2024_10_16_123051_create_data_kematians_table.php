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
            $table->string('nama_kepala_keluarga', 50);
            $table->string('nomor_keluarga', 50);
            $table->string('nik', 16);
            $table->string('nama_alm', 50);
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->text('tempat_lahir', 100);
            $table->date('tanggal_lahir');
            
            $table->string('agama', 50);
            $table->string('pekerjaan', 50);
            $table->text('alamat');

            $table->date('tanggal_kematian');
            $table->time('waktu_kematian');
            $table->string('sebab_kematian', 50);
            $table->text('tempat_kematian', 100);
            $table->string('yang_menerangkan', 50);

            $table->string('nik_ibu', 50)->nullable();
            $table->string('nama_ibu', 50)->nullable();
            $table->date('tgl_lahir_ibu')->nullable();
            $table->text('pekerjaan_ibu')->nullable();
            $table->text('alamat_ibu')->nullable();

            $table->string('nik_ayah', 50)->nullable();
            $table->string('nama_ayah', 50)->nullable();
            $table->date('tgl_lahir_ayah')->nullable();
            $table->text('pekerjaan_ayah')->nullable();
            $table->text('alamat_ayah')->nullable();
            
            $table->string('berkas_kk', 100);
            $table->string('ktp_ibu', 100)->nullable();
            $table->string('ktp_ayah', 100)->nullable();
            $table->string('berkas_ktp', 100);
            $table->string('berkas_akta', 100);
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
        Schema::dropIfExists('data_kematians');
    }
};
