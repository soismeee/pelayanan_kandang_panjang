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
            'user' => User::all()
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

    public function json()
    {
        $columns = ['id', 'name', 'email', 'role', 'status'];
        $orderBy = $columns[request()->input("order.0.column")];
        $data = User::select('id', 'name', 'email', 'status', 'role');

        if (request()->input("search.value")) {
            $data = $data->where(function ($query) {
                $query->whereRaw('name like ? ', ['%' . request()->input("search.value") . '%'])
                    ->orWhereRaw('email like ? ', ['%' . request()->input("search.value") . '%'])
                    ->orWhereRaw('role like ? ', ['%' . request()->input("search.value") . '%'])
                    ->orWhereRaw('status like ? ', ['%' . request()->input("search.value") . '%']);
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

    public function validation($request){
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);
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
        $user->status = 'active';
        $user->save();

        return redirect()->route('pengguna.index')->with('success', 'Pengguna berhasil ditambahkan');
    }

    public function isActive(Request $request, $id){
        try {
            $user = User::findOrFail($id);
            $user->status = $request->status;
            $user->update();
            return response()->json(['status' => 200, 'message' => "Status pengguna berhasil diubah"]);
        } catch (\Throwable $th) {
            return response()->json(['status' => 400, 'message' => "Status pengguna gagal diubah"], 400);
        }
    }

    public function edit(string $id)
    {
        return view('pengguna.edit', [
            'title' => 'Tambah Pengguna',
            'menu' => 'Pengguna',
            'submenu' => 'Edit pengguna',
            'user' => User::find($id)
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
        $user->update();

        return redirect()->route('pengguna.index')->with('success', 'Pengguna berhasil diubah');
    }

    public function destroy(string $id)
    {
        User::find($id)->delete();
        return redirect()->route('pengguna.index')->with('success', 'Pengguna berhasil dihapus');
    }
}
