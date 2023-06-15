<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\WebConfig;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;

class AuthOwnerController extends Controller
{
    function login()
    {
        $data['config'] = WebConfig::first();

        return view('owner.lock-screen', $data);
    }

    function loginProcess(Request $request)
    {
        $request->validate([
            'password' => 'required|min:8',
        ], [
            'password.required' => 'Kata sandi tidak boleh kosong',
            'password.min' => 'Panjang kata sandi minimal 8 karakter',
        ]);

        try {
            if (Auth::guard('owner')->attempt(['name' => WebConfig::first()->name, 'password' => $request->password])) {
                return response()->json([
                    'code' => 200,
                    'status' => 'Berhasil!',
                    'message' => 'Selamat datang kembali, kami akan mengantarmu ke dalam sistem.',
                ]);
            } else {
                return response()->json([
                    'code' => 300,
                    'status' => 'Gagal!',
                    'message' => 'Kami tidak mengenali anda.',
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                'code' => 500,
                'status' => 'Terjadi Kesalahan!',
                'message' => $e->getMessage(),
            ]);
        }
    }

    function logout()
    {
        Auth::guard('owner')->logout();

        return back();
    }
}
