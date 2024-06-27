<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        // dd(Auth::attempt($credentials));

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Cek peran pengguna
            $user = Auth::user();
            if ($user->role == 'admin') {
                return redirect()->intended('halamanadmin');
            } elseif ($user->role == 'siswa') {
                return redirect()->intended('halamansiswa');
            } elseif ($user->role == 'guru') {
                return redirect()->intended('halamanguru');
            }

        }

        return back()->withErrors([
        'username' => 'Username atau Password yang anda masukkan salah.',
        ])->withInput($request->only('username'));

    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
