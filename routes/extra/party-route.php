<?php

use App\Http\Controllers\PartyController;
use Illuminate\Support\Facades\Route;

Route::prefix('parties')->controller(PartyController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('detail/{id}', 'detail');

});
