<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class DashbaordController extends Controller
{
    public function index(){
        $user = auth()->user();
        $pelanggan = Pelanggan::where('user_id', $user->id)->count();
        if ($user->role == "user" && $pelanggan == 0) {
            return view('home.first-page', [
                'title' => 'Lengkapi data',
            ]);
        } else {
            return view('home.index', [
                'title' => 'Dashboard',
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

        // return $pelanggan;
        return response()->json(['statusCode' => 200, 'message' => "Data berhasil disimpan"]);
    }
}
