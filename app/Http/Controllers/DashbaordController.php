<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use App\Models\PengajuanLayanan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashbaordController extends Controller
{

    public function landingpage(){
        return view('home.landingpage', [
            'title' => 'Pelayanan Kandang Panjang',
        ]);
    }
    public function index(){
        
        $data = [
            'pengguna' => User::count(),
            'pengajuan' => PengajuanLayanan::whereYear('tanggal_pengajuan', date('Y'))->count(),
            'kelahiran' => PengajuanLayanan::where('jenis_pengajuan', 'kelahiran')->whereYear('tanggal_pengajuan', date('Y'))->count(),
            'kematian' => PengajuanLayanan::where('jenis_pengajuan', 'kematian')->whereYear('tanggal_pengajuan', date('Y'))->count(),
        ];
        
        $user = auth()->user();
        if ($user->role == "admin") {
            $pengajuan = PengajuanLayanan::where('status', 'pengajuan');
            return view('home.index', [
                'title' => 'Dashboard',
                'data' => $data,
                'pengajuan' => $pengajuan->get(),
                'user' => User::where('verified', "0")->get(),
            ]);
        } else {
            if (!$user->pengguna) {
                return view('home.first-page', [
                    'title' => 'Lengkapi data',
                ]);
            }else{
                $user_pengguna = Pengguna::where('user_id', $user->id)->first();
                $pengajuan = PengajuanLayanan::where('status', 'pengajuan')->where('pengguna_id', $user_pengguna->pengguna_id);
                
                return view('home.index', [
                    'title' => 'Dashboard',
                    'data' => $data,
                    'pengajuan' => $pengajuan->get(),
                    'user' => User::where('verified', "0")->get(),
                ]);
            }
        }
    }

    public function getNewUser(){
        $user = User::where('verified', "0");
        return response()->json(['statusCode' => 200, 'data' => $user->get(), 'jumlahPengguna' => $user->count()]);
    }

    public function verifiedPengguna($id){
        $user = User::find($id);
        $user->verified = "1";
        $user->update();
        return redirect('/pengguna');
    }

    public function getNotification(){
        $user = auth()->user();
        if ($user->role == "admin") {
            $pengajuan = PengajuanLayanan::where('status', 'pengajuan')->where('read_admin', "0");
            return response()->json(['statusCode' => 200, 'data' => $pengajuan->get(), 'jumlahNotifikasi' => $pengajuan->count()]);
        } else {
            if (!$user->pengguna) {
                return response()->json(['statusCode' => 200, 'data' => [], 'jumlahNotifikasi' => 0]);
            }else{
                $pengguna = Pengguna::where('user_id', $user->id)->first();
                $pengajuan = PengajuanLayanan::where('status', "!=" ,'pengajuan')->where('pengguna_id', $pengguna->pengguna_id)->where('read_pengguna', "0");
                return response()->json(['statusCode' => 200, 'data' => $pengajuan->get(), 'jumlahNotifikasi' => $pengajuan->count()]);
            }
        }
    }

    public function readNotification($id){
        $user = auth()->user();
        $pengajuan = PengajuanLayanan::find($id);
        if ($user->role == "admin") {
            if ($pengajuan->jenis_pengajuan == "kelahiran") {
                $link = "/pengajuan_kelahiran" . "/" . $pengajuan->pengajuan_id;
            } else {
                $link = "/pengajuan_kematian" . "/" . $pengajuan->pengajuan_id;
            }
            
            $pengajuan->read_admin = "1";
        } else {
            $link = "/pengajuan" . "/" . $pengajuan->pengajuan_id;
            $pengajuan->read_pengguna = "1";            
        }
        $pengajuan->update();
        return redirect($link);
    }

    public function store(Request $request){
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'no_telepon' => 'required'
        ]);

        $pengguna = new Pengguna();
        $pengguna->pengguna_id = intval((microtime(true) * 10000));
        $pengguna->user_id = auth()->user()->id;
        $pengguna->nama = $request->nama;
        $pengguna->alamat = $request->alamat;
        $pengguna->no_telepon = $request->no_telepon;
        $pengguna->save();

        $request->session()->put('nama', $pengguna->nama);
        $request->session()->put('alamat', $pengguna->alamat);

        return response()->json(['statusCode' => 200, 'message' => "Data berhasil disimpan"]);
    }

    public function update(Request $request, $id){
        $request->validate([
            'nama' => 'required',
            'email' => 'required',
        ]);
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password !== null) {
            $user->password = Hash::make($request->password);
        }
        $user->update();

        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/');
    }

    public function profil(){
        return view('home.profil', [
            'title' => 'Profil',
            'menu' => 'Profil',
            'submenu' => 'Profil',
        ]);
    }
}
