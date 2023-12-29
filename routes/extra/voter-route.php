<?php

use App\Http\Controllers\ExportController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\PrintController;
use App\Http\Controllers\VoterController;
use Illuminate\Support\Facades\Route;

Route::prefix('voters')->controller(VoterController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('district/{id}', 'district');
    Route::get('village/{id}', 'village');
    Route::get('voting-place/{id}', 'votingPlace');
    Route::get('detail/{id}', 'detail');
    Route::post('validating', 'validating');
    Route::post('check', 'check');
    Route::post('store', 'store');
    Route::delete('destroy', 'destroy');

    Route::controller(ExportController::class)->group(function () {
        Route::get('export/all', 'all');
        Route::get('export/district/{id}', 'district');
        Route::get('export/village/{id}', 'village');
        Route::get('export/voting-place/{id}', 'votingPlace');
        Route::get('export/coordinator-member/{id}', 'coordinatorMember');
    });

    Route::controller(PrintController::class)->group(function(){
        Route::get('print/voting-place/{id}', 'votingPlace');
        Route::get('print/coordinator-member/{id}', 'coordinatorMember');
    });

    Route::controller(ImportController::class)->group(function () {
        Route::get('import', 'index');
        Route::post('import', 'import');
    });
});
