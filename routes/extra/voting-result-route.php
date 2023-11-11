<?php

use App\Http\Controllers\VotingResultController;
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

Route::prefix('input-voting-results')->controller(VotingResultController::class)->group(function () {
    Route::get('/', 'inputIndex');
    Route::get('{id}', 'inputVotingPlace');
    Route::post('store', 'store');
});
