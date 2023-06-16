<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class AuthAdminController extends Controller
{
    function login()
    {
        return view('admin.login');
    }

    function loginProcess(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ], [
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Mohon isi sesuai format email',
            'password.required' => 'Kata sandi tidak boleh kosong',
            'password.min' => 'Panjang kata sandi minimal 8 karakter',
        ]);

        try {
            if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
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

    function forgotPassword()
    {
        return view('admin.forgot-password');
    }

    function forgotPasswordProcess(Request $request)
    {
        try {
            $request->validate([
                'phone_number' => 'required',
            ]);

            $check = Admin::where('phone_number', $request->phone_number)->first();

            if (!empty($check)) {

                $checkOTP = DB::table('admin_password_resets')->where('phone_number', $request->phone_number)->first();

                if (empty($checkOTP)) {
                    DB::table('admin_password_resets')->insert([
                        'phone_number' => $request->phone_number,
                        'otp' => rand(123456, 999999),
                        'token' => Str::random(60),
                        'expired_at' => Carbon::now()->addMinutes(10)
                    ]);

                    $response = Http::asForm()->post('https://wa.srv2.watsap.id/send-message', [
                        'api_key' => 'b7cd27c8019ef0e860deb04f26ca192a8d2bb79f',
                        'sender' => '6285171121070',
                        'number' => $request->phone_number,
                        'message' => 'Hellooooo',
                    ]);

                    return response()->json([
                        'code' => 200,
                        'status' => 'OTP Terkirim!',
                        'message' => 'Mengarahkanmu ke halaman pemeriksaan OTP.',
                        'other' => $response,
                    ]);
                }

                return response()->json([
                    'code' => 200,
                    'status' => 'OTP Sudah Terkirim Sebelumnya!',
                    'message' => 'Mengarahkanmu ke halaman pemeriksaan OTP.',
                ]);
            }

            return response()->json([
                'code' => 500,
                'status' => 'Nomor Tidak Ditemukan!',
                'message' => 'Tidak ada admin yang menggunakan nomor ini.',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'code' => 500,
                'status' => 'Terjadi Masalah!',
                'message' => $e->getMessage(),
            ]);
        }
    }

    function logout()
    {
        Auth::guard('admin')->logout();

        return back();
    }
}
