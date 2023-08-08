<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth/login', [
            'title' => 'Login'
        ]);
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $data = $request->only(['email', 'password']);

        $cek_aktif = DB::table('users')->where('email', $data['email'])->first();
        if ($cek_aktif != null) {
            if ($cek_aktif->is_active == 1) {
                if (Auth::attempt($data)) {
                    $request->session()->regenerate();
                    return redirect()->intended('/dashboard');
                }
            } else {
                return back()->with('error', 'Data Anda Tidak Aktif');
            }
        } else {
            return back()->with('error', 'Email atau Password Salah!!!');
        }
        return back()->with('error', 'Email atau Password Salah!!!');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect('/');
    }
}
