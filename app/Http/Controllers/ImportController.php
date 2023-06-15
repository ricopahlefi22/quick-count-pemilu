<?php

namespace App\Http\Controllers;

use App\Imports\VoterImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    function index(Request $request)
    {
        $data['title'] = 'Impor Data';

        return view('import', $data);
    }

    function import(Request $request)
    {
        $request->validate([
            'file' => 'required',
        ]);

        Excel::import($import = new VoterImport,   $request->file('file'));

        if ($import->failures()->isNotEmpty()) {
            if ($import->getRowCount() == 0) {
                return response()->json([
                    'code' => 500,
                    'status' => 'Impor Selesai!',
                    'message' => 'Tidak ada data yang dapat ditambahkan ke sistem',
                    'data' => $import->failures(),
                ]);
            } else {
                return response()->json([
                    'code' => 300,
                    'status' => 'Impor Berhasil!',
                    'message' => 'Sebanyak ' . $import->getRowCount() . ' data telah ditambahkan ke data '.$import->getLocation().' dengan beberapa pengecualian.',
                    'data' => $import->failures(),
                ]);
            }
        }

        return response()->json([
            'code' => 200,
            'status' => 'Impor Berhasil!',
            'message' => 'Sebanyak ' . $import->getRowCount() . ' data telah ditambahkan ke data '.$import->getLocation().'.',
        ]);
    }
}
