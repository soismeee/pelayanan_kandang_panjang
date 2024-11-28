<?php

namespace App\Http\Controllers;

use App\Models\PengajuanLayanan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function indexKelahiran(){
        return view('laporan.kelahiran', [
            'title' => 'Laporan kelahiran',
            'menu' => 'laporan',
            'submenu' => 'kelahiran',
        ]);
    }

    public function cekKelahiran(Request $request){
        $tgl_awal = $request->tgl_awal;
        $tgl_akhir = $request->tgl_akhir;

        $pelayanan = PengajuanLayanan::with('dataKelahiran')->where('jenis_pengajuan', "kelahiran")->whereBetween('tanggal_pengajuan', [$tgl_awal, $tgl_akhir])->get();
        if (count($pelayanan) > 0) {
            return response()->json(['statusCode' => 200, 'data' => $pelayanan]);
        } else {
            return response()->json(['statusCode' => 400, 'message' => 'Data tidak ditemukan'], 400);
        }
    }

    public function cetakKelahiran(Request $request){
        $tgl_awal = $request->tgl_awal;
        $tgl_akhir = $request->tgl_akhir;

        $pelayanan = PengajuanLayanan::with('dataKelahiran')->where('jenis_pengajuan', "kelahiran")->whereBetween('tanggal_pengajuan', [$tgl_awal, $tgl_akhir])->get();
        return view('laporan.cetak_kelahiran', [
            'title' => 'Cetak data kelahiran',
            'tanggal' => date('d-m-Y', strtotime($tgl_awal)) . ' s.d ' . date('d-m-Y', strtotime($tgl_akhir)),
            'data' => $pelayanan    
        ]);
    }


    public function indexKematian(){
        return view('laporan.kematian', [
            'title' => 'Laporan kematian',
            'menu' => 'laporan',
            'submenu' => 'kematian',
        ]);
    }

    public function cekKematian(Request $request){
        $tgl_awal = $request->tgl_awal;
        $tgl_akhir = $request->tgl_akhir;

        $pelayanan = PengajuanLayanan::with('dataKematian')->where('jenis_pengajuan', "kematian")->whereBetween('tanggal_pengajuan', [$tgl_awal, $tgl_akhir])->get();
        if (count($pelayanan) > 0) {
            return response()->json(['statusCode' => 200, 'data' => $pelayanan]);
        } else {
            return response()->json(['statusCode' => 400, 'message' => 'Data tidak ditemukan'], 400);
        }
    }

    public function cetakKematian(Request $request){
        $tgl_awal = $request->tgl_awal;
        $tgl_akhir = $request->tgl_akhir;

        $pelayanan = PengajuanLayanan::with('dataKematian')->where('jenis_pengajuan', "kematian")->whereBetween('tanggal_pengajuan', [$tgl_awal, $tgl_akhir])->get();
        return view('laporan.cetak_kematian', [
            'title' => 'Cetak data kematian',
            'tanggal' => date('d-m-Y', strtotime($tgl_awal)) . ' s.d ' . date('d-m-Y', strtotime($tgl_akhir)),
            'data' => $pelayanan    
        ]);
    }
}
