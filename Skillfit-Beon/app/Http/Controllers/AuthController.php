<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Pengeluaran;
use App\Models\Penghuni;
use App\Models\RukunTetangga;
use App\Models\Rumah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function dashboard()
    {
        $rukuntetangga = RukunTetangga::first();
        $rumah = Rumah::all();
        $penghuni = Penghuni::all();
        $pembayaran = Pembayaran::all();
        $pengeluaran = Pengeluaran::all();
        return view('dashboard.index', compact('rukuntetangga', 'rumah', 'penghuni', 'pembayaran', 'pengeluaran'));
    }

    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Cobalah untuk login menggunakan Laravel's Auth
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Login berhasil
            return redirect()->route('dashboard')->with('success login', 'Login berhasil');
        }

        // Jika login gagal, kembali ke form login dengan error
        return redirect()->route('login')->with(['error login' => 'Email atau password salah']);
    }





    // public function login(Request $request)
    // {
    //     $credentials = $request->only('email', 'password');

    //     if (!$token = JWTAuth::attempt($credentials)) {
    //         $user = RukunTetangga::where('email', $request->email)->first();

    //         if (!$user) {
    //             return response()->json(['error' => 'Email tidak ditemukan!'], Response::HTTP_NOT_FOUND);
    //         }

    //         if (!Hash::check($request->password, $user->password)) {
    //             return response()->json(['error' => 'Password yang anda masukkan salah!'], Response::HTTP_UNAUTHORIZED);
    //         }

    //         return response()->json(['error' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
    //     }

    //     $user = $request->user();
    //     return response()->json(compact('user', 'token'));
    // }



    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

}
