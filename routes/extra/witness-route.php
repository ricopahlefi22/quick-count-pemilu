<?php

use App\Http\Controllers\WitnessController;
use Illuminate\Support\Facades\Route;

Route::prefix('witnesses')->controller(WitnessController::class)->group(function () {
    Route::get('/', 'index');
    Route::post('voting-places', 'votingPlaces');
    Route::post('voters', 'voters');
    Route::post('check', 'check');
    Route::post('store', 'store');
    Route::delete('destroy', 'destroy');
});
