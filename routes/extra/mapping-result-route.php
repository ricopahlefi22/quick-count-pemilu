<?php

use App\Http\Controllers\MappingController;
use Illuminate\Support\Facades\Route;

Route::controller(MappingController::class)->group(function(){
    Route::get('mapping-result', 'index');
    Route::get('mapping-result/district/{id}', 'district');
    Route::get('mapping-result/village/{id}', 'village');
});
