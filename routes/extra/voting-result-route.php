<?php

use Illuminate\Support\Facades\Route;

Route::get('voting-result', function () {
    $data['time'] = '2023/10/01';
    return view('errors.maintenance', $data);
});

Route::get('voting-result/district/{id}', function () {
    $data['time'] = '2023/10/01';
    return view('errors.maintenance', $data);
});

Route::get('voting-result/village/{id}', function () {
    $data['time'] = '2023/10/01';
    return view('errors.maintenance', $data);
});

Route::get('input-voting-result', function () {
    $data['time'] = '2023/10/01';
    return view('errors.maintenance', $data);
});
