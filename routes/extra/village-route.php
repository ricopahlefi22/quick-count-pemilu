<?php

use App\Http\Controllers\VillageController;
use Illuminate\Support\Facades\Route;

Route::prefix('villages')->controller(VillageController::class)->group(function () {
    Route::post('json', 'json');
});
