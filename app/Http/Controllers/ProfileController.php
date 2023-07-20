<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    function indexAdmin()
    {
        $data['title'] = 'Profil Saya';
        return view('profile.admin', $data);
    }

    function indexOwner()
    {
        // $data['title'] = 'Profil Saya';
        // return view('profile.owner', $data);
        $data['time'] = '2023/07/25';
        return view('errors.maintenance', $data);
    }

    function editProfileAdmin(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'email' => 'required|email',
                'phone_number' => 'required',
            ],
            [
                'name.required' => 'Mohon isi kolom nama',
                'email.required' => 'Mohon isi kolom email',
                'email.email' => 'Format email tidak sesuai',
                'phone_number.required' => 'Mohon isi kolom nomor handphone',
            ]
        );

        $photo = $request->hidden_photo;

        if ($request->file('photo')) {
            $path = 'public/admin-photos/';
            $file = $request->file('photo');
            $file_name = Str::random(2) . time() . '.' . $file->getClientOriginalExtension();

            $file->storeAs($path, $file_name);
            $photo = "storage/admin-photos/" . $file_name;
        }

        $data = Admin::findOrFail($request->id);
        $data->name = ucwords(strtolower($request->name));
        $data->email = $request->email;
        $data->phone_number = $request->phone_number;
        $data->photo = $photo;
        $data->update();

        return response()->json([
            'code' => 200,
            'status' => 'Berhasil!',
            'message' => 'Data telah diperbaharui.',
        ]);
    }
}
