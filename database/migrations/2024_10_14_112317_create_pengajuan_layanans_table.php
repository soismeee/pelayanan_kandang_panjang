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
            $table->uuid('pengguna_id')->index();
            $table->enum('jenis_pengajuan', ['kelahiran', 'kematian']);
            
            $table->string('nik_pelapor', 16);
            $table->string('nama_pelapor', 100);
            $table->date('tgl_lahir_pelapor');
            $table->string('pekerjaan_pelapor', 100);
            $table->text('alamat_pelapor');
            $table->string('no_hp', 16);
            
            $table->string('nik_saksi1', 16);
            $table->string('nama_saksi1', 50);
            $table->date('tgl_lahir_saksi1');
            $table->string('pekerjaan_saksi1', 100);
            $table->text('alamat_saksi1');

            $table->string('nik_saksi2', 16);
            $table->string('nama_saksi2', 50);
            $table->date('tgl_lahir_saksi2');
            $table->string('pekerjaan_saksi2', 100);
            $table->text('alamat_saksi2');


            $table->date('tanggal_pengajuan');
            $table->enum('status', ['pengajuan', 'proses', 'selesai']);

            $table->string('dokumen')->nullable();
            $table->string('ktp_pelapor')->nullable();
            $table->string('ktp_saksi1')->nullable();
            $table->string('ktp_saksi2')->nullable();
            $table->enum('read_admin', [0, 1])->default(0);
            $table->enum('read_pengguna', [0, 1])->default(0);
            $table->timestamps();

            $table->foreign('pengguna_id')->references('pengguna_id')->on('penggunas')->onDelete('cascade');
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
