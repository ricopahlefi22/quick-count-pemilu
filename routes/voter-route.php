<?php

use App\Http\Controllers\CoordinatorController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\VoterController;
use Illuminate\Support\Facades\Route;

Route::prefix('voters')->controller(VoterController::class)->group(function () {
    Route::get('village/{id}', 'index');
    Route::post('validating', 'validating');
    Route::post('check', 'check');
    Route::post('store', 'store');
    Route::delete('destroy', 'destroy');

    Route::controller(CoordinatorController::class)->group(function () {
        Route::post('coordinator', 'coordinator');
        Route::post('check-coordinator', 'checkCoordinator');
        Route::post('be-coordinator', 'beCoordinator');
        Route::post('cancel-coordinator', 'cancelCoordinator');
    });

    Route::controller(ExportController::class)->group(function () {
        Route::get('export', 'export');
    });

    Route::controller(ImportController::class)->group(function () {
        Route::get('import', 'index');
        Route::post('import', 'import');
    });
});
