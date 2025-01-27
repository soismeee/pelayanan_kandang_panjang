<?php

namespace App\Http\Controllers;

use App\Models\DataKelahiran;
use App\Models\DataKematian;
use App\Models\Pengguna;
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
        $pengguna = Pengguna::where('user_id', auth()->user()->id)->first();

        $columns = ['pengajuan_id', 'pengguna_id', 'jenis_pengajuan', 'nama_pelapor', 'nik_pelapor', 'tanggal_pengajuan', 'status', 'dokumen'];
        $orderBy = $columns[request()->input("order.0.column")];
        $data = PengajuanLayanan::with(['dataKematian', 'dataKelahiran'])->select('pengajuan_id', 'pengguna_id', 'jenis_pengajuan', 'nama_pelapor', 'nik_pelapor', 'tanggal_pengajuan', 'status', 'dokumen')->where('pengguna_id', $pengguna->pengguna_id);

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

    public function formKematian(){
        if (!auth()->user()->pengguna) {
            return redirect('/home');
        }else{
            return view('pengajuan.form_kematian', [
                'title' => 'Pengajuan Kematian',
                'menu' => 'Pengajuan',
                'submenu' => 'Pengajuan'
            ]);
        }
    }

    public function formKelahiran(){
        if (!auth()->user()->pengguna) {
            return redirect('/home');
        }else{
            return view('pengajuan.form_kelahiran', [
                'title' => 'Pengajuan Kelahiran',
                'menu' => 'Pengajuan',
                'submenu' => 'Pengajuan'
            ]);
        }
    }

    public function kodePengajuan()
    {
        $jmldatahariini = PengajuanLayanan::selectRaw('LPAD(CONVERT(COUNT("id") + 1, char(8)) , 3,"0") as kodes')->where('tanggal_pengajuan', date('Y-m-d'))->first();
        return "KP" . date("ymd") . $jmldatahariini['kodes'];
    }

    public function store(Request $request){
        
        if ($request->jenis_pengajuan == "kelahiran") {
            $request->validate(
                [
                    'nama_pelapor' => 'required',
                    'nik_pelapor' => 'required|min:15',
                    'tgl_lahir_pelapor' => 'required',
                    'no_hp' => 'required',
                    'pekerjaan_pelapor' => 'required',
                    'alamat_pelapor' => 'required',
                    'jenis_pengajuan' => 'required',
                    
                    'nama_saksi1' => 'required',
                    'nik_saksi1' => 'required|min:15',
                    'tgl_lahir_saksi1' => 'required',
                    'pekerjaan_saksi1' => 'required',
                    'alamat_saksi1' => 'required',

                    'nama_saksi2' => 'required',
                    'nik_saksi2' => 'required|min:15',
                    'tgl_lahir_saksi2' => 'required',
                    'pekerjaan_saksi2' => 'required',
                    'alamat_saksi2' => 'required',


                    'nama_bayi' => 'required',
                    'kelahiran_ke' => 'required',
                    'penolong_kelahiran' => 'required',
                    'jenis_kelamin' => 'required',
                    'jenis_kelahiran' => 'required',
                    'berat_bayi' => 'required',
                    'panjang_bayi' => 'required',
                    'tanggal_lahir' => 'required',
                    'waktu_lahir' => 'required',
                    'tempat_dilahirkan' => 'required',
                    'tempat_lahir' => 'required',

                    'nama_kepala_keluarga' => 'required',
                    'nomor_kk' => 'required',
                    'tgl_pencatatan_pernikahan' => 'required',
                    
                    'nama_ibu' => 'required',
                    'nik_ibu' => 'required|min:15',
                    'tgl_lahir_ibu' => 'required',
                    'pekerjaan_ibu' => 'required',
                    'alamat_ibu' => 'required',
                    'kewarnegaraan_ibu' => 'required',
                    'ktp_ibu' => 'required|mimes:jpeg,jpg,png|max:2048',
                    'akta_nikah' => 'required|mimes:jpeg,jpg,png|max:2048',
                    'berkas_kk' => 'required|mimes:jpeg,jpg,png|max:2048',
                    'surat_ket_rs' => 'required|mimes:jpeg,jpg,png|max:2048',
                    'surat_pengantar_rt' => 'required|mimes:jpeg,jpg,png|max:2048',
                    'ktp_pelapor' => 'required|mimes:jpeg,jpg,png|max:2048',
                    'ktp_saksi1' => 'required|mimes:jpeg,jpg,png|max:2048',
                    'ktp_saksi2' => 'required|mimes:jpeg,jpg,png|max:2048',
                ],
                [
                    'nama_pelapor.required' => 'Nama pelapor harus diisi',
                    'nik_pelapor.required' => 'NIK pelapor harus diisi',
                    'nik_pelapor.min' => 'NIK pelapor harus 16 karakter',
                    'nama_pelapor.regex' => 'Format NIK pelapor salah',
                    'nik_pelapor.unique' => 'NIK pelapor sudah terdaftar',
                    'tgl_lahir_pelapor.required' => 'Tanggal lahir pelapor harus diisi',
                    'no_hp.required' => 'No HP pelapor harus diisi',
                    'pekerjaan_pelapor.required' => 'Pekerjaan pelapor harus diisi',
                    'alamat_pelapor.required' => 'Alamat pelapor harus diisi',

                    'nama_saksi1.required' => 'Nama saksi 1 harus diisi',
                    'nik_saksi1.required' => 'NIK saksi 1 harus diisi',
                    'nik_saksi1.min' => 'NIK saksi 1 harus 16 karakter',
                    'tgl_lahir_saksi1.required' => 'Tanggal lahir saksi 1 harus diisi',
                    'pekerjaan_saksi1.required' => 'Pekerjaan saksi 1 harus diisi',
                    'alamat_saksi1.required' => 'Alamat saksi 1 harus diisi',

                    'nama_saksi2.required' => 'Nama saksi 2 harus diisi',
                    'nik_saksi2.required' => 'NIK saksi 2 harus diisi',
                    'nik_saksi2.min' => 'NIK saksi 2 harus 16 karakter',
                    'tgl_lahir_saksi2.required' => 'Tanggal lahir saksi 2 harus diisi',
                    'pekerjaan_saksi2.required' => 'Pekerjaan saksi 2 harus diisi',
                    'alamat_saksi2.required' => 'Alamat saksi 2 harus diisi',

                    'nama_bayi.required' => 'Nama bayi harus diisi',
                    'kelahiran_ke.required' => 'Kelahiran ke harus diisi',
                    'penolong_kelahiran.required' => 'Penolong kelahiran harus diisi',
                    'jenis_kelamin.required' => 'Jenis kelamin bayi harus diisi',
                    'berat_bayi.required' => 'Berat bayi harus diisi',
                    'panjang_bayi.required' => 'Panjang bayi harus diisi',
                    'tanggal_lahir.required' => 'Tanggal lahir bayi harus diisi',
                    'waktu_lahir.required' => 'Waktu lahir bayi harus diisi',
                    'tempat_dilahirkan.required' => 'Tempat dilahirkan bayi harus diisi',
                    'tempat_lahir.required' => 'Tempat lahir bayi harus diisi',
                    'nama_kepala_keluarga.required' => 'Nama kepala keluarga harus diisi',
                    'nomor_kk.required' => 'Nomor KK harus diisi',
                    'tgl_pencatatan_pernikahan.required' => 'Tanggal pencatatan pernikahan harus diisi',
                    'nama_ibu.required' => 'Nama ibu harus diisi',
                    'nik_ibu.required' => 'NIK ibu harus diisi',
                    'nik_ibu.min' => 'NIK ibu harus 16 karakter',
                    'tgl_lahir_ibu.required' => 'Tanggal lahir ibu harus diisi',
                    'pekerjaan_ibu.required' => 'Pekerjaan ibu harus diisi',
                    'alamat_ibu.required' => 'Alamat ibu harus diisi',
                    'kewarnegaraan_ibu.required' => 'Kewarnegaraan ibu harus diisi',
                    'ktp_ibu' => 'Berkas hanya boleh gambar dan tidak lebih dari 2MB',
                    'akta_nikah' => 'Berkas hanya boleh gambar dan tidak lebih dari 2MB',
                    'berkas_kk' => 'Berkas hanya boleh gambar dan tidak lebih dari 2MB',
                    'surat_ket_rs' => 'Berkas hanya boleh gambar dan tidak lebih dari 2MB',
                    'surat_pengantar_rt' => 'Berkas hanya boleh gambar dan tidak lebih dari 2MB',
                    'ktp_pelapor' => 'Berkas hanya boleh gambar dan tidak lebih dari 2MB',
                    'ktp_saksi1' => 'Berkas hanya boleh gambar dan tidak lebih dari 2MB',
                    'ktp_saksi2' => 'Berkas hanya boleh gambar dan tidak lebih dari 2MB',

                ]
            );
        } else {
            $request->validate(
                [
                    'nama_pelapor' => 'required',
                    'nik_pelapor' => 'required|min:15',
                    'tgl_lahir_pelapor' => 'required',
                    'no_hp' => 'required',
                    'pekerjaan_pelapor' => 'required',
                    'alamat_pelapor' => 'required',
                    'jenis_pengajuan' => 'required',

                    'nama_saksi1' => 'required',
                    'nik_saksi1' => 'required|min:15',
                    'tgl_lahir_saksi1' => 'required',
                    'pekerjaan_saksi1' => 'required',
                    'alamat_saksi1' => 'required',

                    'nama_saksi2' => 'required',
                    'nik_saksi2' => 'required|min:15',
                    'tgl_lahir_saksi2' => 'required',
                    'pekerjaan_saksi2' => 'required',
                    'alamat_saksi2' => 'required',

                    'nama_kepala_keluarga' => 'required',
                    'nomor_keluarga' => 'required',
                    'nama_alm' => 'required',
                    'nik' => 'required',
                    'jenis_kelamin' => 'required',
                    'tanggal_lahir' => 'required',
                    'tempat_lahir' => 'required',
                    'agama' => 'required',
                    'pekerjaan' => 'required',
                    'alamat' => 'required',
                    'tanggal_kematian' => 'required',
                    'waktu_kematian' => 'required',
                    'tempat_kematian' => 'required',
                    'sebab_kematian' => 'required',
                    'yang_menerangkan' => 'required',

                    'berkas_ktp' => 'required|mimes:jpeg,jpg,png|max:2048',
                    'berkas_akta' => 'required|mimes:jpeg,jpg,png|max:2048',
                    'berkas_kk' => 'required|mimes:jpeg,jpg,png|max:2048',
                    'surat_ket_rs' => 'required|mimes:jpeg,jpg,png|max:2048',
                    'surat_pengantar_rt' => 'required|mimes:jpeg,jpg,png|max:2048',
                    'ktp_pelapor' => 'required|mimes:jpeg,jpg,png|max:2048',
                    'ktp_saksi1' => 'required|mimes:jpeg,jpg,png|max:2048',
                    'ktp_saksi2' => 'required|mimes:jpeg,jpg,png|max:2048',
                ],
                [
                    'nama_pelapor.required' => 'Nama pelapor harus diisi',
                    'nik_pelapor.required' => 'NIK pelapor harus diisi',
                    'nik_pelapor.min' => 'NIK pelapor harus 15 karakter',
                    'tgl_lahir_pelapor.required' => 'Tanggal lahir pelapor harus diisi',
                    'no_hp.required' => 'No HP pelapor harus diisi',
                    'pekerjaan_pelapor.required' => 'Pekerjaan pelapor harus diisi',
                    'alamat_pelapor.required' => 'Alamat pelapor harus diisi',

                    'nama_saksi1.required' => 'Nama saksi 1 harus diisi',
                    'nik_saksi1.required' => 'NIK saksi 1 harus diisi',
                    'nik_saksi1.min' => 'NIK saksi 1 harus 15 karakter',
                    'tgl_lahir_saksi1.required' => 'Tanggal lahir saksi 1 harus diisi',
                    'pekerjaan_saksi1.required' => 'Pekerjaan saksi 1 harus diisi',
                    'alamat_saksi1.required' => 'Alamat saksi 1 harus diisi',

                    'nama_saksi2.required' => 'Nama saksi 2 harus diisi',
                    'nik_saksi2.required' => 'NIK saksi 2 harus diisi',
                    'nik_saksi2.min' => 'NIK saksi 2 harus 15 karakter',
                    'tgl_lahir_saksi2.required' => 'Tanggal lahir saksi 2 harus diisi',
                    'pekerjaan_saksi2.required' => 'Pekerjaan saksi 2 harus diisi',
                    'alamat_saksi2.required' => 'Alamat saksi 2 harus diisi',
                    'nama_kepala_keluarga.required' => 'Nama kepala keluarga harus diisi',
                    'nomor_keluarga.required' => 'Nomor KK harus diisi',
                    'nama_alm.required' => 'Alamat keluarga harus diisi',
                    'nik.required' => 'NIK harus diisi',
                    'jenis_kelamin.required' => 'Jenis kelamin harus diisi',
                    'tanggal_lahir.required' => 'Tanggal lahir harus diisi',
                    'tempat_lahir.required' => 'Tempat lahir harus diisi',
                    'agama.required' => 'Agama harus diisi',
                    'pekerjaan.required' => 'Pekerjaan harus diisi',
                    'alamat.required' => 'Alamat harus diisi',
                    'tanggal_kematian.required' => 'Tanggal kematian harus diisi',
                    'waktu_kematian.required' => 'Waktu kematian harus diisi',
                    'tempat_kematian.required' => 'Tempat kematian harus diisi',
                    'sebab_kematian.required' => 'Sebab kematian harus diisi',
                    'yang_menerangkan.required' => 'Yang menerangkan harus diisi',
                    'berkas_ktp.required' => 'Berkas KTP harus diisi',
                    'berkas_akta.required' => 'Berkas Akta Kelahiran harus diisi',
                    'berkas_kk.required' => 'Berkas KK harus diisi',
                    'berkas_ktp.mimes' => 'Berkas KTP hanya boleh gambar',
                    'ktp_pelapor' => 'Berkas hanya boleh gambar dan tidak lebih dari 2MB',
                    'ktp_saksi1' => 'Berkas hanya boleh gambar dan tidak lebih dari 2MB',
                    'ktp_saksi2' => 'Berkas hanya boleh gambar dan tidak lebih dari 2MB',
                ]
            );
        }
        
        
        $pengajuan = new PengajuanLayanan();
        $pengajuan->pengajuan_id = $this->kodePengajuan();
        $pengajuan->pengguna_id = auth()->user()->pengguna->pengguna_id;
        $pengajuan->nama_pelapor = $request->nama_pelapor;
        $pengajuan->nik_pelapor = $request->nik_pelapor;
        $pengajuan->tgl_lahir_pelapor = $request->tgl_lahir_pelapor;
        $pengajuan->no_hp = $request->no_hp;
        $pengajuan->pekerjaan_pelapor = $request->pekerjaan_pelapor;
        $pengajuan->tanggal_pengajuan = date('Y-m-d');
        $pengajuan->alamat_pelapor = $request->alamat_pelapor;
        $pengajuan->jenis_pengajuan = $request->jenis_pengajuan;
        
        $pengajuan->nama_saksi1 = $request->nama_saksi1;
        $pengajuan->nik_saksi1 = $request->nik_saksi1;
        $pengajuan->tgl_lahir_saksi1 = $request->tgl_lahir_saksi1;
        $pengajuan->pekerjaan_saksi1 = $request->pekerjaan_saksi1;
        $pengajuan->alamat_saksi1 = $request->alamat_saksi1;

        $pengajuan->nama_saksi2 = $request->nama_saksi2;
        $pengajuan->nik_saksi2 = $request->nik_saksi2;
        $pengajuan->tgl_lahir_saksi2 = $request->tgl_lahir_saksi2;
        $pengajuan->pekerjaan_saksi2 = $request->pekerjaan_saksi2;
        $pengajuan->alamat_saksi2 = $request->alamat_saksi2;

        $ktp_pelapor = $request->file('ktp_pelapor');
        if ($ktp_pelapor !== null) {
            $filename_ktp_pelapor = "ktp_pelapor" . "_" .time() ."ktp_pelapor". '.' . $ktp_pelapor->getClientOriginalExtension();

            $ktp_pelapor->move(public_path('Pengajuan/pengajuan'), $filename_ktp_pelapor);
            $pengajuan->ktp_pelapor = $filename_ktp_pelapor;
        }
        
        $ktp_saksi1 = $request->file('ktp_saksi1');
        if ($ktp_saksi1 !== null) {
            $filename_ktp_saksi1 = "ktp_saksi1" . "_" .time() ."ktp_saksi1". '.' . $ktp_saksi1->getClientOriginalExtension();

            $ktp_saksi1->move(public_path('Pengajuan/pelayanan'), $filename_ktp_saksi1);
            $pengajuan->ktp_saksi1 = $filename_ktp_saksi1;
        }
        $ktp_saksi2 = $request->file('ktp_saksi2');
        if ($ktp_saksi2 !== null) {
            $filename_ktp_saksi2 = "ktp_saksi2" . "_" .time() ."ktp_saksi2". '.' . $ktp_saksi2->getClientOriginalExtension();

            $ktp_saksi2->move(public_path('Pengajuan/pelayanan'), $filename_ktp_saksi2);
            $pengajuan->ktp_saksi2 = $filename_ktp_saksi2;
        }

        $pengajuan->save();

        if ($request->jenis_pengajuan == "kelahiran") {
            $kelahiran = new DataKelahiran();
            $kelahiran->pengajuan_id = $pengajuan->pengajuan_id;
            $kelahiran->nama_bayi = $request->nama_bayi;
            $kelahiran->kelahiran_ke = $request->kelahiran_ke;
            $kelahiran->penolong_kelahiran = $request->penolong_kelahiran;
            $kelahiran->jenis_kelahiran = $request->jenis_kelahiran;
            $kelahiran->berat_bayi = $request->berat_bayi;
            $kelahiran->panjang_bayi = $request->panjang_bayi;
            $kelahiran->jenis_kelamin = $request->jenis_kelamin;
            $kelahiran->tanggal_lahir = $request->tanggal_lahir;
            $kelahiran->waktu_lahir = $request->waktu_lahir;
            $kelahiran->tempat_dilahirkan = $request->tempat_dilahirkan;
            $kelahiran->tempat_lahir = $request->tempat_lahir;


            $kelahiran->nama_kepala_keluarga = $request->nama_kepala_keluarga;
            $kelahiran->nomor_kk = $request->nomor_kk;
            $kelahiran->tgl_pencatatan_pernikahan = $request->tgl_pencatatan_pernikahan;
            
            $kelahiran->nik_ayah = $request->nik_ayah;
            $kelahiran->nama_ayah = $request->nama_ayah;
            $kelahiran->tgl_lahir_ayah = $request->tgl_lahir_ayah;
            $kelahiran->pekerjaan_ayah = $request->pekerjaan_ayah;
            $kelahiran->alamat_ayah = $request->alamat_ayah;
            $kelahiran->kewarnegaraan_ayah = $request->kewarnegaraan_ayah;


            $kelahiran->nik_ibu = $request->nik_ibu;
            $kelahiran->nama_ibu = $request->nama_ibu;
            $kelahiran->tgl_lahir_ibu = $request->tgl_lahir_ibu;
            $kelahiran->pekerjaan_ibu = $request->pekerjaan_ibu;
            $kelahiran->alamat_ibu = $request->alamat_ibu;
            $kelahiran->kewarnegaraan_ibu = $request->kewarnegaraan_ibu;
            
            $ktp_ayah = $request->file('ktp_ayah');
            if ($ktp_ayah !== null) {
                $filename_ayah = $pengajuan->pengajuan_id . "_" .time() ."ktp_ayah". '.' . $ktp_ayah->getClientOriginalExtension();
    
                $ktp_ayah->move(public_path('Pengajuan/kelahiran'), $filename_ayah);
                $kelahiran->ktp_ayah = $filename_ayah;
            }

            $ktp_ibu = $request->file('ktp_ibu');
            $filename_ibu = $pengajuan->pengajuan_id . "_" .time() . "ktp_ibu" .'.' . $ktp_ibu->getClientOriginalExtension();
            $ktp_ibu->move(public_path('Pengajuan/kelahiran'), $filename_ibu);
            $kelahiran->ktp_ibu = $filename_ibu;

            $akta_nikah = $request->file('akta_nikah');
            $filename_ibu = $pengajuan->pengajuan_id . "_" .time() . "akta_nikah" .'.' . $akta_nikah->getClientOriginalExtension();
            $akta_nikah->move(public_path('Pengajuan/kelahiran'), $filename_ibu);
            $kelahiran->akta_nikah = $filename_ibu;

            $kk = $request->file('berkas_kk');
            $filename_kk = $pengajuan->pengajuan_id . "_" .time(). "berkas_kk". '.' . $kk->getClientOriginalExtension();
            $kk->move(public_path('Pengajuan/kelahiran'), $filename_kk);
            $kelahiran->berkas_kk = $filename_kk;

            $rt = $request->file('surat_pengantar_rt');
            $filename_rt = $pengajuan->pengajuan_id . "_" .time(). "surat_pengantar_rt". '.' . $rt->getClientOriginalExtension();
            $rt->move(public_path('Pengajuan/kelahiran'), $filename_rt);
            $kelahiran->surat_pengantar_rt = $filename_rt;

            $rs = $request->file('surat_ket_rs');
            $filename_rs = $pengajuan->pengajuan_id . "_" .time(). "surat_ket_rs". '.' . $rs->getClientOriginalExtension();
            $rs->move(public_path('Pengajuan/kelahiran'), $filename_rs);
            $kelahiran->surat_ket_rs = $filename_rs;

            $kelahiran->save();
        } 
        else {
            $kematian = new DataKematian();
            $kematian->pengajuan_id = $pengajuan->pengajuan_id;
            $kematian->nama_alm = $request->nama_alm;
            $kematian->nik = $request->nik;
            $kematian->jenis_kelamin = $request->jenis_kelamin;
            $kematian->tanggal_lahir = $request->tanggal_lahir;
            $kematian->tempat_lahir = $request->tempat_lahir;
            $kematian->agama = $request->agama;
            $kematian->pekerjaan = $request->pekerjaan;
            $kematian->alamat = $request->alamat;
            $kematian->tanggal_kematian = $request->tanggal_kematian;
            $kematian->waktu_kematian = $request->waktu_kematian;
            $kematian->tempat_kematian = $request->tempat_kematian;
            $kematian->sebab_kematian = $request->sebab_kematian;
            $kematian->yang_menerangkan = $request->yang_menerangkan;
            
            $kematian->nama_kepala_keluarga = $request->nama_kepala_keluarga;
            $kematian->nomor_keluarga = $request->nomor_keluarga;
            
            $kematian->nik_ayah = $request->nik_ayah;
            $kematian->nama_ayah = $request->nama_ayah;
            $kematian->tgl_lahir_ayah = $request->tgl_lahir_ayah;
            $kematian->pekerjaan_ayah = $request->pekerjaan_ayah;
            $kematian->alamat_ayah = $request->alamat_ayah;


            $kematian->nik_ibu = $request->nik_ibu;
            $kematian->nama_ibu = $request->nama_ibu;
            $kematian->tgl_lahir_ibu = $request->tgl_lahir_ibu;
            $kematian->pekerjaan_ibu = $request->pekerjaan_ibu;
            $kematian->alamat_ibu = $request->alamat_ibu;

            $ktp_ayah = $request->file('ktp_ayah');
            if ($ktp_ayah !== null) {
                $filename_ayah = $pengajuan->pengajuan_id . "_" .time() ."ktp_ayah". '.' . $ktp_ayah->getClientOriginalExtension();
    
                $ktp_ayah->move(public_path('Pengajuan/kematian'), $filename_ayah);
                $kematian->ktp_ayah = $filename_ayah;
            }

            $ktp_ibu = $request->file('ktp_ibu');
            $filename_ibu = $pengajuan->pengajuan_id . "_" .time() . "ktp_ibu" .'.' . $ktp_ibu->getClientOriginalExtension();
            $ktp_ibu->move(public_path('Pengajuan/kematian'), $filename_ibu);
            $kematian->ktp_ibu = $filename_ibu;
            
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

            $rt = $request->file('surat_pengantar_rt');
            $filename_rt = $pengajuan->pengajuan_id . "_" .time(). "surat_pengantar_rt". '.' . $rt->getClientOriginalExtension();
            $rt->move(public_path('Pengajuan/kematian'), $filename_rt);
            $kematian->surat_pengantar_rt = $filename_rt;

            $rs = $request->file('surat_ket_rs');
            $filename_rs = $pengajuan->pengajuan_id . "_" .time(). "surat_ket_rs". '.' . $rs->getClientOriginalExtension();
            $rs->move(public_path('Pengajuan/kematian'), $filename_rs);
            $kematian->surat_ket_rs = $filename_rs;
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
        
        if ($request->status == "selesai") {
            $pengajuan->read_pengguna = "0";
        }

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
        $columns = ['pengajuan_id', 'pengguna_id', 'jenis_pengajuan', 'nama_pelapor', 'nik_pelapor', 'tanggal_pengajuan', 'status'];
        $orderBy = $columns[request()->input("order.0.column")];
        $data = PengajuanLayanan::with(['dataKelahiran'])->select('pengajuan_id', 'pengguna_id', 'jenis_pengajuan', 'nama_pelapor', 'nik_pelapor', 'tanggal_pengajuan', 'status')->where('jenis_pengajuan', "kelahiran")->where('status', '!=' ,'selesai');

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
    
    public function showBerkasKelahiran($id){
        return view('pengajuan.kelahiran.berkas', [
            'title' => "Lihat berkas kelahiran",
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
        $columns = ['pengajuan_id', 'pengguna_id', 'jenis_pengajuan', 'nama_pelapor', 'nik_pelapor', 'tanggal_pengajuan', 'status', 'dokumen', 'updated_at'];
        $orderBy = $columns[request()->input("order.0.column")];
        $data = PengajuanLayanan::with(['dataKelahiran'])->select('pengajuan_id', 'pengguna_id', 'jenis_pengajuan', 'nama_pelapor', 'nik_pelapor', 'tanggal_pengajuan', 'status', 'dokumen', 'updated_at')->where('jenis_pengajuan', "kelahiran")->where('status', 'selesai');

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

    ##############################################################################################
    // master kematian
    public function indexKematian(){
        return view('pengajuan.kematian.index', [
            'title' => 'Data kematian',
            'menu' => 'kematian',
            'menu' => 'Data kematian',
        ]);
    }

    public function jsonKematian(){
        $columns = ['pengajuan_id', 'pengguna_id', 'jenis_pengajuan', 'nama_pelapor', 'nik_pelapor', 'tanggal_pengajuan', 'status'];
        $orderBy = $columns[request()->input("order.0.column")];
        $data = PengajuanLayanan::with(['dataKematian'])->select('pengajuan_id', 'pengguna_id', 'jenis_pengajuan', 'nama_pelapor', 'nik_pelapor', 'tanggal_pengajuan', 'status')->where('jenis_pengajuan', "kematian")->where('status', '!=' ,'selesai');

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
    
    public function showBerkasKematian($id){
        return view('pengajuan.kematian.berkas', [
            'title' => "Lihat berkas kematian",
            'menu' => 'kematian',
            'submenu' => 'Data kematian',
            'data' => PengajuanLayanan::with(['dataKematian'])->find($id)
        ]);
    }

    public function riwayatKematian(){
        return view('pengajuan.kematian.riwayat', [
            'title' => 'Riwayat kematian',
            'menu' => 'kematian',
            'menu' => 'Riwayat kematian',
        ]);
    }

    public function jsonRiwayatKematian(){
        $columns = ['pengajuan_id', 'pengguna_id', 'jenis_pengajuan', 'nama_pelapor', 'nik_pelapor', 'tanggal_pengajuan', 'dokumen', 'updated_at'];
        $orderBy = $columns[request()->input("order.0.column")];
        $data = PengajuanLayanan::with(['dataKematian'])->select('pengajuan_id', 'pengguna_id', 'jenis_pengajuan', 'nama_pelapor', 'nik_pelapor', 'tanggal_pengajuan', 'dokumen', 'updated_at')->where('jenis_pengajuan', "kematian")->where('status', 'selesai');

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

    public function createDocumentKelahiran($id){
        $data = PengajuanLayanan::with(['dataKelahiran'])->find($id);
        // return $data;
        return view('pengajuan.create_dokumen.kelahiran', [
            'title' => 'Buat dokumen kelahiran',
            'tanggal' => date('Y-m-d'),
            'nomor' => ' ',
            'data' => $data
        ]);
    }
    
    public function createDocumentKematian($id){
        $data = PengajuanLayanan::with(['dataKematian'])->find($id);
        // return $data;
        return view('pengajuan.create_dokumen.kematian', [
            'title' => 'Buat dokumen kematian',
            'tanggal' => date('Y-m-d'),
            'nomor' => ' ',
            'data' => $data
        ]);
    }
}
