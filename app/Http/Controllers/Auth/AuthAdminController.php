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
                    'message' => 'Halo Admin! kami akan mengantarmu ke dalam sistem.',
                ]);
            } else {
                return response()->json([
                    'code' => 300,
                    'status' => 'Gagal!',
                    'message' => 'Maaf, kami tidak mengenali anda.',
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
        $request->validate([
            'phone_number' => 'required',
        ]);

        try {
            $check = Admin::where('phone_number', $request->phone_number)->first();

            if (!empty($check)) {

                $checkOTP = DB::table('admin_password_resets')->where('phone_number', $request->phone_number)->first();

                if (empty($checkOTP)) {
                    $otp = rand(123456, 999999);
                    $token = Str::random(60);
                    DB::table('admin_password_resets')->insert([
                        'phone_number' => $request->phone_number,
                        'otp' => $otp,
                        'token' => $token,
                        'expired_at' => Carbon::now()->addMinutes(10)
                    ]);

                    $response = Http::asForm()->post('https://wa.srv2.wapanels.com/send-message', [
                        'api_key' => '0GxB0JURoGbukwlxok6sY9DKhnyjQTvy',
                        'sender' => '6285171121070',
                        'number' => $request->phone_number,
                        'message' => $otp . " adalah kode OTP anda untuk mengatur ulang kata sandi. Jangan berikan kode ini kepada siapapun. \n\n*Quixx - Rekan Pemenangan 2024*",
                    ]);

                    return response()->json([
                        'code' => 200,
                        'status' => 'OTP Terkirim!',
                        'message' => 'Mengarahkanmu ke halaman pemeriksaan OTP.',
                        'token' => $token,
                        'other' => $response,
                    ]);
                }

                return response()->json([
                    'code' => 200,
                    'status' => 'OTP Sudah Terkirim Sebelumnya!',
                    'message' => 'Mengarahkanmu ke halaman pemeriksaan OTP.',
                    'token' => $checkOTP->token,
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

    function otp(Request $request)
    {
        $request->validate([
            'otp' => 'required',
        ]);

        return response()->json('test');
    }

    function resetPassword(Request $request)
    {
        $check = DB::table('admin_password_resets')->where('token', $request->token)->exists();

        if ($check) {
            return view('admin.otp');
        }

        return abort(404);
    }

    function logout()
    {
        Auth::guard('admin')->logout();

        return redirect('login');
    }
}
