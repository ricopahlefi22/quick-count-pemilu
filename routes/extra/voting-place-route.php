<?php

use App\Http\Controllers\VotingPlaceController;
use Illuminate\Support\Facades\Route;

Route::prefix('voting-places')->controller(VotingPlaceController::class)->group(function () {
    Route::post('json', 'json');
});
