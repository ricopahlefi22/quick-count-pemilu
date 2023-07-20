<?php

use Illuminate\Support\Facades\Route;

Route::get('mapping-result', function () {
    $data['time'] = '2023/08/01';
    return view('errors.maintenance', $data);
});

Route::get('mapping-result/district/{id}', function () {
    $data['time'] = '2023/08/01';
    return view('errors.maintenance', $data);
});

Route::get('mapping-result/village/{id}', function () {
    $data['time'] = '2023/08/01';
    return view('errors.maintenance', $data);
});
