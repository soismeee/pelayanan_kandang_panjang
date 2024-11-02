<?php

namespace App\Http\Controllers;

use App\Models\DataKelahiran;
use App\Models\DataKematian;
use App\Models\Pelanggan;
use App\Models\PengajuanLayanan;
use Illuminate\Http\Request;

class PelayananController extends Controller
{
    public function index(){
        return view('pengajuan.index', [
            'title' => 'Data Pengajuan',
            'menu' => 'Data Pengajuan',
            'submenu' => 'Data Pengajuan',
        ]);
    }

    public function json(){
        $pelanggan = Pelanggan::where('user_id', auth()->user()->id)->first();

        $columns = ['pengajuan_id', 'pelanggan_id', 'jenis_pengajuan', 'nama_pelapor', 'nik_pelapor', 'tanggal_pengajuan', 'status', 'dokumen'];
        $orderBy = $columns[request()->input("order.0.column")];
        $data = PengajuanLayanan::with(['dataKematian', 'dataKelahiran'])->select('pengajuan_id', 'pelanggan_id', 'jenis_pengajuan', 'nama_pelapor', 'nik_pelapor', 'tanggal_pengajuan', 'status', 'dokumen')->where('pelanggan_id', $pelanggan->pelanggan_id);

        if (request()->input("search.value")) {
            $data = $data->where(function ($query) {
                $query->whereRaw('jenis_pengajuan like ? ', ['%' . request()->input("search.value") . '%'])
                    ->orWhereRaw('nama_pelapor like ? ', ['%' . request()->input("search.value") . '%'])
                    ->orWhereRaw('nik_pelapor like ? ', ['%' . request()->input("search.value") . '%'])
                    ->orWhereRaw('tanggal_pengajuan like ? ', ['%' . request()->input("search.value") . '%']);
            });
        }

        $recordsFiltered = $data->get()->count();
        $data = $data->skip(request()->input('start'))->take(request()->input('length'))->orderBy($orderBy, request()->input("order.0.dir"))->get();
        $recordsTotal = $data->count();
        return response()->json([
            'draw' => request()->input('draw'),
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data
        ]);
    }

    public function create(){
        return view('pengajuan.create', [
            'title' => 'Pengajuan',
            'menu' => 'Pengajuan',
            'submenu' => 'Pengajuan'
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'nama_pelapor' => 'required',
            'nik_pelapor' => 'required',
            'alamat_pelapor' => 'required',
            'jenis_pengajuan' => 'required',
        ]);

        $pelanggan = Pelanggan::where('user_id', auth()->user()->id)->first();
        
        $pengajuan = new PengajuanLayanan();
        $pengajuan->pengajuan_id = intval((microtime(true) * 10000));
        $pengajuan->pelanggan_id = $pelanggan->pelanggan_id;
        $pengajuan->nama_pelapor = $request->nama_pelapor;
        $pengajuan->nik_pelapor = $request->nik_pelapor;
        $pengajuan->tanggal_pengajuan = date('Y-m-d');
        $pengajuan->alamat_pelapor = $request->alamat_pelapor;
        $pengajuan->jenis_pengajuan = $request->jenis_pengajuan;
        $pengajuan->save();

        if ($request->jenis_pengajuan == "kelahiran") {
            $kelahiran = new DataKelahiran();
            $kelahiran->nama_bayi = $request->nama_bayi;
            $kelahiran->pengajuan_id = $pengajuan->pengajuan_id;
            $kelahiran->jenis_kelamin = $request->jenis_kelamin;
            $kelahiran->tanggal_lahir = $request->tanggal_lahir;
            $kelahiran->tempat_lahir = $request->tempat_lahir;
            $kelahiran->nama_ayah = $request->nama_ayah;
            $kelahiran->nik_ayah = $request->nik_ayah;
            $kelahiran->nama_ibu = $request->nama_ibu;
            $kelahiran->nik_ibu = $request->nik_ibu;

            $ktp_ayah = $request->file('ktp_ayah');
            $filename = $pengajuan->pengajuan_id . "_" .time() ."ktp_ayah". '.' . $ktp_ayah->getClientOriginalExtension();

            $ktp_ayah->move(public_path('Pengajuan/kelahiran'), $filename);
            $kelahiran->ktp_ayah = $filename;

            $ktp_ibu = $request->file('ktp_ibu');
            $filename = $pengajuan->pengajuan_id . "_" .time() . "ktp_ibu" .'.' . $ktp_ibu->getClientOriginalExtension();
            $ktp_ibu->move(public_path('Pengajuan/kelahiran'), $filename);
            $kelahiran->ktp_ibu = $filename;

            $kk = $request->file('berkas_kk');
            $filename = $pengajuan->pengajuan_id . "_" .time(). "berkas_kk". '.' . $kk->getClientOriginalExtension();
            $kk->move(public_path('Pengajuan/kelahiran'), $filename);
            $kelahiran->berkas_kk = $filename;
            $kelahiran->save();
        }

        if ($request->jenis_pengajuan == "kematian") {
            $kematian = new DataKematian();
            $kematian->pengajuan_id = $pengajuan->pengajuan_id;
            $kematian->nama_alm = $request->nama_alm;
            $kematian->jenis_kelamin = $request->jenis_kelamin;
            $kematian->tanggal_kematian = $request->tanggal_kematian;
            $kematian->tempat_kematian = $request->tempat_kematian;

            $berkas_ktp = $request->file('berkas_ktp');
            $filename = $pengajuan->pengajuan_id . "_" .time() ."berkas_ktp". '.' . $berkas_ktp->getClientOriginalExtension();

            $berkas_ktp->move(public_path('Pengajuan/kematian'), $filename);
            $kematian->berkas_ktp = $filename;

            $berkas_akta = $request->file('berkas_akta');
            $filename = $pengajuan->pengajuan_id . "_" .time() . "berkas_akta" .'.' . $berkas_akta->getClientOriginalExtension();
            $berkas_akta->move(public_path('Pengajuan/kematian'), $filename);
            $kematian->berkas_akta = $filename;

            $kk = $request->file('berkas_kk');
            $filename = $pengajuan->pengajuan_id . "_" .time(). "berkas_kk". '.' . $kk->getClientOriginalExtension();
            $kk->move(public_path('Pengajuan/kematian'), $filename);
            $kematian->berkas_kk = $filename;
            $kematian->save();
        }

        return response()->json(['statusCode' => 200, 'message' => 'Pengajuan berhasil disimpan']);
    }

    public function show($id){
        $pengajuan = PengajuanLayanan::with(['dataKelahiran', 'DataKematian'])->find($id);
        return view('pengajuan.show', [
            'title' => "Lihat data pengajuan",
            'menu' => 'Pengajuan',
            'submenu' => 'Pengajuan',
            'data' => $pengajuan
        ]);
    }

    public function destroy($id){
        PengajuanLayanan::destroy($id);
        return response()->json(['statusCode' => 200,'message' => 'Pengajuan berhasil dihapus']);
    }

    public function updateInAdmin(Request $request, $id){
        $request->validate([
            'status' => 'required',
        ]);
        $pengajuan = PengajuanLayanan::find($id);
        $pengajuan->status = $request->status;
        $pengajuan->created_at = $request->created_at;

        if ($request->hasFile('dokumen')) {
            $file = $request->file('dokumen');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('Pengajuan/dokumen'), $filename);
            $pengajuan->dokumen = $filename;
        }
        $pengajuan->update();

        return redirect('/');
    }

    // master kelahiran
    public function indexKelahiran(){
        return view('pengajuan.kelahiran.index', [
            'title' => 'Data kelahiran',
            'menu' => 'kelahiran',
            'menu' => 'Data kelahiran',
        ]);
    }

    public function jsonKelahiran(){
        $columns = ['pengajuan_id', 'pelanggan_id', 'jenis_pengajuan', 'nama_pelapor', 'nik_pelapor', 'tanggal_pengajuan', 'status'];
        $orderBy = $columns[request()->input("order.0.column")];
        $data = PengajuanLayanan::with(['dataKelahiran'])->select('pengajuan_id', 'pelanggan_id', 'jenis_pengajuan', 'nama_pelapor', 'nik_pelapor', 'tanggal_pengajuan', 'status')->where('jenis_pengajuan', "kelahiran")->where('status', '!=' ,'selesai');

        if (request()->input("search.value")) {
            $data = $data->where(function ($query) {
                $query->whereRaw('jenis_pengajuan like ? ', ['%' . request()->input("search.value") . '%'])
                    ->orWhereRaw('nama_pelapor like ? ', ['%' . request()->input("search.value") . '%'])
                    ->orWhereRaw('nik_pelapor like ? ', ['%' . request()->input("search.value") . '%'])
                    ->orWhereRaw('tanggal_pengajuan like ? ', ['%' . request()->input("search.value") . '%']);
            });
        }

        $recordsFiltered = $data->get()->count();
        $data = $data->skip(request()->input('start'))->take(request()->input('length'))->orderBy($orderBy, request()->input("order.0.dir"))->get();
        $recordsTotal = $data->count();
        return response()->json([
            'draw' => request()->input('draw'),
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data
        ]);
    }

    public function createKelahiran(){
        return view('pengajuan.kelahiran.create', [
            'title' => 'Input kelahiran',
            'menu' => 'kelahiran',
            'menu' => 'Form kelahiran',
        ]);
    }

    public function showKelahiran($id){
        return view('pengajuan.kelahiran.show', [
            'title' => "Lihat data kelahiran",
            'menu' => 'kelahiran',
            'submenu' => 'Data kelahiran',
            'data' => PengajuanLayanan::with(['dataKelahiran'])->find($id)
        ]);
    }

    public function riwayatKelahiran(){
        return view('pengajuan.kelahiran.riwayat', [
            'title' => 'Riwayat kelahiran',
            'menu' => 'kelahiran',
            'menu' => 'Riwayat kelahiran',
        ]);
    }

    public function jsonRiwayatKelahiran(){
        $columns = ['pengajuan_id', 'pelanggan_id', 'jenis_pengajuan', 'nama_pelapor', 'nik_pelapor', 'tanggal_pengajuan', 'status', 'dokumen'];
        $orderBy = $columns[request()->input("order.0.column")];
        $data = PengajuanLayanan::with(['dataKelahiran'])->select('pengajuan_id', 'pelanggan_id', 'jenis_pengajuan', 'nama_pelapor', 'nik_pelapor', 'tanggal_pengajuan', 'status', 'dokumen')->where('jenis_pengajuan', "kelahiran")->where('status', 'selesai');

        if (request()->input("search.value")) {
            $data = $data->where(function ($query) {
                $query->whereRaw('jenis_pengajuan like ? ', ['%' . request()->input("search.value") . '%'])
                    ->orWhereRaw('nama_pelapor like ? ', ['%' . request()->input("search.value") . '%'])
                    ->orWhereRaw('nik_pelapor like ? ', ['%' . request()->input("search.value") . '%'])
                    ->orWhereRaw('tanggal_pengajuan like ? ', ['%' . request()->input("search.value") . '%']);
            });
        }

        $recordsFiltered = $data->get()->count();
        $data = $data->skip(request()->input('start'))->take(request()->input('length'))->orderBy($orderBy, request()->input("order.0.dir"))->get();
        $recordsTotal = $data->count();
        return response()->json([
            'draw' => request()->input('draw'),
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data
        ]);
    }

    // master kematian
    public function indexKematian(){
        return view('pengajuan.kematian.index', [
            'title' => 'Data kematian',
            'menu' => 'kematian',
            'menu' => 'Data kematian',
        ]);
    }

    public function jsonKematian(){
        $columns = ['pengajuan_id', 'pelanggan_id', 'jenis_pengajuan', 'nama_pelapor', 'nik_pelapor', 'tanggal_pengajuan', 'status'];
        $orderBy = $columns[request()->input("order.0.column")];
        $data = PengajuanLayanan::with(['dataKematian'])->select('pengajuan_id', 'pelanggan_id', 'jenis_pengajuan', 'nama_pelapor', 'nik_pelapor', 'tanggal_pengajuan', 'status')->where('jenis_pengajuan', "kematian")->where('status', '!=' ,'selesai');

        if (request()->input("search.value")) {
            $data = $data->where(function ($query) {
                $query->whereRaw('jenis_pengajuan like ? ', ['%' . request()->input("search.value") . '%'])
                    ->orWhereRaw('nama_pelapor like ? ', ['%' . request()->input("search.value") . '%'])
                    ->orWhereRaw('nik_pelapor like ? ', ['%' . request()->input("search.value") . '%'])
                    ->orWhereRaw('tanggal_pengajuan like ? ', ['%' . request()->input("search.value") . '%']);
            });
        }

        $recordsFiltered = $data->get()->count();
        $data = $data->skip(request()->input('start'))->take(request()->input('length'))->orderBy($orderBy, request()->input("order.0.dir"))->get();
        $recordsTotal = $data->count();
        return response()->json([
            'draw' => request()->input('draw'),
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data
        ]);
    }

    public function createKematian(){
        return view('pengajuan.kematian.create', [
            'title' => 'Input kelahiran',
            'menu' => 'kelahiran',
            'menu' => 'Form kelahiran',
        ]);
    }

    public function showKematian($id){
        return view('pengajuan.kematian.show', [
            'title' => "Lihat data kematian",
            'menu' => 'kematian',
            'submenu' => 'Data kematian',
            'data' => PengajuanLayanan::with(['dataKematian'])->find($id)
        ]);
    }

    public function riwayatKematian(){
        return view('pengajuan.kematian.riwayat', [
            'title' => 'Riwayat kelahiran',
            'menu' => 'kelahiran',
            'menu' => 'Riwayat kelahiran',
        ]);
    }

    public function jsonRiwayatKematian(){
        $columns = ['pengajuan_id', 'pelanggan_id', 'jenis_pengajuan', 'nama_pelapor', 'nik_pelapor', 'tanggal_pengajuan'];
        $orderBy = $columns[request()->input("order.0.column")];
        $data = PengajuanLayanan::with(['dataKelahiran'])->select('pengajuan_id', 'pelanggan_id', 'jenis_pengajuan', 'nama_pelapor', 'nik_pelapor', 'tanggal_pengajuan')->where('jenis_pengajuan', "kematian")->where('status', 'selesai');

        if (request()->input("search.value")) {
            $data = $data->where(function ($query) {
                $query->whereRaw('jenis_pengajuan like ? ', ['%' . request()->input("search.value") . '%'])
                    ->orWhereRaw('nama_pelapor like ? ', ['%' . request()->input("search.value") . '%'])
                    ->orWhereRaw('nik_pelapor like ? ', ['%' . request()->input("search.value") . '%'])
                    ->orWhereRaw('tanggal_pengajuan like ? ', ['%' . request()->input("search.value") . '%']);
            });
        }

        $recordsFiltered = $data->get()->count();
        $data = $data->skip(request()->input('start'))->take(request()->input('length'))->orderBy($orderBy, request()->input("order.0.dir"))->get();
        $recordsTotal = $data->count();
        return response()->json([
            'draw' => request()->input('draw'),
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data
        ]);
    }
}
