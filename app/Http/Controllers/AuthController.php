<?php

namespace App\Http\Controllers;

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
        // dd($request);
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            // return redirect()->intended('/home');
            return response()->json(['message' => 'Berhasil login']);
        }
        // return back()->with('loginError', 'Login Failed!!!');
        return response()->json(['message' => 'Gagal melakukan authentikasi'], 404);
    }

    public function store(Request $request)
    {
        // return request()->all();
        $vaslidatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5|max:255'
        ]);

        $user = new User();
        $user->id = intval((microtime(true) * 10000));
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = "user";
        $user->status = 'inactive';
        $user->save();
        return redirect('login')->with('success', 'Registrasi berhasil!! silahkan login');
    }

    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/');
    }
}
