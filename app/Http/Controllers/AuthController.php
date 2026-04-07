<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
   //--- LOGIN SISWA ---
    public function showLoginSiswa() {
        return view('auth.login_siswa');
    }

    public function loginSiswa(Request $request) {
        $credentials = $request->validate([
            'nis' => 'required',
            'password' => 'required',
        ]);

        
        if (Auth::guard('siswa')->attempt($credentials)) {
            return redirect()->route('siswa.dashboard');
        }
        return back()->withErrors(['msg' => 'NIS atau Password salah!']);
    }

    // --- REGISTER SISWA ---
    public function showRegisterSiswa() {
        return view('auth.register_siswa');
    }

    public function registerSiswa(Request $request) {
        $request->validate([
            'nis' => 'required|unique:siswas',
            'password' => 'required|min:5',
            'kelas' => 'required'
        ]);

        Siswa::create([
            'nis' => $request->nis,
            'password' => Hash::make($request->password),
            'kelas' => $request->kelas
        ]);

        return redirect()->route('siswa.login')->with('success', 'Berhasil daftar, silakan login!');
    }

    // --- LOGIN ADMIN ---
    public function showLoginAdmin() {
        return view('auth.login_admin');
    }

    public function loginAdmin(Request $request) {
        $credentials = $request->only('username', 'password');

        if (Auth::guard('web')->attempt($credentials)) {
            return redirect()->route('admin.dashboard');
        }
        return back()->withErrors(['msg' => 'Admin Unauthorized!']);
    }

    public function logout() {
        Auth::logout();
        return redirect('/');
    }
}