<?php

use App\Http\Controllers\CandidateController;
use Illuminate\Support\Facades\Route;

Route::prefix('candidates')->controller(CandidateController::class)->group(function () {
    Route::get('/', 'index');
    Route::post('check', 'check');
    Route::post('store', 'store');
    Route::delete('destroy', 'destroy');

});
