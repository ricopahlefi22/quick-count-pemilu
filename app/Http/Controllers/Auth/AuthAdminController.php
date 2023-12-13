<?php

namespace App\Http\Controllers\Auth;

use App\Models\Admin;
use App\Models\AdminPasswordReset;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Exception;

class AuthAdminController extends Controller
{
    function login()
    {
        return view('admin.login');
    }

    function loginProcess(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required|min:8',
        ], [
            'username.required' => 'Email tidak boleh kosong',
            'password.required' => 'Kata sandi tidak boleh kosong',
            'password.min' => 'Panjang kata sandi minimal 8 karakter',
        ]);

        try {
            if (Auth::guard('admin')->attempt(['username' => $request->username, 'password' => $request->password])) {
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
        return view('auth.forgot-password');
    }

    function forgotPasswordProcess(Request $request)
    {
        $request->validate([
            'phone_number' => 'required',
        ], [
            'phone_number.required' => 'Nomor handphone tidak boleh kosong',
        ]);

        try {
            $check = Admin::where('phone_number', $request->phone_number)->first();

            if (!empty($check)) {

                $checkOTP = AdminPasswordReset::where('phone_number', $request->phone_number)->first();

                if (empty($checkOTP)) {
                    $otp = rand(123456, 999999);
                    $token = Str::random(60);
                    AdminPasswordReset::insert([
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
        ], [
            'otp.required' => 'OTP tidak boleh kosong',
        ]);

        $checkOTP = AdminPasswordReset::where('token', $request->token)->first();

        if ($checkOTP->otp == $request->otp) {
            return response()->json([
                'code' => 200,
                'status' => 'Berhasil!',
                'message' => 'Ayo buat kata sandi baru!',
                'route' => '/reset-password?token=' . $checkOTP->token,
            ]);
        }

        return response()->json([
            'code' => 300,
            'status' => 'Gagal!',
            'message' => 'Kode OTP yang anda masukkan salah.',
        ]);
    }

    function resetPassword(Request $request)
    {
        $check = AdminPasswordReset::where('token', $request->token)->exists();

        if ($check) {
            $data['token'] = $request->token;
            return view('auth.reset-password', $data);
        }

        return abort(404);
    }

    function resetpasswordProcess(Request $request)
    {
        $request->validate([
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password',
        ], [
            'password.required' => 'Kata sandi tidak boleh kosong',
            'password.min' => 'Panjang kata sandi minimal 8 karakter',
            'confirm_password.required' => 'Konfirmasi tidak boleh kosong',
            'confirm_password.same' => 'Konfirmasi kata sandi tidak sesuai',
        ]);

        try {
            $check = AdminPasswordReset::where('token', $request->token)->first();
            if ($check) {
                $admin = Admin::where('phone_number', $check->phone_number)->first();
                $admin->password = bcrypt($request->password);
                $admin->save();
                $check->delete();

                return response()->json([
                    'code' => 200,
                    'status' => 'Berhasil!',
                    'message' => 'Kata sandi berhasil diperbaharui!',
                ]);
            }

            return response()->json([
                'code' => 300,
                'status' => 'Gagal!',
                'message' => 'Sesi Berakhir',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'code' => 300,
                'status' => 'Gagal!',
                'message' => $e->getMessage(),
            ]);
        }
    }

    function logout()
    {
        Auth::guard('admin')->logout();

        return redirect('login');
    }
}
