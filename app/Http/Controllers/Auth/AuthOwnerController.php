<?php

namespace App\Http\Controllers\Auth;

use App\Models\PasswordReset;
use App\Models\WebConfig;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Carbon\Carbon;
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
            $check = WebConfig::where('phone_number', $request->phone_number)->first();

            if (!empty($check)) {

                $checkOTP = PasswordReset::where('phone_number', $request->phone_number)->first();

                if (empty($checkOTP)) {
                    $otp = rand(123456, 999999);
                    $token = Str::random(60);

                    $response = Http::asForm()->post('https://wa.srv2.wapanels.com/send-message', [
                        'api_key' => WebConfig::first()->token,
                        'sender' => '6285171121070',
                        'number' => $request->phone_number,
                        'message' => $otp . " adalah kode OTP anda untuk mengatur ulang kata sandi. Jangan berikan kode ini kepada siapapun. \n\n*Quixx - Rekan Pemenangan 2024*",
                    ]);

                    if ($response['status'] == "success" && $response['data'][0]['status'] == "online") {
                        PasswordReset::insert([
                            'phone_number' => $request->phone_number,
                            'otp' => $otp,
                            'token' => $token,
                            'expired_at' => Carbon::now()->addMinutes(10)
                        ]);

                        return response()->json([
                            'code' => 200,
                            'status' => 'OTP Terkirim!',
                            'message' => 'Mengarahkanmu ke halaman pemeriksaan OTP.',
                        ]);
                    } else {
                        return response()->json([
                            'code' => 500,
                            'status' => 'Gagal Mengirim OTP!',
                            'message' => 'Terjadi kesalahan saat mengirim OTP, cobalah beberapa saat lagi atau hubungi developer.',
                        ]);
                    }
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
                'message' => 'Nomor handphone salah.',
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

        $checkOTP = PasswordReset::where('token', $request->token)->first();

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
        $check = PasswordReset::where('token', $request->token)->exists();

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
            $check = PasswordReset::where('token', $request->token)->first();
            if ($check) {
                $admin = WebConfig::first();
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
        Auth::guard('owner')->logout();

        return back();
    }
}
