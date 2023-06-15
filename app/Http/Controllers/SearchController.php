<?php

namespace App\Http\Controllers;

use App\Models\Voter;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    function index()
    {
        $data['title'] = 'Pencarian';
        return view('admin.search.index', $data);
    }

    function search(Request $request)
    {
        $request->merge([
            'id_number' => str_replace(array('-', '_'), '', $request->id_number),
        ]);

        $request->validate([
            'id_number' => 'required|min:16',
        ]);

        $data = Voter::where('id_number', $request->id_number)->with(['votingPlace', 'village', 'district'])->first();

        if($data){
            return response()->json([
                'status' => 'success',
                'message' => 'Data ditemukan',
                'data' =>  $data,
            ]);
        }

        return response()->json([
            'status' => 'failed',
            'message' => 'Data tidak ditemukan',
        ]);
    }
}
