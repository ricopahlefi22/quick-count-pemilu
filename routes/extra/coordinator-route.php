<?php

use App\Http\Controllers\CoordinatorController;
use Illuminate\Support\Facades\Route;

Route::controller(CoordinatorController::class)->group(function () {
    Route::get('coordinators', 'index');
    Route::get('coordinators/village/{id}', 'village');
    Route::get('coordinators/detail/{id}', 'detail');
    Route::post('json', 'json');
    Route::post('list-coordinator', 'coordinator');
    Route::post('check-coordinator', 'checkCoordinator');
    Route::post('be-coordinator', 'beCoordinator');
    Route::post('cancel-coordinator', 'cancelCoordinator');
    Route::post('delete-member', 'deleteMember');
});
