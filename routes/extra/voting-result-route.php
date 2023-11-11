<?php

use App\Http\Controllers\VotingResultController;
use Illuminate\Support\Facades\Route;

Route::get('voting-results', function () {
    $data['time'] = '2023/12/01';
    return view('errors.maintenance', $data);
});

Route::get('voting-results/district/{id}', function () {
    $data['time'] = '2023/12/01';
    return view('errors.maintenance', $data);
});

Route::get('voting-results/village/{id}', function () {
    $data['time'] = '2023/12/01';
    return view('errors.maintenance', $data);
});

Route::prefix('input-voting-results')->controller(VotingResultController::class)->group(function () {
    Route::get('/', 'inputIndex');
    Route::get('{id}', 'inputVotingPlace');
    Route::post('store', 'store');
});
