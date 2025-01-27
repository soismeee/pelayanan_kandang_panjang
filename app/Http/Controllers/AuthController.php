<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login', [
            'title' => 'Login aplikasi'
        ]);
    }

    public function register(){
        return view('auth.register', [
            'title' => 'Daftar aplikasi'
        ]);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Cek apakah pengguna aktif
            if (auth()->user()->status != 'active') {
                Auth::logout();
    
                request()->session()->invalidate();
                request()->session()->regenerateToken();
    
                return response()->json(['message' => 'Akun Anda tidak aktif. Hubungi administrator untuk informasi lebih lanjut.'], 403);
            }

            if (auth()->user()->role == "user") {
                $pengguna = Pengguna::where('user_id', auth()->user()->id)->first();
        
                if ($pengguna) {
                    $request->session()->put('nama', $pengguna->nama);
                    $request->session()->put('no_telepon', $pengguna->no_telepon);
                    $request->session()->put('alamat', $pengguna->alamat);
                }
            }
        
            return response()->json([
                'message' => 'Berhasil login',
                'session' => $request->session()->all()
            ]);
        }
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return response()->json(['message' => 'Gagal melakukan authentikasi'], 404);
    }

    public function store(Request $request)
    {
        $vaslidatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:3|max:255'
        ]);

        $user = new User();
        $user->id = intval((microtime(true) * 10000));
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = "user";
        $user->status = 'inactive';
        $user->save();
        return response()->json(['statusCode' => 200, 'message' => 'Registrasi berhasil dilakukan']);
    }

    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/');
    }
}
