<?php

use App\Http\Controllers\VotingPlaceController;
use Illuminate\Support\Facades\Route;

Route::prefix('voting-places')->controller(VotingPlaceController::class)->group(function () {
    Route::get('/', 'index');
    Route::post('json', 'json');
    Route::post('check', 'check');
    Route::post('store', 'store');
    Route::delete('destroy', 'destroy');
});
