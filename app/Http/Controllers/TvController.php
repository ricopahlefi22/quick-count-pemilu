<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WebConfig;
use Illuminate\Support\Facades\Crypt;

class TvController extends Controller
{
    function tv(Request $request)
    {
        $web = WebConfig::first();
        $token = Crypt::decrypt($request->token);

        if ($token == $web->token) {
            $data['title'] = 'TV Hasil Perolehan Suara';

            return view('tv', $data);
        }

        return abort(404);
    }
}
