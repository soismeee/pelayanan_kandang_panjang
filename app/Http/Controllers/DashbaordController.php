<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\PengajuanLayanan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashbaordController extends Controller
{
    public function index(){
        $user = auth()->user();
        $pelanggan = Pelanggan::where('user_id', $user->id);
        if ($user->role == "user" && $pelanggan->count() == 0) {
            return view('home.first-page', [
                'title' => 'Lengkapi data',
            ]);
        } else {
            $data = [
                'pengguna' => User::count(),
                'pengajuan' => PengajuanLayanan::whereYear('tanggal_pengajuan', date('Y'))->count(),
                'kelahiran' => PengajuanLayanan::where('jenis_pengajuan', 'kelahiran')->whereYear('tanggal_pengajuan', date('Y'))->count(),
                'kematian' => PengajuanLayanan::where('jenis_pengajuan', 'kematian')->whereYear('tanggal_pengajuan', date('Y'))->count(),
            ];
            $pengajuan = PengajuanLayanan::where('status', 'pengajuan');
            $user_pelanggan = $pelanggan->first();
            if (auth()->user()->role == "user") {
                $pengajuan->where('pelanggan_id', $user_pelanggan->pelanggan_id);
            }
            return view('home.index', [
                'title' => 'Dashboard',
                'data' => $data,
                'pengajuan' => $pengajuan->get(),
                'user' => User::where('verified', "0")->get(),
            ]);
        }
    }

    public function store(Request $request){
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'no_telepon' => 'required'
        ]);

        $pelanggan = new Pelanggan();
        $pelanggan->pelanggan_id = intval((microtime(true) * 10000));
        $pelanggan->user_id = auth()->user()->id;
        $pelanggan->nama = $request->nama;
        $pelanggan->alamat = $request->alamat;
        $pelanggan->no_telepon = $request->no_telepon;
        $pelanggan->save();

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
