<?php

use App\Http\Controllers\CoordinatorController;
use Illuminate\Support\Facades\Route;

Route::controller(CoordinatorController::class)->group(function () {
    Route::get('coordinator', 'index');
    Route::post('json', 'json');
    Route::post('list-coordinator', 'coordinator');
    Route::post('check-coordinator', 'checkCoordinator');
    Route::post('be-coordinator', 'beCoordinator');
    Route::post('cancel-coordinator', 'cancelCoordinator');
});
