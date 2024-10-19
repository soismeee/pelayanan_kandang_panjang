<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PenggunaController extends Controller
{
    public function index()
    {
        return view('pengguna.index', [
            'title' => 'Daftar Pengguna',
            'menu' => 'Pengguna',
            'submenu' => 'Pengguna',
        ]);
    }

    public function create()
    {
        return view('pengguna.create', [
            'title' => 'Tambah Pengguna',
            'menu' => 'Pengguna',
            'submenu' => 'Tambah pengguna',
        ]);
    }

    public function validation($request){

    }

    public function store(Request $request)
    {
        $this->validation($request);
        $user = new User();
        $user->id = intval((microtime(true) * 10000));
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->status = $request->status;
        $user->save();

        return redirect()->route('pengguna.index')->with('success', 'Pengguna berhasil ditambahkan');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        return view('pengguna.edit', [
            'title' => 'Tambah Pengguna',
            'menu' => 'Pengguna',
            'submenu' => 'Edit pengguna',
        ]);
    }

    public function update(Request $request, string $id)
    {
        $this->validation($request);
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password !== null) {
            $user->password = Hash::make($request->password);
        }
        $user->role = $request->role;
        $user->status = $request->status;
        $user->update();

        return redirect()->route('pengguna.index')->with('success', 'Pengguna berhasil diubah');
    }

    public function destroy(string $id)
    {
        User::find($id)->delete();
        return redirect()->route('pengguna.index')->with('success', 'Pengguna berhasil dihapus');
    }
}
